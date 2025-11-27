<div class="bg-white header sticky w-full z-20 top-0 left-0">
    <nav>
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="flex flex-wrap justify-between items-center py-3">
                <a href="/" class="h-14 w-auto">
                    <img src="{{ $settings['logo'] }}" class="h-full w-14" loading="lazy" alt="logo-img" />
                </a>
                <div class="flex items-center">
                    <ul class="lg:flex hidden">
                        <li class="xl:px-5 px-1.5 py-2">
                            <a href="/"
                                class="text-black xl:text-sm text-xs text-center transition duration-200 ease-in-out font-semibold navigation-name {{ Request::is('/') ? 'active text-primary' : '' }}">{{ __('messages.home') }}</a>
                        </li>
                        @php
                            $nav = getNavigationDetails();
                        @endphp
                        @if ($nav['navigationsCount'] >= 0)
                            @foreach ($nav['navigations'] as $key => $navigation)
                                @if (
                                    $navigation['navigationable']['lang_id'] == getFrontSelectLanguage() ||
                                        $navigation->navigationable_type == \App\Models\Menu::class)
                                    @php
                                        $isSubNav = count($nav['navigationsTakeData'][$navigation->id]) > 0;
                                        $subNavLangs = $nav['navigationsTakeData'][$navigation->id];
                                        $menuName = $navigation->navigationable->name
                                            ? $navigation->navigationable->name
                                            : $navigation->navigationable->title;
                                        $urlTabName = ucwords(str_replace('-', ' ', Request::segment(2)));
                                        $langId = false;
                                        foreach ($subNavLangs as $subNavLang) {
                                            if ($langId) {
                                                continue;
                                            }
                                            if ($subNavLang['navigationable_type'] == \App\Models\SubCategory::class) {
                                                $langId = $subNavLang
                                                    ->navigationable()
                                                    ->where('lang_id', getFrontSelectLanguage())
                                                    ->exists();
                                            }
                                        }
                                    @endphp
                                    <div class="set relative group inline-flex xl:px-3 px-2 py-2">
                                        <a href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug]) }}"
                                            id={{ $menuName }}
                                            class="text-black xl:text-sm lg:text-xs text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center hover:text-primary navigation-name {{ $menuName == ucfirst(last(request()->segments())) || $urlTabName == $menuName ? 'text-primary active' : '' }}">
                                            {!! $navigation->navigationable->name ? $navigation->navigationable->name : $navigation->navigationable->title !!}
                                            @if (($langId || $navigation->navigationable_type == \App\Models\Menu::class) && $isSubNav)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="3 " stroke="currentColor"
                                                    class="w-4 h-3 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            @endif
                                        </a>
                                        @if ($langId || $navigation->navigationable_type == \App\Models\Menu::class)
                                            @if ($isSubNav)
                                                <div
                                                    class="origin-top-right absolute right-0 top-full w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                                    @php
                                                        $path = basename(Request::path());
                                                    @endphp
                                                    @foreach ($nav['navigationsTakeData'] as $key => $navSub)
                                                        @if ($key == $navigation->id)
                                                            @foreach ($navSub as $sub)
                                                                <li><a class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary {{ !empty($path) && $path == $sub->navigationable->slug ? 'text-primary' : '' }}"
                                                                        @if ($sub->navigationable->link !== null) href="{{ getNavUrl($sub->navigationable->link) }}"
                                                               @else
                                                                   href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug, 'slug' => $sub->navigationable->slug]) }}" @endif>
                                                                        {!! $sub->navigationable->name ? $sub->navigationable->name : $sub->navigationable->title !!}</a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <li class="xl:px-4 px-2 py-2">
                            <a href="{{ route('galleryPage') }}"
                                class="text-black xl:text-sm lg:text-xs text-sm  text-center transition duration-200 ease-in-out font-semibold hover:text-primary {{ Request::is('g') || Request::is('g/*') ? 'text-primary' : '' }}">Gallery</a>
                        </li>
                        @if ($nav['navigationsCount'] >= 6)
                            <li class="relative group inline-flex py-2.5">
                                <button href=""
                                    class="ms-2 text-black  xl:text-sm lg:text-xs text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center hover:text-primary {{ Request::is('page') || Request::is('page/*') ? 'text-primary  active' : '' }}">
                                    {{ __('messages.more') }}
                                    <span class="justify-content-end">
                                        <i class="fa-solid fa-angle-down fs-12 ms-2"></i>
                                    </span>
                                </button>

                                <div
                                    class="origin-top-right absolute right-0 top-full w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                    <ul class="dropdown-nav ps-0">
                                        @foreach ($nav['navigationsSkipData'] as $key => $navigation)
                                            @if (
                                                $navigation['navigationable']['lang_id'] == getFrontSelectLanguage() ||
                                                    $navigation->navigationable_type == \App\Models\Menu::class)
                                                @php
                                                    $isSubNav = count($nav['navigationsSkipItem'][$navigation->id]) > 0;
                                                    $subNavLangs = $nav['navigationsSkipItem'][$navigation->id];
                                                    $menuName = $navigation->navigationable->name
                                                        ? $navigation->navigationable->name
                                                        : $navigation->navigationable->title;
                                                    $urlTabName = ucwords(str_replace('-', ' ', Request::segment(2)));
                                                    $langId = false;
                                                    foreach ($subNavLangs as $subNavLang) {
                                                        if ($langId) {
                                                            continue;
                                                        }
                                                        if (
                                                            $subNavLang['navigationable_type'] ==
                                                            \App\Models\SubCategory::class
                                                        ) {
                                                            $langId = $subNavLang
                                                                ->navigationable()
                                                                ->where('lang_id', getFrontSelectLanguage())
                                                                ->exists();
                                                        }
                                                    }
                                                @endphp
                                                <li class="relative group2">
                                                    <div
                                                        class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary">
                                                        <a href="{{ $navigation->navigationable_type == \App\Models\Menu::class ? $navigation->navigationable->link : route('categoryPage', $navigation->navigationable->slug) }}"
                                                            class="fs-14 fw-6 d-flex justify-content-between navigation-name {{ $menuName == ucfirst(last(request()->segments())) || $urlTabName == $menuName ? 'text-primary active' : '' }}">
                                                            {!! $navigation->navigationable->name ? $navigation->navigationable->name : $navigation->navigationable->title !!}
                                                            @if (($langId || $navigation->navigationable_type == \App\Models\Menu::class) && $isSubNav)
                                                                <span class="justify-content-end">
                                                                    <i class="fa-solid fa-angle-right fs-12"></i>
                                                                </span>
                                                            @endif
                                                        </a>

                                                        @if ($langId || $navigation->navigationable_type == \App\Models\Menu::class)
                                                            @if ($isSubNav)
                                                                <ul
                                                                    class="origin-top-right absolute left-full top-0 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 sub-menu">
                                                                    @foreach ($nav['navigationsSkipItem'] as $key => $navSub)
                                                                        @if ($key == $navigation->id)
                                                                            @foreach ($navSub as $sub)
                                                                                @if ($sub->navigationable_type == \App\Models\SubCategory::class)
                                                                                    @if ($sub->navigationable()->where('lang_id', getFrontSelectLanguage())->exists())
                                                                                        <li class="">
                                                                                            <a class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary"
                                                                                                @if ($sub->navigationable->link !== null) href="{{ getNavUrl($sub->navigationable->link) }}"
                                                                                   @else
                                                                                       href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug, 'slug' => $sub->navigationable->slug]) }}" @endif>
                                                                                                {!! $sub->navigationable->name ? $sub->navigationable->name : $sub->navigationable->title !!}
                                                                                            </a>
                                                                                        </li>
                                                                                    @endif
                                                                                @else
                                                                                    <li>
                                                                                        <a class="fs-14 fw-6"
                                                                                            @if ($sub->navigationable->link !== null) href="{{ getNavUrl($sub->navigationable->link) }}"
                                                                               @else
                                                                                   href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug, 'slug' => $sub->navigationable->slug]) }}" @endif>{!! $sub->navigationable->name ? $sub->navigationable->name : $sub->navigationable->title !!}
                                                                                        </a>
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li class="">
                                            <a class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary {{ Request::is('contact') ? 'text-primary active' : '' }}"
                                                href="{{ route('contact.index') }}">{{ __('messages.details.contact_us') }}</a>
                                        </li>
                                        <li class="relative group2">
                                            @if ($nav['pages']->count() > 0)
                                                <a href=""
                                                    class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary {{ Request::is('page') || Request::is('page/*') ? 'text-primary  active' : '' }}">
                                                    {{ __('messages.pages') }}
                                                    <span class="justify-content-end">
                                                        <i class="fa-solid fa-angle-right fs-12"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            <div
                                                class="origin-top-right absolute left-full top-0 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 sub-menu">
                                                @foreach ($nav['pages'] as $page)
                                                    <a href="{{ route('pages.show-page-slug', $page->slug) }}"
                                                        class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary">
                                                        {!! $page->name !!}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if ($nav['navigationsCount'] <= 5)
                            <li class="py-1">
                                <a class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary {{ Request::is('contact') ? 'text-primary active' : '' }}"
                                    href="{{ route('contact.index') }}">{{ __('messages.details.contact_us') }}</a>
                            </li>
                            <li class="set relative group inline-flex xl:px-3 px-2 py-2">
                                @if ($nav['pages']->count() > 0)
                                    <button href=""
                                        class="text-black xl:text-sm lg:text-xs text-sm  text-center transition duration-200 ease-in-out font-semibold flex items-center hover:text-primary {{ Request::is('page') || Request::is('page/*') ? 'text-primary  active' : '' }}">
                                        {{ __('messages.pages') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="3 " stroke="currentColor" class="w-4 h-3 ml-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                @endif
                                @if ($nav['pages']->count() > 0)
                                    <div
                                        class="origin-top-right absolute left-0 top-full w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                        @foreach ($nav['pages'] as $page)
                                            <div class="py-2">
                                                <a href="{{ route('pages.show-page-slug', $page->slug) }}"
                                                    class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary">{!! $page->name !!}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endif
                    </ul>

                    <div class="relative xl:ml-10 ml-4 sm:block hidden">
                        <form action="{{ route('allPosts') }}" class="form search-form-box search-input">
                            <input type="text" name="search" id="search"
                                class="xl:w-full lg:w-32 w-full  py-2 pl-12 pr-4 border rounded-full text-gray-400 placeholder:text-gray-400 placeholder:text-xs text-sm  focus:outline-none focus-visible:ring-2 focus-visible:ring-primary"
                                placeholder={{ __('messages.search') }} />
                        </form>
                        <div class="absolute top-0 left-1 flex items-center h-full pl-3">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.7241 16.1932L13.6436 12.1127C14.626 10.8049 15.1563 9.21299 15.1546 7.57728C15.1546 3.39919 11.7554 0 7.57728 0C3.39919 0 0 3.39919 0 7.57728C0 11.7554 3.39919 15.1546 7.57728 15.1546C9.21299 15.1563 10.8049 14.626 12.1127 13.6436L16.1932 17.7241C16.3998 17.9088 16.6692 18.0073 16.9461 17.9996C17.2231 17.9918 17.4865 17.8783 17.6824 17.6824C17.8783 17.4865 17.9918 17.2231 17.9996 16.9461C18.0073 16.6692 17.9088 16.3998 17.7241 16.1932ZM2.16494 7.57728C2.16494 6.50682 2.48237 5.4604 3.07708 4.57034C3.6718 3.68029 4.51709 2.98657 5.50607 2.57693C6.49504 2.16728 7.58328 2.0601 8.63318 2.26893C9.68307 2.47777 10.6475 2.99325 11.4044 3.75018C12.1613 4.5071 12.6768 5.47149 12.8856 6.52138C13.0945 7.57128 12.9873 8.65952 12.5776 9.64849C12.168 10.6375 11.4743 11.4828 10.5842 12.0775C9.69416 12.6722 8.64774 12.9896 7.57728 12.9896C6.14237 12.9879 4.76672 12.4171 3.75208 11.4025C2.73744 10.3878 2.16666 9.01219 2.16494 7.57728Z"
                                    fill="#6B717E" />
                            </svg>
                        </div>
                    </div>
                    <div class="lg:hidden ml-4">
                        <div onclick="toggleSlideBar()" class="cursor-pointer text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </div>
                        <div id="slideBarContainer" class="w-full h-full fixed inset-0 invisible z-50">
                            <div onclick="toggleSlideBar()" id="slideBarBg"
                                class="w-full h-full duration-500 ease-out transition-all inset-0 absolute bg-gray-900 opacity-0">
                            </div>
                            <div id="slideBar"
                                class="w-80 bg-white h-full absolute right-0 duration-300 ease-out transition-all translate-x-full">
                                <div onclick="toggleSlideBar()"
                                    class="relative cursor-pointer text-gray-600 w-8 h-8 flex items-center justify-center ms-auto mt-3 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <ul class="flex flex-col">
                                    <li class="px-5 py-1">
                                        <a href="/"
                                            class="text-sm text-center transition duration-200 ease-in-out font-semibold {{ Request::is('/') ? 'active text-primary' : '' }}">{{ __('messages.home') }}</a>
                                    </li>
                                    @php
                                        $nav = getNavigationDetails();
                                    @endphp
                                    @if ($nav['navigationsCount'] >= 0)
                                        @foreach ($nav['navigations'] as $key => $navigation)
                                            @if (
                                                $navigation['navigationable']['lang_id'] == getFrontSelectLanguage() ||
                                                    $navigation->navigationable_type == \App\Models\Menu::class)
                                                @php
                                                    $isSubNav = count($nav['navigationsTakeData'][$navigation->id]) > 0;
                                                    $subNavLangs = $nav['navigationsTakeData'][$navigation->id];
                                                    $menuName = $navigation->navigationable->name
                                                        ? $navigation->navigationable->name
                                                        : $navigation->navigationable->title;
                                                    $langId = false;
                                                    foreach ($subNavLangs as $subNavLang) {
                                                        if ($langId) {
                                                            continue;
                                                        }
                                                        if (
                                                            $subNavLang['navigationable_type'] ==
                                                            \App\Models\SubCategory::class
                                                        ) {
                                                            $langId = $subNavLang
                                                                ->navigationable()
                                                                ->where('lang_id', getFrontSelectLanguage())
                                                                ->exists();
                                                        }
                                                    }
                                                @endphp
                                                <li class="px-5 py-1">
                                                    <div class="relative group inline-flex w-full">
                                                        <a href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug]) }}"
                                                            class="text-black text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center hover:text-primary navigation-name {{ $menuName == ucfirst(last(request()->segments())) ? 'text-primary' : '' }}">
                                                            {{ $navigation->navigationable->name ? $navigation->navigationable->name : $navigation->navigationable->title }}
                                                        </a>
                                                        @if (($langId || $navigation->navigationable_type == \App\Models\Menu::class) && $isSubNav)
                                                            <button type="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="3 "
                                                                    stroke="currentColor" class="w-4 h-3 ml-1">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                                </svg>
                                                            </button>
                                                        @endif

                                                        @if ($langId || $navigation->navigationable_type == \App\Models\Menu::class)
                                                            @if ($isSubNav)
                                                                <div
                                                                    class="z-10 origin-top-right absolute left-0 top-full w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                                                    @php
                                                                        $path = basename(Request::path());
                                                                    @endphp
                                                                    @foreach ($nav['navigationsTakeData'] as $key => $navSub)
                                                                        @if ($key == $navigation->id)
                                                                            @foreach ($navSub as $sub)
                                                                                @php
                                                                                    $isCurrent =
                                                                                        !empty($path) &&
                                                                                        $path ==
                                                                                            $sub->navigationable->slug;
                                                                                    $url =
                                                                                        $sub->navigationable->link !==
                                                                                        null
                                                                                            ? getNavUrl(
                                                                                                $sub->navigationable
                                                                                                    ->link,
                                                                                            )
                                                                                            : route('categoryPage', [
                                                                                                'category' =>
                                                                                                    $navigation
                                                                                                        ->navigationable
                                                                                                        ->slug,
                                                                                                'slug' =>
                                                                                                    $sub->navigationable
                                                                                                        ->slug,
                                                                                            ]);
                                                                                @endphp
                                                                                <div class="py-2">
                                                                                    <a class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary {{ $isCurrent ? 'text-primary' : '' }}"
                                                                                        href="{{ $url }}">
                                                                                        {{ $sub->navigationable->name ?: $sub->navigationable->title }}
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                    <li class="px-5 py-1">
                                        <a href="{{ route('galleryPage') }}"
                                            class="text-sm text-center transition duration-200 ease-in-out font-semibold {{ Request::is('g') || Request::is('g/*') ? 'text-primary' : '' }}">Gallery</a>
                                    </li>
                                    <li class="px-5 py-1">
                                        <a href="{{ route('contact.index') }}"
                                            class="text-sm text-center transition duration-200 ease-in-out font-semibold {{ Request::is('contact') ? 'active text-primary' : '' }}">{{ __('messages.details.contact_us') }}</a>
                                    </li>
                                    <li class="set relative group inline-flex px-5 py-1">
                                        @if ($nav['pages']->count() > 0)
                                            <button href=""
                                                class="text-black text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center hover:text-primary ">
                                                {{ __('messages.pages') }}
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="3 " stroke="currentColor"
                                                    class="w-4 h-3 ml-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        @endif
                                        @if ($nav['pages']->count() > 0)
                                            <div
                                                class="z-10 origin-top-right absolute left-0 top-full w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                                @foreach ($nav['pages'] as $page)
                                                    <div class="py-2">
                                                        <a href="{{ route('pages.show-page-slug', $page->slug) }}"
                                                            class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary">{!! $page->name !!}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                    <li class="set relative group inline-flex px-5 py-1">
                                        <button href=""
                                            class="text-black text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center hover:text-primary ">
                                            {{ __('messages.more') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="3 " stroke="currentColor"
                                                class="w-4 h-3 ml-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <div
                                            class="origin-top-right absolute left-0 top-full w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                            <ul class="dropdown-nav ps-0">
                                                @foreach ($nav['navigationsSkipData'] as $key => $navigation)
                                                    @if (
                                                        $navigation['navigationable']['lang_id'] == getFrontSelectLanguage() ||
                                                            $navigation->navigationable_type == \App\Models\Menu::class)
                                                        @php
                                                            $isSubNav =
                                                                count($nav['navigationsSkipItem'][$navigation->id]) > 0;
                                                            $subNavLangs = $nav['navigationsSkipItem'][$navigation->id];
                                                            $menuName = $navigation->navigationable->name
                                                                ? $navigation->navigationable->name
                                                                : $navigation->navigationable->title;
                                                            $urlTabName = ucwords(
                                                                str_replace('-', ' ', Request::segment(2)),
                                                            );
                                                            $langId = false;
                                                            foreach ($subNavLangs as $subNavLang) {
                                                                if ($langId) {
                                                                    continue;
                                                                }
                                                                if (
                                                                    $subNavLang['navigationable_type'] ==
                                                                    \App\Models\SubCategory::class
                                                                ) {
                                                                    $langId = $subNavLang
                                                                        ->navigationable()
                                                                        ->where('lang_id', getFrontSelectLanguage())
                                                                        ->exists();
                                                                }
                                                            }
                                                        @endphp
                                                        <li class="relative group2">
                                                            <div
                                                                class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary">
                                                                <a href="{{ $navigation->navigationable_type == \App\Models\Menu::class ? $navigation->navigationable->link : route('categoryPage', $navigation->navigationable->slug) }}"
                                                                    class="fs-14 fw-6 d-flex justify-content-between navigation-name {{ $menuName == ucfirst(last(request()->segments())) || $urlTabName == $menuName ? 'text-primary active' : '' }}">
                                                                    {!! $navigation->navigationable->name ? $navigation->navigationable->name : $navigation->navigationable->title !!}
                                                                    @if (($langId || $navigation->navigationable_type == \App\Models\Menu::class) && $isSubNav)
                                                                        <span class="justify-content-end">
                                                                            <i
                                                                                class="fa-solid fa-angle-right fs-12"></i>
                                                                        </span>
                                                                    @endif
                                                                </a>

                                                                @if ($langId || $navigation->navigationable_type == \App\Models\Menu::class)
                                                                    @if ($isSubNav)
                                                                        <ul
                                                                            class="z-10 origin-top-right absolute left-full top-0 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 sub-menu">
                                                                            @foreach ($nav['navigationsSkipItem'] as $key => $navSub)
                                                                                @if ($key == $navigation->id)
                                                                                    @foreach ($navSub as $sub)
                                                                                        @if ($sub->navigationable_type == \App\Models\SubCategory::class)
                                                                                            @if ($sub->navigationable()->where('lang_id', getFrontSelectLanguage())->exists())
                                                                                                <li class="">
                                                                                                    <a class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary"
                                                                                                        @if ($sub->navigationable->link !== null) href="{{ getNavUrl($sub->navigationable->link) }}"
                                                                                           @else
                                                                                               href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug, 'slug' => $sub->navigationable->slug]) }}" @endif>
                                                                                                        {!! $sub->navigationable->name ? $sub->navigationable->name : $sub->navigationable->title !!}
                                                                                                    </a>
                                                                                                </li>
                                                                                            @endif
                                                                                        @else
                                                                                            <li>
                                                                                                <a class="fs-14 fw-6"
                                                                                                    @if ($sub->navigationable->link !== null) href="{{ getNavUrl($sub->navigationable->link) }}"
                                                                                       @else
                                                                                           href="{{ route('categoryPage', ['category' => $navigation->navigationable->slug, 'slug' => $sub->navigationable->slug]) }}" @endif>{!! $sub->navigationable->name ? $sub->navigationable->name : $sub->navigationable->title !!}
                                                                                                </a>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="header-bg py-2.5">
        <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="flex justify-between flex-wrap items-center">
                <p class="text-black text-sm font-semibold mr-3">
                    {{ \Carbon\Carbon::now()->isoFormat('MMMM DD, YYYY') }}
                </p>
                <div class="xs:flex hidden justify-center items-center">
                    <a class="mx-2.5 group" href="{{ $settings['facebook_url'] }}" aria-label="social-media">
                        <svg class="fill-current text-black group-hover:text-blue-500" width="16" height="16"
                            viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16 8.02005C16 3.59298 12.416 0 8 0C3.584 0 0 3.59298 0 8.02005C0 11.9018 2.752 15.1338 6.4 15.8797V10.4261H4.8V8.02005H6.4V6.01504C6.4 4.46717 7.656 3.20802 9.2 3.20802H11.2V5.61404H9.6C9.16 5.61404 8.8 5.97494 8.8 6.41604V8.02005H11.2V10.4261H8.8V16C12.84 15.599 16 12.1825 16 8.02005Z" />
                        </svg>
                    </a>
                    <a class="mx-2.5 group" href="{{ $settings['twitter_url'] }}" aria-label="social-media">
                        <svg class="fill-current text-black group-hover:text-blue-500" width="17" height="14"
                            viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.6666 2.25348C16.0782 2.50293 15.4462 2.67148 14.7817 2.74766C15.4673 2.35514 15.9802 1.73737 16.2248 1.00961C15.5806 1.37569 14.8756 1.63336 14.1404 1.77144C13.646 1.26639 12.9912 0.931627 12.2775 0.819138C11.5639 0.706649 10.8314 0.822723 10.1938 1.14934C9.55617 1.47596 9.0491 1.99484 8.75129 2.62543C8.45349 3.25602 8.38162 3.96304 8.54683 4.63672C7.24158 4.57402 5.9647 4.24944 4.79905 3.68404C3.6334 3.11864 2.60503 2.32505 1.78069 1.35479C1.49883 1.81998 1.33676 2.35933 1.33676 2.93373C1.33644 3.45083 1.46954 3.96001 1.72423 4.41608C1.97893 4.87216 2.34735 5.26104 2.79681 5.54822C2.27556 5.53235 1.76581 5.3976 1.30998 5.15517V5.19562C1.30993 5.92087 1.57214 6.6238 2.05212 7.18514C2.53209 7.74647 3.20028 8.13165 3.94329 8.27529C3.45974 8.4005 2.95278 8.41894 2.46069 8.32923C2.67032 8.95326 3.07867 9.49896 3.62857 9.88992C4.17847 10.2809 4.84238 10.4975 5.52737 10.5095C4.36456 11.3829 2.9285 11.8566 1.45021 11.8545C1.18834 11.8546 0.926699 11.84 0.666626 11.8107C2.16718 12.7338 3.91394 13.2237 5.6979 13.2218C11.7368 13.2218 15.0382 8.43642 15.0382 4.28615C15.0382 4.15131 15.0346 4.01513 15.0283 3.88029C15.6704 3.43598 16.2247 2.8858 16.6652 2.2555L16.6666 2.25348Z" />
                        </svg>
                    </a>
                    <a class="mx-2.5 group" href="{{ $settings['linkedin_url'] }}" aria-label="social-media"><svg
                            class="fill-current text-black group-hover:text-blue-600" width="17" height="16"
                            viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.27657 5.5752H9.24777V7.0552C9.67577 6.204 10.7734 5.4392 12.4222 5.4392C15.583 5.4392 16.3334 7.1336 16.3334 10.2424V16H13.1334V10.9504C13.1334 9.18 12.7054 8.1816 11.6158 8.1816C10.1046 8.1816 9.47657 9.2576 9.47657 10.9496V16H6.27657V5.5752ZM0.789374 15.864H3.98937V5.4392H0.789374V15.864ZM4.44777 2.04C4.44789 2.30822 4.3947 2.57379 4.29128 2.82127C4.18787 3.06875 4.0363 3.29321 3.84537 3.4816C3.45849 3.8661 2.93482 4.08132 2.38937 4.08C1.84489 4.07963 1.32242 3.86496 0.934974 3.4824C0.744743 3.29337 0.593683 3.06866 0.490449 2.82115C0.387215 2.57363 0.333837 2.30818 0.333374 2.04C0.333374 1.4984 0.549374 0.98 0.935774 0.5976C1.32288 0.214527 1.84557 -0.000239369 2.39017 2.00212e-07C2.93577 2.00212e-07 3.45897 0.2152 3.84537 0.5976C4.23097 0.98 4.44777 1.4984 4.44777 2.04Z" />
                        </svg>
                    </a>
                    <a class="mx-2.5 group" href="{{ $settings['pinterest_url'] }}" aria-label="social-media"><svg
                            class="fill-current text-black group-hover:text-red-600" width="16" height="16"
                            viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.00509 1.61021e-06C6.13979 -0.00118135 4.3327 0.649478 2.8963 1.83948C1.45989 3.02947 0.484465 4.684 0.138677 6.51697C-0.207111 8.34994 0.0984782 10.2461 1.00261 11.8777C1.90673 13.5092 3.35256 14.7735 5.09009 15.452C5.02009 14.819 4.95609 13.846 5.11709 13.155C5.26309 12.53 6.05509 9.178 6.05509 9.178C6.05509 9.178 5.81609 8.699 5.81609 7.991C5.81609 6.878 6.46109 6.048 7.26409 6.048C7.94609 6.048 8.27609 6.56 8.27609 7.175C8.27609 7.861 7.83909 8.887 7.61309 9.838C7.42509 10.634 8.01309 11.284 8.79809 11.284C10.2201 11.284 11.3131 9.784 11.3131 7.62C11.3131 5.705 9.93609 4.366 7.97109 4.366C5.69509 4.366 4.35909 6.073 4.35909 7.837C4.35909 8.525 4.62409 9.262 4.95409 9.663C4.98251 9.69323 5.0026 9.73031 5.01242 9.77062C5.02223 9.81093 5.02143 9.85309 5.01009 9.893C4.94909 10.145 4.81409 10.689 4.78809 10.8C4.75309 10.946 4.67209 10.977 4.52009 10.907C3.52009 10.442 2.89609 8.981 2.89609 7.807C2.89609 5.284 4.73009 2.967 8.18209 2.967C10.9571 2.967 13.1141 4.944 13.1141 7.587C13.1141 10.344 11.3751 12.563 8.96309 12.563C8.15209 12.563 7.39009 12.142 7.12909 11.644L6.63109 13.546C6.45009 14.241 5.96209 15.112 5.63609 15.643C6.73606 15.9831 7.89648 16.0818 9.03809 15.9323C10.1797 15.7828 11.2756 15.3886 12.2509 14.7767C13.2262 14.1648 14.0579 13.3496 14.6892 12.3868C15.3206 11.424 15.7367 10.3362 15.9091 9.19787C16.0815 8.0595 16.0061 6.89733 15.6882 5.79075C15.3702 4.68418 14.8171 3.65927 14.0668 2.78604C13.3164 1.91281 12.3863 1.21184 11.3402 0.731016C10.294 0.250192 9.15644 0.000842303 8.00509 1.61021e-06Z" />
                        </svg>
                    </a>

                    <a class="mx-2.5 group" href="{{ $settings['instagram_url'] }}" aria-label="social-media"><svg
                            class="fill-current text-black group-hover:text-primary" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m16 12v-.001c0-2.209-1.791-4-4-4s-4 1.791-4 4 1.791 4 4 4c1.104 0 2.104-.448 2.828-1.171.723-.701 1.172-1.682 1.172-2.768 0-.021 0-.042-.001-.063v.003zm2.16 0c-.012 3.379-2.754 6.114-6.135 6.114-3.388 0-6.135-2.747-6.135-6.135s2.747-6.135 6.135-6.135c1.694 0 3.228.687 4.338 1.797 1.109 1.08 1.798 2.587 1.798 4.256 0 .036 0 .073-.001.109v-.005zm1.687-6.406v.002c0 .795-.645 1.44-1.44 1.44s-1.44-.645-1.44-1.44.645-1.44 1.44-1.44c.398 0 .758.161 1.018.422.256.251.415.601.415.988v.029-.001zm-7.84-3.44-1.195-.008q-1.086-.008-1.649 0t-1.508.047c-.585.02-1.14.078-1.683.17l.073-.01c-.425.07-.802.17-1.163.303l.043-.014c-1.044.425-1.857 1.237-2.272 2.254l-.01.027c-.119.318-.219.695-.284 1.083l-.005.037c-.082.469-.14 1.024-.159 1.589l-.001.021q-.039.946-.047 1.508t0 1.649.008 1.195-.008 1.195 0 1.649.047 1.508c.02.585.078 1.14.17 1.683l-.01-.073c.07.425.17.802.303 1.163l-.014-.043c.425 1.044 1.237 1.857 2.254 2.272l.027.01c.318.119.695.219 1.083.284l.037.005c.469.082 1.024.14 1.588.159l.021.001q.946.039 1.508.047t1.649 0l1.188-.024 1.195.008q1.086.008 1.649 0t1.508-.047c.585-.02 1.14-.078 1.683-.17l-.073.01c.425-.07.802-.17 1.163-.303l-.043.014c1.044-.425 1.857-1.237 2.272-2.254l.01-.027c.119-.318.219-.695.284-1.083l.005-.037c.082-.469.14-1.024.159-1.588l.001-.021q.039-.946.047-1.508t0-1.649-.008-1.195.008-1.195 0-1.649-.047-1.508c-.02-.585-.078-1.14-.17-1.683l.01.073c-.07-.425-.17-.802-.303-1.163l.014.043c-.425-1.044-1.237-1.857-2.254-2.272l-.027-.01c-.318-.119-.695-.219-1.083-.284l-.037-.005c-.469-.082-1.024-.14-1.588-.159l-.021-.001q-.946-.039-1.508-.047t-1.649 0zm11.993 9.846q0 3.578-.08 4.953c.005.101.009.219.009.337 0 3.667-2.973 6.64-6.64 6.64-.119 0-.237-.003-.354-.009l.016.001q-1.375.08-4.953.08t-4.953-.08c-.101.005-.219.009-.337.009-3.667 0-6.64-2.973-6.64-6.64 0-.119.003-.237.009-.354l-.001.016q-.08-1.375-.08-4.953t.08-4.953c-.005-.101-.009-.219-.009-.337 0-3.667 2.973-6.64 6.64-6.64.119 0 .237.003.354.009l-.016-.001q1.375-.08 4.953-.08t4.953.08c.101-.005.219-.009.337-.009 3.667 0 6.64 2.973 6.64 6.64 0 .119-.003.237-.009.354l.001-.016q.08 1.374.08 4.953z" />
                        </svg>
                    </a>
                </div>
                <div class="flex items-center">
                    <div>
                        <div class="relative group inline-flex py-2">
                            <button href="javascript:void(0)"
                                class="relative text-black text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center">
                                {{ getFrontSelectLanguageName() }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="3 " stroke="currentColor" class="w-4 h-3 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <div
                                class="origin-top-right absolute right-0 left-px top-full w-24 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block max-h-48 overflow-auto">
                                @foreach (getFrontLanguage() as $key => $language)
                                    <div class="py-1 languageSelection">
                                        <span data-prefix-value="ar"
                                            class="block cursor-pointer px-4 py-1 text-center text-black text-sm font-semibold hover:text-primary selectLanguage {{ getFrontSelectLanguageName() == $language ? 'active' : '' }}"
                                            data-id="{{ $key }}">{{ $language }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if (getLogInUser())
                        <div class="relative group inline-flex ms-8 py-1">
                            <button href=""
                                class="text-black text-sm text-center transition duration-200 ease-in-out font-semibold flex items-center">
                                {{ Str::limit(getLogInUser()->full_name, 20) }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="3 " stroke="currentColor" class="w-4 h-3 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <div
                                class="origin-top-right absolute right-0 top-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block w-32 z-20">
                                <div class="py-2">
                                    <div class="languageSelection">
                                        @if (Auth::user()->hasRole('customer'))
                                            <a href="{{ route('customer.dashboard') }}"
                                                class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary "
                                                data-turbo="false">{{ __('messages.details.admin_panel') }}</a>
                                        @endif
                                        @if (!Auth::user()->hasRole('customer'))
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary"
                                                data-turbo="false">{{ __('messages.details.admin_panel') }}</a>
                                        @endif
                                    </div>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="post">
                                        @csrf
                                    </form>
                                    <div class="languageSelection">
                                        <a href="{{ url('logout') }}"
                                            onclick="event.preventDefault();
                                    localStorage.clear();  document.getElementById('logout-form').submit();"
                                            class="block px-4 py-1.5 text-black text-sm font-semibold hover:text-primary">
                                            {{ __('messages.details.logout') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="ps-6">
                            <a href="{{ route('login') }}" class="text-primary text-sm font-semibold"
                                data-turbo="false">{{ __('messages.common.login') }}</a>
                            @if (getSettingValue()['registration_system'])
                                <span class="text-primary text-sm font-semibold xs:mx-1.5 px-1">|</span>
                                <a href="{{ route('register') }}" class="text-primary text-sm font-semibold"
                                    data-turbo="false">
                                    {{ __('auth.register') }} </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
