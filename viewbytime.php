<?php
    include "navigation.php";
?>

<?php
    if(isset($_POST['time1']) || isset($_POST['day1']) || isset($_POST['sem1']))
    {
        $con=mysqli_connect("localhost","root","","timetable");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
                        
        @$time1=$_POST['time1'];
        @$day1=$_POST['day1'];
        @$sem1=$_POST['sem1'];

        if($time1 and $day1 and $sem1)
        {
            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where CAST('$time1' as time) BETWEEN start_time and end_time and day='$day1' and sem='$sem1'; ";
            $result=mysqli_query($con,$query);
        }

        else if($time1 and $day1)
        {
            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where CAST('$time1' as time) BETWEEN start_time and end_time and day='$day1';";
            $result=mysqli_query($con,$query);
        }
                        
        else if($time1 and $sem1)
        {
            
            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where CAST('$time1' as time) BETWEEN start_time and end_time and sem='$sem1'; ";
            $result=mysqli_query($con,$query);
        }
                        
        else if($sem1 and $day1)
        {
            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where day='$day1' and sem='$sem1'; ";
            $result=mysqli_query($con,$query);
        }
        
        else if($day1)
        {
            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where day='$day1'; ";
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
            echo "<table border='1' width=400><tr><th>Sem</th><th>Start Time</th><th>End Time</th><th>Subject</th><th>Day</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td valign=middle align=center>" . $row['sem'] . "</td>";
            //  $start=date('g:i', strtotime($row['start_time']));
                echo "<td valign=middle align=center>" . $row['start_time'] . "</td>";
            //  $end=date('g:i', strtotime($row['end_time']));
                echo "<td valign=middle align=center>" . $row['end_time'] . "</td>";
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
                            View Classes - Time
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by time
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">View courses by time</h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="">

                                <div class="form-group">
                                    <div class = "input-group">
                                    <label>Enter Time of the day:</label>
                                    <input class="form-control" placeholder="Enter time">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <div class="input-group">
                                        <label> Select a semester : </label>
                                        <select class = "form-control" name="sel" id="sel" onclick="checkAndSubmit()">
                                         <option value=0>Semester</option>
                                        <?php                   
                                             $con=mysqli_connect("localhost","root","","timetable");
                                             $query="SELECT distinct sem from class;";
                                             $result=mysqli_query($con,$query);

                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {
                                                echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                             }
                                        ?>
                                         </select>

                                    </div>
                                </div>

                                         <div class="form-group"> 
                                             <div class="input-group"> 
                                            <form method="post" action="">
                                                <label> Select a day of the week: </label>
                                                    <select class = "form-control" name="day" id="day">
                                                        <option value=0>Day</option>
                                                        <option value="MON">MON</option>
                                                        <option value="TUE">TUE</option>
                                                        <option value="WED">WED</option>
                                                        <option value="THU">THU</option>
                                                        <option value="FRI">FRI</option>
                                                        <option value="SAT">SAT</option>
                                                    </select>
                                            </div>
                                          </div>  
                                           <button class="btn btn-default" name="check" onclick="checkAndSubmit()">Submit</button>
                                        
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
