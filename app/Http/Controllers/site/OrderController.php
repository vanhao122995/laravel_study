<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

//load model and rename
use App\Order           as Order_model;
use App\Order_detail    as Order_detail_model;
use App\Product         as Product_model;
//use libs
use Cart;

class OrderController extends Controller
{
    private $prefix = 'order';
    private $name   = 'giỏ hàng';
    /*
    /*==========================process cart==============
    */
    public function index()
    {
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => 'Giỏ hàng'
                        );
     
        $this->data['breadcumb'] = $breadcumb;
        $this->data['title'] = "{$this->name}";       
        return view("site.{$this->prefix}.index", $this->data);
    }
    public function addCart(Request $request, $id = 0)
    {
        $id = $id > 0 ? $id : $request->input('id');
        $qty = $id > 0 ? 1 : $request->input('qty');
        $product = Product_model::find($id);
        if($product) {
            Cart::add(
                        $id, $product->name, $product->price, $qty, array('image' => $product->image)
                    );
        }
        return redirect('order/cart');
    }
    public function delete($id)
    {  
        Cart::remove($id);
        return redirect('order/cart');
    }
    public function update(Request $request)
    {  
        $ids = $request->input('id');
        $qtys = $request->input('qty');
        foreach($ids as $key => $id) {
            Cart::update($id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $qtys[$key] <= 0 ? 1 : $qtys[$key]
                    )
              ));
        }
        return redirect('order/cart');
    }
    /*
    /*===========================checkout==============
    */
    public function checkout()
    {   
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => 'Thanh toán đơn hàng'
                        );  
        $this->data['breadcumb'] = $breadcumb;
        $this->data['title'] = "Chi tiết {$this->name}";
        return view("site.{$this->prefix}.checkout", $this->data);
    }
 
    public function postCheckout(Request $request)
    {  
        //order
        $order = new Order_model;
        $order->customer_id = Auth::guard('user')->id();
        $order->status = 0;
        $order->save();

        foreach (Cart::getContent() as $key => $item) {
            $order_detail = new Order_detail_model;
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item->id;
            $order_detail->price = $item->price;
            $order_detail->quantity = $item->quantity;
            $order_detail->save();
        }
        Cart::clear();
        return redirect('message')->with('message', 'Đặt hàng thành công');
    }
}
