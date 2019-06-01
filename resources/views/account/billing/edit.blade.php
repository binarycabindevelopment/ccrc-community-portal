@extends('layouts.dashboard.app')

@section('content')
    <div class="bg-grey-lighter">

        <div class="container pt-8 pb-8">
            @include('components.breadcrumbs.breadcrumbs',[
                'links' => [
                    url('/dashboard') => 'Dashboard',
                    url('/account/billing') => 'My Billing Details',
                    url('/account/billing/edit') => 'Update Billing Method',
                ]
            ])
        </div>

        <div class="container pb-8">

            <div class="mb-8">
                @component('components.panels.panel',['title'=>'Update Billing Method'])
                    {!! Former::open_vertical('/account/billing')->method('PATCH')->id('payForm') !!}
                    @include('components.billing.fields')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Set Payment Method</button>
                    </div>
                    {!! Former::close() !!}
                @endcomponent
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    @include('components.billing.scripts')

    <script>
        $(function() {
            $('#payForm').submit(function() {
                $(this).find("button[type='submit']").prop('disabled',true);
            });
        });
    </script>

@endsection
