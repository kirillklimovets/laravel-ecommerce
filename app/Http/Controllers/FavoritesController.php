<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;

class FavoritesController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $rowId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $rowId): RedirectResponse
    {
        $removedProduct = Cart::instance('favorites')->get($rowId);
        Cart::instance('favorites')->remove($rowId);

        session()->flash('successMessage', "\"$removedProduct->name\" был удален из Избранного");

        return back();
    }

    /**
     * Transfer resource from Favorites to the shopping cart.
     *
     * @param  string  $rowId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchToCart(string $rowId): RedirectResponse
    {
        $product = Cart::instance('favorites')->get($rowId);
        Cart::instance('favorites')->remove($rowId);

        $duplicates = Cart::instance('default')->search(fn($cartItem, $itemRowId) => $itemRowId === $rowId);

        if ($duplicates->isNotEmpty()) {
            session()->flash('successMessage', "\"$product->name\" уже в Корзине");

            return redirect()->route('cart.index');
        }

        Cart::instance('default')->add($product->id, $product->name, 1, $product->price)
            ->associate(Product::class);

        session()->flash('successMessage', "\"$product->name\" перемещен в Корзину");

        return redirect()->route('cart.index');
    }
}
