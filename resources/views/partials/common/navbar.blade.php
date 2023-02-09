<nav
    class="user-select-none navbar navbar-expand-lg {{ $navbarStyle ?? 'navbar-light'  }} {{ $navbarBg ?? 'bg-light' }} mb-3 mb-lg-3 pt-lg-3 fs-5 {{$navbarPosition ?? ''}}">
    <div class="container">

        <a class="navbar-brand px-3 py-2"
           href="{{ route('landing.index') }}">
            {{ config('app.name', 'Laravel E-Commerce') }}
        </a>
        <button class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-end text-lg-start" id="navbarSupportedContent">
            <div>
                {{ menu('main', 'partials.common.menus.main-left') }}
            </div>

            <div class="ms-auto">
                @include('partials.common.menus.main-right', ['cartBadge' => $cartBadge ?? null])
            </div>
        </div>
    </div>
</nav>
