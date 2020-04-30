<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../../index.php");
}

?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once '../../config.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM employee WHERE EmpID =:EmpID');
		$stmt_edit->execute(array(':EmpID'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: ../emp.php");
	}
	if(isset($_POST['btn_save_updates']))
	{
	$UserName  	= $_POST['UserName'];
	$UserPassword = $_POST['UserPassword'];
	$FirstName  = $_POST['FirstName'];
	$LastName   = $_POST['LastName'];
	$Address   	= $_POST['Address'];
	$Tel   		= $_POST['Tel'];
	//newadd
	$BirthDate	= $_POST['BirthDate'];
	$Sex        = $_POST['Sex'];
	$Email      = $_POST['Email'];				
	$imgFile 	= $_FILES['Picture']['name'];
	$tmp_dir 	= $_FILES['Picture']['tmp_name'];
	$imgSize 	= $_FILES['Picture']['size'];

					
		if($imgFile)
		{
			$upload_dir = '../include/emp_i/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$itempic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['Picture']);
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
					echo "<script>alert('Sorry, your file is too large it should be less then 5MB')</script>";				
					 
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";	
              echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";					
			}	
		}
		else
		{
		
			$itempic = $edit_row['Picture']; 
		}	
						
		

		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE employee
									     SET 
											 FirstName=:FirstName, 
											 LastName=:LastName,
											 Address=:Address, 
											 Tel=:Tel, 
											 Email=:Email, 
										     Picture=:Picture,
										     -- newadd
										     Sex=:Sex,
										     BirthDate=:BirthDate
								       WHERE EmpID=:EmpID');
			
			$stmt->bindParam(':FirstName',$FirstName);
			$stmt->bindParam(':LastName',$LastName);
			$stmt->bindParam(':Address',$Address);
			$stmt->bindParam(':Tel',$Tel);
			$stmt->bindParam(':Email',$Email);
			// newadd
			$stmt->bindParam(':Sex',$Sex);
			$stmt->bindParam(':BirthDate',$BirthDate);
			$stmt->bindParam(':Picture',$itempic);
			$stmt->bindParam(':EmpID',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('ອັບເດດສຳເລັດ ...');
				window.location.href='../emp.php';
				</script>
                <?php
			}
			else{
				$errMSG = "ຂໍອະໄພ, ຂໍ້ມູນບໍທັນໄດ້ຖືກຈັດເກັບເທື່ອ !";
				 echo "<script>alert('ຂໍອະໄພ, ຂໍ້ມູນບໍທັນໄດ້ຖືກຈັດເກັບເທື່ອ !')</script>";				
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ໜ້າແກ້ໄຂ</title>	
 		<?php include_once '../supplier/library.php';?>
	</head>
	<body>
	<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			   <?php include_once '../prodiv/icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="../index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			   <!--    <li class="nav-item">
			       <a class="nav-link" href="additems.php" data-toggle="modal" data-target="#myModal"> ເພີ່ມສິນຄ້າ	</a>
			      </li>
			        <li class="nav-item">
			       <a class="nav-link" href="Product.php" data-toggle="modal" data-target="#myModal"> ຈັດການສິນຄ້າ	</a>
			      </li>
			       <li class="nav-item">
			       <a class="nav-link" href="Customers.php"> ຈັດການລູກຄ້າ</a>
			      </li>
			       <li class="nav-item">
			       <a class="nav-link" href="Selldetails.php"> ຈັດການການຂາຍ	</a>
			       </li> -->
		    </ul>
		    <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <span class="fa fa-calendar"></span>  <?php
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?>
                        &nbsp;
                    </li> 
                        <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">
                                <span class="fa fa-power-off"></span> ອອກລະບົບ</a></li>
                        </ul>
                    </li>
                </ul>
		    <!-- madal additems -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title ml-10" id="">ຟອມປ່ອນຂໍ້ມູນສິນຄ້າ</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			       <form enctype="multipart/form-data" method="POST" action="../emp.php"> 
			  <div class="form-group">
			    <label for="FirstName">ຊື່ແທ້</label>
			    <input type="text" class="form-control" name="FirstName" required/>
			  </div>
			  <div class="form-group">
			    <label for="LastName">ນາມສະກຸນ</label>
			    <input type="text" class="form-control" name="LastName" required/>
			  </div> 
			<div class="form-group">
			    <label for="Picture">ຮູບພາບ</label>
			    <input type="file" class="form-control" accept="image/*" name="Picture" required/>
			  </div>
			  <div class="form-group">
			    <label for="Address">ທີ່ຢູ່</label>
			    <input type="text" class="form-control" name="Address" required/>
			  </div>
			  <div class="form-group">
			    <label for="Tel">ເບີໂທ</label>
			    <input type="text" class="form-control" name="Tel" required/>
			  </div>
			  <div class="form-group">
			    <label for="Email">ອີເມວ</label>
			    <input type="email" class="form-control" name="Email">
			  </div>
			  <!-- newadd -->
			   <div class="form-group">
			    <label for="Sex">ເພດ</label>
			      <div class="radio" required>
			 <div class="radio">
			   	<label>
			   		<input type="radio" name="Sex" id="male" value="ຊາຍ" checked>
			   		ເພດຊາຍ
			   	</label>
			   </div>
			   <div class="radio">
			   	<label>
			   		<input type="radio" name="Sex" id="female" value="ຍິງ">
			   		ເພດຍິງ
			   	</label>
			   </div>
			  </div>
			</div>
			<div class="form-group row">
      				<label for="BirthDate" class="col-form-label col-sm-3">ວັນ, ເດືອນ, ປີເກີດ</label>
      				<div class="col-sm-9">
			 		<input class="form-control" type="date" name="BirthDate" value="" id="example-date-input"/>
			 		</div>   				
			 	</div>	     
			     
			      <div class="modal-footer">
			         <input type="submit" class="btn btn-primary" id="" name="emp_save" value="ຕົກລົງ">
			        <button type="button" class="btn btn-danger" data-dimiss="modal">ຍົກເລີກ</button>
			    </div>
					        </form>
					    </div>
					</div>
				</div>
			</div>	  <!-- End Modal -->
			</div>		<!-- End Collapse -->
			</div>
			</nav>

        <div id="page-wrapper">
            	
		<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
	if(isset($errMSG)){
		?>
        <?php
	}
	?>
			 <div class="alert alert-info">
                        
            <center> <h3><strong>ອັບເດດຂໍ້ມູນພະນັກງານ</strong> </h3>
						  
					</center>
				</div>			  
	 <table class="table table-bordered table-responsive">	 
    <tr align="center">
    	<td><label class="control-label">ຊື່ແທ້</label></td>
        <td><input class="form-control" type="text" name="FirstName" value="<?php echo $FirstName; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ນາມສະກຸນ</label></td>
        <td><input class="form-control" type="text" name="LastName" value="<?php echo $LastName; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ເພດ</label></td>
        <td> <div class="radio">
			   	<label>
			   		<input type="radio" name="Sex" id="male" value="ຊາຍ" checked>
			   		ເພດຊາຍ
			   	</label>
			   	<label>
			  <input type="radio" name="Sex" id="female" value="ຍິງ">
			   		ເພດຍິງ
			   	</label>
			   </div>
			</td>
    </tr>
     <tr align="center">
    	<td><label class="control-label">ວັນ, ເດືອນ, ປີເກີດ</label></td>
        <td><input class="form-control" type="date" name="BirthDate" value="<?php echo $BirthDate; ?>" id="example-date-input" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ຮູບພາບ.</label></td>
        <td>
        	<p><img class="img img-thumbnail" src="../include/emp_i/<?php echo $Picture; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="Picture" accept="image/*" />
        </td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ທີ່ຢູ່</label></td>
        <td><input class="form-control" type="text" name="Address" value="<?php echo $Address; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ເບີໂທ</label></td>
        <td><input class="form-control" type="text" name="Tel" value="<?php echo $Tel; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ອີເມວ</label></td>
        <td><input class="form-control" type="text" name="Email" value="<?php echo $Email; ?>" required /></td>
    </tr>
    <tr align="center">
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary">
        <span class="fa fa-save"></span> ປ່ຽນແປງຂໍ້ມູນໃໝ່
        </button>
        
        <a class="btn btn-danger" href="../emp.php"> <span class="fa fa-backward"></span> ຍົກເລີກ </a>
        
        </td>
    </tr>  
    </table>
</form>
</div>
<?php include '../../include/footer.php'; ?> 
	</body>
</html>