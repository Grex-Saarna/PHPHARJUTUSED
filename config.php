<?php
$servername = 'localhost';
$dbname = 'muusikpod';
$username = 'root';
$password = '';
$sqluhendus = mysqli_connect($servername, $username, $password, $dbname);
if(!$sqluhendus){
	die('Ei saa ühendust andmebaasiga');
}
?>