<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
?>
<html>
<head>
   <title>Download</title>
</head>

<body>
    <div id="wrapper">
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
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download by sem
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
                            ?>
                <!-- PHP script to download file if submit pressed and file exists.Else diaplay suitable message -->

                 <form method="post" action="" enctype="multipart/form-data" name="sem1">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the semester for which you want to download timetable:</h3>
                            </div>
                             
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <strong>Heads Up:</strong> The timetables generated will be stored in "Downloads" folder of your browser.
                                </div>
                                <div class="form-group">
                                    <label>Sem:</label>
                                        <select class="form-control" onchange="checkAndSubmit()" name="sem">
                                            <option value=0>Sem</option>
                                            <?php
                                            $con=mysqli_connect("localhost","root","","timetable");
                                            $query="select distinct sem from class;";
                                            $result=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                             echo "<option value =".$row['sem'].">".$row['sem']."</option>";
                                            }
                                            mysqli_close($con);
                                            ?>
                                        </select>
                                        <!-- PHP script to get sem values from database and from "class" table in db-->
                                </div>
                                <button type="submit" class="btn btn-default" name="download">Submit</button>
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
<?php
    }
    else
        header('Refresh:0,url=login.php');