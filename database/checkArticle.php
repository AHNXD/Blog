<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/checkArticle.css">
    <title>Status</title>
</head>
<body>
    <div class="wrapper">
        <div class="form-container">
            <div class="form-inner">
                <div class="title-Categories">
                    <h1>
                        <?php
                            include("connection.php");
                            if(isset($_GET['title']) && isset($_GET['catID']) && isset($_GET['description']) && isset($_GET['authorName']) && isset($_GET['article']) && isset($_GET['photo']))
                            {
                                $title = sanitize($_GET['title']);
                                $catID = sanitize($_GET['catID']);
                                $description = sanitize($_GET['description']);
                                $authorName = sanitize($_GET['authorName']);
                                $article = sanitize($_GET['article']);
                                $photo = sanitize($_GET['photo']);
                                
                                $sql = "INSERT INTO article (`category_ID`, `title`, `description`, `author_name`, `content`, `photo`) VALUES (?, ?, ?, ?, ?, ?)";
                                $stmt = mysqli_prepare($connection, $sql);
                                mysqli_stmt_bind_param($stmt, "isssss", $catID, $title, $description, $authorName, $article, $photo);
                        
                                $result = mysqli_stmt_execute($stmt);
                                if ($result) {
                                    echo "Added successfully";
                                } else {
                                    echo "Error, Try again!";
                                }
                                mysqli_stmt_close($stmt);
                                $connection->close();
                            }else{ echo "Something Went Wrong!"; }
                        ?>
                    </h1>
                </div>
                <button class="button-85" role="button" onclick="goBackAndPop()">Go Back</button>
            </div>
        </div>
    </div>
    <script>
        function goBackAndPop() {
            history.replaceState(null,null, "../pages/addArticle.php");
            history.back();
        }
    </script>
</body>
</html>

