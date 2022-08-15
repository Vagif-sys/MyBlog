@props(['name', 'placeholder', 'value'])
<textarea required id="{{ $name }}" name="{{ $name }}"class="form-control" 
      placeholder="{{ $placeholder }}">{{ $value }}</textarea> 
@error($name)
<p class='text-danger'>{{ $message  }}</p>
@enderror