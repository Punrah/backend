<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
switch($act)
{
	case "add_restaurant";
	add_restaurant();
	break;
	case "add_kategori_menu";
	add_kategori_menu();
	break;
	case "add_item";
	add_item();
	break;
	case "add_hours";
	add_hours();
	break;
	case "add_menu_explore";
	add_menu_explore();
	break;
	case "editDriver";
	editDriver();
	break;
	case "updateFoto";
	updateFoto();
	break;


}
	
function add_restaurant()
{
	$up=upload_foto();
	$foto=basename($_FILES["foto"]["name"]);
	if($up=='1')
	{
		$id=date("U");
		$q=mysql_query("INSERT INTO m_restaurant 
			VALUES('$id',
			'$_POST[name]',
			'$_POST[address]',
			'$_POST[long]',
			'$_POST[lat]',
			'$foto',
			'$_POST[phone]')")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=restaurant&hal=list&message=1");
		}
		else
		{
			header("location:../../dashboard.php?m=restaurant&hal=list&message=2");
		}
	}
	else
	{
		header("location:../../dashboard.php?m=restaurant&hal=list&message=3");
	}
	
}
function add_kategori_menu()
{

		$id=date("U");
		$q=mysql_query("INSERT INTO m_kategori_menu 
			VALUES('$id',
			'$_POST[name]')")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=menu_c&hal=list&message=1");
		}
		else
		{
			header("location:../../dashboard.php?m=menu_c&hal=list&message=2");
		}
	
}

function add_item()
{

		$up=upload_foto();
		$foto=basename($_FILES["foto"]["name"]);	
		$id=date("U");
		$q=mysql_query("INSERT INTO m_item
			VALUES('$id',
			'$_POST[name]','$_POST[harga]','$_POST[description]','$foto','$_POST[cat]','$_POST[id]') ")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id]&ms=1");
		}
		else
		{
			header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id]&ms=2");
		}
	
}

function add_hours()
{

		$up=upload_foto();
		$foto=basename($_FILES["foto"]["name"]);	
		$id=date("U");
		$q=mysql_query("INSERT INTO t_restaurant_hours
			VALUES('$_POST[id]','$_POST[date]','$_POST[open]','$_POST[close]') ")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id]&ms=1");
		}
		else
		{
			header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id]&ms=2");
		}
	
}

function add_menu_explore()
{

		$id=date("U");
		$q=mysql_query("INSERT INTO m_kategori_explore 
			VALUES('$id',
			'$_POST[name]')")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=explore_c&hal=list&message=1");
		}
		else
		{
			header("location:../../dashboard.php?m=explore_c&hal=list&message=2");
		}
	
}

function editDriver()
{

		$q=mysql_query("update m_driver 
			set 
			name='$_POST[name]',
			email='$_POST[email]',
			gender='$_POST[jk]',
			phone='$_POST[phone]',
			rekening='$_POST[rekening]',
			tempat_lahir='$_POST[birth_place]',
			tanggal_lahir='$_POST[birth_date]',
			imei='$_POST[imei]',
			biography='$_POST[biography]',
			pin='$_POST[pin]',
			religion='$_POST[religion]',
			address='$_POST[address]',
			uniform='$_POST[uniform]',
			identity_number='$_POST[identity_number]',
			pulsa='$_POST[pulsa]',
			status_mitra='$_POST[status_mitra]',
			status_freeze='$_POST[status_freeze]',
			plat_motor='$_POST[plat]',
			jenis_motor='$_POST[jenis_motor]',
			warna_motor='$_POST[warna_motor]'
			where id_driver='$_POST[id_driver]'")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=driver&hal=profile&id=$_POST[id_driver]&message=1");
		}
		else
		{
			header("location:../../dashboard.php?m=driver&hal=profile&id=$_POST[id_driver]&message=2");
		}
}

function updateFoto()
{
	$q1=mysql_query("select photo from m_restaurant where id_restaurant='$_POST[id_restaurant]'");
	$d=mysql_fetch_array($q1);
	// hapus foto lama
	//unlink("../../image/restaurant_image/$d[url_foto]");
	//upload foto
	$up=upload_foto();
	$foto=basename($_FILES["foto"]["name"]);
	if($up=='1')
	{

		$q=mysql_query("update m_restaurant 
			set 
			photo='$foto'
			where id_restaurant='$_POST[id_restaurant]'")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id_restaurant]");
		}
		else
		{
			header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id_restaurant]&message=2");
		}
	}
	else
	{
		header("location:../../dashboard.php?m=restaurant&hal=detail&id=$_POST[id_restaurant]&message=2");
	}
}



function upload_foto()
	{
	     $target_dir = "../../image/restaurant_image/";
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
