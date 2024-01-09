<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";

try{
    $connection = new mysqli($servername, $username, $password, $database);
    if (!$connection) die("". mysqli_connect_error());
    echo "Connected successfully";
}catch(Exception $e){
    echo "". $e->getMessage();
}

?>