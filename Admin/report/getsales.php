<?php
session_start();
include("../db.php");
 $date1 = $_POST['date1'];
 $sql  = "SELECT * from sellproduct WHERE Sell_status='Complete' and Sell_date";
 
 $data = mysqli_query($conn,$sql);
 
 while ($row = mysqli_fetch_assoc($data) ) {
 	echo "<tr>
 	    <td>".$row['ProductID']."</td>
 	    <td>".$row['Sell_name']."</td>
 	    <td>".$row['Sell_Qty']."</td>
 	    <td>".$row['Sell_Price']."</td>
 	   <td>".$row['Sell_total']."</td>
 	   <td>".$row['Sell_date']."</td>
 	</tr>";
 	
 }
?>