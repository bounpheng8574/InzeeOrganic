<?php
 session_start();
  $orderID=$_POST['order_id'];
  $productdetail = $_POST['detail'];
  $_SESSION['imp_OrderId'] = $orderID;
  $_SESSION['imp_productdetail'] = $productdetail;
  echo json_encode("ບັນທືກຂໍ້ມູນແລ້ວ. ກົດຕົກລົງເພື່ອຢີນຢັນ");
?>