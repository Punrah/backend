		<section class="content-header">
          <h1>
            Dashboard
            <small>Welcome</small>
          </h1>
         
        </section>
        <!-- Main content -->
                <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
          
                  <img class="profile-user-img img-responsive img-circle" src="image/<?php echo $dp[foto]; ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $_SESSION['user']; ?></h3>
                  <p class="text-muted text-center"><?php echo $dp['lv']; ?></p>
          <!--<ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Komunitas</b> <a class="pull-right">--</a>
                    </li>
                    <li class="list-group-item">
                      <b>Friends</b> <a class="pull-right">--</a>
                    </li>
                  </ul>-->
          <a href="#" class="btn btn-primary btn-block"><b>Update Profile</b></a>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                      <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <strong><i class="fa fa-user margin-r-5"></i> Name</strong>
                  <p class="text-muted">
                    <?php echo $dp['name']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                      <strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
                 <p class="text-muted">
                    <?php echo $dp['email']; ?>
                  </p>
                    </li>
                    <li class="list-group-item">
                                        <strong><i class="fa fa-phone margin-r-5"></i>Phone</strong>
          <p class="text-muted">
                    <?php echo $dp['phone']; ?>
                  </p>
                    </li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#a1" data-toggle="tab">Activity 1</a></li>
          <li class=""><a href="#a2" data-toggle="tab">Activity 2</a></li>
          <li class=""><a href="#a3" data-toggle="tab">Activity 3</a></li>
          <li class=""><a href="#a4" data-toggle="tab">Activity 4</a></li>
          <li class=""><a href="#a5" data-toggle="tab">Activity 5</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="a1">

                  </div>
           
                 <div class="tab-pane" id="a2">
                </div>

                 <div class="tab-pane" id="a3">
                </div>

                 <div class="tab-pane" id="a4">
                </div>

                 <div class="tab-pane" id="a5">
                </div>
           
                  
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </div>
          <!-- Modal Popup untuk Hapus Transaks member--> 
          <div id="edit_profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          </div>
        </section><!-- /.content -->
	   <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	