
<?php
    include("connection.php");

    $title = sanitize($_POST['title']);
    $catID = sanitize($_POST['category']);
    $description = sanitize($_POST['description']);
    $authorName = sanitize($_POST['authorName']);
    $article = sanitize($_POST['article']);
    $photo = sanitize($_POST['photo']);
    
    $sql = "INSERT INTO article (`category_ID`, `title`, `description`, `author_name`, `content`, `photo`) VALUES ($catID, '$title', '$description', '$authorName', '$article', '$photo')";

    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to insert data"));
    }
?>

