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
            $storedEmail = $row['email'];
            $storedName = $row['user_name'];
            $storedStatus = $row['is_admin'];

            if (password_verify($password, $storedPassword)) {
                if($storedStatus == 1) header("Location: ../pages/admin.php?user=$storedName&isAdmin=1");
                else header("Location: ../pages/categories.php?user=$storedName&isAdmin=0");
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }
        $connection->close();
    }
?>