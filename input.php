<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Form PDF Generator</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 0;

        background-color: #f0f0f0;
    }
    
    #form-container {
        width: 80%;
        max-width: 600px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    h1 {
        text-align: center;
    }
    
    fieldset {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    legend {
        font-weight: bold;
        color: #333;
    }
    
    label {
        display: inline-block;
        margin-top: 10px;
        font-weight: bold;
        width: 100px;
    }
    
    input {
        width: calc(100% - 120px);
        padding: 6px;
        margin-top: 5px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    
    button {
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    button:hover {
        background-color: #0056b3;
    }
    
</style>
</head>
<body>
    <div id="form-container">
        <h1>Exam Information Form</h1>
        
        <!-- Examiner and Exam Details -->
        <fieldset>
            <legend>Examiner and Exam Details</legend>
            <label for="examinerName">Examiner Name:</label>
            <input type="text" id="examinerName" placeholder="Enter examiner's name"><br><br>

            <label for="position">Position and Department:</label>
            <input type="text" id="position" placeholder="Position, Department"><br><br>

            <label for="year">Year:</label>
            <input type="text" id="year"><br><br>

            <label for="term">Term:</label>
            <input type="text" id="term"><br><br>

            <label for="session">Session:</label>
            <input type="text" id="session"><br><br>

            <label for="examDate">Exam Date:</label>
            <input type="date" id="examDate"><br><br>
        </fieldset>

        <!-- Section 1: Question Paper Preparation -->
        <fieldset>
            <legend>1. Question Paper Preparation</legend>
            <label for="courseCode1">Course Code:</label>
            <input type="text" id="courseCode1" placeholder="Course Code"><br><br>

            <label for="courseTitle1">Course Title:</label>
            <input type="text" id="courseTitle1" placeholder="Course Title"><br><br>

            <label for="hour1">Hour:</label>
            <input type="number" id="hour1" placeholder="Hours"><br><br>
        </fieldset>

        <!-- Section 2: Question Coordination -->
        <fieldset>
            <legend>2. Question Coordination</legend>
            <label for="courseCodesCoordination">Course Codes:</label>
            <input type="text" id="courseCodesCoordination" placeholder="Enter course codes"><br><br>

            <label for="numQuestions">Number of Questions:</label>
            <input type="number" id="numQuestions"><br><br>

            <label for="numMembers">Number of Members:</label>
            <input type="number" id="numMembers"><br><br>
        </fieldset>

        <!-- Section 3: Class Test / Assignment -->
        <fieldset>
            <legend>3. Class Test / Assignment</legend>
            <label for="courseCode2">Course Code:</label>
            <input type="text" id="courseCode2" placeholder="Course Code"><br><br>

            <label for="courseTitle2">Course Title:</label>
            <input type="text" id="courseTitle2" placeholder="Course Title"><br><br>

            <label for="numStudentsTest">Number of Students:</label>
            <input type="number" id="numStudentsTest"><br><br>

            <label for="numQuizAssign">Number of Quiz/Assignments:</label>
            <input type="number" id="numQuizAssign"><br><br>
        </fieldset>

        <!-- Section 4: Answer Sheet Evaluation -->
        <fieldset>
            <legend>4. Answer Sheet Evaluation</legend>
            <label for="courseCode3">Course Code:</label>
            <input type="text" id="courseCode3" placeholder="Course Code"><br><br>

            <label for="courseTitle3">Course Title:</label>
            <input type="text" id="courseTitle3" placeholder="Course Title"><br><br>

            <label for="hourEval">Hour:</label>
            <input type="number" id="hourEval" placeholder="Hours"><br><br>

            <label for="numStudentsEval">Number of Students:</label>
            <input type="number" id="numStudentsEval"><br><br>

            <label for="amountPerScript">Amount per Script:</label>
            <input type="number" id="amountPerScript" placeholder="Amount"><br><br>
        </fieldset>

        <!-- Section 5: Practical Exam -->
        <fieldset>
            <legend>5. Practical Exam</legend>
            <label for="courseCode4">Course Code:</label>
            <input type="text" id="courseCode4" placeholder="Course Code"><br><br>

            <label for="courseTitle4">Course Title:</label>
            <input type="text" id="courseTitle4" placeholder="Course Title"><br><br>

            <label for="numDays">Number of Days:</label>
            <input type="number" id="numDays"><br><br>

            <label for="numGroups">Number of Groups:</label>
            <input type="number" id="numGroups"><br><br>
        </fieldset>
        
        <!-- Section 6: Oral Exam -->
        <fieldset>
            <legend>6. Oral Exam</legend>
            <label for="oralCourseCodes">Course Codes:</label>
            <input type="text" id="oralCourseCodes" placeholder="Course Codes"><br><br>
        </fieldset>

        <!-- Section 7: Result Compilation -->
        <fieldset>
            <legend>7. Result Compilation</legend>
            <label for="resultCourseCodes">Course Codes:</label>
            <input type="text" id="resultCourseCodes" placeholder="Course Codes"><br><br>

            <label for="numStudentsResult">Number of Students:</label>
            <input type="number" id="numStudentsResult"><br><br>
        </fieldset>

        <!-- Section 8: Answer Sheet Review -->
        <fieldset>
            <legend>8. Answer Sheet Review</legend>
            <label for="reviewCourseCodes">Course Codes:</label>
            <input type="text" id="reviewCourseCodes" placeholder="Course Codes"><br><br>

            <label for="numStudentsReview">Number of Students:</label>
            <input type="number" id="numStudentsReview"><br><br>

            <label for="numCourses">Number of Courses:</label>
            <input type="number" id="numCourses"><br><br>
        </fieldset>

        <!-- Section 9: Examination Committee -->
        <fieldset>
            <legend>9. Examination Committee</legend>
            <label for="committeeRole">Role:</label>
            <input type="text" id="committeeRole" placeholder="Role (e.g., Member, Chairperson)"><br><br>
        </fieldset>

        <!-- Generate PDF Button -->
        <button type="button" onclick="generatePDF()">Download as PDF</button>
    </div>

    <script>
        
function generatePDF() {
    const { jsPDF } = window.jspdf;

    // Capture the form element
    const form = document.getElementById("form-container");

    // Use html2canvas to take a snapshot of the form
    html2canvas(form).then(canvas => {
        // Convert the canvas to an image data URL
        const imgData = canvas.toDataURL("image/png");

        // Create a new jsPDF instance
        const pdf = new jsPDF({
            orientation: "portrait",
            unit: "px",
            format: [canvas.width, canvas.height]
        });

        // Add the captured image to the PDF
        pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);

        // Save the generated PDF
        pdf.save("exam_information_form.pdf");
    });
}

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="script.js"></script>
</body>
</html>