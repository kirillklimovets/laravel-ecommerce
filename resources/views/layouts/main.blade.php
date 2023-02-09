@include('partials.common.head')
@include('partials.common.navbar')

@isset($breadcrumbs)
    @include('partials.common.breadcrumbs')
@endisset

<main class="container">
    @yield('content')
</main>

@include('partials.common.pageEnding')
@include('partials.common.footer')
