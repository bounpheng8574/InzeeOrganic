<?php
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}

?>
<?php
include("../db.php");
if(isset($_POST['Custsave']))
{

 $CustFirstName = $_POST['CustFirstName'];
 $CustAddress 	= $_POST['CustAddress'];
 $CustEmail     = $_POST['CustEmail'];
 $CustTel       = $_POST['CustTel'];
 $CustID 		= $_POST['CustID'];
 
 
$update_profile="UPDATE customers SET CustEmail='$CustEmail', CustFirstName='$CustFirstName', CustAddress='$CustAddress', CustTel='$CustTel'  where CustID='$CustID'";
    if(mysqli_query($dbcon,$update_profile))
    {
    $_SESSION['CustEmail'] = $CustEmail;
	echo "<script>alert('ການສັ່ງຊື້ສຳເລັດ!')</script>";
    echo"<script>window.open('success.php','_self')</script>";
    }else{
	 echo "<script>alert('ເກີດຂໍ້ຜິດພາດໃນການຕັ້ງຄ່າ!')</script>";
	
	}
}

?>
