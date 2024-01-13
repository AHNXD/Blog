<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/articles.css">
    <title>Articles</title>
</head>
<body>
    <div class="wrapper">
        <div class="form-container">
            <div class="form-inner">
                <div class="title-admin"><h1 style="color: #a445b2"><?php echo $_GET['user'] ?></h1></div>
                <h3><?php echo $_GET['catName']; ?></h3>
                <button class='button-85' role='button' onclick='signOut()'>LogOut</button>
                <button class='button-85' role='button' onclick='history.back()'>Go Back</button>
            </div>
        </div>
    </div>
        <?php
            include("../database/connection.php");
            $id = $_GET['ID'];
            $isAdmin = $_GET['isAdmin'];
            $sql = "SELECT * FROM article";
            if ($id != 0)
            {
                $sql .= " WHERE category_ID = $id";
            }
            $data = mysqli_query($connection, $sql);

            if ($data->num_rows > 0) {
                $rows = $data->fetch_all(MYSQLI_ASSOC);
                for($i =0 ; $i < count($rows); $i++){
                    $id = $rows[$i]["ID"];
                    $title = $rows[$i]['title'];
                    $imageURL = $rows[$i]['photo'];
                    $explanation =$rows[$i]['description'];

                    echo " <div class='wrapper'><div class='form-container'><div class='form-inner'>";
                    echo "<div class='article' >";
                    echo "<img src=\"../photos/$imageURL\" alt=\"$title\">";
                    echo "<h1> $title </h1>";
                    echo "<h4> $explanation </h4>";
                    echo "<hr />";
                    echo "<div class=\"btns\" style='display:flex;justify-content:center;margin:16px;'> <button class='button-64' role='button' onclick='goToContent(\"$id\")''><span class='text'>See More</span></button> </div>";                    
                    if($isAdmin) echo "<button class='button-85' role='button' onclick='deleteArticle(\"$id\")'>Delete</button>";
                    echo " </div> </div> </div> </div>";
                }
            }
            $connection->close();
        ?>
    <script>     
        function signOut() {
            window.location = "logInUp.php";
        }
        function goToContent(id){
            window.location = "articleContent.php?ID=" + id;
        }
        function deleteArticle(id) {
            window.location.href = "../database/deleteArticle.php?ID=" + id;
        }
    </script>
</body>
</html>