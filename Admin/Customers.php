<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}
?>
<?php
    require_once '../config.php';
    
    if(isset($_GET['delete_id']))
    {
        $stmt_delete = $DB_con->prepare('DELETE FROM customers WHERE CustID =:CustID');
        $stmt_delete->bindParam(':CustID',$_GET['delete_id']);
        $stmt_delete->execute();
        
        header("Location: customers.php");
    }

?>
<?php
    require_once '../config.php';
    
    if(isset($_GET['SellID']))
    {
// ຕັດສະຕ໊ອກ ແລະ ນັບຈຳນວນຖ້າສັ່ງບໍ່ເກິນ 50,000 ກີບຈະບໍ່ສົ່ງ
//     include("../db.php");
//     if ($_POST['deletestock']) {
//       $ProductID = $_POST['ProductID'];
//       $CustID = $_POST['CustID'];
//       $ProductQuantity = $_POST['ProductQuantity']; 
//       $Sell_Qty = $_POST['Sell_Qty'];
//       $Sell_Price = $_POST['Sell_Price'];
//       $DeleteStock =$ProductQuantity - $Sell_Qty;

//       if ($Sell_Price<=50000) {
//         echo "<script>alert('ສິນຄ້າໜ້ອຍກ່ອນ 50,000 ກີບ!')</script>";
//         echo "<script>window.history.go(-1);</script>";
//       }else{
//           $sql = mysqli_query($dbcon, "UPDATE Products set ProductQuantity = '$DeleteStock' where ProductID='$ProductID'");
//     echo "<script>alert('ທ່ານໄດ້ສັ່ງສິນຄ້າແລ້ວ!')</script>";       
//     echo "<script>window.open('customers.php','_self')</script>";
//     }
// }
        $stmt_delete = $DB_con->prepare('UPDATE sellproduct SET Sell_Status="Ordered_Finished"  WHERE CustID =:CustID and Sell_Status="Ordered"');
        $stmt_delete->bindParam(':CustID',$_GET['SellID']);
        $stmt_delete->execute();
        
        header("Location: customers.php");
    }

?>
<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Page</title>       
        <?php include_once 'include/libraryadmin.php';?>
    </head>
    <body>
    <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <div class="container">
             <?php include_once 'include/icon.php';  ?>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php"><span class='fa fa-home'></span>ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ຈັດການລູກຄ້າ 
              </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="Customers.php">ຈັດການລູກຄ້າ</a>
            <a class="dropdown-item" href="Selldetails.php">ລາຍລະອຽດການຈອງຂອງລູກຄ້າ </a>
             <a class="dropdown-item" href="Sellsuccess.php">ສິນຄ້າທີ່ຂາຍແລ້ວ </a>
             <!-- <a class="dropdown-item" href="previous_sell.php">ການຂາຍທີ່ຜ່ານມາ  </a>
             <a class="dropdown-item" href="views_sell.php">ກວດສອບການຂາຍ  </a> -->
            </div>
            </li>
              </ul>
              <?php include_once 'include/session.php';?>
          </div>
      </div>
  </nav>
    <!-- manage customer -->
     <div id="page-wrapper">        
        <div class="">  
        <br/>                    
          <center> <h3><strong>ກວດສອບລູກຄ້າ</strong> </h3></center>   
           </div>
         <br />
         <form action="" method="POST">
          <td><input class="form-control" type="hidden" name="ProductID" value="<?php echo $ProductID; ?>" /></td>
          <td><input class="form-control" type="hidden" name="CustID" value="<?php echo $CustID; ?>" /></td>
          <td><input type="hidden" name="ProductQuantity" id="ProductQuantity" value="<?php echo $ProductQuantity; ?>"></td>
          <td><input type="hidden" name="Sell_Qty" id="Sell_Qty" value="<?php echo $Sell_Qty; ?>"></td>
          <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຊື່ອີເມວລູກຄ້າ</th>
                  <th>ລະຫັດຜ່ານ</th>
                  <th>ຊື່</th>
                  <th>ທີ່ຢູ່</th>
                  <th>ເພດ</th>
                  <th>ຊ່ອງທາງຕິດຕໍ່</th>
                  <th>ດຳເນີນການ</th>
                </tr>
              </thead>
              <tbody>
              <?php
include("../config.php");
    $stmt = $DB_con->prepare('SELECT * FROM customers');
    $stmt->execute();
        
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);                      
            ?>
                <tr>
                 <td><?php echo $CustEmail; ?></td>
                 <td><?php echo $CustPassword; ?></td>
                 <td><?php echo $CustFirstName; ?> <?php echo $CustLastName; ?></td>
                 <td><?php echo $CustAddress; ?></td>  
                 <td><?php echo $CustSex; ?></td>
                 <td>ເບີໂທ:<?php echo $CustTel; ?><br/>
                   FB:<?php echo $CustFace; ?><br/>
                   Whatsapp:<?php echo $CustWhat; ?><br/>
                 </td>
                 
                         
                 <td>
                <!-- check -->
                 <a class="btn btn-success" href="views_sell.php?view_id=<?php echo $row['CustID']; ?>"><span class='fa fa-shopping-cart'></span> ລາຍລະອຽດການສັ່ງຈອງ</a> 
<!-- new add -->
                 <!-- <a class="btn btn-danger" href="notify.php?notify=payment&cid=<?php //echo $row['CustID']; ?>" title="ຄລິກເພື່ອດຳເນີນການ" onclick="return confirm('ທ່ານຈະປິດການຂາຍຂອງລູກຄ້າຄົນນີ້ຫຼືບໍ່?')" target="_blank"><span class='fa fa-cash'></span> ແຈ້ງການຊຳລະເງິນ</a>
                 <a class="btn btn-secondary" href="notify.php?notify=delivery&cid=<?php //echo $row['CustID']; ?>" title="ຄລິກເພື່ອດຳເນີນການ" onclick="return confirm('ທ່ານຈະປິດການຂາຍຂອງລູກຄ້າຄົນນີ້ຫຼືບໍ່?')" target="_blank"><span class='fa fa-cash'></span> ແຈ້ງຫຼັງການສົ່ງສິນຄ້າ</a> -->
                 <a class="btn btn-warning text-white" href="?SellID=<?php echo $row['CustID']; ?>" title="ຄລິກເພື່ອດຳເນີນການ" onclick="return confirm('ທ່ານຈະປິດການຂາຍຂອງລູກຄ້າຄົນນີ້ຫຼືບໍ່?')">
                  <span class='fa fa-check'></span>
                 ປິດການສັ່ງຈອງ</a>
                 <a class="btn btn-primary" href="previous_sell.php?previous_id=<?php echo $row['CustID']; ?>"><span class='fa fa-history'></span> ລາຍການສັ່ງຈອງສິນຄ້າທີ່ຜ່ານມາ</a>  
<!-- end -->
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['CustID']; ?>" title="click for delete" onclick="return confirm('ຈະລົບບັນຊີລູກຄ້າທ່ານນີ້ຫຼືບໍ່?')">
                  <span class='fa fa-trash'></span>
                  ລຶບບັນຊີ</a>
                
                  </td>
                </tr>
               
              <?php
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</form>";
        echo "<br />";
        echo '
        <div class=""     




        </div>';
    
        echo "</div>";
    }
    else
    {
        ?>
        
            
        <div class="col-xs-12">
            <div class="alert alert-warning">
                <span class="fa fa-info-sign"></span> &nbsp; ບໍ່ພົບຂໍ້ມູນໃດໆ ...
            </div>
        </div>
        <?php }?>   
    </div>
    </div>
    
    <br />
    <br />       
       <?php include '../include/footer.php'; ?> 
   <?php include_once 'include/showdatatables.js';?>

    </body>
    </html>
