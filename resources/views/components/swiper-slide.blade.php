<div class="swiper-slide text-center {{ $isThumb ? 'w-auto p-2 border rounded' : '' }}">
    <img src="{{ productImage($image) }}"
         alt="{{ $alt }}"
         class="opacity-0 of-contain rounded {{ $isThumb ? 'product-thumb-image' : 'product-main-image' }}">
</div>
