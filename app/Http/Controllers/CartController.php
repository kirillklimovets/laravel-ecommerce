<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     */
    public function index(): View|Redirector
    {
        if (productsAreNoLongerAvailable()) {
            Log::info('There was an attempt to buy a product which is no longer available.');

            removeProductsWhichAreNoLongerAvailable();

            return redirect(route('cart.index'))
                ->withErrors('К сожалению, некоторые товары, которые были в корзине больше не доступны. Мы убрали их из корзины.');
        }

        return view('pages.cart.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $product = Product::findOrFail($request->id);

        $duplicates = Cart::search(fn($product) => $product->id === $request->id);

        if ($duplicates->isNotEmpty()) {
            session()->flash('successMessage', "\"$product->name\" уже в корзине.");

            return redirect()->route('cart.index');
        }

        Cart::add($product->id, $product->name, 1, $product->price)->associate(Product::class);
        session()->flash('successMessage', "\"$product->name\" был добавлен в Корзину.");

        return redirect()->route('cart.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $rowId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId): JsonResponse
    {
        $maxProductsQuantity = config('cart.maxQuantity', 5);
        $validator           = Validator::make($request->all(), [
            'quantity' => "required|numeric|between:1,$maxProductsQuantity",
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect([
                "Количество единиц товара должно быть между 1 и $maxProductsQuantity.",
            ]));

            return response()->json(['success' => false], 400);
        }

        $productQuantity = Cart::get($rowId)->model->quantity;
        if ($request->quantity > $productQuantity) {
            Cart::update($rowId, $productQuantity);

            session()->flash('errors', collect([
                "На данный момент у нас нет в наличии достаточного количества этого товара.",
            ]));

            return response()->json(['success' => false], 400);
        }

        Cart::update($rowId, $request->quantity);
        session()->flash('successMessage', 'Количество товаров обновлено.');

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $rowId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $rowId): RedirectResponse
    {
        $removedProduct = Cart::get($rowId);
        Cart::remove($rowId);

        session()->flash('successMessage', "\"$removedProduct->name\" был удален из Корзины.");

        return back();
    }

    /**
     * Transfer resource from shopping cart to Favorites.
     *
     * @param  string  $rowId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchToFavorites(string $rowId): RedirectResponse
    {
        $product = Cart::get($rowId);
        Cart::remove($rowId);

        $duplicates = Cart::instance('favorites')->search(fn($cartItem, $itemRowId) => $itemRowId === $rowId);

        if ($duplicates->isNotEmpty()) {
            session()->flash('successMessage', "\"$product->name\" уже в Избранном.");

            return redirect()->route('cart.index');
        }

        Cart::instance('favorites')->add($product->id, $product->name, 1, $product->price)
            ->associate(Product::class);

        session()->flash('successMessage', "\"$product->name\" перемещен в Избранное.");

        return redirect()->route('cart.index');
    }
}
