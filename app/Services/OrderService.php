<?php

namespace App\Services;

use App\Utils\CardDetector;
use Illuminate\Http\Request;
use Topdot\Order\Models\Order;
use Topdot\Coupon\Models\Coupon;
use Topdot\Product\Models\Product;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\ItemCollection;
use Darryldecode\Cart\Facades\CartFacade;
use Exception;
use Illuminate\Support\Facades\DB;
use Topdot\Coupon\Services\CouponCalculator;

class OrderService
{
    protected $error;
    protected $request;

    protected $billing;
    protected $shipping;
    protected $payment;
    protected $isBillingAndShippingSame;

    protected static $orderId;

    public function __construct()
    {
        self::$orderId = Order::getOrderId();   
    }

    public function from(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function create() : bool | Order
    {
        $this->payment = CartFacade::getValue('payment', []);
        $this->billing = CartFacade::getValue('billing', []);
        $this->shipping = CartFacade::getValue('shipping', []);
        $this->isBillingAndShippingSame = CartFacade::getValue('is_shipping_billing_same',true);

        DB::beginTransaction();

        try {
            $order = $this->saveOrderToDb();
            $this->updateStock();
            $response = $this->payOrder();
    
            if (!$response->success) {
                $this->error = $response->message;
                throw new Exception($response->message);
            }

            DB::commit();
            CouponCalculator::removeCoupon();
            CartFacade::clear();
            CartFacade::setValue('billing',[]);
            CartFacade::setValue('shipping',[]);
            CartFacade::setValue('is_shipping_billing_same',[]);
            CartFacade::setValue('payment',[]);
            return $order;

        } catch (\Exception $ex) {
            DB::rollBack();
            $this->error = $ex->getMessage();
            return false;
        }
    }

    protected function payOrder()
    {
        return (object) [
            'success' => true,
            'message' => 'Order has been placed successfully.',
        ];
    }

    protected function saveOrderToDb(): Order
    {
        
        $coupon = CouponCalculator::isCouponApplied() ? CouponCalculator::getAppliedCopon() : null;

        $couponId = null;
        if ($coupon && ($couponRecord = Coupon::where('code', $coupon)->active()->first())) {
            $couponId = $couponRecord->id;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_id' => self::$orderId,
            'coupon_id' => $couponId,
            'subtotal' => CartFacade::getSubTotalWithoutConditions(),
            'discount' => (CartFacade::getSubTotalWithoutConditions() - CartFacade::getSubTotal()),
            'shipping' => $this->getShipping(),
            'tax' => $this->getTax(),
            'total' => CartFacade::getTotal(),
            'shipping_name' => optional($this->shipping)['first_name'] .' '. optional($this->shipping)['last_name'] ,
            'shipping_address' => optional($this->shipping)['address'],
            'shipping_city' => optional($this->shipping)['city'],
            'shipping_state' => optional($this->shipping)['state'],
            'shipping_email' => optional($this->shipping)['email'],
            'shipping_phone' => optional($this->shipping)['phone'],
            'shipping_zipCode' => optional($this->shipping)['zip_code'],

            'billing_name' => optional($this->billing)['first_name'] .' '. optional($this->billing)['last_name'],
            'billing_address' => optional($this->billing)['address'],
            // 'billing_address2' => optional($this->billing)['address2'],
            'billing_city' => optional($this->billing)['city'],
            'billing_state' => optional($this->billing)['state'],
            'billing_email' => optional($this->billing)['email'],
            'billing_phone' => optional($this->billing)['phone'],
            'billing_zipCode' => optional($this->billing)['zip_code'],
            'is_billing_same_as_shipping' => $this->isBillingAndShippingSame,

            'payment_info_card_number' => optional($this->payment)['card_number'] ? substr(optional($this->payment)['card_number'], -4) : null,
            'payment_info_expiry' => optional($this->payment)['expiry_year'].'-'.optional($this->payment)['expiry_month'],
            'payment_info_card_type' => optional($this->payment)['card_number'] ? (new CardDetector)->detect(cleanString(optional($this->payment)['card_number'])) : 'Other Payment Method',
            'payment_info_name' => optional($this->payment)['name_on_card'],
            'payment_profile_id' => optional($this->payment)['payment_id'],
            'cart' => CartFacade::getContent()
        ]);

        $productsWithQty = [];
        foreach (CartFacade::getContent() as $product) {
            $productsWithQty[$product->id] = ['qty' => $product->quantity];
        }

        $order->products()->attach($productsWithQty);

        return $order;
    }

    protected function updateStock()
    {
        CartFacade::getContent()->each(function (ItemCollection $item) {
            $product = Product::find($item->id);
            if (!$product) {
                $product->update([
                    'qty' => ($product->qty - $item->quantity)
                ]);
            }
        });
    }

    protected function getTax()
    {
        return 0;
    }

    protected function getShipping()
    {
        return 0;
    }

    public function getError(): string
    {
        return $this->error;
    }


    public function setError( $error ): self
    {
        $this->error = $error;
        return $this;
    }

}
