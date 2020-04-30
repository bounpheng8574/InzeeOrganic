<?php
session_start();

?>
<?php
include("db.php");
if(isset($_POST['register']))
{
$CustFirstName  = $_POST['CustFirstName'];
$CustLastName   = $_POST['CustLastName'];
$CustSex		= $_POST['CustSex'];
$CustAddress    = $_POST['CustAddress'];
$CustEmail      = $_POST['CustEmail'];
$CustFace      = $_POST['CustFace'];
// $CustUserName   = $_POST['CustUserName'];
$CustPassword   = $_POST['CustPassword'];
$CustBirthdate	= $_POST['CustBirthdate'];
$CustWhat      = $_POST['CustWhat'];
$CustTel        = $_POST['CustTel'];

$check_user    = "SELECT * FROM customers WHERE CustEmail='$CustEmail' AND CustPassword='$CustPassword'";
    $run_query=mysqli_query($dbcon,$check_user);
    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('ມີຂໍ້ມູນຊ້ຳກັນ, ກະລຸນາປ້ອນຂໍ້ມູນໃໝ່!')</script>";
 echo"<script>window.history.go(-1)</script>";
exit();
    }
 
$saveaccount="INSERT INTO customers (CustFirstName, CustLastName, CustSex, CustAddress, CustEmail, CustFace, CustPassword, CustBirthdate, CustWhat, CustTel ,Delivery, datecreate) VALUE ('$CustFirstName','$CustLastName', '$CustSex','$CustAddress','$CustEmail', '$CustFace', '$CustPassword', '$CustBirthdate', '$CustWhat', '$CustTel', 'ຍັງ', NOW())";

	mysqli_query($dbcon,$saveaccount);
   if (!$_SESSION['CustEmail'] = $CustEmail){
    header("Location: ../index.php");
   }

	echo "<script>alert('ລົງທະບຽນສຳເລັດ!')</script>";
    echo"<script>window.open('customers/index.php','_self')</script>";

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
			<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inzee Organic Laos,LTD</title>
     <link rel="shortcut icon" href="" type="image/x-icon" />
		<!-- Bootstrap CSS -->
		 <?php 
     include_once 'include/library.php';   ?> 
	<style>
		body{
		background-image: url("photo/cover1.jpg");
		width: 100%;
		height: auto;
		background-size: cover;
		}
	</style>
	</head>
	<body> 
<body> 
	 <div class=""> <?php 
     include_once 'include/header.php';   ?>  
 </div>   
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto mt-5">
			 	<div class="card" style="background-color: lightgreen; background-repeat: cover;">
			 	<form role="form" action="" method="POST">
			 		<div class="card-header text-center" style="font-size: 25px;">
			 			<b>ໜ້າລົງທະບຽນເປັນສະມາຊິກ</b>
			 		</div>	
			 			<div class="card-body">
			 				<div class="form-group row">
			 					<label for="firstname" class="col-form-label col-sm-3">ຊື່ແທ້</label>
			 			<div class="col-sm-9">
			 						<input type="text" class="form-control" name="CustFirstName" placeholder="ປ້ອນຊື່" required/>
			 			</div>
			 			</div>
			 		<div class="form-group row">
			 				<label for="lastname" class="col-form-label col-sm-3">ນາມສະກຸນ</label>
			 		<div class="col-sm-9">
			 				<input type="text" class="form-control" name="CustLastName" placeholder="ປ້ອນນາມສະກຸນ" required/>
			 		</div>
			 		</div>
			 		  <!-- <div class="form-group">
			    <label for="LastName">ນາມສະກຸນ</label>
			    <input type="text" class="form-control" name="LastName" required/>
			  </div>  -->
			  <div class="form-group">
			    <label for="Sex">ເພດ</label>
			    <div class="radio" required>
			 <div class="radio">
			   	<label>
			   		<input type="radio" name="CustSex" id="male" value="ຊາຍ" checked>
			   		ເພດຊາຍ
			   	</label>
			   </div>
			   <div class="radio">
			   	<label>
			   		<input type="radio" name="CustSex" id="female" value="ຍິງ">
			   		ເພດຍິງ
			   	</label>
			   </div>
			  </div>
			</div>
			 		<div class="form-group row">
      				<label for="address" class="col-form-label col-sm-3">ທີ່ຢູ່ລູກຄ້າ</label>
      				<textarea class="form-control" rows="3" id="address" name="CustAddress"></textarea>
    				</div>
    				<div class="form-group row">
      				<label for="Email" class="col-form-label col-sm-3">ອີເມວ<i class="fa fa-envelope-o"></i></label>
      				<div class="col-sm-9">
			 		<input type="email" class="form-control" name="CustEmail" placeholder="ປ້ອນອີເມວເຊັ່ນວ່າ: YourEmail@gmail.com" required/>
			 		</div>   				
			 	</div>
			 	<div class="form-group row">
      				<label for="Email" class="col-form-label col-sm-3"><i class="fa fa-facebook"></i></label>
      				<div class="col-sm-9">
			 		<input type="text" class="form-control" name="CustFace" placeholder="ປ້ອນຊື່ ຫຼື ອີເມວທີໃຊ້ໃນ facebook" required/>
			 		</div>   				
			 	</div>
    				<!-- <div class="form-group row">
      				<label for="username" class="col-form-label col-sm-3">ຊື່ຜູ້ໃຊ້</label>
      				<div class="col-sm-9">
			 		<input type="text" class="form-control" name="CustUserName" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້" required/>
			 		</div>   				
			 	</div> -->
			 	<div class="form-group row">
      				<label for="username" class="col-form-label col-sm-3">ລະຫັດຜ່ານ</label>
      				<div class="col-sm-9">
			 		<input type="password" class="form-control" name="CustPassword" placeholder="ປ້ອນຫັດຜ່ານຂອງທ່ານ" required/>
			 		</div>   				
			 		</div>
			 		<div class="form-group row">
      				<label for="birthdate" class="col-form-label col-sm-3">ວັນ, ເດືອນ, ປີເກີດ</label>
      				<div class="col-sm-9">
			 		<input class="form-control" type="date" name="CustBirthdate" value="" id="example-date-input"/>
			 		</div>   				
			 	</div>
			 	<div class="form-group row">
      				<label for="tel" class="col-form-label col-sm-3">ເບີໂທລະສັບ</label>
      				<div class="col-sm-9">
			 		<input type="text" class="form-control" name="CustTel" placeholder="ປ້ອນເບີໂທຂອງທ່ານ"/>
			 		</div>   				
			 	</div>
			 	<div class="form-group row">
      				<label for="tel" class="col-form-label col-sm-3">&nbsp;<i class="fa fa-whatsapp"></i></label>
      				<div class="col-sm-9">
			 		<input type="text" class="form-control" name="CustWhat" placeholder="ປ້ອນເບີທີ່ນຳໃຊ້ whatsapp ເຊັ່ນ +85620"/>
			 		</div>   				
			 	</div>
			 		<div class="card-footer text-center">
			 			<input type="submit" name="register" class="btn btn-success" value="ລົງທະບຽນ">
			 			<a class="btn btn-danger" style="color: white;" href="index.php">ຍົກເລີກ </a>
			 		</div>
			 	</div>
			 	</form>
			 </div>
			</div> 	
		</div>
	</div>
	<?php 
 include_once 'include/Footer1.php';
 ?>	
   </body>
</html>
 