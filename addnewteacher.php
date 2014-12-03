<?php
	include "navigation.php";
?>
<head>
   <title>Add</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

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
                                <i class="fa fa-file"></i> Add new teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add a new teacher to the department: </h3>
                            </div>
                             <div class="panel-body">
                                <form action = "" method = "post">
                                <div class="form-group">
                                <label>First Name:</label>
                                <input class="form-control" name = "fn" placeholder="FN">
                                </div>
                                <div class="form-group">
                                <label>Last Name:</label>
                                <input class="form-control" name = "ln" placeholder="LN">
                                </div>
                                <div class="form-group">
                                <label>Initials:</label>
                                <input class="form-control" name = "sn" placeholder="INI">
                                </div>
                                <div class="form-group">
                                <label>Email ID:</label>
                                <input class="form-control" name = "mail" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                <label>Phone Number:</label>
                                <input class="form-control" name = "phone" placeholder="Phone">
                                </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                                  
                             </form>  
                                
                            </div>
                           
               </div>
                
                 <?php
                                /* $fname=$_POST['fn'];
                    $lname=$_POST['ln'];
                    $sname=$_POST['sn'];
                    $email=$_POST['mail'];
                    $phone=$_POST['phone'];
                    $con=mysqli_connect("localhost","root","","timetable");
                    if (mysqli_connect_errno())
                    {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }
                    $query="Insert into login values('$fname','$lname','$sname','NULL','NULL','$email','$phone');";
                    $result=mysqli_query($con,$query);
                    mysqli_close($con);     
                                */ 
                ?> 
                    
                                
                        

                
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
