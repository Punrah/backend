  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
                  <h3 class="box-title">Messages to Driver</h3>
                </div><!-- /.box-header -->
                  <div class="box-body">

                  <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Blast Message Succesful</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Add Message Error!</div>';
           }
           ?>

                  <a class="btn btn-primary" href="?m=message&hal=add">
                  Add Messages
                </a>
                  </br></br></br>
				    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>Id Message</th>
              <th>Date Post</th>
              <th>Subject</th>
              <th>Messages</th>

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
		
		
		<?php if($_GET['hal']=='add'){ 
		?>
        <!-- Main content Form Jenis Property-->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Message</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
				<form role="form" enctype="multipart/form-data" method="post" id="" action="modul/order/action_driver.php?aksi=blast_message">
                  <div class="box-body">
				   <div class='col-md-6'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Subject</label>
                      <input type="text" class="form-control" name="name" placeholder="Restaurant Name" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Message</label>
                       <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            This is my textarea to be replaced with CKEditor.
                    </textarea>
                      <div class="err" id="namak"></div>
                    </div>
                    
		
                  <div class="box-footer">
                     <p class="help-block">*) Cannot be empty</p>
                  <input type="submit" value="Blast Message" id="tambah" name="tambah" class="btn btn-primary" />
				  <a class="btn btn-danger" href='?m=message&hal=list'>back to Message list</a>
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
                  <li><a href="#open" data-toggle="tab">Open/Close Hours</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="menu">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                  Add Menu
                </button>
                </br></br>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Photo</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="open">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">
                  Add open/close Hours
                </button>
                </br></br>
                   <table id="" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Open Hours</th>
                    <th>Close Hours</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 

                     $q=mysql_query("select * from t_restaurant_hours where id_restaurant='$_GET[id]'");
                     $no=1;
                     while($d=mysql_fetch_array($q))
                     {

                      $tr.="<tr>
                      <td>$no</td>
                      <td>$d[date]</td>
                      <td>$d[open_hour]</td>
                      <td>$d[close_hour]</td>
                      </tr>
                      ";
                      $no++;
                     }
                     echo $tr;
                     ?>
                    </tbody>
                  </table>

                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->

               <?php if($_GET['ms']=='1'){ 
           echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Save Succesful</div>';
           }
           if($_GET['ms']=='2'){ 
           echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Save Error!</div>';
           }
           ?>

            </div><!-- /.col -->
          </div><!-- /.row -->

         


        </section><!-- /.content -->

     		<!-- Modal Popup untuk Hapus Transaks member--> 
          <div id="modal_profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          </div>

             <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Menu</h4>
      </div>
      <div class="modal-body">
      <form role="form" enctype="multipart/form-data" method="post" id="" action="modul/restaurant/action.php?aksi=add_item">
      <input type="hidden" name="id" value="<?php echo $_GET[id]; ?>" />
      <div class="form-group">
                      <label for="exampleInputEmail1">* Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Menu Name" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Description</label>
                      <textarea class="form-control" name="description" required></textarea>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Price</label>
                      <input type="text" class="form-control" name="harga" placeholder="Menu Price" required>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Menu Category</label>
                      <select class="form-control" name="cat" required>
                      <?php 
                      $q=mysql_query("select * from m_kategori_menu");
                      while($d=mysql_fetch_array($q))
                      {
                        echo "<option value='$d[id_kategori_menu]'>$d[menu_name]</option>";
                      }
                      ?>
                      </select>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Photo</label>
                      <input type="file" class="form-control" name="foto" required>
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


 <!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel1">Add Open / Close Hours</h4>
      </div>
      <div class="modal-body">
      <form role="form" enctype="multipart/form-data" method="post" id="" action="modul/restaurant/action.php?aksi=add_hours">
      <input type="hidden" name="id" value="<?php echo $_GET[id]; ?>" />
      <div class="form-group">
                      <label for="exampleInputEmail1">* Date</label>
                      <select type="text" class="form-control" name="date" placeholder="Type a Date" required>
                      <option value="Sunday">Sunday</option>
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thrusday">Thrusday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>
                      </select>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Open Hours</label>
                      <input type="time" class="form-control" name="open" placeholder="ex : 08:00:00" required>
                      <div class="err" id="namak"></div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">* Close Hours</label>
                      <input type="time" class="form-control" name="close" placeholder="ex 21:00:00" required>
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
				
 <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <script src="plugins/select2/select2.full.min.js"></script>

     <script>

      $(".select2").select2();

	var table = $("#example1").DataTable( {
        "ajax": 'modul/restaurant/ajaxData.php?cari=restaurant'
    } );
  var table1 = $("#example2").DataTable( {
        "ajax": 'modul/restaurant/ajaxData.php?cari=menu&id=<?php echo $_GET[id] ?>'
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

    <!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>


