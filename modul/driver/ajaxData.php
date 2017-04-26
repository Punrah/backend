<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "driver";
	driver();
	break;
	case "transaksi";
	transaksi();
	break;
}
function driver()
{
	
	$query = mysql_query("SELECT * FROM m_driver");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){


			if($row['status_mitra']=='inactive')
			{
				$status_mitra="<span class='label label-danger'>INACTIVE</span>";
			}
			else
			{
				$status_mitra="<span class='label label-success'>ACTIVE</span>";
			}

			if($row['status_freeze']=='freeze')
			{
				$status_freeze="<span class='label label-info'>FREEZE</span>";
			}
			else
			{
				$status_freeze="<span class='label label-success'>NOT FREEZE</span>";
			}



			$edit="<a href='?m=driver&hal=profile&id=$row[id_driver]'><i class='fa fa-pencil'></i> Profile</a>";
			 array_push($a, array(
									$row['id_driver'],
									$row['name'],
									$row['phone'],
									$row['address'],
									$row['driver_type'],
									$status_mitra,
									$status_freeze,
									$edit
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";

   
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

