<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
    <input type="checkbox" name="status" class="form-check-input  cursor-pointer" value="{{$row->front_language_status}}" 
    wire:click="updateLanguageStatus({{$row['id']}})" {{ (($row->front_language_status)=="1") ? 'checked' : ''}}>
    <span class="custom-switch-indicator"></span>
</label>