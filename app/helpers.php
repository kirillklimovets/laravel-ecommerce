<?php

use App\Models\Product;
use Behat\Transliterator\Transliterator;
use Faker\Factory;
use Faker\Provider\ru_RU\Address;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

/**
 * Format given price using app locale
 *
 * @param  string|int  $price
 *
 * @return bool|string
 */
function formatPrice(string|int $price): bool|string
{
    $price  = is_int($price) ? $price : (int) $price;
    $fmt    = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
    $amount = $price / 100;

    return $fmt->formatCurrency($amount, 'RUR');
}

/**
 * Generate a fake person for placeholder
 *
 * @return array
 */
function getFakePerson(): array
{
    $faker = Factory::create(config('app.faker_locale', 'ru_RU'));

    $gender             = $faker->numberBetween(0, 1) === 0 ? 'male' : 'female';
    $name               = $faker->firstName($gender).' '.$faker->lastName($gender);
    $nameTransliterated = Transliterator::transliterate($name, '.');
    $email              = $nameTransliterated.'@'.$faker->safeEmailDomain;
    $phone              = '+7(XXX)XXX-XX-XX';

    $apartmentFloor            = $faker->numberBetween(2, 24);
    $apartmentsPerFloor        = 4;
    $maxApartmentNumberOnFloor = $apartmentsPerFloor * ($apartmentFloor - 1);
    $minApartmentNumberOnFloor = $maxApartmentNumberOnFloor - $apartmentsPerFloor + 1;
    $apartmentNumber           = $faker->numberBetween($minApartmentNumberOnFloor, $maxApartmentNumberOnFloor);
    $line1                     = mb_ucfirst($faker->streetAddress);
    $line2                     = 'Кв. '.$apartmentNumber.', этаж '.$apartmentFloor;
    $city                      = $faker->city;
    $state                     = Address::region().' '.Address::regionSuffix();
    $postalCode                = $faker->postcode;

    return compact('email', 'name', 'line1', 'line2', 'city', 'state', 'postalCode', 'phone');
}

/**
 * Return the path to the image or the 404 image.
 *
 * @param  string|null  $path
 *
 * @return string
 */
function productImage(?string $path): string
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path)
        : asset('images/image-not-found.png');
}

/**
 * Return the tax value, coupon code with discount,
 * subtotal with coupon applied, updated tax and updated total.
 *
 * @return Collection
 * @throws \Psr\Container\ContainerExceptionInterface
 * @throws \Psr\Container\NotFoundExceptionInterface
 */
function getTotalPriceInformation(): Collection
{
    $tax         = config('cart.tax', 20) / 100;
    $discount    = session()->get('coupon')['discount'] ?? 0;
    $code        = session()->get('coupon')['name'] ?? null;
    $newSubtotal = Cart::instance('default')->subtotal() - $discount;

    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }

    $newTax   = round($newSubtotal * $tax);
    $newTotal = $newSubtotal + $newTax;

    return collect(compact('tax', 'discount', 'code', 'newSubtotal', 'newTax', 'newTotal'));
}

/**
 * Check, if there are items in the cart which are no longer available.
 *
 * @return bool
 */
function productsAreNoLongerAvailable(): bool
{
    foreach (Cart::content() as $cartItem) {
        $product = Product::find($cartItem->model->id);
        if ($product->quantity < $cartItem->qty) {
            return true;
        }
    }

    return false;
}

/**
 * Remove all products which are no longer available from cart.
 *
 * @return void
 */
function removeProductsWhichAreNoLongerAvailable(): void
{
    foreach (Cart::content() as $cartItem) {
        $product = Product::find($cartItem->model->id);
        if ($product->quantity < $cartItem->qty) {
            Cart::update($cartItem->rowId, max($product->quantity, 0));
        }
    }
}
