<?php
session_start();
include("connection.php");
$landlordName = $_POST['landlordName'];
$landlordEmail = $_POST['landlordEmail'];
$landlordPassword = $_POST['landlordPassword'];

{
	if($landlordName!="" && $landlordEmail!=""  && $landlordPassword!="")
	{
		$query="insert into landlord(name,email,password) values('$landlordName','$landlordEmail','$landlordPassword')";
		$data=mysqli_query($conn,$query);
		if($data)

			{
				$_SESSION['uname']=$landlordName;
				header('location:home.php');
	        }
		else
			{
				echo "<script type='text/javascript'>alert('Sign up unsuccessfull')
        window.location.href='index.html';
        </script>";
			}
	}
}
?>