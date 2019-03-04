<?php

namespace App\Repositories;

use App\Models\Transaction;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version November 13, 2018, 10:25 am UTC
 *
 * @method Transaction findWithoutFail($id, $columns = ['*'])
 * @method Transaction find($id, $columns = ['*'])
 * @method Transaction first($columns = ['*'])
*/
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qrcode_id',
        'qrcode_owner_id',
        'user_id',
        'payment_method',
        'amount',
        'message',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transaction::class;
    }
}
