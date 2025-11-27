<div class="d-flex align-items-start">
    <a href="{{route('gallery-images.edit',$row['id'])}}" 
       class="btn px-1 text-primary fs-3 gallery-images-edit-btn" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.common.edit') }}" data-id="{{$row['id']}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row['id']}}" title="{{ __('messages.delete') }}"
       data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}"
       class="btn px-1 text-danger fs-3 delete-gallery-image-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>