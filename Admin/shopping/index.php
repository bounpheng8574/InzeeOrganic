<?php session_start();
include_once ('db.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Page Title</title>

		<?PHP include_once 'library.php';?>

	</head>
	<body>

		<br/>
		<div class="container" style="width: 800px;">
			<h3 align="center">Shopping Cart </h3>
	<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#Products" role="tab" data-toggle="tab">ສິນຄ້າ</a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="#Cart" role="tab" data-toggle="tab">ກະຕ່າ<span class="badge badge-info">
    	<?php if (isset($_SESSION['shopping_cart'])) 
    	{ echo count($_SESSION['shopping_cart']);  
				}else{ 
					echo '0';
				}
				?>
				</span>
			</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#references" role="tab" data-toggle="tab">ເອກະສານ</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="Products">
  	<div class="row">
					<?php
				include_once ('db.php'); 
				$query = "SELECT * FROM products order by ProductID asc";
				$result = mysqli_query($dbcon, $query); 
				while ($row = mysqli_fetch_array($result)) { ?>
		<div class="col-md-4" style="margin-top: 12px;">
				 <div style="border: 1px solid #333; background-color: #f1f1f1; border-radius: 5px;" class="btn btn-warning form-control add_to_cart" value="ຈັບໃສ່ກະຕ່າ">
				 	<img class="img-thumbnail" src="../images/<?php echo $row["ProductImage"]; ?>" style='width:350px;height:150px;'><br/>
				 	<h4 class="text-info"><?php echo $row["ProductName"]; ?></h4>
				 	<h4 class="text-danger"><?php echo $row["ProductPrice"];?></h4>
				 	<input type="text" name="ProductQuantity" id="ProductQuantity<?php echo $row["ProductID"];?>" class="form-control" value="1"/>

				 	<!-- hidden -->
				 	<input type="hidden" name="hidden_name" id="ProductName<?php echo $row["ProductID"];?>" value="<?php echo $row["$ProductName"]; ?>">
				 	<input type="hidden" name="hidden_Price" id="ProductPrice<?php echo $row["ProductID"];?>" value="<?php echo $row["$ProductPrice"]; ?>">
				 	<input type="button" name="add_to_cart" id="<?php echo $row["ProductID"]; ?>" class="btn btn-warning form-control add_to_cart" value="add_to_cart" style="margin-top: 5px;">
				 </div>   
				</div>
				<?php	
				} 
			?>	
			</div>
		</div>
	
	<!-- tab cart -->
  <div role="tabpanel" class="tab-pane fade" id="Cart">ລາຍການສັ່ງຊື້
  <div class="table-responsive" id="order_table"> 
				<table class="table table-bordered">
				 	<tr>
				 		<th width="40%">ຊື່ສິນຄ້າ</th>
				 		<th width="10%">ຈຳນວນ</th>
				 		<th width="20%">ລາຄາ</th>
				 		<th width="15%">ລວມເງິນ</th>
				 		<th width="5%">ຈັດການ</th>
				 	</tr>
				 	<?php 
				 	if (!empty($_SESSION['shopping_cart'])) {
				 		$total = 0;
				 		foreach ($_SESSION['shopping_cart'] as $keys => $values) {
				 			?>
				 	<tr>
				 		<td><?php echo $values['ProductName']; ?></td>
				 		<td><?php echo $values['ProductQuantity']; ?></td>	
				 		<td align="right">$ <?php echo $values['ProductPrice'] ?></td>			
				 		<td align="right">$ <?php echo number_format($values['ProductQuantity'] * $values['ProductPrice'], 2)?></td>
				 		<td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo  $values['ProductID']; ?>"> ລຶບ</button></td> 	
				 	</tr>
				 	<?php 
				 		$total = $total + ($values['ProductQuantity'] * $values['ProductPrice']);
				 		}
				 	 ?>
				 	<tr>
					 <td colspan="3" align="right">ລວມ</td>
					 <td align="right">$ <?php echo number_format($total, 2) ?> 
					</td>
					 <td> </td>
					</tr>
				 
				 	<?php
						}
				 	?>
				 </table>
			</div>
</div>
			<!-- tab c -->
<div role="tabpanel" class="tab-pane fade" id="references">ເອກະສານ</div>
</div> <!-- end tab panes -->
</div>
</body>
		<script> 
			$(document).ready(function(data){

				$('.add_to_cart').click(function(){
				var ProductID 	=	$(this).attr("ProductID");
				var ProductName =	$('#ProductName'+ProductID).val();
				var ProductPrice =	$('#ProductPrice'+ProductID).val();
				var ProductQuantity =	$('#ProductQuantity'+ProductID).val();
				var action = "add";
				if (ProductQuantity > 0) {
					$.ajax({
						url:"action.php",
						method:"POST",
						dataType:"json",
						data:{
							ProductID:ProductID,
							ProductName:ProductName,
							ProductPrice:ProductPrice,
							ProductQuantity:ProductQuantity,
							action:action
						},
					success:function(data)
					{
						$('#order_table').html(data.order_table);
						$('#badge').text(data.cart_item);
						alert("success");
					}
				});

				}else {
					alert("enter quantity")				
				}
			 });		
		});
		</script>
		
	</body>
</html>