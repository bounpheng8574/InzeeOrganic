<?php
 session_start();
   include("../db.php");
   $imp_orderId = $_SESSION['imp_OrderId'];
   // $_SESSION['imp_productdetail'];
   
   foreach ($_SESSION['imp_productdetail'] as $key => $product) {
    // echo $product['product_id']."<br/>";
    $getproductStock = "select prod.ProductQuantity as stock from products as prod where prod.ProductID ='".$product['product_id']."' ";
    $stoct = mysqli_query($conn,$getproductStock);

    while ($row = mysqli_fetch_assoc($stoct)) {

      // echo $product['bought_price']."<br/>";
      
      $updateproduct = "UPDATE `products` SET `ProductPrice` = '".$product['sale_price']."', `ProductQuantity` = '".($row['stock']+$product['orderout_qty'])."' WHERE `products`.`ProductID` = '".$product['product_id']."' ";


      mysqli_query($conn,$updateproduct);
    }

    
   }

 

   $updateOrder = "update `orders` set status='1',importDate='".date('Y-m-d')."' where `orders`.OrderID = '".$imp_orderId."'";
   $result = mysqli_query($conn,$updateOrder);
    if($result){
      foreach ($_SESSION['imp_productdetail'] as $key => $import) {
    $updateproductdetail = "update `orderdetails` set DetailPrice ='".$import['bought_price']."' where `orderdetails`.OrderID = '".$_SESSION['imp_OrderId']."' and `orderdetails`.ProductID = '".$import['product_id']."' ";
    mysqli_query($conn,$updateproductdetail);
       }
      
    }
    // redirect to importProduct.php
   header('location:importProduct.php');
?>