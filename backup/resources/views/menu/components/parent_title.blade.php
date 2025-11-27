@if($row->parent != null)
{!! $row->parent->title !!}
@else
<p>{{ __('messages.menu.n_a') }}</p>
@endif