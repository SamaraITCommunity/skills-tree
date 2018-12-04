<?php
include('vars.php');	
$mysqli = new mysqli($host, $username, $passwd, $dbname);
	$mysqli->set_charset("utf8");
	/* check connection */ 
	if ($mysqli->connect_errno) { 
	printf("Connect failed: %s\n", $mysqli->connect_error); 
	exit(); }

	$query = "SELECT * FROM pointsToLevelup ORDER BY level_;"; 
	$result = $mysqli->query($query); 
 	$sum=0;
	while ($level = $result->fetch_assoc()){
		$sum=$sum+$level["currentLevel"];
		$query = sprintf("UPDATE pointsToLevelup SET skills_points=%d WHERE level_=%d LIMIT 1;",$sum, $level["level_"]);
		$mysqli->query($query);
		printf("level_ %s currentLevel %s skills_points %s sum %s", $level["level_"], $level["currentLevel"], $level["skills_points"], $sum);
	} 
?>