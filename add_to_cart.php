<?php
	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	if(isset($_GET['cart']) && !empty($_GET['cart']))
	{
		$id = $_GET['cart'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM Products WHERE ProductID =:ProductID');
		$stmt_edit->execute(array(':ProductID'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: shop.php");
	}
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
			<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inzee Organic Laos,LTD</title>
   <?php include_once 'include/librarycust.php';?>
	</head>
	<body> 
 <!-- navbar -->   
<?php 
include_once 'include/header.php';
include 'include/navbar.php'; 
?>    
  <div id="page-wrapper">        
 <form role="form" method="post" action="">
    <?php
  if(isset($errMSG)){
    ?>
    <?php
  }
  ?> 
    <div class="alert alert-default container" style="">
         <h3> <span class="fa fa-info-sign"></span> ລາຍລະອຽດການສັ່ງຊື້</h3>
        </div>
     <td><input class="form-control" type="hidden" name="Sell_Unit" value="<?php echo $UnitID; ?>" /></td>
     <td><input class="form-control" type="hidden" name="Sell_Cat" value="<?php echo $CategoryName; ?>" /></td>
    <td><input class="form-control" type="hidden" name="Sell_Price" value="<?php echo $ProductPrice; ?>" /></td>
    <td><input class="form-control" type="hidden" name="CustID" value="<?php echo $CustID; ?>" /></td>
    <td><input type="hidden" name="ProductQuantity" id="ProductQuantity" value="<?php echo $ProductQuantity; ?>"></td>
    <div class="container">
  <table class="table table-bordered">  
   <tr>
     <td> <label class="control-label"><h5>ລະຫັດສິນຄ້າ</h5></label></td>
     <td><input class="form-control" type="text" name="ProductID" value="<?php echo $ProductID; ?>" disabled/></td>    
    </tr>
   <tr>
      <td><label class="control-label"><h5>ຊື່ສິນຄ້າ</h5></label> </td>
      <td><input class="form-control" type="text" name="ProductName" value="<?php echo $ProductName; ?>" disabled/> </td>  
    </tr>
     <tr>
      <td><label class="control-label"><h5>ປະເພດສິນຄ້າ</h5></label></td>  
      <!-- added -->
      <?php
      include("db.php");
      global $dbcon;
        $sql = mysqli_query($dbcon, "SELECT * FROM categories where CategoryID = '$CategoryName'");
        while($row = mysqli_fetch_array($sql)) {
          ?> 
      <td><input class="form-control" type="text" name="Sell_Cat" value="<?php echo $row['CategoryName']; ?>" disabled/>
      </td>
            <?php
        }
    ?>    
    </tr>
   <tr>
      <td><label class="control-label"><h5>ລາຄາ</h5></label></td>
     <?php $p = $ProductPrice;
      $k = 5000;
      $propice = $p + $k; ?>
      <td><input class="form-control" type="text" name="ProductPrice" value="<?php echo $propice; ?>ກີບ" disabled/></td> 
    </tr> 
      <tr>
      <td><label class="control-label"><h5>ຮູບສິນຄ້າ</h5></label></td>
      <td>
          <p align="center"><img class="img img-thumbnail" src="Admin/images/<?php echo $ProductImage; ?>" style="height:250px;width:500px;" /></p>   
      </td>
      </tr>
     <tr>
      <td><label class="control-label"><h5>ຈຳນວນສັ່ງ</h5></label></td>
   <!-- Added -->
   <?php
        $sql = mysqli_query($dbcon, "SELECT * FROM productunit where UnitID = '$UnitID'");
        while($row = mysqli_fetch_array($sql)) {
          ?>
          <td> 
          <input class="form-control" type="number" placeholder="Quantity" name="Sell_Qty" value="1" onkeypress="return isNumber(event)" onpaste="return false" required />
        </td>
      </tr>
        <tr>
          <td><label class="control-label"><h5>ຫົວໜ່ວຍສິນຄ້າ</h5></label></td>
        <td>
          <input class="form-control" type="text" name="Sell_Unit" value="<?php echo $row['UnitName']; ?>" disabled/>
        </td><!-- return isNumber(event) -->
      <?php     
        }
    ?>
    </tr>     
    <tr>
      <td colspan="2" align="center"><a href="custregister1.php" name="Sell_save" class="btn btn-primary">
        <span class="fa fa-shopping-cart"></span> ຕົກລົງ
        </a>   
      <a class="btn btn-danger" href="shop.php?id=1"> <span class="fa fa-backward"></span> ຍົກເລີກ </a>      
        </td>
    </tr> 
</table> 
</div>   
</form>
<?php 
include_once 'include/footer1.php';
?>
</body>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
</html>
 
