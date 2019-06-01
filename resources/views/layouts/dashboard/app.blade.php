<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body class="bg-black">
    <div id="app" class="border-t-8 border-blue leading-normal">

        @include('components.layout.navbar')

        <main class="bg-white overflow-hidden">
            @yield('content')
        </main>

        <div class="bg-grey-darker text-grey-light py-12">
            <div class="container">
                <h3 class="mb-4">Find a community in</h3>
                <div class="flex flex-wrap leading-normal">
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Newark, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Jersey City, NJ</a>
                    <a href="/community?city=Paterson&state=NJ" class="text-grey no-underline block w-1/4">Paterson, NJ</a>
                    <a href="/community?city=Elizabeth&state=NJ" class="text-grey no-underline block w-1/4">Elizabeth, NJ</a>
                    <a href="/community?city=Edison&state=NJ" class="text-grey no-underline block w-1/4">Edison, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Woodbridge Township, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Lakewood Township, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Toms River, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Hamilton Township, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Trenton, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Clifton, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Camden, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Brick Township, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Cherry Hill, NJ</a>
                    <a href="/community?city=Passaic&state=NJ" class="text-grey no-underline block w-1/4">Passaic, NJ</a>
                    <a href="/community?city=Newark&state=NJ" class="text-grey no-underline block w-1/4">Newark, NJ</a>
                </div>
            </div>
        </div>
        <div class="bg-black text-grey-dark text-xs py-8">
            <div class="container">
                Copyright {{ date('Y') }} {{ config('app.name') }}
            </div>
        </div>
    </div>

    @include('components.layout.scripts')

</body>
</html>
