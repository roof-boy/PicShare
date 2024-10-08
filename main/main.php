<?php
include '../auth.php';

// Database connection
$conn = new mysqli("localhost", "root", "root", "picshare");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement to retrieve username, bio, and upload date
$query = "SELECT users.username, posts.bio, posts.uploadDate, posts.content, posts.id  FROM users INNER JOIN posts ON users.id = posts.ownerID WHERE posts.forReview = false ORDER BY uploadDate DESC LIMIT 5";
$stmt = $conn->prepare($query);

// Variable to store populated templates
$populatedTemplates = "";

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Page template with placeholders
$template = '<div class="custom-border rounded m-2 h-scrollable">
    <div class="row h-auto">
        <div class="col d-flex align-items-center">
            <img src="pfptemp.png" class="rounded-circle pfp-size m-1" alt="Placeholder">
            <a href="#" class="link-underline link-underline-opacity-0 link-color">%USERNAME%</a>
            <p href="#" name="date" class="link-underline link-underline-opacity-0 link-color mt-3 ms-auto me-1">%UPLOAD_DATE% / %POST_ID%</p>
        </div>
    </div>
    <div class="row">
        <img src="%PHOTO_PATH%" class="main-image-size overflow-hidden m-2 mx-auto d-block img-thumbnail border-black" alt="">
    </div>
    <div class="row border-top m-1">
        <p name="bio" class="opacity-50 fst-italic">%BIO%</p>
    </div>
    <form action="reportPost.php" id="reportForm" method="post">
        <div class="col w-auto d-flex align-items-center m-1">
            <input type="hidden" name="post_id" value="%POST_ID%">
            <button id="reportBtn" class="btn btn-link opacity-50 link-underline link-underline-opacity-0 link-color fst-italic ms-auto me-1">Report</button>
        </div>
    </form>
</div>';

$noPostsHtml = '<h3 class="text-center">We couldnt find any posts!</h3>';

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Populate the template with details of the photos
    while ($row = $result->fetch_assoc()) {
        $photoPath = $row['content'];
        $username = $row['username'];
        $bio = $row['bio'];
        $uploadDate = $row['uploadDate'];
        $postId = $row['id'];

        // Replace placeholders in the template with photo details
        $populatedTemplate = str_replace(
            ["%PHOTO_PATH%", "%USERNAME%", "%BIO%", "%UPLOAD_DATE%", "%POST_ID%"],
            [$photoPath, $username, $bio, $uploadDate, $postId],
            $template
        );

        // Append the populated template to the variable
        $populatedTemplates .= $populatedTemplate;
    }
} else {
    $populatedTemplates .= $noPostsHtml;
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
                        <?php
                        // Check if isAdmin is set and true
                        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
                            // Display the button for admins
                            echo '<button class="btn"><a class="nav-link" href="../modPanel/mainmod.php">Moderation Panel</a></li>';
                        }
                        ?>
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

        document.getElementById("reportBtn").onclick = function() {
            document.getElementById("reportForm").submit();
        }
    });
    </script>
</body>

</html>