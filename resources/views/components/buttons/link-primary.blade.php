@component('components.links.link',[
    'url' => $url,
    'classes' => 'inline-block bg-blue hover:bg-blue-dark no-underline leading-none text-white font-semibold hover:text-white px-6 py-4 border border-blue hover:border-blue-dark rounded whitespace-no-wrap ml-2',
])
    {!! $slot !!}
@endcomponent