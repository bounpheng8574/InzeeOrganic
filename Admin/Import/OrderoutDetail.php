<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ນໍາເຂົ້າສິນຄ້າ</title>
     <link rel="shortcut icon" href="../../photo/logo2.png" type="image/x-icon">
        <link rel="stylesheet" href="../../node_modules/custom.css">
            <style type="text/css">
            body,td,th{font-family: Phetsarath OT;}
        </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container">
        <?php include_once '../prodiv/icon.php';  ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
            </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-edit'></span>&nbsp;ນໍາເຂົ້າສິນຄ້າ
                </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="CheckLessStock.php">ກວດສອບສິນຄ້າ</a>
               <a class="dropdown-item" href="OrderOut.php"> ຈັດຊື້ສິນຄ້າ</a>
        <a class="dropdown-item" href="importProduct.php"> ນໍາສິນຄ້າເຂົ້າ</a>
              </div>
          </li>
           </ul>
        <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <span class="fa fa-calendar"></span>  <?php
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?>
                        &nbsp;
                    </li> 
                </ul>
      </div>
    </div>
</nav> <!-- End nav -->
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div style="background-color: #7DA0B1">

                <div class="card" style="height: auto;  box-shadow: 1px 1px 1px 1px #1c7430">
                    <div class="row" style="margin-top: 3%">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div style="text-align: left">
                                <h5 style="margin-left: 5%">ລະຫັດສັ່ງຊື້ : <b style="color: red" id="import_id"> <?php echo $id = $_GET['id']; ?> </b></h5>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div style="text-align: right">
                                <h5 style="margin-right: 5%">ຜູ້ສັ່ງຊື້ : <b style="color: blue">
                                    
                                </b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height: auto; box-shadow: 1px 1px 1px 1px #B3E5FC">
                        <div  style="overflow: scroll;height: 800px">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="">
                                            <tr>
                                                <th style="background-color: #B3E5FC;text-align: center">ລະຫັດສິນຄ້າ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ເລືອກ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຊື່ສິນຄ້າ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຈໍານວນສັ່ງຊື້ອອກ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ລາຄາຊື້</th>
                                                 <th style="background-color: #B3E5FC;text-align: center">ກໍາໄລທີ່ຕ້ອງການ
                                                </th>
                                            </tr>
                                            <tbody>
                                                <?php 
                                                include("../db.php");
                                                    $sql1 = "select * from orderdetails where OrderID like '".$id."'";
                                                    $result = mysqli_query($conn,$sql1);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>

<tr>
    <td style="text-align: center" class="product_id"><?php echo $row['ProductID']?></td>
<td style="text-align: center" class="choose"><input type="checkbox" name="" class="checkforImport"></td>
    <td style="text-align: center" class="orderout_name"><?php echo $row['OrderDetail']?></td>
    <td style="text-align: center" class="orderout_qty">
    <input type="number" class="orderoutQty" name="" value="<?php echo $row['OrderQity']?>">

<!-- ຍັງບໍ່ຖືກ -->
<?php $Unit = "SELECT Unt.UnitName as Unt_name  from productunit as Unt INNER JOIN orders as ord WHERE ord.UnitID = Unt.UnitID and OrderID like '".$id."'";
                                        $typename1 = mysqli_query($conn,$Unit);

                                        while ($row = mysqli_fetch_assoc($typename1)) {
                                           ?>
                                            <?php echo $row['Unt_name']; 
                                        }
?>
</td>
<td style="text-align: center" class="bought_price"><input type="number" class="bought_Price" name=""></td>
<td style="text-align: center" class="income"><input type="number" id="income" class="income" name=""></td>
</tr>
                                                 <?php       
                                                    }

                                                 ?>
                                                

                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <div class="" style="text-align: right; margin-right: 10%">
                                        <a class="btn btn-outline-success" id="import_product">ນໍາເຂົ້າ</a>
                                    </div>
                                </li>
                            </ul>
                            <div style="margin-top: 3%">
                                <h6 style="color: #d39e00 ; text-align: center" id="Notification"></h6>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <a href="StoreImportToDb.php" class="btn btn-warning" id="btn_Import" style="display: none;">ຕົກລົງ</a>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

<script type="text/javascript">

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var orderOut = {
        'order_id':0,
        'detail':[

        ]
    }

    $(function () {
        $('.checkforImport').click(function () {

            $(this).parent().parent().children('td.bought_price').children('input.bought_Price').focus();
//            var choose = $(this)['0']['checked'];
            var orderout_id = $(this).parent().parent().children('td.product_id').text();
            var orderout_name = $(this).parent().parent().children('td.orderout_name').text();
            var orderout_qty = $(this).parent().parent().children('td.orderout_qty').children('input.orderoutQty').val();
            var bought_price = $(this).parent().parent().children('td.bought_price').children('input.bought_Price').val();

            var choose = $(this)['0']['checked'];
//            console.log($(this));
            if(choose){
//                console.log($('#import_id').text());
                orderOut['order_id'] = $('#import_id').text();
                orderOut['detail'].push({
                    'product_id':orderout_id,
                    'productname':orderout_name,
                    'orderout_qty':orderout_qty,
                    'bought_price':bought_price
                });

            }else{
                for(var i=0; i <  orderOut['detail'].length; i++) {
                    if(orderOut['detail'][i]['product_id'] == orderout_id) {
                        orderOut['detail'].splice(i, 1);
                        break;
                    }
                }

            }
            console.log(orderOut);
        });

    });

    $('.orderoutQty').change(function () {
        var choosen = $(this).parent().parent().children('td.choose').children('input.checkforImport')['0']['checked'];
        if (choosen) {
            var product_id = $(this).parent().parent().children('td.product_id').text();
            var qty = $(this).val();
            for(var i=0; i <  orderOut['detail'].length; i++) {
                if(orderOut['detail'][i]['product_id'] == product_id) {
                    orderOut['detail'][i]['orderout_qty'] = qty;
                    break;
                }
            }
        }
    });

         $('.income').change(function () {


       
            var product_id = $(this).parent().parent().children('td.product_id').text();
            var qty = $(this).val();
            for(var i=0; i <  orderOut['detail'].length; i++) {
                if(orderOut['detail'][i]['product_id'] == product_id) {

        var income =  $(this).parent().parent().children('td.income').children('input.income').val();

        var bought_price = $(this).parent().parent().children('td.bought_price').children('input.bought_Price').val();
        
        orderOut['detail'][i]['sale_price']=parseInt(bought_price)+parseInt(income);
        console.log(income);


                }
            }  
    });

    $('.bought_Price').change(function () {
        var choosen = $(this).parent().parent().children('td.choose').children('input.checkforImport')['0']['checked'];
        if (choosen) {
            var product_id = $(this).parent().parent().children('td.product_id').text();
            var qty = $(this).val();

            // console.log(product_id);
            for(var i=0; i <  orderOut['detail'].length; i++) {
                if(orderOut['detail'][i]['product_id'] == product_id) {
                    orderOut['detail'][i]['bought_price'] = qty;
                    break;
                }
            }
        }
    });
    $('#import_product').click(function () {

        if(orderOut['order_id'] != 0 && orderOut['detail'].length >0){
            $('#Notification').html("");

            $.ajax({
                type:'POST',
                url:'StoreImportToSession.php',
                data:orderOut,
                dataType:'JSON',
                success: function(data){ // What to do if we succeed
                    $("#Notification").html(data);
                    console.log(data);
                    document.getElementById('btn_Import').style.display = "block";
                }
            });

            

        }else{
            $('#Notification').html("ກລູນາກໍານົດຂໍ້ມູນໃຫ້ຄົບຖ້ວນ");
        }
    });
</script>


</html>