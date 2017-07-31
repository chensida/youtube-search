<?php
$dbcon = mysqli_connect("130.211.236.143:3306", "root", "p@ssw0rd", "video");

$query = "SELECT * FROM videos";
$result = mysqli_query($dbcon, $query);
if (!$result) {
	die('error inserting records');
}

echo "<table>";
echo "<tr><td>title</td><td>date</td><td>description</td><td>channel</td><td>tags</td><td>duration</td><td>topicDetails</td></tr>"; 

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
	echo "<tr><td>" . $row['title'] . "</td><td>" . $row['date'] . "</td><td>" . $row['description'] . "</td><td>" . $row['channel'] . "</td><td>" . $row['tags'] . "</td><td>" . $row['duration'] . "</td><td>" . $row['topicDetails'] . "</td></tr>"; 
}

echo "</table>"; //Close the table in HTML

mysqli_close($dbcon);
?>