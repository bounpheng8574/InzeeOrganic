  <?php
include("../config.php");
    $stmt = $DB_con->prepare('SELECT accbank, accno, accname,  customers.CustEmail, customers.CustFirstName, customers.CustLastName, customers.CustAddress, customers.CustSex, customers.CustUserName, customers.CustPassword FROM payment, customers WHERE payment.CustID=customers.CustID');
    $stmt->execute();?>



<td><?php echo $accbank; ?><p> <?php echo $accno; ?><p>
                   <?php echo $accname; ?> 
                 </td>              