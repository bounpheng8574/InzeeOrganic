<?php
include_once ('../db.php') ;  
if (isset($_POST['accconfirm'])) {
      $CustID = $_POST['CustID'];
      $accbank = $_POST['accbank'];
      $accno = $_POST['accno'];
      $accname = $_POST['accname'];     
      $saveitem="INSERT INTO payment (accname, accno, accbank, CustID, PaymentDate) VALUE ('$accname','$accno','$accbank', '$CustID',CURDATE())";
      mysqli_query($dbcon, $saveitem);
      echo "<script>alert('ບັນທຶກຂໍ້ມູນຂອງທ່ານສຳເລັດແລ້ວ!')</script>";                        
      echo "<script>window.open('success.php','_self')</script>";
      }else{             
      echo "<script>alert('error!')</script>";
}
?>