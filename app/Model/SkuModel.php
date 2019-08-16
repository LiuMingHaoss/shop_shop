<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SkuModel extends Model
{
    public $table='goods_sku';
    public $primaryKey='id';

    public function post(){
        return $this->belongsTo('App\Model\GoodsModel', 'goods_id','goods_id');
    }
}
