<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'Classes/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'Classes/PHPExcel/Writer/Excel2007.php';

//Enable connection to database
$con=mysqli_connect("localhost","root","","timetable");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

//get data from form
$teacher=$_GET['teacher'];
echo "teacher=".$teacher;

	$teacher="%".$teacher."%";
	$query="SELECT * from class where sub IN (select sub from handles where name like '$teacher')";
	$result=mysqli_query($con,$query);

if($result === FALSE) 
{
	die(mysql_error()); // TODO: better error handling
}

//get details out of database
else if(isset($result) and $result != FALSE)
{						
	$num_rows = $result->num_rows;
	if($num_rows>0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$start_time=date('g:i', strtotime($row['start_time']));
			$end_time=date('g:i', strtotime($row['end_time']));
			$subject=$row['sub'];
			$day=$row['day'];
			write_to_file($start_time,$end_time,$day,$subject); //to define a function for this
		}//end while
	}//end num_rows >0 condition
}//end set of result

//function to write
function write_to_file($start,$end,$day,$matter)
{
	$teacher=$_GET['teacher'];
	$fname="PersonalTT/".$teacher.".xlsx";
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load($fname);
	$objPHPExcel->setActiveSheetIndex(0);
	switch($day)
	{
		case 'MON':$row=4;break;
		case 'TUE':$row=5;break;
		case 'WED':$row=6;break;
		case 'THU':$row=7;break;
		case 'FRI':$row=8;break;
		case 'SAT':$row=9;break;
	}

	switch($start)
	{
		case '9:00':$col='B';break;
		case '10:00':$col='C';break;
		case '11:30':$col='E';break;
		case '12:30':$col='F';break;
		case '2:15':$col='H';break;
		case '3:15':$col='I';break;
		
		case '11:15':$col='D';break;
		case '12:05':$col='E';break;
		case '12:55':$col='F';break;
		case '2:20':$col='H';break;
		case '3:10':$col='H';break;
	}
	$cell=$col.$row;
	if(preg_match("/\(/",$matter))
	{
		$cols=$cell;
		$col++;
		$cole=$col.$row;
		$limit=$cols.":".$cole;
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($limit);
	}
	$objPHPExcel->getActiveSheet()->SetCellValue($cell,$matter);
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$fname="PersonalTT/".$teacher.".xlsx";
	$objWriter->save($fname);
}
header("Refresh:0,url=create.php");
?>
<script>
	alert("Your personalised timetable has been added!");
</script>