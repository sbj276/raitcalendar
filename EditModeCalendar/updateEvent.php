<?php
include '../connect.php';

session_start();
$logged_in_user = $_SESSION['login'];

$id = $_POST['event_id'];
$name = $_POST['event_name'];
$description = $_POST['event_desc'];
//modify event description
	while(strpos($description, "\n")) {
		$description = substr($description, 0, strpos($description, "\n")-1).'<br/>'.substr($description, strpos($description, "\n")+1);
	}
//

$location = $_POST['event_location'];

if(isset($_POST['event_category'])){
	$category = $_POST['event_category'];
}else{
	$category = "NULL";
}

if(mysqli_query($conn,"UPDATE `cal_events_new` SET `event_name`='$name', `event_desc`='$description', `location`='$location', `category`='$category' WHERE `event_id`='$id'")){
	echo '<br>updated';
}else{
	echo mysqli_error($conn);
}

if(isset($_POST['delete'])){
	if(mysqli_query($conn,"DELETE FROM `cal_events_new` WHERE `event_id`='$id'")){
		echo 'deleted';
	}else{
		echo mysqli_error($conn);
	}	
}

header('Location: '.$_SERVER['HTTP_REFERER']);	
?>
