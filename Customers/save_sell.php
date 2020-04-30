<?php
include("../db.php");
if(isset($_POST['Sell_save']))
{
$ProductID = $_POST['ProductID'];
$CustID = $_POST['CustID'];
$Sell_name = $_POST['Sell_name'];
$Sell_Cat = $_POST['Sell_Cat'];
$Sell_Unit = $_POST['Sell_Unit'];
$Sell_Price = $_POST['Sell_Price'];
$ProductQuantity = $_POST['ProductQuantity']; 
$Sell_Qty = $_POST['Sell_Qty'];
// $DeleteStock =$ProductQuantity - $Sell_Qty; 
$Sell_total=$Sell_Price * $Sell_Qty;
$Sell_status='Pending';

// if($Sell_total>=50000){

	if ($Sell_Qty > $ProductQuantity) {
	echo "<script>alert('ສິນຄ້າທີ່ສັ່ງເກີນຈຳນວນສິນຄ້າໃນສາງ!')</script>";
	echo "<script>window.history.go(-1);</script>";
}elseif ($Sell_Qty<=0) {
	echo "<script>alert('ກະລຸນາປ້ອນຈຳນວນສິນຄ້າຕັ້ງແຕ່ 1 ຂຶ້ນໄປ!')</script>";
	echo "<script>window.history.go(-1);</script>";
}else{
  // $sql = mysqli_query($dbcon, "UPDATE Products set ProductQuantity = '$DeleteStock' where ProductID='$ProductID'");
		$save_order_details="INSERT INTO sellproduct 
		(ProductID, CustID, Sell_name, Sell_Price, Sell_Qty, Sell_total, Sell_status, Sell_Cat, Sell_Unit, Sell_date) VALUE ('$ProductID', '$CustID','$Sell_name','$Sell_Price','$Sell_Qty','$Sell_total','$Sell_status', '$Sell_Cat', '$Sell_Unit',CURDATE())";
		mysqli_query($dbcon,$save_order_details);
		echo "<script>alert('ສິນຄ້າໄດ້ຖືກເກັບເຂົ້າກະຕ່າແລ້ວ!')</script>";				
		echo "<script>window.open('cart_items.php','_self')</script>";

}


/*}
		echo "<script>alert('ທ່ານຕ້ອງຊື້ສິນຄ້າໃຫ້ຄົບລາຄາ 50.000ກີບ ຂຶ້ນໄປຈຶ່ງຈະຈັດສົ່ງສິນຄ້າ!')</script>";				
		echo "<script>window.open('add_to_cart.php','_self')</script>";*/


}

?>
