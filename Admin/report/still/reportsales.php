<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once '../../config.php';
	
	if(isset($_GET['previous_id']) && !empty($_GET['previous_id']))
	{
		$view_id = $_GET['previous_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM customers WHERE CustID=:CustID');
		$stmt_edit->execute(array(':CustID'=>$view_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
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
	</head>
	<body>
	<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			   <?php include_once 'icon.php';  ?>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="../index.php"><span class='fa fa-home'></span>ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			     
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-filter'></span>ເລືອກລາຍງານ 
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">ລາຍງານການຂາຍ</a>
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
                            <li><a href="logout.php">
                                <span class="fa fa-power-off"></span> ອອກລະບົບ</a></li>
                        </ul>
                    </li>
                </ul>
		  </div>
		</div>
	</nav><!-- end -->
	<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">ການຂາຍປະຈຳອາທິດ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">ການຂາຍປະຈຳເດືອນ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#references" role="tab" data-toggle="tab">ການຂາຍປະຈຳປີ</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="container">
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="profile"><div id="page-wrapper">
			 <div class="">  
        <br/>                    
          <center> <h3><strong>ລາຍງານຂໍ້ມູນປະຈຳອາທິດ</strong> </h3></center>   
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
include("../../config.php");
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Complete'");
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
                include("../../db.php");
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
		}include("../../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where Sell_status='Complete'");
		 $stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>	
		<td colspan="6"><a class="btn btn-success" href="printsales.php" target="_blank"><span class="fa fa-print"></span>&nbsp; print
		</a>
		</td>
		<td colspan="2"><?php echo $totalx;?>
		</td>
	</tr>
	<?php }
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="fa fa-info-sign"></span> &nbsp; ບໍ່ມີການສັ່ງຈອງສິນຄ້າໃດໆ...
            </div>
        </div>
        <?php
	}
	
?>	
</tbody>
	</table>
	</div>
</div>
</div>
  <div role="tabpanel" class="tab-pane fade" id="buzz"><div id="page-wrapper">
			 <div class="">  
        <br/>                    
          <center> <h3><strong>ລາຍງານຂໍ້ມູນປະຈຳເດືອນ</strong> </h3></center>   
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
include("../../config.php");
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Complete'");
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
                include("../../db.php");
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
		}include("../../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where Sell_status='Complete'");
		 $stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>	
		<td colspan="6"><a class="btn btn-success" href="printsalesmon.php" target=""><span class="fa fa-print"></span>&nbsp; print
		</a>
		</td>
		<td colspan="2"><?php echo $totalx;?>
		</td>
	</tr>
	<?php }
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="fa fa-info-sign"></span> &nbsp; ບໍ່ມີການສັ່ງຈອງສິນຄ້າໃດໆ...
            </div>
        </div>
        <?php
	}
	
?>	
</tbody>
	</table>
	</div>
</div>
</div>
  <div role="tabpanel" class="tab-pane fade" id="references"><div id="page-wrapper">
			 <div class="">  
        <br/>                    
          <center> <h3><strong>ລາຍງານຂໍ້ມູນປະຈຳເດືອນ</strong> </h3></center>   
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
include("../../config.php");
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Complete'");
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
                include("../../db.php");
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
		}include("../../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where Sell_status='Complete'");
		 $stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>	
		<td colspan="6"><a class="btn btn-success" href="printsalesyear.php" target=""><span class="fa fa-print"></span>&nbsp; print
		</a>
		</td>
		<td colspan="2"><?php echo $totalx;?>
		</td>
	</tr>
	<?php }
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="fa fa-info-sign"></span> &nbsp; ບໍ່ມີການສັ່ງຈອງສິນຄ້າໃດໆ...
            </div>
        </div>
        <?php
	}
	
?>	
</tbody>
	</table>
	</div>
</div>
</div>
</div>
</div>

<?php include '../../include/footer.php'; ?>  

</body>
</html>