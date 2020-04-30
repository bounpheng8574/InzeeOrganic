<?php
session_start();
?>
<!DOCTYPE html>

<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Log in</title> 
		<?php include_once 'include/libraryadmin.php';?>
		<link rel="stylesheet" href="../node_modules/footer.css">
		<link rel="stylesheet" href="../node_modules/header.css">
		<link rel="stylesheet" href="../node_modules/icon.css">
	</head>
	<body>
<header>
 <a href="index.php"> <img src="../photo/cover3.jpg" width="100%" height="200px" alt=""> </a>
</header>
	 <div class="container" style="padding: 100px;">
		<div class="row">
			<div class="col-md-12 mx-auto mt-5">
			 	<div class="card">
			 	<form role="form" action="login.php" method="POST">
			 		<div class="card-header text-center" style="background-color:;">
			 			<h4 class="text-danger"> <b>ເຂົ້າສູ່ລະບົບ Admin <img src="../photo/Ad.jpg" alt="" width="70px" height="70px"> </b>
			 		</h4>
			 		<input type="hidden" name="name" required/>
			 	</div>	
			 			<div class="card-body">
			 				<div class="form-group row">
			 					<label for="username" class="col-form-label col-sm-3"><img src="../photo/Admin.png" alt="" width="70px" height="70px"></label>
			 			<div class="col-sm-9">
			 						<input type="text" class="form-control" name="username" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້" required/>
			 			</div>
			 		</div>
			 		<div class="form-group row">
			 					<label for="password" class="col-form-label col-sm-3"><img src="../photo/key.jpg" alt="" width="70px" height="70px"></label>
			 			<div class="col-sm-9">
			 				<input type="password" class="form-control" name="password" placeholder="ປ້ອນລະຫັດຜ່ານ" required/>
			 		</div>
			 		</div>
			 	</div>
			 		<div class="card-footer text-center">
			 			<input type="submit" name="submit" class="btn btn-success" value="ລົງຊື່ເຂົ້າ">  
			 		</div>
			 	</form>
			 </div>
			</div> 	
		</div> 
				
	<!-- admin -->
		<!-- <div class="card" style="background-color: lightgreen;">
		<ul class="nav justify-content-center" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active btn btn-success" href="#admin" role="tab" data-toggle="tab">Admin</a> -->
		<!-- CEO -->
		  <!-- </li>
		  <li class="nav-item">
		    <a class="nav-link btn btn-warning text-white" href="#ceo" role="tab" data-toggle="tab">ຜູ້ບໍລິຫານ</a>
		  </li>
		</ul> -->
		<!-- Tab panes -->
		<!-- <div class="tab-content"> -->
			<!-- tab admin -->
		 <!--  <div role="tabpanel" class="tab-pane fade in active" id="admin">		
		  	<div class="row">
			<div class="col-md-8 mx-auto mt-5">
			 	<div class="card">
			 	<form role="form" action="login.php" method="POST">
			 		<div class="card-header text-center" style="background-color: lightblue;">
			 			<h5 class="text-danger"> <b>ເຂົ້າສູ່ລະບົບ Admin </b>
			 		</h5>
			 		<input type="hidden" name="name" required/>
			 	</div>	
			 			<div class="card-body" style="background-color: cyan;">
			 				<div class="form-group row">
			 					<label for="username" class="col-form-label col-sm-3">ຊື່ຜູ້ໃຊ້</label>
			 			<div class="col-sm-9">
			 						<input type="text" class="form-control" name="username" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້" required/>
			 			</div>
			 		</div>
			 		<div class="form-group row">
			 					<label for="password" class="col-form-label col-sm-3">ລະຫັດຜ່ານ</label>
			 			<div class="col-sm-9">
			 				<input type="password" class="form-control" name="password" placeholder="ປ້ອນລະຫັດຜ່ານ" required/>
			 		</div>
			 		</div>
			 	</div>
			 		
			 	</form>
			 </div>
			</div> 	
		</div>
	</div> -->
	<!-- tab CEO -->
		  <!-- <div role="tabpanel" class="tab-pane fade" id="ceo">	
		  	<div class="row">
			<div class="col-md-8 mx-auto mt-5">
			 	<div class="card">
			 	<form role="form" action="login.php" method="POST">
			 		<div class="card-header text-center" style="background-color: lightblue">
			 			<h5 class="text-danger"> <b>ເຂົ້າສູ່ລະບົບ Admin </b>
			 		</h5>
			 		<input type="hidden" name="name" required/>
			 	</div>	
			 			<div class="card-body">
			 				<div class="form-group row">
			 					<label for="username" class="col-form-label col-sm-3">ຊື່ຜູ້ໃຊ້</label>
			 			<div class="col-sm-9">
			 						<input type="text" class="form-control" name="username" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້" required/>
			 			</div>
			 		</div>
			 		<div class="form-group row">
			 					<label for="password" class="col-form-label col-sm-3">ລະຫັດຜ່ານ</label>
			 			<div class="col-sm-9">
			 				<input type="password" class="form-control" name="password" placeholder="ປ້ອນລະຫັດຜ່ານ" required/>
			 		</div>
			 		</div>
			 	</div>
			 		<div class="card-footer text-center">
			 			<input type="submit" name="submit" class="btn btn-success" value="ລົງຊື່ເຂົ້າ">  
			 		</div>
			 	</form>
			 </div>
			</div> 	
		</div>
	</div> --> 
<!-- </div> --> <!-- end tabpanes -->
<!-- </div> --> <!-- card -->
</div> 	
<?php 
include_once '../include/footer1.php';
?>
   </body>
</html>