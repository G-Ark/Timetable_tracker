<?php
	if(isset($_POST['download'])) 
	{
		$sem=$_POST["sem"];
		$fname="uploads/".$sem."sem_tt".".xlsx";
		if(file_exists($fname)){
			echo "<a href='$fname'>Click here to download!</a>";
		}
		else
			echo "No such file!";
	}
	include "include-must.php";
?>
<br/><br/><br/><br/><br/><br/><br/>
<section class="section1">
	<div style="clear:both"></div>
	<p>Enter the sem and check if the file is available for download</p>
		<form id="loginform" method="post" name="loginform" action="">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input style="width:250px" type="text" class="form-control" placeholder="Sem" name="sem">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="button" name="download">Submit</button>
			</div>
		</form>	
</section>
</body>
	<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>