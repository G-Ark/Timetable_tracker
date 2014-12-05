<?php
	$sem=$_POST["sem"];
	$fname=$_FILES['file']['name'];
	if(!isset($fname))
	{
		echo "File not able to upload!Please try again!";
	}
	else if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} 
	else 
	{
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		$temp=$sem."sem_tt".".".$ext;
		$mov=move_uploaded_file($_FILES['file']['tmp_name'],"uploads/$temp");
		
		include 'Classes/PHPExcel/IOFactory.php';
		
		function get_multiple_values($cell_value,$lab_true,$first)
		{
			$inputFileType = 'Excel2007';
			
			$sem=$_POST["sem"];
			$fname=$_FILES['file']['name'];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$temp=$sem."sem_tt".".".$ext;
						
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load("uploads/".$temp);
			$Subject=$objPHPExcel->setActiveSheetIndex(0)->getCell($cell_value)->getValue();
			
			preg_match("/[1-9]/",$cell_value,$row);
			preg_match("/[A-Z]/",$cell_value,$col);

			if($lab_true==true and $first==false)
			{
				$cols=$col[0]."2";
				$start=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
				$cols=$col[0]+1;
				$end=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			}
			else if($lab_true==true and $first==true)
			{
				$cols=$col[0]."1";
				$start=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
				$temp=$col[0];
				if($temp!='B')
				$cols=++$temp."2";
				else
				$cols="D1";
				$end=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			}
			else if($lab_true==false)
			{
				$cols=$col[0]."1";
				$start=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
				$cols=$col[0]."1";
				$end=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			}
			$cols="A".$row[0];
	//		echo "cols=".$col[0];
	//		echo "<br>";
	//		echo "start_time=".$start;
	//		echo "end_time=".$end; 
					
			$start_time=preg_split("/-/",$start);
			$end_time=preg_split("/-/",$end);
	//		echo "start_time=".$start_time[0];
	//		echo "end_time=".$end_time[1]; 
	//		echo "<br/>";
	
			$Day=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			if($Subject!=NULL)
			{
				$con=mysqli_connect("localhost","root","","timetable");
				if(preg_match("/[\/]/",$Subject))
				{
					$list=preg_split("/[\/]/",$Subject);
					foreach($list as $sub)
					{
	//					echo "INSERT into class VALUES('$sem','$sub','$start_time[0]','$end_time[1]','$Day'); for Electives";
						$query="INSERT into class VALUES('$sem','$sub','$start_time[0]','$end_time[1]','$Day');";
						mysql_query($query);
					}
				}
				else if(preg_match("/[\&]/",$Subject))
				{
					$temp=preg_split("/[\&]/",$Subject);
					foreach($temp as $base)
					{
						$list=preg_split("/[\(\,\)]/",$base);
						$subject=$list[0];
						$batch=$list[1];
						$batch1=$list[2];
						$Subject=$subject."(".$batch.")";
						$query="INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day');";
						mysqli_query($con,$query);	
	//					echo "INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day'); for lab split1";
						
						$Subject=$subject."(".$batch1.")";
						$query="INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day');";
						mysqli_query($con,$query);	
	//					echo "INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day'); for lab split2";
					} 
				}
				else
				{
					$query="INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day');";
					mysqli_query($con,$query);
	//				echo "INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day'); for ordinary";
				}
			}
		}
//		echo "To start teacher uplods";
		$cols=array("B","C","E","F","H","I");
		$num=array("3","4","5","6","7","8");
		$first=false;
		for($j=0;$j<6;$j++)
		{
			$lab_true=false;
			for($i=0;$i<6;$i++)
			{
				if($first==true)
				{
					$first=false;
					if($i<5)
					$i++;
					else 
					continue;
				}
				$inputFileType = 'Excel2007';
				$sem=$_POST["sem"];
				$fname=$_FILES['file']['name'];
				$ext = pathinfo($fname, PATHINFO_EXTENSION);
				$temp=$sem."sem_tt".".".$ext;
				$lab_true=false;
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load("uploads/".$temp);
/*			
			echo "cols[$i]=".$cols[$i];
			echo "          num[$j]".$num[$j]."         ";
			echo "<br/>";
	*/		
				$cellmax=$cols[$i]."".$num[$j];
				foreach($objPHPExcel->setActiveSheetIndex(0)->getMergeCells() as $range) 
				{
					if ($objPHPExcel->setActiveSheetIndex(0)->getCell($cellmax)->isInRange($range)) 
					{
						$lab_true=true;
						$first=true;
						break;
					}
					else
						$first=false;
				}
//				echo "clling mltiple values";
				get_multiple_values($cellmax,$lab_true,$first);
			}
		}
		function teacher_uploads($num)
		{
			$inputFileType = 'Excel2007';
			$sem=$_POST["sem"];
			$fname=$_FILES['file']['name'];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$temp=$sem."sem_tt".".".$ext;
						
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load("uploads/".$temp);
			$sub="A".$num;
			$tea="B".$num;
			$Subject = $objPHPExcel->setActiveSheetIndex(1)->getCell($sub)->getValue();
			$Teacher = $objPHPExcel->setActiveSheetIndex(1)->getCell($tea)->getValue();
			if($Subject!=NULL && $Teacher!=NULL)
			{
				 $con=mysqli_connect("localhost","root","","timetable");
				if(preg_match("/Lab/",$Subject))
				{
					$lab=preg_split("/Lab/",$Subject);
					$lab[0]=trim($lab[0]);
					$temp=$lab[0];
					$temp=str_replace(' ','', $temp);
					$lab[0]=$temp;
					$temp=$lab[1];
					$temp=str_replace(' ','', $temp);
					$temp=str_replace('-','', $temp);
					$temp=str_replace(' ','', $temp);
					$lab[1]=$temp;
					$lab[1]=trim($lab[1]);
					$Subject=$lab[0]."(".$lab[1].")";
	//				echo $Subject."&nbsp";
					$lab=preg_split("/[+]/",$Teacher);
					foreach($lab as $base)
					{
						$query="INSERT into handles VALUES('$Subject','$base','$sem');";
						mysqli_query($con,$query);
			
					}
				}
				else
				$query="INSERT into handles VALUES('$Subject','$Teacher','$sem');";
				mysqli_query($con,$query);
			}
		}
		$inputFileType = 'Excel2007';
		$sem=$_POST["sem"];
		$fname=$_FILES['file']['name'];
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		$temp=$sem."sem_tt".".".$ext;
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load("uploads/".$temp);
		$lastRow = $objPHPExcel->setActiveSheetIndex(1)->getHighestRow();
		for($j=2;$j<=$lastRow;$j++)
		{
			teacher_uploads($j);
		}
		
		$con=mysqli_connect("localhost","root","","timetable");
		$query="select c1.sem,c1.sub,c1.start_time,c1.end_time,c1.day,c2.start_time as start,c2.end_time as end from class as c1,class as c2 where c1.sem=c2.sem and c1.sub=c2.sub and c1.start_time=c2.end_time and c1.day=c2.day;";

		$result1=mysqli_query($con,$query);
//		echo "drooppingl";
		if($result1 === FALSE) 
	{
		die(mysqli_error()); // TODO: better error handling
	}
//		echo "Updating database...Please wait.";			
/*	if(isset($result1) and $result1 != FALSE)
	{	
		$num_rows = $result1->num_rows;
		if($num_rows>0)
		{
			while($row=mysqli_fetch_assoc($result1))
			{
				$sem=$row['sem'];
				$sub=$row['sub'];
				$old_beg=$row['start_time'];
				$new_end=$row['end_time'];
				$day=$row['day'];
				$new_beg=$row['start'];
				$old_end=$row['end'];
			$query1="delete from class where sem='$sem' and sub='$sub' and start_time='$old_beg' and end_time='$new_end' and day='$day';";
				$result2=mysqli_query($con,$query1) or die(mysql_error());
			$query1="delete from class where sem='$sem' and sub='$sub' and start_time='$new_beg' and end_time='$old_end' and day='$day';";
				$result2=mysqli_query($con,$query1) or die(mysql_error());
			$query2="insert into class values('$sem','$sub','$new_beg','$new_end','$day');";
				$result2=mysqli_query($con,$query2) or die(mysql_error());
			}
		}
		echo "drooppingldg";
	}*/
		echo "Updating database...Please wait.";
	}
	//echo "Updating database1...Please wait.";
	header('Refresh:1,url= index.php');
?> 