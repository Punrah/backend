<?php
	session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
switch($cari)
{
	case "restaurant";
	restaurant();
	break;
	case "menu";
	menu();
	break;
	case "menu_category";
	menu_category();
	break;
	case "explore_category";
	explore_category();
	break;
}
function restaurant()
{
	
	$query = mysql_query("SELECT * FROM m_restaurant");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			$edit="<a href='?m=restaurant&hal=edit&id=$row[id_restaurant]'><i class='fa fa-pencil'></i> Edit</a> | <a href='?m=restaurant&hal=detail&id=$row[id_restaurant]'><i class='fa fa-spoon'></i> Detail</a>";
			 array_push($a, array(
									$row['id_restaurant'],
									$row['rest_name'],
									$row['phone'],
									$row['rest_address'],
									$edit
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";

   
}

function menu()
{
	
	$query = mysql_query("SELECT *,(select menu_name from m_kategori_menu where id_kategori_menu=m_item.id_kategori_menu) as cat FROM `m_item` WHERE `id_restaurant`='$_GET[id]' ");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			//$edit="<a href='?m=restaurant&hal=edit&id=$row[id_restaurant]'><i class='fa fa-pencil'></i> Edit</a> | <a href='?m=restaurant&hal=detail&id=$row[id_restaurant]'><i class='fa fa-spoon'></i> Detail</a>";
				$foto="<img width='100' height='100' src='image/restaurant_image/$row[photo]'>";
			 array_push($a, array(
									$no,
									$row['item_name'],
									$row['price'],
									$row['cat'],
									$row['description'],
									$foto
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";

   
}

function menu_category()
{
	
	$query = mysql_query("SELECT * FROM m_kategori_menu");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			$edit="<a href='?m=menu_c&hal=edit&id=$row[id_kategori_menu]'><i class='fa fa-pencil'></i> Edit</a>";
			 array_push($a, array(
									$row['id_kategori_menu'],
									$row['menu_name'],
									$edit
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";

   
}
function explore_category()
{
	
	$query = mysql_query("SELECT * FROM m_kategori_explore");   
	$a=array();
	$no=1;
			while($row = mysql_fetch_array($query)){

			$edit="<a href='?m=menu_c&hal=edit&id=$row[id_kategori_explore]'><i class='fa fa-pencil'></i> Edit</a>";
			 array_push($a, array(
									$row['id_kategori_explore'],
									$row['kategori_explore'],
									$edit
								)
							);
							$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";

   
}

?>

