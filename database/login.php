<?php
    include("connection.php");
    session_start();
    if(isset($_GET['email']) && isset($_GET['password'])){
        $email = sanitize($_GET['email']);
        $password = sanitize($_GET['password']);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $connection->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $storedID = $row['ID'];
            $storedPassword = $row['password'];
            $storedEmail = $row['email'];
            $storedName = $row['user_name'];
            $storedStatus = $row['is_admin'];

            if (password_verify($password, $storedPassword)) {
                $_SESSION['user_name'] = $storedName;
                $_SESSION['user_email'] = $storedEmail;
                $_SESSION['user_isAdmin'] = $storedStatus;
                if($storedStatus == 1) header("Location: ../pages/admin.php");
                else header("Location: ../pages/categories.php");
            } else {
                echo "Invalid email or password.";
            }


        } else {
            echo "Invalid email or password.";
        }
        $connection->close();
    }
?>