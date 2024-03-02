<?php

namespace Modules\Admin\Entities;

use App\Traits\Status;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Model extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable, Status;

    protected $guarded = [];

    protected $table = 'admins';

    protected $hidden = ['password', 'remember_token'];
}
