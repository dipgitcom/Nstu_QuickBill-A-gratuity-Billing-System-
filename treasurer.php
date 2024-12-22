<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasurer</title>
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
            background-color:#82c0ab;
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
            background-color:#a0bbb7;
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

        .footer {
            background-color: #061e6d;
            color: rgb(247, 243, 243);
            padding: 15px 0;
            font-size: 14px;
        }

        .footer a {
            color: rgb(224, 217, 217);
        }

        .footer a:hover {
            color: #cccccc;
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 14px;
            color: rgb(236, 223, 223);
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
                <h2>Treasurer</h2>
                <div id="pendingBills">
                    <b>Pending Bills</b>
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
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeData();
            loadTables();
            attachButtonListeners();
        });

        function initializeData() {
            if (!localStorage.getItem('initialized')) {
                const pendingBills = [
                    { email: 'rajib@example.com', name: 'John Doe', date: '2024-06-29', time: '10:30 AM' },
                    { email: 'munna@example.com', name: 'Jane Doe', date: '2024-06-28', time: '11:00 AM' },
                    { email: 'rehnuma@example.com', name: 'Bob Smith', date: '2024-06-27', time: '2:00 PM' },
                    { email: 'rakib@example.com', name: 'Alice Johnson', date: '2024-06-26', time: '9:00 AM' },
                    { email: 'dip@gmail.com', name: 'John Doe', date: '2024-06-29', time: '10:30 AM' },
                    { email: 'mun@example.com', name: 'Jane Doe', date: '2024-06-28', time: '11:00 AM' },
                    { email: 'jason@example.com', name: 'Jason Smith', date: '2024-06-25', time: '4:30 PM' }
                ];
                const approvedBills = [
                    { email: 'rajib@example.com', name: 'Alice Johnson', date: '2024-06-26', time: '9:00 AM' },
                    { email: 'dip@gmail.com', name: 'John Doe', date: '2024-06-29', time: '10:30 AM' },
                    { email: 'mun@example.com', name: 'Jane Doe', date: '2024-06-28', time: '11:00 AM' },
                    { email: 'james@example.com', name: 'James Brown', date: '2024-06-25', time: '2:30 PM' },
                    { email: 'rachel@example.com', name: 'Rachel Green', date: '2024-06-24', time: '3:45 PM' }
                ];
                localStorage.setItem('pendingBills', JSON.stringify(pendingBills));
                localStorage.setItem('approvedBills', JSON.stringify(approvedBills));
                localStorage.setItem('initialized', true);
            }
        }

        function loadTables() {
            loadPendingBills();
            loadApprovedBills();
        }

        function loadPendingBills() {
            const pendingBills = JSON.parse(localStorage.getItem('pendingBills')) || [];
            const pendingBillsTable = document.getElementById('pendingBillsTable');
            pendingBillsTable.innerHTML = '';
            pendingBills.forEach((bill, index) => {
                const row = pendingBillsTable.insertRow();
                row.innerHTML = `
                    <td>${bill.email}</td>
                    <td>${bill.name}</td>
                    <td>${bill.date}</td>
                    <td>${bill.time}</td>
                    <td>
                        <button class="btn btn-success btn-approve" onclick="approveBill(${index})">Approve</button>
                        <button class="btn btn-danger btn-reject" onclick="rejectBill(${index})">Reject</button>
                        <button class="btn btn-info btn-forward" onclick="forwardBill(this.parentElement.parentElement)">Forward</button>
                    </td>
                `;
            });
        }

        function loadApprovedBills() {
            const approvedBills = JSON.parse(localStorage.getItem('approvedBills')) || [];
            const approvedBillsTable = document.getElementById('approvedBillsTable');
            approvedBillsTable.innerHTML = '';
            approvedBills.forEach((bill) => {
                const row = approvedBillsTable.insertRow();
                row.innerHTML = `
                    <td>${bill.email}</td>
                    <td>${bill.name}</td>
                    <td>${bill.date}</td>
                    <td>${bill.time}</td>
                `;
            });
        }

        function approveBill(index) {
            const pendingBills = JSON.parse(localStorage.getItem('pendingBills')) || [];
            const approvedBills = JSON.parse(localStorage.getItem('approvedBills')) || [];
            const [approvedBill] = pendingBills.splice(index, 1);
            approvedBills.push(approvedBill);
            localStorage.setItem('pendingBills', JSON.stringify(pendingBills));
            localStorage.setItem('approvedBills', JSON.stringify(approvedBills));
            loadTables();
        }

        function rejectBill(index) {
            const pendingBills = JSON.parse(localStorage.getItem('pendingBills')) || [];
            pendingBills.splice(index, 1);
            localStorage.setItem('pendingBills', JSON.stringify(pendingBills));
            loadTables();
        }

        function showPendingBills() {
            document.getElementById('pendingBills').style.display = 'block';
            document.getElementById('approvedBills').style.display = 'none';
            toggleActiveClass('pendingBillsLink');
        }

        function showApprovedBills() {
            document.getElementById('pendingBills').style.display = 'none';
            document.getElementById('approvedBills').style.display = 'block';
            toggleActiveClass('approvedBillsLink');
        }

        function showAllBills() {
            document.getElementById('pendingBills').style.display = 'block';
            document.getElementById('approvedBills').style.display = 'block';
            toggleActiveClass('allBillsLink');
        }

        function toggleActiveClass(activeLinkId) {
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(link => {
                link.classList.remove('active');
            });
            document.getElementById(activeLinkId).classList.add('active');
        }

        function attachButtonListeners() {
            const approveButtons = document.querySelectorAll('.btn-approve');
            const rejectButtons = document.querySelectorAll('.btn-reject');
            approveButtons.forEach((button, index) => {
                button.addEventListener('click', () => approveBill(index));
            });
            rejectButtons.forEach((button, index) => {
                button.addEventListener('click', () => rejectBill(index));
            });
        }

        function forwardBill(row) {
            console.log(`Forwarded bill for ${row.cells[1].innerText} to next sector.`);
        }

        function saveTables() {
            // Save both pending and approved bills to localStorage or backend storage
            // Example implementation provided earlier
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
