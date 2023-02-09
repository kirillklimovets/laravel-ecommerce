<ul class="navbar-nav">
    @foreach($items as $menuItem)
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs($menuItem->route) ? 'active' : '' }}"
               href="{{ $menuItem->link() }}">
                {{ $menuItem->title }}
            </a>
        </li>
    @endforeach
</ul>
