<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
use App\Model\SkuModel;
class TestController extends Controller
{
    public function test()
    {
//        $goods_id=1000020;
//        $goods_sku=GoodsModel::find($goods_id)->comments->toArray();

        $sku_id=4;
        $goodsList=SkuModel::find($sku_id)->post->toArray();
        print_r($goodsList);
    }
}
