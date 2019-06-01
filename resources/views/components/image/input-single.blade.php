@if(!empty($model) && !empty($model->getFirstMediaUrl($name)))
    @if(!empty($deleteURL))
        <div class="text-right"><small><a href="{{ $deleteURL }}" class="text-danger">Delete {{ $label }}</a></small></div>
    @endif
    <p><img src="{{ $model->getFirstMediaUrl($name,$size) }}" class="embed-responsive" /></p>
    {!! Former::file($name,'Upload a new '.$label) !!}
@else
    {!! Former::file($name,'Upload '.$label) !!}
@endif