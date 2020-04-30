<?php
 session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}
?>
<?php 
 $orderID=$_POST['order_no'];
 $supplier_no=$_POST['supplier_no'];
 $LoginUser=$_POST['LoginUser'];
 $P_Category=$_POST['CategoryName'];
  $P_Unit=$_POST['UnitID'];
 $product_detail=$_POST['detail'];


$_SESSION['orderID'] = $orderID;
$_SESSION['supplier_no'] = $supplier_no;
$_SESSION['LoginUser'] = $LoginUser;
$_SESSION['P_Category'] = $P_Category;
$_SESSION['P_Unit'] = $P_Unit;
$_SESSION['product_detail'] = $product_detail;

 echo json_encode("success");

?>