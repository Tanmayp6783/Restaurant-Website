<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>code is runing</title>
    <p> hi my name is Tanmay </p>
</head>
<body>
    
</body>
</html>


<?php
// Show all errors while developing
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data safely (with defaults)
    $name    = $_POST['name']    ?? '';
    $email   = $_POST['email']   ?? '';
    $phone   = $_POST['phone']   ?? '';
    $date    = $_POST['date']    ?? '';
    $time    = $_POST['time']    ?? '';
    $people  = $_POST['people']  ?? '';
    $message = $_POST['message'] ?? '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'restaurant');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // 7 placeholders for 7 columns
    $stmt = $conn->prepare(
        "INSERT INTO registration (name,email,phone,date,time,people,message)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    // Types: name(s), email(s), phone(s), date(s), time(s), people(i), message(s)
    $stmt->bind_param(
        "sssssis",
        $name,
        $email,
        $phone,
        $date,
        $time,
        $people,
        $message
    );

    if ($stmt->execute()) {
        // Simple success message (you can redirect instead)
        echo "<script>
                alert('Booking saved successfully!');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Invalid request method.";
}
?>
