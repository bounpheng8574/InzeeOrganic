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
  //   // ຂຽນຄ່າລຶບແລ້ວບວກຈຳນວນສິນຄ້າໃສ່ຄືນ
  //   $Sel = mysqli_query($dbcon, "SELECT Sell_Qty, ProductID from sellproduct where SellID= '".$_GET['delete_id']."'");
  //   while ($row = mysqli_fetch_array($Sel)) {
  //     $n = $row['Sell_Qty'];
  //     $m = $row['ProductID'];
  //   }
  //   $sql = mysqli_query($dbcon, "SELECT ProductQuantity From products where ProductID= '$m'");
  //   while ($row1 = mysqli_fetch_array($sql)) {
  //     $d = $row1['ProductQuantity'];
  //   }
  //   $plus = $d + $n;
  //   $sqlupdate = mysqli_query($dbcon, "UPDATE products set ProductQuantity='$plus' where ProductID='$m'");
    //end
    $stmt_delete = $DB_con->prepare('DELETE FROM sellproduct WHERE SellID =:SellID');
    $stmt_delete->bindParam(':SellID',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: sellproduct.php");
  }

?>

<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>shop</title>
 	<?php include_once 'include/librarycust.php';
 	?>
	</head>
	<body>
		<!-- add nav and modal -->
<?php 
include_once 'include/header.php';
include 'include/navbar.php'; 
?>
         <center><h3> <span class="fa fa-list-alt"></span> ລາຍການຈອງສິນຄ້າ</h3></center>
        </div>
			<br />
			<div class="container">			  
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
        				  <th>ລວມເງິນທັງໝົດ</th>
                  <th>ຈັດການ</th>
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
        <td><?php echo $ProductID; ?></td>
        <td><?php echo $Sell_name; ?></td>
				<td> <?php echo $Sell_Price; ?> ກີບ </td>
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
		  $stmt_edit = $DB_con->prepare("select sum(Sell_total) as totalx from sellproduct where CustID=:CustID and Sell_status='Ordered'");
		$stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row); ?>	
		<tr>
		<td colspan="7" align="right">ລວມລາຄາທີ່ສັ່ງໄວ້:
		</td>
		<td> <?php echo $totalx; ?> ກີບ </td>	
		</tr>
	</tbody>
 <td><a class="btn btn-primary" href="bill.php">ຮັບໃບບິນ  </td>
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
            	<span class="fa fa-info-sign"></span> &nbsp; ບໍ່ພົບສິນຄ້າໃດໆ ...
            </div>
        </div>
        <?php
	}	
?>
</tbody>
      </table>  
        </div>
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
</div>
</div>
</body>
</html>