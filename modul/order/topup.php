
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Hog Pay
          </h1>
         
        </section>

		<?php if($_GET['hal']=='list'){ ?>
		<section class="content">
		 <div class="row">
		
		<div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Topup</h3>
                </div><!-- /.box-header -->
                  <div class="box-body">

                  <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Update Succesful</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Update Error!</div>';
           }
           ?>
				    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>No</th>
              <th>Id Customer</th>
              <th>Customer</th>
              <th>Account Number</th>
              <th>Account Name</th>
              <th>Bank Name</th>
              <th>Date Transaction</th>
              <th>Nominal</th>
              <th>Photo</th>
              <th>Status</th>
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
		
		
		<?php if($_GET['hal']=='accept'){ 

      $q = mysql_query("SELECT *,(select name from m_customer where id_customer=t.id_customer) as cname FROM t_customer_topup t where id_topup='$_GET[id]'");
      $d=mysql_fetch_array($q); 

		?>
        <!-- Main content Form Jenis Property-->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Accept Transaction</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
				<form role="form" enctype="multipart/form-data" method="post" id="" action="modul/order/action_topup.php?aksi=acc_customer">
                  <div class="box-body">
            <div class="alert alert-info alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-info"></i>Are You Sure to Accept this transaction?</div>

				   <div class='col-md-6'>
           <input type="hidden" name="id" value="<?php echo $d[id_topup] ?>">
           <input type="hidden" name="id_customer" value="<?php echo $d[id_customer] ?>">
           <input type="hidden" name="nominal" value="<?php echo $d[nominal] ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Customer</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $d[cname]; ?>" readonly>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Date Transaction</label>
                      <input type="text" class="form-control" name="date" value="<?php echo $d[date_transaction]; ?>"  readonly>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <img src='modul/order/image/<?php echo $d[foto]; ?>' width='600'/>
                    </div>
                  <div class="box-footer">
                  <input type="submit" value="Accept Transaction" id="tambah" name="tambah" class="btn btn-primary" />
				  <a class="btn btn-danger" href='?m=topup&hal=list'>back to list</a>
				  </br></br>
				  <div class="err" id="err"></div>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->

            <!-- general form elements disabled -->
             
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->


     		
		<?php } ?>

        <?php if($_GET['hal']=='cancel'){ 

      $q = mysql_query("SELECT *,(select name from m_customer where id_customer=t.id_customer) as cname FROM t_customer_topup t where id_topup='$_GET[id]'");
      $d=mysql_fetch_array($q); 

    ?>
        <!-- Main content Form Jenis Property-->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Cancel Transaction</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
        <form role="form" enctype="multipart/form-data" method="post" id="" action="modul/order/action_topup.php?aksi=cancel_customer">
                  <div class="box-body">
            <div class="alert alert-info alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-info"></i>Are You Sure to Cancel this transaction?</div>

           <div class='col-md-6'>
           <input type="hidden" name="id" value="<?php echo $d[id_topup] ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Customer</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $d[cname]; ?>" readonly>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Date Transaction</label>
                      <input type="text" class="form-control" name="date" value="<?php echo $d[date_transaction]; ?>"  readonly>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <img src='modul/order/image/<?php echo $d[foto]; ?>' width='600'/>
                    </div>
                  <div class="box-footer">
                  <input type="submit" value="Cancel Transaction" id="tambah" name="tambah" class="btn btn-success" />
          <a class="btn btn-danger" href='?m=topup&hal=list'>back to list</a>
          </br></br>
          <div class="err" id="err"></div>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->

            <!-- general form elements disabled -->
             
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->


        
    <?php } ?>
				
 <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <script src="plugins/select2/select2.full.min.js"></script>

    <script src="bootsrap/js/main.js"></script>
    <script src="bootsrap/js/viewer.js"></script>

     <script>

      $(".select2").select2();

	var table = $("#example1").DataTable( {
        "ajax": 'modul/order/ajaxData.php?cari=topup'
    } );
    </script>


