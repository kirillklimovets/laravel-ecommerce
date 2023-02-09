<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    public function index(): Factory|View|Redirector|RedirectResponse|Application
    {
        if ( ! Cart::instance('default')->count()) {
            return redirect(route('cart.index'))->withErrors('Невозможно оформить заказ с пустой корзиной.');
        }

        $placeholderUser = getFakePerson();

        try {
            $priceInfo = getTotalPriceInformation();
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            Log::error('Error when retrieving total price information for checkout page: '.$e->getMessage());

            return redirect(route('cart.index'))->withErrors('Произошла непредвиденная ошибка.');
        }

        return view('pages.checkout.index', [
            'placeholderUser' => $placeholderUser,
            ...$priceInfo->only('discount', 'newSubtotal', 'newTax', 'newTotal')->toArray(),
        ]);
    }

    public function createPaymentIntent(): ?JsonResponse
    {
        if (productsAreNoLongerAvailable()) {
            Log::info('There was an attempt to buy a product which is no longer available.');

            removeProductsWhichAreNoLongerAvailable();

            return response()->json(['message' => 'К сожалению, некоторые товары в корзине больше не доступны.'], 409);
        }

        try {
            $stripe    = new StripeClient(env('STRIPE_SECRET'));
            $priceInfo = getTotalPriceInformation();

            $paymentIntent = $stripe->paymentIntents->create([
                'amount'               => $priceInfo->get('newTotal'),
                'currency'             => 'rub',
                'payment_method_types' => ['card'],
                'description'          => 'Покупка в магазине Laravel E-Commerce',
                'metadata'             => [
                    'discount' => $priceInfo->get('discount'),
                    'code'     => $priceInfo->get('code'),
                    'subtotal' => $priceInfo->get('newSubtotal'),
                    'tax'      => $priceInfo->get('newTax'),
                    'content'  => Cart::content()->mapWithKeys(fn($item) => [$item->model->id => $item->qty])
                        ->toJson(JSON_UNESCAPED_UNICODE),
                ],
            ]);

            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe Api Error when creating a Payment Intent: '.$e->getMessage());

            return response()->json(['message' => 'Something went wrong while creating a Payment Intent.'], 500);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            Log::error('Error when retrieving total price information for Payment Intent: '.$e->getMessage());

            return response()->json(['message' => 'Something went wrong while creating a Payment Intent.'], 500);
        }
    }

    /**
     * Show a success page.
     */
    public function success(): View|Factory|Redirector|RedirectResponse|Application
    {
        $paymentIntentID = request()->payment_intent;

        if ( ! $paymentIntentID) {
            return redirect(route('landing.index'));
        }

        try {
            $stripe        = new StripeClient(env('STRIPE_SECRET'));
            $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentID);

            if ( ! $paymentIntent->status === 'succeeded') {
                return redirect(route('landing.index'));
            }

            Cart::instance('default')->destroy();
            session()->forget('coupon');

            return view('pages.checkout.success');
        } catch (ApiErrorException $e) {
            Log::error('Stripe Api Error when retrieving a Payment Intent: '.$e->getMessage());

            return redirect(route('landing.index'));
        }
    }
}
