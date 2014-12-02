			<?php
				if(!isset($time))
				{
					date_default_timezone_set('Asia/Kolkata');
					$timestamp = time()-86400;
					$date = strtotime("+1 day", $timestamp);
					$day=date('D', $date);
					$time=date('h:i', $date);
					$con=mysqli_connect("localhost","root","","timetable");
						if (mysqli_connect_errno())
						{
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
							exit();
						}
						$query="SELECT * from class WHERE CAST('$time' as time) between start_time and end_time and day='$day';";
						$result=mysqli_query($con,$query);
						
						if($result === FALSE) 
						{
							die(mysql_error()); // TODO: better error handling
						}
						
						else if(isset($result) and $result != FALSE)
						{						
							$num_rows = $result->num_rows;
							if($num_rows>0)
							{
							echo "<table border='1' width=600 text-align:center><tr width=30px><th>Sem</th><th>Start Time</th><th>End Time</th><th>Subject</th><th>Day</th></tr>";
							while($row = mysqli_fetch_assoc($result))
							{
							echo "<tr>";
							echo "<td align:'center'>" . $row['sem'] . "</td>";
							$start=date('g:i', strtotime($row['start_time']));
							echo "<td valign=middle align=center>" . $start . "</td>";
							$end=date('g:i', strtotime($row['end_time']));
							echo "<td valign=middle align=center>" . $end . "</td>";
							echo "<td align:center>" . $row['sub'] . "</td>";
							echo "<td align:center>" . $row['day'] . "</td>";
							echo "</tr>";
							}
							echo "</table>";
							}
							else
							echo "No classes being held now!";
						}
						else
						echo "No classes being held now";
						mysqli_close($con);		
				}
				header("Refresh:300; url=now.php");
				?>	
				</html>