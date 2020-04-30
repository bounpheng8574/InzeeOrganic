
<nav class="navbar navbar-nav navbar-expand-lg navbar-light  bg-footer py-3">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img class="rounded-circle" src="photo/logo2.PNG" width="70px" height="70px" alt=""><h3 class=""><b> ຮ້ານອີນຊີບ້ານເຮົາ</b></h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link btn btn-success" href="index.php">
                <span class='fa fa-home'></span> ໜ້າຫຼັກ 
                <span class="sr-only">(current)</span>
              </a>
            </li>
              <li class="nav-item dropdown active">
              <a class="nav-link btn btn-success dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class='fa fa-list-alt'></span>&nbsp; ສິນຄ້າ 
              </a>
             <div class="dropdown-menu btn btn-success" aria-labelledby="navbarDropdown">
              <a class="dropdown-item nav-link btn btn-success" href="shop.php">ສິນຄ້າທັງໝົດ</a>
              <!-- ສະແດງເປັນປະເພດ -->
             <?php 
              include_once ('db.php');
              $sql = "SELECT * from categories";
              $r = mysqli_query($dbcon, $sql);
              while ($row = mysqli_fetch_array($r)) { ?>
                  <a class="dropdown-item nav-link btn btn-success" href="shop.php?CategoryType=<?=$row['CategoryID']?>"><?php echo $row['CategoryName']; ?></a>
            <?php  }

              ?>
            </div>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-success" href="About.php" > &nbsp;<span class=""> </span> ກ່ຽກັບພວກເຮົາ</a>
           </li>
           <li class="nav-item">
              <!-- Button trigger modal -->
<a href="login.php" class="nav-link btn btn-success" data-toggle="modal" data-target="#myModal">
  ລົງຊື່ເຂົ້າ
</a>
   </li>
          <li>
            <li class="nav-item">
              <a class="nav-link btn btn-success" href="guideline.php" > &nbsp;<span class=""> </span> ຄຳແນະນຳ</a>
           </li>
<!--             <form class="form-inline navbar-form pull-right">
        <input class="form-control" type="text" placeholder="ພິມເພື່ອຄົ້ນຫາຂໍ້ມູນ">
        <button class="btn btn-success-outline" type="submit">ຄົ້ນຫາ</button>
      </form> -->
          </li>
          </ul>
        </div>
      </div>
    </nav>
                <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ເຂົ້າສູ່ລະບົບ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="POST" action="Custlogin.php"> 
        <div class="modal-body">
      <div class="form-group">
      <label for="exampleInputEmail1">ອີເມວ <img src="photo/email.png" width="50px" height="50px" alt=""></label>
      <input type="email" class="form-control" id="CustEmail" aria-describedby="emailHelp" name="CustEmail" placeholder="ປ້ອນອີເມວເຊັ່ນວ່າ: YourEmail@gmail.com">
   <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">ລະຫັດຜ່ານ</label>
    <input type="Password" class="form-control" id="" name="CustPassword" placeholder="ປ້ອນລະຫັດຜ່ານ">
  </div>
      </div>
      <div class="form-group" align="center">
         <input type="submit" class="btn btn-primary" name="Custlogin" value="ຕົກລົງ">
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">ຍົກເລີກ </button>
      </div>
    </form>
     <a type="submit" class="btn btn-danger" href="Custregister.php">ລົງທະບຽນ</a>
  </div>
</div>
</div>