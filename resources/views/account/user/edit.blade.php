@extends('layouts.dashboard.app')

@section('content')
	<div class="bg-grey-lighter">

        <div class="container pt-8 pb-8">
            @include('components.breadcrumbs.breadcrumbs',[
                'links' => [
                    url('/dashboard') => 'Dashboard',
                    url('/account/user') => 'My Account Details',
                ]
            ])
        </div>

		<div class="container pb-8">

			{!! Former::open_vertical_for_files('/account/user')->method('PATCH') !!}
			<div class="flex -mx-4">
				<div class="w-2/3 px-4">

					@component('components.panels.panel',['title'=>'My Account Details'])
							{!! Former::populate(\Auth::user()) !!}
							{!! Former::text('first_name','First Name')->required() !!}
							{!! Former::text('last_name','Last Name')->required() !!}
							{!! Former::email('email','Email Address')->required() !!}
							{!! Former::password('password','Password')->help('Leave blank to keep existing password') !!}
							{!! Former::checkbox('is_ccrc_manager','')->text('CCRC Manager Account') !!}
							<div id="company_name_container">
								{!! Former::text('company_name','Company Name') !!}
							</div>
							@component('components.buttons.submit')
								Save
							@endcomponent
						@endcomponent

				</div>
				<div class="w-1/3 px-4">
					@include('components.user.input-avatar',[
					'user'=>\Auth::user(),
					'deleteURL' => url('/account/user/avatar/delete')
					])
				</div>
			</div>
			{!! Former::close() !!}

		</div>
	</div>
@stop
