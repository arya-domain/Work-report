<?php
	include("config.php");

	$uid;
	if(isset($_COOKIE['id']) && isset($_COOKIE['role']))
	{
		$uid=$_COOKIE['id'];
	}
	
	$name=$_POST['name'];
	
	$rand=rand("123456",5);
	$code;
	$check=$_FILES['file']['name'];
	if(!empty($check))
	{		
		$ss=$_FILES["file"]["tmp_name"];
		$code = hash_file('crc32b',"$ss");
		//$code=sha1_file($_FILES["file"]["tmp_name"]);
		//echo $code;
		
		$sqlss="select * from `files` where `code`='$code' order by `id` desc limit 1";
		$rest=mysqli_query($con,$sqlss);
		if(mysqli_num_rows($rest)>0)
		{
			while($rows=mysqli_fetch_array($rest))
			{
				$frt=$rows['code'];
				$fkl=$rows['file'];

				$st="insert into `files` (`name`, `file`, `code`, `added_by`, `date`) values ('$name','$fkl','$code','$uid',NOW())";
				$rts=mysqli_query($con,$st);
				
				if(isset($_COOKIE['role']))
				{
					if($_COOKIE['role']=='u')
					{
						header("Location: home.php?q=Successfully Uploaded (With Duplication Detected)...");
					}

					if($_COOKIE['role']=='a')
					{
						header("Location: admin.php?q=Successfully Uploaded (With Duplication Detected)...");
					}
				}
				else
				{
					header("Location: home.php?q=Successfully Uploaded (With Duplication Detected)...");
				}
			}
		}
		else
		{
			$st="insert into `files` (`name`, `file`, `code`, `added_by`, `date`) values ('$name','$rand$check','$code','$uid',NOW())";
			$rts=mysqli_query($con,$st);

			$name=$_FILES['file']['name'];

			$tmpname=$_FILES['file']['tmp_name'];

			if($rts==true)
			{
				$location="files/";
				$jjk=$rand.$name;
				move_uploaded_file($tmpname,$location.$jjk);

				if(isset($_COOKIE['role']))
				{
					if($_COOKIE['role']=='u')
					{
						header("Location: home.php?q=Successfully Uploaded...");
					}

					if($_COOKIE['role']=='a')
					{
						header("Location: admin.php?q=Successfully Uploaded...");
					}
				}
				else
				{
					header("Location: home.php?q=Successfully Uploaded...");
				}
			}
		}
	}
else
	{
		if(isset($_COOKIE['role']))
		{
			if($_COOKIE['role']=='u')
			{
				header("Location: home.php?q=Something Went Wrong...");
			}

			if($_COOKIE['role']=='a')
			{
				header("Location: admin.php?q=Something Went Wrong...");
			}
		}
		else
		{
			header("Location: home.php?q=Something Went Wrong...");
		}
	}
?>