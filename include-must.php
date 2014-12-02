<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Time Table tracker</title>

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
<body>
    <div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Time Table tracker and generator</a>
            </div>
			<div style="margin-left:45%" class="nacbar-header">
			<a style="margin-top:-5px;" class="navbar-brand" ><img src="images/RVCE_New_Logo1.jpg"></a>
			<a style="margin-top:25px;" class="navbar-brand" >Dept Of ISE</a>
			</div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               <li class="dropdown">
                    <a class="dropdown-toggle"><i class="fa fa-user"></i> Welcome guest </a>
                </li>
            </ul>
			<br/><br/><br/><br/><br/>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Home</a>
                    </li>
					<li>
                        <a href="upload.php"><i class="fa fa-fw fa-edit"></i>Upload</a>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#download"><i class="fa fa-fw fa-arrows-v"></i> Download <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="download" class="collapse">
                            <li>
                                <a href="download.php">Download Sem-wise</a>
                            </li>
							<li>
                                <a href="create.php">Download Teacher-wise</a>
                            </li>
							<li>
                                <a href="#">Download Lab-wise</a>
                            </li>
						</ul>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#add"><i class="fa fa-fw fa-table"></i> Add <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="add" class="collapse">
                            <li>
                                <a href="#">Add New Class</a>
                            </li>
							<li>
                                <a href="#">Add New Teacher</a>
                            </li>
												
						</ul>
					</li>
					<li>
                        <a href="edit.php"><i class="fa fa-fw fa-wrench"></i>Edit</a>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#view"><i class="fa fa-fw fa-desktop"></i> View <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="view" class="collapse">
                            <li>
                                <a href="now.php">Current Classes</a>
                            </li>
							<li>
                                <a href="teacher.php">By Teacher</a>
                            </li>
							<li>
                                <a href="#">By Sem</a>
                            </li>
							<li>
                                <a href="#">By Course</a>
                            </li>
							<li>
                                <a href="#">By Time</a>
							</li>
						</ul>
					</li>
					<li>
                        <a href="tables.html"><i class="fa fa-fw fa-file"></i>Clear</a>
                    </li>
				</ul> 
            </div>
            <!-- /.navbar-collapse -->
        </nav>
         <!-- End of Navigation -->