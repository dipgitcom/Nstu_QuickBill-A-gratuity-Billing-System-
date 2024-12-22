<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #82c0ab;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: hwb(0 4% 96%);
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        .navbar-custom .nav-link:hover {
            color: #cccccc;
        }
        h1 {
            margin-top: 20px;
            color: #007bff;
        }

        h2 {
            color: #007bff;
            margin-top: 20px;
        }

        .table {
            margin-bottom: 20px;
        }

        .btn {
            margin-right: 10px;
        }

        .footer {
            background-color: #061e6d;
            color: white;
            padding: 10px 0;
            font-size: 14px;
            text-align: center;
            position: relative;
        }

        .footer a {
            color: white;
        }

        .footer a:hover {
            color: #cccccc;
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: white;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="../images/Logo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
            NSTU-Quickbill
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="contactus.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
               
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Saved Data Details</h1>
        <div id="details-container"></div>
        <div class="d-flex justify-content-between no-print">
            <button class="btn btn-danger mt-3" onclick="clearHistory()">Clear History</button>
            <button class="btn btn-primary mt-3" onclick="goBack()">Back to Office</button>
            <button class="btn btn-secondary mt-3" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>

    <!-- Footer -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const savedData = JSON.parse(localStorage.getItem('savedData')) || [];

            if (savedData.length === 0) {
                document.getElementById('details-container').innerHTML = '<p class="text-muted">No data available.</p>';
                return;
            }

            const groupedData = savedData.reduce((acc, item) => {
                const key = `${item.batch} - ${item.term}`;
                if (!acc[key]) acc[key] = [];
                acc[key].push(item);
                return acc;
            }, {});

            const detailsContainer = document.getElementById('details-container');
            detailsContainer.innerHTML = '';

            for (const [key, group] of Object.entries(groupedData)) {
                const table = `
                    <h2>${key}</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Course Code</th>
                                <th>Course Teacher</th>
                                <th>Share Course Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${group.map(data => `
                                <tr>
                                    <td>${data.courseCode}</td>
                                    <td>${data.courseTeacher}</td>
                                    <td>${data.shareCourseTeacher}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;
                detailsContainer.innerHTML += table;
            }
        });

        function goBack() {
            window.location.href = 'office.php';
        }

        function clearHistory() {
            if (confirm('Are you sure you want to clear all saved data?')) {
                localStorage.removeItem('savedData');
                document.getElementById('details-container').innerHTML = '<p class="text-muted">No data available.</p>';
            }
        }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>

</html>
