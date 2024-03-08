<div class="card-columns">
<div class="container-fluid" style="background-color:black; color:white;">
    <form action="" id="booking-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="cab_id" value="<?= isset($_GET['cid']) ? $_GET['cid'] : (isset($cab_id) ? $cab_id : "") ?>">
       
        <div class="form-group">
        <label for="client_id" class="control-label">Client Name</label>
        <select name="client_id" id="client_id" class="custom-select select2">
                    <option value="" <?= !isset($client_id) ? "selected" : "" ?> disabled></option>
                    <?php 
                    $clients = $conn->query("SELECT * FROM client_list where `status` = 1 ".(isset($client_id) ? " or id = '{$client_id}'" : "")." order by `firstname` asc ");
                    while($row= $clients->fetch_assoc()):
                    ?>
                    <option value="<?= $row['id'] ?>" <?= isset($client_id) && $client_id == $row['id'] ? "selected" : "" ?>><?= $row['firstname'] ?> <?= $row['delete_flag'] == 1 ? "<small>Deleted</small>" : "" ?></option>
                    <?php endwhile; ?>
        </select>
        </div>
        <div class="form-group">
            <label for="driver_name" class="control-label">Driver Name</label>
            <input type="text" name="driver_name" id="driver_name" class="form-control form-control-sm rounded-0" required value="<?= isset($driver_name) ? $driver_name : '' ?>">
        </div>
        <div class="form-group">
            <label for="pickup_date" class="control-label">Pickup Date</label>
            <input type="date" name="" id="pickup_date" class="form-control form-control-sm rounded-0" value="<?php echo date('Y-m-d'); ?>" readonly required> 
        </div>
        <div class="form-group">
            <label for="pickup_zone" class="control-label">Pickup Location</label>
            <input type="text" name="pickup_zone" id="pickup_zone" rows="2" class="form-control form-control-sm rounded-0" required> 
        </div>
        <div class="form-group">
            <label for="drop_zone" class="control-label">Drop-off Location</label>
            <input type="text" name="drop_zone" id="drop_zone" rows="2" class="form-control form-control-sm rounded-0" required> 
        </div>
    </form>
    <div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn  btn-warning mr-2" form="booking-form" style="border-radius: 50px;">Submit</button>
					<a class="btn  btn-danger" href="./?page=bookings/index" style="border-radius: 50px;">Cancel</a>
				</div>
			</div>
	</div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('.select2').select2({
			width:'100%',
			placeholder:"Please Select Here"
		})
        $('#booking-form').submit(function(e){
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_OP_booking",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err);
                    alert_toast("An error occurred",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        location.href = './?p=booking_list';
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg);
                            _this.prepend(el);
                            el.show('slow');
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader();
                    }else{
                        alert_toast("An error occurred",'error');
                        end_loader();
                        console.log(resp);
                    }
                }
            });
        });
    });
</script>
