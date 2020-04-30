<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Page</title>
 		<?php include_once '../supplier/library.php';?>
 		<style>
 			@page{
 				margin:0;
 			}

 		</style>
	</head>
	<body onload="">
		<div class="container">
			<br/><br/><br/>
        <div class="pull-right"><a href="printpro.php" class="btn btn-primary"> &nbsp;<span class="fa fa-print">print</span></a>
        </div>
		<!-- Sellproduct page -->
		<br/><br />
	<div class="">  
        <br/>                    
          <center> <h3><strong>ລາຍງານຂໍ້ມູນສິນຄ້າ</strong> </h3></center>   
           </div>
         <br />
			 	 		 			  
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຮູບສິນຄ້າ</th>
                  <th>ຊື່ສິນຄ້າ</th>
				  <th>ລາຄາ</th>
				  <th>ປະເພດສິນຄ້າ</th> 
				  <th>ຫົວໜ່ວຍສິນຄ້າ</th> 
				  <th>ສະຕ໊ອກສິນຄ້າ</th> 
				  <th>ລາຍລະອຽດສິນຄ້າ</th>
				  <th>ວັນທີທີ່ເພິ່ມຂໍ້ມູນ</th>
                 
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
                  <td>
				<center> <img src="../images/<?php echo $ProductImage; ?>" class="img img-rounded"  width="50" height="50" /></center>
				 </td>
                 <td><?php echo $ProductName; ?></td>
				 <td> <?php echo $ProductPrice; ?> ກີບ</td>
				 <td><?php 
				 include '../../db.php';
				 $sel = mysqli_query($dbcon, "SELECT * FROM categories WHERE CategoryID='$CategoryName'");

				 while ($r = mysqli_fetch_array($sel)) {
				     echo $r['CategoryName'];
				 }
				  ?></td>
				 <td><?php 
				 include '../db.php';
				 $sel = mysqli_query($dbcon, "SELECT * FROM productunit WHERE UnitID='$UnitID'");

				 while ($r = mysqli_fetch_array($sel)) {
				     echo $r['UnitName'];
				 }
				  ?></td>
				 <td><?php echo $ProductQuantity; ?></td> 
				 <td> <?php echo $Description; ?>  </td>
				 <td><?php echo $ProductUpdateDate; ?></td>
                </tr>
               
              <?php
		}
		
	}
	
		?>	
		</tbody>
		</table>
        </div>
    </div>
    </body>
    </html>
