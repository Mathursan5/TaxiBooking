<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-black" style="background-color:black; color:white;">
	<div class="card-header">
		<h3 class="card-title">Drivers</h3>
		<div class="card-tools">
			<a href="?page=cabs/manage_cab" class="btn btn-flat btn-warning btn-sm" style="border-radius: 50px;"><span class="fas fa-plus"></span>  Add New Driver</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped table-hover">
				<colgroup>
					<col width="5%">
					<!-- <col width="15%"> -->
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
				<tr class="bg-gradient-light text-dark">
						<th>#</th>
						<!-- <th>Date Created</th> -->
						<th>Driver Name</th>
						<th>Contact No</th>
						<th>Taxi No</th> 
						<th>Taxi Name</th>
						<th>Status</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT c.*,cc.name as category from `cab_list` c inner join category_list cc on c.category_id = cc.id where c.delete_flag = 0 order by (c.`reg_code`) asc ");
						while($row = $qry->fetch_assoc()):
							foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<!-- <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td> -->
							<td><?php echo ucwords($row['cab_driver']) ?></td>
							<td><?php echo ucwords($row['driver_contact']) ?></td>
							<td><?php echo ucwords($row['body_no']) ?></td>
							<td><?php echo ucwords($row['cab_model'])?></td>
							<!-- <td>
								<div>
									<p class="m-0 truncate-1"><small><b>Plate:</b> <?= $row['cab_reg_no'] ?></small></p>
									<p class="m-0 truncate-1"><small><b>Driver:</b> <?= $row['cab_driver'] ?></small></p>
								</div>
							</td> -->
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-warning px-3 rounded-pill" alt="Active"><span class="fa fa-check text-light"></span>
                                <?php else: ?>
                                    <span class="badge badge-danger px-3 rounded-pill"><span class="fa fa-ban text-light"></span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn border text-light btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
                                    <!-- <a class="dropdown-item" href="?page=cabs/view_cab&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a> -->
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="?page=cabs/manage_cab&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
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
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Driver?","delete_cab",[$(this).attr('data-id')])
		})
        $('.table th, .table td').addClass("align-middle px-2 py-1")
		$('.table').dataTable();
		$('.table').dataTable();
	})
	function delete_cab($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_cab",
			method:"POST",
			data:{id: $id},
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