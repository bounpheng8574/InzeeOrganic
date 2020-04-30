<?php
session_start();

?>
<?php

include("db.php");
if(isset($_POST['Custlogin']))
{
    $CustEmail=$_POST['CustEmail'];
    $CustPassword=$_POST['CustPassword'];
    
	
    $check_user="SELECT * FROM customers WHERE CustEmail='$CustEmail' AND CustPassword='$CustPassword'";
    $result = $dbcon->query($check_user); //end query

if ($result->num_rows > 0 ){
        $row = $result->fetch_assoc();
        $_SESSION['CustID'] = $row['CustID'];
        $_SESSION['CustEmail'] = $row['CustEmail'];
        
        header('location:customers/index.php');
        
        
    }else{
        echo "<script>alert('Email ຫຼື password ບໍ່ຖືກຕ້ອງ!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        
          exit();
    }
    

    }


  //  $run=mysqli_query($dbcon,$check_user);

   // if(mysqli_num_rows($run)) {

    //$_SESSION['Custmail']= $CustEmail;

	 //echo "<script>alert('You're successfully login!')</script>";
       
     //echo "<script>window.open('customers/index.php','_self')</script>";



   //  }
   //  else
   //  {
   //      echo "<script>alert('Email or password is incorrect!')</script>";
		 //  echo "<script>window.open('index.php','_self')</script>";
		
		 // exit();
		
   //  }
//}
?>