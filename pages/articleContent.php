<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/articleContent.css">
    <title>Content</title>
</head>
<body>
    <?php
        $id = $_GET['ID'];
        include("../database/connection.php");
        $sql = "SELECT * FROM article WHERE category_ID = $id";
        $data = mysqli_query($connection, $sql);

        if ($data->num_rows > 0) {
            $rows = $data->fetch_all(MYSQLI_ASSOC);
            $title = $rows[0]['title'];
            $imageURL = $rows[0]['photo'];
            $content =$rows[0]['content'];
            $author = $rows[0]['author_name'];

            echo " <div class='wrapper'><div class='form-container'><div class='form-inner'>";
            echo "<div class='article' >";
            echo "<img src=\"../photos/$imageURL\" alt=\"$title\">";
            echo "<h1 class='title'> $title </h1>";
            echo $content;
            echo "<h4 class ='author'> $author </h4>";
            echo "</div> </div> </div> </div>";
        }
    ?>
    <?php
        $sql = "SELECT comment ,user_name AS 'user' FROM comments c inner join users u on c.user_ID=u.ID where article_ID = $id;";
        $data = mysqli_query($connection, $sql);

        if ($data->num_rows > 0) {
            $rows = $data->fetch_all(MYSQLI_ASSOC);
            echo " <div class='comments'><div class='form-container'><div class='form-inner'>";
            echo "<h1>Comments</h1>";
            echo "</hr>";
            for($i =0 ; $i < count($rows); $i++){
                $user_name = $rows[0]['user'];
                $comment = $rows[0]['comment'];
                echo "<div class='comments' >";
                echo "<h1 class='user_name'> $user_name </h1>";
                echo "<h4 class ='comment'> $comment </h4>";
                echo "</hr>";
                echo "</div>";
            }
            echo "</div> </div> </div>";
        }
        $connection->close();
    ?>
</body>
</html>