<?php
// Establish database connection (you may have this in a separate file)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_rental_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume you have obtained the specific landlord's ID
$specific_landlord_id = '1';

// SQL query to retrieve tenants belonging to a specific landlord
$sql = "SELECT tenants.*
        FROM tenants
        JOIN landlord ON tenants.id = landlord.id
        WHERE landlord.id = '$specific_landlord_id'";

$result = $conn->query($sql);

if (!$result) {
    // Query failed - display error details for debugging
    echo "Error: " . $conn->error;
}else{

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Tenant ID: " . $row["id"]. " - Tenant Name: " . $row["name"]. "Tenant Email:" . $row["email"]. "<br>";
        // Display other tenant details as needed
    }
} else {
    echo "No tenants found for this landlord.";
}
}

// Close the connection
$conn->close();
?>
