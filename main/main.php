<?php
include '../auth.php';
?>

<html>
    <head>
        <title>PicShare: Main Page</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div class="container-fluid custom-height text-center">
            <div class="row">
                <div class="col-md order-1 color">
                    <p>test</p>
                </div>
                <div class="vr d-none d-md-block col-md-auto order-2"></div> <!-- Vertical rule visible only on medium and larger screens -->
                <div class="vr d-block d-md-none col-1 order-2"></div> <!-- Vertical rule visible only on extra small and small screens -->
                <div class="col-lg-7 color order-3 custom-height">
                    <p>test</p>
                </div>
                <div class="vr d-none d-md-block col-md-auto order-4"></div> <!-- Vertical rule visible only on medium and larger screens -->
                <div class="vr d-block d-md-none col-1 order-4"></div> <!-- Vertical rule visible only on extra small and small screens -->
                <div class="col-md order-5 color">
                    <p>test</p>
                </div>
            </div>
        </div>
    </body>
</html>
