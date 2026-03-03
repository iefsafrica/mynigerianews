
@php
    $menuCategories = collect(newscategories())->filter(function ($category) {
        return $category->menu_publish && strtolower(trim($category->name)) !== 'investigation';
    })->values();
@endphp
@foreach($menuCategories as $newscategory)
    @if ($loop->iteration==7)
        <li class="dropdown"><a href="#">{{__('More')}}</a>
            <ul class="dropdown-menu">
                @endif
                <li>
                    <a href="{{ route($newscategory->slug,strtolower($newscategory->name)) }}">{{ $newscategory->name  }} </a>
                </li>
                @if ($loop->last)
            </ul>
        </li>
    @endif
@endforeach
