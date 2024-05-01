<?php
session_start();
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row h-auto">
            <nav class="navbar navColor">
                <div class="container">
                    <a class="navbar-brand" href="#"><i>PicShare</i></a>
                        <a href="../resetCookie.php">
                            <button class="btn custom-button">Logout</button>
                        </a>
                </div>
            </nav>
        </div>
        <div class="row h-100">
            <div class="col-md-2 column-border">
                <!-- LEFT COLUMN -->

            </div>
            <div class="col-lg-7 column-border">
                <!-- CENTER COLUMN -->

            </div>
            <div class="col">
                <!-- RIGHT COLUMN -->
                <div class="container quickProfile shadow mt-3 mb-5 rounded">
                    <div class="row h-auto">
                        <div class="col-sm-4 image">
                            <img src="pfptemp.png" class="img-fluid img-circle float-left pfpImage" alt="">
                        </div>
                        <div class="col-lg">
                            <div class="row h-auto usernameDivider text-center">
                                <h1><?php echo($_SESSION['username']); ?></h1>
                            </div>
                            <div class="row h-auto flex-grow-1">
                                <p>Placeholder Bio</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php



?>