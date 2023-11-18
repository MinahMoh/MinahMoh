<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maintenance Request</title>
    <link rel="stylesheet" type="text/css" href="signin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    </head>
    
    <body>
    <div class="container" align="left">
    <div class="card" style="width: 23rem;border-radius: 25px;background-color:#f0f5f5">
    <br>
     <div class="card-body">
    <h1 class="card-title" align="left"><B>Request Here</B></h1>
    <form name="Form1" action="signin.php" method="get">
    <h1>Maintenance Request</h1>
    <form action="maintenance.php" method="post">
        <label for="property_id">Property ID:</label>
        <input type="text" name="property_id" id="property_id" required>
        
        <label for="issue_type">Issue Type:</label>
        <select name="issue_type" id="issue_type">
            <option value="Electrical">Electrical</option>
            <option value="Plumbing">Plumbing</option>
            <option value="Appliance">Appliance</option>
            <option value="General Repairs">General Repairs</option>
            <option value="Other">Other</option>
        </select>
        
        <label for="description">Issue Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <button type="submit">Submit Request</button>
    </form>
</body>
</html>

<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $property_id = $_POST['property_id'];
    $issue_type = $_POST['issue_type'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO maintenance_requests (property_id, issue_type, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $property_id, $issue_type, $description);
    
    if ($stmt->execute()) {
        echo "Maintenance request submitted successfully!";
    } else {
        echo "Error submitting maintenance request: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>