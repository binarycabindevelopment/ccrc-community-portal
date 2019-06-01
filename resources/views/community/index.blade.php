@extends('layouts.dashboard.app')

@section('content')
<div class="bg-grey-lighter">
    <div class="container py-8">
        {!! Former::open_vertical('/community')->method('GET')->autocomplete('off') !!}
        <div class="flex h-24">
            <div class="flex-1">
                <community-search :communities="{{ $communities }}" @if(!empty($_GET['query'])) value="{{ $_GET['query'] }}" @endif></community-search>
            </div>
            <div class="pl-4 pt-4">
                <button type="submit" class="no-underline text-white py-3 px-4 font-medium bg-blue hover:bg-blue-dark rounded-full"><i class="fas fa-search"></i></button>
            </div>
        </div>
        {!! Former::close() !!}
    </div>

    <div class="container pt-2">
        <div class="flex flex-wrap -mx-4">
            @foreach($filteredCommunities->take(9) as $community)
                <div class="w-1/3 px-4 mb-8">
                    @include('components.community.teaser',['community' => $community])
                </div>
            @endforeach
        </div>
        @if($filteredCommunities->count() == 0)
            <div class="mb-8 text-red text-center">No results found, please try another search</div>
        @endif
    </div>
</div>


@stop
