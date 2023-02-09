@extends('layouts.main', [
    'title' => 'Информация',
    'breadcrumbs' => [
        ['name' => 'Главная', 'routeName' => 'landing.index'],
        ['name' => 'Информация', 'routeName' => 'information.index'],
    ]
])

@section('content')
    <x-page-title title="Информация"></x-page-title>
    <div class="row d-flex justify-content-between mb-4 mb-md-5">

        <div class="col-12 d-grid d-md-none mb-3 mb-md-0">
            <button class="btn btn-outline-primary d-flex justify-content-center align-items-center gap-1" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#section-list" aria-expanded="false" aria-controls="section-list"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list"
                     viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Разделы
            </button>
        </div>

        <div class="col-12 col-md-3">
            <div class="position-sticky collapse d-md-block" style="top: -1px;" id="section-list">
                <x-section-title title="Разделы"></x-section-title>
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#general">Общая информация</a>
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#site">Информация о сайте</a>
                        <a class="nav-link ms-3 my-1" href="#price">Стоимость товаров</a>
                    </nav>
                    <a class="nav-link" href="#orders">Заказы</a>
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#payments">Оплата заказа</a>
                        <a class="nav-link ms-3 my-1" href="#coupons">Купоны</a>
                        <a class="nav-link ms-3 my-1" href="#purchase-returns">Возврат товаров</a>
                        <a class="nav-link ms-3 my-1" href="#delivery">Доставка товаров</a>
                    </nav>
                    <a class="nav-link" href="#privacy-policy">Политика конфиденциальности</a>
                </nav>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <x-information-section title="Общая информация" id="general">
                <x-slot name="content">
                    <x-information-subsection title="Информация о сайте" id="site">
                        <x-slot name="content">
                            <p>Это учебный сайт, поэтому никаких товаров мы не отправляем. Цены на сайте также
                                являются
                                вымышленными.</p>
                        </x-slot>
                    </x-information-subsection>

                    <x-information-subsection title="Стоимость товаров" id="price">
                        <x-slot name="content">
                            <p>Налог не включен в стоимость товаров в каталоге. Он будет рассчитан на странице
                                оформления заказа
                                исходя из итоговой суммы заказа после применения купона.</p>
                        </x-slot>
                    </x-information-subsection>
                </x-slot>
            </x-information-section>

            <x-information-section title="Заказы" id="orders">
                <x-slot name="content">
                    <x-information-subsection title="Оплата заказа" id="payments">
                        <x-slot name="content">
                            <p>Платежи обрабатываются сервисом Stripe. Для симуляции оформления заказа можно
                                использовать
                                тестовые
                                карты:</p>
                            <div class="overflow-scroll">
                                <table class="table table-light" style="min-width: 45rem;">
                                    <thead>
                                    <tr>
                                        <th class="fw-normal bg-white">Платежная система</th>
                                        <th class="fw-normal bg-white">Номер карты</th>
                                        <th class="fw-normal bg-white">CVC</th>
                                        <th class="fw-normal bg-white">Срок окончания действия</th>
                                    </tr>
                                    </thead>
                                    <tbody class="border-top-0">
                                    <tr>
                                        <td>Visa</td>
                                        <td>4242 4242 4242 4242</td>
                                        <td>Любые 3 цифры</td>
                                        <td>Любая дата в будущем</td>
                                    </tr>
                                    <tr>
                                        <td>Mastercard</td>
                                        <td>5555 5555 5555 4444</td>
                                        <td>Любые 3 цифры</td>
                                        <td>Любая дата в будущем</td>
                                    </tr>
                                    <tr>
                                        <td>American Express</td>
                                        <td>3782 8224 6310 005</td>
                                        <td>Любые 4 цифры</td>
                                        <td>Любая дата в будущем</td>
                                    </tr>
                                    <tr>
                                        <td>Discover</td>
                                        <td>6011 1111 1111 1117</td>
                                        <td>Любые 3 цифры</td>
                                        <td>Любая дата в будущем</td>
                                    </tr>
                                    <tr>
                                        <td>UnionPay</td>
                                        <td>6200 0000 0000 0005</td>
                                        <td>Любые 3 цифры</td>
                                        <td>Любая дата в будущем</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </x-slot>
                    </x-information-subsection>

                    <x-information-subsection title="Купоны" id="coupons">
                        <x-slot name="content">
                            <p>Если у вас есть купон на скидку, его можно применить при оформлении заказа. Купоны
                                бывают двух типов:</p>
                            <ul>
                                <li>Фиксированная сумма скидки</li>
                                <li>Процент от общей стоимости покупки</li>
                            </ul>
                            <p>Для тестирования работы можно использовать купоны ABC123 (Скидка 500 р.) и DEF567 (скидка
                                50%).</p>
                        </x-slot>
                    </x-information-subsection>

                    <x-information-subsection title="Возврат товаров" id="purchase-returns">
                        <x-slot name="content">
                            <p>Какой возврат?</p>
                        </x-slot>
                    </x-information-subsection>

                    <x-information-subsection title="Доставка товаров" id="delivery">
                        <x-slot name="content">
                            <p>Доставка может занять много времени, поскольку мы ничего не отправляем.</p>
                        </x-slot>
                    </x-information-subsection>
                </x-slot>
            </x-information-section>

            <x-information-section title="Политика конфиденциальности" id="privacy-policy">
                <x-slot name="content">
                    <p>Если бы это был настоящий интернет-магазин, здесь была бы политика конфиденциальности и
                        правила
                        обработки персональных данных.</p>
                    <p>Мы собираем:</p>
                    <ul>
                        <li>Имя</li>
                        <li>Email</li>
                        <li>Адрес и почтовый индекс</li>
                        <li>Телефон</li>
                        <li>IP адрес</li>
                        <li>Платежные данные</li>
                        <li>Файлы cookie</li>
                        <li>Информацию об использовании сайта</li>
                    </ul>
                    <p>Данные используются для оформления заказов и улучшения сайта.</p>
                    <p>Данные хранятся необходимое время.</p>
                    <p>Согласием пользователя считается заполнение форм на сайте.</p>
                </x-slot>
            </x-information-section>
        </div>
    </div>
@endsection
