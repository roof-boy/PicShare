<?php
// Establish connection to the server

include '../config.php';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get postID from POST form in mainmod.php and prepare the query

$postID = $_POST['post_id'];

$query = "SELECT content FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $postID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['content'];

    if (file_exists($filePath)) {
        if(unlink($filePath)) {
            $deleteQuery = "DELETE FROM posts WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $postID);
            if ($deleteStmt->execute()) {
                header("Location: mainmod.php?success=post_deleted");
                exit();
            } else {
                header("Location: main.php?error=delete_post_failed");
                exit();
            }
        } else {
            header("Location: main.php?error=delete_file_failed");
            exit();
        }
    }
}

$stmt->close();
$deleteStmt->close();
$conn->close();

?>
