<h1 class=""><i class="fas fa-taxi"></i> <?php echo $_settings->info('name') ?></h1>
<hr>
<style>
  #cover_img_dash{
    width:100%;
    max-height:50vh;
    object-fit:cover;
    object-position:bottom center;
  }
</style>
<div class="row" style="padding-top:15px">
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon" style="background-image: linear-gradient(blue, purple)"><i class="fas fa-taxi" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Available Taxi</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM cab_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(lightblue, darkblue)"><i class="fas fa-users" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Passengers</span>
                <span class="info-box-number">
                  <?php 
                    $mechanics = $conn->query("SELECT count(id) as total FROM `client_list` where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($mechanics);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon" style="background-image: linear-gradient(#D89216, darkgreen)"><i class="fas fa-bookmark" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Bookings Made</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM booking_list ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
		   <!-- col -->
		  <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#D89216, #374045)"><i class="fas fa-users-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">System Users</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `users` ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
			 <!-- /.col -->
          </div>
		  
        </div>
       


        <div class="row" style="background-color: lightpink; padding-top:15px">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#3C0753, #720455)"><i class="fas fa-spinner" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Bookings</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 0 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#D21312, #570530)"><i class="fas fa-times" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cancelled Bookings</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 4 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#790252, #E80F88)"><i class="fas fa-road" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ongoing Trips</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 2 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#0E2954, #1F6E8C)"><i class="fas fa-tasks" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Trips Completed</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 3 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          
        </div>

        <div class="row">
          
        </div>

        <hr>
    <!-- <div class="text-center">
      <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover" class="w-100 img-fluid img-thumnail border" id="cover_img_dash">
    </div> -->
