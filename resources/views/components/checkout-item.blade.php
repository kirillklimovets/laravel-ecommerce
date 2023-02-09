<div class="col">
    <div class="card">
        <img src="{{ productImage($cartItem->model->image) }}"
             alt="{{ $cartItem->name }}"
             class="p-3 cart-item-image">

        <div class="card-body">
            <h5 class="card-title text-truncate">{{ $cartItem->name }}</h5>
            <div class="card-text">
                <p class="text-muted text-truncate">{{ $cartItem->model->details }}</p>
                <p class="fs-5" data-type="currency">{{ $cartItem->model->getPriceAsFloat() }}</p>
                <p class="badge rounded-pill bg-warning text-black mb-0">&times;{{ $cartItem->qty }}</p>
            </div>
        </div>
    </div>
</div>
