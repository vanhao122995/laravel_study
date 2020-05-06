<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

//load model and rename
use App\Product as Item_model;
use App\Customer as Customer_model;
//use libs
use Cart;

class CustomerController extends Controller
{
    private $prefix = 'customer';
    private $name   = 'Quản lí thông tin';
    /*
    /*=====Load list items==============
    */
    public function index()
    {
        
        //get list items
        // $pagination = 10;
        // $items = Item_model::get_list(array('site' => 'admin'), $input_where, $pagination);

        // $this->data['item'] = $item;
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => 'Quản lí thông tin'
                        );  
        $this->data['breadcumb'] = $breadcumb;
        $this->data['title'] = "$this->name";       
        //return view("site.{$this->prefix}.index", $this->data);
        return view("site.{$this->prefix}.index", $this->data);
    }

    public function login()
    {
        if (Auth::guard('user')->check()) {
            return redirect('customer');
        }
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => 'Đăng nhập'
                        );
        $this->data['title'] = 'Đăng nhập';
        $this->data['breadcumb'] = $breadcumb;
        return view("site.{$this->prefix}.login", $this->data);
    }

    public function postLogin(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );
        $messages = array(
                'username.required' => "Username không được rỗng",
                'password.required' => "Password không được rỗng",
            );
        //start validate
        $validator = Validator::make($input, $rules, $messages);
        //check        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $info = array(
                        'username' => $input['username'],
                        'password' => $input['password']
                    );
        if(Auth::guard('user')->attempt($info)) {
            return redirect('customer');
        }else {
            return redirect('login')->with('message', 'Tên đăng nhập hoặc mật khẩu không đúng');
        }
    }

    public function logOut()
    {
        Cart::clear();
        Auth::guard('user')->logOut();
        return redirect('login');
    }

    
    public function register()
    {
        if (Auth::guard('user')->check()) {
            return redirect('customer');
        }
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => 'Đăng kí'
                        );
        $this->data['title'] = 'Đăng kí';
        $this->data['breadcumb'] = $breadcumb;
        return view("site.{$this->prefix}.register", $this->data);
    }

    public function postRegister(Request $request) {
        $input = $request->all();
        $rules = array(
            'name' => 'required',
            'username' => 'required|unique:customer',
            'password' => 'required',
        );
        $messages = array(
                'name.required'     => "Tên không được rỗng",
                'username.unique' => "Tên đã tồn tại",
                'username.required' => "Username không được rỗng",
                'password.required' => "Password không được rỗng",
            );
        //start validate
        $validator = Validator::make($input, $rules, $messages);
        //check        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $customer = new Customer_model;
        $customer->name = $request->input('name');
        $customer->username = $request->input('username');
        $customer->password = Hash::make($request->input('password'));
        $customer->save();
        return redirect('login')->with('message', 'Bạn đã đăng kí tài khoản thành công vui lòng đăng nhập để sử dụng');
    }

    public function message() {
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => 'Thông báo'
                        );
     
        $this->data['breadcumb'] = $breadcumb;
        $this->data['title'] = 'Thông báo';
        return view('site.message', $this->data);
    }
}
