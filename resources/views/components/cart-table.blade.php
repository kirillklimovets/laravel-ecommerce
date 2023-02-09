<section class="mb-4">
    <x-section-title title="{{ $title }}">
        <x-slot name="rightAligned">
            <p class="fs-5 bg-warning px-2 m-0">{{ trans_choice('cart.items', Cart::instance($cartInstanceName)->count(), ['count' => Cart::count()]) }}</p>
        </x-slot>
    </x-section-title>
    <div class="overflow-scroll">
        <div class="row d-flex justify-content-between align-items-center fs-6 mb-2" style="min-width: 60rem;">
            <div class="col-5 text-center">Товар</div>
            <div class="col-2">Стоимость</div>
            <div class="col-2">Количество</div>
            <div class="col-3"></div>
        </div>
        <x-section-divider class="mb-4" style="min-width: 60rem;"></x-section-divider>
        @foreach(Cart::instance($cartInstanceName)->content() as $product)
            <x-cart-item :cart-item="$product"></x-cart-item>
        @endforeach
    </div>
</section>

<section class="mb-4 mb-md-5">
    <x-section-title title="Стоимость товаров" with-divider="0"></x-section-title>
    <div class="row d-flex justify-content-between gap-4 gap-md-0">
        <div class="col-12 col-md-6">
            <div class="row g-3 fs-6">
                <div class="col-6">
                    <div>Стоимость товаров</div>
                    @if(session()->has('coupon'))
                        <div class="d-flex align-items-center">
                            Скидка ({{ session()->get('coupon')['code'] }})
                            <form action="{{ route('coupon.destroy') }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="p-0 bg-light rounded border-0 px-2 ms-2 text-primary"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="Не применять купон">
                                    Отменить
                                </button>
                            </form>
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
        </div>
        <div class="col-12 col-md-6">
            @if(!session()->has('coupon'))
                <form action="{{ route('coupon.store') }}" method="post" class="mb-4">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <label for="coupon" class="form-label">Есть купон? Введите его сюда</label>
                        <a href="{{ route('information.index').'#coupons' }}"
                           class="text-decoration-none">Подробнее</a>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="coupon" placeholder="COUPON" name="coupon_code">
                        <button class="btn btn-outline-success" type="submit">Применить</button>
                    </div>
                </form>
            @endif
            <p class="lead fs-6 m-0 bg-light px-3 py-4">Доставка бесплатная по всему миру. А то иначе
                пришлось еще бы рассчитывать стоимость доставки и т.д.</p>
        </div>
    </div>
</section>

<section class="mb-4 mb-md-5">
    <div class="px-2 d-grid gap-2 text-center">
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Перейти к оформлению
            заказа</a>
        <a href="{{ route('shop.index') }}" class="text-decoration-none">Продолжить покупки</a>
    </div>
</section>
