<h1 class=""><i class="fas fa-taxi"></i> <?php echo $_settings->info('name') ?></h1>
<hr>
<style>
  #cover_img_dash{
    width:100%;
    max-height:50vh;
    object-fit:cover;
    object-position:bottom center;
  }
  body {
    background-color:black; color:white;
    
  }
  .content-wrapper {
    background-color: black;
}
.custom-card-title {
    font-weight: bold;
    text-align: center !important;
}
</style>
<div class="row" style="padding-top:15px">
<div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #8E2DE2, #4A00E0); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
              <span>  <img src="../assets/images/drivers.png"> </span> 
              </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Drivers</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                   $inv = $conn->query("SELECT count(id) as total FROM cab_list where delete_flag = 0 ")->fetch_assoc()['total'];
                   echo number_format($inv);
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #8E2DE2, #4A00E0); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/passenger.png"> </span> 
            </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Passengers</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                     $mechanics = $conn->query("SELECT count(id) as total FROM `client_list` where delete_flag = 0 ")->fetch_assoc()['total'];
                     echo number_format($mechanics);
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #8E2DE2, #4A00E0); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/pending.png"> </span>  </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Pending Trips</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                     $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 0 ")->fetch_assoc()['total'];
                     echo number_format($services);
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #8E2DE2, #4A00E0); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/cancelled.png"> </span> </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Cancelled Trips</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                     $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 4 ")->fetch_assoc()['total'];
                     echo number_format($services);
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row" style="padding-top:15px">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #ffc107, #28a745); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/ongoing.png"> </span> </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Ongoing Trips</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                     $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 2 ")->fetch_assoc()['total'];
                     echo number_format($services);
                    ?>
                </p>
            </div>
        </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #ffc107, #28a745); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/completed.png"> </span> </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Completed Trips</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                     $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 3 ")->fetch_assoc()['total'];
                     echo number_format($services);
                    ?>
                </p>
            </div>
        </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #ffc107, #28a745); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/systemusers.png"> </span> </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">System Users</h5>
                <p class="card-text" style="font-size: 28px;">
                    <?php 
                     $services = $conn->query("SELECT count(id) as total FROM `users` ")->fetch_assoc()['total'];
                     echo number_format($services);
                    ?>
                </p>
            </div>
        </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="card" style="background: linear-gradient(to right, #ffc107, #28a745); color: #ffffff; border-radius: 15px; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
            <span>  <img src="../assets/images/ttypes.png"> </span> </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Taxi Types</h5>
                <p class="card-text" style="font-size: 28px;">
                5
                </p>
            </div>
        </div>
    </div>
  </div>
</div>
        <div class="row">
          
        </div>

        <hr>
    <!-- <div class="text-center">
      <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover" class="w-100 img-fluid img-thumnail border" id="cover_img_dash">
    </div> -->
