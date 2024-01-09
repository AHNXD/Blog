<?php
$user;
$email;
$password;
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function addUser()
{
    include("connection.php");
    if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['password'])){
        $user = sanitize($_POST['user']);
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `users` (`user_name`,`email`,`password`) VALUES (?, ?, ?)";
        // Create a prepared statement
        $stmt = mysqli_prepare($connection, $query);
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sss", $user, $email, $hashedPassword);
        // Execute the statement
        $result = mysqli_stmt_execute($stmt);
        // Check the result
        if($result){
            $msg = "Registered Successfully";
        }
        else{
            $msg = "Error Registering: " . mysqli_error($connection);
        }
        // Close the statement
        mysqli_stmt_close($stmt);
        $connection->close();
    }
}
?>