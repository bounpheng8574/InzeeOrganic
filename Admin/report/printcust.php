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
	<body onload="Print();" onclick="goBack();">
		<div class="container">
			<br/><br/><br/>
		<center><h4> <span class=""></span>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h4>
			<h5>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</h5></center>
        <div class="pull-left"><img src="../../photo/icon1.jpeg" style="width: 80px; height: 80px;"></div>
        <div class="pull-right"><p align="center">ຮ້ານ ອິນຊີບ້ານເຮົາ</p>
        	<p align="center">ບ. ສົມຫວັງ, ມ.ຫາດຊາຍຟອງ, ນະຄອນຫຼວງວຽງຈັນ
        	</p>
        	<p align="center">ອີເມວ: Vaijai_Trading@gmail.com</p>
        	<p align="center">ເບີໂທລະສັບ: 030 53 32 224 </p>
        </div>
		<!-- Sellproduct page -->
		<br/><br /><br /><br /><br /><br /><br />
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
        } ?>
        </tbody>
        </table>
      <?php } 
      ?>
        </div>
        <div class="pull-right"><p align="center">ລາຍງານໂດຍ: <?php extract($_SESSION); echo $admin_username;?></p> 
        <p align="center">ວັນທີ: <?php echo date("d/m/Y") ?></p>
    </div>
        <br />      
       </div>
   <?php include_once '../include/showdatatables.js';?>
    <script type="text/javascript">
    function Print() {
        window.print();
      }
      function goBack() {
    window.open('../index.php', '_self');
  }
    </script>
    </body>
    </html>
