<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Auth;
use App\Model\CartModel;
class CartController extends Controller
{
    /**
     * 添加购物车
     */
    public function addCart()
    {
        $goods_id=$_POST['goods_id'];   //获取商品id
        $num=$_POST['num'];             //获取加入购物车数量
        $goodsData=GoodsModel::where('goods_id',$goods_id)->first()->toArray();     //根据id查询该商品信息

        //加入购物车数据
        $addCart=[
            'goods_id'=>$goods_id,
            'buy_number'=>$num,
            'goods_name'=>$goodsData['goods_name'],
            'goods_price'=>$goodsData['self_price'],
            'create_time'=>time(),
            'uid'=>Auth::id(),
        ];

        //添加成功返回id
        $cid=CartModel::insertGetId($addCart);
        if($cid){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    /**
     * 购物车列表
     */

    public function cartList()
    {
        $where=[
            'uid'=>Auth::id(),
            'status'=>1
        ];
        $cartList=CartModel::where($where)->get()->toArray();
        return view('cart/cartlist',['data'=>$cartList]);
    }

    /**
     * 修改购物车数量
     */
    public function cartUpt(Request $request)
    {
        $cart_id=$request->input('cart_id');
        $buy_number=$request->input('buynum');
        $res=CartModel::where('id',$cart_id)->update(['buy_number'=>$buy_number]);

    }

    /**
     * 删除购物车
     */

    public function cartDel(Request $request)
    {
        $cart_id=$request->input('cart_id');
        $res=CartModel::where('id',$cart_id)->update(['status'=>2]);
        if($res)
        {
            echo 'ok';
        }else{
            echo 'no';
        }
    }
}
