<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use JsonException;
use Stripe\Event;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request): void
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $event = Event::constructFrom($payload);

            if ($event->type === 'payment_intent.succeeded') {
                $paymentIntent = $event->data->object;
                $order         = $this->addToOrdersTables($paymentIntent);
                $this->decreaseQuantities($order);
                Mail::send(new OrderPlaced($order));
            }
        } catch (Exception $e) {
            Log::error('Error when handling a Stripe Webhook: '.$e->getMessage());

            return;
        }
    }

    protected function addToOrdersTables(PaymentIntent $paymentIntent, $error = null): Order
    {
        $billingDetails = $paymentIntent->charges->data[0]->billing_details;
        $address        = $paymentIntent->shipping->address;

        $order = Order::create([
            'user_id'               => auth()->user()->id ?? null,
            'billing_email'         => $billingDetails->email,
            'billing_name'          => $billingDetails->name,
            'billing_address_line1' => $address->line1,
            'billing_address_line2' => $address->line2,
            'billing_city'          => $address->city,
            'billing_state'         => $address->state,
            'billing_postal_code'   => $address->postal_code,
            'billing_phone'         => $billingDetails->phone,
            'billing_discount'      => $paymentIntent->metadata['discount'],
            'billing_discount_code' => $paymentIntent->metadata['code'],
            'billing_subtotal'      => $paymentIntent->metadata['subtotal'],
            'billing_tax'           => $paymentIntent->metadata['tax'],
            'billing_total'         => $paymentIntent->amount,
            'error'                 => $error,
        ]);

        try {
            $orderContent = json_decode($paymentIntent->metadata['content'], true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            Log::error('Error when decoding a JSON to get a Payment Intent content: '.$e->getMessage());
        }

        foreach ($orderContent as $productId => $quantity) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $quantity,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities(Order $order): void
    {
        foreach (OrderProduct::where('order_id', $order->id)->get() as $orderProduct) {
            $product = Product::find($orderProduct->product_id);

            $newQuantity = max($product->quantity - $orderProduct->quantity, 0);
            $product->update(['quantity' => $newQuantity]);
        }
    }
}
