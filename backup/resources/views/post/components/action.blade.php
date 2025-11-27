
<div class="action-btn d-flex option align-items-center">
    <div class="btn-group dropstart">
        <button class="btn btn-light btn-sm dropdown-toggle hide-arrow" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('messages.common.select_an_option') }}
        </button>
        <ul class="dropdown-menu min-width-220" aria-labelledby="dropdownMenuButton1">
            <li>
                @if (Auth::user()->hasRole('customer'))
                    <a href="{{ route('customer-posts.edit', $row['id']) }}"
                        class="dropdown-item posts-edit-btn px-3 py-1 text-decoration-none">
                        {{ __('messages.common.edit') }}
                    </a>
                @endif
                @if (!Auth::user()->hasRole('customer'))
                    <a href="{{ route('posts.edit', $row['id']) }}"
                        class="dropdown-item posts-edit-btn px-3 py-1 text-decoration-none">
                        {{ __('messages.common.edit') }}
                    </a>
                @endif
            </li>
            <li>
                @if (!Auth::user()->hasRole('customer'))
                    <a href="{{ route('posts.show', $row['id']) }}"
                        class="dropdown-item px-3 py-1 text-decoration-none">
                        {{ __('messages.common.view') }}
                    </a>
                @endif
                @if (Auth::user()->hasRole('customer'))
                    <a href="{{ route('customer-posts.show', $row['id']) }}"
                        class="dropdown-item px-3 py-1 text-decoration-none">
                        {{ __('messages.common.view') }}
                    </a>
                @endif
            </li>

            @if (!$row->status)
                <li>
                    <a href="javascript:void(0)" class="dropdown-item px-3 py-1 text-decoration-none"
                        wire:click.prevent="publishPost({{ $row['id'] }})">
                        {{ __('messages.post.publish_post') }}
                    </a>
                </li>
            @endif
            <li>
                <a href="javascript:void(0)" class="dropdown-item px-3 py-1 update-breaking text-decoration-none"
                    data-id="{{ $row['id'] }}">
                    @if ($row->breaking)
                        {{ __('messages.post.remove_to_breaking') }}
                    @else
                        {{ __('messages.post.add_to_breaking') }}
                    @endif
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="dropdown-item px-3 py-1 updateSlider text-decoration-none"
                    data-id="{{ $row['id'] }}">
                    @if ($row->slider)
                        {{ __('messages.post.remove_to_slider') }}
                    @else
                        {{ __('messages.post.add_to_slider') }}
                    @endif
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="dropdown-item px-3 py-1 updateRecommended text-decoration-none"
                    data-id="{{ $row['id'] }}">
                    @if ($row->recommended)
                        {{ __('messages.post.remove_to_recommended') }}
                    @else
                        {{ __('messages.post.add_to_recommended') }}
                    @endif
                </a>
            </li>
        </ul>
    </div>
    <a href="javascript:void(0)" data-id="{{ $row['id'] }}" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-trigger="hover" data-bs-original-title="{{ __('messages.delete') }}"
        class="btn px-2 text-danger fs-3 delete-posts-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
