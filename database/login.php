<?php
    include("connection.php");
    if(isset($_GET['email']) && isset($_GET['password'])){
        $email = sanitize($_GET['email']);
        $password = sanitize($_GET['password']);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $connection->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];
            $storedUsername = $row['user_name'];

            if (password_verify($password, $storedPassword)) {
                header("Location: ../pages/home.php?user=".$storedUsername);
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }
        $connection->close();
    }
?>