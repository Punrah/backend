
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Member Taurus Gym
          </h1>
         
        </section>

		<?php if($_GET['hal']=='list'){ ?>
		<section class="content">
		 <div class="row">
		
		<div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Data User</h3>
                </div><!-- /.box-header -->
                  <div class="box-body">
				   <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Berhasil Menambah Data User</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-close"></i>Gagal Menghapus Data User</div>';
           }
           ?>

				   <a data-target="#tambahUser" data-toggle="modal" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> &nbsp;Tambah</a>
				   </br> </br>

				    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
					    <th>No</th>
              <th>username</th>
              <th>password</th>
              <th>level</th>
              <th>foto</th>

                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                   
              </div><!-- /.box -->
          </div>  
		    </div><!-- /.content-wrapper -->
		</section>
    <!-- Modal Popup untuk Add--> 
<div id="tambahUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
        </div>

        <div class="modal-body">
          <form action="modul/user/action.php?aksi=tambah_user" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Modal Name">Username</label>
                  <input type="text" name="username"  class="form-control" placeholder="Username User" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Modal Name">Password</label>
                  <input type="password" name="password"  class="form-control" placeholder="Password User" required/>
                </div>

                <div class="form-group">
                      <label for="exampleInputEmail1">* Jenis User</label>
                      <select class="form-control" name="level" required>
                      <option value='1'>Admin</option>
                      <option value='2'>Kasir</option>
                      </select>
                    </div>

              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                      Confirm
                  </button>

                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              </div>

              </form>

           

            </div>

           
        </div>
    </div>
</div>

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
                  <h3 class="box-title">Tambah Member</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
				<form role="form" enctype="multipart/form-data" method="post" id="" action="modul/anggota/action.php?aksi=tambahanggota">
                  <div class="box-body">
                  <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Berhasil Menambah Data Member</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Gagal Menambah Data Member</div>';
           }
           ?>
				   <div class='col-md-6'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* No Member</label>
                      <input type="text" class="form-control" name="no" placeholder="No Member..." required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Nama Member</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Member..." required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Jenis Kelamin</label>
                      <select class="form-control" name="jk" required>
                      <option value='L'>Laki - Laki</option>
                      <option value='P'>Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Alamat Member</label>
                      <textarea type="text" class="form-control" name="alamat" placeholder="Alamat Member..." required></textarea>
                      <div class="err" id="namak"></div>
                    </div>
					</div>
           <div class='col-md-6'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* No Telepon Member</label>
                      <input type="text" class="form-control" name="telp" placeholder="No Telepon Member..." required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Tanggal Daftar Member</label>
                      <input type="text" class="form-control date" name="tgl" placeholder="Tanggal Daftar Member..." required>
                      <div class="err" id="namak"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">* Jenis Member</label>
                      <select class="form-control" name="jenis" required>
                      <option value='harian'>Harian</option>
                      <option value='bulanan'>Bulanan</option>
                      </select>
                      <div class="err" id="namak"></div>
                    </div>
          </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                     <p class="help-block">*) Tidak Boleh Kosong</p>
                  <input type="submit" value="Tambah" id="tambah" name="tambah" class="btn btn-primary" />
				  <a class="btn btn-danger" href='?m=anggota&hal=list'>Kembali</a>
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
		$q=mysql_query("select * from m_anggota where id_anggota='$_GET[id]'");
		$d=mysql_fetch_array($q);
    if($d['jenis_kelamin']=='L')
    {
      $gambar="L.png";
    }
    else
    {
      $gambar="P.png";
    }
    
    $q1=mysql_query("select * from t_anggota where id_anggota='$d[id_anggota]' order by tgl_selesai desc limit 0,1");
      $d1=mysql_fetch_array($q1);
      if($d1['tgl_selesai']<date("Y-m-d"))
      {
        $status="<span class='label label-danger'>Tidak Aktif</span> - <a href='#' class='open_modal' id='$d[id_anggota]'><i class='fa fa-calendar-plus-o'></i> Aktifasi</a>";
      }
      else
      {
        $status="<span class='label label-success'>Aktif</span>";
      }


		?>
        <!-- Main content Form Jenis Property-->
          <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
              
                  <img class="profile-user-img img-responsive img-circle" src="image/<?php echo $gambar ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $d['id_anggota']." - ".$d['nama']; ?></h3>
                  <p class="text-muted text-center"><?php echo $status ?></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <strong><i class="fa fa-envelope margin-r-5"></i>Alamat</strong>
                 <p class="text-muted">
                    <?php echo $d['alamat']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                                        <strong><i class="fa fa-phone margin-r-5"></i>No Telepon</strong>
          <p class="text-muted">
                    <?php echo $d['no_telp']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                                        <strong><i class="fa fa-user margin-r-5"></i>Jenis Kelamin</strong>
          <p class="text-muted">
                    <?php echo $d['jenis_kelamin']; ?>
                  </p>
                    </li>
            <?php if($_SESSION['jb']=='admin'){ ?>
            <button id="btnmodal" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal" data-whatever="<?php echo $d['id_anggota'] ?>"><b>Hapus Member</b></button>
            <?php } ?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Data</h4>
                </div>
                <div class="modal-body">
                </br>
                <form method="post" action="modul/anggota/action.php?aksi=hapusanggota">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Yakin Menghapus Data dengan Nomor Member : </label>
                  <input type="text" class="form-control" id="recipient-name" name="id_anggota" readonly>
                </div>
            

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  <input type="submit" class="btn btn-danger" value="Hapus Data">
                </div>
                  </form>
              </div>
            </div>
          </div>

          <!-- Modal Popup untuk perpanjang member--> 
          <div id="pmember" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          </div>
          <!-- Modal Popup untuk Hapus Transaks member--> 
          <div id="dmember" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          </div>
          

             
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Transaksi</a></li>
          <li><a href="#settings" data-toggle="tab">Update Profil</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <?php if($_GET['message']=='1'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Berhasil Mengubah Data Member</div>';
           }
           if($_GET['message']=='2'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Gagal Mengubah Data Member</div>';
           }
           if($_GET['message']=='3'){ 
           echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
           data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-check"></i>Berhasil Menambah Transaksi Member</div>';
           }
           ?>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Selesai</th>
                    <th>Bayar</th>
                    <th>Jenis Member</th>
                    <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="post" action="modul/anggota/action.php?aksi=ubahanggota">
                    <input type="hidden" name="id" value="<?php echo $d['id_anggota']; ?>" />
           <div class="err" id="add"></div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $d['nama']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="alamat" name="alamat" value=""><?php echo $d['alamat']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">No Telpon</label>
                        <div class="col-sm-10">
                       <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $d['no_telp']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" id="ubah" class="btn btn-danger">Ubah Data</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->

     		
		<?php } ?>
				
 <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>

     <script>
    $('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
})

	var table = $("#example1").DataTable( {
        "ajax": 'modul/user/ajaxData.php?cari=user'
    } );
  var table = $("#example2").DataTable( {
        "ajax": 'modul/anggota/ajaxData.php?cari=transaksi&id=<?php echo $_GET[id] ?>'
    } );
	      $('.date').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd',
    });
    </script>

    <!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modul/anggota/modal_pmember.php",
             type: "GET",
             data : {modal_id: m,},
             success: function (ajaxData){
               $("#pmember").html(ajaxData);
               $("#pmember").modal('show',{backdrop: 'true'});
             }
           });
        });

    $(".modal_hapus").click(function(e) {
      var a = $(this).attr("id");
       $.ajax({
             url: "modul/anggota/modal_dmember.php",
             type: "GET",
             data : {id_transaksi: a,},
             success: function (ajaxData){
               $("#dmember").html(ajaxData);
               $("#dmember").modal('show',{backdrop: 'true'});
             }
           });
        });


      });
</script>

