<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill History - NSTU-Quickbill</title>
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
            font-family: 'Arial', sans-serif;
        }

        .navbar-custom .nav-link:hover {
            color: #cccccc;
        }

        .container {
            margin-top: 50px;
        }

        .table thead th {
            background-color: #b4bebd;
            color: black;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
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

        .user-section h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .button-image {
            text-align: center;
        }

        .button-image img {
            width: 100%;
            max-width: 300px;
        }

        .classic-font {
            font-family: 'Playfair Display', serif;
        }

        .pagination {
            justify-content: center;
        }

        .bill-details {
            position: absolute;
            top: 150px;
            right: 50px;
            width: 300px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .bill-details h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .action-column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .download-all-btn {
            margin-bottom: 10px;
        }

        .modal-content {
            text-align: center;
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
                <input class="form-control mr-sm-2" type="search" placeholder="Search Bill History" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center classic-font">Bill History</h2>
        <div class="text-right mb-3">
            <button class="btn btn-primary download-all-btn" id="downloadAll"><i class="fas fa-download"></i> Download All</button>
            <button class="btn btn-success"><i class="fas fa-plus"></i><a href="createbill.htm" class style="color: #fff;">Add New Bill</a></button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Bill ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="billTableBody">
                        <tr>
                            <td>001</td>
                            <td>2024-01-01</td>
                            <td>2024-01-15</td>
                            <td>Exam Bill</td>
                            <td>$200</td>
                            <td><i class="fas fa-check-circle text-success"></i> Paid</td>
                            <td class="action-column">
                                <button class="btn btn-sm btn-info view-bill" data-bill-id="001"><i class="fas fa-eye"></i></button>
                                
                                <button class="btn btn-sm btn-danger delete-bill" data-bill-id="001"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success download-bill" data-bill-id="001"><i class="fas fa-download"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>2024-01-25</td>
                            <td></td>
                            <td>Course Expenses</td>
                            <td>$150</td>
                            <td><i class="fas fa-clock text-warning"></i> Pending</td>
                            <td class="action-column">
                                <button class="btn btn-sm btn-info view-bill" data-bill-id="002"><i class="fas fa-eye"></i></button>
                                
                                <button class="btn btn-sm btn-danger delete-bill" data-bill-id="002"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success download-bill" data-bill-id="002"><i class="fas fa-download"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>2024-02-15</td>
                            <td>2024-03-05</td>
                            <td>Research Fund</td>
                            <td>$300</td>
                            <td><i class="fas fa-check-circle text-success"></i> Paid</td>
                            <td class="action-column">
                                <button class="btn btn-sm btn-info view-bill" data-bill-id="003"><i class="fas fa-eye"></i></button>
                                
                                <button class="btn btn-sm btn-danger delete-bill" data-bill-id="003"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success download-bill" data-bill-id="003"><i class="fas fa-download"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>004</td>
                            <td>2024-03-01</td>
                            <td></td>
                            <td>Postage Charges</td>
                            <td>$50</td>
                            <td><i class="fas fa-times-circle text-danger"></i> Overdue</td>
                            <td class="action-column">
                                <button class="btn btn-sm btn-info view-bill" data-bill-id="004"><i class="fas fa-eye"></i></button>
                                
                                <button class="btn btn-sm btn-danger delete-bill" data-bill-id="004"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success download-bill" data-bill-id="004"><i class="fas fa-download"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>005</td>
                            <td>2024-05-01</td>
                            <td>2024-05-20</td>
                            <td>Insertion Of Test Result</td>
                            <td>$100</td>
                            <td><i class="fas fa-check-circle text-success"></i> Paid</td>
                            <td class="action-column">
                                <button class="btn btn-sm btn-info view-bill" data-bill-id="005"><i class="fas fa-eye"></i></button>
                                
                                <button class="btn btn-sm btn-danger delete-bill" data-bill-id="005"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success download-bill" data-bill-id="005"><i class="fas fa-download"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination"></ul>
                </nav>
            </div>
        </div>
        <div class="bill-details" id="billDetails" style="display:none;">
            <h4>Bill Details</h4>
            <p id="billDetailsContent"></p>
            <button class="btn btn-primary" onclick="$('#billDetails').hide();">Close</button>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 NSTU-Quickbill. All rights reserved.</p>
            <p><a href="#">Privacy Policy|Terms of service</a></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this bill?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var rowsPerPage = 3;
            var rows = $('#billTableBody tr');
            var rowsCount = rows.length;
            var pageCount = Math.ceil(rowsCount / rowsPerPage);
            var numbers = $('.pagination');

            for (var i = 1; i <= pageCount; i++) {
                numbers.append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
            }

            numbers.find('li:first-child').addClass('active');
            showPage(1);

            numbers.find('li').click(function () {
                numbers.find('li').removeClass('active');
                $(this).addClass('active');
                showPage(parseInt($(this).text()));
            });

            function showPage(page) {
                rows.hide();
                rows.each(function (n) {
                    if (n >= rowsPerPage * (page - 1) && n < rowsPerPage * page) {
                        $(this).show();
                    }
                });
            }

            $('.view-bill').click(function (e) {
                e.preventDefault();
                var billId = $(this).data('bill-id');
                var billDetails = {
                    '001': 'Bill ID: 001<br>Start Date: 2024-01-01<br>End Date: 2024-01-15<br>Description: Exam Bill<br>Amount: $200<br>Status: Paid',
                    '002': 'Bill ID: 002<br>Start Date: 2024-01-25<br>Description: Course Expenses<br>Amount: $150<br>Status: Pending',
                    '003': 'Bill ID: 003<br>Start Date: 2024-02-15<br>End Date: 2024-03-05<br>Description: Research Fund<br>Amount: $300<br>Status: Paid',
                    '004': 'Bill ID: 004<br>Start Date: 2024-03-01<br>Description: Postage Charges<br>Amount: $50<br>Status: Overdue',
                    '005': 'Bill ID: 005<br>Start Date: 2024-05-01<br>End Date: 2024-05-20<br>Description: Insertion Of Test Result<br>Amount: $100<br>Status: Paid'
                };
                $('#billDetailsContent').html(billDetails[billId]);
                $('#billDetails').show();
            });

            $('.delete-bill').click(function () {
                var billId = $(this).data('bill-id');
                $('#confirmDelete').data('bill-id', billId);
                $('#deleteModal').modal('show');
            });

            $('#confirmDelete').click(function () {
                var billId = $(this).data('bill-id');
                $('#billTableBody tr').each(function () {
                    if ($(this).find('td:first').text() == billId) {
                        $(this).remove();
                    }
                });
                $('#deleteModal').modal('hide');
            });

            $('#downloadAll').click(function () {
                alert('Downloading all bills...');
                // Implement the actual download functionality here
            });
        });
    </script>
</body>

</html>
