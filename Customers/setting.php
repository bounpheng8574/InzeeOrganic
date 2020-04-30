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
 $CustLastName 	= $_POST['CustLastName'];
 $CustSex		= $_POST['CustSex'];
 $CustAddress 	= $_POST['CustAddress'];
 $CustEmail     = $_POST['CustEmail'];
 // $CustUserName  = $_POST['CustUserName']; 
 $CustPassword 	= $_POST['CustPassword'];
 $CustBirthdate	= $_POST['CustBirthdate'];
 $CustTel       = $_POST['CustTel'];
 $CustFace       = $_POST['CustFace'];
 $CustWhat       = $_POST['CustWhat'];
 $CustID 		= $_POST['CustID'];
 
 
$update_profile="UPDATE customers SET CustEmail='$CustEmail', CustUserName='$CustUserName', CustPassword='$CustPassword', CustFirstName='$CustFirstName', CustLastName='$CustLastName', CustAddress='$CustAddress', CustSex= '$CustSex', CustBirthdate='$CustBirthdate', CustTel='$CustTel', CustFace='$CustFace', CustWhat='CustWhat' where CustID='$CustID'";
    if(mysqli_query($dbcon,$update_profile))
    {
    $_SESSION['CustEmail'] = $CustEmail;
	 echo "<script>alert('ຂໍ້ມູນບັນຊີຂອງທ່ານໄດ້ຖືກປ່ຽນແປງ!')</script>";
         echo"<script>window.open('index.php','_self')</script>";
    }else{
	 echo "<script>alert('ເກີດຂໍ້ຜິດພາດໃນການຕັ້ງຄ່າ!')</script>";
	
	}
}

?>

