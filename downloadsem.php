<?php
	include "include-must.php";
?>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
		include "menu-must.php";
		?>
         <!-- End of Navigation -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Download by semester
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i>Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i>Download by sem
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

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
                                elseif(isset($_POST['teacher']))
                                {
                                     header("Refresh:0,url= create.php?teacher=".$teacher);
                                }
                            ?>

                 <form method="post" action="" enctype="multipart/form-data">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the semester for which you want to download timetable:</h3>
                            </div>
                           
                            
                            
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Sem:</label>
                                        <select class="form-control">
                                            <option>Sem</option>
                                            <?php
                                            $con=mysqli_connect("localhost","root","","timetable");
                                            $query="select name from sem;";
                                            $result=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                             echo "<option value =".$row['name'].">".$row['name']."</option>";
                                            }
                                            mysqli_close($con);
                                            ?>
                                        </select>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                </form>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
