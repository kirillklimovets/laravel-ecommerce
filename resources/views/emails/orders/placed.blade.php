@component('mail::message')

<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 2rem;">
    <img src="{{ asset('images/email/done.svg') }}" alt="Изображение галочки" width="30%">
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h1 style="font-size: 1.8rem;">Заказ оформлен</h1>
        <p>Благодарим вас за покупку в нашем магазине!</p>
    </div>
</div>

<br/>

# Информация о получателе:

**Имя:** {{ $order->billing_name }}

**Email:** {{ $order->billing_email }}

**Телефон:** {{ $order->billing_phone }}

**Адрес:** {{ $order->billing_city.', '.$order->billing_address_line1.', '.$order->billing_address_line2 }}

<br/>

# Купленные товары

@component('mail::table')
| Товар                | Количество                      | Цена                               |
| :------------------: | :-----------------------------: | :--------------------------------: |
@foreach($order->products as $product)
| {{ $product->name }} | {{ $product->pivot->quantity }} | {{ formatPrice($product->price) }} |
@endforeach
@endcomponent

@component('mail::panel')
@if($order->billing_discount)
**Стоимость товаров (с учетом скидки):** {{ formatPrice($order->billing_subtotal) }}
**Скидка:** -{{ formatPrice($order->billing_discount) }}
@else
**Стоимость товаров:** {{ formatPrice($order->billing_subtotal) }}
@endif

**Налог:** {{ formatPrice($order->billing_tax) }}

**Итого:** {{ formatPrice($order->billing_total) }}
@endcomponent

@component('mail::button', ['url' => route('landing.index'), 'color' => 'success'])
Продолжить покупки
@endcomponent

@endcomponent
