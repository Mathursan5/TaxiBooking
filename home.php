 <!-- Header-->
 <header class="bg-dark py-5" id="main-header">
    <div class="container h-100 d-flex align-items-center justify-content-center w-100">
        <div class="text-center text-white w-100">
            <h1 class="display-4 fw-bolder mx-5"><?php echo $_settings->info('name') ?></h1>
            <div class="col-auto mt-4">


			<!-- DASH BORAD -->
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
              <span>  <img src="assets/images/pending.png"> </span> 
              </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Pending Bookings</h5>
                <p class="card-text" style="font-size: 28px;">
                <?php 
				$user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status =0 ")->fetch_assoc()['total'];
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
            <span>  <img src="assets/images/cancelled.png"> </span> 
            </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Cancel Bookings</h5>
                <p class="card-text" style="font-size: 28px;">
                <?php 
				$user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status = 4 ")->fetch_assoc()['total'];
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
            <span>  <img src="assets/images/ongoing.png"> </span> 
            </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Ongoing Bookings</h5>
                <p class="card-text" style="font-size: 28px;">
                <?php 
				            $user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status = 2 ")->fetch_assoc()['total'];
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
            <span style="width:120%;">  <img src="assets/images/completed.png" > </span> 
            </div>
            <div class="text-center">
                <h5 class="custom-card-title" style="font-weight: bold; text-align: center !important;">Trips Completed</h5>
                <p class="card-text" style="font-size: 28px;">
                <?php 
				            $user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status = 3 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </p>
            </div>
        </div>
    </div>
</div>

</div>



			<!-- <div class="row" style="background-color: black; padding-top:15px">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(blue, purple)"><i class="fas fa-spinner"></i></span>

              <div class="info-box-content" style="background-image: linear-gradient(blue, purple)">
                <span class="info-box-text" >Pending Bookings</span>
                <span class="info-box-number">
				 
                <?php 
				$user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status =0 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
            </div>
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#D21312, #570530)"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content" style="background-image: linear-gradient(#D21312, #570530)">
                <span class="info-box-text">Cancelled Bookings</span>
                <span class="info-box-number">
                <?php 
				$user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status = 4 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#0E2954, #1F6E8C)"><i class="fas fa-road"></i></span>

              <div class="info-box-content" style="background-image: linear-gradient(#0E2954, #1F6E8C)">
                <span class="info-box-text">Ongoing Trips</span>
                <span class="info-box-number">
                <?php 
				$user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status = 2 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
            </div>
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon" style="background-image: linear-gradient(#3C0753, #720455)"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content" style="background-image: linear-gradient(#3C0753, #720455)">
                <span class="info-box-text">Trips Completed</span>
                <span class="info-box-number">
                <?php 
				$user_id = $_settings->userdata('id');
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where client_id = '$user_id' AND status = 3 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
            </div>
          </div>


          
        </div> -->
                 <a class="btn btn-warning btn-lg rounded-50" href="./?p=cab_available" style="border-radius: 50px;">Book Now</a> 
            </div>
        </div>
    </div>
</header>


<section class="py-5">
    <div class="container">
     <!--   <div class="card shadow card-outline card-purple rounded-0">
            <div class="card-body">
               <?php include './welcome.html' ?> 
            </div>
        </div> -->
    </div>
</section>
<script>
    $(function(){
        $('#search').on('input',function(){
            var _search = $(this).val().toLowerCase().trim()
            $('#service_list .item').each(function(){
                var _text = $(this).text().toLowerCase().trim()
                    _text = _text.replace(/\s+/g,' ')
                    console.log(_text)
                if((_text).includes(_search) == true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
            })
            if( $('#service_list .item:visible').length > 0){
                $('#noResult').hide('slow')
            }else{
                $('#noResult').show('slow')
            }
        })
        $('#service_list .item').hover(function(){
            $(this).find('.callout').addClass('shadow')
        })
        $('#service_list .view_service').click(function(){
            uni_modal("Service Details","view_service.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('#send_request').click(function(){
            uni_modal("Fill the Service Request Form","send_request.php",'large')
        })

    })
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg navbar-light navbar-dark  text-light')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg text-light')
        }else{
           $('#topNavBar').addClass('navbar-dark ')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script>