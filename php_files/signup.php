<?php 
session_start();

	include("connection.php");
	include("operations.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//input user given info for registration while preventing sql injection
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
        $firstName = mysqli_real_escape_string($con,$_POST['firstName']);
        $lastName = mysqli_real_escape_string($con,$_POST['lastName']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
		$passwordconfirmed = mysqli_real_escape_string($con,$_POST['passwordconfirmed']);

		if(!empty($username) && !empty($password) && !empty($passwordconfirmed)&& !empty($firstName) && !empty($lastName) && !empty($email)){
			
			if ($password != $passwordconfirmed){
				echo("password and passwordconfirmed does not match, please try again");
				
			}
			else{
				$sql = "INSERT INTO user (username,password,firstName,lastName,email) VALUES (?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($con);


				if(!mysqli_stmt_prepare($stmt, $sql)){
					echo("issue...");
				} 
				else{
					$q_username = "SELECT username  FROM user WHERE username ='$username' ";
					$result_username = mysqli_query($con,$q_username);
					$num_rows_username = mysqli_num_rows($result_username);

					$q_email = "SELECT  email FROM user WHERE  email = '$email'";
					$result_email = mysqli_query($con,$q_email);
					$num_rows_email = mysqli_num_rows($result_email);

					// check for duplicates in database
					if(!$num_rows_username && !$num_rows_email)
					{
					//save to database
					
					mysqli_stmt_bind_param($stmt, "sssss", $username, $password, $firstName, $lastName, $email);
					mysqli_stmt_execute($stmt);
					header("Location: login.php");
					exit;
					}

					elseif($num_rows_username && $num_rows_email)
					{
						echo" Duplicate email and username please try again";
					}

					elseif($num_rows_username)
					{
						echo" Duplicate username please try again";
					}

					elseif($num_rows_email)
					{
						echo" Duplicate email please try again";
					}


					
				}

			}
		}
		else
		{
			echo "Empty slot for user input, please fill in";
		}
		
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
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
			<div id = "title">Signup</div>
            
			<label for="username">username:</label>
			<input id="text" type="text" name="username"><br><br>

            <label for="password">password:</label>
			<input id="text" type="password" name="password">
            <br><br>

            <label for="passwordconfirmed">password confirmed:</label>
			<input id="text" type="password" name="passwordconfirmed">
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

			<input id="button" type="submit" value="Signup">
            <br><br>

			<a href="login.php">Click to Login</a>
            <br><br>
		</form>
	</div>
</body>
</html>


<?php
#Reference: https://www.youtube.com/watch?v=WYufSGgaCZ8
#Reference: https://www.youtube.com/watch?v=nTgFPcYRkys
#Reference: https://www.youtube.com/watch?v=I4JYwRIjX6c
?>