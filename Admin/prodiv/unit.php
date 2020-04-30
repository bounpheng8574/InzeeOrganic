<!-- check admin -->
<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<!-- insert data and emp -->
<?php
include("../../db.php");
if(isset($_POST['Unit']))
{
$UnitName   = $_POST['UnitName'];
$Unitdescr   = $_POST['Unitdescr'];
 
$saveaccount="INSERT INTO productunit (UnitID, UnitName, Unitdescr) VALUE ('$UnitID', '$UnitName','$Unitdescr')";
mysqli_query($dbcon,$saveaccount);
 echo "<script>alert('ບັນທຶກຂໍ້ມູນສຳເລັດ')</script>";       
 echo "<script>window.open('unit.php','_self')</script>";
		
}	

?>
<!-- Delete data by id -->
<?php
	require_once '../../config.php';
	
	if(isset($_GET['delete_id']))
	{	
		
		$stmt_delete = $DB_con->prepare('DELETE FROM productunit WHERE UnitID =:UnitID');
		$stmt_delete->bindParam(':UnitID',$_GET['delete_id']);
		$stmt_delete->execute();	
		header("Location: Unit.php");
	}
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Page</title>
 		<?php include_once 'libraryadmin.php';?>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			  <?php include_once 'icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="../index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			        <li class="nav-item dropdown">
	              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-edit'></span>&nbsp;ຈັດການສິນຄ້າ
	              </a>
	            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	             <a class="dropdown-item" href="../Product.php">ສິນຄ້າ</a>
	             <a class="dropdown-item" href="category.php"> ບັນທຶກປະເພດສິນຄ້າ	</a>
				<a class="dropdown-item" href="unit.php"> ບັນທຶກຫົວໜ່ວຍສິນຄ້າ	</a>
	            </div>
            </li>
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
                            <li><a href="../logout.php">
                                <span class="fa fa-power-off"></span> ອອກລະບົບ</a></li>
                        </ul>
                    </li>
                </ul>
			</div>
		</div>
</nav> <!-- End nav -->

		
		<div class="container">
			<div class="">  
        <br/>                    
          <center> <h3><strong>ຟອມປ້ອນຂໍ້ມູນຫົວໜ່ວຍສິນຄ້າ</strong> </h3></center>   
           </div>
         <br />
			       <form enctype="multipart/form-data" method="POST" action="">   
			  <div class="form-group">
			    <label for="FirstName">ຫົວໜ່ວຍສິນຄ້າ</label>
			    <input type="text" class="form-control" name="UnitName" required/>
			  </div>
			  <div class="form-group">
			    <label for="LastName">ລາຍລະອຽດຫົວໜ່ວຍສິນຄ້າ</label>
			    <input type="text" class="form-control" name="Unitdescr" required/>
			  </div> 
			 
			     
			      <div class="">
			         <input type="submit" class="btn btn-primary" name="Unit" value="ຕົກລົງ">
			         </div>        
			        </form>
			    </div>
			 <!-- end -->
	<!--  	ກຸ່ມຜັກທີ່ເປັນຫົວ 	ກຸ່ມຜັກທີ່ເປັນໝາກ -->
	 <!-- Datatables -->
	 <div class="">  
        <br/>                    
          <center> <h3><strong>ຕາຕະລາງຫົວໜ່ວຍສິນຄ້າ</strong> </h3></center>   
           </div>
         <br />
	 
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th>ຫົວໜ່ວຍສິນຄ້າ</th>
                  <th>ລາຍລະອຽດຫົວໜ່ວຍສິນຄ້າ</th>
				    <th>ຈັດການ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
include("../../config.php");
	$stmt = $DB_con->prepare('SELECT * FROM productunit');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);		
			?>
                <tr>               
                 <td><?php echo $UnitName; ?></td>
			 	 <td><?php echo $Unitdescr; ?></td>	 			
                  <td>
                <!-- delete and update data emp -->
 				<a class="btn btn-info" href="" title="ຄລິກເພື່ອແກ້ໄຂ" onclick="return confirm('ຕ້ອງການແກ້ໄຂຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-pencil'></span> ແກ້ໄຂຂໍ້ມູນ</a>
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['UnitID']; ?>" title="ຄລິກເພື່ອລຶບ" onclick="return confirm('ຕ້ອງການລຶບຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-trash'></span> ລຶບຂໍ້ມູນ</a>
				
                  </td>	
                </tr>
               
              <?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
	// echo '<div class="alert alert-default" style="background-color:#033c73;">
  //                     <p style="color:white;text-align:center;">
  //                     ບຳລຸງຮັກສາໂດຍ: Leproxedo
		// 				</p>
                        
  //                   </div>
		
	
		echo "</div>";
	}
	else
	{
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
         <?php include '../../include/footer.php'; ?> 
        <!-- End Wrapper -->
<?php include_once '../include/showdatatables.js';?>

</body>
</html>