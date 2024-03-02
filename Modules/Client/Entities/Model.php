<?php

namespace Modules\Client\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Address\Entities\Model as Address;
use Modules\Country\Entities\Country;
use Spatie\Permission\Traits\HasRoles;

class Model extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $table = 'clients';

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function Addresses()
    {
        return $this->hasMany(Address::class, 'client_id');
    }
}
