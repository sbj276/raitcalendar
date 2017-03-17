<?php
session_start();
include "../connect.php";
// Grab User submitted information
$username = $_POST["uid"];
$pass = $_POST["pass"];
/*
// Connect to the database
$con = mysql_connect("localhost","root","");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysql_select_db("rait_calendar_sys",$con);*/





//encrypt function
function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded   = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    echo 'Encrypted->'.$qEncoded;
    return( $qEncoded );
}




//validate from database
//echo 'passing';
$result = mysqli_query($conn,"SELECT * FROM `usertable` WHERE username='$username';");
if(!$result){
	mysqli_error($conn);
}
$row = mysqli_fetch_array($result);
//echo 'passing2';
//$epass=encryptIt($pass);
//echo 'username->'.$row['username'].'	pass->'.$row["password"];
if($row["username"]==$username && $row["password"]==$pass)
{
			$_SESSION['login'] = "$username";
			//populate the log table
			//still to be tested
			//TODO: remove constant IP
			$log_sql = "INSERT INTO `log_user`(`timestamp`, `operation`, `user`, `IP`) VALUES (NOW(),'LOGIN','$username','0.0.0.0')";
			header('Location: ../EditModeCalendar');  
}

else
{
	header('Location: ../Login/index.php?wrong=1'); 
}
?>