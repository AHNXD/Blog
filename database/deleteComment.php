<?php
include("connection.php");

$commentID = $_POST['comment_ID'];

$sql = "DELETE FROM comments WHERE ID = $commentID";
$result = mysqli_query($connection, $sql);
if ($result) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
}
?>