<?php
  
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
  
class ProductController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('dashboard', compact('products'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function checkoutform(Request $request)
    {
            
            return view('checkoutform');

    
    }
    public function checkout(Request $request)
    {
        
            try{

            $input = $request->all();
            $data = \App\Models\Admin::first()->toArray();
            $carts = session()->get('cart');
            // dd($carts);
            $input['user_id'] = \Auth::id();
            $order = \App\Models\Order::create($input);

            foreach($carts as $key => $cart){
                $input['order_id'] = $order->id;
                $input['product_id'] = $key;
                \App\Models\OrderItem::create($input);
            }
            $request->email = 'jsinghkik@gmail.com';
            self::mailSend($data, $request);
            session()->forget('cart');
            session()->flush();
            return redirect('/home')->with('success', 'Order Confirm successfully!');
        }catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }

    
    }
    public static function mailSend($data, $request) {
        try{
            
	\Mail::send('emails.send_email', $data, function($message) use ($request) {
	    $message->from(env('MAIL_FROM_ADDRESS'));
	    $message->sender(env('MAIL_FROM_ADDRESS'));
	    $message->to($request->email);
	    $message->subject('Please confirm your order!');

        
	});
	return true;
        } catch (Exception $ex) {
            return redirect('admin/users')->with('flash_message', $ex->getMessage());
        }
    }
}