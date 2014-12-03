<?php
	include "navigation.php";
?>
<head>
   <title>Remove</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Remove
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Remove
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Remove a faculty
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Remove a faculty from the department: </h3>
                            </div>
                             <div class="panel-body">
                                <div class="alert alert-warning">
                                    <strong>Warning!</strong> You are removing a faculty from the department.
                                 </div>
                                <form action = "" method = "post">
                                    <div class="form-group">
                                    <div class="input-group">
                                         <select class = "form-control" name="teacher" id="teacher" onclick="checkAndSubmit()">
                                            <option value=0>Choose a faculty initial</option>
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
                                <button type="submit" class="btn btn-lg btn-danger">Remove</button>     
                             </form>  
                                
                            </div>
                           
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

                
                
                    
                                
                        

                
                