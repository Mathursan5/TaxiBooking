<?php
require_once('./config.php');
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
                 
                <dl>
                <dt class="">Taxi  No</dt>
                <dd class="pl-4"><?= isset($body_no) ? $body_no : "" ?></dd>
                <dt class="">Taxi Type</dt>
                <dd class="pl-4"><?= isset($category) ? $category : "" ?></dd>
                <dt class="">Taxi Name</dt>
                <dd class="pl-4"><?= isset($cab_model) ? $cab_model : "" ?></dd>
                <dt class="">Driver</dt>
                <dd class="pl-4"><?= isset($cab_driver) ? $cab_driver : "" ?></dd>
                <dt class="">Driver Contact</dt>
                <dd class="pl-4"><?= isset($driver_contact) ? $driver_contact : "" ?></dd>
                </dl>
            </fieldset>
        
            
        </div>

        <div class="col-md-6">
            <fieldset class="bor">
            <dl>
                    <dt class="">Booking #</dt>
                    <dd class="pl-4"><?= isset($ref_code) ? $ref_code : "" ?></dd>
                    <dt class="">Location Details </dt>
                    <br class="">Pickup : <br>
                    <dd class="pl-4"><?= isset($pickup_zone) ? $pickup_zone : "" ?>
                    <br class="">Drop : <br>
                    <dd class="pl-4"><?= isset($drop_zone) ? $drop_zone : "" ?></dd> 
                </dd>
                    <dt class="">Status</dt>
                    <dd class="pl-4">
                        <?php 
                            switch($status){
                                case 0:
                                    echo "<span class='badge badge-secondary bg-gradient-secondary px-3 square-pill fa fa-pause text-light'> Pending</span>";
                                    break;
                                case 1:
                                    echo "<span class='badge badge-primary bg-gradient-primary px-3 square-pill fa fa-commenting text-light'>Driver Confirmed</span>";
                                    break;
                                case 2:
                                    echo "<span class='badge badge-warning bg-gradient-warning px-3 square-pill fa fa-taxi text-light'>Picked-up</span>";
                                    break;
                                case 3:
                                    echo "<span class='badge badge-success bg-gradient-success px-3 square-pill fa fa-check text-light'>Dropped</span>";
                                    break;
                                case 4:
                                    echo "<span class='badge badge-danger bg-gradient-danger px-3 square-pill fa fa-ban text-light'>Cancelled</span>";
                                    break;
                                case 5:
                                    echo "<span class='badge badge-dark bg-gradient-dark px-3 square-pill fa fa-check-circle text-light'>Completed</span>";
                                    break;
                            }
                        ?>
                    </dd>
                </dl>
            </fieldset>
        </div>
    </div>
    <!-- <div class="clear-fix my-2"></div> -->
    
    
    <div class="text-right">
        
        <?php if(isset($status) && $status == 0): ?>
        <button class="btn btn-danger btn-flat bg-gradient-danger" type="button" id="cancel_booking">Cancel Bookings</button>
        <?php endif; ?>
        <button class="btn btn-dark btn-flat bg-gradient-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<script>
    $(function(){
        $('#cancel_booking').click(function(){
            _conf("Are you sure to cancel your Taxi booking [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>]?", "cancel_booking",["<?= isset($id) ? $id : "" ?>"])
        })
    })
    function cancel_booking($id){
        start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=update_booking_status",
			method:"POST",
			data:{id: $id,status:4},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
    }
</script>