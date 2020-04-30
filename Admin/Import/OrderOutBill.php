<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill</title>
    <link rel="shortcut icon" href="../../photo/logo2.png" type="image/x-icon">
        <link rel="stylesheet" href="../../node_modules/custom.css">
            <style type="text/css">
            body,td,th{font-family: Phetsarath OT;}
            @page{margin: 0;}
        </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
    <?php
     session_start();
     if(!$_SESSION['product_detail']){
        header('location:OrderOut.php');
     }

     include("../db.php");
     $sql = "insert into `orders` values('".$_SESSION['orderID']."','".date('Y-m-d')."','".$_SESSION['P_Category']."','".$_SESSION['P_Unit']."','".$_SESSION['supplier_no']."','0','') ";

     $query = mysqli_query($conn,$sql);
     if($query){
         foreach ($_SESSION['product_detail'] as $key => $product) {

            $sql2 = "insert into orderdetails values('','".$_SESSION['orderID']."','".$product['pro_id']."','".$product['pro_name']."','".$product['pro_price']."','".$product['qty']."')";
            $query2 = mysqli_query($conn,$sql2);
      
     }

    }


    // echo $_SESSION['orderID'];

    ?>
</head>
<body onclick="goBack();">
<div> <h4 align="center">ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h4>
            <h4 align="center">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</h4>
            <h5 style="text-align: center" id="showtest">-----oooo-----</h5>
        </div> <br>

    <div class="row">
        <div class=" col-md-1 col-lg-1 col-xl-1">

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <p><img src="../../photo/icon1.jpeg" style="width: 80px; height: 80px;"></p>
            
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 text-right">
                <!-- <p><h5><b>ຂໍ້ມູນເພີ່ມເຕີມ</b></h5></p>
                <hr style="width: 50%; margin-right: 0px; background-color: #c82333"> -->
                <p>ຮ້ານ ອິນຊີບ້ານເຮົາ</p>
                <p>ບ. ສົມຫວັງ, ມ.ຫາດຊາຍຟອງ, ນະຄອນຫຼວງວຽງຈັນ</p>
                <p>ອີເມວ: Vaijai_Trading@gmail.com</p>
                <p>ເບີໂທລະສັບ: 030 53 32 224</p>
            </div>
        </div>
       

        <div class="container container-fluid">
            <div class="row" style="margin-top: 2%">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <td><div class="div_in_td"><b>ລໍາດັບ</b></div></td>
                                <td><div class="div_in_td"><b>ຊື່ສິນຄ້າ</b></div></td>
                                <td><div class="div_in_td"><b>ປະເພດສິນຄ້າ</b></div></td>
                                <td><div class="div_in_td"><b>ຈໍານວນສັ່ງຊື້</b></div></td>
                            </tr>
                            </thead>
                            <tbody>
                             <?php
                             $i=0;
                            foreach ($_SESSION['product_detail'] as $key => $order_product) {
                                ?>
                                <tr>
                                    <td><?php echo ($i+1) ?></td>
                                    <td><?php echo $order_product['pro_name'];?></td>
                                    

                                       <?php
                                        $producttype = "SELECT ctg.CategoryName as ctg_name  from categories as ctg INNER JOIN products as prod where prod.CategoryName = ctg.CategoryID AND prod.ProductID='".$order_product['pro_id']."' ";
                                        
                                        $typename = mysqli_query($conn,$producttype);

                                        while ($row = mysqli_fetch_assoc($typename)) {
                                           ?>
                                            <td><?php echo $row['ctg_name']; ?></td>
                                           <?php
                                        }
                                       ?>
                                            
                                        
                                    <td><?php echo $order_product['qty'];
                                    
                                        $Unit = "SELECT Unt.UnitName as Unt_name  from productunit as Unt INNER JOIN products as prod where prod.UnitID = Unt.UnitID AND prod.ProductID='".$order_product['pro_id']."' ";
                                        $typename1 = mysqli_query($conn,$Unit);

                                        while ($row = mysqli_fetch_assoc($typename1)) {
                                           ?>
                                            <?php echo $row['Unt_name']; 
                                        }
                                      

                                    ?></td>

                                </tr>

                                <?php
                                $i++;
                            }

                             ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<div class="mainConten">
        <div class="row">
            <div class=" col-md-1 col-lg-1 col-xl-1">

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <p><h5><b>ຂໍ້ມູນຜູ້ສະໜອງ</b></h5></p>
                <hr style="width: 50%; margin-left: 0px; background-color: #c82333">
                <?php
                                        $supplier = "select * from `supplier` where `supplier`.SupID= '".$_SESSION['supplier_no']."' ";

                                        $sp = mysqli_query($conn,$supplier);

                                        while ($sp_infor= mysqli_fetch_assoc($sp)) {
                                           ?>
                                            <b> ຊື່ຮ້ານ :</b> <?php echo $sp_infor['CompanyName']  ?><br/>
                                            <b>  ຊື່ຜູ້ສະໜອງ :</b> <?php echo $sp_infor['ContactName']  ?>   <br/>
                                            <b>  ທີ່ຢູ່ :</b> <?php echo $sp_infor['SupAddress']  ?>  <br/>
                                            <b>  ໂທລະສັບ :</b>  <?php echo $sp_infor['SupTel']  ?>  <br/>
                                            <b>  ອີເມວ :</b> <?php echo $sp_infor['SupEmail']  ?> <br/>
                                      <?php
                                       }
                                       ?>


                


            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 text-right">
                <p><h5><b>ຂໍ້ມູນເພີ່ມເຕີມ</b></h5></p>
                <hr style="width: 50%; margin-right: 0px; background-color: #c82333">
                <b>ລະຫັດໃບບິນ:</b><label style="margin-left: 20px"><?php echo $_SESSION['orderID']; ?></label><br/>
                <b>ສັ່ງຊື້ໂດຍ : </b><label style="margin-left: 20px"><?php echo $_SESSION['LoginUser']; ?></label><br/>
                <b>ວັນທີ: <?php  echo date("d/m/Y");?><br/>
            </div>
        </div>
    </div>
        <hr>
        <!-- <div style="margin-top: 10px;margin-bottom: 10px; text-align: right; margin-right: 20px">
            <a href="../index.php" id="btn_backToOrder" class="btn btn-success" style="display: block; float: right;"><b>ໜ້າຫຼັກ</b></a>
        </div> -->
        <div class="text-center">
            <a id="saveBill" onclick="saveBill()" class="btn btn-warning" style=" width: 130px"><b>ພີມໃບຈັດຊື້</b></a>
        </div>
        <!-- <h3 style="text-align: center" id="showtest">-----oooo-----</h3> -->
        <div>
          

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

<script type="text/javascript">
    function saveBill(){
        // document.getElementById('btn_backToOrder').style.display="none";
        document.getElementById('showtest').style.display="none";
        document.getElementById('saveBill').style.display="none";
        window.print();
        document.getElementById('btn_backToOrder').style.display="block";
        // document.getElementById('showtest').style.display="block";
        document.getElementById('saveBill').style.display="block";
    }
    function goBack(){
    window.open('../index.php','_self');
    }
</script>




</html>

