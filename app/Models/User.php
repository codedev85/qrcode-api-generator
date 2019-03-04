<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User.
 *
 * @version November 13, 2018, 10:25 am UTC
 *
 * @property string name
 * @property int role_id
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string remember_token
 */
class User extends Model
{
    use SoftDeletes, HasApiTokens, Notifiable;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'role_id',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'role_id' => 'integer',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
    ];

    /**
     * Get the transactions for the user.
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Get the user for the QECodes.
     */
    public function qrcodes()
    {
        return $this->hasMany('App\Models\Qrcode');
    }

    /**
     * Get the account associated with this user.
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account');
    }

    /**
     * Get the account history  of the user.
     */
    public function account_histories()
    {
        return $this->hasMany('App\Models\accountHistory');
    }
}
