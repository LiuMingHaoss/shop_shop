<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="/js/jquery/jquery-1.12.4.min.js"></script>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="flex-center position-ref full-height">


    <div class="content">
        <h2>购物车列表</h2>

        <table>
            <tr>
                <th></th>
                <th>商品名称</th>
                <th>商品价格</th>
                <th>购买数量</th>
                <th>操作</th>
            </tr>
            @foreach($data as $k => $v)
                <tr cart_id="{{$v['id']}}">
                    <td><input type="checkbox" class="box"></td>
                    <td>{{$v['goods_name']}}</td>
                    <td>{{$v['goods_price']}}</td>
                    <td><span class="min">－ </span><span>{{$v['buy_number']}}</span><span class="add"> ＋</span></td>
                    <td><a href="javascript:;" class="delcart">删除</a></td>
                </tr>
            @endforeach
            <hr>

        </table>
        <hr>

        <a href="javascript:;" id="go">结算</a>
    </div>
</div>
</body>
</html>

<script>
    $(function(){
        //点击－号
        $('.min').click(function(){
            var num=$(this).next().text();
            if(num>1){
                $(this).next().text(num-1);
            }else{
                $(this).next().text(1);
            }
            var buynum=$(this).next().text();
            var cart_id=$(this).parents('tr').attr('cart_id');

            $.post(
                '/cart/cartUpt',
                {buynum:buynum,cart_id:cart_id},
                function(data)
                {
                    history.go(0);
                }
            )
        })

        //点击＋号
        $('.add').click(function(){
            var num=$(this).prev().text();
            $(this).prev().text(parseInt(num)+1);
            var buynum=$(this).prev().text();
            var cart_id=$(this).parents('tr').attr('cart_id');
            $.post(
                '/cart/cartUpt',
                {buynum:buynum,cart_id:cart_id},
                function(data)
                {
                    history.go(0);
                }
            )
        })

        //删除
        $('.delcart').click(function(){
            var cart_id=$(this).parents('tr').attr('cart_id');
            $.post(
                '/cart/cartDel',
                {cart_id:cart_id},
                function(res){
                    if(res='ok'){
                        alert('删除成功');
                        history.go(0);
                    }else{
                        alert('删除失败');
                        history.go(0);
                    }
                }
            )

        })

        //结算
        $('#go').click(function(){
            var _box=$('.box');
            var cart_id='';
            _box.each(function(){
                if($(this).prop('checked')==true){
                    cart_id+=$(this).parents('tr').attr('cart_id')+',';
                }
            });
            cart_id=cart_id.substr(0,cart_id.length-1);
            $.post(
                '/order/orderAdd',
                {cart_id:cart_id},
                function(data)
                {
                    if(data=='ok'){
                        location.href="/order/orderList";
                    }
                }
            )
        })
    })

</script>
