<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

//load model and rename
use App\Customer as Item_model;

class CustomerController extends Controller
{
    private $prefix = 'customer';
    private $name   = 'khách hàng';
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
                        'name' => 'required',
                        'username' => 'required|unique:customer|min:3',
                        'password' => 'required|min:3',
                    );
        $messages = array(
                            'name.required' => "Tên {$this->name} không được rỗng",
                            'username.unique' => "Tên {$this->name} đã tồn tại",
                            'username.required' => "Username không được rỗng",
                            'username.min' => "Username tối thiểu 3 ký tự",
                            'password.required' => "Password không được rỗng",
                            'password.min' => "Password tối thiểu 3 ký tự"
                        );
        //start validate
        $validator = Validator::make($input, $rules, $messages);
        //check        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //save
        $item = new Item_model;
        $item->name = $request->input('name');
        $item->username = $request->input('username');
        $item->password = Hash::make($request->input('password'));
        $item->save();
        return redirect("admin/{$this->prefix}")->with('message', "Thêm {$this->name} thành công");
    }
        /*
    /*=====Create and Update send POST==============
    */
    public function postEdit(Request $request) {
        $input = $request->all();
        $rules = array(
            'name' => 'required',
            'password' => 'required|min:3',
        );
        $messages = array(
                'name.required' => "Tên {$this->name} không được rỗng",
                'password.required' => "Password không được rỗng",
                'password.min' => "Password tối thiểu 3 ký tự"
            );
        //start validate
        $validator = Validator::make($input, $rules, $messages);
        //check        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //save
        $item = Item_model::find($request->input('id'));
        $item->name = $request->input('name');
        $item->password = Hash::make($request->input('password'));
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
