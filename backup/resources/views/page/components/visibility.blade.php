@php
$checked = $row->visibility === 0 ? '' : 'checked';
@endphp
<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm mt-2">
<input type="checkbox" name="visibility" class="form-check-input visibility {{ auth()->user()->language == 'ar' ? 'float-end' : '' }}"
       data-id="{{$row->id}}" {{$checked}} >
<span class="custom-switch-indicator"></span>
</label>
