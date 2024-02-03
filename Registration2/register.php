<?php

# Validate input from register.html

$formUser = $_POST['usr'];
$formPass = $_POST['psw'];
$formMail = $_POST['eml'];

$hashedPassword = password_hash($formPass, PASSWORD_DEFAULT);

# Connect to DB

$username = 'root';
$password = 'root';
$server = 'localhost';
$database = 'picshare';

$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Insert record

$query = "INSERT INTO users (username, passw, email) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sss", $formUser, $hashedPassword, $formMail);
// Bind other parameters if needed

// Step 4: Execute the Query
if(mysqli_stmt_execute($stmt)) {
    $success = true;
    if ($success) {
        header("Location: register.html?registration=true"); // Redirect with success parameter
        exit();
    }
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

