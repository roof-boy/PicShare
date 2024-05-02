<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if deny review button is clicked
    if (isset($_POST['deny_review'])) {
        // Get the post ID from the form data
        $postId = $_POST['post_id'];

        // Call the deletePost() function to delete the post
        deletePost($postId);
    }
}

// Function to delete post by post ID
function deletePost($postId) {
    // Database connection
    $conn = new mysqli("localhost", "root", "root", "picshare");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to retrieve the file path
    $query = "SELECT content FROM posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row['content'];

        // Debug statement
        echo "Post ID: " . $postId . "<br>";
        echo "File Path: " . $filePath . "<br>";

        // Check if file exists
        if (file_exists($filePath)) {
            echo "File exists: " . $filePath . "<br>"; // Debugging statement

            // Attempt to delete the file
            if (unlink($filePath)) {
                echo "File deleted successfully"; // Debugging statement

                // File deleted successfully, now delete the entry from the database
                $deleteQuery = "DELETE FROM posts WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                $deleteStmt->bind_param("i", $postId);
                if ($deleteStmt->execute()) {
                    // Post deleted successfully
                    header("Location: main.php?success=post_deleted");
                    exit();
                } else {
                    // Error occurred while deleting post from database
                    header("Location: main.php?error=delete_post_failed");
                    exit();
                }
            } else {
                // Error occurred while deleting file
                header("Location: main.php?error=delete_file_failed");
                exit();
            }
        } else {
            // File does not exist
            echo "File does not exist: " . $filePath . "<br>"; // Debugging statement
        }
    } else {
        // Post not found
        header("Location: main.php?error=post_not_found");
        exit();
    }

    // Close statements and connection
    $stmt->close();
    $deleteStmt->close();
    $conn->close();
}
?>
