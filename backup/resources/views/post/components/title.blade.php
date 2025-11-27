@php
    $image = $row->post_types == \App\Models\Post::VIDEO_TYPE_ACTIVE ? (!empty($row->postVideo->thumbnail_image_url) ? $row->postVideo->thumbnail_image_url : $row->postVideo->uploaded_thumb ?? '') : $row->post_image;
@endphp
<div class="d-flex align-items-center">
    <div class=" position-relative overflow-hidden width-custom">
        <a href="{{ $image }}" data-lightbox="image-{{$row->id}}">
            <img src="{{ $image }}" class="float-start  width-custom">
            @if($row->status == 0)
                <span class="badge badge-tag bg-warning position-absolute">{{__('messages.post.draft_post')}}</span>
            @endif
        </a>
    </div>
    <div class="d-flex flex-column align-items-start">
        <a href="{{ route('detailPage', $row->slug) }}"
            class="mb-0 ps-2 lh-15 text-decoration-none {{ $row->status != 0 ? '' : 'pe-none' }} {{ $row->visibility != 0 ? '' : 'pe-none' }}"
            target="_blank"> {!! $row->title !!} </a>
        <div>
            <span class="badge bg-light-primary   fs-7 m-1 ">
                {!! $row->type_name !!}
            </span>
            <span class="badge bg-light-primary  fs-7 m-1 ">
                {!! $row->category->name !!}
            </span>
            <span class="badge bg-light-primary  fs-7 m-1 ">
                <i class="fa-solid fa-language"></i>
                {!! $row->language->name !!}
            </span>
            <span class="badge bg-light-primary  fs-7 m-1 ">
                <i class="fa-solid fa-eye fs-12 text-gray me-1"></i>
                {{ getPostViewCount($row->id) }}
            </span>
        </div>
    </div>
</div>
