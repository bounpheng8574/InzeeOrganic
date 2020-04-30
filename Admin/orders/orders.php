<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>

<?php
	require_once '../../config.php';
	
	if(isset($_GET['delete_id']))
	{
		
		$stmt_select = $DB_con->prepare('SELECT ProductImage FROM Products WHERE ProductID =:ProductID');
		$stmt_select->execute(array(':ProductID'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("images/".$imgRow['ProductImage']);
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM Products WHERE ProductID =:ProductID');
		$stmt_delete->bindParam(':ProductID',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: orders.php");
	}

?>

<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ໜ້າສິນຄ້າ</title>
 		<?php include_once '../prodiv/libraryadmin.php';?>
	</head>
	<body>
		
		<!-- navbar -->
		<div id="wrapper">
	<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			   <?php include_once '../prodiv/icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="../index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			       <a class="nav-link" href="addorders.php" data-toggle="modal" data-target="#myModal"> ເພີ່ມສິນຄ້າ	</a>
			      </li>
			       	 <li class="nav-item dropdown">
	              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-edit'></span>&nbsp;import product
	              </a>
	            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	             <a class="dropdown-item" href="orders.php">orders</a>
	             <a class="dropdown-item" href="orderdetails.php"> orderdetails	</a>
				<!-- <a class="dropdown-item" href="prodiv/unit.php"> ບັນທຶກຫົວໜ່ວຍສິນຄ້າ	</a> -->
	            </div>
            </li>	
		    </ul>
				<?php include_once '../include/session.php';?>
		  </div>
		</div>
	</nav><!-- end -->

	<!-- madal additems -->
			<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title ml-10" id="">ຟອມປ່ອນຂໍ້ມູນສິນຄ້າ</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			       <form enctype="multipart/form-data" method="POST" action="additems.php"> 
			  <div class="form-group">
			    <label for="Name">ຊື່ສິນຄ້າ</label>
			    <input type="text" class="form-control" name="ProductName" required/>
			  </div>
			  <div class="form-group">
			    <label for="ProductPrice">ລາຄາສິນຄ້າ</label>
			    <input id="ProductPrice" type="text" class="form-control" name="ProductPrice" required/>
			  </div>  
			   <div class="form-group">
			<label for="category">ປະເພດສິນຄ້າ</label>
		<select class="custom-select" name="CategoryName"> -->
			<?php /*
			include("../db.php");
			global $dbcon;
		    $sql = mysqli_query($dbcon, "SELECT * FROM categories");
		    while($row = mysqli_fetch_array($sql)) {
		    	?>
		        <option value="<?php echo $row['CategoryID']; ?>"><?php echo $row['CategoryName']; ?></option>
		        <?php
		    }
		?>
		</select>			
		</div>
		 <div class="form-group">
			<label for="category">ຫົວໜ່ວຍ</label>
				<select class="custom-select" name="UnitID">
			<?php
			include("../db.php");
			global $dbcon;
		    $sql = mysqli_query($dbcon, "SELECT * FROM productunit");
		    while($row = mysqli_fetch_array($sql)) {
		    	?>
		        <option value="<?php echo $row['UnitID']; ?>">
		        	<?php echo $row['UnitName']; ?></option>
		        <?php
		    }
	*/	?>
		<!-- </select>			
		</div>   
			<div class="form-group">
			    <label for="ProductStock">ຈຳນວນສະຕ໊ອກ</label>
			    <input id="" type="number" class="form-control" name="ProductQuantity" required/>
			  </div> 
			  <div class="form-group">
			    <label for="Description">ລາຍລະອຽດສິນຄ້າ</label>
			    <input type="text" class="form-control" name="Description" required/>
			  </div>   
			  <div class="form-group">
			  	<label>ເລືອກຮູບພາບ</label>
			    <input type="file" name="ProductImage" accept="image/*" class="form-control" required/>  
			  </div>
			     
			      <div class="modal-footer">
			         <input type="submit" class="btn btn-primary" name="i_save" value="ຕົກລົງ">
			        </form>
			    </div>
			</div>
		</div>
	</div>
	</div>  -->   <!-- end -->
	<div class="container">  
        <br/> <div class="pull-left"><!-- <img src="../../photo/icon1.jpeg" style="width: 80px; height: 80px;"> --><br/>ລະຫັດໃບບິນ: </div> <div class="pull-right"><br/>ຜູ້ສະໜອງ: </div>                    
         <h3 align="center">                   
         <h3 align="center"><strong>ໃບບິນການສັ່ງຊື້ສິນຄ້າ</strong> </h3>   
           
         <br />
			 	 		 			  
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຊື່ສິນຄ້າ</th>
                  <th>ລະຫັດສິນຄ້າ</th>
				  <th>ລາຄາ</th>
				  <th>ປະເພດສິນຄ້າ</th> 
				  <th>ຫົວໜ່ວຍສິນຄ້າ</th> 
				  <th>ສະຕ໊ອກສິນຄ້າ</th> 
				  <th>ລາຍລະອຽດສິນຄ້າ</th>
				  <th>ວັນທີທີ່ເພິ່ມຂໍ້ມູນ</th>
                  <th>ຈັດການສິນຄ້າ</th>
                 
                </tr>
              </thead>
              <tbody>
			  <?php
include("../../config.php");
	
	$stmt = $DB_con->prepare('SELECT * FROM products order by ProductID Asc');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);		
			?>
			
                <tr>
                 <td><?php echo $ProductName; ?></td>
                 <td><?php echo $ProductID; ?></td>
				 <td> <?php echo $ProductPrice; ?> ກີບ</td>
				 <td><?php 
				 include '../../db.php';
				 $sel = mysqli_query($dbcon, "SELECT * FROM categories WHERE CategoryID='$CategoryName'");

				 while ($r = mysqli_fetch_array($sel)) {
				     echo $r['CategoryName'];
				 }
				  ?></td>
				 <td><?php 
				 include '../../db.php';
				 $sel = mysqli_query($dbcon, "SELECT * FROM productunit WHERE UnitID='$UnitID'");

				 while ($r = mysqli_fetch_array($sel)) {
				     echo $r['UnitName'];
				 }
				  ?></td>
				 <td><?php echo $ProductQuantity; ?></td> 
				 <td> <?php echo $Description; ?>  </td>
				 <td><?php echo $ProductUpdateDate; ?></td>
				
				  <!-- <td>ProductStock</td>
				 <td>UnitID</td>-->  
                  <td>
                   <a class="btn btn-info" href="edititem.php?edit_id=<?php echo $row['ProductID']; ?>" title="ຄລິກເພື່ອແກ້ໄຂ" onclick="return confirm('ຕ້ອງການແກ້ໄຂຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-pencil'></span> ແກ້ໄຂສິນຄ້າ</a> 
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['ProductID']; ?>" title="ຄລິກເພື່ອລຶບ" onclick="return confirm('ຕ້ອງການລຶບຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-trash'></span> ລຶບຂໍ້ມູນສິນນຄ້າ</a>
				
                  </td>
                </tr>
               
              <?php
		}
		
	}else{
		?>	
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="fa fa-info-sign"></span> &nbsp; ບໍ່ພົບຂໍ້ມູນໃດໆ ...
            </div>
        </div>
       <?php
			}
		?>	
		</tbody>
		</table>
        </div>
    </div>
	<?php include '../../include/footer.php'; ?>  

	<?php include_once '../include/showdatatables.js';?>	
	
	<?php include_once '../include/productprice.js';?>
</body>
</html>