<?php

	
// Connexion à la base de données
require_once('../connect.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$sql = "UPDATE `cal_events_new` SET start_date = '$start', end_date = '$end' WHERE event_id LIKE '$id' ";

	
	if(mysqli_query($conn,$sql)){
		echo '<br>updated';
	}else{
		echo mysqli_error($conn);
	}	

}

// header('Location: '.$_SERVER['HTTP_REFERER']); 
?>
