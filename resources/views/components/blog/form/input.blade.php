@props(['type'=>'text', 'name', 'placeholder', 'required'=>'true','value'])
<input value="{{ $value }}" {{ $required == true ? 'required': ""}} rows='5'  type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"class=
       "form-control" placeholder="{{ $placeholder }}"/>
@error($name)
<p class='text-danger'>{{ $message  }}</p>
@enderror