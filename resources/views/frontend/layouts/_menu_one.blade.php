
@foreach( newscategories() as $newscategory )
    @if($newscategory->menu_publish)
        <li>
            <a href="{{ route($newscategory->slug,strtolower($newscategory->name)) }}">{{ $newscategory->name  }} </a>
        </li>
    @endif
@endforeach
