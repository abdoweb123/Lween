<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Category\Entities\Model as Category;

class BasicController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}//end of class
