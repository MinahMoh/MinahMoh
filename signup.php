<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['landlordName'], $_POST['landlordEmail'], $_POST['landlordPassword'], $_POST['landlordConfirmPassword'])) {
        
        $landlordName = $_POST['landlordName'];
        $landlordEmail = $_POST['landlordEmail'];
        $landlordPassword = $_POST['landlordPassword'];
        $landlordConfirmPassword = $_POST['landlordConfirmPassword'];

        if ($landlordPassword !== $landlordConfirmPassword) {
            $hashedPassword = hash('sha256', $landlordPassword);
            echo "Passwords do not match!";
            return;
        }

        $sql = "INSERT INTO Landlord (name, email, password) VALUES ('$landlordName', '$landlordEmail', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            header("Location: home.php");
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } elseif (isset($_POST['tenantName'], $_POST['tenantEmail'], $_POST['tenantPassword'], $_POST['tenantConfirmPassword'])) {
        
        $tenantName = $_POST['tenantName'];
        $tenantEmail = $_POST['tenantEmail'];
        $tenantPassword = $_POST['tenantPassword'];
        $tenantConfirmPassword = $_POST['tenantConfirmPassword'];

        if ($tenantPassword !== $tenantConfirmPassword) {
            $hashedPassword = hash('sha256', $tenantPassword);
            echo "Passwords do not match!";
            return;
        }

        $sql = "INSERT INTO Tenants (name, email, password) VALUES ('$tenantName', '$tenantEmail', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            text-align: center;
        }
        label, input[type="submit"] {
            display: block;
            margin-bottom: 10px;
        }
        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <script>
        function showForm() {
            var userType = document.getElementById("userType").value;
            var landlordForm = document.getElementById("landlordForm");
            var tenantForm = document.getElementById("tenantForm");

            if (userType === "landlord") {
                landlordForm.style.display = "block";
                tenantForm.style.display = "none";
            } else if (userType === "tenant") {
                tenantForm.style.display = "block";
                landlordForm.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h1>Signup Page</h1>
    <label>Select User Type:</label>
    <select id="userType" onchange="showForm()">
        <option value="">Select</option>
        <option value="landlord">Landlord</option>
        <option value="tenant">Tenant</option>
    </select>

    <!-- Landlord Signup Form -->
    <form id="landlordForm" style="display: none;" method="post" action="landlordsignup.php">
        <h2>Landlord Signup</h2>
        <input type="text" name="landlordName" placeholder="Name" required><br>
        <input type="email" name="landlordEmail" placeholder="Email" required><br>
        <input type="password" name="landlordPassword" placeholder="Password" required><br>
        <input type="password" name="landlordConfirmPassword" placeholder="Confirm Password" required><br>
        <input type="submit" value="Sign Up as Landlord">
    </form>

    <!-- Tenant Signup Form -->
    <form id="tenantForm" style="display: none;" method="post" action="tenantsignup.php">
        <h2>Tenant Signup</h2>
        <input type="text" name="tenantName" placeholder="Name" required><br>
        <input type="email" name="tenantEmail" placeholder="Email" required><br>
        <input type="password" name="tenantPassword" placeholder="Password" required><br>
        <input type="password" name="tenantConfirmPassword" placeholder="Confirm Password" required><br>
        <input type="submit" value="Sign Up as Tenant">
    </form>
</body>
</html>