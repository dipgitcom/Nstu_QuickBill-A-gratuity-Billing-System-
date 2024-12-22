<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Navbar Customization */
        .navbar-custom {
            background-color: #82c0ab;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        .navbar-custom .nav-link:hover {
            color: #dfe4ea;
        }

        /* User Info Box */
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
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Header and Table Section */
        h1 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .header-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .header-section select {
            width: 150px;
        }

        .header-section button {
            font-weight: bold;
        }

        table {
            margin-top: 10px;
        }

        th {
            background-color: #f8f9fa;
        }

        h2 {
            margin-top: 20px;
            color: #343a40;
        }

        .btn {
            margin-top: 20px;
        }

        .alert {
            display: none;
        }

        /* Footer Section */
        .footer {
            background-color: #061e6d;
            color: white;
            padding: 50px 0;
            font-size: 14px;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
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
    <!-- Navbar Section -->
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
                <li class="nav-item"><a class="nav-link" href="trackbilllogin.php"><i class="fas fa-search"></i> Track Bill</a></li>
            </ul>
        </div>
    </nav>

    <!-- User Info Box -->
    <div class="user-info-box">
        <img src="../images/Examchair.jpg" alt="User Image">
        <div class="user-info">
            <h5>Md.Iftekharul Alam Efat</h5>
            <p>Designation: Assistant Professor</p>
            <p>Exam Committee Chairman</p>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center">Exam Panel</h1>

        <!-- Header Section -->
        <div class="header-section">
            <div class="dropdown-group">
                <label for="batch-select">Batch:</label>
                <select id="batch-select" class="form-control">
                    <option value="" disabled selected>Select</option>

                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                    <option value="5th">5th</option>
                    <option value="6th">6th</option>
                    <option value="7th">7th</option>
                </select>
            </div>

            <div class="dropdown-group">
                <label for="term-select">Term:</label>
                <select id="term-select" class="form-control">
                    <option value="" disabled selected>Select</option>
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

            <button id="goBtn" class="btn btn-primary" onclick="fetchData()">Go</button>

        </div>

        <!-- Tables for Panels -->
        <!-- Theory Panel Table -->
<h2>Theory Panel</h2>
<table class="table table-bordered table-striped exam-panel" id="theory">
    <thead>
        <tr>
            <th>Course Code</th>
            <th>Course Teacher (First Examiner)</th>
            <th>Second Examiner</th>
            <th>Third Examiner</th>
            <th>External Examiner</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Lab Panel Table -->
<h2>Lab Panel</h2>
<table class="table table-bordered table-striped exam-panel" id="lab">
    <thead>
        <tr>
            <th>Course Code</th>
            <th>Course Teacher (First Examiner)</th>
            <th>Second Examiner</th>
            <th>Third Examiner</th>
            <th>External Examiner</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

        <button id="saveBtn" class="btn btn-success btn-block">Save</button>

        <div class="alert alert-success" id="saveAlert" role="alert">
            Data saved successfully!
        </div>
    </div>

    <!-- Footer Section -->
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
    <!-- JavaScript Section -->
    <script>
        const courseCodeData = {
            "1-1": {
                "theory": ["CSE 1101", "CSE 1103", "STAT 1105", "MATH 1107", "GE 1109", "GE 1111", "SE 1113"],
                "lab": ["CSE 1102", "GE 1112"]
            },
            "1-2": {
                "theory": ["CSE 1201", "CSE 1203", "STAT 1205", "MATH 1207", "GE1211", "SE1213"],
                "lab": ["CSE 1202", "CSE 1204", "SE 1214"]
            },
            "2-1": {
                "theory": ["CSE 2101", "SE 2103", "CSE 2105", "MATH 2107", "SE2109"],
                "lab": ["CSE 2102", "SE 2104", "CSE 2106", "MATH 2108", "SE2110", "SE 2112"]
            },
            "2-2": {
                "theory": ["CSE 2201", "GE 2203", "CSE 2205", "CSE 2207", "SE 2209", "BUS 2211"],
                "lab": ["CSE 2202", "CSE 2206", "CSE 2208", "SE 2210"]
            },
            "3-1": {
                "theory": ["SE 3101", "CSE 3103", "CSE 3105", "BUS 3107", "SE 3109"],
                "lab": ["CSE 3104", "CSE 3106", "SE 3110", "SE 3112"]
            },
            "3-2": {
                "theory": ["CSE 3201", "CSE 3203", "SE 3205", "CSE 3207", "SE 3209", "SE 3211"],
                "lab": ["CSE 3202", "SE 3204", "SE 3206", "CSE 3208", "SE 3210", "SE 3212"]
            },
            "4-1": {
                "lab": ["SE 4100"]
            },
            "4-2": {
                "theory": ["SE 4202", "SE 4203", "SE 4205"],
                "lab": ["SE 4204", "SE 4206"]
            }
        };


        const examiners = ['Dipok Chandra Das', 'Md.Hasan Imam', 'Rafid Mustafiz', 'Md. Auhidur Rahman', 'Nazmun Nahar', 'Tasnia Ahmed Neela', 'Eusha Kadir', 'Md.Efthekar Alam Efat', 'Dipannita Das', 'Shudeb Babu Sen', 'Md.Nuruzzaman Bhuiyan', 'Falguni Roy', 'Tasnim Rahman'];

        let currentCourseList;

        document.getElementById("term-select").addEventListener("change", function(event) {
            currentCourseList = courseCodeData[event.target.value];
        });

        // document.getElementById("goBtn").addEventListener("click", () => {
        //     if (currentCourseList) {
        //         populateTable("theory", currentCourseList.theory);
        //         populateTable("lab", currentCourseList.lab);
        //     } else {
        //         alert("Please select a valid term.");
        //     }
        // });

        function populateTable(tableId, courses) {
             const table = document.getElementById(tableId).querySelector("tbody");
             table.innerHTML = ""; // Clear existing rows

             courses.forEach(course => {
             const row = document.createElement("tr");

              // Function to dynamically create a select dropdown
             const createSelect = (excludeValues = []) => {
            return `<select class="form-control">
                <option value="" disabled selected>Select</option>
                ${examiners
                    .filter(examiner => !excludeValues.includes(examiner)) // Exclude already selected values
                    .map(examiner => `<option value="${examiner}">${examiner}</option>`)
                    .join("")}
            </select>`;
             };

             row.innerHTML = `
            <td>${course}</td>
            <td>${createSelect()}</td> <!-- Course Teacher (First Examiner) -->
            <td>${createSelect()}</td> <!-- Second Examiner -->
            <td>${createSelect()}</td> <!-- Third Examiner -->
            <td><input type="text" class="form-control" placeholder="Enter External Examiner" /></td> <!-- External Examiner -->
            `;

             table.appendChild(row); // Append the row to the table
             });
             }


// Function to handle Save Button click
document.getElementById("saveBtn").addEventListener("click", () => {
    const batch = document.getElementById("batch-select").value;
    const term = document.getElementById("term-select").value;

    if (!batch || !term) {
        alert("Please select both batch and term.");
        return;
    }

    const tablesData = Array.from(document.querySelectorAll(".exam-panel")).map((table, idx) => ({
        panel: `Panel ${idx + 1}`,
        data: Array.from(table.querySelectorAll("tbody tr")).map(row => ({
            courseCode: row.children[0].textContent,
            firstExaminer: row.children[1].querySelector("select").value,
            secondExaminer: row.children[2].querySelector("select").value,
            thirdExaminer: row.children[3].querySelector("select").value,
            externalExaminer: row.children[4].querySelector("input").value.trim()
        }))
    }));

    // Flatten tablesData into a form-urlencoded format
    const payload = `batch=${encodeURIComponent(batch)}&term=${encodeURIComponent(term)}&data=${encodeURIComponent(
        JSON.stringify(tablesData)
    )}`;

    fetch("save_exam_panel.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: payload
    })
        .then(response => response.text()) // Expect plain text response
        .then(data => {
            console.log("Server response:", data);
            alert("Data saved successfully!");
        })
        .catch(error => {
            console.error("Error saving data:", error);
            alert("An error occurred while saving. Check the console for details.");
        });
});


const payload = { batch, term, data: tablesData };

// Log the data before sending it
console.log("Sending the following JSON data to the server:", JSON.stringify(payload, null, 2));

fetch("save_exam_panel.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload) // Ensure this is a valid JSON string
})

.then(response => response.json())
.then(data => {
    console.log("Server response:", data);
    if (data.success) {
        alert("Data saved successfully!");
    } else {
        alert("Failed to save data: " + data.message);
    }
})
.catch(error => {
    console.error("Error saving data:", error);
    alert("An error occurred while saving. Check the console for details.");
});

    

     


    </script>
    <script>
        function fetchData() {
    const batch = document.getElementById('batch-select').value;
    const term = document.getElementById('term-select').value;

    if (!batch || !term) {
        alert('Please select both batch and term.');
        return;
    }

    const payload = `batch=${encodeURIComponent(batch)}&term=${encodeURIComponent(term)}`;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_exam_panel.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.querySelector('#theory tbody').innerHTML = xhr.responseText;
        }
    };

    xhr.send(payload);
}

    </script>

    <script>
    // AJAX form submission
    function submitForm() {
        var formData = [];
        $('#examTable tr').each(function() {
            var row = $(this);
            var courseCode = row.find('td:first').text();
            var firstExaminer = row.find('td select:first').val();
            var secondExaminer = row.find('td select:eq(1)').val();
            var thirdExaminer = row.find('td select:eq(2)').val();
            var fourthExaminer = row.find('td input').val();

            if (courseCode && firstExaminer) {
                formData.push({
                    courseCode: courseCode,
                    firstExaminer: firstExaminer,
                    secondExaminer: secondExaminer,
                    thirdExaminer: thirdExaminer,
                    fourthExaminer: fourthExaminer
                });
            }
        });

        $.ajax({
            url: 'save_exam_panel.php',
            method: 'POST',
            data: {
                batch: '<?php echo $batch; ?>',  // Pass batch and term
                term: '<?php echo $term; ?>',
                panels: formData
            },
            success: function(response) {
                alert(response.message);
            },
            error: function() {
                alert("Error saving data.");
            }
        });
    }
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>

</html>