<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
switch($act)
{
	case "coba";
	coba();
	break;
	case "editDriver";
	editDriver();
	break;
	case "updateFoto";
	updateFoto();
	break;


}
	
function coba()
{
		include "vendor/autoload.php";
	 $url = 'https://green-tract-151609.firebaseio.com/';
$token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
$path = '/driver/1';

$firebase = new \Firebase\FirebaseLib($url, $token);

// --- storing an array ---
$test = array(
    "destinationAddress" => "asas",
    "destinationLat" => 1121,
    "destinationLng" => 2323,
    "distance" => 5,
    "orderId" => "2121",
    "orderType" => 1,
    "originAddress" => "ASAS",
    "originLat" => 11,
    "originLng" => 121,
    "price" => 121
);
$customerId ="sasasa";
$firebase->set($path . '/' . $customerId, $test);
	
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
	$q1=mysql_query("select url_foto from m_driver where id_driver='$_POST[id_driver]'");
	$d=mysql_fetch_array($q1);
	// hapus foto lama
	unlink("../../image/driver_image/$d[url_foto]");
	//upload foto
	$up=upload_foto();
	$foto=basename($_FILES["foto"]["name"]);
	if($up=='1')
	{

		$q=mysql_query("update m_driver 
			set 
			url_foto='$foto'
			where id_driver='$_POST[id_driver]'")or die(mysql_error());

		

		if($q)
		{
			header("location:../../dashboard.php?m=driver&hal=profile&id=$_POST[id_driver]");
		}
		else
		{
			header("location:../../dashboard.php?m=driver&hal=profile&id=$_POST[id_driver]&message=2");
		}
	}
	else
	{
		header("location:../../dashboard.php?m=driver&hal=profile&id=$_POST[id_driver]&message=2");
	}
}



function upload_foto()
	{
	     $target_dir = "../../image/driver_image/";
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
