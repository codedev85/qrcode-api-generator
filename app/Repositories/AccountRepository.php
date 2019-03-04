<?php

namespace App\Repositories;

use App\Models\Account;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AccountRepository
 * @package App\Repositories
 * @version December 10, 2018, 2:37 pm UTC
 *
 * @method Account findWithoutFail($id, $columns = ['*'])
 * @method Account find($id, $columns = ['*'])
 * @method Account first($columns = ['*'])
*/
class AccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'balance',
        'total_credit',
        'total_debit',
        'withrawal_method',
        'applied_for_payouts',
        'last_date_applied',
        'last_date_paid',
        'paid',
        'payment_email',
        'bank_name',
        'bank_branch',
        'bank_account',
        'country',
        'other_details',
        'payment_details'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Account::class;
    }
}
