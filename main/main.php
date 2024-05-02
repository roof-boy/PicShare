<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "root", "picshare");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read uploaded photos from the directory
$uploadDirectory = "../postPhotos/";
$photos = glob($uploadDirectory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

// Sort the photos by modification time (newest first)
usort($photos, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

// Select the five newest photos
$newestPhotos = array_slice($photos, 0, 5);

// Page template with placeholders
$template = '<div class="custom-border rounded m-2 h-scrollable">
                <div class="row h-auto">
                    <div class="col d-flex align-items-center">
                        <img src="pfptemp.png" class="rounded-circle pfp-size m-1" alt="Placeholder">
                        <a href="#" class="link-underline link-underline-opacity-0 link-color">%USERNAME%</a>
                        <a href="#" class="link-underline link-underline-opacity-0 link-color ms-auto me-1">Report</a>
                    </div>
                </div>
                <div class="row">
                    <img src="%PHOTO_PATH%" class="main-image-size overflow-hidden m-2 mx-auto d-block img-thumbnail border-black" alt="">
                </div>
            </div>';

// Variable to store populated templates
$populatedTemplates = "";

// Prepare statement to retrieve username
$query = "SELECT username FROM users INNER JOIN posts ON users.id = posts.ownerID WHERE posts.content = ?";
$stmt = $conn->prepare($query);

// Populate the template with details of the five newest photos
foreach ($newestPhotos as $photo) {
    // Retrieve photo details (e.g., file path)
    $photoPath = $photo;
    
    // Retrieve additional details from the photo (e.g., user account, bio, etc.)
    // You may need to implement a method to extract this information from the photo file or database

    // Execute statement to retrieve username
    $stmt->bind_param("s", $photoPath);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
    } else {
        $username = "Unknown";
    }

    // Replace placeholders in the template with photo details
    $populatedTemplate = str_replace(
        ["%PHOTO_PATH%", "%USERNAME%"],
        [$photoPath, $username],
        $template
    );

    // Append the populated template to the variable
    $populatedTemplates .= $populatedTemplate;
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="navbar navbar-expand-lg nav-properties">
                <div class="container-fluid d-flex justify-content-between">
                    <div>
                        <a href="#" class="navbar-brand ml-1 h2"><i>PicShare</i></a>
                        <button class="btn" id="newpost">New Post</button>
                    </div>
                    <button class="btn" id="logout">Logout</button>
                </div>
            </div>
        </div>
        <div class="row flex-grow-1">
            <div class="col">
                <!-- left column -->
            </div>
            <div class="col-lg-5 custom-column overflow-auto">
                <!-- center column -->
                <?php echo $populatedTemplates; ?>
            </div>
            <div class="col">
                <!-- right column -->
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    // Get references to the buttons
    var newpost = document.getElementById('newpost');
    var logout = document.getElementById('logout');

    // Add event listeners to the buttons
    newpost.addEventListener('click', function() {
        window.location.href = '../upload/upload.php'
    });

    logout.addEventListener('click', function() {
        window.location.href = '../resetCookie.php'
    });
    </script>
</body>

</html>