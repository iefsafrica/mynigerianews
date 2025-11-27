<label
    class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
    <input type="checkbox" name="status" class="form-check-input post-visibility post-visibility-status cursor-pointer"
        value="{{ $row->visibility }}" data-id="{{ $row['id'] }}"
        {{ $row->visibility == '1' ? 'checked' : '' }}>
    <span class="custom-switch-indicator"></span>
</label>
