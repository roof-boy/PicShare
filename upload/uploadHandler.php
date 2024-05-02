<?php
include '../config.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        // Directory where uploaded files will be saved
        $uploadDirectory = "../postPhotos/";

        // Create the directory if it doesn't exist
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Generate a unique filename to prevent overwriting existing files
        $uniqueFilename = uniqid() . '_' . $_FILES["photo"]["name"];
        $targetFilePath = $uploadDirectory . $uniqueFilename;

        // Check if file was uploaded via HTTP POST
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            // Database connection
            $conn = new mysqli("localhost", "root", "root", "picshare");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO posts (content, uploadDate, bio, ownerID) VALUES (?, NOW(), ?, ?)");
            $stmt->bind_param("sss", $content, $bio, $ownerID);

            // Get other form data
            $bio = $_POST["bio"];
            $ownerID = $_SESSION["userId"]; // Assuming you have a session variable for userID

            // Set the content field to the file path
            $content = $targetFilePath;

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../main/main.php");
            } else {
                echo "Error uploading photo: " . $conn->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        // Output file upload error
        echo "Error uploading file: " . $_FILES["photo"]["error"];
    }
}
?>
