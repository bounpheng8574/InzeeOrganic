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
 		<?php include_once 'include/libraryadmin.php';?>
 		 <script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
	  $('#example').dataTable();
	});
    </script>	
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
            <li class="nav-item">
			       <a class="nav-link" href="financial.php"><span class='fa fa-money'></span> ການເງິນ</a>
			      </li>
		    </ul>
				<?php include_once 'include/session.php';?>
		  </div>
		</div>
	</nav><!-- end -->
	 <!-- table selldetails -->
			<div class="container">         				 
			<div class="">
   <center> <h3><strong>ງົບປະມານລາຍຮັບ</strong> </h3>
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
				   
                </tr>
              </thead>
              <tbody>
			  <?php
include_once ("../db.php");
include("../config.php");
	$stmt = $DB_con->prepare('SELECT SellID, Sell_date,customers.CustFirstName, customers.CustLastName, Sell_name, Sell_Price, Sell_Qty, Sell_total, ProductID, Sell_Unit, Sell_Cat from sellproduct, customers WHERE sellproduct.CustID=customers.CustID and Sell_status="Ordered_Finished" ORDER BY Sell_date desc');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
                <tr>
				 <td><?php echo $CustFirstName; ?> 
				 <?php echo $CustLastName; ?></td>
				 <td><?php echo $ProductID; ?></td>
				 <td>
				<?php
			        $sql = mysqli_query($dbcon, "SELECT * FROM categories where CategoryID = '$Sell_Cat'");
			        while($row = mysqli_fetch_array($sql)) {
			          ?> 
							 <?php echo $row['CategoryName']; ?>
				<?php
						} ?> 
				</td>
				 <td><?php echo $Sell_name; ?></td>
				 <td><?php echo $Sell_Price; ?> ກີບ</td>
				 <td><?php echo $Sell_Qty; ?></td>
				 <td> <?php	 	
					$sql = mysqli_query($dbcon, "SELECT * FROM productunit where UnitID = '$Sell_Unit'");
			        while($row = mysqli_fetch_array($sql)) {
			          ?> 
							 <?php echo $row['UnitName']; ?>
				<?php
				} ?> 
				</td>
				 <td><?php echo $Sell_date; ?></td>
				 <td> <?php echo $Sell_total; ?> ກີບ</td> 	
				</tr> 	           				 
              <?php
		} 
include("../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where Sell_status='Ordered_Finished'");
		$stmt_edit->execute(array(':SellID'=>$SellID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);	
		?>
		<!-- <div> <tr>
		<td colspan="8" align="center" style="font-size:18px;"> ລວມ
		</td>	
		<td><?php //echo $totalx; ?>
		</td>
		</tr>	</div> -->
		</tbody>
			 <div> <tr>
		<td colspan="8" align="center" style="font-size:18px;"> ລວມ
		</td>	
		<td><?php echo $totalx; ?>
		</td>
		</tr>	</div> 
		</table>
		</div>
		<br />
	<?php 
	}else{
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