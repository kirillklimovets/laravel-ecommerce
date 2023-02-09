@extends('layouts.main', [
    'title' => $product->name,
    'breadcrumbs' => [
        ['name' => 'Главная', 'routeName' => 'landing.index'],
        ['name' => 'Каталог', 'routeName' => 'shop.index'],
        ['name' => $product->name, 'routeName' => ['shop.show', $product->slug]],
    ]
])

@section('pageHeadExtensions')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('content')
    <div class="row justify-content-between mb-4">

        <div class="col-12 col-md-6 user-select-none py-3 py-md-5">
            @if($product->images)
                <div class="swiper main-swiper mb-4 mb-md-5">
                    <div class="swiper-wrapper">
                        <x-swiper-slide image="{{ $product->image }}"
                                        alt="{{ $product->name }}"></x-swiper-slide>
                        @foreach(json_decode($product->images) as $image)
                            <x-swiper-slide image="{{ $image }}"
                                            alt="{{ $product->name }}"></x-swiper-slide>
                        @endforeach
                    </div>
                    <div class="swiper-button-next d-none d-md-block"></div>
                    <div class="swiper-button-prev d-none d-md-block"></div>
                </div>

                <div class="swiper thumbnail-swiper w-100 animate__animated" data-animation="animate__slideInLeft">
                    <div class="swiper-wrapper">
                        <x-swiper-slide image="{{ $product->image }}"
                                        alt="{{ $product->name }}"
                                        is-thumb="1"></x-swiper-slide>

                        @foreach(json_decode($product->images) as $image)
                            <x-swiper-slide image="{{ $image }}"
                                            alt="{{ $product->name }}"
                                            is-thumb="1"></x-swiper-slide>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="text-center">
                    <img src="{{ productImage($product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-auto rounded product-main-image opacity-0 animate__animated"
                         data-animation="animate__fadeIn">
                </div>
            @endif
        </div>

        <div class="col-12 px-3 px-md-0 col-md-5 ps-md-5 py-3">
            <h1 class="mb-3 mb-md-4 display-4">{{ $product->name }}</h1>
            <h2 class="mb-3 mb-md-4 lead text-muted">{{ $product->details }}</h2>
            <x-stock-level product-quantity="{{ $product->quantity }}"></x-stock-level>

            <x-section-divider></x-section-divider>
            <div class="mb-4 mb-md-5">{!! $product->description !!}</div>

            <h2 class="d-inline-block mb-4 fs-4 bg-success text-white px-3 py-2" data-type="currency">
                {{ $product->getPriceAsFloat() }}
            </h2>

            @if($product->quantity > 0)
                <form action="{{ route('cart.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="d-grid d-md-block">
                        <button type="submit"
                                class="btn btn-primary btn-lg d-flex justify-content-center align-items-center gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                            </svg>

                            В корзину
                        </button>
                    </div>
                </form>
            @else
                <button type="button"
                        class="btn btn-secondary btn-lg d-flex justify-content-between align-items-center gap-2"
                        disabled
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         viewBox="0 0 16 16">
                        <path
                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                    </svg>
                    В корзину
                </button>
            @endif
        </div>
    </div>

    <div class="mb-4 mb-md-5">
        @include('partials.shop.mightAlsoLike')
    </div>

@endsection

@section('pageEndingExtensions')
    <script src="{{ asset('js/slider.js') }}"></script>
@endsection
