<?php
$state = $_GET['state'];
if( $state == "login") login();
else addUser();

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function addUser()
{
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
            header("Location: home.php?user=".$user);
        }
        else{
            $msg = "Error Registering: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
        $connection->close();
    }
}
function login() {
    include("connection.php");

    $email = sanitize($_GET['email']);
    $password = sanitize($_GET['password']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        $storedUsername = $row['user_name'];

        if (password_verify($password, $storedPassword)) {
            header("Location: home.php?user=".$storedUsername);
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $connection->close();
}

?>