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
        .ul1 li{
            list-style:none;
            float:left;
            width:50px;
            height:20px;
            border :1px solid red;
            cursor:pointer;
        }

    </style>
</head>
<body>

<div class="flex-center position-ref full-height">


    <div class="content">


        <table>
            <tr>
                <th>商品名称：</th>
                <td>{{$data['goods_name']}}</td>
            </tr>

            <tr>
                <th>颜色</th>
                <td>
                    <ul class="ul1">
                        @foreach($sku as $k=>$v)
                             <li class="sku" sku_id="{{$v['id']}}">{{$v['color']}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>



        </table>
        <hr>
        <p>价格：<b class="price"></b></p>
        <hr>
        <a href="javascript:;" class="addCart" goods_id="{{$data['goods_id']}}">加入购物车</a>
    </div>
</div>
</body>
</html>
<script>
    $(function(){
        $('.sku').click(function(){
            var _this=$(this);
            var sku_id=_this.attr('sku_id');
            $('.price').attr('sku_id',sku_id);
            $.post(
                '/goods/goodsSku',
                {sku_id:sku_id},
                function(data)
                {
                    $('.price').text(data);
                }
            )
        })
        //加入购物车
        $('.addCart').click(function(){
            var num = prompt("请输入加入购物车数量", "");
            var sku_id=$('.price').attr('sku_id');

            // var goods_id=$(this).attr('goods_id');
            $.post(
                '/cart/addCart',
                {num:num,sku_id:sku_id},
                function(res)
                {
                    // console.logs(res);
                    if(res=='ok')
                    {
                        alert('添加购物车成功');
                    }else{
                        alert('添加购物车失败');
                    }
                }
            )
        })

    })
</script>
