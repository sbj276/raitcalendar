<?php
include "connect.php";
$category="";
$some="";
header('Content-Type: application/json');

if(isset($_REQUEST['branch'])){
	$branch=$_REQUEST['branch'];
}
else{
		$branch=" ";
}
if(isset($_REQUEST['category'])){
	$category=$_REQUEST['category'];
	}	
else
	$category=" ";

if(isset($_REQUEST['timerange'])){
	$timerange=$_REQUEST['timerange'];
	//do things to set timerange

	$today=date('Y-m-d',time());
	$firstDayOfTheWeek = date('Y-m-d', strtotime('this week last monday', strtotime($today)));
	$lastDayOfTheWeek=date('Y-m-d', strtotime('this week next sunday', strtotime($today)));
	$nextweekfirstday=date('Y-m-d', strtotime('this week next monday', strtotime($today)));
	$nextweeklastday=date('Y-m-d', strtotime('next week this sunday', strtotime($today)));

	$currentYear=date("Y",time());
    $currentMonth=date("m",time());
    $totaldaysinmonth=_daysInMonth($currentMonth,$currentYear);
    $nextMonth=date("m",strtotime($currentYear.'-'.$currentMonth.'-'.$totaldaysinmonth)+86400);
	$nextMonthsYear=date("Y",strtotime($currentYear.'-'.$currentMonth.'-'.$totaldaysinmonth)+86400);
	$totalNextMonthsDays=_daysInMonth($nextMonth,$nextMonthsYear);

	$firstdayofthismonth = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-1')); 
	$lastdayofthismonth = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-'.$totaldaysinmonth)); 
	$firstdayofnextmonth = date('Y-m-d', strtotime($currentYear.'-'.$currentMonth.'-'.$totaldaysinmonth)+86400); 
	$lastdayofnextmonth = date('Y-m-d', strtotime($nextMonthsYear.'-'.$nextMonth.'-'.$totalNextMonthsDays)); 

	if($timerange=="All"){
		$timerange_query_addition = "1";
	}
	else if($timerange=="Today"){
		$timerange_query_addition = "start_date!='0000-00-00' AND NOW() BETWEEN start_date AND end_date and start_date!='0000-00-00'";
	}
	else if($timerange=="Tomorrow"){
		$timerange_query_addition = "start_date!='0000-00-00' AND time()+86400 BETWEEN start_date AND end_date and start_date!='0000-00-00'";
	}
	else if($timerange=="Current_Week"){
		$timerange_query_addition = "start_date>='".$firstDayOfTheWeek."' and start_date<='".$lastDayOfTheWeek."' and start_date!='0000-00-00'";
	}
	else if($timerange=="Next_Week"){
		$timerange_query_addition = "start_date>='".$nextweekfirstday."' and start_date<='".$nextweeklastday."' and start_date!='0000-00-00'";
	}
	else if($timerange=="Current_Month"){
		$timerange_query_addition = "start_date>='".$firstdayofthismonth."' and start_date<='".$lastdayofthismonth."' and start_date!='0000-00-00'";
	}
	else if($timerange=="Next_Month"){
		$timerange_query_addition = "start_date>='".$firstdayofnextmonth."' and start_date<='".$lastdayofnextmonth."' and start_date!='0000-00-00'";
	}
}
else
	$timerange="";


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
	$sql="select * from  cal_events_new where 1";
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