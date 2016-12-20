<?php

include "conn_cal_view.php";
header('Content-Type: application/json');

$return["aaData"]= array();
$sql="SELECT * from cal_events WHERE event_id=1";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
	 array_push($return["aaData"],array('event_id'=>intval($row['event_id']),'event_name'=>$row['event_name'],'start_date'=>$row['start_date'],'end_date'=>$row['end_date'],'event_desc'=>$row['event_desc'],'location'=>$row['location'],'web_user'=>$row['web_user']));
}

echo json_encode($return);
?>