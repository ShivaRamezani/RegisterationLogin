<?php 

session_start();

	include("connection.php");
	include("operations.php");
	//var_dump($_SERVER);
	$requestMethod = strtoupper(getenv('REQUEST_METHOD'));
	$httpMethods = array('GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS');

	if (in_array($requestMethod, $httpMethods)) 

	{
		if ($requestMethod == 'POST') {


		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
		$email = $_POST['email'];


		if(!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($email) && !is_numeric($username))
		{

			$query = "select * from user where username = '$username' limit 1";
			$result = mysqli_query($con, $query);


			if($result)
			{

				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if(($user_data['password'] === $password) && ($user_data['firstName'] === $firstName) && ($user_data['lastName'] === $lastName) && ($user_data['email'] === $email))
					{

						$_SESSION['username'] = $user_data['username'];
						header("Location: index.php");
						exit;
					}

				}
			}
			
			echo "wrong username or password!";
		}
	
		else
		{
			echo "wrong username or password!";
		}
	}
	}
	else{
		echo("failed server");
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<style type="text/css">
	
	#button{
	padding: 10px;
	height: 40px;
	width: 80px;
	color: white;
	background-color: blue;
	border: none;
	}
	#text{
	height: 20px;
	padding: 4px;
	border: solid thin #aaa;
	width: 100%;
	border-radius: 5px;

	}
	#box{
	background-color: lightgreen;
	display: flex;
	margin: auto;
	width: 200px;
	padding: 20px;
	}
	#title{
		font-size: 20px;
		margin: 10px;
		color: blue;"
	}

	</style>

	<div id="box">

		<form method="post">
			<div id = "title">Login</div>

            <label for="username">username:</label>
			<input id="text" type="text" name="username">
			<br><br>

            <label for="password">password:</label>
			<input id="text" type="password" name="password">
			<br><br>
            
            <label for="firstName">first name:</label>
            <input id="text" type="text" name="firstName">
            <br><br>
            
            <label for="lastName">last name:</label>
            <input id="text" type="text" name="lastName">
            <br><br>

            <label for="email"> email:</label>
			<input id="text" type="text" name="email">
			<br><br>

			<input id="button" type="submit" value="Login">
			<br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>


<?php
#Reference: https://www.youtube.com/watch?v=WYufSGgaCZ8

?>