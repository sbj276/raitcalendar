<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=rait_calendar_sys', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(!$bdd){
	echo mysqli_error($bdd);
}