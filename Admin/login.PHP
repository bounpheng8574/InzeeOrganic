<?php
session_start();

?>
<?php

include("db.php");



if(isset($_POST['submit']))
{
    // $admin_name    =$_POST['name'];
    $admin_username=$_POST['username'];
    $admin_password=$_POST['password'];

    $check_admin="select * from admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";

 
    $run=mysqli_query($conn,$check_admin);

    if(mysqli_num_rows($run))
    {
	 echo "<script>alert('You're successfully login!')</script>";
       
 echo "<script>window.open('index.php','_self')</script>";
       
$_SESSION['admin_username']=$admin_username;
$_SESSION['name']=$admin_name;
    }
    else
    {
        echo "<script>alert('Username ຫຼື password ບໍ່ຖືກຕ້ອງ!')</script>";
		  echo "<script>window.history.go(-1);</script>";
		
		 exit();
		
    }
}
?>
