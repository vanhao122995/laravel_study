<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//load model and rename
use App\Product as Item_model;
use App\Banner as Banner_model;

class HomeController extends Controller
{
    private $prefix = 'home';
    private $name   = 'Trang chủ';
    /*
    /*=====Load list items==============
    */
    public function index()
    {
        //get list items
        $pagination = 16;
        $items = Item_model::where([['is_home', '=', 1], ['status', '=', 1]])->paginate($pagination);
        $banners = Banner_model::select('id', 'image', 'link')->paginate($pagination);

        $this->data['items'] = $items;
        $this->data['banners'] = $banners;
        $this->data['title'] = "$this->name";       
        return view("site.{$this->prefix}.index", $this->data);
    }

}
