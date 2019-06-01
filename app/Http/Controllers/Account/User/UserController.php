<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function edit(){
        return view('account.user.edit',[]);
    }

    public function update(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);
        $userData = $request->only([
            'first_name',
            'last_name',
            'email',
            'company_name',
        ]);
        \Auth::user()->update($userData);
        $newPassword = $request->password;
        if(!empty($newPassword)){
            \Auth::user()->updatePassword($newPassword);
        }
        \Auth::user()->updateCCRCManager($request->is_ccrc_manager);
        if(!empty($request->file('avatar'))){
            \Auth::user()->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
        return redirect('/account/user')->withSuccess('Saved!');
    }

}