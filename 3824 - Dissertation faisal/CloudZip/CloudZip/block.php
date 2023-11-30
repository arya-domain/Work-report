<?php
	include("config.php");

	if(isset($_GET['s'])&&isset($_GET['q']))
	{
		$s=$_GET['s'];
		$id=$_GET['q'];
		$sql="Update `register` set `role`='$s' where `id`='$id'";
		$result=mysqli_query($con,$sql);

		if($result==true)
		{
			header("Location: view_users.php?q=User Status Updated...");
		}
	}
	else
	{
		header("Location: view_users.php?q=Something Went Wrong...");
	}
?>