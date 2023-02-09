<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-3 mb-lg-4">
    <div class="container">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                @if(request()->routeIs($breadcrumb['routeName']))
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb['name'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a class="text-decoration-none"
                           href="{{ route($breadcrumb['routeName']) }}">{{ $breadcrumb['name'] }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
