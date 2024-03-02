<?php

namespace Modules\Role\Entities;

use App\Traits\DeleteImage;
use App\Traits\Status;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use DeleteImage, HasFactory, Status, Translate;

    protected $guarded = [];

    protected $table = 'roles';
}
