<div class="form-check form-switch form-check-custom form-check-solid mt-2 justify-content-start">
    <input class="form-check-input w-35px is-active cursor-pointer {{ auth()->user()->language == 'ar' ? 'float-end' : '' }}"
           wire:change="updateShowInMenu({{$row->show_in_menu}},{{$row->id}})" name="show_in_menu" type="checkbox"
           value="{{$row->show_in_menu}}"
        {{ (($row->show_in_menu)=="1") ? 'checked' : ''}} >
    <span class="custom-switch-indicator"></span>
</div>
