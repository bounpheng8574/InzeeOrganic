<?php
session_start();
include("../db.php");
 $date2 = $_POST['date2'];
 $date3 = $_POST['date3'];
 $sql  = "SELECT SUM(Sell_total) as total FROM `sellproduct` WHERE Sell_status='Complete' AND Sell_date";
 
 $data = mysqli_query($conn,$sql);
 
 while ($row = mysqli_fetch_assoc($data) ) {
 	echo "<tr>
 	    <td>".$row['total']." ກີບ</td>
 	</tr>";
 	
 }
?>