<?php
    include("connection.php");
    $id = $_POST['ID'];

    $sql = "DELETE FROM article WHERE ID = $id";

    $result = mysqli_query ($connection,$sql);

    if ($result) {
        $count = mysqli_affected_rows($connection);
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
        }
    } else {
        echo "Something went wrong!";
    }
?>