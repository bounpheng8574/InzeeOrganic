<?php
session_start();
include("../db.php");
  $date2 = $_POST['date2'];
 $date3 = $_POST['date3'];
 $sql  = "SELECT SUM(DetailPrice) as total FROM `orders` as od INNER JOIN orderdetails as odt ON od.OrderID = odt.OrderID WHERE od.`importDate` BETWEEN '". $date2."' AND '".$date3."'";
 
 $data = mysqli_query($conn,$sql);
 
 while ($row = mysqli_fetch_assoc($data) ) {
 	echo "<tr>
 	    <td>".$row['total']." ກີບ</td>
 	</tr>";
 	
 }
?>