<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
<?php
    include("../database/connection.php");

    $sql = "SELECT * FROM article";
    $data = mysqli_query($connection, $sql);

    if ($data->num_rows > 0) {
        $rows = $data->fetch_all(MYSQLI_ASSOC);
        for($i =0 ; $i<count($rows); $i++){
            $title = $rows[$i]['title'];
            $imageURL = $rows[$i]['photo'];
            $explanation =$rows[$i]['description'];
            
            echo '<div>';
            echo "<img src=\"../photos/$imageURL\" alt=\"$title\">";
            echo '<h1>' . $title . '</h1>';
            echo '<h4>' . $explanation . '</h4>';
            echo '</div>';
        }
    }
?>
</body>
</html>