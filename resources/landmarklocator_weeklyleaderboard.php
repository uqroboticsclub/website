<?php
	session_start();
	$con = mysqli_connect('localhost','haydenst','s4288794','haydenst_landmarklocator');
	$sql = "SELECT username, max(score) FROM games WHERE username != 'GUEST' AND date >= CURDATE()-7 AND date <= CURDATE() GROUP BY username ORDER BY max(score) DESC";
    $result = mysqli_query($con, $sql);
	echo "<h2>Leaderboard</h2> <button id='btnall' class='button button_blue'>All</button><button id='btnweekly' class='button button_blue'disabled>This Week</button>";
	echo "<table><tr><th>Place</th><th>User</th><th>Score</th></tr>";
	$i = 1;
	$username = $_SESSION['username'];
	while($row = mysqli_fetch_array($result)){
		if($i <= 10 && $row['max(score)'] != 0){
			if($username == $row['username']){
				echo "<tr id='me'><td>";
				echo $i;
				echo "</td><td>	";
				echo $row['username']; 
				echo "</td><td>	";
				echo $row['max(score)'];
				echo "</td></tr>";
			} else {
				echo "<tr><td>";
				echo $i;
				echo "</td ><td>	";
				echo $row['username']; 
				echo "</td><td>	";
				echo $row['max(score)'];
				echo "</td></tr>";
			}
		} else if($username == $row['username']){
			echo "<tr id='last'><td>";
			echo $i;
			echo "</td><td>";
			echo $row['username']; 
			echo "</td><td>";
			echo $row['max(score)'];
			echo "</td></tr>";
		}
		$i++;
	}
	echo "</table>";
	if($i == 1){
        echo "<p>There are no registered players who have completed a game this week :(</p>";
    }
	
	mysqli_close($con);
?>