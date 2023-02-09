@extends('layouts.main', [
    'title' => 'Товары',
    'breadcrumbs' => [
        ['name' => 'Главная', 'routeName' => 'landing.index'],
        ['name' => 'Каталог', 'routeName' => 'shop.index'],
    ]
])

@section('pageHeadExtensions')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection

@section('content')
    <x-page-title title="Каталог">
        <x-slot name="rightAligned">
            <div class="d-flex flex-column gap-2 w-100" style="max-width: 25rem;">
                <div id="search-box"></div>
                <div id="powered-by" class="d-flex justify-content-end"></div>
            </div>
        </x-slot>
    </x-page-title>

    <div class="row mb-4 mb-md-5 justify-content-between">

        <div class="col-12 d-grid d-md-none mb-3 mb-md-0">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#refinements">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter"
                     viewBox="0 0 16 16">
                    <path
                        d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Фильтры
            </button>
        </div>

        <section class="col-12 col-md-3">
            <div class="position-sticky collapse d-md-block" style="top: -1px;" id="refinements">
                <x-section-title title="Фильтры"></x-section-title>
                <div id="current-refinements"></div>
                <div id="clear-refinements"></div>
                <div id="categories-refinement-list"></div>
                <div id="price-numeric-menu"></div>
            </div>
        </section>

        <section class="col-12 col-md-9">
            <x-section-title title="Товары">
                <x-slot name="rightAligned">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fs-6">Сортировка:</span>
                        <div id="sort-by-price"></div>
                    </div>
                </x-slot>
            </x-section-title>
            <div id="error-container"></div>
            <div id="hits" class="mb-4"></div>
            <div id="pagination"></div>
        </section>

    </div>

    <template id="searchBoxTemplate">
        <div class="input-group">
            <input type="text" placeholder="Искать в каталоге..." class="form-control border-end-0">
            <span class="input-group-text bg-transparent border-start-0 border-end-0">
                <div class="spinner-border spinner-border-sm border-2 text-primary" role="status">
                    <span class="visually-hidden">Загрузка...</span>
                </div>
            </span>
            <button class="input-group-text bg-transparent border-start-0 border-end-0 py-0 text-secondary fs-5"
                    data-action="clear">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x"
                     viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
            <button class="btn btn-primary d-flex justify-content-center align-items-center" data-action="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                     viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
    </template>

    <template id="error">
        <div class="col-12 d-flex flex-column align-items-center">
            <i class="bi bi-exclamation-octagon-fill text-danger fs-1"></i>
            <p class="mb-1 fs-5">Произошла непредвиденная ошибка</p>
            <p>Пожалуйста, попробуйте позже</p>
        </div>
    </template>
@endsection

@section('pageEndingExtensions')
    <script type="text/javascript">
        (function () {
            const algoliaOptions = {
                appId: '{{ env('ALGOLIA_APP_ID') }}',
                apiKey: '{{ env('ALGOLIA_KEY') }}',
                indexName: '{{ Product::getIndexName() }}',
                shopUrl: '{{ route('shop.index') }}',
                storageUrl: '{{ URL::to('storage') }}',
                imageNotFoundUrl: '{{ asset('images/image-not-found.png') }}',
                hitsPerPage: {{ config('shop.pagination') }},
            }

            initializeAlgolia(algoliaOptions)
        })()
    </script>
@endsection
