@component('components.links.link',[
    'url' => $url,
    'classes' => 'inline-block bg-transparent no-underline leading-none text-blue font-semibold hover:text-blue-dark px-6 py-2 border border-blue-lighter hover:border-blue-light rounded whitespace-no-wrap ml-2',
])
    {!! $slot !!}
@endcomponent