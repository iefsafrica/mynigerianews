@if ($row->payment_type == App\Models\Subscription::MANUALLY)
    <div class="dropdown">
        <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
           data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('messages.common.pending') }}
        </a>
        <ul class="dropdown-menu withdraw-approval-dropdown" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#" data-id="{{ $row->id }}" id="approvedPayment">{{ __('messages.common.approved') }}</a>
            </li>
            <li><a class="dropdown-item" href="#" data-id="{{ $row->id }}"
                   id="rejectedPayment">{{ __('messages.common.rejected') }}</a>
            </li>
        </ul>
    </div>
    @elseif($row->payment_type == App\Models\Subscription::REJECTED)
        <a class="text-danger bg-light-danger badge text-decoration-none"> ">{{ __('messages.common.rejected') }}</a>

    @else
        <span class="badge bg-light-success">{{ __('messages.common.received') }}</span>
    @endif
