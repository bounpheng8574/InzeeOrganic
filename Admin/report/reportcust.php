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
 		<?php include_once '../supplier/library.php';?>
 		<style>
 			@page{
 				margin:0;
 			}

 		</style>
	</head>
	<body onload="">
		<div class="container">
      <br/><br/><br/>
        <div class="pull-right"><a href="printcust.php" class="btn btn-primary"> &nbsp;<span class="fa fa-print">print</span></a>
        </div>
    <!-- Sellproduct page -->
    <br/><br />
	<div class="">  
        <br/>                    
          <center> <h3><strong>ລາຍງານຂໍ້ມູນລູກຄ້າ</strong> </h3></center>   
           </div>
         <br />
          <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ຊື່ອີເມວລູກຄ້າ</th>
                  <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                  <th>ທີ່ຢູ່</th>
                  <th>ເພດ</th>
                  <th>ວັນ, ເດືອນ, ປີເກີດ</th>
                  <th>ຊື່ ແລະ ລະຫັດຜ່ານ</th>
                </tr>
              </thead>
              <tbody>
              <?php
include("../../config.php");
    $stmt = $DB_con->prepare('SELECT * FROM customers');
    $stmt->execute();
        
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);                      
            ?>
                <tr>
                 <td><?php echo $CustEmail; ?></td>
                 <!-- name and surname -->
                 <td><?php echo $CustFirstName; ?> <?php echo $CustLastName; ?></td>
                 <td><?php echo $CustAddress; ?></td>  
                 <td><?php echo $CustSex; ?></td>
                 <td><?php echo $CustBirthdate; ?></td>
                 <td><?php echo $CustUserName; ?> <?php echo $CustPassword; ?></td>        
                 </tr>
               
              <?php
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "<br />";
        echo '
        <div class=""     




        </div>';
    
        echo "</div>";
    }
        ?>
        
            
        
       
    </div>
    </div>
    
    <br />
    <br />       
       
   <?php include_once '../include/showdatatables.js';?>

    </body>
    </html>
