@include('partials.common.head')

@include('partials.common.navbar', [
    'navbarStyle'    => 'navbar-dark',
    'navbarBg'       => 'bg-transparent',
    'navbarPosition' => 'position-absolute fixed-top',
    'cartBadge'      => 'bg-light opacity-75'
])

<section class="mb-5">
    <div class="diagonal-box"></div>
    <div class="position-relative d-flex flex-column justify-content-center vh-100 text-white overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 mx-md-auto">
                    @yield('heroSection')
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container col-xxl-8 px-3 pt-4 pb-5 pt-md-5 text-center">
        @yield('offersSection')
    </div>
</section>

<section class="bg-light">
    <div class="container col-xxl-8 px-3 py-4 py-md-5">
        @yield('blogSection')
    </div>
</section>

@include('partials.common.pageEnding')
@include('partials.common.footer')
