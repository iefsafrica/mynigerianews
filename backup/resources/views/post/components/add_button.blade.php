<div class="">
         <a href="{{ Auth::user()->hasRole('customer') ? route('customer.post_type', ['section' => 'post_format']) : route('post_type', ['section' => 'post_format']) }}"
                  type="button" class="btn btn-primary mx-1">
                  {{ __('messages.post.add_post') }}
         </a>
         <a href="#" type="button" class="btn btn-danger delete-post-btn d-none ">
                  {{ __('messages.post.add_post') }}
         </a>
         <button wire:click="deleteSelected" class="btn btn-primary">{{__('messages.delete') }}</button>
</div>
