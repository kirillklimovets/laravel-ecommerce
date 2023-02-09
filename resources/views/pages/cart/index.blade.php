@extends('layouts.main', [
    'title' => 'Корзина',
    'breadcrumbs' => [
        ['name' => 'Главная', 'routeName' => 'landing.index'],
        ['name' => 'Каталог', 'routeName' => 'shop.index'],
        ['name' => 'Корзина', 'routeName' => 'cart.index'],
    ]
])

@section('pageHeadExtensions')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection

@section('content')
    <x-page-title title="Корзина" id="cartSectionStart"></x-page-title>

    <div class="row mb-4 mb-md-5">
        <div class="col-12 col-md-10">
            <div id="errorContainer">
                @include('partials.common.alerts')
            </div>

            @if(Cart::count())
                <x-cart-table cart-instance-name="default" title="Ваш заказ"></x-cart-table>

                @if(Cart::instance('favorites')->count())
                    <x-favorites-table cart-instance-name="favorites" title="Избранное"></x-favorites-table>
                @else
                    <p class="text-center text-muted fs-4">Тут будут товары, которые вы добавили в избранное</p>
                @endif
            @else
                @if(Cart::instance('favorites')->count())
                    <div class="row mb-4">
                        <div
                            class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-light px-4 px-md-5 py-3">
                            <h3 class="fw-normal">Корзина пуста :(</h3>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary animate__animated"
                               data-animation="animate__pulse">Продолжить покупки</a>
                        </div>
                    </div>

                    <x-favorites-table cart-instance-name="favorites" title="Избранное"></x-favorites-table>
                @else
                    <div class="row">
                        <div class="col-12 bg-light py-4 py-md-5 px-4 px-md-5">
                            <h3 class="mb-3 mb-md-5">Корзина пуста :(</h3>
                            <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg animate__animated"
                               data-animation="animate__pulse">Продолжить покупки</a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <template id="errorAlert">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span id="alertMessage"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    </template>
@endsection

@section('pageEndingExtensions')
    <script type="text/javascript">
        (function () {
            initializeQuantityChangeHandler({
                cartRoute: '{{ route('cart.index') }}'
            })
        })()
    </script>
@endsection
