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
    // ຂຽນຄ່າລຶບແລ້ວບວກຈຳນວນສິນຄ້າໃສ່ຄືນ
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
		<!-- Sellproduct page -->
		 <div class="container">			
			<div class="alert alert-default" style="">
         <center><h3> <span class="fa fa-list-alt"></span> ລາຍການຈອງສິນຄ້າ</h3></center>
        </div>
			<br />
						  
			<div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ລະຫັດສິນຄ້າ</th>
                  <th>ຊື່ສິນຄ້າ</th>
                  <th>ລາຄາ</th>
                  <!-- <th>ຫົວໜ່ວຍ</th>
                  <th>ປະເພດສິນຄ້າ</th>  -->
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
		<td colspan="5" align="center">ລວມລາຄາທີ່ສັ່ງໄວ້:
		</td>
		<td> <?php echo $totalx; ?> ກີບ </td>	
		</tr>
	</tbody>
	</table>
   <div class="col-sm-12">   
        <!-- Button trigger modal -->
    <a href="" title="Cash Money?" class="btn btn-success"  data-toggle="modal" data-target="#myPaid"><span class='fa fa-credit-card'></span>
      ຊຳລະເງິນຜ່ານບັດທະນາຄານ
    </a>

   <!-- <a href="payment.php" class="btn btn-block btn-success border-0" href="" title="Cash Money?" onclick="return confirm('ກົດຕົກລົງເພື່ອດຳເນີນການ ຫຼື ຍົກເລີກເພືອກັບຄືນ')">
</a> -->
    <a class="btn btn-info" href="success1.php" title="No acount payment" onclick="return confirm('ດຳເນີນການຖ້າບໍ່ຈ່າຍຜ່ານບັນຊີ')"><span class='fa fa-truck'></span>ຈ່າຍເມື່ອຮັບສິນຄ້າ</a>
  </div>  
		<!-- modal payment -->
		<div class="modal fade" id="myPaid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="header">
        <h5 align="center" class="alert alert-success" id="exampleModalLabel"><b>ການຊຳລະເງິນ </b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <form role="form" method="POST" action="payment.php"> 
        <?php
  if(isset($errMSG)){
    ?>
    <?php
  }
  ?> 
    <div class="modal-body">
    <div class="row">
      <div class="form-group col-sm-6">

      <td><input class="form-control" type="hidden" name="CustID" value="<?php echo $CustID; ?>" /></td>     
      <div class="form-group">
      <label for="inputState" class="alert alert-info">ບັນຊີທະນາຄານຂອງທ່ານ <span class='fa fa-dollar'></span>
      </label>
    </div>
    <div class="form-group">
      <select class="form-control" name="accbank">
        <option selected>ເລືອກບັນຊີຂອງທ່ານ...</option>
        <option>ທະນາຄານການຄ້າ</option>
        <option>ທະນາຄານພົງສະຫວັນ</option>
      </select>
    </div>
      <div class="form-group">   
      <label for="accno">ໝາຍເລກບັນຊີ</label>
      <input type="text" class="form-control" name="accno" placeholder="[xxx-xx-xx-xxxxxxxx-xx]" required/>
      </div>
    <div class="form-group">
      <label for="accname">ຊື່ບັນຊີ</label>
      <input type="text" class="form-control" name="accname" placeholder="ຊື່ບັນຊືທະນາຄານຂອງທ່ານ" required/>
    </div>
  <!-- <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="checkacc" id="gridCheck" required/>
      <label class="form-check-label" for="gridCheck" required>
        ຕິກເພື່ອຍືນຍັນ ແລ້ວຈຶ່ງກົດຕົກລົງ
      </label>
    </div>
  </div> -->
   <div class="form-group" align="center">
         <input type="submit" class="btn btn-primary" name="accconfirm" value="ຕົກລົງ">
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">ຍົກເລີກ </button>
      </div>
</div>
<!-- tips -->
<div class="form-group col-sm-6">
      <label for="inputState" class="alert alert-danger">ວິທີການຈ່າຍເງິນ<br/> (ໃຫ້ຈ່າຍເງິນເຂົ້າໃນບັນຊີທະນາຄານຂອງຮ້ານ)</label>
  <div class="">
    <ul class="list-unstyled">
      <li >ເລກບັນຊີບັນຊີເງິນ ບາດ (B) : <b class="text-danger">090110200389676001 </b></li>
      <li>ເລກບັນຊີບັນຊີເງິນ ກີບ  (K) :<b class="text-danger"> 090110000389676001</b></li>
     
    </ul>
  </div>
  </div>
  </div>
  </div>
  </form>
  </div>
  </div>
  </div> <!-- end modal -->
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