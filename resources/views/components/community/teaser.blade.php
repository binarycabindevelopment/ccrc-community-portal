<article class="overflow-hidden rounded shadow-lg bg-white">

    <a href="{{ url($community->getPath()) }}">
        <div class="block w-full h-48 bg-center bg-cover" style="background-image: url('{{ $community->photo_path }}');">&nbsp;</div>
    </a>

    <header class="flex items-center justify-between leading-tight px-2 md:p-4">
        <h1 class="text-lg">
            <a class="no-underline hover:underline text-black" href="{{ url($community->getPath()) }}">
                {{ $community->name }}
            </a>
        </h1>
        <?php /*
        <p class="text-grey-darker text-sm pl-4">
            [label]
        </p> */ ?>
    </header>

    <footer class="flex items-center justify-between leading-none px-2 md:px-4 pb-2 md:pb-4">
        <a class="flex items-center no-underline hover:underline text-black" href="{{ url($community->getPath()) }}">
            <p class="text-sm">
                {{ $community->city }}, {{ $community->state }} {{ $community->zipcode }}
            </p>
        </a>
        <a class="no-underline text-grey-darker hover:text-red-dark" href="{{ url($community->getPath()) }}">
            <span class="hidden">Like</span>
            <i class="fa fa-heart"></i>
        </a>
    </footer>

</article>