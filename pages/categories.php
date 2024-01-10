<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/categories.css">
    <title>Categories</title>
</head>
<body>
    <div class="wrapper">
        <div class="form-container">
            <div class="form-inner">
                <div class="title-Categories"><h1>Categories</h1></div>
                <div class="btns">
                    <?php
                        include("../database/connection.php");  
                        $sql = "SELECT * FROM categories";
                        $data = mysqli_query($connection, $sql);

                        if ($data->num_rows > 0) {
                            $rows = $data->fetch_all(MYSQLI_ASSOC);
                            for($i = 0 ; $i < count($rows) ; $i++){
                                $title = $rows[$i]['category_name'];
                                $imageURL = $rows[$i]['photo'];

                                echo "<button id='btnCat' class='button-64' role='button' onClick='goToHome(\"$title\")'><span class='text'>$title</span></button>"; 
                            }
                        }
                        $connection->close();
                    ?>
                </div>
                <button class="button-85" role="button" onclick="signOut()">LogOut</button>
            </div>
        </div>
    </div>
    <script>
        function goToHome(title){
            window.location = "home.php?title=" + title;
        }  
        function signOut() {
            window.location = "logInUp.php";
        }
    </script>
</body>
</html>

