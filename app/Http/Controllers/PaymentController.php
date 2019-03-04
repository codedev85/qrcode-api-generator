<?php

namespace App\Http\Controllers;

use Paystack;
use App\Models\Qrcode as QrcodeModel;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\User;
use App\Models\AccountHistory;
use Flash;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page.
     *
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information.
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        //dd($paymentDetails);
        if ($paymentDetails['data']['status'] != 'success') {
            Flash::error('Payment failed');

            return redirect()->route('qrcodes.show', ['id' => $paymentDetails['data']['metadata']['qrcode_id']]);
        }

        //check if the user pays the exact amount

        $qrcode = QrcodeModel::where(['id' => $paymentDetails['data']['metadata']['qrcode_id']])->first();
        if ($qrcode->ammount != ($paymentDetails['data']['amount'] / 100)) {
            Flash::error('Payment failed , you didnt oay the exact amount');

            return redirect()->route('qrcodes.show', ['id' => $paymentDetails['data']['metadata']['qrcode_id']]);
        }

        //update transaction
        $transaction = Transaction::where('id', $paymentDetails['data']['metadata']['transaction_id'])->first();
        Transaction::where('id', $paymentDetails['data']['metadata']['transaction_id'])
                                          ->update(['status' => 'Completed']);
        //get the user
        $buyer = User::find($paymentDetails['data']['metadata']['buyer_user_id']);

        //update qrcode owner account and accounthistory
        $qrcodeAccountowner = Account::where(['user_id' => $qrcode->user_id])->first();

        Account::where(['user_id' => $qrcode->user_id])->update([
            'balance' => ($qrcodeAccountowner->balance + $qrcode->ammount),
            'total_credit' => ($qrcodeAccountowner->total_credit + $qrcode->ammount),
        ]);

        //update buyer account an account history
        AccountHistory::create([
            'user_id' => $qrcode->user_id,
            'account_id' => $qrcodeAccountowner->id,
            'message' => 'Received '.$transaction->payment_method.' payment from '.$buyer->email.' for qrcode '.$qrcode->product_name,
        ]);

        //update buyer account and accounthistory
        $buyerAccountowner = Account::where(['user_id' => $qrcode->user_id])->first();
        Account::where('user_id', $paymentDetails['data']['metadata']['buyer_user_id'])->update([
               'total_debit' => ($qrcodeAccountowner->total_debit + $qrcode->ammount),
           ]);

        //update buyer account an account history
        AccountHistory::create([
               'user_id' => $paymentDetails['data']['metadata']['buyer_user_id'],
               'account_id' => $buyerAccountowner->id,
               'message' => 'Paid'.$transaction->payment_method.' payment to '.$qrcode->user['email'].' for qrcode '.$qrcode->product_name,
           ]);

        return redirect()->route('transactions.show', ['id' => $transaction->id]);
        //send sms and emial

        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
