<?php
unset($_COOKIE['id']);
setcookie('uid', '', 1);
unset($_COOKIE['role']);
setcookie('role', '', 1);
header("Location: login.php");
?>