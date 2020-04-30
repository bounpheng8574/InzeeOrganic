<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<?php
//,
include_once ('../db.php') ; 	
if (isset($_POST['i_save'])); {
	$ProductName = $_POST['ProductName'];
	$ProductPrice = $_POST['ProductPrice'];
	$ProductQuantity = $_POST['ProductQuantity'];
	$Description = $_POST['Description'];
	$CategoryName = $_POST['CategoryName'];
	$UnitID = $_POST['UnitID'];
	$check_item="SELECT * FROM products WHERE ProductName='$ProductName'";
    $run_query=mysqli_query($dbcon,$check_item);
    
    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('ສິນຄ້ານີ້ມີແລ້ວ, ກະລຸນາເພິ່ມສິນຄ້າໃໝ່!')</script>";
 echo"<script>window.open('index.php','_self')</script>";
exit();	
    }
$imgFile = $_FILES['ProductImage']['name'];
$tmp_dir = $_FILES['ProductImage']['tmp_name'];
$imgSize = $_FILES['ProductImage']['size'];
$upload_dir = 'images/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;
//add select id categories and reach mysqli_query 
			if(in_array($imgExt, $valid_extensions)){			
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
					//add cateID and Desc
					$saveitem="INSERT INTO products (ProductQuantity, UnitID, CategoryName, Description, ProductName, ProductPrice, ProductImage, ProductUpdateDate) VALUES ('$ProductQuantity', '$UnitID', '$CategoryName', '$Description','$ProductName','$ProductPrice', '$itempic', CURDATE())";
					mysqli_query($dbcon, $saveitem);
					  echo "<script>alert('ບັນທຶກຂໍ້ມູນຂອງທ່ານສຳເລັດແລ້ວ!')</script>";				
					  echo "<script>window.open('Product.php','_self')</script>";
				}
				else{			
					  echo "<script>alert('ຂໍອະໄພ, ຂະໜາດຟາຍຮູບຂອງທ່ານສູງເກິນໄປ')</script>";				
					  echo "<script>window.open('Product.php','_self')</script>";
				}
			}
			else{			
				  echo "<script>alert('ຂະໜາດຟາຍຮູບຕ້ອງເປັນ JPG, JPEG, PNG & GIF ເທົ່ານັ້ນ')</script>";				
					  echo "<script>window.open('Product.php','_self')</script>";		
			}
			
	}	
?>