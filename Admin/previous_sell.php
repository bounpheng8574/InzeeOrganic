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
	
	if(isset($_GET['previous_id']) && !empty($_GET['previous_id']))
	{
		$view_id = $_GET['previous_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM customers WHERE CustID=:CustID');
		$stmt_edit->execute(array(':CustID'=>$view_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: customers.php");
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
            <a class="dropdown-item" href="Selldetails.php">ລາຍລະອຽດການຂາຍ  </a>
             <!-- <a class="dropdown-item" href="previous_sell.php">ການຂາຍທີ່ຜ່ານມາ  </a>
             <a class="dropdown-item" href="views_sell.php">ກວດສອບການຂາຍ  </a> -->
            </div>
            </li>
		    </ul>
				<?php include_once 'include/session.php';?>
		  </div>
		</div>
	</nav><!-- end -->	
         <div class="container">
			 <div class="">
                        <br/>
                          <center> <h3><strong>ລາຍການຈອງສິນຄ້າຂອງລູກຄ້າ</strong> </h3></center>			  
						  </div>	  
						  <br />
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ລະຫັດສິນຄ້າ</th>
                  <th>ຊື່ສິນຄ້າ</th>
                  <th>ປະເພດສິນຄ້າ</th>
                  <th>ລາຄາ</th>
				  <th>ຈຳນວນ</th>
				  <th>ຫົວໜ່ວຍສິນຄ້າ</th>
                  <th>ລວມ</th>
				  <th>ວັນທີສັ່ງຈອງ</th>
                </tr>
              </thead>
              <tbody>
			  <?php
include("../config.php");
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where CustID='$CustID' and Sell_status='Ordered_Finished'");
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			
			
			?>
                <tr>
                <td><?php echo $ProductID; ?></td> 
                 <td><?php echo $Sell_name; ?></td>
                 <td><?php 
                include("../db.php");
      			global $dbcon;
                	$sql = mysqli_query($dbcon, "SELECT * FROM categories where CategoryID = '$Sell_Cat'");
			        while($row = mysqli_fetch_array($sql)) {
			          ?> 
							 <?php echo $row['CategoryName']; ?>
				<?php
						} ?> 
				</td>           
				 <td> <?php  echo $Sell_Price; ?>&nbsp; ກີບ </td>
				 <td><?php echo $Sell_Qty; ?></td>
				 <td><?php 	 	
					$sql = mysqli_query($dbcon, "SELECT * FROM productunit where UnitID = '$Sell_Unit'");
			        while($row = mysqli_fetch_array($sql)) {
			          ?> 
							 <?php echo $row['UnitName']; ?>
				<?php
				} ?>
				</td> 
				 <td> <?php echo $Sell_total; ?>&nbsp; ກີບ</td>
				 <td><?php echo $Sell_date; ?></td>	 
                </tr>
               
              <?php
		} 
	include("../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where CustID=:CustID and Sell_status='Ordered_Finished'");
		 $stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>
		<td colspan="6" align="center" style="font-size:18px;">ຊື່ລຸກຄ້າ: <span style="color:red;"><?php echo $CustFirstName?> &nbsp; <?php echo $CustLastName ?></span> 
			<br/> Email: <span style="color:red;"><?php echo $CustEmail ?></span> 
			<br/> ທີ່ຢູ່: <span style="color:red;"> ບ້ານ &nbsp;  <?php echo $CustAddress ?> </span>
		</td>
		<td> <?php echo $totalx ?> ກີບ</td>
		<td colspan="2">
			<a class="btn btn-danger" href="customers.php"><span class="fa fa-backward"></span>&nbsp; ກັບຄືນ</a>
		</td>
		</tr>	
		</tbody>
		</table>
		</div>
		<br />
	
				</div>
		</div>
	<?php }
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; ບໍ່ມີການສັ່ງຈອງສິນຄ້າໃດໆ...
            </div>
        </div>
        <?php
	}
	
?>	
</tbody>
	</table>
	</div>
</div>
<?php include '../include/footer.php'; ?>  

    <!-- /#wrapper -->
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