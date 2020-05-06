<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//load model and rename
use App\Banner as Item_model;

class BannerController extends Controller
{
    private $prefix = 'banner';
    private $name   = 'banner';
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
                        'image'         => 'required|max:2048'
                    );
        $messages = array(
                            'image.required'    => "Vui lòng chọn ảnh đại diện",
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
            $file->move($path_upload , $image_name);
        }
        //save
        $item = new Item_model;
        $item->image = $image_name;
        $item->link = $request->input('link');
        $item->save();
        return redirect("admin/{$this->prefix}")->with('message', "Thêm {$this->name} thành công");
    }
        /*
    /*=====Create and Update send POST==============
    */
    public function postEdit(Request $request) {
        $input = $request->all();
        $rules = array(
                        'image'         => 'max:2048'
                    );
        $messages = array(
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
        $item->link = $request->input('link');
        $item->image = $image_name;
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
    {
        echo 'delete-' . $curent_status . '-' . $id;

    }

}
