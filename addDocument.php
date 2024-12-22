<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Document - NSTU-QuickBill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #82c0ab;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: hwb(0 3% 97%);
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        .navbar-custom .nav-link:hover {
            color: #070707;
        }

        .footer {   
            background-color: #061e6d ;
            color: #d3cccc;
            padding: 25px 0;
            font-size: 14px;
        }

        .footer a {
            color: hsl(0, 28%, 92%);
        }

        .footer a:hover {
            color: hwb(0 91% 7%);
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: #dbcece;
        }

        .container {
            padding-bottom: 60px;
        }

        .btn-primary {
            background-color: #3755a5;
            border-color: #20dbc2;
            color: rgb(224, 218, 218);
        }

        .btn-primary:hover {
            background-color: #dfe9e8;
            border-color: #1ca79e;
            color: black;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="index.htm">
            <img src="../images/Logo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
            NSTU-Quickbill
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php"><i class="fas fa-envelope"></i> Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="trackbilllogin.php"><i class="fas fa-search"></i> Track Bill</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Document</h2>
                <form id="addDocumentForm" enctype="multipart/form-data" action="/submitDocument" method="post">
                    <div class="form-group">
                        <label for="billId">Bill ID</label>
                        <input type="text" class="form-control" id="billId" name="billId" required>
                    </div>
                    <div class="form-group">
                        <label for="document">Upload Document</label>
                        <input type="file" class="form-control-file" id="document" name="document" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2024 NSTU-QuickBill. All rights reserved.</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            <div class="social-icons">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-linkedin-in"></a>
                <a href="#" class="fab fa-instagram"></a>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $billId = $_POST['billId'];
    $description = $_POST['description'];

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["document"]["name"]);
    $uploadOk = 1;
    $documentFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is a valid document type
    if ($documentFileType != "pdf" && $documentFileType != "doc" && $documentFileType != "docx") {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["document"]["name"]) . " has been uploaded.";
            // Save the document information to the database here (e.g., $billId, $description, $targetFile)
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
