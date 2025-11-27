@if($row->name !='customer')
<div class="justify-content-center d-flex ">

    <a href="{{ route('roles.edit', $row->id) }}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.common.edit') }}"
       class="btn px-1 text-primary fs-3 {{ auth()->user()->language == 'ar' ? 'pe-3' : 'ps-3' }} role-edit-btn"  data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.delete') }}"
       class="btn px-1 text-danger fs-3 delete-btn {{ auth()->user()->language == 'ar' ? 'ps-5' : 'pe-5' }}" >
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
@endif
