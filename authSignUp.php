<?php
include("operationToDataBase.php");
addUser();
header("location: home.php?user=$user");
?>