@foreach($row->permissions as $permissions)
<span class="badge bg-{{ getRandomColor($loop->index) }}  fs-7 m-1">{!! $permissions->display_name !!}</span>
@endforeach