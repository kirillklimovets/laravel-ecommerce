<ul class="nav justify-content-center border-bottom pb-3 mb-3">
    @foreach($items as $menuItem)
        <li class="nav-item">
            <a href="{{ $menuItem->link() }}" class="nav-link px-2 text-muted">{{ $menuItem->title }}</a>
        </li>
    @endforeach
</ul>
