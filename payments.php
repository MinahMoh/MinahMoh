<?php
$landlordId = 1;
$servername="localhost";
$username="root";
$password="";
$dbname="house_rental_system";

// Establish connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}

// SQL query to fetch leases for a specific landlord
$sql = "SELECT Leases.*, Property.name AS property_name
        FROM Leases
        INNER JOIN Property ON Leases.property_id = Property.id
        WHERE Property.landlord_id = $landlordId";

$result = mysqli_query($conn, $sql);

$leases = [];

if ($result === false) {
    echo "Error: " . mysqli_error($conn);
} else {
    // Fetch the leases belonging to the specified landlord
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $leases[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lease Information</title>
</head>
<body>
    <div class="leases">
        <?php if (!empty($leases)) : ?>
            <?php foreach ($leases as $lease) : ?>
                <div class="lease">
                    <h3><?php echo $lease['property_name']; ?></h3>
                    <p><strong>Start Date:</strong> <?php echo $lease['start_date']; ?></p>
                    <p><strong>End Date:</strong> <?php echo $lease['end_date']; ?></p>
                    <p><strong>Terms:</strong> <?php echo $lease['terms']; ?></p>
                    <p><strong>Status:</strong> <?php echo $lease['status']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No leases found for the specified landlord.</p>
        <?php endif; ?>
    </div>
</body>
</html>
