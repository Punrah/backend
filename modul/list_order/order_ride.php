
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Hogwheelz Order Ride
          </h1>
         
        </section>

		<?php if($_GET['hal']=='list'){ 

      for($i=1;$i<=12;$i++)
      {
        if($_GET['month']==$i)
        {
          $month.="<option value=$i selected>$i</option>";
        }
        else
        {
          $month.="<option value=$i>$i</option>";
        }
        
      }

      $q=mysql_query("select extract(year from order_date) as year from t_order");
      while($d=mysql_fetch_array($q))
      {
        if($_GET['year']==$d['year'])
        {
           $year.="<option value=$d[year] selected>$d[year]</option>";
        }
        else
        {
          $year.="<option value=$d[year]>$d[year]</option>";
        }
      }
        
    ?>
		<section class="content">
		 <div class="row">
		
		<div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Order Ride</h3>
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="col-md-6">
                  <form method="get" action="">
                  <input type='hidden' name='m' value='order_ride'>
                  <input type='hidden' name='hal' value='list'>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Month</label>
                     <select class="form-control" name="month" required>
                      <?php echo $month; ?>
                      </select>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Year</label>
                     <select class="form-control" name="year" required>
                      <?php echo $year; ?>
                      </select>
                      <div class="err" id="namak"></div>
                    </div>

                    <div class="box-footer">
                  <input type="submit" value="Search" class="btn btn-warning" />
                   </div>
                  </form>
                  </div>
                  </br></br></br></br></br></br></br></br></br></br></br>
				    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>Id Order</th>
              <th>Customer</th>
              <th>Status</th>
              <th>Order Date Time</th>
              <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                   
              </div><!-- /.box -->
          </div>  
		    </div><!-- /.content-wrapper -->
		</section>

		<?php } ?>
		

		
		<?php if($_GET['hal']=='detail'){ 
		$q=mysql_query("select *,(select name from m_driver where id_driver=t.id_driver) as drivername,
      (select url_foto from m_driver where id_driver=t.id_driver) as url_foto,
     (select name from m_customer where id_customer=t.id_customer) as customername,
     (select status from m_status where id_status=t.order_status) as st
      from t_order t inner join t_order_ride r 
      on t.id_order=r.id_order
      where 
      t.id_order='$_GET[id]'");
		$d=mysql_fetch_array($q);
    if($d['id_driver']=='0')
    {
      $foto="tanpafoto.jpg";
      $a="Order Not Yet Accepted by Driver";
    }
    else
    {
      $foto=$d['url_foto'];
    }

		?>
        <!-- Main content Form Jenis Property-->
          <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
              
                  <img class="profile-user-img img-responsive img-circle" src="image/driver_image/<?php echo $foto ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $d['id_driver']; ?></h3>
                  <h4 class="profile-username text-center"><?php echo $d['drivername']; ?></h4>
                  <?php echo $a; ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab">Order Details</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                  <div class="form-group">
                  <label>Order Id :</label></br>
                  <?php echo $d['id_order']; ?>
                  </div>
                  <div class="form-group">
                  <label>Customer :</label></br>
                  <?php echo $d['customername']; ?>
                  </div>
                  <div class="form-group">
                  <label>Origin Address :</label></br>
                  <?php echo $d['address_from']; ?>
                  </div>
                  <div class="form-group">
                  <label>Destination Address :</label></br>
                  <?php echo $d['address_to']; ?>
                  </div>
                  <div class="form-group">
                  <label>Price :</label></br>
                  <?php echo $d['price']; ?>
                  </div>
                  <div class="form-group">
                  <label>Notes :</label></br>
                  <?php echo $d['note']; ?>
                  </div>
                  <div class="form-group">
                  <label>Order Status :</label></br>
                  <?php echo $d['st']; ?>
                  </div>
                  </div><!-- /.tab-pane -->

                 
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->

     		<!-- Modal Popup untuk Hapus Transaks member--> 
          <div id="modal_profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          </div>
		<?php } ?>
				
 <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>

     <script>

	var table = $("#example1").DataTable( {
        "ajax": 'modul/list_order/ajaxData.php?cari=ride&month=<?php echo $_GET[month]?>&year=<?php echo $_GET[year] ?>'
    } );
	      $('.date').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd',
    });

        $(".modal_profile").click(function(e) {
      var a = $(this).attr("id");
       $.ajax({
             url: "modul/driver/modal_profile.php",
             type: "GET",
             data : {id_driver: a,},
             success: function (ajaxData){
               $("#modal_profile").html(ajaxData);
               $("#modal_profile").modal('show',{backdrop: 'true'});
             }
           });
        });
    </script>


