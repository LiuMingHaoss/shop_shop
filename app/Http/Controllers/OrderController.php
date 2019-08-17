<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Model\OrderModel;
class OrderController extends Controller
{
    public function orderAdd(Request $request)
    {
        $cart_id=$request->input('cart_id');
        $cart_id=explode(',',$cart_id);
        $cartData=DB::table('shop_cart')->whereIn('id',$cart_id)->get();
        $allPirce=0;
        foreach ($cartData as $k=>$v){
            $allPirce+=$v->buy_number*$v->goods_price;
        }
        $addOrder=[
          'uid'=>Auth::id(),
            'order_no'=>Str::random(16),
            'order_amount'=>$allPirce,
            'create_time'=>time(),
        ];

        $oid=OrderModel::insertGetId($addOrder);

        foreach ($cartData as $key=>$value)
        {
            $addOrderD=[
                'oid'=>$oid,
                'goods_id'=>$value->goods_id,
                'goods_name'=>$value->goods_name,
                'goods_price'=>$value->goods_price,
                'uid'=>Auth::id()
            ];
            $id=DB::table('shop_order_detail')->insertGetId($addOrderD);
        }

        echo 'ok';
    }

    /**
     * 订单列表
     */
    public function orderList()
    {

        $where=[
          'uid'=>Auth::id(),
          'status'=>1
        ];
        $orderList=OrderModel::where($where)->get();
//        $orderList=json_encode($orderList);
//        $orderList=json_decode($orderList,JSON_UNESCAPED_UNICODE);
        return view('order/orderlist',['data'=>$orderList]);
    }
}
