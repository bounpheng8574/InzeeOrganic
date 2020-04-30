<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<?php
	error_reporting( ~E_NOTICE );
	
	require_once '../config.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM products WHERE ProductID =:ProductID');
		$stmt_edit->execute(array(':ProductID'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: Product.php");
	}
	
	if(isset($_POST['btn_save_updates']))
	{
	$ProductName 	= $_POST['ProductName'];
	$ProductPrice 	= $_POST['ProductPrice'];
	$ProductQuantity= $_POST['ProductQuantity'];
	$Description  	= $_POST['Description'];	
	$CategoryName  	= $_POST['CategoryName'];
	$UnitID 		= $_POST['UnitID'];	
	$imgFile		= $_FILES['ProductImage']['name'];
	$tmp_dir 		= $_FILES['ProductImage']['tmp_name'];
	$imgSize 		= $_FILES['ProductImage']['size'];		
		if($imgFile)
		{
			$upload_dir = 'images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$itempic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['ProductImage']);
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
		
			$itempic = $edit_row['ProductImage']; 
		}	
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE products
									     SET ProductName=:Productname, 
											 ProductPrice=:ProductPrice,
											 ProductQuantity=:ProductQuantity,
										     Description=:Description,
										     CategoryName=:CategoryName,
										     UnitID=:UnitID,
										     ProductImage=:ProductImage
								       WHERE ProductID=:ProductID');
			$stmt->bindParam(':Productname',$ProductName);
			$stmt->bindParam(':ProductPrice',$ProductPrice);
			$stmt->bindParam(':ProductQuantity',$ProductQuantity);
			$stmt->bindParam(':Description',$Description);
			$stmt->bindParam(':CategoryName',$CategoryName);
			$stmt->bindParam(':UnitID',$UnitID);
			$stmt->bindParam(':ProductImage',$itempic);
			$stmt->bindParam(':ProductID',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('ອັບເດດສຳເລັດ...');
				window.location.href='Product.php';
				</script>
                <?php
			}
			else{
				$errMSG = "ຂໍອະໄພ, ຂໍ້ມູນບໍທັນໄດ້ຖືກຈັດເກັບເທື່ອ!";
				 echo "<script>alert('ຂໍ້ມູນບໍທັນໄດ້ຖືກຈັດເກັບເທື່ອ ! !')</script>";				
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
		<title>Log in</title>	
 		 <?php include_once 'include/libraryadmin.php';?>
	</head>
	<body>
	<!-- navbar -->
		<div id="wrapper">
	<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			  <?php include_once 'include/icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			      <!-- <li class="nav-item">
			       <a class="nav-link" href="additems.php" data-toggle="modal" data-target="#myModal"> ເພີ່ມສິນຄ້າ	</a>
			      </li> -->
			        <li class="nav-item">
			       <a class="nav-link" href="Product.php"> ຈັດການສິນຄ້າ	</a>
			      </li>			
		    </ul>
				<?php include_once 'include/session.php';?>
		  </div>
		</div>
	</nav><!-- end -->

        <div id="page-wrapper">
            	
		<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
	if(isset($errMSG)){
		?>
        <?php
	}
	?>
			 <div class="">
                        <br/>
            <center> <h3><strong>ອັບເດດສິນຄ້າ</strong> </h3>
						  
					</center>
				</div>	

	 <table class="table table-bordered table-responsive">	 
    <tr align="center">
    	<td><label class="control-label">ຊື່ສິນຄ້າ</label></td>
        <td><input class="form-control" type="text" name="ProductName" value="<?php echo $ProductName; ?>" required /></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ປະເພດສິນຄ້າ</label></td>
        <td><select class="" name="CategoryName">
        	<!-- ເຮັດໃຫ້ມັນເລືອກເລີຍ -->
			<?php
			include("../db.php");
			global $dbcon;
		    $sql = mysqli_query($dbcon, "SELECT * FROM categories");
		    while($row = mysqli_fetch_array($sql)) {
		    	if ($CategoryName == $row['CategoryID']) {
		    		$sel = "selected";

		    	}else{
		    		$sel = "";
		    	}
		    	?>
		        <option value="<?php echo $row['CategoryID']; ?>" <?php echo $sel; ?>><?php echo $row['CategoryName']; ?></option>
		        <?php
		    }
		?>
		</select>	
	</td>	
    </tr>
    <tr align="center">
    	<td><label class="control-label">ຫົວໜ່ວຍສິນຄ້າ</label></td>
        <td><select class="" name="UnitID">
			<?php
			include("../db.php");
			global $dbcon;
		    $sql = mysqli_query($dbcon, "SELECT * FROM productunit");
		     while($row = mysqli_fetch_array($sql)) {
		    	if ($UnitID == $row['UnitID']) {
		    		$sel = "selected";

		    	}else{
		    		$sel = "";
		    	}
		    	?>
		        <option value="<?php echo $row['UnitID']; ?>" <?php echo $sel; ?>><?php echo $row['UnitName']; ?></option>
		        <?php
		    }
		?>
		</select>	
	</td>	
    </tr>
	
	 <tr align="center">
    	<td><label class="control-label">ລາຄາ</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="ProductPrice" value="<?php echo $ProductPrice; ?>" required/></td>
    </tr>
    <tr align="center">
    	<td><label class="control-label">ຈຳນວນສະຕ໊ອກ</label></td>
        <td><input class="form-control" type="number" name="ProductQuantity" value="<?php echo $ProductQuantity; ?>" required/></td>
    	</tr>
	<tr align="center">
    	<td><label class="control-label">ລາຍລະອຽດສິນຄ້າ:</label></td>
        <td><input class="form-control" type="text" name="Description" value="<?php echo $Description; ?>" required/></td>
    	</tr>
    <tr align="center">
    	<td><label class="control-label">ຮູບພາບ</label></td>
        <td>
        	<p><img class="img img-thumbnail" src="images/<?php echo $ProductImage; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="ProductImage" accept="image/*" />
        </td>
    </tr>
    <tr align="center">
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary">
        <span class="fa fa-save"></span> ປ່ຽນແປງຂໍ້ມູນໃໝ່
        </button>
        
        <a class="btn btn-danger" href="product.php"> <span class="fa fa-backward"></span> ຍົກເລີກ </a>
        
        </td>
    </tr>  
    </table>
</form>
</div>
	<script>
    $(document).ready(function() {
        $('#ProductPrice').keypress(function (event) {
            return isNumber(event, this)
        });
    });
  
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    
</script>
	</body>
</html>