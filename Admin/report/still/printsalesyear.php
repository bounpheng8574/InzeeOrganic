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
	<body onload="Print();" onclick="goBack();">
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
	<div class="">  
        <br/>                    
          <center> <h3><strong>ລາຍງານຂໍ້ມູນການຂາຍປະຈຳປີ</strong> </h3></center>   
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
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Ordered_Finished'");
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
		} 
	include("../../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where Sell_status='Ordered_Finished'");
		 $stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		</tbody>
		</table>
		</div>
		<br />
	
				</div>
		</div>
	<?php }
	
?>	
</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
	  $('#example').dataTable();
	});
	function Print() {
		window.print();
	}
	function goBack() {
		window.history.back();
	}
    </script>	
	</body>
</html>