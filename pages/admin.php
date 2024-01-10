<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admin.css">
    <title>Admin</title>
</head>
<body>
    <div class="wrapper">
        <div class="form-container">
            <div class="form-inner">
                <div class="title-admin"><h1><?php echo $_GET['user'] ?></h1></div>
                <div class="btns">
                    <button class="button-64" role="button" onclick=""><span class="text">Categories</span></button>
                    <button class="button-64" role="button" onclick="goToAddArticle()"><span class="text">Add Article</span></button>
                </div>
                <button class="button-85" role="button">LogOut</button>
            </div>
        </div>
    </div>
    <script>
        function goToAddArticle() {
            window.location = "addArticle.php";
        }
    </script>
</body>
</html>