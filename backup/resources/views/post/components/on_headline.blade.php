<label
    class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
    <input type="checkbox" name="status" class="form-check-input updateHeadline cursor-pointer" value="{{ $row->show_on_headline }}"
    data-id="{{ $row['id'] }}" {{ $row->show_on_headline == '1' ? 'checked' : '' }}>
    <span class="custom-switch-indicator"></span>
</label>
