<html lang="en">
<head>
    <title> View </title>
</head>
<script>
    function checkAndSubmit()
    {
        if (document.getElementById('sel').selectedIndex > 0)
        {
      //document.getElementById('formID').submit();
            document.getElementById('sem-form').submit();
            
            
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
                            View Classes - Sem
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by sem
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php
                include "navigation.php";
                if(isset($_POST['sel']))
                {
                    //connectt o dattabse and report eroor in case of failure
                    $con=mysqli_connect("localhost","root","","timetable");
                    if (mysqli_connect_errno())
                    {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    //get data from form if present and report eroor if present
                    @$sem2=$_POST['sel'];
                    echo "The details for classes being taken for ".$sem2." are:<br/><br/>";                   
                    if($sem2)
                    {
                        $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where sem='$sem2' ORDER BY day,start_time; ";
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
                                echo "<td valign=middle align=center>" . $start . "</td>";
                                $end=date('g:i', strtotime($row['end_time']));
                                echo "<td valign=middle align=center>" . $end . "</td>";
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
                else
                {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View classes by semester</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" id="sem-form">
                             <div class="form-group">
                                <div class="input-group">
                                    <select class = "form-control" name="sel" id="sel" onclick="checkAndSubmit()">
                                    <option value=0>Semester</option>
                                    <?php                   
                                        //connect to database and query
                                        $con=mysqli_connect("localhost","root","","timetable");
                                        $query="SELECT distinct sem from class;";
                                        $result=mysqli_query($con,$query);

                                        //loop through query results to get select options
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </form>        
                    </div>

                 </div>
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