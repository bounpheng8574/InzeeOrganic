<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Page</title>
 		<?php include_once 'include/libraryadmin.php';?>
 		 
	</head>
	<body>
		<!-- navbar -->
		<div id="wrapper">
	<!-- navbar -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
			   <?php include_once 'include/icon.php';  ?>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="index.php"><span class='fa fa-home'></span>ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
			      </li>
			       <li class="nav-item dropdown">
	              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-edit'></span>&nbsp;ນໍາເຂົ້າສິນຄ້າ
	              </a>
	            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	             <a class="dropdown-item" href="Import/CheckLessStock.php">ກວດສອບສິນຄ້າ</a>
	             <a class="dropdown-item" href="Import/OrderOut.php"> ຈັດຊື້ສິນຄ້າ</a>
				<a class="dropdown-item" href="Import/importProduct.php"> ນໍາສິນຄ້າເຂົ້າ</a>
	            </div>
        	</li>
			      <!--  dropdown manage product -->
		<li class="nav-item dropdown">
	              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-edit'></span>&nbsp;ຈັດການສິນຄ້າ
	              </a>
	            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	             <a class="dropdown-item" href="Product.php">ສິນຄ້າ</a>
	             <a class="dropdown-item" href="prodiv/category.php"> ບັນທຶກປະເພດສິນຄ້າ	</a>
				<a class="dropdown-item" href="prodiv/unit.php"> ບັນທຶກຫົວໜ່ວຍສິນຄ້າ	</a>
	            </div>
        </li>
            <!-- manage emp and sup -->
		<li class="nav-item dropdown">
	              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-tasks'></span>&nbsp;ຈັດການຂໍ້ມູນ 
	              </a>
	            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	             <a class="dropdown-item" href="emp.php">ຈັດການພະນັກງານ</a>
	            <a class="dropdown-item" href="supplier.php">ຈັດການຜູ້ສະໜອງ	</a>
	            </div>
            </li>
			<!-- manage cust -->
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-tasks'></span>ລູກຄ້າ 
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="Customers.php">ຈັດການລູກຄ້າ</a>
             <a class="dropdown-item" href="Selldetails.php">ລາຍລະອຽດການຈອງຂອງລູກຄ້າ	</a>
             <a class="dropdown-item" href="Sellsuccess.php">ສິນຄ້າທີ່ຂາຍແລ້ວ	</a>
             <!--<a class="dropdown-item" href="views_sell.php">ກວດສອບການຂາຍ	</a>  -->
            </div>
            </li>
            <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-money'></span>ການເງິນ
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="#">ງົບປະມານລາຍຈ່າຍ</a>
             <a class="dropdown-item" href="financial.php">ງົບປະມານລາຍຮັບ	</a>
             <a class="dropdown-item" href="#">ຜົນກຳໄລ	</a>
             <a class="dropdown-item" href="views_sell.php">ກວດສອບການຂາຍ	</a>              
             </div>
            </li> -->
           
            <!-- report -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-filter'></span>&nbsp;ເລືອກລາຍງານ 
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="report/printpro.php">ລາຍງານສິນຄ້າທີ່ມີໃນຮ້ານ</a>
            <a class="dropdown-item" href="report/Importproduct.php">ລາຍງານສິນຄ້ານໍາເຂົ້າ	</a>
            <a class="dropdown-item" href="report/printcust.php">ລາຍງານຂໍ້ມູນລູກຄ້າ</a>
            <a class="dropdown-item" href="report/print2.php">ລາຍງານການຂາຍສິນຄ້າ</a>
            <a class="dropdown-item" href="report/outcome.php">ລາຍງານລາຍຈ່າຍ</a>
            <a class="dropdown-item" href="report/income.php">ລາຍງານລາຍຮັບ</a>
           <!--  <a class="dropdown-item" href="#">ລາຍງານລາຍຮັບ</a>
            <a class="dropdown-item" href="#">ລາຍງານລາຍຈ່າຍ</a>         -->           
            </div>
            </li>
		    </ul>
				<?php include_once 'include/session.php';?>
		  </div>
		</div>
	</nav><!-- end -->
 <!-- jumbotron -->
 <div class="jumbotron">
	  	<div class="container">
		  <h1 class="display-6" align="center">ຍິນດີຕ້ອນຮັບເຂົ້າສູ່ເວັບຈັດການຮ້ານອິນຊີບ້ານເຮົາ!</h1>
			  <p class="lead"><!--  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  --></p>
		    <!-- <div align="center"><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
		    </div>
		    	   <!-- courousel -->
	<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner" style="background-size: cover;">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="https://images.unsplash.com/photo-1502054195739-505158fe7855?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=c757b90c267cffaea5a4efb109ad3d80&auto=format&fit=crop&w=1280&h=400&q=60" alt="First slide">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="https://images.unsplash.com/photo-1513957391641-38811fee23f9?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=986a50abca5b48ee42a346454feb018f&auto=format&fit=crop&w=1280&h=400&q=60" alt="Second slide">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="https://images.unsplash.com/photo-1483389127117-b6a2102724ae?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=eeca69186adfa89d5e1b81fbd41c5512&auto=format&fit=crop&w=1280&h=400&q=60" alt="Third slide">
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
		</div> -->
		</div>
	
<?php include '../include/footer.php'; ?>  
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