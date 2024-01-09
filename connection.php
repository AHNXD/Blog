<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";

try{
    $msg;
    $connection = new mysqli($servername, $username, $password, $database);
    if (!$connection) die("". mysqli_connect_error());
        $msg = "Connected successfully";
}catch(Exception $e){
        $msg = "". $e->getMessage();
}

?>