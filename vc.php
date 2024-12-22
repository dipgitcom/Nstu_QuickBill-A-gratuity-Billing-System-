<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VC - Finalize Bills</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            color: black;
        }

        .navbar-custom {
            background-color: #82c0ab;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: black;
            font-weight: bold;
        }

        .navbar-custom .nav-link:hover {
            color: #cccccc;
        }

        .container {
            margin-top: 50px;
        }

        .sidebar {
            background-color: #9fc4b7;
            color: white;
            height: 100vh;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #15626a;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            margin-bottom: 20px;
        }

        .table thead th {
            background-color: #a0bbb7;
            color: black;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #030303;
        }

        table td {
            background-color: hsl(189, 41%, 97%);
        }

        .container {
            margin-top: 50px;
        }

        .filter-icon {
            float: right;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-finalize {
            background-color: #007bff;
            color: white;
        }

        .footer {
            background-color: #061e6d;
            color: rgb(245, 242, 242);
            padding: 15px 0;
            font-size: 14px;
        }

        .footer a {
            color: rgb(235, 224, 224);
        }

        .footer a:hover {
            color: #cccccc;
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 14px;
            color: rgb(238, 227, 227);
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
            background-color: #20dbc2;
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="container-fluid">
        <!-- Header section -->
        <!-- Sidebar and Content section -->
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <a href="#" id="pendingBillsLink" class="active" onclick="showPendingBills()">Pending Bills</a>
                <a href="#" id="approvedBillsLink" onclick="showApprovedBills()">Approved Bills</a>
                <a href="#" id="allBillsLink" onclick="showAllBills()">All Bills</a>
                <!-- Add more sidebar links as needed -->
            </nav>
            <!-- Main Content -->
            <main class="col-md-10 content">
                <h2>Vice-Chancellor (VC) - Finalize Bills</h2>
                <p class="text-muted">The Vice-Chancellor is the final authority to approve or reject the bills.</p>
                <div id="pendingBills">
                    <h3>Pending Bills</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="pendingBillsTable">
                            <!-- Pending bills rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
                <div id="approvedBills" style="display: none;">
                    <h3>Approved Bills</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="approvedBillsTable">
                            <!-- Approved bills rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 NSTU-Quickbill. All rights reserved.</p>
            <p><a href="#">Privacy Policy | Terms and Service</a></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to populate the pending bills table
        function showPendingBills() {
            document.getElementById("pendingBills").style.display = "block";
            document.getElementById("approvedBills").style.display = "none";
            document.getElementById("pendingBillsLink").classList.add("active");
            document.getElementById("approvedBillsLink").classList.remove("active");
            document.getElementById("allBillsLink").classList.remove("active");
            var pendingBills = [
                { email: "user1@example.com", name: "John Doe", date: "2023-06-30", time: "12:34 PM" },
                { email: "user2@example.com", name: "Jane Smith", date: "2023-06-29", time: "09:45 AM" },
                { email: "user3@example.com", name: "Alice Johnson", date: "2023-06-28", time: "03:21 PM" }
            ];
            var pendingBillsTable = document.getElementById("pendingBillsTable");
            pendingBillsTable.innerHTML = "";
            pendingBills.forEach(function (bill) {
                var row = document.createElement("tr");
                row.innerHTML = "<td>" + bill.email + "</td><td>" + bill.name + "</td><td>" + bill.date + "</td><td>" + bill.time + "</td><td><button class='btn btn-approve' onclick='approveBill(this)'>Approve</button> <button class='btn btn-reject' onclick='rejectBill(this)'>Reject</button> <button class='btn btn-finalize' onclick='finalizeBill(this)'>Finalize</button></td>";
                pendingBillsTable.appendChild(row);
            });
        }

        // Function to populate the approved bills table
        function showApprovedBills() {
            document.getElementById("pendingBills").style.display = "none";
            document.getElementById("approvedBills").style.display = "block";
            document.getElementById("pendingBillsLink").classList.remove("active");
            document.getElementById("approvedBillsLink").classList.add("active");
            document.getElementById("allBillsLink").classList.remove("active");
            var approvedBills = [
                { email: "user4@example.com", name: "Bob Brown", date: "2023-06-27", time: "11:15 AM" },
                { email: "user5@example.com", name: "Carol Davis", date: "2023-06-26", time: "02:30 PM" }
            ];
            var approvedBillsTable = document.getElementById("approvedBillsTable");
            approvedBillsTable.innerHTML = "";
            approvedBills.forEach(function (bill) {
                var row = document.createElement("tr");
                row.innerHTML = "<td>" + bill.email + "</td><td>" + bill.name + "</td><td>" + bill.date + "</td><td>" + bill.time + "</td>";
                approvedBillsTable.appendChild(row);
            });
        }

        // Function to populate the all bills table
        function showAllBills() {
            document.getElementById("pendingBills").style.display = "none";
            document.getElementById("approvedBills").style.display = "none";
            document.getElementById("pendingBillsLink").classList.remove("active");
            document.getElementById("approvedBillsLink").classList.remove("active");
            document.getElementById("allBillsLink").classList.add("active");
        }

        // Function to approve a bill
        function approveBill(button) {
            var row = button.parentElement.parentElement;
            var email = row.cells[0].innerText;
            var name = row.cells[1].innerText;
            var date = row.cells[2].innerText;
            var time = row.cells[3].innerText;
            row.remove();
            var approvedBillsTable = document.getElementById("approvedBillsTable");
            var newRow = document.createElement("tr");
            newRow.innerHTML = "<td>" + email + "</td><td>" + name + "</td><td>" + date + "</td><td>" + time + "</td>";
            approvedBillsTable.appendChild(newRow);
        }

        // Function to reject a bill
        function rejectBill(button) {
            var row = button.parentElement.parentElement;
            row.remove();
        }

        // Function to finalize a bill
        function finalizeBill(button) {
            var row = button.parentElement.parentElement;
            var email = row.cells[0].innerText;
            var name = row.cells[1].innerText;
            var date = row.cells[2].innerText;
            var time = row.cells[3].innerText;
            alert('The bill has been finalized by the VC.');
            row.remove();
        }

        // Initial display of pending bills
        showPendingBills();
    </script>
</body>

</html>
