<div class="content py-5 mt-5" style="background-color:black; color:white;" >
    <div class="container">
        <div class="card card-outline card-black shadow rounded-0" style="background-color:black; color:white;">
            <div class="card-header">
                <h4 class="card-title">Booking List</h4>
            </div>
            <div class="card-body"> 
                <table class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                    <tr class="bg-gradient-light text-dark">
                            <th class="text-center">#</th>
                            <th class="text-center">Date Booked</th>
                            <th class="text-center">Ref. Code</th>
                            <th class="text-center">Pickup</th>
                            <th class="text-center">Dropoff</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM `booking_list` where cab_id = '{$_settings->userdata('id')}' order by unix_timestamp(date_created) desc");
                            while($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['ref_code'] ?></td>
                            <td>
                                <p class="m-0 truncate-1">  <?= $row['pickup_zone'] ?></p>    </td>
                            <td><p class="m-0 truncate-1">  <?= $row['drop_zone'] ?></p>
                            </td>
                            <td class="text-center">
                                <?php 
                                    switch($row['status']){
                                        case 0:
                                            echo "<span class='badge badge-secondary bg-gradient-secondary px-3 square-pill'>Pending &diams;</span>";
                                            break;
                                        case 1:
                                            echo "<span class='badge badge-primary bg-gradient-primary px-3 square-pill'>Confirmed</span>";
											echo "<span class='badge badge-warning bg-gradient-warning px-3 square-pill'>BUSY &diams;</span>";
                                            break;
                                        case 2:
                                            echo "<span class='badge badge-warning bg-gradient-warning px-3 square-pill'>Picked-up</span>";
                                            echo "<span class='badge badge-warning bg-gradient-warning px-3 square-pill'>BUSY &diams;</span>";
                                            break;
                                        case 3:
                                            echo "<span class='badge badge-success bg-gradient-success px-3 square-pill'>Dropped &diams;</span>";
                                            break;
                                        case 4:
                                            echo "<span class='badge badge-danger bg-gradient-danger px-3 square-pill'>Cancelled &diams;</span>";
                                            break;
                                        case 5:
                                            echo "<span class='badge badge-dark bg-gradient-dark px-3 square-pill'>Completed</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-flat btn border text-light btn-sm view_data" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i>View </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>
<script>
    $(function(){
        $('table th, table td').addClass('px-2 py-1 align-middle')
        $('table').dataTable();

        $('.view_data').click(function(){
            uni_modal("Booking Details","view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>
<script>
    // Reload the page every 12 seconds
    setTimeout(function () {
        location.reload();
    }, 12000); 
</script>