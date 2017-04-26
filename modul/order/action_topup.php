<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
   date_default_timezone_set('Africa/Johannesburg');
  $datenow=date('Y-m-d H:i:s', time());

switch($act)
{

	case "insert_topup";
	insert_topup();
	break;
	case "transfer_guide";
	transfer_guide();
	break;
  case "term_of_service";
  term_of_service();
  break;
  case "privacy_policy";
  privacy_policy();
  break;
  case "acc_customer";
  acc_customer();
  break;
  case "cancel_customer";
  cancel_customer();
  break;


	
}


function acc_customer()
{
  $q=mysql_query("update t_customer_topup set status='verified' where id_topup='$_POST[id]'");
  $q2=mysql_query("update m_customer set saldo=saldo+$_POST[nominal] where id_customer='$_POST[id_customer]'");
  $id=date("U");
  $qhogpay1=mysql_query("insert into t_hogpay_customer values('$id',$_POST[id_customer],'$datenow','debet','$_POST[nominal]','Hogpay Top Up')");
  kirim_notif($_POST['id_customer'],"Congratulation! Your Topup is Verified");
  if($q)
  {
      header("location:../../dashboard.php?m=topup&hal=list&message=1");
  }
  else
  {
    header("location:../../dashboard.php?m=topup&hal=list&message=2");
  }


}

function cancel_customer()
{
  $q=mysql_query("update t_customer_topup set status='denied' where id_topup='$_POST[id]'");
  kirim_notif($_POST['id_customer'],"Sorry! Your Topup is Denied");
  if($q)
  {
      header("location:../../dashboard.php?m=topup&hal=list&message=1");
  }
  else
  {
    header("location:../../dashboard.php?m=topup&hal=list&message=2");
  }


}

function kirim_notif($id_customer,$notif)
{
  
      // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();

        // optional payload
        $payload = array();
        $payload['id_customer'] = $id_customer;

        // notification title
        $title = 'You Have A Notification'; //isset($_GET['title']) ? $_GET['title'] : '';
        
        // notification message
        $message = $notif;//isset($_GET['message']) ? $_GET['message'] : '';
        
        // push type - single user / topic
        $push_type ='individual';
        
        // whether to include to image or not
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;


        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(TRUE);
        $push->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
          $qregid=mysql_query("select regid from tb_regid_cust where id_customer='$id_customer'");
          $dreg=mysql_fetch_array($qregid);
          $regid=$dreg['regid'];
            $json = $push->getPush();
            $regId = $regid;
            //$regId = 'dFIMMDiwmX8:APA91bFUZEpviZ06Zy2dE5H_4cGVyj83GwPfz4GOFQHpNhG8KKJ9Q8yPBO8OdBhBZEym74zxN48dB0wh9RMPHEs9wEl_FolAROzCZRcX0iP491zVBT6qKRdJOCLm1BOn3SdqES9RwUg_';
           
           
            //isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
            //echo $response;
        }
   
     
 
}

function insert_topup()
{
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//$id=date("U");
  	//$q=mysql_query("insert into t_customer_topup values('$id','$_POST[id_customer]','$_POST[]'")or die(mysql_error());
		//echo $_POST['image'];

		// Get image string posted from Android App
    $base=$_POST['image'];
    // Get file name posted from Android App
      $data = base64_decode($base);

    $im = imagecreatefromstring($data);
    if ($im !== false) {
        header('Content-Type: image/png');
        $id=date("U");
        $filename=date("U").".png";
        imagepng($im,"image/".$filename);
        imagedestroy($im);
        $q=mysql_query("insert into t_customer_topup values('$id','$_POST[id_customer]','$_POST[account_number]','$_POST[account_name]','$_POST[bank_name]','$filename','$_POST[date]','$_POST[transfer_amount]','on progress')");
        $json = array("status" => "1", "msg" => "Success");
    }
    else {
        $json = array("status" => "2", "msg" => "error");
    }

	}
	else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }

   echo json_encode($json);

 }


function transfer_guide()
{


  	$html="<html>
  	<head></head>
  	<body>
  	Transfer Guide
  	</body>
  	</html>";

    echo $html;
  }


function term_of_service()
{


    $html="<html>
    <head></head>
    <body>
    Term Of Service
    </body>
    </html>";

     echo $html;
  }

  function privacy_policy()
{


    $html="<html>
    <head></head>
    <body>
    Privacy Policy
    </body>
    </html>";

     echo $html;
  }


?>

