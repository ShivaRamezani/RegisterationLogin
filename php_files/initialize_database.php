
<?php
$mysql_host = "localhost";
$mysql_database = "comp440_project";
$mysql_user = "comp440";
$mysql_password = "pass1234";
$db = new PDO("mysql:host=$mysql_host; dbname=$mysql_database", $mysql_user, $mysql_password);
$query = file_get_contents("project.sql");
$stmt = $db->prepare($query);

if ($stmt->execute()){
     echo "Great, status: succeed";
}
else{ 
     echo "Issue, status: failed";
}


#Reference: https://www.youtube.com/watch?v=WYufSGgaCZ8

