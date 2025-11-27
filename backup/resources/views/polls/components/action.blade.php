<div class="d-flex justify-content-start">
    <a href="{{route('polls.edit',$row['id'])}}" data-bs-toggle="tooltip"
       data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="{{ __('messages.common.edit') }}"
       class="btn px-0 text-primary fs-3 polls-edit-btn" data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <buuton type="button" data-id="{{$row->id}}" title="{{ __('messages.delete') }}"
       class="btn px-2 text-danger fs-3 delete-poll-btn" id="deleteUser" data-bs-toggle="tooltip">
        <i class="fa-solid fa-trash"></i>
    </button>
</div>