<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
			<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inzee Organic Laos,LTD</title>
     <?php 
     include_once 'include/library.php';   ?> 
	</head>
	<body> 
       <div class=""> <?php 
     include_once 'include/header.php';   ?>  
 </div>   
   <?php include 'include/navbar.php'; ?>

    	 <div class="container" style="padding: 50px;">
		<div class="row">
			<div class="col-md-12 mx-auto mt-5">
			 	<div class="card">
			 	<form role="form" action="login.php" method="POST">
			 		<div class="card-header text-center" style="background-color:;">
			 			<h4 class="text-danger"> <b>ຄຳແນະນຳ <img src="../photo/Ad.jpg" alt="" width="70px" height="70px"> </b>
			 		</h4>
				 	</div>	
			 			<div class="card-body">
			 				<div class="form-group row">
			 					<label for="username" class="col-form-label col-sm-3"><b>ຕອນລູກຄ້າລົງທະບຽນ:</b><img src="../photo/Admin.png" alt="" width="70px" height="70px"></label>
			 			<div class="col-sm-9">
			 				-	ກວດສອບຂໍ້ມູນໃຫ້ລະອຽດວ່າຖືກຕ້ອງແລ້ວບໍ ເພາະຫຼັງຈາກທ່ານສັ່ງຊື້ແລ້ວພວກເຮົາຈະຕິດຕໍ່ກັບໄປໄດ້ຖືກຕ້ອງ (ກໍລະນີຂໍ້ມູນລູກຄ້າເປັນເທັດ, ພວກເຮົາຈະທຳການລົບລ້າງບັນຊີທັນທີ). 
			 			</div>
			 		</div>
			 		<div class="form-group row">
			 					<label for="password" class="col-form-label col-sm-3"><b>ການສັ່ງຊື້ສິນຄ້າ:</b><img src="../photo/key.jpg" alt="" width="70px" height="70px"></label>
			 			<div class="col-sm-9">
			 				1.	ເມື່ອທ່ານສັ່ງຊື້ສິນຄ້າ, ແລ້ວພະນັກງານຈະແຈ້ງການໂອນເງິນເຂົ້າເລກບັນຊີຂອງຮ້ານໂດຍການຕິດຕໍ່ກັບລູກຄ້າໂດຍກົງ (ຊ່ອງທາງຕິຕໍ່ທີທ່ານລົງທະບຽນ).<br/>
							2.	ກະລຸນາຮັບເອົາໃບບິນສິນຄ້າຂອງທ່ານເພື່ອຢືນຢັນການສັ່ງຊື້ສິນຄ້າ <br/>
			 		</div>
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





