<?php
include "connect.php";
$category="";
$some="";
header('Content-Type: application/json');

if(isset($_REQUEST['branch'])){
	$branch=$_REQUEST['branch'];
}
else{
		$branch="";
}
if(isset($_REQUEST['category'])){
	$category=$_REQUEST['category'];
	}	
else
	$category="";


if($branch!="" && $category!=""){
	 //$sql="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE branch='$branch' ";
	 $arr1=explode(',',$category);
	if(sizeof($arr1)==1){
		$sql="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE branch='$branch' and category='$arr1[0]'";
	}else{
		$sql1="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE branch='$branch' and (category)";
		$concate=implode("' or category='",$arr1);
		$f1="'".$concate."'";
		$sql=str_replace('category',"category=$f1",$sql1);
	}
	 
}
else if($branch!=""){
	$sql="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE branch='$branch'";
}
else if($category!=""){
	$arr1=explode(',',$category);
	if(sizeof($arr1)==1){
		$sql="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE category='$arr1[0]'";
	}else{
		$sql1="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE category";
		$concate=implode("' or category='",$arr1);
		$f1="'".$concate."'";
		$sql=str_replace('category',"category=$f1",$sql1);
	}

}
else{
	$sql="SELECT * FROM `cal_events_new` ;";
}

$return["aaData"] = array();

$result=mysqli_query($conn,$sql);
if(!$result){
	mysqli_error($conn);
}
while($row=mysqli_fetch_array($result))
{
	 array_push($return["aaData"],array('event_id'=>intval($row['event_id']),'event_name'=>$row['event_name'],'start_date'=>$row['start_date'],'end_date'=>$row['end_date'],'event_desc'=>$row['event_desc'],'location'=>$row['location']));
}
echo json_encode($return);

/* echo'';
$sql="SELECT *,DATE(start_date) AS start_date,DATE(end_date) AS end_date FROM cal_events_new WHERE branch='IT'";
if($result=mysqli_query($conn,$sql))
print_r($result); */

?>