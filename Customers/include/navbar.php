 <!-- navbar -->
<nav class="navbar navbar-nav navbar-expand-lg navbar-light  bg-footer py-3">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img class="rounded-circle" src="../photo/logo2.PNG" width="70px" height="70px" alt=""><h3 class=""><b> ຮ້ານອີນຊີບ້ານເຮົາ</b></h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link btn btn-success" href="index.php"><span class='fa fa-home'></span><b>ໜ້າຫຼັກ </b>
                <span class="sr-only">(current)</span>
              </a>
            </li>
              <li class="nav-item dropdown active">
              <a class="nav-link btn btn-success dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <!-- <span class='fa fa-cart-plus'></span>&nbsp; -->ຊື້ສິນຄ້າ 
              </a>
            <div class="dropdown-menu btn btn-success" aria-labelledby="navbarDropdown">
              <a class="dropdown-item nav-link btn btn-success" href="shop.php">ສິນຄ້າທັງໝົດ</a>
              <!-- ສະແດງເປັນປະເພດ -->
             <?php 
              include_once ('../db.php');
              $sql = "SELECT * from categories";
              $r = mysqli_query($dbcon, $sql);
              while ($row = mysqli_fetch_array($r)) { ?>
                  <a class="dropdown-item nav-link btn btn-success" href="shop.php?CategoryType=<?=$row['CategoryID']?>"><?php echo $row['CategoryName']; ?></a>
            <?php  }

              ?>
            </div>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link btn btn-success dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-cart-plus'></span>&nbsp;ການຈອງ
              </a>
              <!-- add class count -->
            <div class="dropdown-menu btn btn-success" aria-labelledby="navbarDropdown">
             <a class="dropdown-item nav-link btn btn-success" href="cart_items.php">ກະຕ່າສິນຄ້າ<span class="badge badge-danger count"></span></a>
            <a class="dropdown-item nav-link btn btn-success" href="sellproduct.php">ການສັ່ງຈອງ</a>
            <a class="dropdown-item nav-link btn btn-success" href="view_purchased.php">ການຊື້ສິນຄ້າ</a>
            </div>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-success" href="About.php" > &nbsp;<span class=""> </span> ກ່ຽກັບພວກເຮົາ</a> 
           </li>
            <li class="nav-item">
                        <a href="#" class="nav-link btn btn-success"><span class='fa fa-shopping-cart'></span> ລວມເງິນ:  <?php echo $total; ?> ກີບ</a>
                       
                    </li>
            <!-- <li class="nav-item">
              <a class="nav-link btn btn-success" href="guideline.php" > &nbsp;<span class=""> </span> ຄຳແນະນຳ</a>
           </li> -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle btn btn-success" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ບັນຊີ <?php echo $_SESSION['CustEmail']; ?>
              </a>
            <div class="dropdown-menu btn btn-success" aria-labelledby="navbarDropdown">
              <a class="dropdown-item nav-link btn btn-success" href="" data-toggle="modal" data-target="#myModal" href="Setting.php">ຕັ້ງຄ່າ</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item nav-link btn btn-success" href="Logout.php">ອອກຈາກລະບົບ</a>
            </div>
            </li>
          </li>
         <!--   <li><form class="form-inline navbar-form pull-right">
        <input class="form-control" type="text" placeholder="ພິມເພື່ອຄົ້ນຫາຂໍ້ມູນ">
        <button class="btn btn-success-outline" type="submit">ຄົ້ນຫາ</button>
        </form>
         </li> -->
       </ul>
     </ul>
    </div>
  </div>
</nav>
<!-- madal setting customer -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title ml-10" id="">ຕັ້ງຄ່າບັນຊີລູກຄ້າ</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="setting.php">
      <div class="modal-body">          
                   <fieldset> 
           <p>ຊື່ແທ້:</p>
                            <div class="form-group">
              
                                <input class="form-control" placeholder="ໃສ່ຊື່ແທ້" name="CustFirstName" type="text" value="<?php  echo $CustFirstName; ?>" required>  
              </div>
          <p>ນາມສະກຸນ:</p>
                        <div class="form-group">       
                       <input class="form-control" placeholder="ໃສ່ນາມສະກຸນ" name="CustLastName" type="text" value="<?php  echo $CustLastName; ?>" required>                
                           </div>     
              <p>ທີ່ຢູ່:</p>
                            <div class="form-group">
                     <input class="form-control" placeholder="ໃສ່ທີ່ຢູ່" name="CustAddress" type="text" value="<?php  echo $CustAddress; ?>" required> 
                       </div>
                       <!-- new add -->
                        <p>ເພດ:</p>
                            <div class="form-group">
                       <div class="radio" required>
       <div class="radio">
          <label>
            <input type="radio" name="CustSex" id="male" value="<?php  echo $CustSex; ?>" checked>
            ເພດຊາຍ
          </label>
         </div>
         <div class="radio">
          <label>
            <input type="radio" name="CustSex" id="female" value="<?php  echo $CustSex; ?>">
            ເພດຍິງ
          </label>
         </div>
        </div>
          </div>            
                   <!-- <p>ຊື່ຜູ້ໃຊ້:</p>
                      <div class="form-group">
                     <input class="form-control" placeholder="ໃສ່ຊື່ຜູ້ໃຊ້" name="CustUserName" type="text" value="<?php // echo $CustUserName; ?>" required> 
                       </div>     -->                
                               <p>ລະຫັດຜ່ານ:</p>
                   <div class="form-group">
                       <input class="form-control" placeholder="ປ້ອນລະຫັດຜ່ານ" name="CustPassword" type="text" value="<?php  echo $CustPassword; ?>" required>
                            </div>    
                            <p>ວັນ, ເດືອນ, ປີເກີດ:</p>
                      <div class="form-group">
                     <input class="form-control" type="date" name="CustBirthdate" value="<?php echo $CustBirthdate; ?>" id="example-date-input" required> 
                       </div>
                       <p>ເບີໂທລະສັບ:</p>
                      <div class="form-group">
                     <input class="form-control" placeholder="ໃສ່ເບີໂທລະສັບ" name="CustTel" type="text" value="<?php  echo $CustTel; ?>" required> 
                       </div>
                    <p><i class="fa fa-whatsapp"></i></p>
                      <div class="form-group">
                     <input type="text" class="form-control" name="CustWhat" placeholder="ປ້ອນເບີທີ່ນຳໃຊ້ whatsapp ເຊັ່ນ +85620" value="<?php echo $CustWhat; ?>"/> 
                       </div>
                    <p>ອີເມວ:</p>
                      <div class="form-group">
                     <input class="form-control" placeholder="ໃສ່ອີເມວ" name="CustEmail" type="email" value="<?php  echo $CustEmail; ?>" required> 
                    </div>
                    <p><i class="fa fa-facebook"></i></p>
                    <div class="form-group">
                     <input type="text" class="form-control" name="CustFace" placeholder="ປ້ອນຊື່ ຫຼື ອີເມວທີໃຊ້ໃນ facebook" value="<?php echo $CustFace; ?>" required/>
                       </div>
               <div class="form-group">
                      <input class="form-control hide" name="CustID" type="hidden" value="<?php  echo $CustID; ?>" required>              
              </div>            
           </fieldset>            
              </div>
              <div class="modal-footer">         
                <button class="btn btn-block btn-success btn-md" name="Custsave">ບັນທຶກ</button>
                <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">ຍົກເລີກ</button>
        </div>
        </form>
          </div>
      </div>
    </div>  <!-- end -->