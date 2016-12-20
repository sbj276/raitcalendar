<?php
/*
 *	
 */

session_start();
if(isset($_SESSION['login']))
{
	header('Location: EditModeCalendar/');
}
else
{
	header('Location: ViewCalendar/');
}
?>