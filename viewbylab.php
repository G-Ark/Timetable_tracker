<?php
    include "navigation.php";
?>

<html lang="en">
<head>
    <title> View </title>
</head>

<body>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Labs
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View labs
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">View labs being conducted right now:</h3>
                            </div>
                            <div class="panel-body">
                                <select class = "form-control" name="subject" id="subject" onclick="checkAndSubmit()">
                                 <option value=0>Select a Lab</option>
                                    <?php
                                        $con=mysqli_connect("localhost","root","","timetable");
                                         $query="SELECT distinct sub from class;";
                                         $result=mysqli_query($con,$query);
                                        $test="";
                    
                                        while ($row=mysqli_fetch_assoc($result)) 
                                         {
                                                $sub=preg_split("/\(/",$row['sub']);
                                                if(isset($sub[1]) and $sub[0]!=$test)
                                                {
                                                 echo "<option value=".$sub[0].">".$sub[0]."</option>";
                                                 $test=$sub[0];
                                                    }
                                        }
                                    ?>
                                </select>
                                
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
