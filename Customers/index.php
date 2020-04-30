<?php
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}

?>
<?php include_once 'include/selectorder.php';?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
			<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inzee Organic Laos,LTD</title>
		<!-- Bootstrap CSS -->
		
		<?php include_once 'include/librarycust.php';?>
	</head>
	<body> 
    <?php include_once 'include/header.php';?> 

   <?php include_once 'include/navbar.php';?> 

<!-- Carousel -->
     <div class="container">
            <div id="carousel-example-generic" class="carousel slide align-content-center" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img data-src src="../photo/ผักบ้ง/slide1.jpg" width="100%" height="500px" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img data-src src="../photo/สะลัด/slide2.jpg" width="100%" height="500px" alt="Second slide"> 
          </div>
             <div class="carousel-item">
                  <img data-src src="../photo/มากพิก/slide3.jpg" width="100%" height="500px" alt="Third slide">
                </div>
                </div>
              </div>
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="icon-prev" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
       
 <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-sm-8">
          <h4 class="mt-4"><b><font color="green">ພືດຜັກອິນຊີ (Organic)</font></b></h4>
          <p>ພືດຜັກອິນຊີ (Organic) ທັງໝົດແມ່ນນໍາເຂົ້າມາຈາກກຸ່ມກະສິກໍາອິນຊີນະຄອນຫຼວງ, ເປັນຕົ້ນແມ່ນພືດຜັກ ແລະ ໝາກໄມ້ອິນຊີ ( ບໍ່ນໍາໃຊ້ສານເຄມີ ແລະ ສານສັງເຄາະໃດໆເຂົ້າໃນການຜະລິດ ) ເຊິ່ງສິນຄ້າກ່ອນທີ່ຈະນໍາມາຈໍາໜ່າຍ ແລະ ບໍລິການໃຫ້ລູກຄ້າ ທາງຮ້ານແມ່ນໄດ້ມີການກວດສອບເພື່ອໃຫ້ໄດ້ສິນຄ້າມີມີມາດຕະຖານອອກສູ່ສັງຄົມ.</p>
            <h4><b><font color="green">ພື້ນທີ່ດິນທີ່ໃຊ້ໃນການປູກ</font></b></h4>
            <img src="../photo/garden.jpg" width="100%" height="350px">
          <p>ພື້ນທີ່ດິນທີ່ໃຊ້ໃນການປູກແມ່ນປອດສານພິດມາເປັນເວລາຫຼາຍກ່ວາ 3 ປີ ແລະໃຊ້ພຽງຝຸ່ນຊີວະພາບ (ຝຸ່ນໝັກ, ສິ່ງເສດເຫຼືອຈາກສັດ) ເທົ່ານັ້ນເພື່ອໃຫ້ພືດຜັກສາມາດຈະເລີນເຕີບໂຕໄດ້ດ້ວຍວິທີແບບທໍາມະຊາດໂດຍອາຫານຈາກທໍາມະຊາດ ເອີ້ນໄດ້ວ່າເປັນການປູກແບບທໍາມະຊາດລ້ວນໆ 100% ສ່ວນປະກອບທຸກຢ່າຈິ່ງບໍລິສຸດບໍ່ມີສານພິດໃດໆ ແລະ ມີຄວາມປອດໄພສູງຕໍ່ຜູ້ບໍລິໂພກເນື່ອງຈາກພືດຜັກອິນຊີເປັນຜັກຈາກທໍາມະຊາດບໍ່ມີສານເຄມີຕ່າງໆອັນເປັນສາເຫດທີ່ກໍ່ໃຫ້ເກີດມະເຮັງ. ການບໍລິໂພກຜັກອິນຊີໃນປະລິມານທີ່ເໝາະສົມເປັນປະຈໍາຈະຊ່ວຍເຮັດໃຫ້ຮ່າງກາຍມີສຸຂະພາບທີ່ດີຂຶ້ນ, ເຮັດໃຫ້ຮ່າງກາຍແຂງແຂງ ແລະ ມີຄຸນນະພາບຊີວິດທີ່ດີຂຶ້ນ. ນອກຈກນີ້ແລ້ວ, ເມືອປຽບທຽບພືດຜັກທົ່ວໄປກັບຜັກອິນຊີແລ້ວຈະເຫັນວ່າ ຜັກອິນຊີມີວິຕາມິນ, ເກືອແຮ່ ແລະ  ສານອາຫານທີ່ມີຄຸນຄ່າຫຼາຍກ່ວາຜັກທົ່ວໄປອີກດ້ວຍ.</p>
           <h4><b><font color="green">ການເກັບຮັກສາ</font></b></h4>
            <img src="../photo/KepHukSa.jpg" width="100%" height="350px">
            <p>ພືດຜັກທຸກຊະນິດ, ພວກເຮົາແມ່ນຈະນໍາມາກວດສອບ ແລະ ລ້າງໃຫ້ສະອາດແລ້ວເກັບໄວ້ໃນຖົງສູນອາກາດ ແລະ ເກັບຮັກສາໄວ້ໃນຕູ້
              ທີ່ມີອຸນພະພູມເໝາະສົມກັບພັກແຕ່ລະຊະນິດ ເພື່ອກຽມຈັດສົ່ງສິນຄ້າທີ່ມີຄຸນນະພາບໃຫ້ລູກຄ້າຕາມຄວາມຕ້ອງການ
            </p>
          <p>
            <a class="btn btn-primary btn-lg" href="shop.php">ຄລິກເພື່ອເບິ່ງສິນຄ້າພວກເຮົາ &raquo;</a>
          </p>
        </div>
        <div class="col-sm-4">
          <h2 class="mt-4">ຕິດຕໍ່ໂດຍກົງ</h2>
          <address>
           <h4> <strong>ສະຖານທີ່</strong></h4>
            ບ້ານສົມຫວັງໃຕ້
            <br>ເມືອງ ຫາດຊາຍຟອງ, ນວ
            <br>
          </address>
          <address>
            <abbr title="Phone">ເບີໂທຕິດຕໍ່:</abbr>
            (123) 456-7890
            <br>
            <abbr title="Email">ອີເມວ:</abbr>
            <a href="mailto:https://www.Vaijai_trading@gmail.com">Vaijai_trading@gmail</a>
          </address>
        </div>
      </div>

      <!-- /.row -->
      <div class="row">
           <?php 
              include_once ('../db.php');
              $sql = "SELECT * from categories";
              $r = mysqli_query($dbcon, $sql);
              while ($row = mysqli_fetch_array($r)) {  ?>
      <!-- src="<?php //echo $row['CategoryPic']; ?>"  -->
        <div class="col-sm-4 my-4">
          <div class="card">
            <img class="card-img-top" width="180px" height="190px" src="../Admin/prodiv/Catpic/<?php echo $row['CatPic']; ?>" alt="">
            <div class="card-body">
              <h4 class="card-title"><b><?php echo $row['CategoryName']; ?></b></h4>
              <p class="card-text">
              <?php echo $row['Descriptions']; ?></p>
            </div>
            <div class="form-group" align="center">
              <a href="shop.php?CategoryType=<?=$row['CategoryID']?>" class="btn btn-primary">ເບິ່ງຕື່ມອີກ!</a>
            </div>
          </div>
        </div>
<!--         <div class="col-sm-4 my-4">
          <div class="card">
            <img class="card-img-top" src="http://placehold.it/300x200" alt="">
            <div class="card-body">
              <h4 class="card-title"><b>ກຸ່ມຜັກທີ່ເປັນໝາກ</b></h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
            </div>
            <div class="form-group" align="center" ">
              <a href="#" class="btn btn-primary">ເບິ່ງຕື່ມອີກ!</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 my-4">
          <div class="card">
            <img class="card-img-top" src="http://placehold.it/300x200" alt="">
            <div class="card-body">
              <h4 class="card-title"><b>ກຸ່ມຜັກທີ່ເປັນຫົວ</b></h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="form-group" align="center">
              <a href="#" class="btn btn-primary">ເບິ່ງຕື່ມອີກ!</a>
            </div>
          </div>
        </div> --> 
        <?php  }?>
      </div>
   
      <!-- /.row -->
      </div> 
      <?php 
 include_once '../include/Footer1.php';
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

