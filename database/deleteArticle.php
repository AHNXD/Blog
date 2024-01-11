<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/deleteArticle.css">
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
                            $id = $_GET ['ID'];

                            $sql = "DELETE FROM article WHERE ID = $id";

                            $result = mysqli_query ($connection,$sql);

                            if ($result) {
                                $count = mysqli_affected_rows($connection);
                                if ($count > 0) {
                                    echo "Article deleted successfully";
                                } else {
                                    echo "Error, Try again!";
                                }
                            } else {
                                echo "Something went wrong!";
                            }

                            $connection->close();
                        ?>
                    </h1>
                </div>
                <button class="button-85" role="button" onclick="goBackAndPop()">Go Back</button>
            </div>
        </div>
    </div>
    <script>
        function goBackAndPop() {
            history.back();
        }
    </script>
</body>
</html>