<div class="card card-outline card-black rounded-0 shadow" style="background-color:black; color:white;">
    <div class="card-header">
        <h3 class="card-title">Feedback List</h3>
    </div>
    <div class="card-body">
        <div class="container">
            <table class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="35%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-light text-dark">
                        <th class="text-center">#</th>
                        <th class="text-center">Client Name</th>
                        <th class="text-center">Taxi Id</th>
                        <th class="text-center">Feedback Text</th>
                        <th class="text-center">Rating</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    //$feedbacks = $conn->query("SELECT * From `feedback`");
                    $feedbacks = $conn->query("SELECT f.id,concat(c.lastname,' ', c.firstname,' ') as passenger, cc.cab_model as Taxi, f.feedback_text, f.rating 
                    FROM `feedback` f inner join client_list c on f.client_id=c.id inner join cab_list cc on f.cab_id = cc.id ");
                    while($row = $feedbacks->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td><?= $row['passenger'] ?></td>
                            <td><?= $row['Taxi'] ?></td>
                            <td><?= $row['feedback_text'] ?></td>
                            <td class="text-center"><?= $row['rating'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-flat btn-sm btn border text-light border view_data" href="javascript:void(0)" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
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
        $('.table th, .table td').addClass("align-middle px-2 py-1");
        $('.table').dataTable();
        $('.view_data').click(function(){
            uni_modal("Feedback Details","feedback/view_feedback.php?id="+$(this).attr('data-id'))
        })
    })
</script>
