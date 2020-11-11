<?php
try
{
$baglan = new PDO("mysql:host=localhost;dbname=id9219008_basatelektronik","id9219008_basat","Basat12345");
$baglan->query("set character set utf8");
}

catch(PDOException $e)
{
	$e->getMessage();
	print $e;
}
?>