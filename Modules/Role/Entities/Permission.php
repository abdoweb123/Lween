<?php

namespace Modules\Role\Entities;

use App\Traits\DeleteImage;
use App\Traits\Status;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use DeleteImage, HasFactory, Status, Translate;

    protected $guarded = [];

    protected $table = 'permissions';
}
