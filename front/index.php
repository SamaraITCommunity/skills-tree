<!DOCTYPE html>
<html>
<head>
<title>Тестовая страница</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<center>

<form action="" method="post">
	<select name="userid" size=5>
	<option value="0">Выберите пользователя</option>
	<?php
	
	include('vars.php');	
	$mysqli = new mysqli($host, $username, $passwd, $dbname); 
	$mysqli->set_charset("utf8");
	
	$query = "SELECT id_, name, surname FROM users ORDER BY name;"; 
	$username = $mysqli->query($query); 
	while ($userString = $username->fetch_assoc()) {
		printf ("<option value=\"%d\">%s %s</option>",$userString["id_"], $userString["name"], $userString["surname"]);
	}
	?>
	</select>
	<input type="submit" value="Отправить">
</form>

<form action="" method="post">
<?php
	printf("<button type=\"submit\" value=\"%s\" name=\"userid\">Обновить</button>",$_POST["userid"]);
?>
</form>
<form action="points.php">
<input type="submit" value="Пересчитать очки">
</form>
<?php 
/*$mysqli = new mysqli("localhost", "***REMOVED***", "***REMOVED***", "***REMOVED***"); 
$mysqli->set_charset("utf8");*/

/* check connection */ 
if ($mysqli->connect_errno) { 
	printf("Connect failed: %s\n", $mysqli->connect_error); 
	exit(); 
} 



$query = sprintf("SELECT * FROM users WHERE id_=\"%s\";", $_POST["userid"]);
$result = $mysqli->query($query); 
$currentuser=$result->fetch_assoc();

printf("<h1>%s %s</h1>", $currentuser["name"], $currentuser["surname"]);
printf ("<center><table valign=top class=maintable><tr><td>");

/* First column*/
$query = sprintf("SELECT * FROM skills, userSkills WHERE userSkills.user_id=\"%s\" AND skills.id_=skill_id AND skills.id_ LIKE '1%%';", $_POST["userid"]);
$result = $mysqli->query($query); 
while ($skill = $result->fetch_assoc()){
	if ($skill["points"] == 0)
		$color="unavailable";
	else
		$color="engineer";
	$query = sprintf("SELECT * FROM pointsToLevelup WHERE skills_points > %d LIMIT 1",$skill["points"]);
	$levels1 = $mysqli->query($query);
	$levelhigh = $levels1->fetch_assoc();
	

	$query = sprintf("SELECT * FROM pointsToLevelup WHERE level_=%d LIMIT 1",$levelhigh["level_"]-1);
	$levels2 = $mysqli->query($query);
	$levellow = $levels2->fetch_assoc();
	
	$progresspercent = ($skill["points"]-$levellow["skills_points"])/($levelhigh["skills_points"]-$levellow["skills_points"])*100;
	printf ("<table class=sublevel%s><tr><td><div class=%s>%s</div></td><td align=left><b class=%s>&nbsp%s&nbsp</b><br><progress value=%d max=100 class=engineer></progress><br><small>%s из %s</small></td></tr></table>", $skill["sublevel"], $color, $skill["level"], $color, $skill["name"], $progresspercent, $skill["points"]-$levellow["skills_points"], $levelhigh["skills_points"]-$levellow["skills_points"]);
}
printf ("</td><td>");

/* Second column*/

$query = sprintf("SELECT * FROM skills, userSkills WHERE userSkills.user_id=\"%s\" AND skills.id_=skill_id AND skills.id_ LIKE '2%%';", $_POST["userid"]); 
$result = $mysqli->query($query); 


while ($skill = $result->fetch_assoc()){
	if ($skill["points"] == 0)
		$color="unavailable";
	else
		$color="designer";

	$query = sprintf("SELECT * FROM pointsToLevelup WHERE skills_points > %d LIMIT 1",$skill["points"]);
	$levels1 = $mysqli->query($query);
	$levelhigh = $levels1->fetch_assoc();
	

	$query = sprintf("SELECT * FROM pointsToLevelup WHERE level_=%d LIMIT 1",$levelhigh["level_"]-1);
	$levels2 = $mysqli->query($query);
	$levellow = $levels2->fetch_assoc();
	
	$progresspercent = ($skill["points"]-$levellow["skills_points"])/($levelhigh["skills_points"]-$levellow["skills_points"])*100;
	printf ("<table class=sublevel%s><tr><td><div class=%s>%s</div></td><td align=left><b class=%s>&nbsp%s&nbsp</b><br><progress value=%d max=100 class=designer></progress><br><small>%s из %s</small></td></tr></table>", $skill["sublevel"], $color, $skill["level"], $color, $skill["name"], $progresspercent, $skill["points"]-$levellow["skills_points"], $levelhigh["skills_points"]-$levellow["skills_points"]);
						}	
printf ("</td><td>");

/* Third column*/
$query = sprintf("SELECT * FROM skills, userSkills WHERE userSkills.user_id=\"%s\" AND skills.id_=skill_id AND skills.id_ LIKE '3%%';", $_POST["userid"]);; 
$result = $mysqli->query($query); 


while ($skill = $result->fetch_assoc()){
	if ($skill["points"] == 0)
		$color="unavailable";
	else
		$color="programmer";
	$query = sprintf("SELECT * FROM pointsToLevelup WHERE skills_points > %d LIMIT 1",$skill["points"]);
	$levels1 = $mysqli->query($query);
	$levelhigh = $levels1->fetch_assoc();
	

	$query = sprintf("SELECT * FROM pointsToLevelup WHERE level_=%d LIMIT 1",$levelhigh["level_"]-1);
	$levels2 = $mysqli->query($query);
	$levellow = $levels2->fetch_assoc();
	
	$progresspercent = ($skill["points"]-$levellow["skills_points"])/($levelhigh["skills_points"]-$levellow["skills_points"])*100;
	
	printf ("<table class=sublevel%s><tr><td><div class=%s>%s</div></td><td align=left><b class=%s>&nbsp%s&nbsp</b><br><progress value=%d max=100 class=programmer>></progress><br><small>%s из %s</small></td></tr></table>", $skill["sublevel"], $color, $skill["level"], $color, $skill["name"], $progresspercent, $skill["points"]-$levellow["skills_points"], $levelhigh["skills_points"]-$levellow["skills_points"]);
}
printf ("</td></table></center>");

/* close connection */
$mysqli->close();
?>
</center>
</body>