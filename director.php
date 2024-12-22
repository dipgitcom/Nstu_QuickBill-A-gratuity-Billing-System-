<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Exam Committee Chairman</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .user-info-box {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            padding: 10px;
            margin-top: 10px;
            margin-left: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user-info-box img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            margin-bottom: 20px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-danger {
            padding: 5px 10px;
            font-size: 14px;
        }

        .btn-primary {
            width: 100%;
            font-size: 16px;
        }
        .footer {
            background-color: #061e6d;
            color: white;
            padding: 10px 0;
            font-size: 14px;
            text-align: center;
            position: relative;
            width: 100%;
            bottom: 0;
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="../images/Logo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
            Nstu-Quickbill
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
        </div>
    </nav>

    <div class="user-info-box">
        <img src="../images/Director.jpg" alt="User Image">
        <div class="user-info">
            <h5>Md.Nizam Uddin</h5>
            <p>Designation: Director</p>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="form-container">
                    <h3>Create Exam Committee</h3>
                    <form id="committeeForm">
                        <!-- Batch -->
                        <div class="form-group">
                            <label for="batch">Batch</label>
                            <input type="text" class="form-control" id="batch" placeholder="Enter Batch" required>
                        </div>
                        <!-- Term -->
                        <div class="form-group">
                            <label for="term">Term</label>
                            <select class="form-control" id="term" required>
                                <option value="1-1">1-1</option>
                                <option value="1-2">1-2</option>
                                <option value="2-1">2-1</option>
                                <option value="2-2">2-2</option>
                                <option value="3-1">3-1</option>
                                <option value="3-2">3-2</option>
                                <option value="4-1">4-1</option>
                                <option value="4-2">4-2</option>
                            </select>
                        </div>
                        
                        <!-- Session -->
                        <div class="form-group">
                            <label for="session">Session</label>
                            <input type="text" class="form-control" id="session" placeholder="Enter session" required>
                        </div>
                        
                        <!-- Chairman Selection -->
                        <div class="form-group">
                            <label for="chairman">Chairman Selection</label>
                            <select class="form-control" id="chairman" required>
                            <option selected disabled>Select Teacher</option>
                                <option value="Dipok Chandra Das">Dipok Chandra Das</option>
                                <option value="Md Ifthekar Alam Efat">Md Ifthekar Alam Efat</option>
                                <option value="Hasan Imam">Md Hasan Imam</option>
                                <option value="Rafid Mustafiz">Rafid Mustafiz</option>
                                <option value="Tasnim Rahman">Tasnim Rahman</option>
                                <option value="Tasnia Ahmed Neela">Tasnia Ahmed Neela</option>
                                <option value="Nazmun Nahar">Nazmun Nahar</option>
                                <option value="Eusha Kadir">Md Eusha Kadir</option>
                                <option value="Md Auhidur Rahman">Md Auhidur Rahman</option>
                                <option value="Falguni Roy">Falguni Roy</option>
                                <option value="Shudeb Babu Sen Amit">Shudeb Babu Sen Amit</option>
                                <option value="Nuruzzaman Bhuiyan">Md Nuruzzaman Bhuiyan</option>
                            </select>
                        </div>

                        
                        <!-- Member 1 Selection -->
                        <div class="form-group">
                            <label for="member">Member-1</label>
                            <select class="form-control" id="member-1" required>
                                <option value="Dipok Chandra Das">Dipok Chandra Das</option>
                                <option value="Md Ifthekar Alam Efat">Md Ifthekar Alam Efat</option>
                                <option value="Hasan Imam">Md Hasan Imam</option>
                                <option value="Rafid Mustafiz">Rafid Mustafiz</option>
                                <option value="Tasnim Rahman">Tasnim Rahman</option>
                                <option value="Tasnia Ahmed Neela">Tasnia Ahmed Neela</option>
                                <option value="Nazmun Nahar">Nazmun Nahar</option>
                                <option value="Eusha Kadir">Md Eusha Kadir</option>
                                <option value="Md Auhidur Rahman">Md Auhidur Rahman</option>
                                <option value="Falguni Roy">Falguni Roy</option>
                                <option value="Shudeb Babu Sen Amit">Shudeb Babu Sen Amit</option>
                                <option value="Nuruzzaman Bhuiyan">Md Nuruzzaman Bhuiyan</option>
                            </select>
                        </div>

                        
                        <!-- Member 2 Selection -->
                        <div class="form-group">
                            <label for="member">Member-2</label>
                            <select class="form-control" id="member-2" required>
                                <option value="Dipok Chandra Das">Dipok Chandra Das</option>
                                <option value="Md Ifthekar Alam Efat">Md Ifthekar Alam Efat</option>
                                <option value="Hasan Imam">Md Hasan Imam</option>
                                <option value="Rafid Mustafiz">Rafid Mustafiz</option>
                                <option value="Tasnim Rahman">Tasnim Rahman</option>
                                <option value="Tasnia Ahmed Neela">Tasnia Ahmed Neela</option>
                                <option value="Nazmun Nahar">Nazmun Nahar</option>
                                <option value="Eusha Kadir">Md Eusha Kadir</option>
                                <option value="Md Auhidur Rahman">Md Auhidur Rahman</option>
                                <option value="Falguni Roy">Falguni Roy</option>
                                <option value="Shudeb Babu Sen Amit">Shudeb Babu Sen Amit</option>
                                <option value="Nuruzzaman Bhuiyan">Md Nuruzzaman Bhuiyan</option>
                            </select>
                        </div>

                        
                        <!-- Member 3 Selection -->
                        <div class="form-group">
                            <label for="member">Member-3</label>
                            <select class="form-control" id="member-3" required>
                                <option value="Dipok Chandra Das">Dipok Chandra Das</option>
                                <option value="Md Ifthekar Alam Efat">Md Ifthekar Alam Efat</option>
                                <option value="Hasan Imam">Md Hasan Imam</option>
                                <option value="Rafid Mustafiz">Rafid Mustafiz</option>
                                <option value="Tasnim Rahman">Tasnim Rahman</option>
                                <option value="Tasnia Ahmed Neela">Tasnia Ahmed Neela</option>
                                <option value="Nazmun Nahar">Nazmun Nahar</option>
                                <option value="Eusha Kadir">Md Eusha Kadir</option>
                                <option value="Md Auhidur Rahman">Md Auhidur Rahman</option>
                                <option value="Falguni Roy">Falguni Roy</option>
                                <option value="Shudeb Babu Sen Amit">Shudeb Babu Sen Amit</option>
                                <option value="Nuruzzaman Bhuiyan">Md Nuruzzaman Bhuiyan</option>
                            </select>
                        </div>

                        <!-- Externam Member Selection -->
                        <div class="form-group">
                            <label for="member">External Member</label>
                            <select class="form-control" id="externalmember" required>
                                <option value="Dipok Chandra Das">Dipok Chandra Das</option>
                                <option value="Md Ifthekar Alam Efat">Md Ifthekar Alam Efat</option>
                                <option value="Hasan Imam">Md Hasan Imam</option>
                                <option value="Rafid Mustafiz">Rafid Mustafiz</option>
                                <option value="Tasnim Rahman">Tasnim Rahman</option>
                                <option value="Tasnia Ahmed Neela">Tasnia Ahmed Neela</option>
                                <option value="Nazmun Nahar">Nazmun Nahar</option>
                                <option value="Eusha Kadir">Md Eusha Kadir</option>
                                <option value="Md Auhidur Rahman">Md Auhidur Rahman</option>
                                <option value="Falguni Roy">Falguni Roy</option>
                                <option value="Shudeb Babu Sen Amit">Shudeb Babu Sen Amit</option>
                                <option value="Nuruzzaman Bhuiyan">Md Nuruzzaman Bhuiyan</option>
                            </select>
                        </div>
                        
                        <!-- Done Button -->
                        <button type="button" class="btn btn-primary" id="doneButton">Save</button>
                    </form>

                    <!-- Table to display entered data -->
                    <h4 class="mt-5">Committee List</h4>
                    <table class="table table-bordered" id="chairmanTable">
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Term</th>
                                <th>Session</th>
                                <th>Chairman</th>
                                <th>Member-1</th>
                                <th>Member-2</th>
                                <th>Member-3</th>
                                <th>External Member</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic rows will be added here -->
                        </tbody>
                    </table>
                </div>
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

    <script>
        // Load data from localStorage
        document.addEventListener('DOMContentLoaded', loadTableData);

        document.getElementById('doneButton').addEventListener('click', function () {
            const batch = document.getElementById('batch').value;
            const term = document.getElementById('term').value;
            const session = document.getElementById('session').value;
            const chairman = document.getElementById('chairman').value;
            const member1 = document.getElementById('member-1').value;
            const member2 = document.getElementById('member-2').value;
            const member3 = document.getElementById('member-3').value;
            const externalmember = document.getElementById('externalmember').value;

            if (!batch || !term || !session || !chairman || !member1 || !member2 || !member3 || !externalmember) {
                alert('Please fill in all fields');
                return;
            }

            const tableData = JSON.parse(localStorage.getItem('tableData')) || [];
            const row = { batch, term, session, chairman, member1, member2, member3, externalmember };
            tableData.push(row);
            localStorage.setItem('tableData', JSON.stringify(tableData));

            addRowToTable(row);
            document.getElementById('committeeForm').reset();
        });

        function loadTableData() {
            const tableData = JSON.parse(localStorage.getItem('tableData')) || [];
            tableData.forEach(row => addRowToTable(row));
        }

        function addRowToTable({ batch, term, session, chairman, member1, member2, member3, externalmember }) {
            const table = document.getElementById('chairmanTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${batch}</td>
                <td>${term}</td>
                <td>${session}</td>
                <td>${chairman}</td>
                <td>${member1}</td>
                <td>${member2}</td>
                <td>${member3}</td>
                <td>${externalmember}</td>
                <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button></td>
            `;
        }

        function deleteRow(button) {
            const row = button.closest('tr');
            const index = row.rowIndex - 1;
            row.remove();

            const tableData = JSON.parse(localStorage.getItem('tableData'));
            tableData.splice(index, 1);
            localStorage.setItem('tableData', JSON.stringify(tableData));
        }
    </script>
</body>

</html>
