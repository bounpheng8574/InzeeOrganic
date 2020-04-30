<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}
?>
<?php

	require_once '../config.php';
	
	if(isset($_GET['delete_id']))
	{
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM supplier WHERE SupID =:SupID');
		$stmt_delete->bindParam(':SupID',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: supplier.php");
	}

?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Page</title>
 		<?php include_once 'include/libraryadmin.php';?>
	</head>
	<body>
	
	<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			   <?php include_once 'include/icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			       <a class="nav-link" href="additems.php" data-toggle="modal" data-target="#myModal"> ບັນທຶກຜູ້ສະໜອງ	</a>
			      </li>
		    </ul>
		    <?php include_once 'include/session.php';?>           
		  </div>
		</div>
	</nav><!-- end -->
	<!-- madal additems -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title ml-10" id="">ຟອມປ່ອນຂໍ້ມູນຜູ້ສະໜອງ</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			       <form enctype="multipart/form-data" method="POST" action="supplier/addsup.php"> 
			  <div class="form-group">
			    <label for="CompanyName">ຊື່ຮ້ານນຳເຂົ້າ</label>
			    <input type="text" class="form-control" name="CompanyName" required/>
			  </div>
			  <div class="form-group">
			    <label for="ContactName">ຜູ້ຕິດຕໍ່ນຳເຂົ້າ</label>
			    <input type="text" class="form-control" name="ContactName" required/>
			  </div>  

			  <div class="form-group">
			  	<label for="SubAddress">ທີ່ຢູ່</label>
			    <input type="text" name="SupAddress" class="form-control" required/>  
			  </div>
			  <div class="form-group">
			    <label for="SupTel">ເບີໂທ</label>
			    <input type="text" class="form-control" name="SupTel" required/>
			  </div>
			  <div class="form-group">
			    <label for="SupEmail">ອີເມວ</label>
			    <input type="email" class="form-control" name="SupEmail">
			  </div>		     
			      <div class="modal-footer">
			         <input type="submit" class="btn btn-primary" name="supplier_save" value="ຕົກລົງ">        
			              
			        </form>
			    </div>
			</div>
		</div>
	</div>
	</div> <!-- end -->

<!-- supplier table data --><div class="">  
        <br/>                    
          <center> <h3><strong>ຈັດການຂໍ້ມູນຜູ້ສະໜອງ</strong> </h3></center>   
           </div>
         <br />
	<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຊື່ຮ້ານນຳເຂົ້າ</th>
                  <th>ຜູ້ຕິດຕໍ່ນຳເຂົ້າ</th>
				  <th>ທີ່ຢູ່</th>
				  <th>ເບີໂທ</th>
				  <th>ອີເມວ</th>
				   <th>ຈັດການ</th> 
                  
                 
                </tr>
              </thead>
              <tbody>
			  <?php
include("../config.php");
	$stmt = $DB_con->prepare('SELECT * FROM supplier');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			
			
			?>
                <tr>
                
                 <td><?php echo $CompanyName; ?></td>
				 <td> <?php echo $ContactName ; ?> </td>
				 <td><?php echo $SupAddress; ?></td>
				 <td><?php echo $SupTel; ?></td>
				 <td><?php echo $SupEmail; ?></td>	 
                  <td>
                    <a class="btn btn-info" href="supplier/edititem.php?edit_id=<?php echo $row['SupID']; ?>" title="ຄລິກເພື່ອແກ້ໄຂ" onclick="return confirm('ຕ້ອງການແກ້ໄຂຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-pencil'></span> ແກ້ໄຂຂໍ້ມູນ</a>
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['SupID']; ?>" title="ຄລິກເພື່ອລຶບ" onclick="return confirm('ຕ້ອງການລຶບຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-trash'></span> ລຶບຂໍ້ມູນ</a>
				
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
	<!-- End Wrapper -->
	<?php include '../include/footer.php'; ?>  

		<?php include_once 'include/showdatatables.js';?>	
	</body>
	</html>