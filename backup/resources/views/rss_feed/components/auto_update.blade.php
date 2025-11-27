<span class="badge {{App\Models\RssFeed::YES == $row->auto_update ?  'bg-success' : 'bg-danger'}}  fs-7 m-1">
    {{App\Models\RssFeed::AUTO_UPDATE[$row->auto_update]}}
</span>
<div>
    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="
{{__('messages.sync')}}"
       class="btn btn-primary px-2 py-1  rss-feed-manually-update" data-id="{{$row->id}}">
        <i class="fa-solid fa-repeat"></i> {{__('messages.sync')}}
    </a>
</div>