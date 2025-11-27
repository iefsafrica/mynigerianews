 <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
        <input type="checkbox" name="status" class="form-check-input user-active cursor-pointer"
               wire:change="emailVerified({{$row->id}})"
               value="{{$row->email_verified_at}}" {{ (($row->email_verified_at)!=null) ? 'checked' : ''}} {{(($row->email_verified_at) != null) ? 'disabled' : ''}}>

        <span class="custom-switch-indicator"></span>
    </label>