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

            if (password_verify($password, $storedPassword)) {
                if($row['is_admin'] == true) header("Location: ../pages/admin.php?user=".$row['user_name']);
                else header("Location: ../pages/home.php?user=".$row['user_name']);
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }
        $connection->close();
    }
?>