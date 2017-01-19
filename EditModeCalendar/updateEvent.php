<?php
include '../connect.php';

session_start();
$logged_in_user = $_SESSION['login'];

$name = $_POST['event_name'];
$description = $_POST['event_desc'];
$location = $_POST['event_location'];

if(isset($_POST['event_category'])){
	$category = $_POST['event_category'];
}else{
	$category = "NULL";
}

// if value of branch is not null it shud update events for every branch
if(isset($_POST['branch'])){
	foreach ($_POST['branch'] as $selectedOption){
	    if(mysqli_query($conn,"UPDATE `cal_events_new` SET `event_name`=$name, `event_desc`=$description, `location`=$location, `web_user`=$logged_in_user, `category`=$category WHERE `event_id`=0 AND `branch`=$selectedOption")){
			echo '<br>updated';
		}
		else{
			echo mysqli_error($conn);
		}
	}
}else{
	echo 'shit';
	//TODO: make this an update query
	// if(mysqli_query($conn,"INSERT INTO `cal_events_new`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','NULL','$category'")){
	// 		echo '<br>inserted';
	// 	}
	// 	else{
	// 		echo mysqli_error($conn);
	// 	}
}




// header('Location: '.$_SERVER['HTTP_REFERER']);	
?>
