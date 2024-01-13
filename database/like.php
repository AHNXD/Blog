<?php
include("connection.php");
session_start();

$userID = $_SESSION['user_ID'];
$articleid = $_POST['article_ID'];

// check if the user has already liked the article
$sql = "SELECT * FROM likes WHERE user_ID = $userID AND article_ID = $articleid";
$result = mysqli_query($connection, $sql);
$count = mysqli_num_rows($result);

if ($count == 0) {
    $sql = "INSERT INTO likes (user_ID, article_ID) VALUES ($userID, $articleid)";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        // return a success message and the new number of likes
        $sql = "SELECT COUNT(*) AS 'likes' FROM likes WHERE article_ID = $articleid";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['likes'];
        echo json_encode(array("status" => "success", "likes" => $likes));
    } else {
        // return an error message
        echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
    }
} else {
    // if the user has already liked the article, delete the row from the likes table
    $sql = "DELETE FROM likes WHERE user_ID = $userID AND article_ID = $articleid";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        // return a success message and the new number of likes
        $sql = "SELECT COUNT(*) AS 'likes' FROM likes WHERE article_ID = $articleid";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['likes'];
        echo json_encode(array("status" => "success", "likes" => $likes));
    } else {
        // return an error message
        echo json_encode(array("status" => "error", "message" => "Failed to delete data"));
    }
}
?>
