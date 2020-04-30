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
if(isset($_POST['CatSave']))
{
$CategoryName   = $_POST['CategoryName'];
$Descriptions   = $_POST['Descriptions'];

 //image coding
$imgFile = $_FILES['CatPic']['name'];
$tmp_dir = $_FILES['CatPic']['tmp_name'];
$imgSize = $_FILES['CatPic']['size'];

$upload_dir = 'Catpic/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;

			if(in_array($imgExt, $valid_extensions)){			
		
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic); 

$saveaccount="INSERT INTO categories (CategoryName, Descriptions, CatPic) VALUE ('$CategoryName','$Descriptions' , '$itempic')";
mysqli_query($dbcon,$saveaccount);
 echo "<script>alert('ບັນທຶກຂໍ້ມູນສຳເລັດ')</script>";       
 echo "<script>window.open('category.php','_self')</script>";
		 
}	
		else{
					
					  echo "<script>alert('ຂໍອະໄພ, ຂະໜາດຟາຍຮູບຂອງທ່ານສູງເກິນໄປ')</script>";				
					  echo "<script>window.history.go(-1);</script>";
				}
	}
	else{
				
				  echo "<script>alert('ຂະໜາດຟາຍຮູບຕ້ອງເປັນ JPG, JPEG, PNG & GIF ເທົ່ານັ້ນ')</script>";				
					  echo "<script>window.history.go(-1);</script>";
	}
}
?>
<!-- Delete data by id -->
<?php
	require_once '../../config.php';
	
	if(isset($_GET['delete_id']))
	{	
		$stmt_select = $DB_con->prepare('SELECT CatPic FROM categories WHERE CategoryID =:CategoryID');
		$stmt_select->execute(array(':CategoryID'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("Catpic/".$imgRow['CatPic']);
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM Categories WHERE CategoryID =:CategoryID');
		$stmt_delete->bindParam(':CategoryID',$_GET['delete_id']);
		$stmt_delete->execute();	
		header("Location: category.php");
	}
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ໜ້າຈັດການພະນັກງານ</title>
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
	             <a class="dropdown-item" href="category.php">ບັນທຶກປະເພດສິນຄ້າ</a>
				<a class="dropdown-item" href="unit.php"> ບັນທຶກຫົວໜ່ວຍສິນຄ້າ</a>
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
          <center> <h3><strong>ຟອມປ້ອນຂໍ້ມູນປະເພດສິນຄ້າ</strong> </h3></center>   
           </div>
         <br />
			       <form enctype="multipart/form-data" method="POST" action="">   
			  <div class="form-group">
			    <label for="FirstName">ປະເພດສິນຄ້າ</label>
			    <input type="text" class="form-control" name="CategoryName" required/>
			  </div>
			  <div class="form-group">
			    <label for="LastName">ລາຍລະອຽດປະເພດສິນຄ້າ</label>
			    <input type="text" class="form-control" name="Descriptions" required/>
			  </div> 
			  <div class="form-group">
			    <label for="Picture">ຮູບ</label>
			    <input type="file" class="form-control" accept="image/*" name="CatPic" required/>
			  </div>
			     
			      <div class="">
			         <input type="submit" class="btn btn-primary" name="CatSave" value="ຕົກລົງ">
			         </div>        
			        </form>
			    </div>
			 <!-- end -->
	
	 <!-- Datatables -->
	 <br/>
	 <div class="">  
        <br/>                    
          <center> <h3><strong>ຕາຕະລາງປະເພດສິນຄ້າ</strong> </h3></center>   
           </div>
         <br />
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th>ຮູບ</th>	
                  <th>ປະເພດສິນຄ້າ</th>
                  <th>ລາຍລະອຽດປະເພດສິນຄ້າ</th>
				     <th>ລາຍລະອຽດປະເພດສິນຄ້າ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
include("../../config.php");
	$stmt = $DB_con->prepare('SELECT * FROM categories');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);		
			?>
                <tr>
                  <td>
				<center> <img src="Catpic/<?php echo $CatPic; ?>" class="img img-rounded"  width="50" height="50"/></center>
				 </td>
                 <td><?php echo $CategoryName; ?></td>
			 	 <td><?php echo $Descriptions ?></td>	 			
                  <td>
                <!-- delete and update data emp -->
 				<a class="btn btn-info" href="" title="ຄລິກເພື່ອແກ້ໄຂ" onclick="return confirm('ຕ້ອງການແກ້ໄຂຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-pencil'></span> ແກ້ໄຂຂໍ້ມູນ</a>
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['CategoryID']; ?>" title="ຄລິກເພື່ອລຶບ" onclick="return confirm('ຕ້ອງການລຶບຂໍ້ມູນນີ້ຫຼືບໍ່?')"><span class='fa fa-trash'></span> ລຶບຂໍ້ມູນ</a>
				
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