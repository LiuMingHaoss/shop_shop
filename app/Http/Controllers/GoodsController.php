<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
class GoodsController extends Controller
{
    public function goodsList()
    {
        $goodsList=GoodsModel::all()->toArray();
        return view('goods/goodslist',['data'=>$goodsList]);
    }
}
