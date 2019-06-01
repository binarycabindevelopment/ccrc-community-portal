@extends('layouts.dashboard.app')

@section('content')

    <div class="p-4 px-3 py-10 bg-grey-lighter flex justify-center flex-1">

        <div class="w-full max-w-lg self-center">

            <h2 class="mb-4">Reset Password</h2>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-4 mb-4">
                {!! Former::open(route('password.update'))->method('POST') !!}
                <input type="hidden" name="token" value="{{ $token }}">
                {!! Former::password('password','Password')->required() !!}
                {!! Former::password('password_confirmation','Confirm Password')->required() !!}
                <div class="mb-4">
                    {!! Former::email('email','Email Address')->required() !!}
                    @component('components.buttons.submit')
                        {{ __('Reset Password') }}
                    @endcomponent
                </div>
                {!! Former::close() !!}
            </div>

        </div>
    </div>

@endsection
