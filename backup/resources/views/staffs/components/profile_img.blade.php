<div class="d-flex align-items-center">
    <div class="me-5">
        <img src="{{ $row->profile_image }}" alt="" width="50" height="50" class="rounded-circle object-cover">
    </div>
    <div class="d-flex justify-content-start flex-column">
        <span class="text-muted fw-bold text-muted d-block fs-7">{!! $row->first_name !!} {!! $row->last_name !!}</span>
        <span class="text-muted text-muted d-block fs-7">{{ $row->email }} </span>
    </div>
</div>