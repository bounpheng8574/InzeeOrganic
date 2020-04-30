<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Page</title>
        <?php include_once '../supplier/library.php';?>
        <style>
            @page{
                margin:0;
            }
        </style>
    </head>
    <body onload="">
        
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
         <br />
          <div class="container"> 
          <center> <h3><strong>ຕາຕະລາງກວດສອບສິນຄ້າ</strong> </h3>
   </center>                      
            <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຮູບສິນຄ້າ</th>
                  <th>ລະຫັດສິນຄ້າ</th>
                  <th>ຊື່ສິນຄ້າ</th>
                  <th>ລາຄາ</th>
                  <th>ປະເພດສິນຄ້າ</th> 
                  <th>ຫົວໜ່ວຍສິນຄ້າ</th> 
                  <th>ສະຕ໊ອກສິນຄ້າ</th> 
                  <th>ລາຍລະອຽດສິນຄ້າ</th>
                  <th>ວັນທີທີ່ເພິ່ມຂໍ້ມູນ</th>
                 
                </tr>
              </thead>
              <tbody>
              <?php
include("../../config.php");
    
    $stmt = $DB_con->prepare('SELECT * FROM products where ProductQuantity <= 10 order by ProductID Asc');
    $stmt->execute();
    
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);      
            ?>
            
                <tr>
                  <td>
                <center> <img src="../images/<?php echo $ProductImage; ?>" class="img img-rounded"  width="50" height="50" /></center>
                 </td>
                 <td><?php echo $ProductID; ?></td>
                 <td><?php echo $ProductName; ?></td>
                 <td> <?php echo $ProductPrice; ?> ກີບ</td>
                 <td><?php 
                 include '../../db.php';
                 $sel = mysqli_query($dbcon, "SELECT * FROM categories WHERE CategoryID='$CategoryName'");

                 while ($r = mysqli_fetch_array($sel)) {
                     echo $r['CategoryName'];
                 }
                  ?></td>
                 <td><?php 
                 include '../db.php';
                 $sel = mysqli_query($dbcon, "SELECT * FROM productunit WHERE UnitID='$UnitID'");

                 while ($r = mysqli_fetch_array($sel)) {
                     echo $r['UnitName'];
                 }
                  ?></td>
                 <td><?php echo $ProductQuantity; ?></td> 
                 <td> <?php echo $Description; ?>  </td>
                 <td><?php echo $ProductUpdateDate; ?></td>
                </tr>
               
              <?php
        }
        
    }else{
      ?>
        <div class="col-xs-12">
          <div class="alert alert-warning">
              <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ບໍ່ພົບຂໍ້ມູນໃດໆ ...
            </div>
        </div>
        <?php
  }
?>  
        </tbody>
        </table>
        </div>
    </div>
    <?php include '../../include/footer.php'; ?>
    </body>
    </html>
