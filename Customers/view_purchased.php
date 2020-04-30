<!-- y br dai paeng -->
<?php 
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}

?>
<!-- got -->
<?php
//taf navbar show price view_phurchased
 include("../config.php");
 extract($_SESSION); 
      $stmt_edit = $DB_con->prepare('SELECT * FROM customers WHERE CustEmail =:CustEmail');
    $stmt_edit->execute(array(':CustEmail'=>$CustEmail));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);
    ?>
<?php
 include("../config.php");
		$stmt_edit = $DB_con->prepare("SELECT SUM(Sell_total) as total from sellproduct where CustID=:CustID and Sell_Status='Ordered_finished'");
		$stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>		
<?php
  require_once '../config.php';
   include_once '../db.php';
   if(isset($_GET['delivery']))
	{
	// ຂຽນຄ່າລຶບແລ້ວລົບຈຳນວນສິນຄ້າໃນສະຕ໊ອກ
    $Sel = mysqli_query($dbcon, "SELECT Sell_Qty, ProductID from sellproduct where SellID= '".$_GET['delivery']."'");
    while ($row = mysqli_fetch_array($Sel)) {
      $n = $row['Sell_Qty'];
      $m = $row['ProductID'];
    }
    $sql = mysqli_query($dbcon, "SELECT ProductQuantity From products where ProductID= '$m'");
    while ($row1 = mysqli_fetch_array($sql)) {
      $d = $row1['ProductQuantity'];
    }
    $minusStock = $d - $n;
    $sqlupdate = mysqli_query($dbcon, "UPDATE products set ProductQuantity='$minusStock' where ProductID='$m'");
	$stmt_delete = $DB_con->prepare('UPDATE sellproduct SET Sell_status="Complete" WHERE Sell_status="Ordered_Finished" and SellID=:SellID');
		$stmt_delete->bindParam(':SellID',$_GET['delivery']);
		$stmt_delete->execute();
		echo "<script>alert('Item/s successfully ຈອງແລ້ວ!')</script>";	
		
		header("Location: view_purchased.php");
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
include 'include/navbar1.php'; 
?>
		<!-- view purchase coding -->
	<div class="container">    
		<div class="alert alert-default" style="">
         <center><h3> <span class="glyphicon glyphicon-eye-open"></span>ລາຍການສັ່ງຊື້ສິນຄ້າ</h3></center>
        </div>
			<br />			  
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                 <th>ລະຫັດສິນຄ້າ</th>
                 <th>ຊື່ສິນຄ້າ</th>
                  <th>ລາຄາ</th>
                  <th>ປະເພດສິນຄ້າ</th>
                  <th>ຫົວໜ່ວຍ</th>
				  <th>ຈຳນວນ</th>
				  <th>ລວມເງິນ</th>
				  <th>ຮັບສິນຄ້າ</th>           
                </tr>
              </thead>
              <tbody>
			  <?php
include("../config.php");
 
	$stmt = $DB_con->prepare("SELECT * FROM sellproduct where Sell_status='Ordered_Finished' and CustID='$CustID'");
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);					
			?>
            <tr> 
            	 <td><?php  echo $ProductID; ?></td>     
                 <td><?php echo $Sell_name; ?></td>
                 <td>
			<?php  $sql = mysqli_query($dbcon, "SELECT * FROM categories where CategoryID = '$Sell_Cat'");
		        while($row = mysqli_fetch_array($sql)) {
		          ?> 
						 <?php echo $row['CategoryName']; ?>
			<?php
					} ?> 
		        </td>
				 <td> <?php echo $Sell_Price; ?>ກີບ </td>
				 
				 <td><?php echo $Sell_Qty; ?></td>
				 <td><?php
		      include("../db.php");
		      global $dbcon;
		        $sql = mysqli_query($dbcon, "SELECT * FROM productunit where UnitID = '$Sell_Unit'");
		        while($row = mysqli_fetch_array($sql)) {
		          ?> 
						  <?php echo $row['UnitName']; ?>
			<?php
					} ?> 
        		</td>
				 <td> <?php echo $Sell_total; ?>ກີບ </td>
				 <td><a class="btn btn-block btn-primary" href="?delivery=<?php echo $SellID;?>"><span class='fa fa-delivery'></span> ຮັບສິນຄ້າ</a></td>
             </tr>
        
       <?php
		}
		?>
		</tbody>
		<?php 
        include("../config.php");
		 $stmt_edit = $DB_con->prepare("SELECT sum(Sell_total) as totalx from sellproduct where CustID=:CustID and Sell_status='Ordered_Finished'");
		 $stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		?>
		<tr>
			<td colspan="6"></td>
			<td colspan="2"><?php echo $totalx ;?> ກີບ</td>
		
	</tr>
		</table>
		</div>
		<br />
		<div>   
	</div>
	</div>
<?php	}else{
		?>			
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; ບໍ່ພົບຂໍ້ມູນສິນຄ້າໃດໆ ...
            </div>
        </div>
    </tbody>
</table>
        <?php
	}
?>		
         </div>
     </div>
    <?php 
include_once '../include/footer1.php';
?> 
     
     <?php //include_once 'include/showdatatables.js';
     ?>
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
	
