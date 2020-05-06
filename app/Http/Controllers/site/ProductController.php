<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//load model and rename
use App\Product as Item_model;
use App\Category as Item_category_model;

class ProductController extends Controller
{
    private $prefix = 'product';
    private $name   = 'sản phẩm';
    /*
    /*=====Load list items==============
    */
    public function index()
    {
        //get list items
        $pagination = 10;
        $items = Item_model::select(['id', 'name', 'title', 'slug', 'price', 'sale_price', 'image', 'description', 'created_at'])
                            ->where('status', '=', 1)
                            ->paginate($pagination);
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => url('san-pham.html'),
                            'name' => 'Sản phẩm'
                        );
     
        $this->data['breadcumb'] = $breadcumb;
        $this->data['items'] = $items;
        $this->data['title'] = "Danh sách {$this->name}";       
        return view("site.{$this->prefix}.index", $this->data);
    }

    public function category($slug) {
        $list_category = Item_category_model::where('slug', '=', $slug)->first();
        //get list items
        $pagination = 10;
        $items = Item_model::select(['id', 'name', 'title', 'slug', 'price', 'sale_price', 'image', 'description', 'created_at'])
                            ->where('status', '=', 1)
                            ->where('category_id', '=', $list_category->id)
                            ->paginate($pagination);
        $this->data['title'] = $list_category->name;  
        $breadcumb = array();
        $breadcumb[] = array(
                            'link' => '',
                            'name' => $list_category->name
                        );
     
        $this->data['breadcumb'] = $breadcumb;
        $this->data['items'] =  $items;
        return view('site.product.index', $this->data);
    }

    public function detail($slug) {
        $item = Item_model::where('slug', '=', $slug)->first();
        $category = $item->category;
        $breadcumb = array();
        $breadcumb[] = array(
            'link' => url("san-pham/{$category->slug}-{$category->id}.html"),
            'name' => $category->name
        );
        $breadcumb[] = array(
                            'link' => '',
                            'name' =>  $item->name
                        );
        $this->data['breadcumb'] = $breadcumb;
        $this->data['item'] = $item;
        $this->data['title'] = $item->name;
        return view('site.product.detail', $this->data);
    }

}
