<?php 
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}
?>
<?php include_once 'include/selectorder.php';?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>shop</title>
 	<?php include_once 'include/librarycust.php';
 	?>
 	<style>
 		@page{margin:0;}
 	</style>
	</head>
	<body><div class="container">
		<br/><br/><br/>
		<center><h4> <span class="glyphicon glyphicon-list-alt"></span>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h4>
			<h5>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</h5></center>
        <div class="pull-left"><img src="../photo/icon1.jpeg" style="width: 80px; height: 80px;"></div>
        <div class="pull-right"><p align="center">ຮ້ານ ອິນຊີບ້ານເຮົາ</p>
        	<p align="center">ບ. ສົມຫວັງ, ມ.ຫາດຊາຍຟອງ, ນະຄອນຫຼວງວຽງຈັນ
        	</p>
        	<p align="center">ອີເມວ: Vaijai_Trading@gmail.com</p>
        	<p align="center">ເບີໂທລະສັບ: 030 53 32 224 </p>
        </div>
		<!-- Sellproduct page -->
		<br/><br /><br /><br /><br /><br /><br />
		 <div id="page-wrapper">			
			<div class="alert alert-default" style="">
         <center>
         	<h5 align="center"><b> ໃບບິນການຈອງສິນຄ້າ</b></h5></center>
        </div>
			<br />
				</div>		  
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ລະຫັດສິນຄ້າ</th>
                  <th>ຊື່ສິນຄ້າ</th>
                  <th>ປະເພດສິນຄ້າ</th>
                  <th>ລາຄາ</th>
				  <th>ຈຳນວນສິນຄ້າ</th> 
				  <th>ຫົວໜ່ວຍ</th>
				  <th>ລວມເງິນທັງໝົດ</th>     
                </tr>
              </thead>
              <tbody>
			  <?php
		include("../config.php");
 
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Ordered' and CustID='$CustID'");
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);		
			?>
                <tr>
                <td><?php echo $ProductID; ?> </td>             
                 <td><?php echo $Sell_name; ?></td>
               <td>  <?php
        include("../db.php");
      	global $dbcon;
        $sql = mysqli_query($dbcon, "SELECT * FROM categories where CategoryID = '$Sell_Cat'");
        while($row = mysqli_fetch_array($sql)) {
          ?> 
				 <?php echo $row['CategoryName']; ?>
	<?php
			} ?> 
				</td>
				 <td> <?php echo $Sell_Price; ?> ກີບ </td>
				 <td><?php echo $Sell_Qty; ?></td>
				 <td><?php
        $sql = mysqli_query($dbcon, "SELECT * FROM productunit where UnitID = '$Sell_Unit'");
        while($row = mysqli_fetch_array($sql)) {
          ?> 
				  <?php echo $row['UnitName']; ?>
	<?php
			} ?> 
			</td>
				 <td> <?php echo $Sell_total; ?> ກີບ </td>
                </tr>
        <?php
		}
		include("../config.php");
		$stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where CustID=:CustID and Sell_status='Ordered'");
		$stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>
		<td colspan="6" background-color="red" align="right">ລວມລາຄາທີ່ສັ່ງໄວ້:
		</td>
		
		<td> <?php echo $totalx; ?> ກີບ
		</td>
		
		
		
		</tr>
		</tbody>
		</table>
		</div>
		<br />
		<div class="pull-left">&emsp; <b>ລູກຄ້າ</b> <br/> <?php echo $CustFirstName; ?> <?php echo $CustLastName; ?><br/><br/>
		
		</div>		
		<div class="pull-right">
		ວັນທີ: <?php echo date("d/m/Y"); ?>

		</div>		
		</div>
<?php	}
		
?>

	</tbody>
	</table>	
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
</div>
</div>
</body>
</html>