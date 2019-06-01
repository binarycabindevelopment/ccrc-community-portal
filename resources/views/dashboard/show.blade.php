@extends('layouts.dashboard.app')

@section('content')
	<div class="bg-grey-lighter">
		<div class="container py-16">
			@component('components.panels.panel',['title'=>'Dashboard'])
				<p>- <a href="{{ url('/account/user') }}">Update My Account Details</a></p>
				@if(\Auth::user()->isCCRCManager())
				<p>- <a href="{{ url('/account/billing') }}">Update My Billing Details</a></p>
				@endif
			@endcomponent
		</div>
	</div>
@stop
