<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
switch($act)
{
	case "tambah_user";
	tambah_user();
	break;
	case "ubahanggota";
	ubahanggota();
	break;
	case "hapusanggota";
	hapusanggota();
	break;
	case "data_transaksi";
	data_transaksi();
	break;
	case "p_member";
	p_member();
	break;

}
	
function tambah_user()
{

	$q=mysql_query("INSERT INTO m_user VALUES(id_user,'$_POST[username]','$_POST[password]','$_POST[level]','tanpafoto.jpg')")or die(mysql_error());

	if($q)
	{
		header("location:../../dashboard.php?m=user&hal=list&message=1");
	}
	else
	{
		header("location:../../dashboard.php?m=user&hal=list&message=2");
	}
	
}
function p_member()
{

	$idt=date("U");
	if($_POST['jenis']=='harian')
	{
		$bayar=10000;
		$q2=mysql_query("INSERT INTO t_anggota VALUES('$idt','$_POST[id_anggota]','$_POST[tgl]',date_add('$_POST[tgl]',INTERVAL 1 DAY),'$bayar','$_POST[jenis]')")or die(mysql_error());
	}
	elseif($_POST['jenis']=='bulanan')
	{
		$bayar=50000;
		$q2=mysql_query("INSERT INTO t_anggota VALUES('$idt','$_POST[id_anggota]','$_POST[tgl]',date_add('$_POST[tgl]', INTERVAL 30 DAY),'$bayar','$_POST[jenis]')")or die(mysql_error());
	}
	
	

	if($q2)
	{
		header("location:../../dashboard.php?m=anggota&hal=profile&id=$_POST[id_anggota]&message=3");
	}
	else
	{
		header("location:../../dashboard.php?m=anggota&hal=profile&id=$_POST[id_anggota]&message=2");
	}
	
}
function ubahanggota()
{
	$q=mysql_query("update m_anggota set nama='$_POST[nama]',no_telp='$_POST[telp]',alamat='$_POST[alamat]' where id_anggota='$_POST[id]'")or die(mysql_error());
	if($q)
	{
		header("location:../../dashboard.php?m=anggota&hal=profile&id=$_POST[id]&message=1");
	}
	else
	{
		header("location:../../dashboard.php?m=anggota&hal=profile&id=$_POST[id]&message=1");
	}
}
function hapusanggota()
{
	$q=mysql_query("delete from m_anggota where id_anggota='$_POST[id_anggota]'")or die(mysql_error());
	$q1=mysql_query("delete from t_anggota where id_anggota='$_POST[id_anggota]'")or die(mysql_error());
	if($q)
	{
		header("location:../../dashboard.php?m=anggota&hal=list&message=1");
	}
	else
	{
		header("location:../../dashboard.php?m=anggota&hal=list&message=2");
	}
}
function data_transaksi()
{
	$q=mysql_query("select * from t_anggota where id_transaksi='$_POST[id]'");
	$d=mysql_fetch_array($q);
	?>
	<form method="post" action="modul/anggota/action.php?aksi=hapusanggota">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">ID Transaksi</label>
                  <input type="text" class="form-control" name="id" value="<?php echo $d['id_transaksi'] ?>"; readonly>
                </div>
            

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  <input type="submit" class="btn btn-danger" value="Edit Data">
                </div>
                  </form>

      <?php
}

function upload_foto()
	{
	     $target_dir = "../../image/property/";
		 //$temp= explode(".",$_FILES["foto"]["name"]);
			$newfilename=basename($_FILES["foto"]["name"]);
			$target_file = $target_dir . $newfilename;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["foto"]["tmp_name"]);
				if($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
				//$check = getimagesize($_FILES["bukti"]["tmp_name"]);
				

			// Check if file already exists
			// Allow certain file formats
			/*if($imageFileType != "pdf" ) {
				$uploadOk = 0;
			}*/
			//echo $target_file;
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			$fmessage='3';
			return $fmessage;
			} else {
				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
					$fmessage='1';
					return $fmessage;
				} else {
					$fmessage='2';
					return $fmessage;
				}
			}
	}
?>
