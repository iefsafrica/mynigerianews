<div class="d-flex align-items-center ">
          <a href="#" wire:click.prevent="exportSelected" wire:key="bulk-action-exportSelected" class="btn btn-primary {{ auth()->user()->language == 'ar' ? 'ms-2' : 'me-2' }} mx-auto">{{__('messages.export')}}</a>
          <a href="#" wire:click.prevent="bulkMail" wire:key="bulk-action-bulkMail" class="btn btn-primary w-100">
                  {{__('messages.send_mail')}}
            </a>
</div>
