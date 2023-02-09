@extends('layouts.main', [
    'title' => 'Оформление заказа',
    'breadcrumbs' => [
        ['name' => 'Главная', 'routeName' => 'landing.index'],
        ['name' => 'Каталог', 'routeName' => 'shop.index'],
        ['name' => 'Корзина', 'routeName' => 'cart.index'],
        ['name' => 'Оформление заказа', 'routeName' => 'checkout.index'],
    ]
])

@section('pageHeadExtensions')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection

@section('content')
    <x-page-title title="Оформление заказа"></x-page-title>

    @include('partials.common.alerts', ['class' => 'col-12 col-lg-8 pe-md-5'])

    <div class="row mb-4 mb-md-5 d-flex flex-column-reverse flex-md-row">

        <section class="col-12 col-lg-8 mb-4 mb-md-5 pe-md-5">
            <form id="payment-form" class=needs-validation" novalidate>
                <div class="row g-2 g-md-3">

                    <div class="col-12" id="customerInfoSection">
                        <x-section-title title="Информация о получателе"></x-section-title>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Ваше имя</label>
                        @if(auth()->user())
                            <input type="text" class="form-control" id="name" required
                                   placeholder="{{ $placeholderUser['name'] }}"
                                   value="{{ auth()->user()->name }}">
                        @else
                            <input type="text" class="form-control" id="name" required
                                   placeholder="{{ $placeholderUser['name'] }}">
                        @endif
                        <div class="invalid-feedback">Пожалуйста, введите ваше имя</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        @if(auth()->user())
                            <input type="email" class="form-control" id="email" required readonly
                                   placeholder="{{ $placeholderUser['email'] }}"
                                   value="{{ auth()->user()->email }}">
                        @else
                            <input type="email" class="form-control" id="email" required
                                   placeholder="{{ $placeholderUser['email'] }}">
                        @endif
                        <div class="invalid-feedback">Пожалуйста, введите корректный Email</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="line1" class="form-label">Улица и номер дома</label>
                        <input type="text" class="form-control" id="line1" required
                               placeholder="{{ $placeholderUser['line1'] }}">
                        <div class="invalid-feedback">Пожалуйста, введите вашу улицу и номер дома</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="line2" class="form-label">Квартира и этаж (опционально)</label>
                        <input type="text" class="form-control" id="line2" required
                               placeholder="{{ $placeholderUser['line2'] }}">
                        <div class="invalid-feedback">Пожалуйста, введите ваш номер квартиры</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="city" class="form-label">Город</label>
                        <input type="text" class="form-control" id="city" required
                               placeholder="{{ $placeholderUser['city'] }}">
                        <div class="invalid-feedback">Пожалуйста, введите ваш город</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="state" class="form-label">Область</label>
                        <input type="text" class="form-control" id="state"
                               placeholder="{{ $placeholderUser['state'] }}">
                        <div class="form-text">Если ваш город не имеет области, оставьте это поле пустым</div>
                        <div class="invalid-feedback">Пожалуйста, введите вашу область</div>
                    </div>

                    <div class="col-6">
                        <label for="postalCode" class="form-label">Почтовый индекс</label>
                        <input type="number"
                               class="form-control"
                               id="postalCode"
                               required
                               placeholder="{{ $placeholderUser['postalCode'] }}">
                        <div class="invalid-feedback">Пожалуйста, введите ваш почтовый индекс</div>
                    </div>

                    <div class="col-6 mb-3 mb-md-4">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="tel"
                               pattern="\+?[0-9\s\-\(\)]+"
                               class="form-control"
                               id="phone"
                               required
                               placeholder="{{ $placeholderUser['phone'] }}">
                        <div class="invalid-feedback">Пожалуйста, введите корректный телефон</div>
                    </div>

                    <div class="col-12">
                        <x-section-title title="Платежные реквизиты">
                            <x-slot name="rightAligned">
                                <a target="_blank" class="text-decoration-none"
                                   href="{{ route('information.index').'#payments' }}">
                                    <i class="bi bi-info-circle"></i>
                                    Информация об оплате заказа
                                </a>
                            </x-slot>
                        </x-section-title>
                    </div>

                    <div class="col-12" id="stripeMessageContainer"></div>

                    <div class="col-12 d-flex flex-column align-items-center visually-hidden" id="spinner">
                        <div class="spinner-grow text-primary mb-2" role="status">
                            <span class="visually-hidden">Загрузка...</span>
                        </div>
                        <p class="text-muted">Загрузка платежной системы</p>
                    </div>

                    <div id="errorMessageContainer"></div>

                    <div class="col-12 mb-4">
                        <div id="payment-element">
                            <!--Stripe.js injects the Payment Element-->
                        </div>
                    </div>

                    <div class="col-12 d-grid gap-2 mb-3 mb-md-4">
                        <button class="btn btn-primary" type="submit" id="submit">
                        <span class="spinner-grow spinner-grow-sm visually-hidden"
                              role="status"
                              aria-hidden="true"
                              id="buttonSpinner"
                        ></span>
                            <span id="button-text">Оформить заказ</span>
                        </button>
                    </div>

                    <div class="col-12">
                        <p class="text-muted m-0">Оформляя заказ, вы соглашаетесь с
                            <a target="_blank" href="{{ route('information.index').'#privacy-policy' }}"
                               class="text-decoration-none">политикой конфиденциальности</a>.
                        </p>
                    </div>
                </div>
            </form>
        </section>

        <section class="col-12 col-lg-4 mb-4 mb-md-5">
            <x-section-title title="Ваш заказ" class="mb-3"></x-section-title>

            <div class="row row-cols-2 g-3 mb-4">
                @foreach(Cart::instance('default')->content() as $product)
                    <x-checkout-item :cart-item="$product"></x-checkout-item>
                @endforeach
            </div>

            <x-section-divider></x-section-divider>

            <div class="row g-3 fs-6">
                <div class="col-6">
                    <div>Стоимость товаров</div>
                    @if(session()->has('coupon'))
                        <div class="d-flex align-items-center">
                            Скидка ({{ session()->get('coupon')['code'] }})
                        </div>
                        <div>Новая стоимость</div>
                    @endif
                    <div>Налог ({{ config('cart.tax', 20) }}%)</div>
                </div>
                <div class="col-6">
                    <div data-type="currency">{{ Cart::instance('default')->subtotal() / 100 }}</div>
                    @if(session()->has('coupon'))
                        <div data-type="currency">-{{ $discount / 100 }}</div>
                        <div data-type="currency">{{ $newSubtotal / 100 }}</div>
                    @endif
                    <div data-type="currency">{{ $newTax / 100 }}</div>
                </div>
                <div class="col-6">
                    <h4>Итого</h4>
                </div>
                <div class="col-6">
                    <h4 data-type="currency">{{ $newTotal / 100 }}</h4>
                </div>
            </div>
        </section>
    </div>

    <template id="errorMessageTemplate">
        <div class="col-12 d-flex flex-column align-items-center px-4">
            <i class="bi bi-exclamation-octagon-fill text-danger fs-1"></i>
            <p class="mb-1 fs-5 text-center" id="errorMessageTitle"></p>
            <p class="text-center" id="errorMessageSubtitle"></p>
        </div>
    </template>
@endsection

@section('pageEndingExtensions')
    <script type="text/javascript">
        (function () {
            const stripeOptions = {
                stripeKey: '{{ env('STRIPE_KEY') }}',
                paymentIntentRoute: '{{ route('checkout.createPaymentIntent') }}',
                csrfToken: '{{ csrf_token() }}',
                checkoutSuccessRoute: '{{ route('checkout.success') }}',
                locale: '{{ config('app.locale', 'ru') }}'
            }

            initializeStripe(stripeOptions)
        })()
    </script>
    <script src="{{ asset('js/input-mask.js') }}"></script>
@endsection
