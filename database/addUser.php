<?php
    include("connection.php");
    session_start();
    if(isset($_GET['user']) && isset($_GET['email']) && isset($_GET['password'])){
        $user = sanitize($_GET['user']);
        $email = sanitize($_GET['email']);
        $password = sanitize($_GET['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $state = 0;
        if(isset($_GET['isAdmin'])) $state = 1;
        
        $query = "INSERT INTO `users` (`user_name`,`email`,`password`,`is_admin`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $user, $email, $hashedPassword, $state);

        $result = mysqli_stmt_execute($stmt);
        if($result){
            $_SESSION['user_name'] = $user;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_isAdmin'] =  $state;
            if($state == 1) header("Location: ../pages/admin.php");
            else header("Location: ../pages/categories.php");
        }
        else{
            echo "Error Registering: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
        $connection->close();
    }
?>