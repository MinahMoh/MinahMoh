<?php
include("connection.php");
$tenantName = $_POST['tenantName'];
$tenantEmail = $_POST['tenantEmail'];
$tenantPassword = $_POST['tenantPassword'];
{
	if($tenantName1!="" && $tenantEmail!="" && $tenantPassword!="")
	{
		$query="insert into tenants values('$tenantName','$tenantEmail','$tenantPassword')";
		$data=mysqli_query($conn,$query);
		if($data)

			echo 1;
		else
			echo 2;
	}
}

?>
<?php
session_start();
include("connection.php");
$tenantName = $_POST['tenantName'];
$tenantEmail = $_POST['tenantEmail'];
$tenantPassword = $_POST['tenantPassword'];
{
	if($tenantName!="" && $tenantEmail!="" && $tenantPassword!="")
	{
		$query="insert into tenants(name,email,password) values('$tenantName','$tenantEmail','$tenantPassword')";
		$data=mysqli_query($conn,$query);
		if($data)

			{
				$_SESSION['uname']=$tenantName;
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