
@php
    $menuCategories = collect(newscategories())->filter(function ($category) {
        return $category->menu_publish && strtolower(trim($category->name)) !== 'investigation';
    });
@endphp
@foreach($menuCategories as $newscategory)
    <li>
        <a href="{{ route($newscategory->slug,strtolower($newscategory->name)) }}">{{ $newscategory->name  }} </a>
    </li>
@endforeach
