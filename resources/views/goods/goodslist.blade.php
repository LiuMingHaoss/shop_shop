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
    <h2>商品列表</h2>

            <table>
                <tr>
                    <th>商品名称</th>
                    <th>商品价格</th>
                    <th>库存</th>
                    <th>是否上架</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $k => $v)
                <tr>
                    <td>{{$v['goods_name']}}</td>
                    <td>{{$v['self_price']}}</td>
                    <td>{{$v['goods_num']}}</td>
                    @if($v['is_up']==1)
                        <td>√</td>
                    @else
                        <td>×</td>
                    @endif
                    <td><a href="javascript:;" class="addCart" goods_id="{{$v['goods_id']}}">加入购物车</a></td>
                </tr>
                @endforeach
            </table>


    </div>
</div>
</body>
</html>

<script>
    $(function(){
        $('.addCart').click(function(){
            var num = prompt("请输入加入购物车数量", "");
            var goods_id=$(this).attr('goods_id');
            $.post(
                '/cart/addCart',
                {num:num,goods_id:goods_id},
                function(res)
                {
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
