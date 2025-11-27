<div class="" wire:ignore>
    <div class="dropdown d-flex align-items-center me-4 me-md-2">
        <button class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0" type="button"
            id="draftPostFilterBtn"data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            <p class="text-center">
                <i class='fas fa-filter'></i>
            </p>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="draftPostFilterBtn">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">{{ __('messages.common.filter_options') }}</h3>
            </div>
            <div class="p-5">
                <div class="mb-5">
                    <label for="filterBtn" class="form-label">{{ __('messages.post.posts') }}:</label>
                    {{ Form::select('post',collect($filterHeads[0])->sortBy('key')->toArray(),null,['class' => 'form-select io-select2', 'data-control' => 'select2', 'id' => 'draftPost']) }}
                </div>
                <div class="mb-5">
                    <label for="filterBtn" class="form-label">{{ __('messages.details.views') }}:</label>
                    {{ Form::select('views',collect($filterHeads[1])->sortBy('key')->toArray(),null,['class' => 'form-select io-select2 abc', 'data-control' => 'select2', 'id' => 'postView']) }}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary"
                        id="draftPost-ResetFilter">{{ __('messages.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
