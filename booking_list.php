<?php
$client_id = $_settings->userdata('id');
$booking_query = "SELECT status FROM booking_list WHERE client_id = '$client_id' ORDER BY id DESC LIMIT 1";
$booking_result = $conn->query($booking_query);

if ($booking_result->num_rows > 0) {
    $booking_row = $booking_result->fetch_assoc();
    $currentStatus = $booking_row["status"];

    if ($currentStatus == 3) {
        // If status is 3, initiate the redirection after 3 seconds
        echo "<script>
                setTimeout(function() {
                    window.location.href = '?p=feedback';
                }, 3000);
             </script>";
    }
}
?>
<style> 
    body {
        background-color:black; color:white;
    }
</style>


<!-- <div class="content py-5 mt-5">
    <div class="container"> -->
        <div class="card card-outline card-black shadow rounded-0" style="background-color:black; color:white; padding:10px">
            <div class="card-header">
                <h4 class="card-title">My Booking List</h4>
            </div>
            <div class="card-body">
            <div class="container-fluid">
                <table class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col width="10%">
                        <col width="12%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr class="bg-gradient-light text-dark">
                            <th class="text-center">Date Booked</th>
                            <th class="text-center">Driver</th>
                            <th class="text-center">Taxi</th>
                            <th class="text-center">Pickup</th>
                            <th class="text-center">Dropoff</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT *,c.cab_driver as cab_driver,c.cab_model as cab_model FROM `booking_list` b inner join cab_list c on b.cab_id=c.id where b.client_id = '{$_settings->userdata('id')}' order by unix_timestamp(b.date_created) desc");
                            while($row = $qry->fetch_assoc()):
                        ?>
                        <tr style="color:white;">
                            <td><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['cab_driver'] ?></td>
                            <td><?= $row['cab_model'] ?></td>
                            <td> <p class="m-0 truncate-1"> <?= $row['pickup_zone'] ?></p>  </td>
                            <td><p class="m-0 truncate-1"> <?= $row['drop_zone'] ?></p></td>
                            <td class="text-center">
                                <?php 
                                    switch($row['status']){
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
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-flat btn border text-light btn-sm view_data" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i>View</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div> 
        </div> 
        </div>
    <!-- </div>
</div> -->
<script>
    $(function(){
        $('table th, table td').addClass('px-2 py-1 align-middle')
        $('table').dataTable();

        $('.view_data').click(function(){
            uni_modal("View Booking Details","view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>
<script>
    // Reload the page every 7 seconds
    setTimeout(function () {
        location.reload();
    }, 7000); 
</script>