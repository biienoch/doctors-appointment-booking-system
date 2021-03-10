<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="doctors_appointment";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$conn){
    die("databse connection failed!");

}
?>