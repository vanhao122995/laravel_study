<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model {
    protected $table = 'order_detail';
    //protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * relationship one-one to product
     */
    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}