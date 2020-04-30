<!-- insert data and emp -->
<?php
include("../db.php");
if(isset($_POST['emp_save']))
{
$FirstName    = $_POST['FirstName'];
$LastName     = $_POST['LastName'];
$Address   = $_POST['Address'];
$Tel   = $_POST['Tel'];
$BirthDate	= $_POST['BirthDate'];
$Sex        = $_POST['Sex'];
$Email        = $_POST['Email'];
$check_user     ="SELECT * FROM employee WHERE Email='$Email'";
    $run_query=mysqli_query($dbcon,$check_user);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('ມີຂໍ້ມູນຊ້ຳກັນ, ກະລຸນາປ້ອນຂໍ້ມູນໃໝ່!')</script>";
 echo"<script>window.open('index.php','_self')</script>";
exit();
    }
 //image coding
 $imgFile = $_FILES['Picture']['name'];
$tmp_dir = $_FILES['Picture']['tmp_name'];
$imgSize = $_FILES['Picture']['size'];

$upload_dir = 'include/emp_i/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;


			if(in_array($imgExt, $valid_extensions)){			
		
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic); 


$saveaccount="INSERT INTO employee (FirstName, LastName, Address, Tel,Email, Picture,) VALUE ('$FirstName','$LastName' ,'$Address', '$Sex', '$BirtDate', '$Tel', '$Email', '$itempic')";
mysqli_query($dbcon,$saveaccount);
echo "<script>alert('ບັນທຶກຂໍ້ມູນສຳເລັດ')</script>";       
echo "<script>window.open('emp.php','_self')</script>";
		}	
		else{
					
					 echo "<script>alert('ຂໍອະໄພ, ຂະໜາດຟາຍຮູບຂອງທ່ານສູງເກິນໄປ')</script>";				
					 echo "<script>window.open('emp.php','_self')</script>";
				}
	}
	else{
				
				 echo "<script>alert('ຂະໜາດຟາຍຮູບຕ້ອງເປັນ JPG, JPEG, PNG & GIF ເທົ່ານັ້ນ')</script>";				
					 echo "<script>window.open('emp.php','_self')</script>";
}

}

?>
