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
        <h2>订单列表</h2>

        <table>
            <tr>
                <th>订单id</th>
                <th>订单号</th>
                <th>价格</th>
                <th>操作</th>
            </tr>
            @foreach($data as $k => $v)
                <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['order_no']}}</td>
                    <td>{{$v['order_amount']}}</td>
                    <td><a href="/order/pay?order_id={{$v['id']}}" class="pay">去支付</a></td>
                </tr>
            @endforeach
            <hr>

        </table>
        <hr>


    </div>
</div>
</body>
</html>

<script>
    $(function(){

    })

</script>
