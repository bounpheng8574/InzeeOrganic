<?php
@mysql_connect("localhost", "root", "") or die(mysql_error());
@mysql_select_db("organicfinal") or die(mysql_error());
@mysqli_set_charset("utf8");
// $query1=mysql_connect("localhost","root","") or die(mysql_error());
// mysql_select_db("store",$query1) or die(mysql_error());

?>