<div class="col">
    <div class="card px-2 px-md-3 pt-2">
        <img src="{{ productImage($product->image) }}"
             alt="{{ $product->name }}"
             class="mb-3 product-card-image"
        >

        <div class="card-body py-0 py-md-3 pb-3">
            <a href="{{ route('shop.show', $product->slug) }}" class="text-decoration-none stretched-link">
                <h5 class="card-title text-truncate fs-6">{{ $product->name }}</h5>
            </a>
            <div class="card-text">
                <p class="text-muted product-card-details">{{ $product->details }}</p>
                <p class="fs-5 mb-0" data-type="currency">{{ $product->getPriceAsFloat() }}</p>
            </div>
        </div>
    </div>
</div>
