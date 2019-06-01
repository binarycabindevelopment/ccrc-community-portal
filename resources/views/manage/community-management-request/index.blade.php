@extends('layouts.dashboard.app')

@section('content')
	<div class="bg-grey-lighter">

        <div class="container pt-8 pb-8">
            @include('components.breadcrumbs.breadcrumbs',[
                'links' => [
                    url('/dashboard') => 'Dashboard',
                    url('/manage/community-management-request') => 'Manage Community Requests',
                ]
            ])
        </div>

		<div class="container pb-8">

			<table class="table">
				<thead>
					<tr>
						<th>User</th>
						<th>Community</th>
						<th>Status</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				@foreach($communityManagementRequests as $communityManagementRequest)
					<tr>
						<td><a href="{{ url('/manage/user/'.$communityManagementRequest->user_id.'/edit') }}">{{ $communityManagementRequest->user->email }}</a></td>
						<td><a href="{{ url('/community/'.$communityManagementRequest->community_uuid) }}">{{ $communityManagementRequest->getCommunityName() }}</a></td>
						<td>
							@if(empty($communityManagementRequest->approved_at))
								<span class="text-red">Not Approved</span>
								@else
								<span class="text-green">Approved By {{ $communityManagementRequest->approvedByUser->email }} at {{ $communityManagementRequest->approved_at->format('m/d/Y') }}</span>
							@endif
						</td>
						<td class="text-center">
							@if(empty($communityManagementRequest->approved_at))
							@component('components.buttons.link',['url'=>'/manage/community-management-request/'.$communityManagementRequest->id.'/approve'])
								Approve
							@endcomponent
							@endif
							<div class="mb-1"> </div>
							{!! Former::open('/manage/community-management-request/'.$communityManagementRequest->id)->method('DELETE') !!}
								<button class="text-red text-sm rounded bg-transparent px-2 py-1 border border-red inline-block" type="submit">Delete</button>
							{!! Former::close() !!}

						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

		</div>
	</div>
@stop
