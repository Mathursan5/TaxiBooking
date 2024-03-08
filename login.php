<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>

<body class="bg-gradient">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                              <img src="assets/images/paseengercar.jpg">
                            </div>
                            <div class="col-lg-6" style="background-color:black; color:white;">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Passenger Login</h1>
                                    </div>
                                    <form id="clogin-frm" action="" method="post" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-user btn-block" style="border-radius: 50px;">
                                            Log In
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url ?>">Back</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url.'register.php' ?>">Create an Account</a>
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
    <script src="plugins/jquery-easing/jquery.easing.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
