
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Hogwheelz Driver
          </h1>
         
        </section>

		<?php if($_GET['hal']=='list'){ ?>
		<section class="content">
		 <div class="row">
		
		<div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Driver</h3>
                </div><!-- /.box-header -->
                  <div class="box-body">
				    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>Id Driver</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Driver Type</th>
              <th>Status Mitra</th>
              <th>Status Freeze</th>
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
		
		
		<?php if($_GET['hal']=='tambah'){ 
		?>
        <!-- Main content Form Jenis Property-->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Driver</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
				<form role="form" enctype="multipart/form-data" method="post" id="" action="modul/driver/action.php?aksi=addDriver">
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
				   <div class='col-md-4'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Name</label>
                      <input type="text" class="form-control" name="name" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Phone</label>
                      <input type="text" class="form-control" name="phone" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control" name="email" placeholder="" >
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* gender</label>
                      <select class="form-control" name="jk" required>
                      <option value='L'>Man</option>
                      <option value='P'>Woman</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Driver Type</label>
                      <select class="form-control" name="vehicle" required>
                      <option value='bike'>Motorcycle</option>
                      <option value='car'>Car</option>
                      </select>
                    </div>
                    <div class="form-group">
                    <?php 
                      $q=mysql_query("select * from m_agama");
                      while($d=mysql_fetch_array($q))
                      {
                        $rl.="<option value='$d[id_agama]'>$d[agama]</option>";
                      }
                    ?>
                      <label for="exampleInputEmail1">* Religion</label>
                      <select class="form-control" name="religion" required>
                      <?php echo $rl; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Address</label>
                      <textarea type="text" class="form-control" name="address" placeholder="" required></textarea>
                      <div class="err" id="namak"></div>
                    </div>
                     
                    
					</div>
           <div class='col-md-4'>
           <div class="form-group">
                      <label for="exampleInputEmail1">* biography</label>
                      <textarea type="text" class="form-control" name="biography" placeholder="" required></textarea>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Birth Place</label>
                      <input type="text" class="form-control" name="birth_place" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Birth Date</label>
                      <input type="text" class="form-control date" name="birth_date" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Identity Number</label>
                      <input type="text" class="form-control" name="identity_number" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* IMEI Phone</label>
                      <input type="text" class="form-control" name="imei" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Pin</label>
                      <input type="password" class="form-control" name="pin" placeholder="Driver Pin for login in mobile application" required>
                      <div class="err" id="namak"></div> 
          </div>

                  </div><!-- /.box-body -->
                  <div class='col-md-4'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Rekening</label>
                      <input type="text" class="form-control" name="rekening" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">* Pulsa</label>
                      <input type="text" class="form-control" name="pulsa" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">* Unfiform</label>
                      <select class="form-control" name="uniform" required>
                      <option value='yes'>Yes</option>
                      <option value='no'>No</option>
                      </select>
                    </div>
          <div class="form-group">

                      <label for="exampleInputEmail1">* Nomor Plat Motor</label>
                      <input type="text" class="form-control" name="plat" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Jenis Motor</label>
                      <input type="text" class="form-control" name="jenis_motor" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Warna Motor</label>
                      <input type="text" class="form-control" name="warna_motor" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Choose Photo</label>
                      <input type="file" class="form-control" name="foto" placeholder="" required>
                      <div class="err" id="namak"></div>
                    </div>
          </div>
          <div></br></div>
                  <div class="box-footer">
                     <p class="help-block">*) Cannot be empty</p>
                  <input type="submit" value="Save Data" id="tambah" name="tambah" class="btn btn-primary" />
				  <a class="btn btn-danger" href='?m=driver&hal=list'>back to driver list</a>
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
		
		<?php if($_GET['hal']=='profile'){ 
		$q=mysql_query("select * from m_driver where id_driver='$_GET[id]'");
		$d=mysql_fetch_array($q);


		?>
        <!-- Main content Form Jenis Property-->
          <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
              
                  <img class="profile-user-img img-responsive" src="image/driver_image/<?php echo $d['url_foto'] ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $d['id_driver']; ?></h3>
                  <h4 class="profile-username text-center"><?php echo $d['name']; ?></h4>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <strong><i class="fa fa-envelope margin-r-5"></i>Address</strong>
                 <p class="text-muted">
                    <?php echo $d['address']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                                        <strong><i class="fa fa-phone margin-r-5"></i>Phone</strong>
          <p class="text-muted">
                    <?php echo $d['phone']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                                        <strong><i class="fa fa-user margin-r-5"></i>Gender</strong>
          <p class="text-muted">
                    <?php if($d['gender']=='L')
                    {
                      echo '<i class="fa fa-mars" aria-hidden="true"> Man</i>';
                    } 
                    else
                    {
                      echo '<i class="fa fa-venus" aria-hidden="true"> Woman</i>';
                    }

                    ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                    <strong><i class="fa fa-bullhorn margin-r-5"></i>Status</strong>
          <p class="text-muted">
                    <?php if($d['status_mitra']=='inactive')
                    {
                      echo "<span class='label label-danger'>INACTIVE</span> | ";
                    }
                    else
                    {
                      echo "<span class='label label-success'>ACTIVE</span> | ";
                    }

                    if($d['status_freeze']=='freeze')
                    {
                      echo "<span class='label label-info'>FREEZE</span>";
                    }
                    else
                    {
                      echo "<span class='label label-success'>NOT FREEZE</span>";
                    }

                    ?>
                  </p>
                    </li>
                    <a href='#' class='btn btn-primary btn-block modal_profile' id='<?php echo $d[id_driver] ?>'><i class='fa fa-image'></i> Update Photo</a>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab">Update Profile</a></li>
          <li><a href="#activity" data-toggle="tab">Orders</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
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

                  <div class="active tab-pane" id="settings">
                  <?php if($_GET['message']=='1'){ 
                 echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
                 data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Update Succesful</div>';
                 }
                 if($_GET['message']=='2'){ 
                 echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
                 data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Update Error!</div>';
                 }
                 ?>

                  <form role="form" method="post" id="" action="modul/driver/action.php?aksi=editDriver">
                   <div class='col-md-4'>
                   <input type='hidden' name='id_driver' value='<?php echo $d['id_driver'] ?>' />
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Name</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $d['name'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Phone</label>
                      <input type="text" class="form-control" name="phone" value="<?php echo $d['phone'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control" name="email" value="<?php echo $d['email'] ?>" >
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                    <?php 
                    if($d['gender']=='L')
                    {
                      $gender.="
                      <option value='L' selected>Man</option>
                      <option value='P'>Woman</option>
                      ";
                    }
                    else
                    {

                      $gender.="
                      <option value='L'>Man</option>
                      <option value='P' selected>Woman</option>
                      ";
                    }
                    ?>
                      <label for="exampleInputEmail1">* gender</label>
                      <select class="form-control" name="jk" required>
                      <?php echo $gender; ?>
                      </select>
                    </div>

                    <div class="form-group">
                    <?php 
                    if($d['driver_type']=='bike')
                    {
                      $vehicle.="
                      <option value='bike' selected>MotorCycle</option>
                      <option value='car'>Car</option>
                      ";
                    }
                    else
                    {

                      $vehicle.="
                      <option value='bike'>MotorCycle</option>
                      <option value='car' selected>Car</option>
                      ";
                    }
                    ?>
                      <label for="exampleInputEmail1">* Driver Type</label>
                      <select class="form-control" name="vehicle" required>
                      <?php echo $vehicle; ?>
                      </select>
                    </div>

                    <div class="form-group">
                    <?php 
                      $q1=mysql_query("select * from m_agama");
                      while($d1=mysql_fetch_array($q1))
                      {
                        if($d['religion']==$d1['agama'])
                        {
                          $rl.="<option value='$d1[id_agama]' selected>$d1[agama]</option>";
                        }
                        else
                        {
                          $rl.="<option value='$d1[id_agama]'>$d1[agama]</option>";
                        }
                        
                      }
                    ?>
                      <label for="exampleInputEmail1">* Religion</label>
                      <select class="form-control" name="religion" required>
                      <?php echo $rl; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Address</label>
                      <textarea type="text" class="form-control" name="address" placeholder="" required><?php echo $d['address'] ?></textarea>
                      <div class="err" id="namak"></div>
                    </div>
                    
                    
          </div>
           <div class='col-md-4'>
            <div class="form-group">
                      <label for="exampleInputEmail1">* biography</label>
                      <textarea type="text" class="form-control" name="biography" placeholder="" required><?php echo $d['biography'] ?></textarea>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Birth Place</label>
                      <input type="text" class="form-control" name="birth_place" value="<?php echo $d['tempat_lahir'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Birth Date</label>
                      <input type="text" class="form-control date" name="birth_date" value="<?php echo $d['tanggal_lahir'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Identity Number</label>
                      <input type="text" class="form-control" name="identity_number" value="<?php echo $d['identity_number'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* IMEI Phone</label>
                      <input type="text" class="form-control" name="imei" value="<?php echo $d['imei'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Pin</label>
                      <input type="text" class="form-control" name="pin" value="<?php echo $d['pin'] ?>" required>
                      <div class="err" id="namak"></div>
                      
                     

                 
          </div>

                  </div><!-- /.box-body -->
                  <div class='col-md-4'>
                  <div class="form-group">
                      <label for="exampleInputEmail1">* Rekening</label>
                      <input type="text" class="form-control" name="rekening" value="<?php echo $d['rekening'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Pulsa</label>
                      <input type="text" class="form-control" name="pulsa" value="<?php echo $d['pulsa'] ?>" required>
                      <div class="err" id="namak"></div>
                    </div>
                  <div class="form-group">
                  <?php 
                    if($d['uniform']=='yes')
                    {
                      $uf.="
                      <option value='yes' selected>Yes</option>
                      <option value='no'>No</option>
                      ";
                    }
                    else
                    {

                      $uf.="
                      <option value='yes'>Yes</option>
                      <option value='no' selected>No</option>
                      ";
                    }
                    ?>
                      <label for="exampleInputEmail1">* Unfiform</label>
                      <select class="form-control" name="uniform" required>
                      <?php echo $uf; ?>
                      </select>
                    </div>
          <div class="form-group">

                      <label for="exampleInputEmail1">* Nomor Plat Motor</label>
                      <input type="text" class="form-control" name="plat" value="<?php echo $d['plat_motor'] ?>"  required>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Jenis Motor</label>
                      <input type="text" class="form-control" name="jenis_motor" value="<?php echo $d['jenis_motor'] ?>"  required>
                      <div class="err" id="namak"></div>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">* Warna Motor</label>
                      <input type="text" class="form-control" name="warna_motor" value="<?php echo $d['warna_motor'] ?>"  required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                  <?php 
                    if($d['status_mitra']=='active')
                    {
                      $status_mitra.="
                      <option value='active' selected>ACTIVE</option>
                      <option value='inactive'>INACTIVE</option>
                      ";
                    }
                    else
                    {

                      $status_mitra.="
                      <option value='active'>ACTIVE</option>
                      <option value='inactive' selected>INACTIVE</option>
                      ";
                    }
                    ?>
                      <label for="exampleInputEmail1">* Status Mitra</label>
                      <select class="form-control" name="status_mitra" required>
                      <?php echo $status_mitra; ?>
                      </select>
                    </div>
          
          <div class="form-group">
                  <?php 
                    if($d['status_freeze']=='freeze')
                    {
                      $status_freeze.="
                      <option value='freeze' selected>FREEZE</option>
                      <option value='not freeze'>NOT FREEZE</option>
                      ";
                    }
                    else
                    {

                      $status_freeze.="
                      <option value='freeze'>FREEZE</option>
                      <option value='not freeze' selected>NOT FREEZE</option>
                      ";
                    }
                    ?>
                      <label for="exampleInputEmail1">* Status Freeze</label>
                      <select class="form-control" name="status_freeze" required>
                      <?php echo $status_freeze; ?>
                      </select>
                    </div>
          </div>
          <div></br></div>
                  <div class="box-footer">
                     <p class="help-block">*) Cannot be empty</p>
                  <input type="submit" value="Edit Data" id="tambah" name="tambah" class="btn btn-warning" />
                   <a class="btn btn-danger" href='?m=driver&hal=list'>back to driver list</a>
          </br></br>
          <div class="err" id="err"></div>
          </form>
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
        "ajax": 'modul/driver/ajaxData.php?cari=driver'
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


