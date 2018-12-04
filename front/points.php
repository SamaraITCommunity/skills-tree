<html>
<head>
</head>
<body>
<?php 
ini_set('log_errors', 'On');
ini_set('error_log', '/var/logs/php_errors.log');

include('vars.php');	
$mysqli = new mysqli($host, $username, $passwd, $dbname);
$mysqli->set_charset("utf8");

/* check connection */ 
if ($mysqli->connect_errno) { 
printf("Connect failed: %s\n", $mysqli->connect_error); 
exit(); 
} 
/*create new rows for new users and skills*/
/*new userSkills*/
$query = "INSERT INTO userSkills (user_id, skill_id) SELECT users.id_, skills.id_ FROM skills, users WHERE NOT EXISTS (SELECT * FROM userSkills WHERE skill_id=skills.id_ AND user_id=users.id_)";
$mysqli->query($query);


$i =1;

while ($i <= 3) {
	$query = "SELECT id_ FROM users ORDER BY id_;";
	$users = $mysqli->query($query);
	

/* for every user*/
while ($usercur = $users->fetch_assoc()){
	$skillsum=0;
	$query = sprintf("SELECT * FROM userSkills WHERE skill_id LIKE '%d%%' AND skill_id NOT LIKE '%d' AND user_id=%s ORDER BY user_id;", $i, $i, $usercur["id_"]);
	$result = $mysqli->query($query);
	
	/* for every skill */
	while ($skill = $result->fetch_assoc())	{
		$skillsum = $skillsum + $skill["points"];
		
		/*уровень, до которого ещё не доросли*/
		$query = sprintf("SELECT level_ FROM pointsToLevelup WHERE skills_points > %d LIMIT 1",$skill["points"]);
		$levels = $mysqli->query($query);
		$level = $levels->fetch_assoc();


		/*нижний порог*/
		$query = sprintf("SELECT level_ FROM pointsToLevelup WHERE skills_points > %d LIMIT 1",$skill["points"]);
		$levels = $mysqli->query($query);
		$level = $levels->fetch_assoc();
		$query = sprintf("UPDATE userSkills SET level = %d WHERE user_id=%s AND skill_id='%d'", $level["level_"]-1, $usercur["id_"], $skill["skill_id"]);
		$mysqli->query($query);
		printf ("skills: %s user: %s skill: %s i: %s level: %s<br> ", $skillsum, $usercur["id_"], $skill["skill_id"], $i, $level["level_"]-1);

	$query = sprintf("SELECT level_ FROM pointsToLevelup WHERE skills_points > %d LIMIT 1",$skillsum);
	$levels = $mysqli->query($query);
	$level = $levels->fetch_assoc();
	
	$query = sprintf("UPDATE userSkills SET points = %d WHERE user_id=%s AND skill_id='%d'", $skillsum, $usercur["id_"], $i);
	$mysqli->query($query);
	printf ("level:%s  user: %s skill: %s i: %s<br> ", $level["level_"], $usercur["id_"], $skill["skill_id"], $i);
	$query = sprintf("UPDATE userSkills SET level = %d WHERE user_id=%s AND skill_id='%d'", $level["level_"]-1, $usercur["id_"], $i);
	$mysqli->query($query);


	}
}
$i++;
}


$query = "SELECT * FROM users;";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
printf ("%s (%s)\n", $row[2], $row["name"]);


/* free result set */ 
$result->free(); 

/* close connection */ 
$mysqli->close(); 
?>
</body>
</html>