<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQrcodeRequest;
use App\Http\Requests\UpdateQrcodeRequest;
use App\Repositories\QrcodeRepository;
use Illuminate\Http\Request;
use Flash;
use QRCode;
use App\Models\Qrcode as QrcodeModel;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\Transaction;
use App\Models\User;
use App\Http\Resources\Qrcode as QrcodeResource;

class QrcodeController extends AppBaseController
{
    /** @var QrcodeRepository */
    private $qrcodeRepository;

    public function __construct(QrcodeRepository $qrcodeRepo)
    {
        $this->qrcodeRepository = $qrcodeRepo;
    }

    /**
     * Display a listing of the Qrcode.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id < 3) {
            $this->qrcodeRepository->pushCriteria(new RequestCriteria($request));
            $qrcodes = $this->qrcodeRepository->all();
        } else {
            $qrcodes = QrcodeModel::where('user_id', Auth::user()->id)->get();
        }

        return view('qrcodes.index')
            ->with('qrcodes', $qrcodes);
        // return new QrcodeResource($qrcodes);
    }

    public function show_payment(Request $request)
    {
        //check if the user exists
        //if not create a registration form
        $input = $request->all();
        $user = User::where('email', $input['email'])->first();

        if (empty($user)) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['email']),
            ]);
        }
        //qet the qrcode details
        $qrcode = QrcodeModel::where('id', $input['qrcode_id'])->first();
        $transaction = Transaction::create([
            'qrcode_id' => $qrcode->id,
            'user_id' => $qrcode->user_id,
            'status' => 'Initiated',
            'payment_method' => 'Paystack/Card',
            'ammount' => $qrcode->ammount,
            'qrcode_owner_id' => $qrcode->user_id,
        ]);

        return view('qrcodes.paystack-form')
                    ->with('transaction', $transaction)
                    ->with('user', $user)
                    ->with('qrcode', $qrcode);
    }

    /**
     * Show the form for creating a new Qrcode.
     *
     * @return Response
     */
    public function create()
    {
        return view('qrcodes.create');
    }

    /**
     * Store a newly created Qrcode in storage.
     *
     * @param CreateQrcodeRequest $request
     *
     * @return Response
     */
    public function store(CreateQrcodeRequest $request)
    {
        //receive all the form input
        $input = $request->all();

        //save everything in the database
        $qrcode = $this->qrcodeRepository->create($input);
        //save qrcode path

        $file = 'generated_qrcodes/'.$qrcode->id.'.png';

        $newQrcodes = QRCode::text('message')
            ->setsize(8)
            ->setMargin(2)
            ->setOutfile($file)
            ->png();

        //save the file path
        $input['qrcode_path'] = $file;

        $newQrcode = QrcodeModel::where(['id' => $qrcode->id])
                  ->update(['qrcode_path' => $input['qrcode_path']]);

        if ($newQrcodes) {
            Flash::success('Qrcode saved successfully.');
        } else {
            Flash::error('Qrcode failed to save successfully.');
        }

        return redirect(route('qrcodes.show', ['qrcode' => $qrcode]));
    }

    /**
     * Display the specified Qrcode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }
        $transactions = $qrcode->transactions;

        return view('qrcodes.show')
                   ->with('qrcode', $qrcode)
                   ->with('transactions', $transactions);
    }

    /**
     * Show the form for editing the specified Qrcode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        return view('qrcodes.edit')->with('qrcode', $qrcode);
    }

    /**
     * Update the specified Qrcode in storage.
     *
     * @param int                 $id
     * @param UpdateQrcodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQrcodeRequest $request)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        $qrcode = $this->qrcodeRepository->update($request->all(), $id);

        Flash::success('Qrcode updated successfully.');

        return redirect(route('qrcodes.show', ['qrcode' => $qrcode]));
    }

    /**
     * Remove the specified Qrcode from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        $this->qrcodeRepository->delete($id);

        Flash::success('Qrcode deleted successfully.');

        return redirect(route('qrcodes.index'));
    }
}
