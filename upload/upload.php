<?php
include '../auth.php';
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="upload.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="navbar navbar-expand-lg nav-properties">
                <div class="container-fluid d-flex justify-content-between">
                    <div>
                        <a href="../main/main.php" class="navbar-brand ml-1 h2"><i>PicShare</i></a>
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
            <div class="col-lg-5">
                <!-- center column -->
                <div class="custom-border rounded m-2 h-scrollable">
                    <div class="row text-center h-auto">
                        <h3 class="border-below pb-1">Upload new post</h3>
                    </div>
                    <div class="row">
                        <form action="uploadHandler.php" method="post" enctype="multipart/form-data">
                            <div class="row m-2">
                                <input type="file" name="photo" accept="image/*">
                            </div>
                            <div class="row m-2">
                                <textarea name="bio" placeholder="Enter your bio"></textarea>
                            </div>
                            <div class="row m-2 text-center">
                                <input type="submit" value="Upload">
                            </div>
                        </form>
                    </div>
                </div>
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