<div class="breadcrumbs">
    @foreach($links as $url => $link)
        <a href="{{ $url }}" class="breadcrumb-item">{{ $link }}</a>
    @endforeach
</div>