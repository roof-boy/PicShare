<?php

# Establish DB connection

$username = 'root';
$password = 'root';
$host = 'localhost';
$database = 'picshare';

$conn = mysqli_connect($host, $username, $password, $database);

# Check the DB connection

if ($conn->connect_error)  {
    die('Connection failed: '. $conn->connect_error);
}

# Retrieve login form input

$formUsr = $_POST['usr'];
$formPass = $_POST['psw'];

$hashedPassword = password_hash($formPass, PASSWORD_DEFAULT);

# Execute SELECT query

$query = "SELECT * FROM users WHERE username='$formUsr' AND passw='$hashedPassword'";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    echo("login success");
} else {
    header("login/login.html?loginFail=invalid");
}

# Disconnect from DB

mysqli_close($conn);