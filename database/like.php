<?php
include("connection.php");
session_start();

$userID = $_SESSION['user_ID'];
$articleid = $_POST['article_ID'];

$sql = "SELECT * FROM likes WHERE user_ID = $userID AND article_ID = $articleid";
$result = mysqli_query($connection, $sql);
$count = mysqli_num_rows($result);

if ($count == 0) {
    $sql = "INSERT INTO likes (user_ID, article_ID) VALUES ($userID, $articleid)";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
    }
} else {
    $sql = "DELETE FROM likes WHERE user_ID = $userID AND article_ID = $articleid";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to delete data"));
    }
}
?>
