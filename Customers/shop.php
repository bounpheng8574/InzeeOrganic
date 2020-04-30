<?php
session_start();

if(!$_SESSION['CustEmail'])
{

    header("Location: ../index.php");
}

?>
<?php include_once 'include/selectorder.php';?>
    <?php
    include("../config.php");
    $stmt = $DB_con->prepare("SELECT * FROM products");
    $stmt->execute(); 

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
	<?php include 'include/pager.php'; ?>

    <footer>
	<?php include '../include/footer1.php'; ?>
        
    </footer>
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
    function goBack(){
    window.history.back();
    }   
</script>
</body>
</html>