<?php 
session_start();
if (!$_SESSION['CustEmail']) {
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
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <div class="container">
             <?php include_once 'include/icon.php';  ?>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php"><span class='fa fa-home'></span>ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ຈັດການລູກຄ້າ 
              </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="Customers.php">ຈັດການລູກຄ້າ</a>
            <a class="dropdown-item" href="Selldetails.php">ລາຍລະອຽດການຂາຍ  </a>
             <!-- <a class="dropdown-item" href="previous_sell.php">ການຂາຍທີ່ຜ່ານມາ  </a>
             <a class="dropdown-item" href="views_sell.php">ກວດສອບການຂາຍ  </a> -->
            </div>
            </li>
              </ul>
              <?php include_once 'include/session.php';?>
          </div>
      </div>
  </nav>
<?php
include("dbconn.inc.php");

$CustID = $_GET['cid'];

$sql = "SELECT * FROM customers WHERE CustID = $CustID";
$result = mysql_query($sql);
// $cust_name = mysql_result($result, 0, "name");
// $cust_email = mysql_result($result, 0, "email");
// $result = mysqli_query($dbcon, "SELECT * FROM customers WHERE CustID = $CustID");
$CustFirstName = mysql_result($result, 0, "CustFirstName");
$CustEmail = mysql_result($result, 0, "CustEmail");
$sql = "SELECT * FROM sellproduct WHERE CustID = $CustID;";
$result = mysql_query($sql);
// $result = mysqli_query($dbcon, "SELECT * FROM customers WHERE CustID = $CustID");
// $CustFirstName = mysqli_result($result, 0, "CustFirstName");
// $CustEmail = mysqli_result($result, 0, "CustEmail");
// $result = mysqli_query($dbcon, "SELECT * FROM sellproduct WHERE CustID = $CustID");
$msg = "
	ຮຽນທ່ານ $CustFirstName <br /><br />
	ຈາກການທີທ່ານໄດ້ຊື້ສິນຄ້າຈາກເວັບໄຊ Inzeeorganic.com ຕາມລາຍການຕໍ່ໄປນີ້ຄື
	<br /><br />

	<table border='1' cellpadding='5' style=\"border-collapse: collapse;\">
	<tr bgcolor=#eeeeff>
		<th width='30'>ລຳດັບ</th>
		<th width='230'>ລາຍການ</th>
		<th width='50'>ລາຄາ</th>
		<th width='80'>ຈຳນວນ</th>
		<th width='80'>ລວມ</th>
	</tr>
	";
$i = 1;
$t = 0;
while($ord = mysql_fetch_array($result)) {
	$st = $ord['Sell_Price'] * $ord['Sell_Qty'];
	$msg .= "
	<tr>
	<td align=center>$i</td>
	<td>{$ord['Sell_name']}</td>
	<td align=center>{$ord['Sell_Qty']}</td>
	<td align=center>{$ord['Sell_Price']}</td>
	<td align=right>$st</td>
	</tr>
	";
	$gt += $st;
	$i++;
}

$msg .= "
<tr align=center>
	<td colspan=4 align=right><b>ລວມທັງໝົດ</b></td><td align=right>$gt</td>
</tr>
</table>
<br />
";

$notify = $_GET['notify'];

if($notify == "payment") {
	$msg .= "
	ເຮົາຈຶ່ງຂໍແຈ້ງໃຫ້ທ່ານຊຳລະສິນຄ້າ ໂດຍໂອນເງິນຈຳນວນ <b> $gt ກີບ</b>  <br />
	ຜ່ານທະນາຄານຫຼືຕູ້ ATM  ໄປຍັງບັນຊີອັນໃດອັນໜຶ່ງໃນຕໍ່ໄປນີ້
	<ul>
		<li>ທະນຄານພົງສະຫວັນ ຊື່ບັນຊີ .... ເລກບັນຊີ ....
		<li>ທະນຄານການຄ້າຕ່າງປະເທດ ຊື່ບັນຊີ .... ເລກບັນຊີ ....
		<li>ທະນຄານພົງ JDB ຊື່ບັນຊີ .... ເລກບັນຊີ ....
	</ul>
	ຈາກໃຫ້ສົ່ງຫຼັກຖານການໂອນເງີນດ້ວຍວິທີຕໍ່ໄປນີ້ຄື
	<ul>
		<li>ສົ່ງຫຼັກຖານການໂອນ ຫຼືແຟ໊ກມາທີ 030 53 32 224 
		<li>ຫຼືສົ່ງເປັນຮູບພາບມາທີ່ອີເມວນີ້
		<li>ໂທມາແຈ້ງທີ່ເບີ 
	</ul>
	ຫຼັງຈາກຮັບຫຼັກຖານການຊຳລະເງິນແລ້ວເຮົາຈະຈັດສົ່ງສິນຄ້າໃຫ້ທັນທີ <br />
	ຫາກທ່ານໃດບໍ່ຊຳລະເງິນພາຍໃນ 7 ວັນສິນຄ້າທີ່ທ່ານສັ່ງຈະຖືກຍົກເລີກ <br />
	";
}
else {
	$msg .= "
	ດຽວນີ້ສິນຄ້າໄດ້ຈັດສົ່ງໃຫ້ກັບທ່ານຮຽບຮ້ອຍແລ້ວ ໂດຍທ່ານຈະໄດ້ຮັບສິນຄ້າພາຍໃນ 7 ວັນ  <br /><br />

	ຂອບໃຈທີ່ທ່ານໃຊ້ບໍລິການ
	";
}
//echo $msg;

//¹Ó¢éÍÁÙÅ·Ñé§ËÁ´ ÁÒÊÃéÒ§à»ç¹ÍÕàÁÅ
$header = "From: vaijai.green@gmail.com\r\n";
$header .= "Content-type: text/html; charset=utf-8\r\n";
	
$to = $CustEmail;
$subject = "ແຈ້ງການສັ່ງຊື້ສິນຄ້າ";
$body = $msg;
	
$sendmail = mail($to, $subject, $body, $header);
	
if($sendmail) {
	echo "ການແຈ້ງເຕືອນຖືກສົ່ງໄປທີ່ $to ແລ້ວ";
	if($notify == "delivery") {
		//ÍÑ»à´µÊ¶Ò¹Ð¡ÒÃ¨Ñ´Êè§ ÇèÒä´é¨Ñ´Êè§ÊÔ¹¤éÒáÅéÇ
		$sql = "UPDATE customers SET delivery = 'ສົ່ງແລ້ວ' WHERE CustID = $CustID;";
		mysql_query($sql);
		// $result =mysqli_query($dbcon, "UPDATE customers SET delivery = 'ສົ່ງແລ້ວ' WHERE CustID = $CustID");
	}
}
else {
 	echo "ກ່ນສົ່ງເມວເກີດຂໍ້ຜິດພາດ";
}

?>
</body>
</html>