<?php
// Establish connection to the server

include '../config.php';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get postID from POST form in mainmod.php and prepare the query

$postID = $_POST['post_id'];

$query = "SELECT forReview FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $postID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['content'];

    $updateQuery = "UPDATE posts SET forReview = 0 WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $postID);
    if ($updateStmt->execute()) {
        header("Location: mainmod.php?success=post_updated");
        exit();
    } else {
        header("Location: main.php?error=update_post_failed");
        exit();
    }
} else {
    header("Location: main.php?error=post_not_found");
    exit();
}

$stmt->close();
$updateStmt->close();
$conn->close();
