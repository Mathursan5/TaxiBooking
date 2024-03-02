 <!-- Header-->
 <!-- <header class="bg-dark py-5" id="main-header">
    <div class="container h-100 d-flex align-items-center justify-content-center w-100">
        <div class="text-center text-white w-100">
        <h1 class="display-4 fw-bolder">Available Taxi</h1>
            <p class="lead fw-normal text-white-50 mb-0">We will take care of your vehicle</p>
        </div>
    </div>
</header> -->
<!-- Section-->
<style>
    body {
        background-color:black; color:white;
    }
</style>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5 card rounded-0  card-dark shadow" style="background-color:black; color:white;">
        <div class="row">
            <div class="col-md-12">
            <center>
			<?php
    // Check if the button is pressed
//     if (isset($_POST["toggle_button"])) {
//         echo "<p>Busy</p>";
//         echo "<ul>";
//         // Display a list of items
//         $items = array("Item 1", "Item 2", "Item 3");
//         foreach ($items as $item) {
//             echo "<li>$item</li>";
//         }
//         echo "</ul>";
//     } else {
//         echo "<p>Not Busy</p>";
//     }
// ?>

<!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <button type="submit" name="toggle_button">Toggle Button</button>
</form> -->
			
            <h1 class="display-6 fw-bolder">Available Taxi</h1>
            <hr>
            </center>
                <div class="form-group">
                <div class="input-group mb-3">
                    <input type="search" id="search" class="form-control" placeholder="Search Here..." aria-label="Search Here" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text bg-success" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
                </div>
                <hr>
                </div>
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3" id="cab_list">
                    <?php 
                    $cabs = $conn->query("SELECT c.*, cc.name as category FROM `cab_list` c inner join category_list cc on c.category_id = cc.id where c.delete_flag = 0 order by c.`reg_code`");//and c.id not in (SELECT cab_id FROM `booking_list` where `status` in (0,1,2))
                    while($row= $cabs->fetch_assoc()):
                    ?>
                    <?php
                    $bookingStatus = getBookingStatus($row['id']);
                    $isBusy = ($bookingStatus == 0 || $bookingStatus == 1 || $bookingStatus == 2);
                    ?>
                    <a class="col item text-decoration-none text-dark book_cab" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-bodyno="<?php echo $row['body_no'] ?>"<?php echo $isBusy ? 'style="pointer-events: none; opacity: 0.9;"' : ''; ?>>
                        <div class="callout <?php echo $isBusy ? 'callout-secondary' : 'callout-primary'; ?> border-success rounded-0">
                            <dl>
                                <dt class="h5"> <?php echo $row['body_no'] ?></dt>
                                <!-- ********************************** --> 
                                <dt>
                                <?php 
                                    switch($row['category']){
                                        case "Tuk":
                                            echo "<img src='assets/images/tuk.png' alt='Tuk Icon'>"; 
                                            break;
                                        case "Car":
                                            echo "<img src='assets/images/car.png' alt='Car Icon'>"; 
                                            break;
                                        case "Mini":
                                            echo "<img src='assets/images/mini.png' alt='Mini Car Icon'>"; 
                                            break;
                                        case "MiniVan":
                                            echo "<img src='assets/images/minivan.png' alt='Mini Van Icon'>"; 
                                            break;
                                        case "Van":
                                            echo "<img src='assets/images/van.png' alt='Van Icon'>"; 
                                            break; 
                                    }
                                ?>  
                                 </dt> 
                                <!--*********************************** -->
                                <dd class="truncate-3 text-muted lh-1">
                                    <small><?php echo $row['category'] ?></small><br>
                                    <small><?php echo $row['cab_model'] ?></small>
                                    <small>
                                        <?php
                                            if ($isBusy) {
                                                echo "<span class='badge badge-warning bg-gradient-warning px-3 rounded-pill'>BUSY &diams;</span>";
                                            }
                                        ?>
                                    </small>
                                    
                                </dd>
                            </dl>
                        </div>
                    </a>

                    <?php endwhile; ?>
                </div>
                <div id="noResult" style="display:none" class="text-center"><b>No Results!!</b></div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#search').on('input',function(){
            var _search = $(this).val().toLowerCase().trim()
            $('#cab_list .item').each(function(){
                var _text = $(this).text().toLowerCase().trim()
                    _text = _text.replace(/\s+/g,' ')
                    console.log(_text)
                if((_text).includes(_search) == true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
            })
            if( $('#cab_list .item:visible').length > 0){
                $('#noResult').hide('slow')
            }else{
                $('#noResult').show('slow')
            }
        })
        $('#cab_list .item').hover(function(){
            $(this).find('.callout').addClass('shadow')
        })
        $('#cab_list .book_cab').click(function(){
            if("<?= $_settings->userdata('id') && $_settings->userdata('login_type') == 2 ?>" == 1)
                uni_modal("Book Taxi - "+$(this).attr('data-bodyno'),"booking.php?cid="+$(this).attr('data-id'),'mid-large');
            else
            location.href = './login.php';
        })
        $('#send_request').click(function(){
            if("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1)
            uni_modal("Fill the cab Request Form","send_request.php",'mid-large');
            else
            alert_toast(" Please Login First.","warning");
        })

    })
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg-purple text-light')
        }else{
           $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script>
        
<?php
// Function to get booking status for a given cab // 
function getBookingStatus($cabId) {
    global $conn; // Assuming $conn is your database connection object

    // Perform a query to get the booking status for the given cab
    $query = "SELECT status FROM booking_list WHERE cab_id = $cabId ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            return $row['status'];
        }
    }
    
    // Default to 0 (Not busy) if no booking or an error occurred
    return -1;
}
?>
