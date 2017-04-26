<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "user";
	user();
	break;
}
function user()
{
	
	$query = mysql_query("SELECT *,(select level from m_level where id_level=m_user.level) as l FROM m_user");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){
				$foto="<img src='image/$row[foto]' width=100 height=100 />";
			 array_push($a, array(
									$no,
									$row['username'],
									$row['password'],
									$row['l'],
									$foto
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
			if($_SESSION['jb']=='admin'){
			$edit="<a href='#' class='modal_hapus' id='$row[id_transaksi]'><i class='fa fa-times'></i> Hapus</a>";
			}
			else
			{
				$edit="-";
			}
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
									$row['jenis'],
									$edit
								)
							);
							$no++;

			}
				
			echo "{\"data\":",json_encode($a),"}";
}
?>
