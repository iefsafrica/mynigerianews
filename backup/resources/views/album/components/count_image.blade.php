@php
        $images = [];
        foreach($row->gallery as $imaga){
            $images[] =  count($imaga->gallery_image);

        }
@endphp
    {{array_sum($images)}}