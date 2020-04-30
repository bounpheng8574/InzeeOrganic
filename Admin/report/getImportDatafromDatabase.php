<?php
session_start();
include("../db.php");
 $date1 = $_POST['date1'];
 $sql = "SELECT ods.importDate as importdate, odt.ProductID as p_id, odt.OrderDetail as productname,odt.OrderQity as quantity,odt.DetailPrice as imp_price, sp.CompanyName as companyName from orders as ods INNER JOIN orderdetails as odt ON ods.OrderID = odt.OrderID INNER JOIN supplier as sp ON ods.SupID like sp.SupID WHERE ods.`importDate` >= '".$date1."'";
 $data = mysqli_query($conn,$sql);

 while ($row = mysqli_fetch_assoc($data) ) {
 	echo "<tr>
 	    <td>".$row['p_id']."</td>
 	    <td>".$row['productname']."</td>
 	    <td>".$row['quantity']."</td>
 	    <td>".$row['imp_price']."</td>
 	   <td>".$row['companyName']."</td>
 	   <td>".$row['importdate']."</td>

 	</tr>";
 }

?>