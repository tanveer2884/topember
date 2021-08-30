<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Mail\OrderCreated;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Topdot\Coupon\Models\Coupon;
use Topdot\Coupon\Services\CouponCalculator;
use Topdot\Order\Models\Order;
use Topdot\Product\Models\Product;

class OrderConfirmationController extends Controller
{
    private $cartData;

    private static $orderId;

    public function index()
    {
        if (CartFacade::isEmpty() ){
            return redirect()->route('cart');
        }

        $this->initializeCartData();

       // dd($this->cartData);
        return view('frontend.cart.confirm-order')->with($this->cartData);
    }

    public function store(Request $request)
    {
        $this->initializeCartData();

        self::$orderId = Order::getOrderId();

        /*$response = collect();
        $response->success = true;

        if (!$response->success) {
            session()->flash('alert-danger', $response->message);
            return back()->withInput();
        }

        $order = $this->saveOrderToDb();
        $this->updateStock();

        unset($this->cartData['paymentProfile']);
        CartFacade::setExtraData($this->cartData);
        CouponCalculator::removeCoupon();
        CartFacade::clear();*/
       // AbondendCart::clearCart();

       // Mail::send(new OrderCreated($order));
       // Mail::send(new OrderCreated($order,true));

        return redirect()->route('thank-you', ['order_number' => self::$orderId]);
    }

    public function updateStock()
    {
        CartFacade::getContent()->each(function(ItemCollection $item) {
            if ( $product = Product::find($item->id) ){

                $product->update([
                    'qty' => ($product->qty - $item->quantity)
                ]);
            }
        });
    }

    private function saveOrderToDb()
    {
        $coupon = CouponCalculator::isCouponApplied() ? CouponCalculator::getAppliedCopon() : null ;

        $couponId = null;
        if ($coupon && ($couponRecord = Coupon::where('code',$coupon)->active()->first())) {
            $couponId = $couponRecord->id;
        }

        $billingInfo = (array) $this->getBillingDetailsFormatted();
        $shippingInfo = (array) $this->getShippingDetailsFormatted();
        $paymentProfile = $this->cartData['paymentMethod'] == 'pay-with-card' ? (array) $this->getPaymentProfileFormatted() : [];
        $isBillingAndShippingSame = $this->cartData['is_shipping_billing_same'];

        $order = Order::create([
            'user_id' => ( $this->cartData['created_by_user'] && $this->cartData['created_by_user'] != 'guest' ) ? $this->cartData['created_by_user'] : Auth::id() ,
            'created_by' => Auth::check() ? Auth::id() : null,
            'order_id' => self::$orderId,
            'coupon_id' => $couponId,
            'subtotal' => CartFacade::getSubTotalWithoutConditions(),
            'discount' => (CartFacade::getSubTotalWithoutConditions() - CartFacade::getSubTotal()),
            'shipping' => 0,
            'tax' => 0,
            'total' => CartFacade::getTotal(),
            'shipping_name' => optional($shippingInfo)['name'],
            'shipping_address' => optional($shippingInfo)['address'],
            'shipping_address2' => optional($shippingInfo)['address2'],
            'shipping_city' => optional($shippingInfo)['city'],
            'shipping_state' => optional($shippingInfo)['state'],
           // 'shipping_email' => $this->cartData['contactInfo'],
            'shipping_phone' => optional($shippingInfo)['phone'],
            'shipping_zipCode' => optional($shippingInfo)['zip_code'],

            'billing_name' => optional($billingInfo)['name'],
            'billing_address' => optional($billingInfo)['address'],
            'billing_address2' => optional($billingInfo)['address2'],
            'billing_city' => optional($billingInfo)['city'],
            'billing_state' => optional($billingInfo)['state'],
            //'billing_email' => $this->cartData['contactInfo'],
            'billing_phone' => optional($billingInfo)['phone'],
            'billing_zipCode' => optional($billingInfo)['zip_code'],
            'is_billing_same_as_shipping' => $isBillingAndShippingSame ? true :false,

            'payment_method' => $this->cartData['paymentMethod'],
            'payment_info_name' => optional($paymentProfile)['name'],
            'payment_info_card_number' => optional($paymentProfile)['card_number'] ? substr(optional($paymentProfile)['card_number'], -4) : null,
            'payment_info_expiry' => optional($paymentProfile)['expiry'],
            'payment_info_card_type' => optional($paymentProfile)['card_type'],
            'payment_profile_id' => optional($paymentProfile)['id'],
            'cart' => CartFacade::getContent()
        ]);

        $productsWithQty = [];
        foreach (CartFacade::getContent() as $product) {
            $productsWithQty[$product->id] = ['qty' => $product->quantity];
        }

        $order->products()->attach($productsWithQty);

        return $order;
    }

    private function getShippingDetailsFormatted()
    {
        return (object)[
            'name' => optional($this->cartData['shippingInfo'])->shipping_first_name.' '.optional($this->cartData['shippingInfo'])->shipping_last_name,
            'address' => optional($this->cartData['shippingInfo'])->shipping_address,
            'address2' => optional($this->cartData['shippingInfo'])->shipping_address_2,
            'city' => optional($this->cartData['shippingInfo'])->shipping_city,
            'state' => optional($this->cartData['shippingInfo'])->shipping_state,
            'zip_code' => optional($this->cartData['shippingInfo'])->shipping_zip_code,
            //'email' => $this->cartData['contactInfo'],
            'phone' => optional($this->cartData['shippingInfo'])->shipping_phone,
        ];
    }

    private function getBillingDetailsFormatted()
    {
        return (object)[
            'name' => optional($this->cartData['billingInfo'])->billing_first_name.' '.optional($this->cartData['billingInfo'])->billing_last_name,
            'address' => optional($this->cartData['billingInfo'])->billing_address,
            'address2' => optional($this->cartData['billingInfo'])->billing_address_2,
            'city' => optional($this->cartData['billingInfo'])->billing_city,
            'state' => optional($this->cartData['billingInfo'])->billing_state,
            'zip_code' => optional($this->cartData['billingInfo'])->billing_zip_code,
           // 'email' => $this->cartData['contactInfo'],
            'phone' => optional($this->cartData['billingInfo'])->billing_phone,
        ];
    }

    private function getPaymentProfileFormatted()
    {
        if ( $this->cartData['paymentProfile']->id ){
            $profileFromDb = (object) CartFacade::getValue('payment', [])['id'];
            return (object)[
                'id' => $profileFromDb->id,
                'name' => $profileFromDb->name,
                'card_number' => $profileFromDb->card_last,
                'expiry' => $profileFromDb->expiry,
                'cvc' => null,
                'card_type' => $profileFromDb->card_type,
            ];
        }

        return (object) [
            'id' => null,
            'name' => ($this->cartData['paymentProfile'])->name,
            'card_number' => ($this->cartData['paymentProfile'])->card_number,
            'expiry' => ($this->cartData['paymentProfile'])->expiry_date,
            'cvc' => ($this->cartData['paymentProfile'])->cvc,
            'card_type' => ($this->cartData['paymentProfile'])->card_type,
        ];
    }

    private function initializeCartData()
    {
        $this->cartData = [
            'products' => (object) CartFacade::getContent(),
            'paymentProfile' => (object) CartFacade::getValue('payment', []),
            'shippingInfo' => (object) CartFacade::getValue('shipping', []),
            'billingInfo' => (object) CartFacade::getValue('billing', []),
            'is_shipping_billing_same' => CartFacade::getValue('is_shipping_billing_same',true),
        ];
    }
}
