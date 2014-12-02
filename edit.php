  <script>
    function warning()
    {
        var msg="Confirm Delete?This action is irrevocable!";
        var ch=confirm(msg);
        if (ch==1)
        {
            location.replace("clear_db.php");
//          alert("msg done");      
        }
    }
    function checkAndSubmit()
    {
        if(document.getElementById('sem').selectedIndex>0)
        {
            document.getElementById('loginform').submit();
            alert('Submitting');
        }
    }
    </script>

<?php
	include "include-must.php";
?>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
		include "menu-must.php";
		?>
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
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i>Edit
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
                                <div class="form-group">
                                    <form method="post" action="">
                                    <select class = "form-control" name="sem" id="sem" onclick="checkAndSubmit()">
                                    <option value=0>Sem</option>
                                    <?php           
                                        $query="SELECT distinct sem from class;";
                                        $result=mysqli_query($con,$query);
                                        while ($row=mysqli_fetch_assoc($result)) 
                                         {   
                                             echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                         }
                                    ?>
                                    </select>
                                    </form>
                                </div>
                                <div class="form-group">   
                                    <form method="post" action="">
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
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Start Time Ex:9:30" name="start" required>
                                </div>
                                <div class="form-group">
                                    <select name="sub" id="sub" class = "form-control">
                                    <option value=0>Subject</option>
                                    <?php
                                        $query="SELECT DISTINCT sub from class;";
                                        $result=mysqli_query($con,$query);
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value=".$row['sub'].">" . $row['sub'] . "</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                </form>
                                <button class="btn btn-default" name="check" onclick="checkAndSubmit()">Submit</button>
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
