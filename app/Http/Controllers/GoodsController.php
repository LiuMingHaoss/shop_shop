<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
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
        return view('goods/goodsdesc',['data'=>$goodsDesc]);
    }
}
