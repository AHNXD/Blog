<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include("../database/connection.php");

    $sql = "SELECT * FROM categories";
    $data = mysqli_query($connection, $sql);

    if ($data->num_rows > 0) {
        $rows = $data->fetch_all(MYSQLI_ASSOC);
        for($i =0 ; $i<count($rows); $i++){
            $title = $rows[$i]['category_name'];
            $imageURL = $rows[$i]['photo'];

            // Display category image with text
            echo '<div>';
            echo "<img src=\"../photos/$imageURL\" alt=\"$title\">";
            echo '<p>' . $title . '</p>';
            echo '</div>';
        }
    }
?>
</body>
</html>

