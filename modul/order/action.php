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
	case "register";
	register();
	break;
	case "login_ionic";
	login_ionic();
	break;
	case "register_ionic";
	register_ionic();
	break;
	case "data";
	data();
	break;
	case "request_price";
	request_price();
  break;
	case "request_price_send";
	request_price_send();
	break;
	case "input_order_ride";
	input_order_ride();
  break;
	case "input_order_send";
	input_order_send();
	break;
	case "update_loc";
	update_loc();
	break;
	case "found_driver";
	found_driver();
	break;
	case "send_loc_driver";
	send_loc_driver();
	break;
	case "accept_order";
	accept_order();
	break;
	case "get_ordered_driver_loc";
	get_ordered_driver_loc();
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
	case "coba_nearme";
	coba_nearme();
	break;
	case "coba_recomended";
	coba_recomended();
	break;
	case "coba_explore";
	coba_explore();
	break;
	case "coba_item";
	coba_item();
	break;
	case "list_restaurant";
	list_restaurant();
	break;
  case "cancel_order";
  cancel_order();
  break;
  case "cancel_accepted_order";
  cancel_accepted_order();
  break;
  case "cancel_accepted_order_driver";
  cancel_accepted_order_driver();
  break;
  case "restaurant";
  restaurant();
  break;
  case "getsaldo";
  getsaldo();
  break;
  case "getsaldodriver";
  getsaldodriver();
  break;
  case "getcancelreason";
  getcancelreason();
  break;
  case "cek_token";
  cek_token();
  break;
  case "insert_rating";
  insert_rating();
  break;
  case "explore";
  explore();
  break;
  case "list_restaurant_explore";
  list_restaurant_explore();
  break;
  case "list_restaurant_explore";
  list_restaurant_explore();
  break;
  case "list_hogpay";
  list_hogpay();
  break;
  case "insert_help";
  insert_help();
  break;
  case "insert_help_order";
  insert_help_order();
  break;
  case "callcenter";
  callcenter();
  break;
   case "edit_profile";
  edit_profile();
  break;
  case "cek_token_profile";
  cek_token_profile();
  break;
   case "change_password";
  change_password();
  break;
  case "insert_voucher";
  insert_voucher();
  break;

	
}

function insert_voucher()
{

  if($_SERVER['REQUEST_METHOD'] == "POST"){

  $id_customer=$_POST['id_customer'];
  $voucher=$_POST['voucher'];

    

    $q1=mysql_query("select id_customer from t_voucher where kode_voucher='$voucher'");
    $cek=mysql_num_rows($q1);
    if($cek>=1)
    {
      $json = array("status" => "2", "msg" => "You Have Allready Submit This Voucher");
    }
    else
    {
      $q=mysql_query("select * from m_voucher where kode_voucher='$voucher' and status='active'");
      $cek2=mysql_num_rows($q);
      if($cek2>=1)
      {
        $d=mysql_fetch_array($q);
        if($d['type']=='topup')
        {
          $qupdate=mysql_query("update m_customer set saldo=saldo+'$d[voucher]' where id_customer='$id_customer'");
          $idlog=date("U");
          $qlog=mysql_query("insert into t_voucher values('$idlog','$voucher','$id_customer','$GLOBALS[datenow]')");
          $qhogpay=mysql_query("insert into t_hogpay_customer values('$idlog','$id_customer','$GLOBALS[datenow]','debet','$d[voucher]','Top Up Voucher $voucher')");
          $json = array("status" => "1", "msg" => "Voucher Submit Success!");
        }
      }
      else
      {
        $json = array("status" => "3", "msg" => "Voucher is Invalid or Not Active Anymore");
      }
      
    }
    
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);

}

function list_hogpay()
{

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $q=mysql_query("select * from t_hogpay_customer where id_customer='$_POST[id_customer]'")or die(mysql_error());
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


function change_password()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){

	$id_customer=$_POST['id_customer'];
	$pass1=$_POST['new_password'];
    $pass2=$_POST['old_password'];

    $q=mysql_query("select * from m_customer where id_customer='$id_customer' and pin='$pass2'");
    $cek=mysql_num_rows($q);
    if($cek>=1)
    {
    	$q=mysql_query("update m_customer set pin='$pass1' where id_customer='$id_customer'");
    	$json = array("status" => "1", "msg" => "Password Succesfully Updated");
    }
    else
    {
    	$json = array("status" => "2", "msg" => "Old Password not correct");
    }
    
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);

}

function edit_profile()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){

	$id_customer=$_POST['id_customer'];
	$email=$_POST['email'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];

	$qhp=mysql_query("select phone from m_customer where id_customer='$id_customer'");
	$dhp=mysql_fetch_array($qhp);

	if($dhp['phone']!=$phone)
	{
		include ("nexmo/NexmoMessage.php");
          $nexmo_sms = new NexmoMessage('ace7dd94', 'afe83e72a0d01e9d');
          $token=rand(1111,9999);
          $info = $nexmo_sms->sendText( "$phone", 'HOGWHEELZ', "Helo $name Your Verification Number is $token, please insert to your application immidiately | HOGWHEELZ" );
          $q=mysql_query("update m_customer set verification_code='$token' where id_customer='$id_customer'");
             $json = array("status" => "2", "msg" => "Verification Code");
           
	}
	else
	{
		$q=mysql_query("update m_customer set name='$name',phone='$phone',email='$email' where id_customer='$id_customer'");
		 $json = array("status" => "1", "msg" => "Profile Succesfully Updated");
	}
    
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);

}

function cek_token_profile()
{
	if($_SERVER['REQUEST_METHOD'] == "POST"){

	$id_customer=$_POST['id_customer'];
	$email=$_POST['email'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];

    $q=mysql_query("select * from m_customer where id_customer='$id_customer' and verification_code='$_POST[token]'");
    $cek=mysql_num_rows($q);

     if($cek>=1){
     	$q=mysql_query("update m_customer set name='$name',phone='$phone',email='$email' where id_customer='$id_customer'");
       $json = array("status" => "1", "msg" => "Verification Success");
       }
       else{
       $json = array("status" => "0", "msg" => "Verification Code False");
       }
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);

}



function callcenter()
{
	 $json = array("status" => "1", "nohp" => "+6285935116633");

	 echo json_encode($json);
}

function insert_help()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id_customer=$_POST['id_customer'];
    $kategori=$_POST['kategori'];
    $message=$_POST['message'];
    $id_help=date("U");
    $q=mysql_query("insert into t_customer_help values('$id_help','$id_customer','$kategori','$GLOBALS[datenow]','$message')");

     if($q){
       $json = array("status" => "1", "msg" => "Insert Success");
       }
       else{
       $json = array("status" => "0", "msg" => "Insert Error");
       }
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);

}

function insert_help_order()
{

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id_customer=$_POST['id_customer'];
    $message=$_POST['message'];
    $id_order=$_POST['id_order'];
    $id_help=date("U");
    $q=mysql_query("insert into t_customer_help_order values('$id_help','$id_customer','$id_order','$GLOBALS[datenow]','$message')");

     if($q){
       $json = array("status" => "1", "msg" => "Insert Success");
       }
       else{
       $json = array("status" => "0", "msg" => "Insert Error");
       }
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);

}

function explore()
{
  $q=mysql_query("select * from m_kategori_explore")or die(mysql_error());
  $a=array();
  while($row=mysql_fetch_array($q))
  {

     array_push($a, array(
                  "id_kategori_explore" => $row['id_kategori_explore'],
                  "name" => $row['kategori_explore'],
                  "foto" => $row['foto']
                )
              );

    }

        echo json_encode($a);
}

function list_restaurant_explore()
{

  if($_SERVER['REQUEST_METHOD'] == "POST"){
  $q=mysql_query("select * from m_restaurant where id_restaurant in(select id_restaurant from m_item where id_item in(select t.id_item from t_item_explore t where t.id_kategori_explore='$_POST[id_kategori_explore]'))")or die(mysql_error());
  $a=array();
  while($row=mysql_fetch_array($q))
  {

     array_push($a, array(
                  "id_restaurant" => $row['id_restaurant'],
                  "name" => $row['rest_name'],
                  "address" => $row['rest_address'],
                  "distance" => "10",
                  "photo" => $row['photo']
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

function insert_rating()
{
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id_order=$_POST['id_order'];
    $rating=$_POST['rating'];
    $comment=$_POST['comment'];
    $q=mysql_query("update t_order set rating='$rating',comment='$comment' where id_order='$id_order'");

     if($q){
       $json = array("status" => "1", "msg" => "Insert Rating Success");
       }
       else{
       $json = array("status" => "0", "msg" => "Insert Rating False");
       }
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);
}

function cek_token()
{
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $q=mysql_query("select * from m_customer where id_customer='$_POST[id_customer]' and verification_code='$_POST[token]'");
    $cek=mysql_num_rows($q);

     if($cek>=1){
       $json = array("status" => "1", "msg" => "Verification Success");
       }
       else{
       $json = array("status" => "0", "msg" => "Verification Code False");
       }
   }
  else
  {
     $json = array("status" => "0", "msg" => "Request method not accepted");
  }
 
/* Output header */

 echo json_encode($json);
}

function list_restaurant()
{

  $q=mysql_query("select * from m_restaurant")or die(mysql_error());
  $a=array();
  while($row=mysql_fetch_array($q))
  {

     array_push($a, array(
                  "id_restaurant" => $row['id_restaurant'],
                  "name" => $row['rest_name'],
                  "address" => $row['rest_address'],
                  "distance" => "10",
                  "photo" => $row['photo']
                )
              );

    }

        echo json_encode($a);

}






function restaurant()
{

	$q=mysql_query("select * from m_restaurant where id_restaurant='$_GET[id_restaurant]'");
	
		$a=array();
  
			$row = mysql_fetch_array($q);
      $qc=mysql_query("select distinct id_kategori_menu,(select menu_name from m_kategori_menu where id_kategori_menu=m_item.id_kategori_menu) as menu from m_item where id_restaurant='$row[id_restaurant]'");
        $menu=array();
        while($dqc=mysql_fetch_array($qc))
        {
           $qitem=mysql_query("select * from m_item where id_restaurant='$row[id_restaurant]' and id_kategori_menu='$dqc[id_kategori_menu]'");
               $item=array();

              while($ditem=mysql_fetch_array($qitem))
              {
                   array_push($item, array(
                        "id_item" => $ditem['id_item'],
                        "item_name" => $ditem['item_name'],
                        "price" => $ditem['price'],
                        "photo_item" => $ditem['photo'],
                        "description" => $ditem['description']
                      )
                    );
              }

          array_push($menu, array(
                  "id_menu" => $dqc['id_kategori_menu'],
                  "menu" => $dqc['menu'],
                  "item" => $item
                )
              );
        }

        $hours=array();  
        $open_hours=array();
        $qhours=mysql_query("select * from t_restaurant_hours where id_restaurant='$row[id_restaurant]'");
        while($dhours=mysql_fetch_array($qhours))
        {

          if($dhours['date']==date("l"))
          {
            $open_hours=$dhours['date']." ".$dhours['open_hour']."-".$dhours['close_hour'];
          }

         // $hours.=$dhours['date']." ".$dhours['open_hour']."-".$dhours['close_hour'].",";
          array_push($hours,$dhours['date']." ".$dhours['open_hour']."-".$dhours['close_hour']);
        }

			$a=array(
									"id_restaurant" => $row['id_restaurant'],
									"name" => $row['rest_name'],
									"address" => $row['rest_address'],
									"longitude" => $row['longitude'],
									"latitude" => $row['latitude'],
									"photo" => $row['photo'],
                  "phone" => $row['phone'],
                  "menu" => $menu,
                  "hours_detail" => $hours,
                  "open_hours" => $open_hours
								);

			
				

     echo json_encode($a);
}
function list_order_complete()
{
	$id_customer=$_GET['id_customer'];
	$q=mysql_query("select *,(select status from m_status where id_status=t_order.order_status) as status from t_order where id_customer='$id_customer' and (order_status='3' or order_status='4') order by order_status_time asc");
	
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

function list_order_progress()
{
	$id_customer=$_GET['id_customer'];
	$q=mysql_query("select *,(select status from m_status where id_status=t_order.order_status) as status  from t_order where id_customer='$id_customer' and (order_status<>'3' and order_status<>'4') order by order_status_time asc");
	
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

function list_order_detail()
{
	$id_order=$_GET['id_order'];
	$q=mysql_query("select *,(select name from m_driver where id_driver=t_order.id_driver) as driver_name,
		(select url_foto from m_driver where id_driver=t_order.id_driver) as foto,
		(select status from m_status where id_status=t_order.order_status) as status,
		(select plat_motor from m_driver where id_driver=t_order.id_driver) as plat,
		(select phone from m_driver where id_driver=t_order.id_driver) as driver_phone,
		(select long_cur from m_driver where id_driver=t_order.id_driver) as driver_long,
		(select lat_cur from m_driver where id_driver=t_order.id_driver) as driver_lat,
    (select driver_type from m_driver where id_driver=t_order.id_driver) as vehicle
	 from t_order where id_order='$id_order'");
	$d=mysql_fetch_array($q);
  $qrating=mysql_query("select AVG(rating) rat from t_order where id_driver='$d[id_driver]'");
  $drating=mysql_fetch_array($qrating);
  $rating=round($drating['rat']);
	if($d['order_type']=='1')
	{
		$qdet=mysql_query("select * from t_order_ride where id_order='$id_order'");
		$det=mysql_fetch_array($qdet);
		$json = array(
			"id_driver" => "$d[id_driver]",
      "foto" => "$d[foto]",
			"driver_name" => "$d[driver_name]",
			"plat" => "$d[plat]",
			"driver_lat" => "$d[driver_lat]",
			"driver_long" => "$d[driver_long]",
			"driver_phone" => "$d[driver_phone]",
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
      "vehicle" => "$d[vehicle]",
      "order_type" => "1",
      "rating_driver" => "$rating",
      "rating_order" => "$d[rating]"
		 	);

	}
  elseif($d['order_type']=='2')
  {
    $qdet=mysql_query("select * from t_order_send where id_order='$id_order'");
    $det=mysql_fetch_array($qdet);
    $json = array(
      "id_driver" => "$d[id_driver]",
      "foto" => "$d[foto]",
      "driver_name" => "$d[driver_name]",
      "plat" => "$d[plat]",
      "driver_lat" => "$d[driver_lat]",
      "driver_long" => "$d[driver_long]",
      "driver_phone" => "$d[driver_phone]",
      "status_order" => "$d[status]",
      "origin_address" => "$det[address_from]",
      "destination_address" => "$det[address_to]",
      "price" => "$det[price]",
      "note_to" => "$det[note_to]",
      "note_from" => "$det[note_from]",
      "lat_from" => "$det[lat_from]",
      "lat_to" => "$det[lat_to]",
      "long_from" => "$det[long_from]",
      "long_to" => "$det[long_to]",
      "item_description" => "$det[item_description]",
      "sender_name" => "$det[sender_name]",
      "sender_phone" => "$det[sender_phone]",
      "receiver_name" => "$det[reciver_name]",
      "receiver_phone" => "$det[reciver_phone]",
      "distance" => "$det[distance]",
       "payment_type" => "$d[payment_type]",
      "vehicle" => "$d[vehicle]",
      "order_type" => "2",
      "rating_driver" => "$rating",
      "rating_order" => "$d[rating]"
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
      "id_driver" => "$d[id_driver]",
      "foto" => "$d[foto]",
      "driver_name" => "$d[driver_name]",
      "plat" => "$d[plat]",
      "driver_lat" => "$d[driver_lat]",
      "driver_long" => "$d[driver_long]",
      "driver_phone" => "$d[driver_phone]",
      "status_order" => "$d[status]",
      "origin_address" => "$det[address_from]",
      "destination_address" => "$det[address_to]",
      "price" => "$det[price]",
      "total_price" => "$det[total_price]",
      "note_to" => "$det[note_to]",
      "note_from" => "$det[note_from]",
      "lat_from" => "$det[lat_from]",
      "lat_to" => "$det[lat_to]",
      "long_from" => "$det[long_from]",
      "long_to" => "$det[long_to]",
      "distance" => "$det[distance]",
       "payment_type" => "$d[payment_type]",
      "vehicle" => "$d[vehicle]",
      "order_type" => "3",
      "item" => $item,
      "rating_driver" => "$rating",
      "rating_order" => "$d[rating]"
      );
  }
	
	echo json_encode($json);
		

}

function get_ordered_driver_loc()
{
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$id_driver=$_GET['id_driver'];
		$q=mysql_query("select * from m_driver where id_driver='$id_driver'")or die(mysql_error());
		$d=mysql_fetch_array($q);
		$lat=$d['lat_cur'];
		$long=$d['long_cur'];
		$json = array("status" => "1", "msg" => "Succes Get !","lat" => "$d[lat_cur]","long" => "$d[long_cur]");

	}
	else
	{
		$json = array("status" => "0", "msg" => "Failed Get !");
	}

	 echo json_encode($json);
	

}


function found_driver()
{

	$qidcust=mysql_query("select id_customer from t_order where id_order='1492749690'")or die(mysql_error());
	$dreg=mysql_fetch_array($qidcust);
	// merubah status dan id driver
	$q=mysql_query("update t_order set order_status='2',id_driver='1480997953' where id_order='1492749690'")or die(mysql_error());
  	// cari registration ID untuk notifikasi 
		$qregid=mysql_query("select regid from tb_regid_cust where id_customer='$dreg[id_customer]'")or die(mysql_error());
		$d=mysql_fetch_array($qregid);
		$regid=$d[regid];
		// cari identitas driver
		$qdriver=mysql_query("select * from m_driver where id_driver='1480997953'")or die(mysql_error());;
		$redriver=mysql_fetch_array($qdriver);
		$driver_name=$redriver['name'];
		$driver_phone=$redriver['phone'];
		$driver_plat=$redriver['plat_motor'];
		$id_driver="1480997953";
		$id_order="1486104818";
    $order_type='1';

		$notif="Driver Found";
		if($q)
		{
			kirim_notif($regid,$notif,$driver_name,$driver_phone,$driver_plat,$id_driver,$id_order,$order_type,'accept');
		}
		
}
function kirim_notif($regid,$notif,$driver_name,$driver_phone,$driver_plat,$id_driver,$id_order,$order_type,$status)
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
        $payload['name'] = $driver_name;
        $payload['phone'] = $driver_phone;
        $payload['plat'] = $driver_plat;
        $payload['id_driver'] = $id_driver;
        $payload['id_order'] = $id_order;
        $payload['order_type'] = $order_type;
        $payload['status'] = $status;

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

function kirim_notif_cancel($regid,$id_order,$notif,$order_type)
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

function kirim_notif_ride($regid,$id_customer,$id_order,$customer_name,$add_from,$add_to,$lat_from,$lat_to,$long_from,$long_to,$customer_phone,$order_date,$price,$note)
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
        $payload['name'] = $customer_name;
        $payload['phone'] = $customer_phone;
        $payload['add_from'] = $add_from;
        $payload['add_to'] = $add_to;
        $payload['id_order'] = $id_order;
        $payload['long_from'] = $long_from;
        $payload['long_to'] = $long_to;
        $payload['lat_from'] = $lat_from;
        $payload['lat_to'] = $lat_to;
        $payload['order_type'] = 1;
        $payload['order_date'] = $order_date;
        $payload['price'] = $price;
        $payload['note'] = $note;
        $payload['distance'] = 0;
        $payload['status'] = 1;

        $notif="you have a notification";


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
	
function login()
{
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	$q=mysql_query("select * from m_customer where email='$_POST[email]' and pin='$_POST[password]'");
	$cek=mysql_num_rows($q);
	$regid=$_POST['regid'];

	 if($cek>=1){

	 	$d=mysql_fetch_array($q);
	 	$qcek=mysql_query("select * from tb_regid_cust where id_customer='$d[id_customer]'");
		$cekregid=mysql_num_rows($qcek);
		if($cekregid<=0)
		{
	 		$iregid=mysql_query("insert into tb_regid_cust values('$d[id_customer]','$regid')");
	 	}
	 	else
	 	{
	 		$iregid=mysql_query("update tb_regid_cust set regid='$regid' where id_customer='$d[id_customer]'");
	 	}

		 $json = array(
		 	"status" => "1", 
		 	"msg" => "Login!",
		 	"name" => "$d[name]",
		 	"email" => "$d[email]",
		 	"phone" => "$d[phone]",
		 	"id_customer" => "$d[id_customer]"
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


// get saldo customer
function getsaldo()
{
  
  if($_SERVER['REQUEST_METHOD'] == "GET"){
  $q=mysql_query("select * from m_customer where id_customer='$_GET[id_customer]'");
  $d=mysql_fetch_array($q);

     $json = array(
      "status" => "1", 
      "msg" => "success",
      "saldo" => $d['saldo']
      );

      echo json_encode($json);

  }
}

// get saldo customer
function getcancelreason()
{
  $json=array();
  $q=mysql_query("select * from m_cancel_reason");
  while($d=mysql_fetch_array($q)){

    array_push($json, array(
      "id_cancel_reason" => $d['id_cancel_reason'],
      "cancel_reason" => $d['cancel_reason']
                )
              );
   }

      echo json_encode($json);

}

  function getsaldodriver()
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
function register()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//$request = json_decode($postdata);
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
			$id=date("U");

			$qem=mysql_query("select email from m_customer where email='$email' or phone='$phone'");
			$cek=mysql_num_rows($qem);
			if($pass1==$pass2) // cek password
			{
				if($cek<=0) // cek email
				{
          include ("nexmo/NexmoMessage.php");
          $nexmo_sms = new NexmoMessage('ace7dd94', 'afe83e72a0d01e9d');
          $token=rand(1111,9999);
          $info = $nexmo_sms->sendText( "$phone", 'HOGWHEELZ', "Helo $name Your Verification Number is $token, please insert to your application immidiately | HOGWHEELZ" );

					$q=mysql_query("insert into m_customer values('$id','$name','$phone','$email','$pass1','0','$token')");
					if($q)
					{
						 $json_reg = array("status" => "1", "msg" => "Register Success", "id_customer" => "$id");
					}
					else
					{
						 $json_reg = array("status" => "2", "msg" => "Database Error");
					}
				}
				else
				{
					 $json_reg = array("status" => "3", "msg" => "email or phone allready used");
				}
			}
			else
			{
				 $json_reg = array("status" => "4", "msg" => "Password doesn't match");
			}
			
		}
		else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}

/* Output header */

 echo json_encode($json_reg);

}


// dari driver
function cancel_order()
{
  $id=$_POST['id_order'];


  $q=mysql_query("update t_order set order_status='4',order_status_time='$GLOBALS[datenow]' where id_order='$id'");

  if($q)
  {
              
              // hapus order

              $qdr=mysql_query("select * from m_driver d inner join tb_regid_driver t on d.id_driver=t.id_driver");
                while($d=mysql_fetch_array($qdr))
                {

                  include "vendor/autoload.php";
                  $url = 'https://green-tract-151609.firebaseio.com/';
                  $token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
                  $path = '/driver/'.$d['id_driver'];

                  $firebase = new \Firebase\FirebaseLib($url, $token);

                  
                  $firebase->delete($path . '/' . $id_order);

                }

     
     $json = array("status" => "1", "msg" => "Update Success !");
  }
  else
  {
    $json = array("status" => "2", "msg" => "Update Failed !");
  }
  
      
        
  echo json_encode($json);

}
// dari customer
function cancel_accepted_order()
{
  $id=$_POST['id_order'];
    $cancel_reason=$_POST['id_reason'];

  $qcs=mysql_query("select id_driver,order_type from t_order where id_order='$id'");
  $dcs=mysql_fetch_array($qcs); 

  $q=mysql_query("update t_order set order_status='4',order_status_time='$GLOBALS[datenow]' where id_order='$id'");

  if($q)
  {
    $insert_reason=mysql_query("insert into t_order_canceled_customer values('$id','$cancel_reason','$GLOBALS[datenow]')");
    $qc=mysql_query("select regid from tb_regid_driver where id_driver='$dcs[id_driver]'");
     $dc=mysql_fetch_array($qc);
     kirim_notif_cancel($dc['regid'],$id,"Order Canceled",$dcs['order_type']);
     $json = array("status" => "1", "msg" => "Update Success !");
  }
  else
  {
    $json = array("status" => "2", "msg" => "Update Failed !");
  }
  
      
        
  echo json_encode($json);

}

function cancel_accepted_order_driver()
{
  $id=$_POST['id_order'];

  $qcs=mysql_query("select id_customer,order_type from t_order where id_order='$id'");
  $dcs=mysql_fetch_array($qcs); 

  $q=mysql_query("update t_order set order_status='4',order_status_time='$GLOBALS[datenow]' where id_order='$id'");

  if($q)
  {
    $qc=mysql_query("select regid from tb_regid_cust where id_customer='$dcs[id_customer]'");
     $dc=mysql_fetch_array($qc);
     kirim_notif_cancel($dc['regid'],$id,"Order Canceled by Driver",$dcs['order_type']);
     $json = array("status" => "1", "msg" => "Update Success !");
  }
  else
  {
    $json = array("status" => "2", "msg" => "Update Failed !");
  }
  
      
        
  echo json_encode($json);

}

function input_order_ride()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//$request = json_decode($postdata);
		$id_customer = $_POST['id_customer'];
		$id_order=date("U");
		$order_type='1';
		$id_order_ride=date("U");
		$add_from = $_POST['add_from'];
		$add_to = $_POST['add_to'];

		$lat_from = $_POST['lat_from'];
		$lat_to = $_POST['lat_to'];

		$long_from = $_POST['long_from'];
		$long_to = $_POST['long_to'];

		$price = $_POST['price'];
		$note_from = $_POST['note_from'];
    $note_to = $_POST['note_to'];
    $distance = $_POST['distance'];

		$date=date("Y-m-d h:i:sa");

		$type=$_POST['payment_type'];
		$vehicle=$_POST['vehicle'];

		if($type=='hogpay')
		{
			$qceksaldo=mysql_query("select saldo from m_customer where id_customer='$id_customer'");
			$dsaldo=mysql_fetch_array($qceksaldo);
			if($dsaldo['saldo']>=$price){
				$q=mysql_query("insert into t_order values('$id_order','0','$id_customer','$GLOBALS[datenow]','$order_type','1','$GLOBALS[datenow]','hogpay','0','')");
				$q2=mysql_query("insert into t_order_ride values('$id_order_ride','$id_order','$add_from','$add_to','$lat_from','$long_from','$lat_to','$long_to','$price','$note_from','$note_to','$distance')");
			}
			else
			{
				$json_reg = array("status" => "3", "msg" => "Your Balance Not Enough!");
				break;
			}
		}

		else{

			$q=mysql_query("insert into t_order values('$id_order','0','$id_customer','$GLOBALS[datenow]','$order_type','1','$GLOBALS[datenow]','cash','0','')");
		$q2=mysql_query("insert into t_order_ride values('$id_order_ride','$id_order','$add_from','$add_to','$lat_from','$long_from','$lat_to','$long_to','$price','$note_from','$note_to','$distance')");
		}

					

					if($q)
					{

            


						$qcus=mysql_query("select name,phone from m_customer where id_customer='$id_customer'");
						$dcus=mysql_fetch_array($qcus);
						$qdr=mysql_query("select * from m_driver d inner join tb_regid_driver t on d.id_driver=t.id_driver where d.status_mitra='active' and driver_type='$vehicle'");
						while($d=mysql_fetch_array($qdr))
						{

              include "vendor/autoload.php";
               $url = 'https://green-tract-151609.firebaseio.com/';
            $token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
            $path = '/driver'.'/'.$d['id_driver'];

            $firebase = new \Firebase\FirebaseLib($url, $token);

            // --- storing an array ---
            $test = array(
                "destinationAddress" => $add_to,
                "destinationLat" => $lat_to,
                "destinationLng" => $long_to,
                "distance" => "$distance",
                "orderId" => $id_order,
                "orderType" => "1",
                "originAddress" => $add_from,
                "originLat" => $lat_from,
                "originLng" => $long_from,
                "price" => $price,
                "note" => $note
            );
            //$customerId =$id_customer;
            //$id_order=date("U");
            $firebase->set($path . '/' . $id_order, $test);

							//kirim_notif_ride($d['regid'],$id_customer,$id_order,$dcus['name'],$add_from,$add_to,$lat_from,$lat_to,$long_from,$long_to,$dcus['phone'],$date,$price,$note);
						}
						 $json_reg = array("status" => "1", "msg" => "Order process", "id_order" => "$id_order");
						 //found_driver($id_order);
					}
					else
					{
						 $json_reg = array("status" => "2", "msg" => "Database Error");
				
					}
		}
		else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}



 echo json_encode($json_reg);

}

function input_order_send()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//$request = json_decode($postdata);
		$id_customer = $_POST['id_customer'];
		$id_order=date("U");
		$order_type='2';
		$id_order_send=date("U");
		$add_from = $_POST['add_from'];
		$add_to = $_POST['add_to'];

		$lat_from = $_POST['lat_from'];
		$lat_to = $_POST['lat_to'];

		$long_from = $_POST['long_from'];
		$long_to = $_POST['long_to'];

		$price = $_POST['price'];
		$note = $_POST['note'];

		$item=$_POST['description'];
		$sender_name=$_POST['sender_name'];
		$sender_phone=$_POST['sender_phone'];
		$reciver_name=$_POST['receiver_name'];
		$revicer_phone=$_POST['receiver_phone'];

		$type=$_POST['payment_type'];
		$vehicle=$_POST['vehicle'];

    $note_from = $_POST['note_from'];
    $note_to = $_POST['note_to'];
    $distance = $_POST['distance'];

		if($type=='hogpay')
		{
			$qceksaldo=mysql_query("select saldo from m_customer where id_customer='$id_customer'");
			$dsaldo=mysql_fetch_array($qceksaldo);
			if($dsaldo['saldo']>=$price){
				$q=mysql_query("insert into t_order values('$id_order','0','$id_customer','$GLOBALS[datenow]','$order_type','1','$GLOBALS[datenow]','hogpay','0','')");
				$q2=mysql_query("insert into t_order_send values('$id_order_send','$id_order','$add_from','$add_to','$lat_from','$long_from','$lat_to','$long_to','$price','$note_from','$note_to','$item','$sender_name','$sender_phone','$reciver_name','$revicer_phone','$distance')");
			}
			else
			{
				$json_reg = array("status" => "3", "msg" => "Your Balance Not Enough!");
				break;
			}
		}


		
		else{
			$q=mysql_query("insert into t_order values('$id_order','0','$id_customer','$GLOBALS[datenow]','$order_type','1','$GLOBALS[datenow]','cash','0','')");
			$q2=mysql_query("insert into t_order_send values('$id_order_send','$id_order','$add_from','$add_to','$lat_from','$long_from','$lat_to','$long_to','$price','$note_from','$note_to','$item','$sender_name','$sender_phone','$reciver_name','$revicer_phone','$distance')");
		}
					

					if($q)
					{

            $qdr=mysql_query("select * from m_driver d inner join tb_regid_driver t on d.id_driver=t.id_driver where d.status_mitra='active' and driver_type='$vehicle'");
            while($d=mysql_fetch_array($qdr))
            {

						include "vendor/autoload.php";
							 $url = 'https://green-tract-151609.firebaseio.com/';
						$token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
						$path = '/driver'.'/'.$d['id_driver'];

						$firebase = new \Firebase\FirebaseLib($url, $token);

						// --- storing an array ---
						$test = array(
						    "destinationAddress" => $add_to,
						    "destinationLat" => $lat_to,
						    "destinationLng" => $long_to,
						    "distance" => "5",
						    "orderId" => $id_order,
						    "orderType" => "2",
						    "originAddress" => $add_from,
						    "originLat" => $lat_from,
						    "originLng" => $long_from,
						    "price" => $price,
						    "note" => $note,
						    "item_description" => $item,
						    "sender_name" => $sender_name,
						    "sender_phone" => $sender_phone,
						    "receiver_name" => $reciver_name,
						    "receiver_phone" => $revicer_phone,
                "distance" => $distance
						);
						//$customerId =$id_customer;
						//$id_order=date("U");
						$firebase->set($path . '/' . $id_order, $test);
          }
						 $json_reg = array("status" => "1", "msg" => "Order process", "id_order" => "$id_order");
						 //found_driver($id_order);
					}
					else
					{
						 $json_reg = array("status" => "2", "msg" => "Database Error");
				
					}
		}
		else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}



 echo json_encode($json_reg);

}

function accept_order()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//$request = json_decode($postdata);

		$id_order=$_POST['order_id'];
		$id_driver=$_POST['driver_id'];

		// cek order
			$q=mysql_query("select * from t_order where id_order='$id_order' and order_status='1'");
			$cek=mysql_num_rows($q);
			if($cek>=1)
			{
				$qupdate=mysql_query("update t_order set order_status='2',id_driver='$id_driver' where id_order='$id_order'");

						if($qupdate)
						{

              $qdr=mysql_query("select * from m_driver d inner join tb_regid_driver t on d.id_driver=t.id_driver");
                while($d=mysql_fetch_array($qdr))
                {

                  include "vendor/autoload.php";
                  $url = 'https://green-tract-151609.firebaseio.com/';
                  $token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
                  $path = '/driver/'.$d['id_driver'];

                  $firebase = new \Firebase\FirebaseLib($url, $token);

                  
                  $firebase->delete($path . '/' . $id_order);

                }

							$qidcust=mysql_query("select id_customer,order_type from t_order where id_order='$id_order'")or die(mysql_error());
							$dreg=mysql_fetch_array($qidcust);
							$qregid=mysql_query("select regid from tb_regid_cust where id_customer='$dreg[id_customer]'")or die(mysql_error());
							$d=mysql_fetch_array($qregid);
							$regid=$d[regid];
							// cari identitas driver
							$qdriver=mysql_query("select * from m_driver where id_driver='$id_driver'")or die(mysql_error());;
							$redriver=mysql_fetch_array($qdriver);
							$driver_name=$redriver['name'];
							$driver_phone=$redriver['phone'];
							$driver_plat=$redriver['plat_motor'];
							$id_driver=$redriver['id_driver'];
              $order_type=$dreg['order_type'];

							$notif="Driver Found";
              $status='accept';
							if($qupdate)
							{
								kirim_notif($regid,$notif,$driver_name,$driver_phone,$driver_plat,$id_driver,$id_order,$order_type,$status);
							}
		

							 $json_reg = array("status" => "1", "msg" => "Order Accept");
						}
						else
						{
							 $json_reg = array("status" => "2", "msg" => "Database Error");
					
						}
			}
			else
			{
				$json_reg = array("status" => "3", "msg" => "Order Taken");
			}
		
			
		}
		else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}



 echo json_encode($json_reg);

}


function update_loc()
{

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//$request = json_decode($postdata);
		$id_driver = $_POST['id_driver'];
		$long = $_POST['long'];
		$lat = $_POST['lat'];

		

					$q=mysql_query("update m_driver set lat_cur='$lat',long_cur='$long' where id_driver='$id_driver'");
          $q2=mysql_query("select driver_type from m_driver where id_driver='$id_driver'");
          $d=mysql_fetch_array($q2);
           include "vendor/autoload.php";
               $url = 'https://green-tract-151609.firebaseio.com/';
            $token = 'oh6hO7d8yK0W1zA5VfuLLxPkq8kiCD7KsM7tg9Qo';
            $path = '/location_driver'.'/'.$id_driver;

            $firebase = new \Firebase\FirebaseLib($url, $token);

            // --- storing an array ---
            $test = array(
                "lat_cur" => $lat,
                "long_cur" => $long,
                 "type" => $d['driver_type']
            );

            $firebase->set($path,$test);
					if($q)
					{
						 $json_reg = array("status" => "1", "msg" => "Update Success");
					}
					else
					{
						 $json_reg = array("status" => "2", "msg" => "Database Error");
				
					}
		}
		else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}



 echo json_encode($json_reg);

}


function register_ionic()
{

	
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

	 //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$pass1 = $request->psd1;
		$pass2 = $request->psd2;
		$email = $request->email;
		$name = $request->name;
		$phone = $request->phone;
			$id=date("U");

			$qem=mysql_query("select * from m_customer where email='$email' and pin='$pass1'");
			$cek=mysql_num_rows($qem);
			if($pass1==$pass2) // cek password
			{
				if($cek<=0) // cek email
				{
					$q=mysql_query("insert into m_customer values('$id','$name','$phone','$email','$pass1')");
					if($q)
					{
						 $json_reg = array("status" => "1", "id" => "$d[id_customer]");
					}
					else
					{
						 $json_reg = array("status" => "2", "msg" => "Database Error");
					}
				}
				else
				{
					 $json_reg = array("status" => "3", "msg" => "Account Exist");
				}
			}
			else
			{
				 $json_reg = array("status" => "4", "msg" => "Password doesn't match");
			}
			
		}
		else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}

/* Output header */

 echo json_encode($json_reg);

}

function data()
{
	//http://stackoverflow.com/questions/18382740/cors-not-working-php
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
	
	$query = mysql_query("SELECT * FROM m_driver");   
	$a=array();
			while($row = mysql_fetch_array($query)){


			
			 array_push($a, array(
									"name" => $row['name'],
									"email" => $row['email']
								)
							);

			}
				
			echo "{\"records\":",json_encode($a),"}";

   
}

function login_ionic()
{
	
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

	 //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$password = $request->password;
		$email = $request->email;
	$q=mysql_query("select * from m_customer where email='$email' and pin='$password'");
	$cek=mysql_num_rows($q);

	 if($cek>=1){
	 	$d=mysql_fetch_array($q);
		 $json = array(
		 	"status" => "1", 
		 	"msg" => "Login!",
		 	"name" => "$d[name]",
		 	"email" => "$d[email]",
		 	"phone" => "$d[phone]",
		 	"id_customer" => "$d[id_customer]"
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

function request_price()
{
	// Used to output JSON data
header("Access-Control-Allow-Origin: *");   
header("Content-Type: application/json; charset=UTF-8");
	
//$origins="-8.714458,115.173597";
//$destination="-8.712943,115.181168";
$or=$_GET['origins'];
$des=$_GET['destinations'];
$order_type=$_GET['order_type'];
$vehicle=$_GET['vehicle'];

//echo $des;

ini_set("allow_url_fopen", 1);

$json = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$or&destinations=$des&mode=driving&language=en-EN&key=AIzaSyA2kW1ymZmUMRwud8HeAuXmSNcUMwqmMeM");
$obj = json_decode($json);


$distance=$obj->rows[0]->elements[0]->distance->value;
// select harga pengiriman dari order type dan bike
$q=mysql_query("select price_per_km from m_distance_price where order_type='$order_type' and vehicle='bike'");
$d=mysql_fetch_array($q);
$distance_km=$distance/1000;

$price=$distance_km*$d['price_per_km'];

// select harga pengiriman dari order type dan car
$q1=mysql_query("select price_per_km from m_distance_price where order_type='$order_type' and vehicle='car'");
$d1=mysql_fetch_array($q1);

$price_car=$distance_km*$d1['price_per_km'];

if($distance_km<=0)
{
  $json_price = array("status" => "3", "msg" => "error input!");
}
elseif(($vehicle=='bike' && $distance_km<=25) or ($vehicle=='car' && $distance_km<=75))
{
  $json_price = array("status" => "1", "price_bike" => "$price","price_car" => "$price_car", "distance" => $distance_km);
}
else
{
  $json_price = array("status" => "2", "msg" => "distance out of area coverage");
}

 echo json_encode($json_price);

}

function request_price_send()
{
	// Used to output JSON data
header("Access-Control-Allow-Origin: *");   
header("Content-Type: application/json; charset=UTF-8");
	
//$origins="-8.714458,115.173597";
//$destination="-8.712943,115.181168";
$or=$_GET['origins'];
$des=$_GET['destinations'];

//echo $des;

ini_set("allow_url_fopen", 1);

$json = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$or&destinations=$des&mode=driving&language=en-EN&key=AIzaSyA2kW1ymZmUMRwud8HeAuXmSNcUMwqmMeM");
$obj = json_decode($json);


$distance=$obj->rows[0]->elements[0]->distance->value;
$distance_km=$distance/1000;

$price=$distance_km*10000+1000;

$cetak_rp=number_format($price);

$json_price = array("status" => "1", "price" => "$price", "distance" => $distance_km);

 echo json_encode($json_price);

}

function send_loc_driver()
{
	$user_loc=$_GET['loc'];
	$q=mysql_query("select * from m_driver");
	
		$a=array();
			while($row = mysql_fetch_array($q)){


			
			 array_push($a, array(
									"lat_cur" => $row['lat_cur'],
									"long_cur" => $row['long_cur'],
									"vehicle" => $row['driver_type']
								)
							);

			}
				
			echo "{\"records\":",json_encode($a),"}";

	

 
/* Output header */
}






?>

