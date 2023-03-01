<?php
session_start();

if(isset($_SESSION['username']))
{
	unset($_SESSION['username']);
}

header("Location: login.php");
exit;



#Reference: https://www.youtube.com/watch?v=WYufSGgaCZ8

