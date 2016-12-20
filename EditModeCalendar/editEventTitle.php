<?php
require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['event_id'])){
	
	$id = $_POST['event_id'];
	
	$sql = "DELETE FROM cal_events WHERE event_id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur executes');
	}
	
}elseif (isset($_POST['event_id']) && isset($_POST['event_name']) && isset($_POST['event_desc']) && isset($_POST['event_location'])){
	session_start();
	$logged_in_user = $_SESSION['login'];
	$event_id = $_POST['event_id'];
	$name = $_POST['event_name'];
	$description = $_POST['event_desc'];
	$location = $_POST['event_location'];
	
	if(isset($_POST['event_category'])){
		$category = $_POST['event_category'];
	}else{
		$category = "NULL";
	}

	$sql = "UPDATE cal_events SET  `event_name`='$name', `event_desc`='$description', `location`='$location', `category`='$category' WHERE event_id='$event_id'";

	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: index.php');

	
?>
