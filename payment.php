<?php
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}
?>
<!-- outstock php procederal -->
<?php
include "../Connect.php";
if (isset($_GET['paid'])){
$SellDetailID=$_GET['SellDetailID'];
$ProductID=$_GET['ProductID'];
$EmployeeID=$_GET['EmployeeID'];
$OrderQty=$_GET['Qty'];
$State="ສຳເລັດ";

$sql="UPDATE SellDetail set State='$State', EmployeeID='$EmployeeID' where OrderID='$OrderID'";
$r=mysqli_query($link,$sql);

$sql="Select * from product where ProductID='$ProductID'";
 $r=mysqli_query($link,$sql);
 
while($data = mysqli_fetch_array($r)) {$Qty=$data['Qty'];}  
$Qty=$Qty-$OrderQty;
$sql="Update product set Qty='$Qty' where ProductID='$ProductID'";
$r=mysqli_query($link,$sql);

header("Location: ..\Employee\ReportOrder.php");
exit;

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
    <?php 
include_once 'include/header.php';
include 'include/navbar.php'; 
?>
  <div class="alert alert-success">
    <h4 align="center"><b>ການຊຳລະເງິນ </b></h4>
   </div> 
    <div class="container">
<form method="POST" action="">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>ເລືອກບັນຊີ</option>
        <option></option>
      </select>
    </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck" required>
        ຕິກເພື່ອຍືນຍັນ ແລ້ວຈຶ່ງກົດຕົກລົງ
      </label>
    </div>
  </div>
  <button type="submit" name="paid" class="btn btn-primary">ຕົກລົງ</button>
</form>
</div>
<footer>
  <?php include '../include/footer.php'; ?>
        
    </footer>
</body>
</html>
