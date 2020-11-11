<?php
try
{
$baglan = new PDO("mysql:host=localhost;dbname=basat_elektronik","root","");
$baglan->query("set character set utf8");
}

catch(PDOException $e)
{
	$e->getMessage();
	print $e;
}
?>