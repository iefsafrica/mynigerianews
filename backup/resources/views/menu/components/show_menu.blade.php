{{-- <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex ms-5 cursor-pointer">
    <input class="form-check-input w-35px h-20px is-active cursor-pointer"
           wire:change="updateShowInMenu({{$row->show_in_menu}},{{$row->id}})" name="show_in_menu" type="checkbox"
           value="{{$row->show_in_menu}}"
        {{ (($row->show_in_menu)=="1") ? 'checked' : ''}} >
    <span class="custom-switch-indicator"></span>
</label> --}}
<label
    class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
    <input type="checkbox" name="show_in_menu" class="form-check-input is-active cursor-pointer"
        value="{{ $row->show_in_menu }}" wire:click="updateShowInMenu({{ $row['id'] }})"
        {{ $row->show_in_menu == '1' ? 'checked' : '' }}>
    <span class="custom-switch-indicator"></span>
</label>
