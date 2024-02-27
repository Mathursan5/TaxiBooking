<div class="card card-outline card-purple shadow rounded-0">
    <div class="card-header">
        <h3 class="card-title">Feedback List</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="45%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th class="text-center">#</th>
                        <th class="text-center">Client Id</th>
                        <th class="text-center">Taxi Id</th>
                        <th class="text-center">Feedback Text</th>
                        <th class="text-center">Rating</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $feedbacks = $conn->query("SELECT * From `feedback`");
                    while($row = $feedbacks->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td><?= $row['client_id'] ?></td>
                            <td><?= $row['cab_id'] ?></td>
                            <td><?= $row['feedback_text'] ?></td>
                            <td class="text-center"><?= $row['rating'] ?></td>
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
        $('.table th, .table td').addClass("align-middle px-2 py-1");
        // $('.table').dataTable();
        $('.view_data').click(function(){
            uni_modal("Feedback Details","feedback/view_feedback.php?id="+$(this).attr('data-id'))
        })
    })
</script>
