<?php
require_once('./../../config.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT f.*, c.firstname, c.lastname, cl.cab_driver,cl.cab_reg_no
                        FROM `feedback` f
                        INNER JOIN client_list c ON f.client_id = c.id
                        INNER JOIN cab_list cl ON f.cab_id = cl.id
                        WHERE f.id = '{$_GET['id']}'");

    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>

<style>
    #uni_modal .modal-footer {
        display: none;
    }
</style>

<div class="container-fluid" style="background-color:black; color:white;">
    <div class="row">
        <div class="col-md-6">
            <fieldset class="border-bottom">
                <legend class="h5 text-muted"> Client Details</legend>
                <dl>
                    <dt class="">Client Id</dt>
                    <dd class="pl-4"><?= isset($client_id) ? $client_id : "" ?></dd>
                    <dt class="">Client Name</dt>
                    <dd class=""><?= isset($firstname) ? $firstname : "" ?> <?= isset($lastname) ? $lastname : "" ?></dd>
                </dl>
            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset class="border-bottom">
                <legend class="h5 text-muted"> Taxi Details</legend>
                <dl>
                    <!-- <dt class="">Cab Id</dt>
                    <dd class="pl-4"><?= isset($cab_id) ? $cab_id : "" ?></dd> -->
                    <dt class="">Taxi Reg Number</dt>
                    <dd class=""><?= isset($cab_reg_no) ? $cab_reg_no : "" ?></dd>
                    <dt class="">Taxi Driver</dt>
                    <dd class=""><?= isset($cab_driver) ? $cab_driver : "" ?></dd>
                </dl>
            </fieldset>
        </div>

        <div class="col-md-12">
            <fieldset class="border-bottom">
                <legend class="h5 text-muted"> Feedback Details</legend>
                <dl>
                    <dt class="">Feedback Text</dt>
                    <dd class=""><?= isset($feedback_text) ? $feedback_text : "" ?></dd>
                    <dt class="">Rating</dt>
                    <dd class="pl-4"><?= isset($rating) ? $rating : "" ?></dd>
                </dl>
            </fieldset>
        </div>
    </div>

    <div class="clear-fix my-3"></div>

    <div class="text-right">
        <button class="btn btn-danger btn-flat bg-gradient-red" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
