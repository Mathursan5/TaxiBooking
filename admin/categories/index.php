<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-black rounded-0 shadow" style="background-color:black; color:white;" >
	<div class="card-header">
		<h3 class="card-title">Taxi Type</h3>
		<div class="card-tools">
			<button type="button" id="create_new" class="btn btn-flat btn-warning btn-sm" style="border-radius: 50px;"><span class="fas fa-plus"></span>  Add New Taxi Type</button>
		</div>
	</div>
	<div class="card-body">
		<div class="container">
			<table class="table table-bordered table-stripped table-hover">
				<colgroup>
					<!-- <col width="20%"> -->
					<col width="35%">
					<col width="35%">
					<col width="15%">
				</colgroup>
				<thead>
				<tr class="bg-gradient-light text-dark">
						
						<th>Taxi Type</th>
						<th>Description</th> 
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `category_list` where delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							
							<!-- <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td> -->
							<td><?php echo $row['name'] ?></td>
							<td><p class="m-0 truncate-1"><?php echo $row['description'] ?></p></td>
							
							<td align="center">
								<button type="button" class="btn btn-flat btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
								<!-- <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a> -->
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
<script>
	$(document).ready(function(){
		$('#create_new').click(function(){
			uni_modal("Add New Taxi Type","categories/manage_category.php");
		})
		$('.edit_data').click(function(){
			uni_modal("Edit Taxi Type","categories/manage_category.php?id="+$(this).attr('data-id'));
		})
		$('.view_data').click(function(){
			uni_modal("View Taxi Type","categories/view_category.php?id="+$(this).attr('data-id'));
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Taxi Type?","delete_category",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_category",
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