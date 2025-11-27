<div class="justify-content-start d-flex">
    <a href="{{route('menus.edit',$row['id'])}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.common.edit') }}"
       class="btn px-1 text-primary fs-3 menus-edit-btn" data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{$row['id']}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.delete') }}"
       class="btn px-1 text-danger fs-3 delete-menu-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>