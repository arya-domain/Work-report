<?php
	include("config.php");

	$usn=$_POST['usn'];
	$pwd=md5($_POST['pwd']);
	
	$sql="select * from `register` where `password`='$pwd' and `username`='$usn' or `email`='$usn'";

	$result=mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_array($result))
		{
			if($row['role']=='a')
			{
				setcookie("id",$row['id']);
				setcookie("role",$row['role']);
				header("Location: admin.php?q=Admin Login Success!!!");
			}
			if($row['role']=='b')
			{
				header("Location: login.php?q=Blocked By Admin!!!");
			}
			if($row['role']=='u')
			{
				setcookie("id",$row['id']);
				setcookie("role",$row['role']);
				header("Location: home.php?q=Login Success!!!");
			}
		}
	}
	else
	{
		header("Location: login.php?q=Incorrect Credentials...");	
	}
?>