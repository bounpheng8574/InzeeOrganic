<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill</title>

    <style>
        body{
            font-family: dejavusans;
            font-size: 12px;
        }
    </style>

</head>
<body>

<div style="margin-left: 5%; margin-top: 10px">
<div style="text-align: center"><h5><b>ໃບຈັດຊື້ສິນຄ້າ</b></h5></div>
    <div>

        <div style="float: left; width: 300px" >
            <b> ຊື່ຮ້ານ :</b> {{$supplier[0]->shop_name}} <br/>
            <b>  ບ້ານ :</b>{{$supplier[0]->village}} <br/>
            <b>  ເມືອງ :</b> {{$supplier[0]->district}} <br/>
            <b>  ແຂວງ :</b> {{$supplier[0]->province}} <br/>
            <b>  ໂທລະສັບ :</b> {{$supplier[0]->tel}} <br/>
        </div>
        <div  style="float: right; width: 150px">
            <b>ຊື່ຮ້ານ :</b> ຮ້ານຈັນຟອງ<br/>
            <b> ໂທ :</b> 021 200342<br/>
            <b>&nbsp;&nbsp;&nbsp;&nbsp; :</b> 0305989990<br/>
        </div>
    </div>
    <br>
    <br>
    <div class="container">

        <table style="width: 100%">
            <tr>
                {{--<th  style="  padding: 10px;"><div style="width: 50px">Picture</div></th>--}}
                <th style="  padding: 10px; background-color: #B3E5FC" ><div style=" text-align: center;">ລະຫັດສິນຄ້າ</div></th>
                <th style="  padding: 10px; background-color: #B3E5FC" ><div style=" text-align: center;">ຊື່ສິນຄ້າ</div></th>
                <th style="  padding: 10px; background-color: #B3E5FC" ><div style=" text-align: center;">ປະເພດສິນຄ້າ</div></th>
                <th style="  padding: 10px; background-color: #B3E5FC" ><div style=" text-align: center;">ຈໍານວນສັ່ງຊື້</div></th>
            </tr>
            @foreach(Session::get('OrderOutList')['detail'] as $detail)
                <tr>
                    <td style=" padding: 10px;text-align: center;"><div class="div_in_td">{{$detail['pro_id']}}</div></td>
                    <td style=" padding: 10px;text-align: center;"><div class="div_in_td">{{$detail['pro_name']}}</div></td>
                    <td style=" padding: 10px;text-align: center;"><div class="div_in_td">{{$detail['pro_type']}}</div></td>
                    <td style=" padding: 10px;text-align: center;"><div class="div_in_td">{{$detail['qty']}}</div></td>
                </tr>
             @endforeach
        </table>
    </div>
</div>

<div style="float: right;margin-top: 10%; margin-right: 5%; width: 200px">
   ລາຍເຊັນຜູ້ບໍລິຫານ
    <br>
    <br>
    ........................................
</div>



</body>
</html>




{{--hello {{$supplier[0]->shop_name}}--}}