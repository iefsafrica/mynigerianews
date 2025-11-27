<div class="form-check form-switch mt-2 justify-content-end cursor-pointer">
    <input class="form-check-input w-35px h-20px is-active cursor-pointer {{ auth()->user()->language == 'ar' ? 'float-end' : '' }}"
           wire:change="updateShowInMenu({{$row->show_in_menu}},{{$row->id}})" name="show_in_menu" type="checkbox"
           value="{{$row->show_in_menu}}"
        {{ (($row->show_in_menu)=="1") ? 'checked' : ''}} >
    <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
</div>
