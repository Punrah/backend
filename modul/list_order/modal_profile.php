<!--
Author : Aguzrybudy
Created : Selasa, 19-April-2016
Title : Crud Menggunakan Modal Bootsrap
-->
<?php
  include "../../database/database.php";
	$modal_id=$_GET['id_driver'];
  $q=mysql_query("select * from m_driver where id_driver='$modal_id'")or die(mysql_error());
  $d=mysql_fetch_array($q);
?>

<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Update Photo Driver</h4>
        </div>

        <div class="modal-body">
        	<form action="modul/driver/action.php?aksi=updateFoto" name="modal_popup" enctype="multipart/form-data" method="POST">
          <input type='hidden' name='id_driver' value="<?php echo $d['id_driver']; ?>" />
                <div class="form-group">
                	<label for="Modal Name">Choose Photo</label>
     				<input type="file" name="foto"  class="form-control"/>
                </div>
                

	            <div class="modal-footer">
	                <button class="btn btn-success" type="submit">
	                    Save Photo
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
