<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- jQuery -->
</head>

<!--End of all CSS includes-->    
<body>
    <div id="wrapper">
		<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Time Table Tracker</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Welcome
                    <?php
                        @session_start();
                        if(isset($_SESSION['sess_username']))
                        {
                            echo " ".$_SESSION['sess_username'];
                        }
                        else
                        {
                            echo "Guest";
                        }
                    ?>
                    <!--End of php script to check if session has been set for Welcome message-->
                    </a>
                </li>
            </ul>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="">
                        <a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
                    </li>
                    

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#view"><i class="fa fa-fw fa-desktop"></i> View <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="view" class="collapse">
                            <li>
                                <a href="currentclass.php">Current Classes</a>
                            </li>
                            <li>
                                <a href="viewbyteacher.php">By Teacher</a>
                            </li>
                            <li>
                                <a href="viewbysem.php">By Sem</a>
                            </li>
                            <li>
                                <a href="viewbycourse.php">By Course</a>
                            </li>
                            <li>
                                <a href="viewbytime.php">By Time</a>
                            </li>
                            <li>
                                <a href="viewbylab.php">By Labs</a>
                            </li>
                        </ul>
                    </li>
                    
                    <?php
                    if (isset($_SESSION['sess_username'])) 
                    {
                    ?>
                        <li>
                        <a href="upload.php"><i class="fa fa-fw fa-upload"></i>Upload</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#download"><i class="fa fa-fw fa-download"></i> Download <i class="fa fa-fw fa-caret-down"></i></a>
                                <ul id="download" class="collapse">
                                    <li>
                                        <a href="downloadsem.php">Download Sem-wise</a>
                                    </li>
                                    <li>
                                        <a href="downloadteach.php">Download Teacher-wise</a>
                                    </li>
                                </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#add"><i class="fa fa-fw fa-table"></i> Add <i class="fa fa-fw fa-caret-down"></i></a>
                                <ul id="add" class="collapse">
                                    <li>
                                        <a href="addnewclass.php">Add New Class</a>
                                    </li>
                                    <li>
                                        <a href="addnewteacher.php">Add New Teacher</a>
                                    </li>
                                </ul>
                        </li>

                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#remove"><i class="fa fa-fw fa-ban"></i> Remove <i class="fa fa-fw fa-caret-down"></i></a>
                                <ul id="remove" class="collapse">
                                    <li>
                                        <a href="removeclass.php">Remove a class</a>
                                    </li>
                                    <li>
                                        <a href="removeteacher.php">Remove a Teacher</a>
                                    </li>
                                                
                                </ul>
                        </li>

                        <li>
                            <a href="edit.php"><i class="fa fa-fw fa-wrench"></i>Edit</a>
                        </li>
                    <?php
                    }
                    else
                    {
                    ?>
                        <li>
                            <a href="login.php"><i class="fa fa-fw fa-lock"></i>Login</a>
                        </li>
                    <?php
                    }
                    ?>
                    <!--End of php script to check if login or logout button should be displayed and login powers choice should be displayed-->
                    
                    
                    <?php
                    if(isset($_SESSION['sess_username']))
                    {
                    ?>             
                    <li>
                        <a href="clear.php"><i class="fa fa-fw fa-file"></i>Clear</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-lock"></i>Logout</a>
                    </li>
                    <?php
                    }
                    ?>
                    <!-- Login power choices to be displayed only if logged in -->
                    <li>
                        <a href="teammembers.php"><i class="fa fa-fw fa-user"></i>Team Members</a>
                    </li>
                                    
                   
                                
                   </ul> 
            </div>
            <!-- /.navbar-collapse -->
        </nav>
         <!-- End of Navigation -->
    </div>
    
     </body>
</html>