<?php
    include("connection.php");
    if(isset($_GET['user']) && isset($_GET['email']) && isset($_GET['password'])){
        $user = sanitize($_GET['user']);
        $email = sanitize($_GET['email']);
        $password = sanitize($_GET['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `users` (`user_name`,`email`,`password`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sss", $user, $email, $hashedPassword);
        $result = mysqli_stmt_execute($stmt);
        if($result){
            header("Location: ../pages/home.php?user=".$user);
        }
        else{
            $msg = "Error Registering: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
        $connection->close();
    }
?>