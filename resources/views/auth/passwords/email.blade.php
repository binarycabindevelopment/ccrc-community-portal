@extends('layouts.dashboard.app')

@section('content')

    <div class="p-4 px-3 py-10 bg-grey-lighter flex justify-center flex-1">

        <div class="w-full max-w-lg self-center">

            <h2 class="mb-4">Send A Reset Password Email</h2>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-4 mb-4">
                {!! Former::open(route('password.email'))->method('POST') !!}
                <div class="mb-4">
                    {!! Former::email('email','Email Address')->required() !!}
                    @component('components.buttons.submit')
                        {{ __('Send Password Reset Link') }}
                    @endcomponent
                </div>
                {!! Former::close() !!}
            </div>

        </div>
    </div>

@endsection
