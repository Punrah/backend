<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
   date_default_timezone_set('Africa/Johannesburg');
  $datenow=date('Y-m-d H:i:s', time());

switch($act)
{
	case "login";
	login();
	break;
	case "list_order_complete";
	list_order_complete();
	break;
	case "list_order_progress";
	list_order_progress();
	break;
	case "list_order_detail";
	list_order_detail();
	break;
	case "coba_notif";
	coba_notif();
	break;
	case "status_order_start";
	status_order_start();
	break;
	case "status_order_otw";
	status_order_otw();
	break;
	case "status_order_complete";
	status_order_complete();
	break;
	case "getsaldo";
	getsaldo();
	break;
	case "set_status_order_on";
	set_status_order_on();
	break;
	case "set_status_order_off";
	set_status_order_off();
	break;

	case "get_status_order";
	get_status_order();
	break;

	case "total_order";
	total_order();
	break;
	case "total_order_today";
	total_order_today();
	break;
	case "total_order_month";
	total_order_month();
	break;
	case "total_order_week";
	total_order_week();
	break;
	case "skip_order";
	skip_order();
	break;
	case "list_message";
  	list_message();
  	break;
  	case "list_hogpay";
  	list_hogpay();
  	break;
    case "view_ratings";
    view_ratings();
    break;


	
}

function view_ratings()
{

if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("select AVG(rating) rat from t_order where id_driver='$_GET[id_driver]'")or die(mysql_error());
  $d=mysql_fetch_array($q);
  $rating=$d['rat'];
  $rating=round($rating);
  $a = array("status" => "1", "msg" => "Success", "rating" => "$rating");
  
  }
  else
  {
     $a = array("status" => "0", "msg" => "Request method not accepted");
  }


    echo json_encode($a);
}

function list_hogpay()
{

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $q=mysql_query("select * from t_hogpay_driver where id_driver='$_POST[id_driver]'")or die(mysql_error());
  $a=array();
  while($row=mysql_fetch_array($q))
  {

     array_push($a, array(
                  "id_transaksi" => $row['id_transaksi'],
                  "date" => $row['date'],
                  "jenis" => $row['jenis'],
                  "jumlah" => $row['jumlah'],
                  "keterangan" => $row['keterangan']
                )
              );

    }
  }
     
  else
  {
     $a = array("status" => "0", "msg" => "Request method not accepted");
  }


        echo json_encode($a);
}

function list_message()
{

  $q=mysql_query("select * from t_message_driver order by date_post desc")or die(mysql_error());
  $a=array();
  while($row=mysql_fetch_array($q))
  {

     array_push($a, array(
                  "id_message" => $row['id_message'],
                  "date_post" => $row['date_post'],
                  "subject" => $row['subject'],
                  "messages" => $row['messages']
                )
              );

    }


        echo json_encode($a);
}

function skip_order()
{
	if($_SERVER['REQUEST_METHOD'] == "POST"){
  	$q=mysql_query("insert into t_driver_skip_order values('$_POST[id_order]','$_POST[id_driver]','$GLOBALS[datenow]')")or die(mysql_error());

     $json = array("status" => "1", "msg" => "Success");

     include "vendor/autoload.php";
                  $url = 'https://green-tract-151609.firebaseio.com/';
                  $token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
                  $path = '/driver/'.$_POST['id_driver'];

                  $firebase = new \Firebase\FirebaseLib($url, $token);

                  
                  $firebase->delete($path . '/' . $_POST['id_order']);

	}
	else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }

   echo json_encode($json);

 }

function total_order()
{
	if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("select count(id_order) as jumorder from t_order where order_status='3' and id_driver='$_GET[id_driver]'");
  $d=mysql_fetch_array($q);

  $q1=mysql_query("select count(id_order) as jumorder from t_order where order_status='3' and id_driver='$_GET[id_driver]' and DATE(order_date)=DATE('$GLOBALS[datenow]')");
  $d1=mysql_fetch_array($q1);

  $q2=mysql_query("select count(id_order) as jumorder from t_order where order_status='3' and id_driver='$_GET[id_driver]' and 
  	EXTRACT(MONTH from order_date)=EXTRACT(MONTH from '$GLOBALS[datenow]')");
  $d2=mysql_fetch_array($q2);

  $q3=mysql_query("select count(id_order) as jumorder from t_order where order_status='3' and id_driver='$_GET[id_driver]' and 
  	EXTRACT(WEEK from order_date)=EXTRACT(WEEK from '$GLOBALS[datenow]')");
  $d3=mysql_fetch_array($q3);

     $json = array(
      "status" => "1", 
      "msg" => "success",
      "total_order" => $d['jumorder'],
      "total_order_today" => $d1['jumorder'],
       "total_order_month" => $d2['jumorder'],
       "total_order_week" => $d3['jumorder']

      );

	}
	else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }

   echo json_encode($json);

 }






function get_status_order()
{
	if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("select status_mitra from m_driver where id_driver='$_GET[id_driver]'");
  $d=mysql_fetch_array($q);

     $json = array(
      "status" => "1", 
      "msg" => "success",
      "status_order" => $d['status_mitra'] 
      );

	}
	else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }

   echo json_encode($json);

 }

function set_status_order_on()
{
	if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("update m_driver set status_mitra='active' where id_driver='$_GET[id_driver]'");
  $d=mysql_fetch_array($q);

     $json = array(
      "status" => "1", 
      "msg" => "success"
      );

	}
	else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }

   echo json_encode($json);

 }

  function set_status_order_off()
{
	if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("update m_driver set status_mitra='inactive' where id_driver='$_GET[id_driver]'");
  $d=mysql_fetch_array($q);

     $json = array(
      "status" => "1", 
      "msg" => "success"
      );

  }
  
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
   echo json_encode($json);
}

  function getsaldo()
{
  
  if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("select * from m_driver where id_driver='$_GET[id_driver]'");
  $d=mysql_fetch_array($q);

     $json = array(
      "status" => "1", 
      "msg" => "success",
      "saldo" => $d['saldo']
      );

  }
  
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);
}

function coba_notif()
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
        $payload['name'] = "driver1";
        $payload['phone'] = "12";
        $payload['plat'] = "asas";
        $payload['id_driver'] = "121";
        $payload['id_order'] = "12121";

        // notification title
        $title = 'You Have A Notification'; //isset($_GET['title']) ? $_GET['title'] : '';
        
        // notification message
        $message = "asasa";//isset($_GET['message']) ? $_GET['message'] : '';
        
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
            $json = $push->getPush();
            //$regId = $regid;
            $regId = 'd7vYC2NbXyA:APA91bHtWiZyZ0XgFIzweSPOoxPGT7cdyfYpjQrvybK-Il330fQk23P4JilVAlVwtI2eFjWBLj5YlCoYM2GWo6TZBSWe_Lv8LUKAow4BvFB9LGe_pnrx_nyGgeLNV9UvgungbXvCnykm';
           
           
            //isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
            //echo $response;
        }
	 
		 
 
}

function kirim_notif($regid,$id_order,$notif,$order_type,$status)
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
        $payload['id_order'] = $id_order;
        $payload['order_type'] = $order_type;
        $payload['status'] = $status;
        $payload['notif'] = "order";
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
            $json = $push->getPush();
            $regId = $regid;
            //$regId = 'dFIMMDiwmX8:APA91bFUZEpviZ06Zy2dE5H_4cGVyj83GwPfz4GOFQHpNhG8KKJ9Q8yPBO8OdBhBZEym74zxN48dB0wh9RMPHEs9wEl_FolAROzCZRcX0iP491zVBT6qKRdJOCLm1BOn3SdqES9RwUg_';
           
           
            //isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
            //echo $response;
        }
	 
		 
 
}

function kirim_notif_message()
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
        $payload['notif'] = "message";
        $payload['id_message'] = "1";
        $payload['subject'] = "tes";
        $payload['body'] = "assasa sa sa s a sa sas asa sasasas";
        $payload['date'] = "2017/01/13";
        // notification title
        $title = 'You Have a New Message'; //isset($_GET['title']) ? $_GET['title'] : '';
        
        // notification message
        $message = $title;//isset($_GET['message']) ? $_GET['message'] : '';
        
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
            $json = $push->getPush();
            $regId = 'fu8scRUIvEc:APA91bGw69VzzbDLh6SSv9Bz4JFDn7V6aBm2_k-nYGH_pAK9bda0ubDmai2MfGFj2R6u6dBmNZCHDajENH-j0IjLNoFT6Aj3HgCg1hd2GeskBXNEDJsBXT5fuclLYcuH3TW12U82n1HX';
            //$regId = 'dFIMMDiwmX8:APA91bFUZEpviZ06Zy2dE5H_4cGVyj83GwPfz4GOFQHpNhG8KKJ9Q8yPBO8OdBhBZEym74zxN48dB0wh9RMPHEs9wEl_FolAROzCZRcX0iP491zVBT6qKRdJOCLm1BOn3SdqES9RwUg_';
           
           
            //isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
            //echo $response;
        }
	 
		 
 
}


	
function login()
{
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	$q=mysql_query("select * from m_driver where email='$_POST[email]' and pin='$_POST[password]'");
	$cek=mysql_num_rows($q);
	$regid=$_POST['regid'];

	 if($cek>=1){

	 	$d=mysql_fetch_array($q);
	 	$qcek=mysql_query("select * from tb_regid_driver where id_driver='$d[id_driver]'");
		$cekregid=mysql_num_rows($qcek);
		if($cekregid<=0)
		{
	 		$iregid=mysql_query("insert into tb_regid_driver values('$d[id_driver]','$regid')");
	 	}
	 	else
	 	{
	 		$iregid=mysql_query("update tb_regid_driver set regid='$regid' where id_driver='$d[id_driver]'");
	 	}

		 $json = array(
		 	"status" => "1", 
		 	"msg" => "Login!",
		 	"name" => "$d[name]",
		 	"email" => "$d[email]",
		 	"phone" => "$d[phone]",
		 	"plat" => "$d[plat_motor]",
		 	"id_driver" => "$d[id_driver]",
		 	"foto" => "$d[url_foto]",
      "driver_type" => "$d[driver_type]"
		 	);
		 }else{
		 $json = array("status" => "0", "msg" => "Username or Password False !");
		 }
	}

	else
	{
		 $json = array("status" => "0", "msg" => "Request method not accepted");
	}
 
/* Output header */

 echo json_encode($json);
}

function list_order_complete()
{
	$id=$_GET['id_driver']; 
	$q=mysql_query("select *,(select status from m_status where id_status=t_order.order_status) as status from t_order where id_driver='$id' and 
		(order_status='3' or order_status='4') order by order_status_time asc");
	
		$a=array();
			while($row = mysql_fetch_array($q)){
			if($row['order_type']=='1')
			{
				$qride=mysql_query("select address_to from t_order_ride where id_order='$row[id_order]'");
				$dride=mysql_fetch_array($qride);
				$address=$dride['address_to'];
			}
			elseif($row['order_type']=='2')
			{
				$qride=mysql_query("select address_to from t_order_send where id_order='$row[id_order]'");
				$dride=mysql_fetch_array($qride);
				$address=$dride['address_to'];
			}
			elseif($row['order_type']=='3')
			{
				$qride=mysql_query("select address_to from t_order_food where id_order='$row[id_order]'");
				$dride=mysql_fetch_array($qride);
				$address=$dride['address_to'];
			}
			
			 array_push($a, array(
									"id_order" => $row['id_order'],
									"status" => $row['status'],
									"order_date" => $row['order_date'],
									"order_type" => $row['order_type'],
									"address" => $address

								)
							);

			}
				
			echo json_encode($a);

}


function status_order_start()
{
	$id=$_POST['id_order']; 
	$qcs=mysql_query("select id_customer,order_type from t_order where id_order='$id'");
	$dcs=mysql_fetch_array($qcs);
	$q=mysql_query("update t_order set order_status='5',order_status_time='$GLOBALS[datenow]' where id_order='$id'");

	if($q)
	{
		 $qc=mysql_query("select regid from tb_regid_cust where id_customer='$dcs[id_customer]'");
		 $dc=mysql_fetch_array($qc);
		 if($dcs['order_type']=='1')
		 {
		 	$notif="Your Driver Is on The Way With You";
		 }
		 elseif($dcs['order_type']=='2')
		 {
		 	$notif="Your Package Is on The Way to receiver";
		 }
		 elseif ($dcs['order_type']=='3') {
		 	$qr=mysql_query("select id_item from t_order_food_item where id_order='$id'");
		 	$dr=mysql_fetch_array($qr);
		 	$qi=mysql_query("select (select rest_name from m_restaurant where id_restaurant=m.id_restaurant) as rest_name from m_item m where m.id_item='$dr[id_item]'");
		 	$di=mysql_fetch_array($qi);
		 	$rest_name=$di['rest_name'];

		 	$notif="Your Driver as Arriving at $rest_name";
		 }
		 $status="start";
		 kirim_notif($dc['regid'],$id,$notif,$dcs['order_type'],$status);
		 $json = array("status" => "1", "msg" => "Update Success !");
	}
	else
	{
		$json = array("status" => "2", "msg" => "Update Failed !");
	}
	
			
				
	echo json_encode($json);

}

function status_order_otw()
{
	$id=$_POST['id_order'];

	$qcs=mysql_query("select id_customer,order_type from t_order where id_order='$id'");
	$dcs=mysql_fetch_array($qcs); 

	$q=mysql_query("update t_order set order_status='6',order_status_time='$GLOBALS[datenow]' where id_order='$id'");

	if($q)
	{
		$qc=mysql_query("select regid from tb_regid_cust where id_customer='$dcs[id_customer]'");
		 $dc=mysql_fetch_array($qc);

		  if($dcs['order_type']=='1')
		 {
		 	$notif="Your Driver is on the way to your location";
		 }
		 elseif($dcs['order_type']=='2')
		 {
		 	$notif="Your Driver is on the way to location";
		 }
		 elseif ($dcs['order_type']=='3') {
		 	$qr=mysql_query("select id_item from t_order_food_item where id_order='$id'");
		 	$dr=mysql_fetch_array($qr);
		 	$qi=mysql_query("select (select rest_name from m_restaurant where id_restaurant=m.id_restaurant) as rest_name from m_item m where m.id_item='$dr[id_item]'");
		 	$di=mysql_fetch_array($qi);
		 	$rest_name=$di['rest_name'];

		 	$notif="Your Driver is on the way to your location $rest_name";
		 }
		 $status="otw";
		 kirim_notif($dc['regid'],$id,$notif,$dcs['order_type'],$status);
		 $json = array("status" => "1", "msg" => "Update Success !");
	}
	else
	{
		$json = array("status" => "2", "msg" => "Update Failed !");
	}
	
			
				
	echo json_encode($json);

}

function status_order_complete()
{
	$id=$_POST['id_order']; 
	$qcs=mysql_query("select id_customer,order_type,id_driver,payment_type from t_order where id_order='$id'");
	$dcs=mysql_fetch_array($qcs);
	$q=mysql_query("update t_order set order_status='3',order_status_time='$GLOBALS[datenow]' where id_order='$id'");

	if($q)
	{
		$qc=mysql_query("select regid from tb_regid_cust where id_customer='$dcs[id_customer]'");
		 $dc=mysql_fetch_array($qc);
		 
		 if($dcs['order_type']=='1')
		 {
		 	$qprice=mysql_query("select price from t_order_ride where id_order='$id'");
		 	$dprice=mysql_fetch_array($qprice);
		 	$price=$dprice['price'];
		 	$notif="You have been arrived to your destination, thank you for using Hogwheelz";
		 	
		 }
		 elseif($dcs['order_type']=='2')
		 {
		 	$qprice=mysql_query("select price from t_order_send where id_order='$id'");
		 	$dprice=mysql_fetch_array($qprice);
		 	$price=$dprice['price'];
		 	$notif="You package been arrived to destination, thank you for using Hogwheelz";
		 }
		 elseif($dcs['order_type']=='3')
		 {
		 	$qprice=mysql_query("select total_price from t_order_food where id_order='$id'");
		 	$dprice=mysql_fetch_array($qprice);
		 	$price=$dprice['total_price'];
		 	$notif="Your food items have been delivered to you, thank you for using Hogwheelz";
		 }

		 $qupdate=mysql_query("update t_order set order_status_time='$GLOBALS[datenow]' where id_order='$id'");
		 if($dcs['payment_type']=='hogpay')
		 {
		 	if($dcs['order_type']=='1')
		 	{
		 		$pay="Hogride Payment";
		 	}
		 	elseif($dcs['order_type']=='2')
		 	{
		 		$pay="Hogsend Payment";
		 	}
		 	else
		 	{
		 		$pay="Hogfood Payment";
		 	}
		 	$qsaldo1=mysql_query("update m_customer set saldo=saldo-'$price' where id_customer='$dcs[id_customer]'");
		 	$id_transaksi=date("U");
		 	$qhogpay1=mysql_query("insert into t_hogpay_customer values('$id',$dcs[id_customer],'$GLOBALS[datenow]','kredit','$price','$pay')");
		 	$qhogpay2=mysql_query("insert into t_hogpay_driver values('$id',$dcs[id_driver],'$GLOBALS[datenow]','debet','$price','$pay')");
		 }
		 $qsaldo2=mysql_query("update m_driver set saldo=saldo+'$price' where id_driver='$dcs[id_driver]'");

		 $status="complete";

		 kirim_notif($dc['regid'],$id,$notif,$dcs['order_type'],$status);

		 $json = array("status" => "1", "msg" => "Update Success !","price" => $price);
	}
	else
	{
		$json = array("status" => "2", "msg" => "Update Failed !");
	}
	
			
				
	echo json_encode($json);

}





function list_order_progress()
{
	$id=$_GET['id_driver'];
	$q=mysql_query("select *,(select status from m_status where id_status=t_order.order_status) as status  from t_order where id_driver='$id' and 
		(order_status<>'3' and order_status<>'4') order by order_status_time asc");
	
		$a=array();
			while($row = mysql_fetch_array($q)){
			if($row['order_type']=='1')
			{
				$qride=mysql_query("select address_to from t_order_ride where id_order='$row[id_order]'");
				$dride=mysql_fetch_array($qride);
				$address=$dride['address_to'];
			}
			elseif($row['order_type']=='2')
			{
				$qride=mysql_query("select address_to from t_order_send where id_order='$row[id_order]'");
				$dride=mysql_fetch_array($qride);
				$address=$dride['address_to'];
			}
			elseif($row['order_type']=='3')
			{
				$qride=mysql_query("select address_to from t_order_food where id_order='$row[id_order]'");
				$dride=mysql_fetch_array($qride);
				$address=$dride['address_to'];
			}
			
			 array_push($a, array(
									"id_order" => $row['id_order'],
									"status" => $row['status'],
									"id_driver" => $row['id_driver'],
									"order_date" => $row['order_date'],
									"order_type" => $row['order_type'],
									"address" => $address
								)
							);

			}
				
			echo json_encode($a);
}

function list_order_detail()
{
	$id_order=$_GET['id_order'];
	$q=mysql_query("select *,
	(select name from m_customer where id_customer=t_order.id_customer) as cus_name,
	(select phone from m_customer where id_customer=t_order.id_customer) as cus_phone,
	(select status from m_status where id_status=t_order.order_status) as status
	 from t_order where id_order='$id_order'");
	$d=mysql_fetch_array($q);
	if($d['order_type']=='1')
	{
		$qdet=mysql_query("select * from t_order_ride where id_order='$id_order'");
		$det=mysql_fetch_array($qdet);
		$json = array(
			"cus_name" => "$d[cus_name]",
			"cus_phone" => "$d[cus_phone]",
			"status_order" => "$d[status]",
		 	"origin_address" => "$det[address_from]",
		 	"destination_address" => "$det[address_to]",
		 	"price" => "$det[price]",
		 	"note_from" => "$det[note_from]",
      		"note_to" => "$det[note_to]",
		 	"lat_from" => "$det[lat_from]",
		 	"lat_to" => "$det[lat_to]",
		 	"long_from" => "$det[long_from]",
		 	"long_to" => "$det[long_to]",
		 	"distance" => "$det[distance]",
		      "payment_type" => "$d[payment_type]",
		      "order_type" => "1"
		 	);

	}
	elseif($d['order_type']=='2')
	  {
	    $qdet=mysql_query("select * from t_order_send where id_order='$id_order'");
	    $det=mysql_fetch_array($qdet);
	    $json = array(
	      "cus_name" => "$d[cus_name]",
			"cus_phone" => "$d[cus_phone]",
			"status_order" => "$d[status]",
		 	"origin_address" => "$det[address_from]",
		 	"destination_address" => "$det[address_to]",
		 	"price" => "$det[price]",
		 	"note_from" => "$det[note_from]",
      		"note_to" => "$det[note_to]",
		 	"lat_from" => "$det[lat_from]",
		 	"lat_to" => "$det[lat_to]",
		 	"long_from" => "$det[long_from]",
		 	"long_to" => "$det[long_to]",
		 	"distance" => "20",
	      "item_description" => "$det[item_description]",
	      "sender_name" => "$det[sender_name]",
	      "sender_phone" => "$det[sender_phone]",
	      "receiver_name" => "$det[reciver_name]",
	      "receiver_phone" => "$det[reciver_phone]",
	      "distance" => "$det[distance]",
      "payment_type" => "$d[payment_type]",
      "order_type" => "2"
	      );

	  }
	    elseif($d['order_type']=='3')
  {
    $qdet=mysql_query("select * from t_order_food where id_order='$id_order'");
    $det=mysql_fetch_array($qdet);
    $qitem=mysql_query("select *,(select item_name from m_item where id_item=i.id_item) as nama from t_order_food_item i where id_order='$id_order'");
               $item=array();

              while($ditem=mysql_fetch_array($qitem))
              {
                   array_push($item, array(
                        "id_item" => $ditem['id_item'],
                        "item_name" => $ditem['nama'],
                        "price" => $ditem['price'],
                        "quantity" => $ditem['quantity'],
                        "notes" => $ditem['notes']
                      )
                    );
              }

    $json = array(
       "cus_name" => "$d[cus_name]",
			"cus_phone" => "$d[cus_phone]",
			"status_order" => "$d[status]",
		 	"origin_address" => "$det[address_from]",
		 	"destination_address" => "$det[address_to]",
		 	"price" => "$det[price]",
		 	"note_from" => "$det[note_from]",
      		"note_to" => "$det[note_to]",
		 	"lat_from" => "$det[lat_from]",
		 	"lat_to" => "$det[lat_to]",
		 	"long_from" => "$det[long_from]",
		 	"long_to" => "$det[long_to]",
		 	"distance" => "20",
      "origin_address" => "$det[address_from]",
      "destination_address" => "$det[address_to]",
      "price" => "$det[price]",
      "total_price" => "$det[total_price]",
      "note" => "$det[note]",
      "lat_from" => "$det[lat_from]",
      "lat_to" => "$det[lat_to]",
      "long_from" => "$det[long_from]",
      "long_to" => "$det[long_to]",
      "distance" => "$det[distance]",
      "payment_type" => "$d[payment_type]",
      "order_type" => "3",
      "item" => $item
      );
  }
	
	echo json_encode($json);
		

}


?>

