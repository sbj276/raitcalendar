<?php

	
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=rait_calendar_sys;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
