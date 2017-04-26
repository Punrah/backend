<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
  include "../../database/database.php";
	$modal_id=$_GET['id_user'];
  $q=mysql_query("select * from m_user where id_user='$modal_id'")or die(mysql_error());
  $d=mysql_fetch_array($q);
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Profile</h4>
        </div>

        <div class="modal-body">
        	<form action="modul/anggota/action.php?aksi=d_member" name="modal_popup" enctype="multipart/form-data" method="POST">
          <input type='hidden' name='id_user' value="<?php echo $d['id_user']; ?>" />
        		
                <div class="form-group">
                	<label for="Modal Name">Name</label>
     				<input type="text" name="name"  class="form-control" value="<?php echo $d['name']; ?>" />
                </div>
                <div class="form-group">
                  <label for="Modal Name">Email</label>
            <input type="text" name="email"  class="form-control" value="<?php echo $d['email']; ?>" />
                </div>
                <div class="form-group">
                  <label for="Modal Name">Tanggal Daftar</label>
            <input type="text" name="phone"  class="form-control" value="<?php echo $d['phone']; ?>" />
                </div>

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
	                    Update Data
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
