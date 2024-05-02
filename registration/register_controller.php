<?php   

include '../config.php';

# Validate input from register.html

$formUser = $_POST['usr'];
$formPass = $_POST['psw'];
$formMail = $_POST['eml'];

$hashedPassword = password_hash($formPass, PASSWORD_DEFAULT);

# Connect to DB

$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Check if username already exists

$query_check_username = "SELECT * FROM users WHERE username = ?";
$stmt_check_username = mysqli_prepare($conn, $query_check_username);
mysqli_stmt_bind_param($stmt_check_username, "s", $formUser);
mysqli_stmt_execute($stmt_check_username);
mysqli_stmt_store_result($stmt_check_username);
if(mysqli_stmt_num_rows($stmt_check_username) > 0) {
    header("Location: register.html?registration=failedUser");
    exit();
}

# Check if email already exists

$query_check_email = "SELECT * FROM users WHERE email = ?";
$stmt_check_email = mysqli_prepare($conn, $query_check_email);
mysqli_stmt_bind_param($stmt_check_email, "s", $formMail);
mysqli_stmt_execute($stmt_check_email);
mysqli_stmt_store_result($stmt_check_email);
if(mysqli_stmt_num_rows($stmt_check_email) > 0) {
    header("Location: register.php?registration=failedEmail");
    exit();
}

# Insert record

$query_insert = "INSERT INTO users (username, passw, email) VALUES (?, ?, ?)";
$stmt_insert = mysqli_prepare($conn, $query_insert);
mysqli_stmt_bind_param($stmt_insert, "sss", $formUser, $hashedPassword, $formMail);

// Step 4: Execute the Query
if(mysqli_stmt_execute($stmt_insert)) {
    header("Location: register.php?registration=true"); // Redirect with success parameter
    exit();
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close statements and connection
mysqli_stmt_close($stmt_insert);
mysqli_stmt_close($stmt_check_username);
mysqli_stmt_close($stmt_check_email);
mysqli_close($conn);
?>
