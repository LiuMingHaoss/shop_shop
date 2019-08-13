<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\SkuModel;
class GoodsController extends Controller
{
    //商品列表
    public function goodsList()
    {

        $goodsList=GoodsModel::all()->where('is_up',1)->toArray();
        return view('goods/goodslist',['data'=>$goodsList]);
    }

    //商品详情
    public function goodsDesc()
    {
        $goods_id=$_GET['id'];
        $goodsDesc=GoodsModel::where('goods_id',$goods_id)->first()->toArray();
        $goodsSku=SkuModel::where('goods_id',$goods_id)->get()->toArray();

        return view('goods/goodsdesc',['data'=>$goodsDesc,'sku'=>$goodsSku]);
    }

    //商品sku
    public function goodsSku(Request $request)
    {
        $sku_id=$request->input('sku_id');
        $data=SkuModel::where('id',$sku_id)->first()->toArray();
        echo $data['self_price'];
    }
}
