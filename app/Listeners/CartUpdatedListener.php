<?php

namespace App\Listeners;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle(): void
    {
        $couponInSession = session()->get('coupon');

        if ($couponInSession) {
            $couponCode = $couponInSession['code'];
            $coupon     = Coupon::where('code', $couponCode)->first();

            dispatch_sync(new UpdateCoupon($coupon));
        }
    }
}
