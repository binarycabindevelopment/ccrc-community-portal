@extends('layouts.dashboard.app')

@section('content')

    <div class="bg-no-repeat bg-cover bg-center" style="background-image: url(https://images.unsplash.com/photo-1496303601138-6e0bca445fa3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80);">
		<div class="py-32" style="background-color:rgba(0,0,0,0.25);">

            <div class="container py-32">

                <h1 class="mb-8 text-white text-4xl">Find Continuing Care Retirement Community Near You</h1>
                {!! Former::open_vertical('/community')->method('GET')->autocomplete('off') !!}
                <div class="flex h-24">
                    <div class="flex-1">
                        <community-search :communities="{{ $communities }}"></community-search>
                    </div>
                    <div class="pl-4 pt-4">
                        <button type="submit" class="no-underline text-white py-3 px-4 font-medium bg-blue hover:bg-blue-dark rounded-full"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                {!! Former::close() !!}
            </div>

		</div>
	</div>

@stop
