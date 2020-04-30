<?php
	session_start();
	session_destroy();
	header('location:form.php');
	$alert = crypt('Not login and refresh');
	echo "<meta http-equiv='refresh', content='1;URL=index.php?login=$alert' />";
?>