@if ($row->frequency == 1)
<span class="badge bg-light-info">
    {{__('messages.plans.monthly')}}
</span>
@elseif ($row->frequency == 2)
<span class="badge bg-light-primary">
    {{__('messages.plans.yearly')}}
</span>
@elseif($row->frequency == 3)
<span class="badge bg-info me-2">
    {{__('messages.plans.unlimited')}}
</span>
@else
<span class="badge bg-light-info">
    {{__('messages.plans.monthly')}}
</span>
@endif