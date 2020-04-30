<?php
session_start();
if(!$_SESSION['admin_username'])
{
    header("Location: ../index.php");
}
?>
	<?php
	require_once '../config.php';
	include_once '../db.php';
	if(isset($_GET['delete_id']))
	{	
		//ຂຽນຄ່າລຶບແລ້ວບວກຈຳນວນສິນຄ້າໃສ່ຄືນ
		$Sel = mysqli_query($dbcon, "SELECT Sell_Qty, ProductID from sellproduct where SellID= '".$_GET['delete_id']."'");
		while ($row = mysqli_fetch_array($Sel)) {
			$n = $row['Sell_Qty'];
			$m = $row['ProductID'];
		}
		$sql = mysqli_query($dbcon, "SELECT ProductQuantity From products where ProductID= '$m'");
		while ($row1 = mysqli_fetch_array($sql)) {
			$d = $row1['ProductQuantity'];
		}
		$plus = $d + $n;
		$sqlupdate = mysqli_query($dbcon, "UPDATE products set ProductQuantity='$plus' where ProductID='$m'");
		$stmt_delete = $DB_con->prepare('DELETE FROM sellproduct WHERE SellID =:SellID');
		$stmt_delete->bindParam(':SellID',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: Sellsuccess.php");
	}

?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin page</title>
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
                    <a class="nav-link" href="index.php"><span class='fa fa-home'></span>ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ຈັດການລູກຄ້າ 
              </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="Customers.php">ຈັດການລູກຄ້າ</a>
           <a class="dropdown-item" href="Selldetails.php">ລາຍລະອຽດການຈອງຂອງລູກຄ້າ	</a>
             <a class="dropdown-item" href="Sellsuccess.php">ສິນຄ້າທີ່ຂາຍແລ້ວ	</a>
            <!-- <a class="dropdown-item" href="views_sell.php">ກວດສອບການຂາຍ  </a> -->
            </div>
            </li>
              </ul>
              <?php include_once 'include/session.php';?>
          </div>
      </div>
  </nav>

<!-- table selldetails -->
			<div id="page-wrapper">         				 
			<div class="">
   <center> <h3><strong>ລາຍລະອຽດການຂາຍ</strong> </h3>
   </center>
			</div> <br />
		 <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຊື່ລູກຄ້າ</th>
				  <th>ລະຫັດສິນຄ້າ</th>
				  <th>ຊື່ສິນຄ້າ</th>
				  <th>ປະເພດສິນຄ້າ</th>
                  <th>ລາຄາ</th>
				  <th>ຈຳນວນ</th>
				  <th>ຫົວໜ່ວຍສິນຄ້າ</th>
				  <th>ວັນທີທີ່ຈອງ</th>
				  <th>ລວມເງິນ</th>
				  <th>ຮັບສິນຄ້າ</th>
				  <!-- <th>ຈັດການ</th> --> 
                </tr>
              </thead>
              <tbody>
			  <?php
include("../config.php");
	$stmt = $DB_con->prepare('SELECT SellID, Sell_date,customers.CustFirstName, customers.CustLastName, Sell_name, Sell_Price, Sell_Qty, Sell_total, ProductID, Sell_Unit, Sell_Cat from sellproduct, customers WHERE sellproduct.CustID=customers.CustID and Sell_status="Complete" ORDER BY Sell_date desc');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
                <tr>
				 <td><?php echo $CustFirstName;?> 
				 	 <?php echo $CustLastName; ?></td>
				 <td><?php echo $ProductID; ?></td>
				 <td><?php echo $Sell_name; ?></td>
				<td> <?php
		        $sql = mysqli_query($dbcon, "SELECT * from categories where CategoryID = '$Sell_Cat'");
		        while ($row1 = mysqli_fetch_array($sql)) {
		             echo $row1['CategoryName'];  ?>
		             <input type="hidden" name="CategoryID" value="<?php echo $row1['CategoryID']; ?>">
		       <?php }
		      ?>
        		</td>
				 <td><?php echo $Sell_Price; ?> ກີບ</td>
				 <td><?php echo $Sell_Qty; ?></td>
				 <td> <?php
		        $sql = mysqli_query($dbcon, "SELECT * from Productunit where UnitID = '$Sell_Unit'");
		        while ($row1 = mysqli_fetch_array($sql)) {
		             echo $row1['UnitName'];  ?>
		             <input type="hidden" name="UnitID" value="<?php echo $row1['UnitID']; ?>">
		       <?php }
		      	?>
         		</td> 
				 <td><?php echo $Sell_date; ?></td>
				 <td> <?php echo $Sell_total; ?> ກີບ</td> 
				 <td>ຮັບແລ້ວ</td>
				<!-- <td>		           				 			
				 <a class="btn btn-danger" href="?delete_id=<?php //echo $row['SellID']; ?>" title="ຄລິກເພື່ອລຶບຂໍ້ມູນ" onclick="return confirm('ທ່ານຕ້ອງການຈະລົບຂໍ້ມູນນີ້ບໍ່?')">
				  <span class='fa fa-trash'></span> 
				  ລຶບສິນຄ້າ</a>      
                  </td>-->
                </tr>           
              <?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class=""

				</div>';
		echo "</div>";
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; ບໍ່ພົບຂໍ້ມູນໃດໆ ...
            </div>
        </div>
        <?php
	}
	
?>	
				</tbody>
			</table>
		</div>
	</div> <!-- /#wrapper -->
	<?php include '../include/footer.php'; ?>  


    <?php include_once 'include/showdatatables.js';?>	
	
	<?php include_once 'include/productprice.js';?>
	</body>
	</html>