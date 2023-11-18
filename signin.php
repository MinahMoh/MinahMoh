<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['landlordEmail'], $_POST['landlordPassword'])) {
        $landlordEmail = $_POST['landlordEmail'];
        $landlordPassword = $_POST['landlordPassword'];
        
        $hashedPassword = hash('sha256', $landlordPassword);

        $sql = "SELECT * FROM Landlord WHERE email = '$landlordEmail' AND password = '$landlordPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['user_type'] = 'landlord';
            header("Location: home.php");
            exit();
        } else {
            echo "Invalid credentials for landlord!";
        }
    } elseif (isset($_POST['tenantEmail'], $_POST['tenantPassword'])) {
        $tenantEmail = $_POST['tenantEmail'];
        $tenantPassword = $_POST['tenantPassword'];

        $hashedPassword = hash('sha256', $tenantPassword);

        $sql = "SELECT * FROM tenants WHERE email = '$tenantEmail' AND password = '$tenantPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['user_type'] = 'tenant';
           header("Location: home.php");
            exit();
        } else {
            echo "Invalid credentials for tenant!";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signin Page</title>
    <style>
        /* Your CSS styles */
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
    <h1>Signin Page</h1>
    <label>Select User Type:</label>
    <select id="userType" onchange="showForm()">
        <option value="">Select</option>
        <option value="landlord">Landlord</option>
        <option value="tenant">Tenant</option>
    </select>

    <!-- Landlord Signin Form -->
    <form id="landlordForm" style="display: none;" method="post" action="signin.php">
        <h2>Landlord Signin</h2>
        <input type="email" name="landlordEmail" placeholder="Email" required><br>
        <input type="password" name="landlordPassword" placeholder="Password" required><br>
        <input type="submit" value="Sign In as Landlord">
    </form>

    <!-- Tenant Signin Form -->
    <form id="tenantForm" style="display: none;" method="post" action="signin.php">
        <h2>Tenant Signin</h2>
        <input type="email" name="tenantEmail" placeholder="Email" required><br>
        <input type="password" name="tenantPassword" placeholder="Password" required><br>
        <input type="submit" value="Sign In as Tenant">
    </form>
</body>
</html>