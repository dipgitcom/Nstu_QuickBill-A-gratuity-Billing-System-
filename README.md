# NSTU-QuickBill

## Introduction

Full Details Project Structure here - https://github.com/IIT-NSTU/Nstu_QuickBill-A-gratuity-Billing-System-.git

SRS LInk : https://github.com/IIT-NSTU/Nstu_QuickBill-A-gratuity-Billing-System-/blob/main/NSTU_QuickBill_SRS_final.docx

Presentation File : https://github.com/IIT-NSTU/Nstu_QuickBill-A-gratuity-Billing-System-/blob/main/Final%20Presentation.pptx

NSTU-QuickBill is a web-based bill management and tracking system designed for Noakhali Science and Technology University (NSTU). The system aims to streamline administrative tasks by automating the process of bill creation, tracking, verification, and approval. This solution replaces the traditional manual system, reducing errors and improving efficiency. With a user-friendly interface, stakeholders across various departments (Director, Registrar Office, DAA Office, Exam Controller, Treasurer, VC) can seamlessly manage and monitor the status of bills at every stage.

## Features

- **Bill Creation**: Allows users to create and submit bills through a simple form.
- **Real-time Tracking**: Provides real-time updates on the status of each bill, including verification and rejection timestamps.
- **Departmental Workflow**: Facilitates smooth interaction between various departments involved in bill processing.
- **Automatic Notifications**: Sends automatic notifications to relevant stakeholders when action is required.
- **Secure Data Management**: Ensures all bill data is securely stored and managed in a centralized database.
- **Audit Trail**: Keeps an accurate record of all actions performed on the bill for transparency.
- **Multi-Role Support**: Supports different roles such as Director, Registrar Office, DAA Office, Exam Controller, and VC.

## Tools and Technologies Used

### Backend
- **PHP**: Used for server-side scripting to handle bill creation, processing, and database interactions.
- **MySQL**: Database management system for storing bill details and tracking information.
- **AJAX**: Used for asynchronous data loading to improve user experience.

### Frontend
- **HTML5**: Markup language for creating the structure of web pages.
- **CSS3**: Styling language for designing the UI elements.
- **Bootstrap 4/5**: Frontend framework used for responsive design and UI components.
- **JavaScript**: Used for adding interactivity and dynamic behavior to the web pages.
- **jQuery**: JavaScript library for DOM manipulation and AJAX functionality.

### Additional Tools
- **XAMPP/WAMP**: Local server environments for PHP and MySQL.
- **Git**: Version control system for managing code and collaboration.

## Dataset Description

The dataset consists of the following key elements:
- **Bill Details**: Contains information about the bill such as the amount, description, department, and the creator.
- **User Data**: Information about users in different departments, including their roles and permissions.
- **Approval Workflow Data**: Tracks the approval status of the bill as it moves through the various departments.

This data is stored in a MySQL database, and the application dynamically queries this data to show the current status and history of each bill.

## Algorithms

- **Bill Status Tracking**: The status of each bill is updated dynamically as it moves through the approval process. This is done by querying the database at regular intervals.
- **Notification System**: An automatic system that triggers notifications based on the actions taken on a bill (e.g., submission, verification, rejection).
- **Role-Based Access Control (RBAC)**: Ensures that only users with the appropriate roles (e.g., Director, Registrar Office, VC) can perform specific actions on the bills.

## Workflow

1. **Bill Creation**: The user (e.g., department head) creates a bill by filling out a form with necessary details.
2. **Bill Submission**: Once created, the bill is submitted to the next department (e.g., Registrar).
3. **Approval/Rejection**: The department (Registrar, DAA Office, etc.) verifies the bill, approves it, or rejects it.
4. **Tracking**: As the bill moves through the various stages, its status is updated, and all stakeholders are notified.
5. **Final Approval**: Once all departments approve the bill, it reaches the VC for final approval or rejection.

## Steps to Run the Project

Follow the steps below to set up and run the **NSTU-QuickBill** project locally:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/nstu-quickbill.git
