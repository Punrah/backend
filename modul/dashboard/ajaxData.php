<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "anggota";
	anggota();
	break;
	case "transaksi";
	transaksi();
	break;
}
function anggota()
{
	
	$query = mysql_query("SELECT * FROM m_anggota");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			$q=mysql_query("select * from t_anggota where id_anggota='$row[id_anggota]' order by tgl_selesai desc limit 0,1");
			$d=mysql_fetch_array($q);
			if($d['tgl_selesai']<date("Y-m-d"))
			{
				$status="<span class='label label-danger'>Tidak Aktif</span>";
			}
			else
			{
				$status="<span class='label label-success'>Aktif</span>";
			}

				
			$edit="<a href='?m=anggota&hal=profile&id=$row[id_anggota]'><i class='fa fa-profile'></i>$row[id_anggota]</a>";
			 array_push($a, array(
									$no,
									$edit." - ".$status,
									$row['nama'],
									$row['alamat'],
									$row['no_telp'],
									$row['jenis_kelamin']
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
									$row['jenis']
								)
							);
							$no++;

			}
				
			echo "{\"data\":",json_encode($a),"}";
}
?>
