<?php
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}
?>
<?php include_once 'include/selectorder.php';?>
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
<br/><br/><br/><br/>
<div class="col-sm-12">
					<div class="alert alert-success">
					   <h3 class="text-center"><i class="fa fa-check-circle fa-lg"></i> ຂອບໃຈທີ່ໃຊ້ບໍລິການ, ການສັ່ງຈອງສິນຄ້າຂອງທ່ານໄດ້ສຳເລັດແລ້ວ!</h3><br/>
					   <a class="btn btn-secondary" href="bill1.php"> ກະລຸນາຮັບໃບບິນຂອງທ່ານ</a> &nbsp;<span style="color: red">ໝາຍເຫດ: ກະລຸນາສະແດງໃບບິນເພື່ອຢັ້ງຢືນໃນເວລາຮັບສິນຄ້າ </span>
                    </div>
				</div>






    <footer>
	<?php include '../include/footer1.php'; ?>
        
    </footer>
</body>
</html>