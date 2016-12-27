<?php

/*
 * dont use this this file while running locally.
 * change connect_local.php to connect.php to run the application locally.
*/
	$con=mysqli_connect('mysql.hostinger.in','u660503975_man','mandeep123');
	
	if($con)
		echo "";
	else 
		echo "connection no done";
	
	if(mysqli_select_db($con,"u660503975_man"))
		echo "";
	else
		echo "db no seleced";
?>