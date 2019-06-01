<?php
if(empty($classes)){
    $classes = '';
}
?>
<a href="{{ $url }}" class="{{ $classes }}">
    {!! $slot !!}
</a>