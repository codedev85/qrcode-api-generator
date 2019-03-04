<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction.
 *
 * @version November 13, 2018, 10:25 am UTC
 *
 * @property int qrcode_id
 * @property int qrcode_owner_id
 * @property int user_id
 * @property string payment_method
 * @property float amount
 * @property string message
 * @property string status
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'qrcode_id',
        'qrcode_owner_id',
        'user_id',
        'payment_method',
        'amount',
        'message',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qrcode_id' => 'integer',
        'qrcode_owner_id' => 'integer',
        'user_id' => 'integer',
        'payment_method' => 'string',
        'amount' => 'float',
        'message' => 'string',
        'status' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
    ];

    /**
     * Get the qrcode that owns the transaction.
     */
    public function qrcode()
    {
        return $this->belongsTo('App\Models\Qrcode');
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

     /**
     * Get the qrcode owner.
     */
     public function qrcode_owner()
     {
         return $this->belongsTo('App\Models\User' , 'qrcode_owner_id');
     }
}
