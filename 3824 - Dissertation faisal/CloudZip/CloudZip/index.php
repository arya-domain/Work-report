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
	<div style="display: none;">
	<?php
		if(isset($_COOKIE['id']) && isset($_COOKIE['role']))
		{
			header("Location: home.php");
		}
?>
	</div>
    <div class="content">
		<h1>User Registeration:</h1>
		<div class="main">
			<h2>Register For an Account</h2>
			
			<form action="user.php" enctype="multipart/form-data" method="post" name="register">
				<h5>Username</h5>
				<input type="text" placeholder="Type Here..." required="" name="usn">
				<h5>Name:</h5>
				<input type="text" placeholder="Type Here..." required="" name="name">
				<h5>Email</h5>
				<input type="text" placeholder="Type Here..." required="" name="email">
				<h5>Password</h5>
				<input type="password" placeholder="Type Here..." name="pwd">
				<input type="submit" value="Create Account">
				<br><br>
				<a href="login.php">
					Already Have An Account? Login Here
					<br><br>
				</a>
			</form>
		</div>
		<p class="footer">&copy; <?php echo date("Y"); ?> Data De-Duplication Project. All Rights Reserved | Design by <a href="#"> Muhammad Faisal</a></p>
	</div>
</body>
</html>