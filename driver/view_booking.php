<?php
require_once('./../config.php');

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `booking_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        $qry2 = $conn->query("SELECT c.*, cc.name as category from `cab_list` c inner join category_list cc on c.category_id = cc.id where c.id = '{$cab_id}' ");
        if($qry2->num_rows > 0){
            foreach($qry2->fetch_assoc() as $k => $v){
                if(!isset($$k))
                $$k=$v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container-fluid" style="background-color:black; color:white;">

    <div class="row">
        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"> Taxi Details</legend>
                <dl>
                    <dt class="">Taxi Body No</dt>
                    <dd class="pl-4"><?= isset($body_no) ? $body_no : "" ?></dd>
                    <dt class="">Vehicle Category</dt>
                    <dd class="pl-4"><?= isset($category) ? $category : "" ?></dd>
                    <dt class="">Vehicle model</dt>
                    <dd class="pl-4"><?= isset($cab_model) ? $cab_model : "" ?></dd>
                    <dt class="">Driver</dt>
                    <dd class="pl-4"><?= isset($cab_driver) ? $cab_driver : "" ?></dd>
                    <dt class="">Driver Contact</dt>
                    <dd class="pl-4"><?= isset($driver_contact) ? $driver_contact : "" ?></dd>
                    <dt class="">Driver Address</dt>
                    <dd class="pl-4"><?= isset($driver_address) ? $driver_address : "" ?></dd>
                </dl>
            </fieldset>
            <!-- <div class="clear-fix my-2"></div> -->
            
        </div>

        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"> Booking Details</legend>
                <dl>
                    <dt class="">Ref. Code</dt>
                    <dd class="pl-4"><?= isset($ref_code) ? $ref_code : "" ?></dd>
                    <dt class="">Pickup Zone</dt>
                    <dd class="pl-4"><?= isset($pickup_zone) ? $pickup_zone : "" ?></dd>
                    <dt class="">Drop off Zone</dt>
                    <dd class="pl-4"><?= isset($drop_zone) ? $drop_zone : "" ?></dd>
                    <dt class="">Status</dt>
                    <dd class="pl-4">
                        <?php 
                            switch($status){
                                case 0:
                                    echo "<span class='badge badge-secondary bg-gradient-secondary px-3 square-pill'>Pending</span>";
                                    break;
                                case 1:
                                    echo "<span class='badge badge-primary bg-gradient-primary px-3 square-pill'>Confirmed</span>";
                                    break;
                                case 2:
                                    echo "<span class='badge badge-warning bg-gradient-warning px-3 square-pill'>Picked-up</span>";
                                    break;
                                case 3:
                                    echo "<span class='badge badge-success bg-gradient-success px-3 square-pill'>Dropped</span>";
                                    break;
                                case 4:
                                    echo "<span class='badge badge-danger bg-gradient-danger px-3 square-pill'>Cancelled</span>";
                                    break;
                                case 5:
                                    echo "<span class='badge badge-dark bg-gradient-dark px-3 square-pill'>Completed</span>";
                                    break;
                            }
                        ?>
                    </dd>
                </dl>
            </fieldset>
        </div>
    </div>
    
    <!-- <div class="clear-fix my-3"></div> -->
    <div class="text-right">
        <?php if(isset($status) && $status == 0): ?>
        <button class="btn btn-primary btn-flat bg-gradient-primary" style="border-radius: 50px;" type="button" id="confirm_booking">Confirm Booking</button>
        <?php elseif(isset($status) && $status == 1): ?>
        <button class="btn btn-warning btn-flat bg-gradient-warning" style="border-radius: 50px;" type="button" id="pickup_booking">Picked Up</button>
        <?php elseif(isset($status) && $status == 2): ?>
        <button class="btn btn-success btn-flat bg-gradient-success" style="border-radius: 50px;" type="button" id="dropoff_booking">Dropped Off</button>
        <?php endif; ?>
        <button class="btn btn-dark btn-flat bg-gradient-dark" style="border-radius: 50px;" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<script>
    $(function(){
        $('#confirm_booking').click(function(){
            _conf("Are you sure to confirm this booking [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>]?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",1])
        })
        $('#pickup_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] booking as Picked Up?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",2])
        }) 
        $('#dropoff_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] booking as Dropped Off?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",3])
        })
    })
    function update_booking_status($id,$status){
        start_loader();

		$.ajax({
			url:_base_url_+"classes/Master.php?f=update_booking_status",
			method:"POST",
			data:{id: $id,status:$status},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					if ($status == 1) {
                        sendConfirmationMessage($id);
                    } else {
                        location.reload();
                    }
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
    }

    function sendConfirmationMessage(bookingId) {
    $.ajax({
        url: _base_url_ + "driver/send_confirmation_message.php", // Replace with the actual file to handle Twilio SMS sending
        method: "POST",
        data: { booking_id: bookingId },
        dataType: "json",
        error: function (err) {
            console.log(err);
            alert_toast("Failed to send confirmation message.", 'error');
            end_loader();
        },
        success: function (resp) {
            if (typeof resp === 'object' && resp.status === 'success') {
                //alert_toast("Booking confirmed. Message sent to the client.", 'success');
                location.reload();
            } else {
                //alert_toast("Failed to send confirmation message.", 'error');
                end_loader();
            }
        }
    });
}
</script>