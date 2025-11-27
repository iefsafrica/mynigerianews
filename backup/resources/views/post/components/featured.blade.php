<label
    class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
    <input type="checkbox" name="status" class="form-check-input updateFeatured cursor-pointer" value="{{ $row->featured }}"
    data-id="{{ $row['id'] }}" {{ $row->featured == '1' ? 'checked' : '' }}>
    <span class="custom-switch-indicator"></span>
</label>
