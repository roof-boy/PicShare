<?php
session_start();

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

# Execute SELECT query

$query = "SELECT id, passw, isAdmin FROM users WHERE username=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $formUsr);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Fetch the hashed password and isAdmin from the result
    $row = mysqli_fetch_assoc($result);
    $hashedPasswordFromDatabase = $row['passw'];
    $isAdmin = $row['isAdmin'];

    // Verify the provided password against the hashed password from the database
    if (password_verify($formPass, $hashedPasswordFromDatabase)) {
        $_SESSION['username'] = $formUsr;
        $_SESSION['userId'] = $row['id'];
        if ($isAdmin == 1) {
            // User is an admin, set session variable to true
            $_SESSION['isAdmin'] = true;
        }
        
        // Redirect to main page
        header("Location: ../main/main.php");
        exit();
    } else {
        // Passwords do not match, redirect to login invalid page
        header("Location: login.php?login=invalid");
        exit();
    }
} else {
    // No user found with the provided username, redirect to login invalid page
    header("Location: login.php?login=userInvalid");
    exit();
}

mysqli_stmt_close($stmt);

# Disconnect from DB

mysqli_close($conn);
exit();
?>
