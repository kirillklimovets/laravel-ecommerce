<ul class="navbar-nav ms-auto">
    @guest
        <li class="nav-item">
            <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                Регистрация
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('login') }}"
               class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                Войти
            </a>
        </li>
    @else
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="nav-link bg-transparent border-0" type="submit">Выйти</button>
            </form>
        </li>
    @endguest

    <li class="nav-item">
        <a href="{{ route('cart.index') }}"
           class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">
            Корзина
            @if(Cart::instance('default')->count())
                <span class="badge rounded-pill {{ $cartBadge ?? 'bg-warning' }} text-dark">
                        {{ Cart::instance('default')->count() }}
                    </span>
            @endif
        </a>
    </li>
</ul>
