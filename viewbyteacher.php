<?php
    include "navigation.php";
?>
<html lang="en">
<head>
    <title> View </title>
</head>
<script>
    function checkAndSubmit()
    {
        
        if (document.getElementById('teacher').selectedIndex > 0)
        {
      //document.getElementById('formID').submit();
            document.getElementById('teacher-form').submit();
            
            
        }
    }
</script>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Classes - Teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View which teacher handles what class</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="teacher-form" id="teacher-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class = "form-control" name="teacher" id="teacher" onclick="checkAndSubmit()">
                                        <option value=0>Choose a teacher initial</option>
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
                    </div>
                </div>
                
                <?php
                    if(isset($_POST['teacher']))
                    {
                        //connect to database
                        $con=mysqli_connect("localhost","root","","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }

                        //get form data
                        @$teacher=$_POST['teacher'];
                        echo "The details for classes being taken by ".$teacher." are:<br/><br/>";
        
                        //execute query if form data is set and report failure if any
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
                            ?>
                                <div class="table-responsive">
                                <table class="table table-hover">
                                    
                                <thead>
                                    <tr>
                                        <th>Sem</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Subject</th>
                                        <th>Day</th>
                                    </tr>
                                </thead>

                            <?php
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
                            echo "</div>";
                            echo "</div>";
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
    
                ?>
                
            <!-- /.container-fluid -->
            <?php
                }
            ?>

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
