<?php 
/*
 *	The global connect file
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rait_calendar_sys";
$content="";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if(!$conn)
	echo mysqli_error($conn);
?>
