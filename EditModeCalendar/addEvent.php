<?php
include '../connect.php';

session_start();
$logged_in_user = $_SESSION['login'];

$name = $_POST['event_name'];
$start = $_POST['event_start'];
$end = $_POST['event_end'];
$description = $_POST['event_desc'];
$location = $_POST['event_location'];

if(isset($_POST['event_category'])){
	$category = $_POST['event_category'];
}else{
	$category = "NULL";
}

if(isset($_POST['branch'])){
	foreach ($_POST['branch'] as $selectedOption){
	    if(mysqli_query($conn,"INSERT INTO `cal_events_new`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','$selectedOption','$category')")){
			//echo '<br>inserted';
			header('Location: index.php');  
		}
		else{
			echo mysqli_error($conn);
		}
	}
}else{
	if(mysqli_query($conn,"INSERT INTO `cal_events_new`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','NULL','$category')")){
			echo '<br>inserted';
		}
		else{
			echo mysqli_error($conn);
		}
}




// header('Location: '.$_SERVER['HTTP_REFERER']);	
?>
