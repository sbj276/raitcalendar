<?php
try
{
	//to work on the local database
	$bdd = new PDO('mysql:host=localhost;dbname=rait_calendar_sys', 'root', '');

	//to work on the remote database
	// $bdd = new PDO('mysql:host=sql6.freesqldatabase.com;dbname=sql6151113', 'sql6151113', 'VlFmqI5kJ4');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(!$bdd){
	echo mysqli_error($bdd);
}