<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Bill - NSTU-Quickbill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            color: black;
        }

        .navbar-custom {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
            font-weight: bold;
        }

        .navbar-custom .nav-link:hover {
           
            color: #f8d210;
        }
        .footer {
            background: #333;
            color: white;
            padding: 20px 0;
            font-size: 14px;
            text-align: center;
        }

        .footer a {
            color: #f8d210;
            position: relative;
        }

        .footer a:hover {
            color: #ff9f1c;
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: white;
            font-size: 18px;
        }

        .footer .social-icons a:hover {
            color: #f8d210;
        }
    
        

        .container {
            padding-bottom: 60px;
        }

        .classic-font {
            font-family: 'Playfair Display', serif;
        }

        .track-bill-form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .track-bill-form h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .bill-details {
            margin-top: 20px;
        }

        .bill-details h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .track-bill-button {
            background-color: #a8bebb;
            color: #151817;
            border: none;
        }

        .track-bill-button:hover {
            background-color: #1ca79e;
            color: #151817;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i> Notifications <span class="badge badge-danger" id="notification-count">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="notification-list">
                        <a class="dropdown-item" href="#" data-notification-id="1">Director Submitted the bills</a>
                        <a class="dropdown-item" href="#" data-notification-id="2">Exam Control Office forward the bill</a>
                        <a class="dropdown-item" href="#" data-notification-id="3">Treasurer submitted the bill.</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="track-bill-form">
            <h2 class="classic-font text-center">Track Your Bill</h2>
            <form id="trackBillForm">
                <div class="form-group">
                    <label for="billId">Enter Bill ID:</label>
                    <input type="text" class="form-control" id="billId" required>
                </div>
            
                <button type="submit" class="btn btn-success btn-block"><a href="trackbill.php" class style="color: #151817;">Track Bill</a></button>
            </form>
            <div class="bill-details" id="billDetails" style="display:none;">
                <h4>Bill Details</h4>
                <p id="billDetailsContent"></p>
            </div>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 NSTU-Quickbill. All rights reserved.</p>
            <p><a href="#">Privacy Policy | Terms and Service</a></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var billDetails = {
                '001': 'Bill ID: 001<br>Start Date: 2024-01-01<br>End Date: 2024-01-15<br>Description: Exam Bill<br>Amount: $200<br>Status: Paid',
                '002': 'Bill ID: 002<br>Start Date: 2024-01-25<br>Description: Course Expenses<br>Amount: $150<br>Status: Pending',
                '003': 'Bill ID: 003<br>Start Date: 2024-02-15<br>End Date: 2024-03-05<br>Description: Research Fund<br>Amount: $300<br>Status: Paid',
                '004': 'Bill ID: 004<br>Start Date: 2024-03-01<br>Description: Postage Charges<br>Amount: $50<br>Status: Overdue',
                '005': 'Bill ID: 005<br>Start Date: 2024-05-01<br>End Date: 2024-05-20<br>Description: Insertion Of Test Result<br>Amount: $100<br>Status: Paid'
            };

            $('#trackBillForm').submit(function (e) {
                e.preventDefault();
                var billId = $('#billId').val();
                if (billDetails[billId]) {
                    $('#billDetailsContent').html(billDetails[billId]);
                    $('#billDetails').show();
                } else {
                    $('#billDetailsContent').html('No details found for Bill ID: ' + billId);
                    $('#billDetails').show();
                }
            });
        });
    </script>
</body>

</html>
