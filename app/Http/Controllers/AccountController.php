<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Account;
use Auth;
use App\Models\AccountHistory;

class AccountController extends AppBaseController
{
    /** @var AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountRepository->pushCriteria(new RequestCriteria($request));
        $accounts = $this->accountRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * recieve the request sent .
     * ensure the person that sent the request is the owner of the account
     * update the applied for payout filed the account table
     *show succes mesage ad redirect.
     */
    public function apply_for_payout(Request $request)
    {
        // $input = $request->input('apply_for_payout');
        $account = $this->accountRepository->findWithoutFail($request->input('apply_for_payout'));
   
        if (empty($account)) {
            Flash::error('Account not found');

            return redirect()->back();
        }

        if (Auth::user()->id != $account->id) {
            Flash::error('Not authorized to perform this operation');

            return redirect()->back();
        }
        //updating an account
        Account::where('id', $account->id)->update([
            'applied_for_payouts' => 1,
            'paid'=>0,
            'last_date_applied'=>date()
            ]);
        AccountHistory::create([
            'user_id'=> $account->user_id,
            'account_id'=>$account->id,
            'message'=>'Payout request pending'
        ]);
        Flash::success('Application Successful');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function mark_as_paid(Request $request){
            // $input = $request->input('apply_for_payout');
        $account = $this->accountRepository->findWithoutFail($request->input('mark_as_paid'));
        if (empty($account)) {
            Flash::error('Account not found');

            return redirect()->back();
        }

        if (Auth::user()->role_id < 3) {
            Flash::error('Not authorized to perform this operation');

            return redirect()->back();
        }
        
        Account::where('id', $account->id)->update([
            'applied_for_payouts' => 0,
            'paid'=>1,
            'last_date_paid'=> date()
            ]);
            
        AccountHistory::create([
            'user_id'=> $account->user()->id,
            'account_id'=>$account->id,
            'message'=>'Payout approved'
        ]);
        Flash::success('Application Successful');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id = null)
    {

        if(isset($id)){
            $account = Account::where('user_id', Auth::user()->id)->first();
        }else{
            $account = $this->accountRepository->findWithoutFail($id);
        }

        

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        $accountHistories = $account->account_histories;

        return view('accounts.show')
                   ->with('account', $account)
                   ->with('accountHistories', $accountHistories);
                   
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param int                  $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }
}
