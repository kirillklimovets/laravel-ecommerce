@extends('layouts.landing', ['title' => 'Главная'])

@section('pageHeadExtensions')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('heroSection')
    <div class="row">
        <div class="col-12 col-md-6">
            <h1 class="fw-bold lh-1 mb-4" style="font-size: 4rem;">Интернет-магазин на Laravel</h1>
            <p class="lead mb-4">Здесь объяснение, почему наш магазин самый лучший и т.д.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('shop.index') }}" class="btn btn-light btn-lg px-4 me-md-2">
                    Смотреть каталог
                </a>
                <a href="#" class="btn btn-outline-light btn-lg px-4">Блог</a>
            </div>
        </div>
        <div class="hero-section-image-wrapper d-none d-md-block">
            <img
                src="{{ asset('images/landing/'.Arr::random(File::allFiles(public_path('images/landing')))->getFilename()) }}"
                alt="Картинка ноутбука">
        </div>
    </div>
@endsection

@section('offersSection')
    <h3 class="display-6 fw-normal mb-2 mb-md-4 animate__animated">Актуальные предложения</h3>
    <p class="lead mb-4">Рекомендуемые товары и новинки</p>

    <ul class="nav nav-pills nav-fill mx-auto mb-4 mb-md-5" id="tabs">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#featured">Рекомендуем</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#new">Новинки</button>
        </li>
    </ul>
    <div class="tab-content mb-4 mb-md-5">
        <div class="tab-pane fade show active" id="featured">
            <div class="row row-cols-2 row-cols-lg-4 g-4">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product"></x-product-card>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="new">
            <div class="row row-cols-2 row-cols-lg-4 g-4">
                @foreach($newProducts as $product)
                    <x-product-card :product="$product"></x-product-card>
                @endforeach
            </div>
        </div>
    </div>

    <a href="{{ route('shop.index') }}" class="btn btn-outline-primary btn-lg">Смотреть все товары</a>
@endsection

@section('blogSection')
    <h3 class="display-6 fw-normal mb-2 mb-md-4 text-center animate__animated">Публикации блога</h3>
    <p class="lead mb-4 mb-md-5 text-center">Читайте последние новости магазина в нашем блоге</p>
    <div class="row row-cols-1 row-cols-lg-3 g-4 mb-3 mb-md-5">
        <div class="col">
            <div class="card overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1621293954908-907159247fc8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
                    alt=""
                >
                <div class="card-body">
                    <h5 class="card-title">Публикация 1</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam,
                        dignissimos ea earum natus.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1648775524994-ebad0f7071b7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
                    alt="">
                <div class="card-body">
                    <h5 class="card-title">Публикация 2</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam,
                        dignissimos ea earum natus.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1522199755839-a2bacb67c546?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1744&q=80"
                    alt="">
                <div class="card-body">
                    <h5 class="card-title">Публикация 3</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam,
                        dignissimos ea earum natus.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
