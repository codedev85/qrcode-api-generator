<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 * @package App\Models
 * @version December 10, 2018, 2:37 pm UTC
 *
 * @property integer user_id
 * @property float balance
 * @property float total_credit
 * @property float total_debit
 * @property string withrawal_method
 * @property integer applied_for_payouts
 * @property date last_date_applied
 * @property date last_date_paid
 * @property integer paid
 * @property string payment_email
 * @property string bank_name
 * @property string bank_branch
 * @property string bank_account
 * @property string country
 * @property string other_details
 * @property string payment_details
 */
class Account extends Model
{
    use SoftDeletes;

    public $table = 'accounts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'balance' => 'float',
        'total_credit' => 'float',
        'total_debit' => 'float',
        'withrawal_method' => 'string',
        'applied_for_payouts' => 'integer',
        'last_date_applied' => 'date',
        'last_date_paid' => 'date',
        'paid' => 'integer',
        'payment_email' => 'string',
        'bank_name' => 'string',
        'bank_branch' => 'string',
        'bank_account' => 'string',
        'country' => 'string',
        'other_details' => 'string',
        'payment_details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
         /**
     * Get the user associated with this account.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
         /**
     * Get the accountHistory associated with this account.
     */
    public function account_histories()
    {
        return $this->hasMany('App\Models\AccountHistory');
    }

    
}
