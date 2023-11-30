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
			<h2>File Manager:</h2>
			<table width="100%" align="center">
				<tr bgcolor="#ccc">
					<th>S.No</th>
					<th>User Name:</th>
					<th>Status:</th>
					<th>Manage:</th>
				</tr>
				<?php
					$i=1;
					$sql="select * from `register` where `role`='u' or `role`='b'";

					$result=mysqli_query($con,$sql);

					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_array($result))
						{
							?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><a href="user_files.php?s=<?php echo $row['id']; ?>"><?php echo $row['username']; ?> (View Files)</a></td>
							<td><?php if($row['role']=='b'){echo "Blocked";}if($row['role']=='u'){echo "Active";} ?></td>
							<td><a href="block.php?q=<?php echo $row['id']; ?>&s=<?php if($row['role']=='b'){echo "u";}if($row['role']=='u'){echo "b";} ?>"><?php if($row['role']=='b'){echo "Un-Block";}if($row['role']=='u'){echo "Block";} ?></a></td>
						</tr>
							<?php
							$i++;
						}
					}
			else
			{
				?>
						<tr>
							<td colspan="4">no record found...</td>
						</tr>
				<?php
			}
				?>
			</table>
			<br><br>
			<a href="admin.php">
					< back
					<br><br>
				</a>
			<a href="logout.php">
					Logout
					<br><br>
				</a>
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