<?php
include("connection.php");
session_start();

$userID = $_SESSION['user_ID'];
$articleID = $_POST['article_ID'];
$comment = sanitize($_POST['comment']);

$sql = "INSERT INTO comments (user_ID, article_ID,comment) VALUES ($userID, $articleID, '$comment')";
$result = mysqli_query($connection, $sql);
if ($result) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
}
?>
