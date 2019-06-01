@extends('layouts.dashboard.app')

@section('content')
    <div class="bg-grey-lighter">

        <div class="container pt-8 pb-8">
            @include('components.breadcrumbs.breadcrumbs',[
                'links' => [
                    url('/community') => 'Communities',
                    url($community->getPath()) => $community->name,
                ]
            ])
        </div>

        <div class="container pb-8">
            <div class="flex justify-between">
                <div><h2>{{ $community->name }}</h2></div>
                <div>
                    @component('components.buttons.link-primary',['url'=>'#contact']) Contact Community @endcomponent
                </div>
            </div>

        </div>

        <div class="container pb-8">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-6 lg:mb-0 lg:w-3/5 px-4 flex flex-col">

                    <div>
                        @component('components.panels.panel',['title'=>'Community Description'])
                            {!! nl2br($community->description) !!}
                        @endcomponent
                    </div>

                </div>
                <div class="w-full mb-6 lg:mb-0 lg:w-2/5 px-4 flex flex-col">
                    <div class="mb-4">
                        <img src="{{ $community->photo_path }}" class="rounded shadow w-full"/>
                    </div>
                    <div class="text-right">
                        <a class="no-underline text-grey-darker hover:text-red-dark text-xs uppercase" href="#">
                            <span class="mr-1 font-bold">Add to favorites</span>
                            <i class="fa fa-heart"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-8">
            @component('components.panels.panel',['title'=>'Location'])
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-6 md:mb-0 lg:w-2/5 px-4 flex flex-col text-center self-center">

                    <div class="mb-4 text-3xl">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="mb-4 text-lg">
                        {{ $community->street_address_1 }}<br/>
                        @if(!empty($community->street_address_2)) {{ $community->street_address_2 }}<br/> @endif
                        {{ $community->city }}, {{ $community->state }} {{ $community->zipcode }}
                    </div>

                    <div>
                        <a href="https://www.google.com/maps?daddr={{ $community->street_address_1 }}+{{ $community->city }}+{{ $community->state }}+{{ $community->zipcode }}
" class="text-black font-bold" target="_blank">Get Directions</a>
                    </div>


                </div>
                <div class="w-full mb-6 lg:mb-0 lg:w-3/5 px-4 flex flex-col">
                    <iframe
                            width="100%"
                            height="300"
                            frameborder="0"
                            scrolling="no"
                            marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?coord={{ $community->latitude }},{{ $community->longitude }}&q={{ $community->street_address_1 }}+{{ $community->city }}+{{ $community->state }}+{{ $community->zipcode }}&hl=es;z=14&amp;output=embed"
                    >
                    </iframe>
                </div>
            </div>
            @endcomponent

        </div>

        <div class="container pb-8">
            @component('components.panels.panel',['title'=>'Community Details'])
                [details]
            @endcomponent
        </div>

        <div class="container pb-8">
            @component('components.panels.panel',['title'=>'Entrance Details'])
                [details]
            @endcomponent
        </div>

        <div class="container pb-8">
            @component('components.panels.panel',['title'=>'Higher Level of Care'])
                [details]
            @endcomponent
        </div>

        <div class="container pb-8" id="contact">
            @component('components.panels.panel',['title'=>'Contact'])
                {!! Former::open_vertical($community->getPath('/contact-submission')) !!}
            <div class="flex -mx-4">
                <div class="w-1/2 px-4">
                    {!! Former::text('first_name','First Name') !!}
                </div>
                <div class="w-1/2 px-4">
                    {!! Former::text('last_name','Last Name') !!}
                </div>
            </div>
                {!! Former::email('email','Email Address') !!}
                {!! Former::text('phone','Phone Number') !!}
                {!! Former::textarea('message','Comments')->rows(8) !!}
                {!! Former::checkbox('subscribe','')->text('I consent to receiving emails containing community related information from this site. I understand that I can unsubscribe at any time.
')->check() !!}
                @component('components.buttons.submit') Send @endcomponent
                {!! Former::close() !!}
            @endcomponent
        </div>

        @if(\Auth::user() && \Auth::user()->isCCRCManager())
            <div class="container pb-8">
                <p class="text-right mb-4">
                    <a href="{{ url('/account/community-management-request/create?community_key='.$community->uuid) }}" class="no-underline hover:underline text-grey-dark text-sm">Are you a manager of {{ $community->name }}?</a>
                </p>
            </div>
        @endif

    </div>

@stop
