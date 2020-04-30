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
     <?php include_once 'include/librarycust.php';?>
	</head>
	<body> 	
<?php 
include_once 'include/header.php';
include_once 'include/navbar.php';
?>

    </div>  <!-- end -->
<div class="container">
<?php 
include_once '../include/history.php';
?>	
</div>
<!-- Footer -->
<footer class="mt-5">
<?php 
include_once '../include/footer1.php';
?>
</footer>	
 
</body>
</html>