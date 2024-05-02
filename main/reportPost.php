<?php
// Establish connection to the server
include '../config.php';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if post_id is set in the POST data
if(isset($_POST['post_id'])) {
    // Get postID from POST form in mainmod.php
    $postID = $_POST['post_id'];

    // Prepare the query to update the post's forReview status
    $updateQuery = "UPDATE posts SET forReview = 1 WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    
    // Check if the prepare statement succeeded
    if ($updateStmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind parameters and execute the update query
    $updateStmt->bind_param("i", $postID);
    if ($updateStmt->execute()) {
        header("Location: main.php?success=post_updated");
        exit();
    } else {
        header("Location: main.php?error=update_post_failed");
        exit();
    }

    // Close the statement
    $updateStmt->close();
} else {
    // If post_id is not set, redirect with error message
    header("Location: main.php?error=post_id_not_set");
    exit();
}

// Close the connection
$conn->close();
?>
