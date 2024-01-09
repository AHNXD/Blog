<?php
addUser();
// Function to sanitize user input
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
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sss", $user, $email, $hashedPassword);
        $result = mysqli_stmt_execute($stmt);
        if($result){
            $msg = "Registered Successfully";
        }
        else{
            $msg = "Error Registering: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    }
}
function login($connection) {
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    $sql = "SELECT password FROM users WHERE email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if (password_verify($password, $storedPassword)) {
            echo "Login successful!";
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    login($connection);
}
$connection->close();
?>