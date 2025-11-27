@if($row->payment_type == App\Models\Subscription::MANUALLY)
<span class="badge bg-warning">{{__('messages.comment.pending')}}</span>
@endif
@if($row->payment_type == App\Models\Subscription::REJECTED)
    <span class="badge bg-danger">{{__('messages.common.rejected')}}</span>
@endif
@if (!$row->payment_type == App\Models\Subscription::MANUALLY || !$row->payment_type == App\Models\Subscription::REJECTED ||$row->payment_type == App\Models\Subscription::PAID)

@if($row->status == 1)
    <span class="badge bg-success">{{__('messages.common.active')}}</span>
@else
    <span class="badge bg-danger">{{ __('messages.common.closed') }}</span>
@endif
@endif
