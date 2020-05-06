<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//load model and rename
use App\Product as Item_model;
use App\Order_detail as Order_detail_model;

class ProductController extends Controller
{
    private $prefix = 'product';
    private $name   = 'sản phẩm';
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
        $items = Item_model::get_list(array('site' => 'admin'), $input_where, $pagination);

        $this->data['name'] = $name;
        $this->data['status'] = $status;
        $this->data['items'] = $items;
        $this->data['title'] = "Danh sách {$this->name}";       
        return view("admin.{$this->prefix}.index", $this->data);
    }
    /*
    /*=====View create a item==============
    */
    public function create()
    {
        $this->data['title'] = "Thêm {$this->name}";
        return view("admin.{$this->prefix}.create", $this->data);
    }
    /*
    /*=====View edit a item==============
    */
    public function edit($id)
    {
        $item = Item_model::find($id);
        if(!$item) {
            return redirect("admin/{$this->prefix}")->with('message', "Không tồn tại {$this->name} này");
        }
        $this->data['item']     = $item;
        $this->data['title']    = "Sửa {$this->name}";
        return view("admin.{$this->prefix}.edit", $this->data);
    }
    /*
    /*=====Create and Update send POST==============
    */
    public function store(Request $request) {
        $input = $request->all();
        $rules = array(
                        'name'          => 'required|unique:product',
                        'price'         => 'numeric',
                        'sale_price'    => 'numeric',
                        'image'         => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    );
        $messages = array(
                            'name.required'     => "Tên {$this->name} không được rỗng",
                            'name.unique'       => "Tên {$this->name} đã tồn tại",
                            'numeric'           => "Vui lòng nhập số vào trường này",
                            'image.required'    => "Vui lòng chọn ảnh đại diện",
                            'image.mimes'       => "Vui lòng chọn file với đuôi mở rộng: jpeg, png, jpg, gif, svg",
                            'image.max'         => "Chọn kích thước dưới 2MB"
                        );
        //start validate
        $validator = Validator::make($input, $rules, $messages);
        //check        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //upload file
        $image_name = '';
        //Kiểm tra file
        if ($request->hasFile('image')) {
            $path_upload    = "./uploads/admin/{$this->prefix}";
            $file           = $request->image;
            $image_name     = time() . '-' . $file->getClientOriginalName();
            //move file
            $file->move( $path_upload , $image_name);
        }
        //save
        $item = new Item_model;
        $item->name         = $request->input('name');
        $item->slug         = $this->slug($request->input('name'));
        $item->title        = $request->input('title');
        $item->price        = $request->input('price');
        $item->image        = $image_name;
        $item->sale_price   = $request->input('sale_price');
        $item->category_id  = $request->input('category_id');
        $item->description  = $request->input('description');
        $item->status       = $request->input('status');
        $item->save();
        return redirect("admin/{$this->prefix}")->with('message', "Thêm {$this->name} thành công");
    }
        /*
    /*=====Create and Update send POST==============
    */
    public function postEdit(Request $request) {
        $input = $request->all();
        $rules = array(
            'name'          => 'required',
            'price'         => 'numeric',
            'sale_price'    => 'numeric',
            'image'         => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        );
        $messages = array(
                'name.required'     => "Tên {$this->name} không được rỗng",
                'numeric'           => "Vui lòng nhập số vào trường này",
                'image.mimes'       => "Vui lòng chọn file với đuôi mở rộng: jpeg, png, jpg, gif, svg",
                'image.max'         => "Chọn kích thước dưới 2MB"
            );
        //start validate
        $validator = Validator::make($input, $rules, $messages);
        //check        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $item = Item_model::find($request->input('id'));
        //upload file
        $image_name = $item->image;
        //Kiểm tra file
        if ($request->hasFile('image')) {
            $path_upload    = "./uploads/admin/{$this->prefix}";
            //delete file old
            if(file_exists($path_upload . '/' . $image_name)) {
                @unlink($path_upload . '/' . $image_name);
            }
            $file           = $request->image;
            $image_name     = time() . '-' . $file->getClientOriginalName();
            //move file
            $file->move( $path_upload , $image_name);
        }
        //save        
        $item->name = $request->input('name');
        $item->slug         = $this->slug($request->input('name'));
        $item->title        = $request->input('title');
        $item->price        = $request->input('price');
        $item->image        = $image_name;
        $item->sale_price   = $request->input('sale_price');
        $item->category_id  = $request->input('category_id');
        $item->description  = $request->input('description');
        $item->status       = $request->input('status');
        $item->save();
        return redirect("admin/{$this->prefix}")->with('message', "Sửa {$this->name} thành công");
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
            $item->delete();
            $message = "Xóa {$this->name} thành công";
        }else {
            $message = "Xóa {$this->name} thất bại";
        }
        return redirect("admin/{$this->prefix}")->with('message', $message);
    }
    /*
    /*=====Delete many Item==============
    */
    public function delete_all(Request $request) {
        $message = '';
        if($request->input('id')) {
            $list_order_detail = Order_detail_model::whereIn('product_id', $request->input('id'))->get();
            if($list_order_detail) {
                Order_detail_model::whereIn('product_id', $request->input('id'))->delete();
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
