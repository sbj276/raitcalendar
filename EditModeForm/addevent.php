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

if(isset($_POST['COMPUTER']))
	$COMPUTER = $_POST['COMPUTER'];
else
	$COMPUTER = false;

if(isset($_POST['EXTC']))
	$EXTC = $_POST['EXTC'];
else
	$EXTC = false;

if(isset($_POST['IT']))
	$IT = $_POST['IT'];
else
	$IT = false;

if(isset($_POST['INSTRU']))
	$INSTRU = $_POST['INSTRU'];
else
	$INSTRU = false;

if(isset($_POST['ETRX']))
	$ETRX = $_POST['ETRX'];
else
	$ETRX = false;

if(isset($_POST['FE']))
	$FE = $_POST['FE'];
else
	$FE = false;




if($COMPUTER){
	if(mysqli_query($conn,"INSERT INTO `cal_events`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','COMPUTER','$category')")){
		echo '<br>inserted';
	}
	else{
		echo mysqli_error($conn);
	}
}
if($EXTC){
	if(mysqli_query($conn,"INSERT INTO `cal_events`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','EXTC','$category')")){
		echo '<br>inserted';
	}
	else{
		echo mysqli_error($conn);
	}
}
if($IT){
	if(mysqli_query($conn,"INSERT INTO `cal_events`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','IT','$category')")){
		echo '<br>inserted';
	}
	else{
		echo mysqli_error($conn);
	}
}
if($ETRX){
	if(mysqli_query($conn,"INSERT INTO `cal_events`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','ETRX','$category')")){
		echo '<br>inserted';
	}
	else{
		echo mysqli_error($conn);
	}
}
if($INSTRU){
	if(mysqli_query($conn,"INSERT INTO `cal_events`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','INSTRU','$category')")){
		echo '<br>inserted';
	}
	else{
		echo mysqli_error($conn);
	}
}
if($FE){
	if(mysqli_query($conn,"INSERT INTO `cal_events`(`event_name`, `start_date`, `end_date`, `event_desc`, `location`, `web_user`, `branch`, `category`) VALUES ('$name','$start','$end','$description','$location','$logged_in_user','FE','$category')")){
		echo '<br>inserted';
	}
	else{
		echo mysqli_error($conn);
	}
}

header('Location:../ViewCalendar/');
?>