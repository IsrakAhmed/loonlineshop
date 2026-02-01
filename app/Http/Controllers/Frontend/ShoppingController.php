<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productprice;
use App\Models\Product;
use App\Models\Coupon;
use Toastr;
use Cart;
use DB;
use Session;
use Carbon\Carbon;
class ShoppingController extends Controller
{

    public function addTocartGet($id,Request $request){
        $qty=1;
        $productInfo = DB::table('products')->where('id',$id)->first();
        $productImage = DB::table('productimages')->where('product_id',$id)->first();
        $cartinfo=Cart::instance('shopping')->add(['id'=>$productInfo->id,'name'=>$productInfo->name,'qty'=>$qty,'price'=>$productInfo->new_price,
            'options' => [
                'image'=>$productImage->image,
                'old_price'=>$productInfo->old_price,
                 'slug' => $productInfo->slug,
                 'purchase_price' => $productInfo->purchase_price,
             ]]);

        // return redirect()->back();
        return response()->json($cartinfo);
    } 

    public function cart_store(Request $request)
    {
        $product = Product::where(['id' => $request->id])->first();
        Cart::instance('shopping')->add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->new_price,
            'options' => [
                'slug' => $product->slug,
                'image' => $product->image->image,
                'old_price' => $product->new_price,
                'purchase_price' => $product->purchase_price,
                'product_size'=>$request->product_size,
                'product_color'=>$request->product_color,
                'pro_unit'=>$request->pro_unit,
            ],
        ]);

        Toastr::success('Product successfully add to cart', 'Success!');
        if ($request->has('order_now')) {
            return redirect()->route('customer.checkout');
        } else {
            return back();
        }
    }
    public function cart_remove(Request $request)
    {
        $remove = Cart::instance('shopping')->update($request->id, 0);
        $data = Cart::instance('shopping')->content();
        return view('frontEnd.layouts.ajax.cart', compact('data'));
    }
    public function cart_increment(Request $request)
    {
        $item = Cart::instance('shopping')->get($request->id);
        $qty = $item->qty + 1;
        $increment = Cart::instance('shopping')->update($request->id, $qty);
        $data = Cart::instance('shopping')->content();
        return view('frontEnd.layouts.ajax.cart', compact('data'));
    }
    public function cart_decrement(Request $request)
    {
        $item = Cart::instance('shopping')->get($request->id);
        $qty = $item->qty - 1;
        $decrement = Cart::instance('shopping')->update($request->id, $qty);
        $data = Cart::instance('shopping')->content();
        return view('frontEnd.layouts.ajax.cart', compact('data'));
    }
    public function cart_count(Request $request)
    {
        $data = Cart::instance('shopping')->count();
        return view('frontEnd.layouts.ajax.cart_count', compact('data'));
    }
    public function mobilecart_qty(Request $request)
    {
        $data = Cart::instance('shopping')->count();
        return view('frontEnd.layouts.ajax.mobilecart_qty', compact('data'));
    }
    public function applyCoupon(Request $request)
    {
        
        $couponCode = $request->input('coupon_code');
        
        // Retrieve the coupon
        $coupon = Coupon::where('code', $couponCode)->first();
        
    
        // If no coupon found or coupon is expired, reset discount and return error
        if (!$coupon) {
            Session::put('discount', 0);
            $message ='Invalid coupon code!' ;
            return response()->json(['status' => false, 'message' => $message]);
        }
        
        if (Carbon::today()->gt($coupon->expired_date)) {
            Session::put('discount', 0);
            $message = 'Coupon has expired!';
            return response()->json(['status' => false, 'message' => $message]);
        }
        
        
        // Calculate discount
        $subtotal = Cart::instance('shopping')->subtotal();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);
        
        $discount = $coupon->calculateDiscount($subtotal);
     
    
        // Apply discount if valid, otherwise reset discount
        if ($discount > 0) {
            Session::put('discount', $discount);
            return response()->json(['status' => true, 'message' => 'Coupon applied!', 'discount' => $discount]);
        }
    
        Session::put('discount', 0);
        return response()->json(['status' => false, 'message' => 'Coupon is not valid for this purchase!']);
    }



public function addToCartAjax(Request $request)
{
    $product = Product::where('id', $request->id)->first();

    if (!$product) {
        return response()->json(['status' => false, 'message' => 'Product not found']);
    }

    Cart::instance('shopping')->add([
        'id' => $product->id,
        'name' => $product->name,
        'qty' => 1,
        'price' => $product->new_price,
        'options' => [
            'slug' => $product->slug,
            'image' => optional($product->image)->image, // null protection
            'old_price' => $product->old_price,
            'purchase_price' => $product->purchase_price,
        ],
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Product added to cart successfully!',
        'cart_count' => Cart::instance('shopping')->count()
    ]);
}















}
