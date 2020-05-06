<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 'product';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    /**
     * get list item
     * option is admin or user
     * where is condition array, example [['vn_name', = , '1234567'], ['status', = , 1...]]
     */
    public static function get_list($option = null, $input_where = array(), $pagination = 10) {
        $items = null;
        
        if($option['site'] == 'admin') {
            $query = Product::select('id', 'name', 'image', 'price', 'sale_price', 'status', 'created_at');
            if(!empty($input_where['where'])) {
                $query->where($input_where['where']);
            }
            if(!empty($input_where['or_where'])) {;
                $vn_name = $input_where['or_where']['name'];
                $query->where(function($query) use($vn_name) {                  
                    $query->where('vn_name', 'like', '%'.$vn_name.'%')->orWhere('id', '=', $vn_name);
                });
            }      
            $items = $query->paginate($pagination);
        }

        return  $items;
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function order_detail() {
        return $this->hasMany('App\Order_detail', 'product_id');
    }
}