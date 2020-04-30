<?php
session_start();
include("../db.php");
 $date1 = $_POST['date1'];
 $sql  = "SELECT SUM(Sell_total) as total FROM `sellproduct` WHERE Sell_date and Sell_status='Complete'";
 
 $data = mysqli_query($conn,$sql);
 
 while ($row = mysqli_fetch_assoc($data) ) {
 	echo "<tr>
 	    <td>".$row['total']." ກີບ</td>
 	</tr>";
 	
 }
?>