<section class="mb-4">
    <x-section-title title="{{ $title }}">
        <x-slot name="rightAligned">
            <p class="fs-5 bg-warning px-2 m-0">{{ trans_choice('cart.items', Cart::instance($cartInstanceName)->count(), ['count' => Cart::count()]) }}</p>
        </x-slot>
    </x-section-title>
    <div class="overflow-scroll">
        <div class="row d-flex justify-content-between align-items-center fs-6 mb-2" style="min-width: 55rem;">
            <div class="col-5 text-center">Товар</div>
            <div class="col-2">Цена</div>
            <div class="col-3"></div>
        </div>
        <x-section-divider class="mb-4" style="min-width: 55rem;"></x-section-divider>
        @foreach(Cart::instance($cartInstanceName)->content() as $product)
            <x-favorites-item :cart-item="$product"></x-favorites-item>
        @endforeach
    </div>
</section>
