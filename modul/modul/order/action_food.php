<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
     date_default_timezone_set('Africa/Johannesburg');
  $datenow=date('Y-m-d H:i:s', time());

switch($act)
{
	case "input_order_food";
	input_order_food();
	break;
	
}

function input_order_food()
{
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //$request = json_decode($postdata);
    $id_customer = $_POST['id_customer'];
    $id_order=date("U");
    $order_type='3';
    $id_order_food=date("U");
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
    $total_price=$_POST['total_price'];

    $item=$_POST['item_json'];

    $date=date("Y-m-d h:i:sa");

    $type=$_POST['payment_type'];

    $vehicle=$_POST['vehicle'];

    if($type=='hogpay')
        {
            $qceksaldo=mysql_query("select saldo from m_customer where id_customer='$id_customer'");
            $dsaldo=mysql_fetch_array($qceksaldo);
            if($dsaldo['saldo']>=$price){
                $q=mysql_query("insert into t_order values('$id_order','0','$id_customer','$GLOBALS[datenow]','$order_type','1','$GLOBALS[datenow]','hogpay','0','')")or die(mysql_error());
                $q2=mysql_query("insert into t_order_food values('$id_order_food','$id_order','$add_from','$add_to','$lat_from','$long_from','$lat_to','$long_to','$price','$note_from','$note_to','$total_price','$distance')");

                $items = json_decode($item);
                foreach($items as $mydata)
                {
                    $q1=mysql_query("insert into t_order_food_item values('$id_order','$mydata->idItem','$mydata->qty','$mydata->notes','$mydata->price')");
                     
                }
            }
            else
            {
                $json_reg = array("status" => "3", "msg" => "Your Balance Not Enough!");
                break;
            }
        }

        else{
              $q=mysql_query("insert into t_order values('$id_order','0','$id_customer','$GLOBALS[datenow]','$order_type','1','$GLOBALS[datenow]','cash','0','')")or die(mysql_error());
                $q2=mysql_query("insert into t_order_food values('$id_order_food','$id_order','$add_from','$add_to','$lat_from','$long_from','$lat_to','$long_to','$price','$note_from','$note_to','$total_price','$distance')");

             	$items = json_decode($item);
    			foreach($items as $mydata)
    		    {
    		    	$q1=mysql_query("insert into t_order_food_item values('$id_order','$mydata->idItem','$mydata->qty','$mydata->notes','$mydata->price')");
    		         
    		    }
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
                "orderType" => "3",
                "originAddress" => $add_from,
                "originLat" => $lat_from,
                "originLng" => $long_from,
                "price" => $price,
                "note" => $note,
                "item" => $items
            );
            $firebase->set($path . '/' . $id_order, $test);
		}
			$json_reg = array("status" => "1", "msg" => "Order process", "id_order" => "$id_order");
		} 
		else
		{
			$json_reg = array("status" => "2", "msg" => "Order Failed", "id_order" => "$id_order");
		} 
         

   }

   else
		{
			 $json_reg = array("status" => "5", "msg" => "Error Parse");
		}

 echo json_encode($json_reg);

}





?>

