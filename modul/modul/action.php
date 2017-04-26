<?php
session_start();
    include '../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
switch($act)
{
	case "edit_data";
	edit_data();
	break;
	case "edit_password";
	edit_password();
	break;
	
}
	
function edit_data()
{
	$q=mysql_query("update m_user set username='$_POST[username]',nama_lengkap='$_POST[namalengkap]',email='$_POST[email]',no_telpon='$_POST[telpon]'
	where id_user='$_SESSION[id_user]'");
	if($q)
	{
		$_SESSION['user']=$_POST['username'];
		echo "1";
	}
	else
	{
		echo "0";
	}
}

function edit_password()
{
	$passlama=$_POST['passlama'];
	$passbaru=$_POST['passbaru'];
	$passbaru2=$_POST['passbaru2'];
	$qps=mysql_query("select password from m_user where id_user='$_SESSION[id_user]'");
	$dps=mysql_fetch_array($qps);
	$passlama1=md5($passlama);
	if(($passlama1==$dps['password']) && ($passbaru==$passbaru2))
	{
		$passbaru1=md5($passbaru);
		$q=mysql_query("update m_user set password='$passbaru1' where id_user='$_SESSION[id_user]'");
		if($q)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
}

?>
