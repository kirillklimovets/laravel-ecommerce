<div class="row d-flex justify-content-between align-items-center mb-4" style="min-width: 55rem;">
    <div class="col-5 row d-flex align-items-center" style="transform: rotate(0);">
        <div class="col-5 d-flex justify-content-center ps-5">
            <img class="cart-item-image-sm me-5" src="{{ productImage($cartItem->model->image) }}"
                 alt="{{ $cartItem->name }}">
        </div>
        <div class="col-7">
            <a href="{{ route('shop.show', $cartItem->model->slug) }}"
               class="stretched-link text-truncate fs-5 m-0 text-decoration-none text-black">{{ $cartItem->name }}</a>
            <p class="cart-item-details-sm text-muted m-0">{{ $cartItem->model->details }}</p>
        </div>
    </div>
    <div class="col-2 d-flex align-items-center">
        <p class="m-0 fs-5" data-type="currency">{{ $cartItem->subtotal() / 100 }}</p>
    </div>
    <div class="col-3 d-flex justify-content-end align-items-center">
        <div>
            <form action="{{ route('favorites.destroy', $cartItem->rowId) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="d-inline-block btn btn-danger my-1">Удалить</button>
            </form>
            <form action="{{ route('favorites.switchToCart', $cartItem->rowId) }}" method="post" class="d-inline-block">
                @csrf
                <button type="submit" class="d-inline-block btn btn-success text-white my-1">В корзину</button>
            </form>
        </div>
    </div>
</div>

<x-section-divider style="min-width: 55rem;"></x-section-divider>
