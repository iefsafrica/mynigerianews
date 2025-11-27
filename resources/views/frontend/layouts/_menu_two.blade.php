
@foreach( newscategories() as $newscategory )
    @if ($loop->iteration==6)
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
