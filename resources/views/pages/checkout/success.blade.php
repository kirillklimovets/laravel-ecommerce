@extends('layouts.main', [
    'title' => 'Спасибо за покупку',
])

@section('pageHeadExtensions')
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">
@endsection

@section('content')
    <div class="py-8 px-5 bg-light mb-5">
        <h1 class="thank-you-title mb-5">Спасибо за покупку!</h1>
        <p class="fs-5 mb-4">Вам на почту отправлено письмо с подтверждением заказа.</p>
        <a class="btn btn-primary btn-lg " href="{{ route('shop.index') }}">Вернуться в каталог</a>
    </div>
@endsection
