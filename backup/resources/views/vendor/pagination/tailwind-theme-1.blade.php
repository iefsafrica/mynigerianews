<div>
    @php
        $maxPagesToShow = 10; // Set the maximum number of pages to show without ellipsis
    @endphp

    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
            <div class="flex items-center justify-between border-t">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <div class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link fs-14" aria-hidden="true">
                            <svg class="xs:w-10 w-8 xs:h-10 h-8" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="19.5" fill="#F6F6F6" stroke="#DDE0E5"></circle>
                                <path
                                    d="M22.6941 13.3302C22.89 13.5416 23 13.8284 23 14.1275C23 14.4265 22.89 14.7133 22.6941 14.9247L17.5221 20.5068L22.6941 26.0889C22.8844 26.3016 22.9897 26.5864 22.9873 26.8821C22.985 27.1778 22.8751 27.4606 22.6814 27.6697C22.4876 27.8788 22.2256 27.9974 21.9516 28C21.6777 28.0025 21.4137 27.8889 21.2167 27.6834L15.3059 21.3041C15.11 21.0926 15 20.8058 15 20.5068C15 20.2078 15.11 19.921 15.3059 19.7095L21.2167 13.3302C21.4126 13.1188 21.6783 13 21.9554 13C22.2324 13 22.4981 13.1188 22.6941 13.3302Z"
                                    fill="#181D27"></path>
                            </svg>
                        </span>
                    </div>
                @else
                    <div class="page-item">
                        <button type="button"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="page-link fs-14" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            wire:target="previousPage('{{ $paginator->getPageName() }}')">
                            <svg class="xs:w-10 w-8 xs:h-10 h-8" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="19.5" fill="#F6F6F6" stroke="#DDE0E5"></circle>
                                <path
                                    d="M22.6941 13.3302C22.89 13.5416 23 13.8284 23 14.1275C23 14.4265 22.89 14.7133 22.6941 14.9247L17.5221 20.5068L22.6941 26.0889C22.8844 26.3016 22.9897 26.5864 22.9873 26.8821C22.985 27.1778 22.8751 27.4606 22.6814 27.6697C22.4876 27.8788 22.2256 27.9974 21.9516 28C21.6777 28.0025 21.4137 27.8889 21.2167 27.6834L15.3059 21.3041C15.11 21.0926 15 20.8058 15 20.5068C15 20.2078 15.11 19.921 15.3059 19.7095L21.2167 13.3302C21.4126 13.1188 21.6783 13 21.9554 13C22.2324 13 22.4981 13.1188 22.6941 13.3302Z"
                                    fill="#181D27"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="flex justify-between">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <div id="pageButtons" class="flex xs:space-x-2 px-3 page-item hidden page-link"
                                aria-disabled="true">{{ $element }}</div>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <div id="pageButtons"
                                        class="bg-gray-100 flex page-item xs:space-x-2 px-3 py-4 text-black font-medium border-t border-t-2 border-t-transparent xs:text-base text-s !border-t-primary text-primary"
                                        wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                        aria-current="page">{{ $page }}</div>
                                @elseif (
                                    $paginator->lastPage() <= $maxPagesToShow ||
                                        ($page == 1 ||
                                            $page == $paginator->lastPage() ||
                                            $page == $paginator->currentPage() - 1 ||
                                            $page == $paginator->currentPage() + 1 ||
                                            ($page == $paginator->currentPage() - 2 && $paginator->currentPage() > 3) ||
                                            ($page == $paginator->currentPage() + 2 && $paginator->lastPage() - $paginator->currentPage() > 2)))
                                    <div class="page-item"
                                        wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                        <button type="button"
                                            class="page-link fs-14 page-item px-3 py-4 text-black font-medium border-t border-t-2 border-t-transparent xs:text-base text-sm"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            wire:loading.attr="disabled"
                                            wire:target="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                                    </div>
                                @elseif (
                                    ($page == $paginator->currentPage() - 3 && $paginator->currentPage() > 4) ||
                                        ($page == $paginator->currentPage() + 3 && $paginator->lastPage() - $paginator->currentPage() > 3))
                                    <span class="page-link fs-14 px-3 py-4">...</span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <div class="page-item">
                        <button type="button"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="page-link fs-14" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            wire:target="nextPage('{{ $paginator->getPageName() }}')">
                            <svg class="xs:w-10 w-8 xs:h-10 h-8" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="19.5" transform="rotate(-180 20 20)"
                                    fill="#F6F6F6" stroke="#DDE0E5"></circle>
                                <path
                                    d="M17.3059 27.6698C17.11 27.4584 17 27.1716 17 26.8725C17 26.5735 17.11 26.2867 17.3059 26.0753L22.4779 20.4932L17.3059 14.9111C17.1156 14.6984 17.0103 14.4136 17.0127 14.1179C17.015 13.8222 17.1249 13.5394 17.3186 13.3303C17.5124 13.1212 17.7744 13.0026 18.0484 13C18.3223 12.9975 18.5863 13.1111 18.7833 13.3166L24.6941 19.6959C24.89 19.9074 25 20.1942 25 20.4932C25 20.7922 24.89 21.079 24.6941 21.2905L18.7833 27.6698C18.5874 27.8812 18.3217 28 18.0446 28C17.7676 28 17.5019 27.8812 17.3059 27.6698Z"
                                    fill="#181D27"></path>
                            </svg>
                        </button>
                    </div>
                @else
                    <div class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link fs-14" aria-hidden="true">
                            <svg class="xs:w-10 w-8 xs:h-10 h-8" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="19.5" transform="rotate(-180 20 20)"
                                    fill="#F6F6F6" stroke="#DDE0E5"></circle>
                                <path
                                    d="M17.3059 27.6698C17.11 27.4584 17 27.1716 17 26.8725C17 26.5735 17.11 26.2867 17.3059 26.0753L22.4779 20.4932L17.3059 14.9111C17.1156 14.6984 17.0103 14.4136 17.0127 14.1179C17.015 13.8222 17.1249 13.5394 17.3186 13.3303C17.5124 13.1212 17.7744 13.0026 18.0484 13C18.3223 12.9975 18.5863 13.1111 18.7833 13.3166L24.6941 19.6959C24.89 19.9074 25 20.1942 25 20.4932C25 20.7922 24.89 21.079 24.6941 21.2905L18.7833 27.6698C18.5874 27.8812 18.3217 28 18.0446 28C17.7676 28 17.5019 27.8812 17.3059 27.6698Z"
                                    fill="#181D27"></path>
                            </svg>
                        </span>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
