<?php
session_start();
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
                <div class="custom-border rounded m-2 h-scrollable">
                    <div class="row h-auto">
                        <div class="col d-flex align-items-center">
                            <img src="pfptemp.png" class="rounded-circle pfp-size m-1" alt="Placeholder">
                            <a href="#" class="link-underline link-underline-opacity-0 link-color">testAccount</a>
                            <a href="#"
                                class="link-underline link-underline-opacity-0 link-color ms-auto me-1">Report</a>
                        </div>
                    </div>
                    <div class="row">
                        <img src="ScaredCat.jpg" class="main-image-size m-2 mx-auto d-block img-thumbnail border-black"
                            alt="">
                    </div>
                </div>
                <div class="custom-border rounded m-2 h-scrollable">
                    <div class="row h-auto">
                        <div class="col d-flex align-items-center">
                            <img src="pfptemp.png" class="rounded-circle pfp-size m-1" alt="Placeholder">
                            <a href="#" class="link-underline link-underline-opacity-0 link-color">testAccount</a>
                            <a href="#"
                                class="link-underline link-underline-opacity-0 link-color ms-auto me-1">Report</a>
                        </div>
                    </div>
                    <div class="row">
                        <img src="ScaredCat.jpg" class="main-image-size m-2 mx-auto d-block img-thumbnail border-black"
                            alt="">
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