<?php
	include "navigation.php";
?>

<html lang="en">

<head>
    <title>Upload</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Upload
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="alert alert-warning">
                    <strong>Warning!</strong> <a style= "color:red" href = "uploads/template.xlsx"> Before uploading have a look at our template! </a>
                </div>

                <form method="post" name="loginform" action="upload-validation.php" enctype="multipart/form-data">
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the semester for which you want to upload timetable:</h3>
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

                              
                                <div class="form-group">
                                    <label>Select a file :</label>
                                <input type="file" name = "file" id = "file">
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
