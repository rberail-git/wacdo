@php
    $label ??=null;
    $multiple ??= false;
    $class ??= null;
    $name ??= '';
    $options ??=[];
    $value ??= [];
@endphp



<div @class(["form-group",$class])>
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}@if($multiple) [] @endif" @if($multiple) multiple @endif>
        <option value="">Choisir</option>
        @foreach($options as $k => $v)
            <option value="{{ $k }}" @if(in_array($k,Arr::flatten($value))) selected @endif >{{ $v }}</option>
        @endforeach
    </select>
</div>
