
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Hogwheelz Food
          </h1>
         
        </section>

		<?php if($_GET['hal']=='list'){ ?>
		<section class="content">
		 <div class="row">
		
		<div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Menu Category</h3>
                </div><!-- /.box-header -->
                  <div class="box-body">

                  <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Save Succesful</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Save Error!</div>';
           }
           ?>

                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Add Menu Category
                </button>
                  </br></br></br>
				    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>Id Menu Category</th>
              <th>Name</th>
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

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Menu Category</h4>
      </div>
      <div class="modal-body">
      <form role="form" enctype="multipart/form-data" method="post" id="" action="modul/restaurant/action.php?aksi=add_kategori_menu">
      <div class="form-group">
                      <label for="exampleInputEmail1">* Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Menu Name" required>
                      <div class="err" id="namak"></div>
                    </div>
    
                    <p class="help-block">*) Cannot be empty</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Save Data" id="tambah" name="tambah" class="btn btn-primary" />
      </div>
    </div>
    </form>
  </div>
</div>


		<?php } ?>
		
		
		<?php if($_GET['hal']=='edit'){ 
		?>
        <!-- Main content Form Jenis Property-->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Restaurant</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
				<form role="form" enctype="multipart/form-data" method="post" id="" action="modul/restaurant/action.php?aksi=add_restaurant">
                  <div class="box-body">
                  <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Save Succesful</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Save Error!</div>';
           }
           ?>
				   <div class='col-md-6'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Restaurant Name" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Phone</label>
                      <input type="text" class="form-control" name="phone" placeholder="Restaurant Phone" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Address</label>
                      <textarea type="text" class="form-control" name="address" placeholder="Restaurant Address" required></textarea>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Longitude</label>
                      <input type="text" class="form-control" name="long" placeholder="Restaurant Longitude" required>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Latitude</label>
                      <input type="text" class="form-control" name="lat" placeholder="Restaurant Latitude" required>
                      <div class="err" id="namak"></div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">* Photo</label>
                      <input type="file" class="form-control" name="foto" required>
                      <div class="err" id="namak"></div>
                    </div>
                     
                    
		
                  <div class="box-footer">
                     <p class="help-block">*) Cannot be empty</p>
                  <input type="submit" value="Save Data" id="tambah" name="tambah" class="btn btn-primary" />
				  <a class="btn btn-danger" href='?m=restaurant&hal=list'>back to Restaurant list</a>
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
		
		<?php if($_GET['hal']=='detail'){ 
		$q=mysql_query("select * from m_restaurant where id_restaurant='$_GET[id]'");
		$d=mysql_fetch_array($q);


		?>
        <!-- Main content Form Jenis Property-->
          <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
              
                  <img class="profile-user-img img-responsive img-circle" src="image/restaurant_image/<?php echo $d['photo'] ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $d['id_restaurant']; ?></h3>
                  <h4 class="profile-username text-center"><?php echo $d['rest_name']; ?></h4>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <strong><i class="fa fa-envelope margin-r-5"></i>Address</strong>
                 <p class="text-muted">
                    <?php echo $d['rest_address']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                                        <strong><i class="fa fa-phone margin-r-5"></i>Phone</strong>
          <p class="text-muted">
                    <?php echo $d['rest_phone']; ?>
                  </p>
                    </li>
                    <a href='#' class='btn btn-primary btn-block modal_profile' id='<?php echo $d[id_restaurant] ?>'><i class='fa fa-image'></i> Update Photo</a>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#menu" data-toggle="tab">Restaurant Menu</a></li>
                  <li><a href="#open" data-toggle="tab">Open Hours</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="menu">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>Order Id</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">

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
        "ajax": 'modul/restaurant/ajaxData.php?cari=menu_category'
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


