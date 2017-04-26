<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "topup";
	topup();
	break;

}
function topup()
{
	$query = mysql_query("SELECT *,(select name from m_customer where id_customer=t.id_customer) as cname FROM t_customer_topup t");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			if($row['status']=='on progress')
			{

			$edit="<a href='?m=topup&hal=accept&id=$row[id_topup]'><i class='fa fa-check'></i> Accept</a> | <a href='?m=topup&hal=cancel&id=$row[id_topup]'><i class='fa fa-warning'></i> Cancel</a>";
		}
		else
		{
			$edit="#";
		}

		$photo="<img src='modul/order/image/$row[foto]' width='200' />";

			 array_push($a, array(
									$no,
									$row['id_customer'],
									$row['cname'],
									$row['account_number'],
									$row['account_name'],
									$row['bank_name'],
									$row['date_transaction'],
									$row['nominal'],
									$photo,
									$row['status'],
									$edit
								)
							);
							$no++;
		}
			
				
			echo "{\"data\":",json_encode($a),"}";

   
}


?>

