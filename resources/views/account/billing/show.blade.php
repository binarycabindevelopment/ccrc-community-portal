@extends('layouts.dashboard.app')

@section('content')
    <div class="bg-grey-lighter">

        <div class="container pt-8 pb-8">
            @include('components.breadcrumbs.breadcrumbs',[
                'links' => [
                    url('/dashboard') => 'Dashboard',
                    url('/account/billing') => 'My Billing Details',
                ]
            ])
        </div>

    <div class="container pb-8">



        <div class="mb-8">
            @component('components.panels.panel',['title'=>'Billing Method'])
                @include('account.billing.partials.default-card-table',['billingMethod'=>$billingMethod])
            @endcomponent
        </div>

        <div class="mb-8">
            @component('components.panels.panel',['title'=>'Plan Information'])
                Please enter your billing information
            @endcomponent
        </div>

        <div class="mb-8">
            @component('components.panels.panel',['title'=>'Payment History'])
                No payments available
            @endcomponent
        </div>

    </div>
    </div>

@endsection
