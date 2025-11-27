@aware(['component', 'tableName'])
<div class="mb-3 mb-sm-0">
    <form class="d-flex position-relative">
        <div class="position-relative d-flex width-320">
          <span
                  class="position-absolute d-flex align-items-center top-0 bottom-0 left-0 text-gray-600  {{ auth()->user()->language == 'ar' ? 'me-3' : 'ms-3' }}">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
            <input class="form-control search-box {{ auth()->user()->language == 'ar' ? 'pe-8' : 'ps-8' }} " wire:model{{ $component->getSearchOptions() }}="search" type="search" placeholder="{{__('Search')}}" aria-label="Search">
        </div>
    </form>
    @if (isset($filters['search']) && strlen($filters['search']))
    @endif
</div>
