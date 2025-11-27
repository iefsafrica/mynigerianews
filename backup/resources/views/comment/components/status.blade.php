<div class="form-check form-switch form-check-custom form-check-solid mt-2 cursor-pointer">
    <input class="form-check-input w-35px h-20px is-active  cursor-pointer {{ auth()->user()->language == 'ar' ? 'float-end' : '' }}" data-bs-toggle="tooltip"
           data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{__('messages.common.edit') }}"
           wire:change="updateStatus({{$row->status}},{{$row->id}})" name="status" type="checkbox"
           value="{{$row->status}}"
        {{ (($row->status)=="1") ? 'checked' : ''}} >
    <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
</div>
