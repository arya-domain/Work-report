<!DOCTYPE html>
<html>
<head>
<title>Data De-Duplication | Project</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Amaranth:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<?php
	if(isset($_GET['q']))
	{
		?>
	<script>
		alert("<?php echo $_GET['q']; ?>");
	</script>
	<?php
	}
	?>
</head>
<body>
    <div class="content">
		<?php
	include("config.php");

		if(isset($_COOKIE['id']) && isset($_COOKIE['role']))
		{
			if($_COOKIE['role']=='a')
			{
	$sql="select * from `register` where `id`='".$_COOKIE['id']."'";

	$result=mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_array($result))
		{	
			?>
		<h1>Welcome "<?php echo $row['name']; ?>" :</h1>
		<div class="main">
			<h2>Admin Panel:</h2>
			
			<form name="uploader" enctype="multipart/form-data" id="uploader" method="post" action="add_file.php">
				<h5>File Name:</h5>
				<input type="text" placeholder="Type Here..." required="" name="name">
				<h5>File:</h5><br>
				<input type="file" name="file" required="" name="name"><br><br>
				<input type="submit" value="Upload File">
				<br><br>
				<a href="view_files.php">
					View/Download Files
					<br><br>
				</a>
				<a href="view_users.php">
					Manage Users
					<br><br>
				</a>
				<a href="logout.php">
					Logout
					<br><br>
				</a>
			</form>
		</div>
	<?php
		}
	}
		}
			
		else
		{
			?>
			<div style="display: none;">
				<?php
			header("Location: home.php");
			?>
		</div>
				<?php
		}
		}
		else
		{
			?>
			<div style="display: none;">
				<?php
			header("Location: login.php?q=Login First!!!");
			?>
		</div>
				<?php
		}
		?>
		<p class="footer">&copy; <?php echo date("Y"); ?> Data De-Duplication Project. All Rights Reserved | Design by <a href="#"> Muhammad Faisal</a></p>
	</div>
</body>
</html>