<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}
?>
<?php
include_once ('../../db.php') ; 	


	$CompanyName = $_POST['CompanyName'];
	$ContactName = $_POST['ContactName'];
	$SupAddress  = $_POST['SupAddress'];
	$SupTel 	 = $_POST['SupTel'];
	$SupEmail 	 = $_POST['SupEmail'];


	$saveitem="INSERT INTO supplier (SupID, CompanyName, ContactName, SupAddress, SupTel, SupEmail) VALUES ('', '$CompanyName','$ContactName','$SupAddress', '$SupTel', '$SupEmail')";

	if ($dbcon->query($saveitem)==TRUE) {
	echo "<script>";
	echo "alert('ບັນທຶກສຳເລັດ');";
	echo "window.location.href='../supplier.php';";
	echo "</script>";
}else{
	echo 'error'.$saveitem."</br>".$dbcon->error;
}

?>

	

