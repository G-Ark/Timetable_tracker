<?php
	include "navigation.php";
?>

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
                            Download for teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                            
                 <form method="post" action="" enctype="multipart/form-data">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select teacher for whom the timetable should be generated:</h3>
                            </div>
                           
                            
                            
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <strong>Heads Up:</strong> The timetables generated will be stored in "PersonalTT" folder with initials.
                                </div>
                                <div class="form-group">
                                    <label>Teacher:</label>
                                        <select class="form-control">
                                            <option>Teacher Initials</option>
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
