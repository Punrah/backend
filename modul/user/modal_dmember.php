<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
  include "../../database/database.php";
	$modal_id=$_GET['id_transaksi'];
  $q=mysql_query("select * from t_anggota where id_transaksi='$modal_id'")or die(mysql_error());
  $d=mysql_fetch_array($q);
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Transaksi Member</h4>
        </div>

        <div class="modal-body">
        	<form action="modul/anggota/action.php?aksi=p_member" name="modal_popup" enctype="multipart/form-data" method="POST">
          <input type='hidden' name='id_transaksi' value="<?php echo $d['id_transaksi']; ?>" />
        		
                <div class="form-group">
                	<label for="Modal Name">No Anggota</label>
     				<input type="text" name="id_anggota"  class="form-control" value="<?php echo $d['id_anggota']; ?>" readonly/>
                </div>
                <div class="form-group">
                  <label for="Modal Name">Jenis Member</label>
            <input type="text" name="jenis"  class="form-control" value="<?php echo $d['jenis']; ?>" readonly/>
                </div>
                <div class="form-group">
                  <label for="Modal Name">Tanggal Daftar</label>
            <input type="text" name="tgl1"  class="form-control" value="<?php echo $d['tgl_daftar']; ?>" readonly/>
                </div>
                <div class="form-group">
                  <label for="Modal Name">Tanggal Selesai</label>
            <input type="text" name="tgl2"  class="form-control" value="<?php echo $d['tgl_selesai']; ?>" readonly/>
                </div>
              

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
	                    Hapus Transaksi Member
	                </button>

	                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
	               		Cancel
	                </button>
	            </div>

            	</form>

            </div>

           
        </div>
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
