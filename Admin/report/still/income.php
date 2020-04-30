<?php
session_start();
if(!$_SESSION['admin_username'])
{
    header("Location: ../index.php");
}
?>
	<?php
	require_once ('../../config.php');
	include_once ('../../db.php');
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin page</title>
 		<?php include_once '../supplier/library.php';?>
 		<style>
 			@page{
 				margin:0;
 			}

 		</style>
	</head>
	<body onload="Print();" onclick="goBack()">
<div class="container">
			<br/><br/><br/>
		<center><h4> <span class=""></span>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h4>
			<h5>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</h5></center>
        <div class="pull-left"><img src="../../photo/icon1.jpeg" style="width: 80px; height: 80px;"></div>
        <div class="pull-right"><p align="center">ຮ້ານ ອິນຊີບ້ານເຮົາ</p>
        	<p align="center">ບ. ສົມຫວັງ, ມ.ຫາດຊາຍຟອງ, ນະຄອນຫຼວງວຽງຈັນ
        	</p>
        	<p align="center">ອີເມວ: Vaijai_Trading@gmail.com</p>
        	<p align="center">ເບີໂທລະສັບ: 030 53 32 224 </p>
        </div>
		<!-- Sellproduct page -->
		<br/><br /><br /><br /><br /><br /><br />
			<div id="page-wrapper">         				 
			<div class="">
   <center> <h3><strong>ລາຍງານລາຍຮັບ</strong> </h3>
   </center>
			</div> <br />
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
				  <th>ວັນທີຈອງສິນຄ້າ</th>
				  <th>ລວມເງິນ</th> 
                </tr>
              </thead>
              <tbody>
			  <?php
include("../../config.php");
	$stmt = $DB_con->prepare('SELECT SellID, Sell_date, Sell_name, Sell_Price, Sell_Qty, Sell_total, ProductID, Sell_Unit, Sell_Cat from sellproduct WHERE Sell_status="Complete" ORDER BY Sell_date desc');
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
                </tr>           
              <?php
		} ?>
		</tbody>
		<?php
include("../../config.php");
		$stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where Sell_status='Complete'");
		$stmt_edit->execute(array(':SellID'=>$SellID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row); ?>	
		<tr><td colspan="7"> </td>
				<td> <?php echo $totalx; ?> ກີບ</td>
		</tr>
		</table>
		</div>
		<br />
		</div>
		<div class="pull-right">
                   
                <b>ລາຍງານໂດຍ:</b><label style="margin-left: 20px"><?php extract($_SESSION); echo $admin_username; ?></label><br/>
                <b>ວັນທີ: <?php  echo date("d/m/Y");?><br/>
            </div>
<?php	}else{
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
	
	<script type="text/javascript">
		function Print() {
		window.print();
}
		function goBack() {
    window.history.back();
}
	</script>
	</body>
	</html>