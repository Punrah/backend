<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "ride";
	ride();
	break;
	case "transaksi";
	transaksi();
	break;
}
function ride()
{
	if(empty($_GET['month']))
	{
		$query = mysql_query("SELECT *,(select name from m_customer where id_customer=t_order.id_customer) as cname,
		(select status from m_status where id_status=t_order.order_status) as st FROM t_order where order_type='1' and extract(month from order_date)=extract(month from now()) and extract(year from order_date)=extract(year from now()) ");   
		$a=array();
		$no=1;
			while($row = mysql_fetch_array($query)){

			$aksi="<a href='?m=order_ride&hal=detail&id=$row[id_order]'><i class='fa fa-pencil'></i> Detail</a>";
			 array_push($a, array(
									$row['id_order'],
									$row['cname'],
									$row['st'],
									$row['order_date'],
									$aksi
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";
		}
		else
		{
			$query = mysql_query("SELECT *,(select name from m_customer where id_customer=t_order.id_customer) as cname,
			(select status from m_status where id_status=t_order.order_status) as st FROM t_order where order_type='1' and extract(month from order_date)='$_GET[month]' and extract(year from order_date)='$_GET[year]' ");   
			$a=array();
			$no=1;
			while($row = mysql_fetch_array($query)){

			$aksi="<a href='?m=order_ride&hal=detail&id=$row[id_order]'><i class='fa fa-pencil'></i> Detail</a>";
			 array_push($a, array(
									$row['id_order'],
									$row['cname'],
									$row['st'],
									$row['order_date'],
									$aksi
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";
		}

   
}
function transaksi()
{
	
	$query = mysql_query("SELECT * FROM t_anggota where id_anggota='$_GET[id]' order by tgl_daftar desc");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){
			//if($_SESSION['jb']=='admin'){
			$edit="<a href='#' class='modal_hapus' id='$row[id_transaksi]'><i class='fa fa-times'></i> Hapus</a>";
			//}
			
			if($row['tgl_selesai']<date("Y-m-d"))
			{
				$status="<span class='label label-danger'>Tidak Aktif</span>";
			}
			else
			{
				$status="<span class='label label-success'>Aktif</span>";
			}
			 array_push($a, array(
									$no,
									date_format(date_create($row['tgl_daftar']),"d-M-Y"),
									date_format(date_create($row['tgl_selesai']),"d-M-Y"),
									$row['bayar'],
									$row['jenis']
								)
							);
							$no++;

			}
				
			echo "{\"data\":",json_encode($a),"}";
}
?>

