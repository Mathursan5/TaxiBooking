<div class="card card-outline card-black shadow rounded-0" style="background-color:black; color:white;">
    <div class="card-header">
        <h3 class="card-title">Booking List</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered table-hover">
                <colgroup> 
                    <col width="14%">
                    <col width="11%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light text-dark"> 
                        <th class="text-center">Booked Date</th>
                        <th class="text-center">Taxi #</th>
                        <th class="text-center">Driver</th>
                        <th class="text-center">Passenger</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $bookings = $conn->query("SELECT b.*,concat(c.lastname,', ', c.firstname,' ',c.middlename) as client, cab_reg_no, cc.cab_driver as cab_driver FROM `booking_list` b inner join client_list c on b.client_id = c.id inner join cab_list cc on b.cab_id = cc.id order by unix_timestamp(b.date_created) desc ");
                    while($row = $bookings->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['cab_reg_no'] ?></td>
                            
                            <td><?= $row['cab_driver'] ?></td>
                            <td><?= $row['client'] ?></td>
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
                                            echo "<span class='badge badge-success bg-gradient-success px-3 square-pill fa fa-check text-light'>Dropped off</span>";
                                            break;
                                        case 4:
                                            echo "<span class='badge badge-danger bg-gradient-danger px-3 square-pill fa fa-ban text-light'>Cancelled</span>";
                                            break;
                                        case 5:
                                            echo "<span class='badge badge-dark bg-gradient-dark px-3 square-pill fa fa-check-circle text-light'>Finished</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-flat btn-sm btn-info border view_data" href="javascript:void(0)" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){

        $('.table th, .table td').addClass("align-middle px-2 py-1")
		$('.table').dataTable();
		$('.table').dataTable();
        $('.view_data').click(function(){
            uni_modal("Booking Details","bookings/view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>