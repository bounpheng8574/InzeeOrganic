<?php
 include("../config.php");
 extract($_SESSION); 
      $stmt_edit = $DB_con->prepare('SELECT * FROM customers WHERE CustEmail =:CustEmail');
    $stmt_edit->execute(array(':CustEmail'=>$CustEmail));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);
    
    ?>
    
		<?php
 include("../config.php");
		$stmt_edit = $DB_con->prepare("SELECT SUM(Sell_total) as total from sellproduct where CustID=:CustID and Sell_Status='Ordered'");
		$stmt_edit->execute(array(':CustID'=>$CustID));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>		