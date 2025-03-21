@php
    $label ??=null;
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??='';
    @endphp


<div @class(["form-group",$class])>
    <label for="{{ $name }}">{{ $label }}</label>
    <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name,$value) }}">
</div>
