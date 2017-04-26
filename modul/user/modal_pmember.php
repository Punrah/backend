<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
    //include "../../database/database.php";
	$modal_id=$_GET['modal_id'];
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Perpanjang Member</h4>
        </div>

        <div class="modal-body">
        	<form action="modul/anggota/action.php?aksi=p_member" name="modal_popup" enctype="multipart/form-data" method="POST">
        		
                <div class="form-group">
                	<label for="Modal Name">No Anggota</label>
     				<input type="text" name="id_anggota"  class="form-control" value="<?php echo $modal_id; ?>" readonly/>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">* Tanggal Perpanjang Member</label>
                      <input type="text" class="form-control date" name="tgl" placeholder="Tanggal Perpanjang Member..." required>
                      <div class="err" id="namak"></div>
                    </div>
              <div class="form-group">
                      <label for="exampleInputEmail1">* Jenis Member</label>
                      <select class="form-control" name="jenis" required>
                      <option value='harian'>Harian</option>
                      <option value='bulanan'>Bulanan</option>
                      </select>
                    </div>

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
	                    perpanjang Member
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
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>

     <script>
          $('.date').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd',
    });
    </script>