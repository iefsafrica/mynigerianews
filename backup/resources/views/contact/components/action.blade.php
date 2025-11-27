<div class="d-flex">
    <a href="javascript:void(0)" data-id="{{$row['id']}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.page.show') }}"
       class="btn px-1 text-primary fs-3 view-contact-btn">
        <i class="fa-solid fa-eye"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{$row['id']}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.delete') }}"
       class="btn px-1 text-danger fs-3 delete-contact-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>