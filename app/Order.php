<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $table = 'order';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    /**
     * get list item
     * option is admin or user
     * where is condition array, example [['name', = , '1234567'], ['status', = , 1...]]
     */
    public static function get_list($option = null, $input_where = array(), $pagination = 10) {
        $items = null;
        
        if($option['site'] == 'admin') {
            $query = Order::select('id', 'created_at');
            if(!empty($input_where['where'])) {
                $query->where($input_where['where']);
            }
            if(!empty($input_where['or_where'])) {;
                $vn_name = $input_where['or_where']['name'];
                $query->where(function($query) use($vn_name) {                  
                    $query->where('name', 'like', '%'.$vn_name.'%')->orWhere('id', '=', $vn_name);
                });
            }      
            $items = $query->paginate($pagination);
        }

        return  $items;
    }
    /**
    * relationship one-many to table order detail
    */
    public function order_detail() {
        return $this->hasMany('App\Order_detail', 'order_id');
    }
    /**
    * relationship one-one to table order detail
    */
    public function customer() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}