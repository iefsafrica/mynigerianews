<div class="form-check form-switch mt-2 justify-content-start">
    <input class="form-check-input w-35px cursor-pointer is-active {{ auth()->user()->language == 'ar' ? 'float-end' : '' }}"
           wire:change="updateShowInHome({{$row->show_in_home_page}},{{$row->id}})" name="show_in_home_page"
           type="checkbox" value="{{$row->show_in_home_page}}"
        {{ (($row->show_in_home_page)=="1") ? 'checked' : ''}} >
    <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
</div>
