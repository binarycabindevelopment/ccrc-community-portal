<?php

namespace App\Http\Controllers\Account\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    public function show(){
        $user = \Auth::user();
        $billingMethod = $user->getBillingMethodCustomer();
        return view('account.billing.show',['billingMethod'=>$billingMethod]);
    }

    public function edit(){
        return view('account.billing.edit',[]);
    }

    public function update(Request $request){
        $this->validate($request,['stripeToken'=>'required']);
        $user = \Auth::user();
        $user->updateBillingMethod($request->all());
        return redirect('account/billing')->withSuccess('Billing information updated');
    }

}
