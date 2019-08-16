<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    public $table='shop_goods';
    public $primaryKey='goods_id';

    public function comments()
    {
        return $this->hasMany('App\Model\SkuModel','goods_id','goods_id');
    }

}
