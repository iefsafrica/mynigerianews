<div class="d-flex justify-content-start">
    @if(($row->email_verified_at) == null)
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           data-bs-placement="top" data-bs-trigger="hover"
           data-bs-original-title="{{__('messages.common.send_email')}}"
           class="btn px-0 text-primary px-2 fs-3 resend-email-staff-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-envelope"></i>
        </a>
    @endif
    <a href="{{route('staff.edit',$row['id'])}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{__('messages.common.edit')}}"
       class="btn px-0 text-primary px-2 fs-3" data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{$row['id']}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.delete') }}"
       class="btn px-2 text-danger px-2 fs-3 delete-staff-btn">
        <i class="fa-solid fa-trash"></i>
    </a>

     {{-- <button type="button" title="{{__('messages.common.delete')}}" data-id="{{ $row->id }}"
        class="delete-staff-btn  btn px-2 text-danger fs-3 pe-0" id="deleteUser" data-bs-toggle="tooltip">
    <i class="fa-solid fa-trash"></i>
</button> --}}
</div>
