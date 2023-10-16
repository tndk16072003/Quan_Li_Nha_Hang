<?php

namespace App\Http\Controllers;

use App\Models\Quyen;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkRule($id_fun)
    {
        $login      = Auth::guard('aloxinh')->user();
        $list_quyen = Quyen::find($login->id_quyen)->list_id_quyen;
        $arr_quyen  = explode(",", $list_quyen);
        if(!in_array($id_fun, $arr_quyen)) {
            return true;
        } else {
            return false;
        }
    }
}
