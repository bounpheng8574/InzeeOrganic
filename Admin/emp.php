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
include("../db.php");
if(isset($_POST['emp_save']))
{
$FirstName  = $_POST['FirstName'];
$LastName   = $_POST['LastName'];
$Address   	= $_POST['Address'];
$Tel   		= $_POST['Tel'];
$BirthDate	= $_POST['BirthDate'];
$Sex        = $_POST['Sex'];
$Email      = $_POST['Email'];
$check_user = "SELECT * FROM employee WHERE Email='$Email'";
$run_query	= mysqli_query($dbcon,$check_user);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('ມີຂໍ້ມູນຊ້ຳກັນ, ກະລຸນາປ້ອນຂໍ້ມູນໃໝ່!')</script>";
 echo"<script>window.open('emp.php','_self')</script>";
exit();
    }
 //image coding
 $imgFile = $_FILES['Picture']['name'];
$tmp_dir = $_FILES['Picture']['tmp_name'];
$imgSize = $_FILES['Picture']['size'];

$upload_dir = 'include/emp_i/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;


			if(in_array($imgExt, $valid_extensions)){			
		
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic); 


$saveaccount="INSERT INTO employee (FirstName, LastName, Sex, BirthDate, Address, Tel,Email, Picture) VALUE ('$FirstName','$LastName' , '$Sex', '$BirthDate', '$Address', '$Tel', '$Email','$itempic')";
mysqli_query($dbcon,$saveaccount);
echo "<script>alert('ບັນທຶກຂໍ້ມູນສຳເລັດ')</script>";       
echo "<script>window.open('emp.php','_self')</script>";
		}	
		else{
					
					 echo "<script>alert('ຂໍອະໄພ, ຂະໜາດຟາຍຮູບຂອງທ່ານສູງເກິນໄປ')</script>";				
					 echo "<script>window.open('emp.php','_self')</script>";
				}
	}
	else{
				
				 echo "<script>alert('ຂະໜາດຟາຍຮູບຕ້ອງເປັນ JPG, JPEG, PNG & GIF ເທົ່ານັ້ນ')</script>";				
					 echo "<script>window.open('emp.php','_self')</script>";
	}
}
?>
<!-- Delete data by id -->
<?php
	require_once '../config.php';
	
	if(isset($_GET['delete_id']))
	{	
		$stmt_select = $DB_con->prepare('SELECT Picture FROM employee WHERE EmpID =:EmpID');
		$stmt_select->execute(array(':EmpID'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("include/emp_i/".$imgRow['Picture']);
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM employee WHERE EmpID =:EmpID');
		$stmt_delete->bindParam(':EmpID',$_GET['delete_id']);
		$stmt_delete->execute();	
		header("Location: emp.php");
	}
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ໜ້າຈັດການພະນັກງານ</title>
 		<?php include_once 'include/libraryadmin.php';?>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			  <?php include_once 'include/icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			       <a class="nav-link" href="addemp.php" data-toggle="modal" data-target="#myModal"> ບັນທຶກພະນັກງານ	</a>
			      </li>
				</ul>
				<?php include_once 'include/session.php';?>
			</div>
		</div>
</nav> <!-- End nav -->

		<!-- madal add employee -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title ml-10" id="">ຟອມປ່ອນຂໍ້ມູນພະນັກງານ</h5>
			       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			       <form enctype="multipart/form-data" method="POST" action=""> 
			      <div class="modal-body">
			  
			  <div class="form-group">
			    <label for="FirstName">ຊື່ແທ້</label>
			    <input type="text" class="form-control" name="FirstName" required/>
			  </div>
			  <div class="form-group">
			    <label for="LastName">ນາມສະກຸນ</label>
			    <input type="text" class="form-control" name="LastName" required/>
			  </div> 
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
			  <!-- add date -->
			  <div class="form-group">
      				<label for="birthdate">ວັນ, ເດືອນ, ປີເກີດ</label>
			 		<input class="form-control" type="date" name="BirthDate" value="" id="example-date-input"/>   				
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
			  </div>	     
			      <div class="modal-footer">
			         <input type="submit" class="btn btn-primary" name="emp_save" value="ຕົກລົງ">
			         </div>        
			        </form>
			    </div>
			</div>
		</div>		 <!-- end -->

	 <!-- Datatables -->
	 <div class="">  
        <br/>                    
          <center> <h3><strong>ໜ້າຈັດການພະນັກງານ</strong> </h3></center>   
           </div>
         <br />
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th>ຮູບໂປຣຟາຍ</th>	
                  <th>ຊື່ແທ້</th>
                  <th>ນາມສະກຸນ</th>
				  <th>ວັນ, ເດຶອນ, ປີເກີດ</th>
				  <th>ເພດ</th>
				  <th>ທີ່ຢູ່</th>
                  <th>ເບີໂທ</th>
                   <th>ອີເມວ</th>
                   <th>ຈັດການ</th> 
                </tr>
              </thead>
              <tbody>
			  <?php
include("../config.php");
	$stmt = $DB_con->prepare('SELECT * FROM employee');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);		
			?>
                <tr>
                  <td>
				<center> <img src="include/emp_i/<?php echo $Picture; ?>" class="img img-rounded"  width="50" height="50"/></center>
				 </td>
                 <td><?php echo $FirstName; ?></td>
				 <td><?php echo $LastName; ?></td>
			 	 <td><?php echo $BirthDate; ?></td>
				 <td> <?php echo $Sex; ?> </td> 
				 <td><?php echo $Address; ?></td>
				 <td><?php echo $Tel; ?></td>
				 <td><?php echo $Email; ?></td>	 
					
                  <td>
                <!-- delete and update data emp -->
 				<a class="btn btn-info" href="employee/edititem.php?edit_id=<?php echo $row['EmpID']; ?>" title="ຄລິກເພື່ອແກ້ໄຂ" onclick="return confirm('ຕ້ອງການແກ້ໄຂຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-pencil'></span> ແກ້ໄຂຂໍ້ມູນ</a>
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['EmpID']; ?>" title="ຄລິກເພື່ອລຶບ" onclick="return confirm('ຕ້ອງການລຶບຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-trash'></span> ລຶບຂໍ້ມູນ</a>
				
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
        </div><!-- End Wrapper -->
        <?php include '../include/footer.php'; ?> 
<?php include_once 'include/showdatatables.js';?>

</body>
</html>