<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
?>
<head>
   <title>Add</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
               
                 <?php
                    if (isset($_POST['sem']) and isset($_POST['strength'])) 
                    {
                    
                        //get values from form
                        $class=$_POST['sem'];
                        $str=$_POST['strength'];

                        //get connection with dtaabase
                        $con=mysqli_connect("localhost","root","","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }
                        
                        //execute query
                        $query="Insert into sem values('$class','$str');";
                        $result=mysqli_query($con,$query);
                        mysqli_close($con);
                        //display message
                    }
                ?>
                <!-- PHP script to insert a new class and sectio nto database -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Add
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Add new class
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add a new class to the department: </h3>
                            </div>
                            <div class="panel-body">
                                <form action = "" method = "post">
                                <div class="form-group">
                                    <label>Enter sem and section</label>
                                    <input class="form-control" name = "sem" placeholder="Sem and section">
                                </div>
                                <div class="form-group">
                                    <label>Enter Strength of the new class</label>
                                    <input class="form-control" name = "strength" placeholder="Strength">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                                </form>      
                            </div>  
               </div>

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
    }//if not logged in redirec to login page
    else
    header('Refresh:0,url=login.php');
?>