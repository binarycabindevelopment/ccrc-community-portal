<?php

namespace App\Http\Controllers\Account\User\Avatar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AvatarController extends Controller
{

    public function destroy()
    {
        $user = \Auth::user();
        $avatar = $user->getFirstMedia('avatar');
        if($avatar){
            $avatar->delete();
        }
        return redirect()->back()->withSuccess('deleted');
    }

}
