<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//load model and rename
use App\Order as Item_model;
use App\Order_detail as Order_detail_model;

class OrderController extends Controller
{
    private $prefix = 'order';
    private $name   = 'đơn hàng';
    /*
    /*=====Load list items==============
    */
    public function index()
    {
        //filter name, id, category id = cid
        $input_where  = array();
        $cid    = 0;
        if(isset($_GET['cid']) && $_GET['cid'] != 0) {
            $cid =  $_GET['cid'];
            $input_where['where'][] = ['cid', '=', $cid];
        }
        $name = '';
        if(isset($_GET['name']) && $_GET['name'] != '') {
            $name =  $_GET['name'];
            $input_where['or_where']['name'] = $name;
        }
        $status = '';
        if(isset($_GET['status']) && $_GET['status'] != '' && $_GET['status'] != 0) {
            $status =  $_GET['status'];
            $input_where['where'][] = ['status', '=', $status];
        }

        //get list items
        $pagination = 10;
        //$items = Item_model::get_list(array('site' => 'admin'), $input_where, $pagination);

        $items = Item_model::with(['customer', 'order_detail'])->get();

        $this->data['name'] = $name;
        $this->data['status'] = $status;
        $this->data['items'] = $items;
        $this->data['title'] = "Danh sách {$this->name}";       
        return view("admin.{$this->prefix}.index", $this->data);
    }
    /*
    /*=====Detail Item==============
    */
    public function detail($id)
    {   
        $item = Item_model::find($id);
        if(!$item) {
            return redirect("admin/{$this->prefix}");
        }
        $this->data['items'] = $item->order_detail()->with('product')->get();
        $this->data['title'] = "Chi tiết {$this->name}";
        return view("admin.{$this->prefix}.detail", $this->data);
    }
    /*
    /*=====Delete one Item==============
    */
    public function delete($id)
    {  
        $message = '';
        $item = Item_model::find($id);
        if($item) {
            if($item->order_detail) {
                $item->order_detail()->delete();
            }           
            if($item->delete()) {
                $message = "Xóa {$this->name} thành công";
            }else {
                $message = "Xóa {$this->name} thất bại";
            }           
        }else {
            $message = "{$this->name} không tồn tại";
        }
        return redirect("admin/{$this->prefix}")->with('message', $message);
    }
    /*
    /*=====Delete many Item==============
    */
    public function delete_all(Request $request) {
        $message = '';
        if($request->input('id')) {
            $list_order_detail = Order_detail_model::whereIn('order_id', $request->input('id'))->get();
            if($list_order_detail) {
                Order_detail_model::whereIn('order_id', $request->input('id'))->delete();
            }
            $flag = Item_model::whereIn('id', $request->input('id'))->delete();
            if($flag) {
                $count = count($request->input('id'));
                $message = "Xóa thành công {$count} {$this->name}";
            }else {
                $message = "{$this->name} xóa không thành công";
            }
        }else {
            $message = "Vui lòng chọn {$this->name} để xóa";
        }
        return redirect("admin/{$this->prefix}")->with('message', $message);
    }
    /*
    /*=====Change status Item==============
    */
    public function status($curent_status, $id)
    {   $message = '';    
        $item = Item_model::find($id);
        if($item) {
            $item->status = $curent_status == 1 ? 0 : 1;
            $item->save();
            $message = "Cập nhật {$this->name} thành công";
        }else {
            $message = "{$this->name} không tồn tại";
        }
        return redirect("admin/{$this->prefix}")->with('message', $message);
    }

}
