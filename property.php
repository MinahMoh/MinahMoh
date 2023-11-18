<!DOCTYPE html>
<html lang="en">
<head>
  <title>House Rental Management System</title>
  <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="table.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">House Rental Management System</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.html">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="viewhouse.php">View Properties <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="viewproperty.php">Houses</a></li>
            <li><a href="review_rating.php">Rating</a></li>
          </ul>
        </li>
        <li><a href="landlord.php">Landlords</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Properties<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="property.php">Properties</a></li>
            <li><a href="review_rating.php">Ratings</a></li>
          </ul></li>
        <li><a href="booking.php">Booking</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Hi <?php session_start();echo $_SESSION['uname'];?></a>
         </li>
        <li><a href="index.html"><span class="glyphicon glyphicon-user"></span> Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>
  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="property2.php" class='btn btn-primary'>Show Ratings</a> 
<div class="container">
  <br>
  <table border="1" id="customers">
    <tr>
      <th>property_id</th>
      <th>property pic</th>
      <th>property_name</th>
      <th>Description</th>
      <th>rental_rate</th>
      <th>Address</th>
      <th>Location Id</th>
      <th>number_of_rooms</th>
      <th>amenities</th>
      <th>date_listed</th>
      <th>availability_status</th>
      <th>Landlord id</th>
    </tr>
<?php
include("connection.php");
$query="select * from property";
$data=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($data))
{
    echo "<tr>
    <td>" . $result['id'] . "</td>
    <td><img src='data:image/jpeg;base64," . base64_encode($result['picture']) . "'/></td>
    <td>" . $result['name'] . "</td>
    <td>" . $result['description'] . "</td>
    <td>" . $result['rental_rate'] . "</td>
    <td>" . $result['address'] . "</td>
    <td>" . $result['location_id'] . "</td>
    <td>" . $result['number_of_rooms'] . "</td>
    <td>" . $result['amenities'] . "</td>
    <td>" . $result['date_listed'] . "</td>
    <td>" . $result['status'] . "</td>
    <td>" . $result['landlord_id'] . "</td>
</tr>";

}
echo "</table>";
?>
</div>

</body>
</html>
