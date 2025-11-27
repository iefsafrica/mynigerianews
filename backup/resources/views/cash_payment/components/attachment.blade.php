@if($row->attachment)
        <a href="{{ url('admin/download-attachment'.'/' .$row->id) }}" target="_blank" class="text-decoration-none">{{__('messages.download') }}</a>
    @else
        N/A
    @endif
