<?php
 include("connection.php");
 if ($connection->connect_error) {
    die('Connection failed: ' . $connnection->connect_error);

 $sql = "SELECT * FROM categories";
 $data = mysqli_query($connection, $sql);

 if ($data->num_rows > 0) {
    $rows = $data->fetch_all(MYSQLI_ASSOC);
    for($i =0 ; $i<count($rows); $i++){
        $title = $rows[$i]['category_name'];
        $imageURL = $rows[$i]['image_url'];

        // Display category image with text
        echo '<div>';
        echo '<img src="' . $imageURL . '" alt="' . $name . '">';
        echo '<p>' . $name . '</p>';
        echo '</div>';
    }
}
?>


