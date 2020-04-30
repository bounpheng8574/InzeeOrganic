<?php
session_start();
include("../db.php");
 $date1 = $_POST['date1'];
 $sql  = "SELECT SUM(DetailPrice) as total FROM `orders` as od INNER JOIN orderdetails as odt ON od.OrderID = odt.OrderID WHERE od.`importDate` >= '".$date1."'";
 
 $data = mysqli_query($conn,$sql);
 
 while ($row = mysqli_fetch_assoc($data) ) {
 	echo "<tr>
 	    <td>".$row['total']." ກີບ</td>
 	</tr>";
 	
 }
?>