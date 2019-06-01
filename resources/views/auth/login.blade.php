@extends('layouts.dashboard.app')

@section('content')

    <div class="p-4 px-3 py-10 bg-grey-lighter flex justify-center flex-1">

        <div class="w-full max-w-lg self-center">

            <h2 class="mb-4">Login</h2>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-4 mb-4">
                {!! Former::open(route('login'))->method('POST') !!}
                <div class="mb-4">
                    {!! Former::email('email','Email Address')->required() !!}
                    {!! Former::password('password','Password')->required() !!}
                    @component('components.buttons.submit')
                        Login
                    @endcomponent
                </div>
                {!! Former::close() !!}
            </div>

            <div class="text-center">
                <a href="{{ route('password.request') }}" class="inline-block align-baseline font-bold text-xs text-blue hover:text-blue-darker">
                    Forgot Password?
                </a>
            </div>

        </div>
    </div>

@endsection
