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
		$stmt_edit = $DB_con->prepare('SELECT * FROM supplier WHERE SupID =:SupID');
		$stmt_edit->execute(array(':SupID'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: ../supplier.php");
	}
	if(isset($_POST['btn_save_updates']))
	{
	$CompanyName  	= $_POST['CompanyName'];
	$ContactName 	= $_POST['ContactName'];
	$SupAddress  	= $_POST['SupAddress'];
	$SupTel   		= $_POST['SupTel'];
	$SupEmail   	= $_POST['SupEmail'];			
		
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE supplier
									     SET 
											 CompanyName=:CompanyName, 
											 ContactName=:ContactName,
											 SupAddress=:SupAddress, 
											 SupTel=:SupTel, 
											 SupEmail=:SupEmail 			    
								       WHERE SupID=:SupID');
			
			$stmt->bindParam(':CompanyName',$CompanyName);
			$stmt->bindParam(':ContactName',$ContactName);
			$stmt->bindParam(':SupAddress',$SupAddress);
			$stmt->bindParam(':SupTel',$SupTel);
			$stmt->bindParam(':SupEmail',$SupEmail);
			
			$stmt->bindParam(':SupID',$id);
				
			if($stmt->execute()) {
				?>
                <script>
				alert('ອັບເດດສຳເລັດ ...');
				window.location.href='../Supplier.php';
				</script>
                <?php
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
			       </li> --></ul>
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
			       <form enctype="multipart/form-data" method="POST" action="../supplier.php"> 
			   <div class="form-group">
			    <label for="Username">ຊື່ຮ້ານນຳເຂົ້າ</label>
			    <input type="text" class="form-control" name="CompanyName" required/>
			  </div>
			  <div class="form-group">
			    <label for="UserPassword">ຜູ້ຕິດຕໍ່ນຳເຂົ້າ</label>
			    <input type="text" class="form-control" name="ContactName" required/>
			  </div> 
			  <div class="form-group">
			    <label for="FirstName">ທີ່ຢູ່</label>
			    <input type="text" class="form-control" name="SupAddress" required/>
			  </div>
			  <div class="form-group">
			    <label for="LastName">ເບີໂທ</label>
			    <input type="text" class="form-control" name="SupTel" required/>
			  </div> 
			  <div class="form-group">
			    <label for="Address">ອີເມວ</label>
			    <input type="email" class="form-control" name="SupEmail" required/>
			  </div>
			  
			    <div class="modal-footer">
			         <input type="submit" class="btn btn-primary" id="" name="supplier_save" value="ຕົກລົງ">
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
                        
            <center> <h3><strong>ອັບເດດຂໍ້ມູນຜູ້ສະໜອງ</strong> </h3>
						  
					</center>
				</div>			  
	 <table class="table table-bordered table-responsive">	 
    <!-- <tr align="center">
    	<td><label class="control-label">Username</label></td>
        <td><input class="form-control" type="text" name="UserName" value="<?php //echo $UserName; ?>" required /></td>
    </tr>
	<tr align="center">
    	<td><label class="control-label">Password</label></td>
        <td><input class="form-control" type="password" name="UserPassword" value="<?php //echo $UserPassword; ?>" required /></td>
    </tr> -->
    <tr align="center">
    	<td><label class="control-label">ຊື່ຮ້ານນຳເຂົ້າ</label></td>
        <td><input class="form-control" type="text" name="CompanyName" value="<?php echo $CompanyName; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ຜູ້ຕິດຕໍ່ນຳເຂົ້າ</label></td>
        <td><input class="form-control" type="text" name="ContactName" value="<?php echo $ContactName; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ທີ່ຢູ່</label></td>
        <td><input class="form-control" type="text" name="SupAddress" value="<?php echo $SupAddress; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ເບີໂທ</label></td>
        <td><input class="form-control" type="text" name="SupTel" value="<?php echo $SupTel; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ອີເມວ</label></td>
        <td><input class="form-control" type="email" name="SupEmail" value="<?php echo $SupEmail; ?>" required /></td>
    </tr>
    <tr align="center">
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary">
        <span class="fa fa-save"></span> ປ່ຽນແປງຂໍ້ມູນໃໝ່
        </button>
        
        <a class="btn btn-danger" href="../supplier.php"> <span class="fa fa-backward"></span> ຍົກເລີກ </a>
        
        </td>
    </tr>  
    </table>
</form>
</div>
<?php include '../../include/footer.php'; ?> 
	</body>
</html>