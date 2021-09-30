<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class FrontUser extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;

    protected $fillable = [
        'lang_id',
        'country_id',
        'currency_id',
        'payment_id',
        'active_diller',
        'customer_type',
        'diller_group_id',
        'is_authorized',
        'google',
        'facebook',
        'name',
        'email',
        'phone',
        'company',
        'country',
        'city',
        'street',
        'apartment',
        'contact_person',
        'password',
        'pass_str',
        'remember_token',
    ];
    protected $hidden = ['password', 'remember_token'];

    public function addresses() {
        return $this->hasMany(FrontUserAddress::class);
    }

    public function priorityAddress() {
        return $this->hasOne(FrontUserAddress::class, 'id', 'priorityaddress');
    }
}
