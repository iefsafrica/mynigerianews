@foreach($row->gallery_image as $image)
        <a href="{{$image}}" data-lightbox="image-{{$row->id}}" class="text-decoration-none">
            <img src='{{ $image }}' width="50px" height="50px"  class="p-2 custom-object-fit">
        </a>
@endforeach