<div>
    @if(!$relatedProducts->isEmpty())
        <x-section-title title="Похожие товары:"></x-section-title>

        <div class="row row-cols-2 row-cols-lg-4 g-4">
            @foreach($relatedProducts as $product)
                <x-product-card :product="$product"></x-product-card>
            @endforeach
        </div>
    @else
        <div class="text-center mt-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#6c757d" class="bi bi-search mb-3"
                 viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <p class="text-muted fs-5">К сожалению, похожие товары не найдены</p>
        </div>
    @endif
</div>
