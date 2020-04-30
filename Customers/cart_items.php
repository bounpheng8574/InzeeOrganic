<?php 
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}

?>
<?php include_once 'include/selectorder.php';?>
		<?php

	require_once '../config.php';
	include_once '../db.php';

	 if(isset($_GET['delete_id']))
	 {	
	// 	// ຂຽນຄ່າລຶບແລ້ວບວກຈຳນວນສິນຄ້າໃສ່ຄືນ
	// 	$Sel = mysqli_query($dbcon, "SELECT Sell_Qty, ProductID from sellproduct where SellID= '".$_GET['delete_id']."'");
	// 	while ($row = mysqli_fetch_array($Sel)) {
	// 		$n = $row['Sell_Qty'];
	// 		$m = $row['ProductID'];
	// 	}
	// 	$sql = mysqli_query($dbcon, "SELECT ProductQuantity From products where ProductID= '$m'");
	// 	while ($row1 = mysqli_fetch_array($sql)) {
	// 		$d = $row1['ProductQuantity'];
	// 	}
	// 	$plus = $d + $n;
	// 	$sqlupdate = mysqli_query($dbcon, "UPDATE products set ProductQuantity='$plus' where ProductID='$m'");
		$stmt_delete = $DB_con->prepare('DELETE FROM sellproduct WHERE SellID =:SellID');
		$stmt_delete->bindParam(':SellID',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: cart_items.php");
	}

?>
<!-- outstock here -->
<?php
	require_once '../config.php';
	
	if(isset($_GET['update_id']))
	{
		$stmt_delete = $DB_con->prepare('UPDATE sellproduct SET Sell_status="Ordered" WHERE Sell_status="Pending" and CustID =:CustID');
		$stmt_delete->bindParam(':CustID',$_GET['update_id']);
		$stmt_delete->execute();
		echo "<script>alert('Item/s successfully ຈອງແລ້ວ!')</script>";	
		
		header("Location: Sellproduct.php");
	}
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>shop</title>
 		<?php include_once 'include/librarycust.php';?>
	</head>
	<body>
		<!-- add nav and modal -->
<?php 
include_once 'include/header.php';
include 'include/navbar.php'; 
?>

		<!-- cart items page -->
		<div class="container">
		<div class="alert alert-default" style="">
         <center><h3> <span class="fa fa-cart-plus"></span> ກະຕ່າສິນຄ້າ</h3></center>
        </div>
			<br />
		  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                 <th>ລະຫັດສິນຄ້າ</th>
                 <th>ຊື່ສິນຄ້າ</th>
                  <th>ລາຄາ</th>
                  <th>ຫົວໜ່ວຍ</th>
				  <th>ປະເພດສິນຄ້າ</th> 
				  <th>ຈຳນວນສິນຄ້າ</th>
				  <th>ຈຳນວນເງິນທັງໝົດ</th>
                  <th>ຈັດການຂໍ້ມູນ</th>
                </tr>
              </thead>
              <tbody>
	<?php
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Pending' and CustID='$CustID'");
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
				 <td><?php echo $Sell_Price; ?> ກີບ </td> 
				<td> <?php
        $sql = mysqli_query($dbcon, "SELECT * from Productunit where UnitID = '$Sell_Unit'");
        while ($row1 = mysqli_fetch_array($sql)) {
             echo $row1['UnitName'];  ?>
             <input type="hidden" name="UnitID" value="<?php echo $row1['UnitID']; ?>">
       <?php }
      ?>
         </td>
         <td> <?php
        $sql = mysqli_query($dbcon, "SELECT * from categories where CategoryID = '$Sell_Cat'");
        while ($row1 = mysqli_fetch_array($sql)) {
             echo $row1['CategoryName'];  ?>
             <input type="hidden" name="CategoryID" value="<?php echo $row1['CategoryID']; ?>">
       <?php }
      ?>
         </td>
				<td><?php echo $Sell_Qty; ?> </td>
				 <td> <?php echo $Sell_total; ?> ກີບ </td> 
			  <td>
                  <a class="btn btn-block btn-danger" href="?delete_id=<?php echo $row['SellID']; ?>" title="click for delete" onclick="return confirm('ລຶບການສັ່ງສິນຄ້ານີ້ ຫຼື ບໍ່?')"><span class='fa fa-trash'></span> ລຶບຂໍ້ມູນສິນຄ້າ</a>		
              </td>
                </tr>
   <?php
		}
		 include("../config.php");
		  $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where CustID=:CustID and Sell_status='Pending'");
		$stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>
		<td colspan="6" align="right">ລວມລາຄາ:</td>	
		<td> <label ><?php echo $totalx; ?></label> <input type="text" id="totalx" name="" value="<?php echo $totalx; ?>" hidden> ກີບ </td> 
		<td>

		<a class="btn btn-block btn-success" href="?update_id=<?php echo $CustID;?>" id="bnt1"> <span class="fa fa-shopping-cart"></span> ສັ່ງຈອງເລີຍ!</a>
		</td>
		</tr>
		</tbody>
		</table>
		</div>
		<br />
		</div>
<?php	}
	else
	{
		?>		
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="fa fa-info-sign"></span> &nbsp; ບໍ່ພົບຂໍ້ມູນສິນຄ້າໃດໆ ...
            </div>
        </div>
        <?php
	}
	
?>				</tbody>
			</table>	
        </div>
        <div id="Notification" style="text-align: center; color: red; font-size: 18px"></div>
        <br>
        <br>
    </div>
  
    	<?php include '../include/footer1.php'; ?>
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

<script type="text/javascript">
	var totalprice = $('#totalx').val();

  if(totalprice < 50000){
  	document.getElementById('bnt1').style.display = "none";
  	$('#Notification').html("ໝາຍເຫດ: ທ່ານຕ້ອງຊື້ສິນຄ້າເປັນຈໍານວນເງິນທັງໝົດຫຼາຍກ່ວາ 50.000 ກີບ ລະບົບຈຶ່ງທຳການຂາຍ ແລະ ຈັດສົ່ງ");

  }
</script>

</body
 

</html>
