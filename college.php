<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection file
$conn = new mysqli("localhost", "root", "", "law_college");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a variable to store success message
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $surname = $_POST['surname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $grievance = $_POST['grievance'];
    $mobile = $_POST['mobile'];

    // Prepare SQL query using prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO law_college(surname, fname, mname, email, category, grievance, mobile) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $surname, $fname, $mname, $email, $category, $grievance, $mobile);

    // Execute query and check for success
    if ($stmt->execute()) {
        $success_message = "Your grievance has been submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Status</title>
</head>
<body>
    <h2>Submission Status</h2>
    <?php if ($success_message) { echo "<p>$success_message</p>"; } ?>

</body>
</html>
