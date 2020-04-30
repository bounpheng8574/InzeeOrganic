<?php 
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}
?>
<?php include_once 'include/selectorder.php';?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
			<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inzee Organic Laos,LTD</title>
     <?php include_once 'include/librarycust.php';?>
	</head>
	<body> 
 <div class=""> <?php 
include_once 'include/header.php';
include 'include/navbar.php'; 
?>
 </div>   

    	 <div class="container" style="padding: 50px;">
		<div class="row">
			<div class="col-md-12 mx-auto mt-5">
			 	<div class="card">
			 	<form role="form" action="login.php" method="POST">
			 		<div class="card-header text-center" style="background-color:;">
			 			<h4 class="text-danger"> <b>ຄຳແນະນຳ </b>
			 		</h4>
				 	</div>	
			 			<div class="card-body">
			 				<div class="form-group row">
			 					<label for="username" class="col-form-label col-sm-3"><b>ຕອນລູກຄ້າລົງທະບຽນ</b></label>
			 			<div class="col-sm-9">
			 				-	ກວດສອບຂໍ້ມູນໃຫ້ລະອຽດວ່າຖືກຕ້ອງແລ້ວບໍ ເພາະຫຼັງຈາກທ່ານສັ່ງຊື້ແລ້ວພວກເຮົາຈະຕິດຕໍ່ກັບໄປໄດ້ຖືກຕ້ອງ (ກໍລະນີຂໍ້ມູນລູກຄ້າເປັນເທັດ, ພວກເຮົາຈະທຳການລົບລ້າງບັນຊີທັນທີ). 
			 			</div>
			 		</div>
			 		<div class="form-group row">
			 					<label for="password" class="col-form-label col-sm-3"><b>ຫຼັງຈາກສັ່ງຊື້ສິນຄ້າ:</b></label>
			 			<div class="col-sm-9">
			 				1.	ກະລຸນາກວດສອບລາຍລະອຽດຂໍ້ມູນຈໍານວນສິນຄ້າຂອງທ່ານ <br/>
							2.	ເມື່ອທ່ານສັ່ງຊື້ສິນຄ້າ, ແລ້ວກະລຸນາໂອນເງິນເຂົ້າເລກບັນຊີຂອງຮ້ານທີ່ພວກເຮົາໄດ້ໄດ້ແຈ້ງໄປແລ້ວ (ກໍລະນີເລືອກການຈ່າຍເງິນຜ່ານບັນຊີ) ແລະ ພະນັກງານຈະໂທແຈ້ງການຊໍາລະເງິນຂອງທ່ານ.<br/>
							3.	ກະລຸນາສະແດງໃບບີນຂອງທ່ານໃນເວລາຮັບສິນຄ້າ.
			 		</div>
			 		</div>		 		
			 	</div>
			 	</form>
			 </div>
			</div> 	
		</div> 
	</div>
      <?php 
 include_once '../include/Footer1.php';
 ?>
	</body>
</html>





