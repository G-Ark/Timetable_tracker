<?php
    if(isset($_POST['sem']) and isset($_POST['start']) and isset($_POST['day']) and isset($_POST['sub']))
    {
        //get data from forms
        $sem=$_POST['sem'];
        $start=$_POST['start'];
        $day=$_POST['day'];
        $subject=$_POST['sub'];
        
        //Ensure connection to database and report error if unsuccessful
        $con=mysqli_connect("localhost","root","","timetable");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        //Query to ensure if the time slot for that sem is possible
        $query="Select end_time from class WHERE sem='$sem' and start_time='$start' and day='$day';";
        $result=mysqli_query($con,$query);
        if($result === FALSE)
        {
            echo "Unable to allocate suitable time slot!<br/>";
        }
                    
        //Query to ensure that that sem has that subjecta s per syllabus
        $query1="Select name from handles WHERE sem='$sem' and sub='$subject';";
        $result1=mysqli_query($con,$query1);
        if($result1 === FALSE)
        {
            echo "Unable to allocate subject to that sem!<br/>";
        }
                    
        //query to ensure the teaccher for that subject
        $query2="Select distinct FName,LName,Email from login as l,handles as h where h.sem='$sem' and h.sub='$subject' and h.name=l.Short;";
        $result2=mysqli_query($con,$query2);
        if($result2 === FALSE)
        {
            echo "No teacher found1!";
        }
                    
        //enable suitable debuggin of results
        $num_rows = $result->num_rows;
        $num_rows1 = $result1->num_rows;
        $num_rows2= $result2->num_rows;           
        if($num_rows==0)
        echo "Unable to allocate suitable time slot!<br/>";
        else if($num_rows1==0)
        echo "Unable to allocate subject to that sem!<br/>";
        else if($num_rows2==0)
        echo "No teacher found!<br/>";
        else if(isset($result) and $result != FALSE and isset($result1) and $result1 != FALSE and isset($result2) and $result2 != FALSE)
        {
            $num_rows = $result->num_rows;
            if($num_rows>0)
            {
                $row=mysqli_fetch_assoc($result);
                $end_time=$row['end_time'];
                $query="Delete from class WHERE sem='$sem' and start_time='$start' and day='$day';";
                mysqli_query($con,$query);
                if($result === FALSE) 
                {
                    echo "No entries!<br/>";
                    exit();
                }
                else
                {
                    $query="INSERT into class VALUES('$sem','$subject','$start','$end_time','$day');";
                    mysqli_query($con,$query);
                    if($result === FALSE) 
                    {
                        echo "Unable to upload to database but class slot is now free!<br/>";
                        exit();
                    }   
                    echo "Database Uploaded!<br/>";
                    $num_rows = $result2->num_rows;
                    if($num_rows>0)
                    {
                        $row=mysqli_fetch_assoc($result2);
                        $FName=$row['FName'];
                        $LName=$row['LName'];
                        $Email=$row['Email'];
    //                  echo "Fname=".$FName."<br/>Lname=".$LName."<br/>Email=".$Email."<br/>";
                            
                        require_once('class.phpmailer.php');
                        $mail = new PHPMailer(); // create a new object
                        $mail->IsSMTP(); // enable SMTP
                        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                        $mail->SMTPAuth = true; // authentication enabled
                        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 465; // or 587
                        $mail->IsHTML(true);
                        $mail->Username = "student.rvce.ise@gmail.com";
                        $mail->Password = "rvce8thmile";
    
                        $mail->Subject = "AutoGen : Alert for class";
                        $mail->Body = "Dear ".$FName." ".$LName.",<br/>
                                            Please Note that you have been asked to take an extra class for:<br/>
                                                    Sem : $sem<br/>
                                                    Time : $start<br/>
                                                    Sub : $subject<br/>
                                                    Day : $day<br/>
                                                Kindly do the needful.<br/>
                                            Thank You.<br/>";
                        $idee = $Email;

                        $mail->AddAddress($idee);
                        if(!@$mail->Send())
                        {
                            echo "Error!".$mail->ErrorInfo;
                        }
                        else
                        {
                            echo "mail sent";
                        }
                    }
                    else
                    echo "Unable to send mail<br/>!";
                }//Mail sending code
            }
        }
        else
            echo "Error!<br/>";
        mysqli_close($con);
        header('Refresh:1,url=edit.php');
    }
?>
<!-- PHP script to do the need ful and sending mail --> 

<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
    include "navigation.php";
?>
<head>
   <title>Edit</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit a class in the timetable:</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <select class = "form-control" name="sem" id="sem">
                                    <option value=0>Sem</option>
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
                            <!-- Select sem from database class table -->

                            <div class="form-group">  
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
                            <!-- Select day from choices -->
                        
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Start Time Ex:9:30" name="start" required>
                            </div>
                            <!-- Type start time for new class -->
                        
                            <div class="form-group">
                                <select name="sub" id="sub" class = "form-control">
                                    <option value=0>Subject</option>
                                    <?php
                                        $query="SELECT DISTINCT sub from class";
                                        $result=mysqli_query($con,$query);
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value=".$row['sub'].">" . $row['sub'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- Select subjects for the sem from the class table -->

                            <button class="btn btn-default" name="check">Submit</button>
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