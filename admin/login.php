<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
      body{
          width:calc(100%);
          height:calc(100%);
        /*  background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?= validate_image($_settings->info('cover')) ?>');
          */background-repeat: no-repeat;
          background-size:cover;  
      }
      #logo-img{
          /* width:15em;
          height:15em; */
          object-fit:scale-down;
          object-position: center center;
      }
  </style>
<!-- <div class="login-box">
<center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" class="img-thumbnail rounded-circle" id="logo-img"></center>
  <div class="clear-fix my-2"></div>
  <div class="card card-outline card-purple">
    <div class="card-header text-center">
      <a href="./" class="h4"><b>Admin Login</b></a>
    </div>
    <div class="card-body">
     

      <form id="login-frm" action="" method="post">
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="text" class="form-control" name="username" placeholder="Username">
          
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" class="form-control" name="password" placeholder="Password">
          
        </div>
        <div class="row">
          <div class="col-8">
            <a href="<?php echo base_url ?>">Back</a>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-danger btn-flat btn-sm w-100">Log In</button>
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div> -->

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                              <img src="../assets/images/adminuser.jpg">
                            </div>
                            <div class="col-lg-6" style="background-color:black; color:white;">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">System User Login</h1>
                                    </div>
                                    <form id="login-frm" action="" method="post" class="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="User Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-user btn-block" style="border-radius: 50px;">
                                            Log In
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url ?>">Back</a>
                                    </div> 
                                </div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">CITY TAXI BOOKING SYSTEM</h1> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>