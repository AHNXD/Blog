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
        $sql = "SELECT COUNT(*) AS 'likes' FROM likes WHERE article_ID = $articleid";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['likes'];
        echo json_encode(array("status" => "success", "likes" => $likes));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
    }
} else {
    $sql = "DELETE FROM likes WHERE user_ID = $userID AND article_ID = $articleid";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $sql = "SELECT COUNT(*) AS 'likes' FROM likes WHERE article_ID = $articleid";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['likes'];
        echo json_encode(array("status" => "success", "likes" => $likes));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to delete data"));
    }
}
?>
