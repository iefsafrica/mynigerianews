<div class="d-flex align-items-start">
    <a href="javascript:void(0)" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{__('messages.common.edit') }}" data-id="{{ $row->id }}"
       class="edit-sub-category-btn btn px-1 text-primary fs-3">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{__('messages.delete')}}" data-id="{{ $row->id }}"
       class="delete-sub-category-btn btn px-1 text-danger fs-3" wire:key="{{$row->id}}">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
