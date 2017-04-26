<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "message";
	restaurant();
	break;
}
function message()
{
	
	$query = mysql_query("SELECT * FROM t_message_driver");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			$edit="<a href='?m=restaurant&hal=edit&id=$row[id_message]'><i class='fa fa-pencil'></i> Edit</a> | <a href='?m=restaurant&hal=detail&id=$row[id_message]'><i class='fa fa-spoon'></i> Detail</a>";
			 array_push($a, array(
									$row['id_message'],
									$row['date_post'],
									$row['subject'],
									$row['message']
									//$edit
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";

   
}

?>

