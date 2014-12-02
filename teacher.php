<?php
	if(isset($_POST['teacher']))
	{
		$con=mysqli_connect("localhost","root","","timetable");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}

		@$teacher=$_POST['teacher'];
		echo "The details for classes being taken by ".$teacher." are:<br/><br/>";
		if($teacher)
		{
			$teacher="%".$teacher."%";
			$query="SELECT * from class where sub IN (select sub from handles where name like '$teacher')";
			$result=mysqli_query($con,$query);
		}
					
		if($result === FALSE) 
		{
			die(mysql_error()); // TODO: better error handling
		}
						
		else if(isset($result) and $result != FALSE)
		{						
			$num_rows = $result->num_rows;
			if($num_rows>0)
			{
				echo "<table border='1' width=600><tr><th>Sem</th><th>Start Time</th><th>End Time</th><th>Subject</th><th>Day</th></tr>";
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<tr>";
					echo "<td valign=middle align=center>" . $row['sem'] . "</td>";
					$start=date('g:i', strtotime($row['start_time']));
					echo "<td valign=middle align=center>" . $start. "</td>";
					$end=date('g:i', strtotime($row['end_time']));
					echo "<td valign=middle align=center>" . $end. "</td>";
					echo "<td valign=middle align=center>" . $row['sub'] . "</td>";
					echo "<td valign=middle align=center>" . $row['day'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			echo "No entries!";
		}
		else
		echo "No entries!";
		mysqli_close($con);	
	}
	else
	{
			include "include-must.php";
		?>
	</head>
	<script>
	function checkAndSubmit(){
	if(document.getElementById('teacher').selectedIndex>0){
		document.getElementById('loginform').submit();
	}
	}
	</script>
<body style="padding:10px">
<section class="section1">
	<div style="clear:both"></div>
		<p>Check timetable with respect to a  teacher </p>
		<form id="loginform" method="post" name="loginform" action="">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<select name="teacher" id="teacher" onclick="checkAndSubmit()">
				<option value=0>Select</option>
				<?php
					$con=mysqli_connect("localhost","root","","timetable");
					$query="SELECT DISTINCT name from handles;";
					$result=mysqli_query($con,$query);
					
					while($row=mysqli_fetch_assoc($result))
					{
						echo "<option value=".$row['name'].">".$row['name']."</option>";
					}
				?>
				</select>
				</div>
		</div>
		</form>	
</section>
</body>
<?php
	}
?>
</html>