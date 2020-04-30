<div id="page-wrapper">
  <!-- <div class="alert alert-default">
         <center><h3> <span class="fa fa-shopping-cart"></span> ນີ້ຄືຄັງສິນຄ້າຂອງພວກເຮົາ </h3></center>
        </div> -->
  <br />
<div class="container">
  <div class="row">
<?php  
    include_once '../db.php';

    if(isset($_GET['CategoryType'])) {
      $Cate = $_GET['CategoryType'];
      
    $start=0;
    $limit=8;

    if(isset($_GET['id']))
    {
      $id= $_GET['id'];
      $start=($id-1)*$limit;
    }else{
      $id=1;
    }

    $query=mysqli_query($dbcon, "SELECT * from products where CategoryName = '$Cate' LIMIT $start, $limit");

    while($row=mysqli_fetch_array($query))
    {
?>
  <div class="col-sm-3">
    <div class="card" style="border-color: 033c73;">
      <div class="card-header" style="color:white;background-color : green;">
            <center> 
      <textarea style="text-align:center;background-color: white; font-size: 1.25rem; font-weight: 700 !important;" class="form-control" rows="1" disabled><?php echo $row['ProductName']; ?></textarea> 
      </center>
            </div>
            <div class="card-body">
           <a class="fancybox-buttons" href="../Admin/images/<?php echo $row['ProductImage'];?>" data-fancybox-group="button" title="<?php echo $id.$row['ProductName'];?>">
          
      <img src="../Admin/images/<?php echo $row['ProductImage'];?>" class='img img-thumbnail'  style='width:350px;height:150px;' />
      </a>
              
      <center><h6><?php echo $row['ProductPrice'];?> ກີບ / 
        <!-- check -->
      <?php
      $UnitID = $row['UnitID'];
        $sql = mysqli_query($dbcon, "SELECT * from Productunit where UnitID = '$UnitID'");
        while ($row1 = mysqli_fetch_array($sql)) {
             echo $row1['UnitName'];  ?>
             <input type="hidden" name="UnitID" value="<?php echo $row1['UnitID']; ?>">
       <?php }
      ?>
               
     </h6></center>
      <a class="btn btn-block btn-success" href="add_to_cart.php?cart=<?=$row['ProductID'];?>"><span class='fa fa-shopping-cart'></span> ໃສ່ກະຕ່າເລີຍ</a>
            </div>
    </div>
  </div>
  <?php  }  ?>
</div>

<?php
$rows=mysqli_num_rows(mysqli_query($dbcon, "SELECT * from products where CategoryName = '$Cate'"));
$total=ceil($rows/$limit)
 ?>
 <br />
 <ul class="pagination justify-content-center">
<?php if($id>1)
{ ?>
   <nav aria-label="Page navigation example">
  <ul class="pagination">
  <li class="page-item justify-content-center">
    <a class="page-link" style="color:white;background-color : #033c73;" href="?id=<?php echo $id-1; ?>"><span class="fa fa-backward"></span> ກັບຄືນ </a><li>
 <?php } ?>

<ul class='pagination justify-content-center'>
<?php   for($i=1;$i<=$total;$i++)
    {
      if($i==$id) {   ?>

    <li class="page-item active justify-content-center"><a class="page-link" style="color:white;background-color : #033c73;"><?php echo $i; ?> </a></li> 
<?php }else { ?> 
    <li class="page-item justify-content-center">
      <a class="page-link" href="?id=<?php echo $i; ?>"><?php echo $i; ?></a>
      </li> 
      <?php }
    }?>
   </ul>

<?php 
  if($id!=$total)
  { ?>
   <li class="page-item justify-content-center">
    <a class="page-link" style="color:white;background-color : #033c73;" href="?id=<?php echo $id+1; ?>">
     ໄປໜ້າໃໝ່ &nbsp;<span class="fa fa-forward"></span></a>
   </li>
   </ul>
<?php } 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else {
  //add
    $start=0;
    $limit=8;

    if(isset($_GET['id']))
    {
      $id= $_GET['id'];
      $start=($id-1)*$limit;
    }else{
      $id=1;
    }
    $query=mysqli_query($dbcon, "SELECT * from products LIMIT $start, $limit");

    while($row=mysqli_fetch_array($query))
    {
    // $p = $row['ProductPrice'];
    // $k = 5000;
    // $propice = $p + $k;
?>
  <div class="col-sm-3">
    <div class="card" style="border-color: 033c73;">
      <div class="card-header" style="color:white;background-color : green;">
            <center> 
      <textarea style="text-align:center; background-color: white; font-size: 1.25rem; font-weight: 700 !important;" class="form-control" rows="1" disabled><?php echo $row['ProductName']; ?></textarea> 
      </center>
            </div>
            <div class="card-body">
           <a class="fancybox-buttons" href="../Admin/images/<?php echo $row['ProductImage'];?>" data-fancybox-group="button" title="<?php echo $id.$row['ProductName'];?>">
          
      <img src="../Admin/images/<?php echo $row['ProductImage'];?>" class='img img-thumbnail'  style='width:350px;height:150px;' />
      </a>
              
      <center><h6><?php echo $row['ProductPrice'];?> ກີບ / 
        <!-- check -->
      <?php
      $UnitID = $row['UnitID'];
        $sql = mysqli_query($dbcon, "SELECT * from Productunit where UnitID = '$UnitID'");
        while ($row1 = mysqli_fetch_array($sql)) {
             echo $row1['UnitName'];  ?>
             <input type="hidden" name="UnitID" value="<?php echo $row1['UnitID']; ?>">
       <?php }
      ?>
               
     </h6></center>             
      <a class="btn btn-block btn-success" href="add_to_cart.php?cart=<?=$row['ProductID'];?>"><span class='fa fa-shopping-cart'></span> ໃສ່ກະຕ່າເລີຍ</a>
            </div>
    </div>
  </div>
  <?php  }  ?>
</div>

<?php
$rows=mysqli_num_rows(mysqli_query($dbcon, "SELECT * from products "));
$total=ceil($rows/$limit)
 ?>
 <br />
 <ul class="pagination justify-content-center">
<?php if($id>1)
{ ?>
   <nav aria-label="Page navigation example">
  <ul class="pagination">
  <li class="page-item justify-content-center">
    <a class="page-link" style="color:white;background-color : #033c73;" href="?id=<?php echo $id-1; ?>"><span class="fa fa-backward"></span> ກັບຄືນ </a><li>
 <?php } ?>

<ul class='pagination justify-content-center'>
<?php   for($i=1;$i<=$total;$i++)
    {
      if($i==$id) {   ?>

    <li class="page-item active justify-content-center"><a class="page-link" style="color:white;background-color : #033c73;"><?php echo $i; ?> </a></li> 
<?php }else { ?> 
    <li class="page-item justify-content-center">
      <a class="page-link" href="?id=<?php echo $i; ?>"><?php echo $i; ?></a>
      </li> 
      <?php }
    }?>
   </ul>

<?php 
  if($id!=$total)
  { ?>
   <li class="page-item justify-content-center">
    <a class="page-link" style="color:white;background-color : #033c73;" href="?id=<?php echo $id+1; ?>">
     ໄປໜ້າໃໝ່ &nbsp;<span class="fa fa-forward"></span></a>
   </li>
   </ul>
<?php }
}

?>

    </nav>
    </ul>
  </div> 
</div>  <!-- end shopping card items page -->