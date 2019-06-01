@extends('layouts.dashboard.app')

@section('content')
	<div class="bg-grey-lighter">

        <div class="container pt-8 pb-8">
            @include('components.breadcrumbs.breadcrumbs',[
                'links' => [
                    url('/dashboard') => 'Dashboard',
                ]
            ])
        </div>

		<div class="container pb-8">

			{!! Former::open_vertical_for_files('/account/community-management-request')->method('POST') !!}

			@component('components.panels.panel',['title'=>'Request to Manage '.$community->name])
				{!! Former::hidden('community_uuid',$community->uuid) !!}
				@component('components.buttons.submit')
					Confirm Request
				@endcomponent
			@endcomponent

			{!! Former::close() !!}

		</div>
	</div>
@stop
