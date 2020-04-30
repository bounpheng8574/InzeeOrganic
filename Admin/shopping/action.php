<?php
session_start();
include_once ('db.php');
if (isset($_POST['ProductID'])) {
	$order_table = '';
	$message='';
	if ($_POST['action'] == "add") {
		if (isset($_SESSION["shopping_cart"])) {
			$is_available = 0;
			foreach ($_SESSION["shopping_cart"] as $keys => $values) {
				if ($_SESSION["shopping_cart"][$keys]['ProductID'] == $_POST["ProductID"]) {
					$is_available++;
					$_SESSION["shopping_cart"][$keys]['ProductQuantity'] = $_SESSION["shopping_cart"][$keys]['ProductQuantity']+ $_POST["ProductQuantity"];
				}
			}
			if ($is_available < 1 ) {
				$item_array = array(
					'ProductID' 		=> $_POST["ProductID"],
					'ProductName' 		=> $_POST["ProductName"],
					'ProductPrice' 		=> $_POST["ProductPrice"],
					'ProductQuantity' 	=> $_POST["ProductQuantity"]
				);
				$_SESSION["shopping_cart"][] = $item_array;
			}
		}else {
			$item_array = array(
				'ProductID' 		=> $_POST["ProductID"],
				'ProductName' 		=> $_POST["ProductName"],
				'ProductPrice' 		=> $_POST["ProductPrice"],
				'ProductQuantity' 	=> $_POST["ProductQuantity"]	
			);
			$_SESSION["shopping_cart"][] = $item_array;
		}
		$order_table .='
				<table class="table table-bordered">
				 	<tr>
				 		<th width="40%">ຊື່ສິນຄ້າ</th>
				 		<th width="10%">ຈຳນວນ</th>
				 		<th width="20%">ລາຄາ</th>
				 		<th width="15%">ລວມເງິນ</th>
				 		<th width="5%">ຈັດການ</th>
				 	</tr>
		';
		if (!empty($_SESSION["shopping_cart"])) 
		{
			$total = 0;
			foreach ($_SESSION["shopping_cart"] as $keys => $values) {
				$order_table .='
				 	<tr>
				 		<td>'.$values["ProductName"].'</td>
				 		<td>'.$values["ProductQuantity"].'</td>	
				 		<td align="right">$ '.$values['ProductPrice'].'</td>			
				 		<td align="right">$ '.number_format($values["ProductQuantity"] * $values["ProductPrice"], 2).'</td>
				 		<td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["ProductID"].'">ລຶບ</button></td> 	
				 	</tr>
				 ';
			
			$total = $total + ($values["ProductQuantity"] * $values["ProductPrice"]);
		}
		$order_table .= '
			<tr>
			 <td colspan="3" align="right">ລວມ</td>
			 <td align="right">$ '.number_format($total, 2).'</td>
			 <td> </td>
			</tr>
		';
	}
	$order_table .= '</table>';
	$output = array(

		'order_table'   => $order_table,
		'cart_item' 	=>	count($_SESSION["shopping_cart"]) 
	);
	echo json_encode($output);
	}
}
 ?>