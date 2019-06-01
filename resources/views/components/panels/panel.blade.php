<div class="bg-white shadow rounded mb-4 border-t border-b sm:rounded sm:border">
    @if(!empty($title))
    <div class="border-b">
        <div class="flex justify-between px-6 -mb-px">
            <h3 class="text-blue-dark py-4 font-normal text-lg">{!! $title !!}</h3>
        </div>
    </div>
    @endif
    <div>
        <div class="p-6">
            {!! $slot !!}
        </div>
    </div>
</div>