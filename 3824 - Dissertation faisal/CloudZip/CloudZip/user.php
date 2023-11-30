<?php
	include("config.php");
	
	$usn=$_POST['usn'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	
	$pwd=md5($_POST['pwd']);

	$sql="insert into `register`(`name`,`username`,`password`,`role`,`email`,`date`) Values ('$name','$usn','$pwd','u','$email',NOW())";
	
	$result=mysqli_query($con,$sql);
	
	if($result==true)
	{
		header("Location: login.php?q=User Added!!!");
	}
	else
	{
		header("Location: login.php?q=Something Went Wrong...");
	}
?>