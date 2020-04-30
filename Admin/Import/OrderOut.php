
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OrderOut</title>
<link rel="shortcut icon" href="../../photo/logo2.png" type="image/x-icon">
<link rel="stylesheet" href="../../node_modules/custom.css">  
        <style type="text/css">
            body,td,th{font-family: Phetsarath OT;}
        </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
   <?php  session_start();   ?>

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
            <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="../logout.php">
                                <span class="fa fa-power-off"></span> ອອກລະບົບ</a></li>
                        </ul>
                    </li>
                </ul>
      </div>
    </div>
</nav> <!-- End nav -->
<div class="" style="margin-top: 10px">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <div style="background-color: #7DA0B1">
                <div class="card" style="height: auto;  box-shadow: 1px 1px 1px 1px #1c7430">
                    <br>
                    
                    <div class="card-body" style="height: auto; box-shadow: 1px 1px 1px 1px #B3E5FC" id="maincontain">
                        <!-- <div style="text-align: right;">
                            <a href="../index.php" class="btn btn-success" style="margin-right: 10px">ໜ້າຫຼັກ</a>
                        </div> -->
                        <br>
                        <div  style="overflow: scroll;height: 800px">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="">
                                            <tr>
                                                <th style="background-color: #B3E5FC;text-align: center">ລະຫັດສິນຄ້າ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ເລືອກ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຮູບພາບ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຊື່ສິນຄ້າ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຈຳນວນສິນຄ້າໃນສາງ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຈຳນວນນຳເຂົ້າໃໝ່</th>
                                            </tr>

                                            <?php

                                            include("../../config.php");
    
    $stmt = $DB_con->prepare('SELECT * FROM products order by ProductQuantity Asc');
    $stmt->execute();
    
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);      
            ?>
            
                                <tr>
                                  

                                 <td class="id"><?php echo $row['ProductID']; ?></td>

                                 <td class="choose"> <input type="checkbox" name="" class="cbChoose"></td>

                                 <td>
                                <center> <img src="../images/<?php echo $ProductImage; ?>" class="img img-rounded"  width="50" height="50" /></center>
                                 </td>

                                 
                                  <td class="pro_name"><?php echo $row['ProductName'];?>
                                    <input type="text" class="pro_price" id="pro_price" value="<?php echo $row['ProductPrice'] ; ?>" hidden>
                                    </td>
                                 
                                 <td><?php echo $row['ProductQuantity'] ; ?>
                                     <?php 
                include '../db.php';
                 $sel = mysqli_query($conn, "SELECT * FROM productunit WHERE UnitID='$UnitID'");

                 while ($r = mysqli_fetch_array($sel)) {
                     echo $r['UnitName'];
                 }
                                 ?> 
                                     
                                 </td>
                                 <td class="tdQty">

                                    <input type="number" value="" name="qty" class="qty">

                                    <input type="text" class="CategoryName" id="CategoryName" value="<?php echo $row['CategoryName']; ?>" hidden>

                                    <input type="text" class="UnitID" id="UnitID" value="<?php echo $row['UnitID']; ?>" hidden>


                                </td> 

                                </tr>
               
                      <?php
                      }
                
                    }
            
                      ?>  
                                           
   
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                  

                    <div class="card-body" style="height: auto; box-shadow: 1px 1px 1px 1px #B3E5FC; display: none" id="searContent">
                        <div  style="overflow: scroll;height: 800px">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="">
                                            <tr>
                                                <th style="background-color: #B3E5FC;text-align: center">ລະຫັດສິນຄ້າ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ເລືອກ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຮູບພາບ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">ຊື່ສິນຄ້າ</th>
                                                <th style="background-color: #B3E5FC;text-align: center">stock</th>
                                                <th style="background-color: #B3E5FC;text-align: center">qty</th>
                                            </tr>
                                            <tbody id="searchTable">

                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class="card" style="height: auto;box-shadow: 1px 1px 1px 1px #B3E5FC">
                <br>
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-xl-2">

                          
    <input type="text" class="LoginUser" id="LoginUser" value="<?php  echo(  $_SESSION['admin_username'] ) ?>" hidden>
                        </div>
                        <div class="col-md-8 col-lg-8 col-xl-8">
                            <h4>ເລືອກຜູ້ສະໜອງ</h4>



                            <select name="productType" id="supplier" class="form-control">
                                <option value="">ເລືອກຜູ້ສະໜອງ...</option>
                                    
                        <?php
                           $stmt = $DB_con->prepare('SELECT * FROM supplier order by SupID Asc');
                            $stmt->execute();
    
                     if($stmt->rowCount() > 0){
                         while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);      
                       ?>
                <option value="<?php echo $row['SupID']?>"><?php echo $row['CompanyName'];?></option>

                                    <?php
                              }
                        
                            }
                    
                              ?> 
                                       
                            </select>




                            <br>
                            <br>
                            <h4>ລະຫັດໃບຈັດຊື້</h4>


                       <?php
                           $stmt = $DB_con->prepare('SELECT MAX(OrderID) as orderID FROM orders');
                            $stmt->execute();
    
                         if($stmt->rowCount() > 0){
                         while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row); 



                       ?>

                            <input type="text" name="billOrderId"  id="billOrderId" class="form-control billOrderId" value="<?php echo($row['orderID']+1) ?>" disabled="">

                        <?php
                              }
                        
                            }
                    
                        ?>     
                        </div>
                        <div class="col-md-2 col-lg-3 col-xl-2">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <br>
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xl-3">

                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6" style="text-align: center">
                                <input type="button" class="btn btn-success" value="ຕົກລົງ" name="OrderOut" id="OrderOut">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div>
                <h6 style="color: #d39e00" id="Notification"></h6>
            </div>
            <br>
            <br>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="text-align: center">
                    <a href="OrderOutBill.php" class="btn btn-warning" id="printBill" style=" display: none; width: auto">ສ້າງໃບບິນ</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="text-align: center">
                    <a href="" class="btn btn-danger" id="cancelPrntBill" style=" display: none; width: auto">ຍົກເລີກ</a>
                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var order = {

        order_no: 0,
        supplier_no: 0,
        LoginUser: null,
        CategoryName: null,
        UnitID:null,
        detail: [
        ]
    }

    $(function () {
        $('.cbChoose').click(function () {

            var choose = $(this)['0']['checked'];
            var id = $(this).parent().parent().children('td.id').text();
            var productName = $(this).parent().parent().children('td.pro_name').text();
            var p_price = $(this).parent().parent().children('td.pro_name').children('input.pro_price').val();
            var P_Category = $(this).parent().parent().children('td.tdQty').children('input.CategoryName').val();
            var P_Unit = $(this).parent().parent().children('td.tdQty').children('input.UnitID').val();
            if(choose) {
                $(this).parent().parent().children('td.tdQty').children('input.qty').val(1);
                $(this).parent().parent().children('td.tdQty').children('input.qty').focus();
                order['CategoryName']= P_Category;
                order['UnitID']= P_Unit; 
                order['order_no']= $("#billOrderId").val();
                order['LoginUser']= $('#LoginUser').val();

                order['detail'].push({
                    pro_id: id,
                    pro_name:productName,
                    pro_price:p_price,
                    qty: 1,
                });
                console.log(order);
            } else {
                for(var i=0; i <  order['detail'].length; i++) {
                    if(order['detail'][i]['pro_id'] == id) {
                        order['detail'].splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().children('td.tdQty').children('input.qty').val("");
                console.log(order);
            }
        });
    });

    $('#supplier').change(function () {
        if($("#supplier").val() != ""){
            order['supplier_no']= $("#supplier").val();
        }else{
            order['supplier_no']= $("#supplier").val();
        }
    });

    $('.qty').change(function () {

        var choosen = $(this).parent().parent().children('td.choose').children('input.cbChoose')['0']['checked'];
        if (choosen) {
            var id = $(this).parent().parent().children('td.id').text();
            var qty = $(this).val();
            for(var i=0; i <  order['detail'].length; i++) {
                if(order['detail'][i]['pro_id'] == id) {
                    order['detail'][i]['qty'] = qty;
                    break;
                }
            }
        }

    });



    $('#OrderOut').click(function () {

       /*var a = confirm("OK");
       if(a == true){
         
       }*/

        if(order['supplier_no'] !=0 && order['order_no'] !=0 && order['detail'].length >0){
            $('#Notification').html("");

            $.ajax({
                url:'storeOrderlistToSession.php',
                type:'POST',
                data:order,
                dataType : 'json',
                
                success: function(data){ // What to do if we succeed
                    console.log(data);
                    
                    $("#Notification").html(data);
                    document.getElementById('printBill').style.display = "block";
                    document.getElementById('cancelPrntBill').style.display = "block";
                }
            });
        }else{
            $('#Notification').html("ກລູນາກໍານົດຂໍ້ມູນໃຫ້ຄົບຖ້ວນ");
        }

    });

    $('#productType').change(function () {
//        console.log($(this).val());
        if($(this).val() != ""){
            var ptype_id = $(this).val();
            $.ajax({
                url:'',
                type:'POST',
                dataType:'JSON',
                success: function(data){
                    console.log(data);

                    if(data.length>0){
                        var seardetail = '';
                        for (var i=0;i<data.length;i++){
                            console.log(data);
                            seardetail += `
                                <tr>
                                    <td  class="id"> ${data[i]['id']} </td>
                                    <td  class="choose"> <input class="cbChoose" type="checkbox" name="checkproduct"> </td>
                                    <td>  <img class="img-responsive" src="http://localhost:8000/img/${data[i]['productimage'][0]['image']}" alt="http://localhost:8000/img/nopic.jpg" style="width: 90px; height: 100px">  </td>
                                    <td  class="pro_name"> ${data[i]['pro_name']} </td>
                                    <td> ${data[i]['stock']}  </td>
                                    <td class="tdQty">
                                        <input class="qty" type="number" name="qty">
                                        <input class="productType" type="text" name="productType" value="${data[i]['producttype']['ptype_name']}" hidden>
                                    </td>
                                </tr>

                            `;
                        }
                        $('#searContent').show();
                        $('#searchTable').html(seardetail);
                    }

                    $('#maincontain').hide();

                }
            });
        }else{
            $('#maincontain').show();
            $('#searContent').hide();
        }

    });


</script>
</html>