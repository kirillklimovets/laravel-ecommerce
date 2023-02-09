<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): Response|RedirectResponse
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if ( ! $coupon) {
            return redirect(route('cart.index'))
                ->withErrors('Недействительный купон. Пожалуйста, попробуйте снова.');
        }

        dispatch_sync(new UpdateCoupon($coupon));

        return redirect(route('cart.index'))->with('successMessage', 'Купон был применен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        session()->forget('coupon');

        return back()->with('successMessage', 'Купон был отменен.');
    }
}
