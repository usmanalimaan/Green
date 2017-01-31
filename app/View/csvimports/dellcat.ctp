<div class="page-container2">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-trash"></i>Delete CSV Impodrt with respect to Category</div>

			</div>
			<div class="portlet-body">
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->Session->flash('error'); ?>
				<?php echo $this->Session->flash('successfully'); ?>

				<table id="message_data" class="table table-striped table-bordered table-hover table-checkable order-column sample_1">
					<thead>
						<tr>
							<th>#</th>
							<th>Category</th>
							<th>Total Products</th>
							<th>Csv Products</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="table_body">
						<?php $i = 0; foreach($categories as $value): ?>				
						<tr>
							<td><?php $i++; echo $i; ?></td>
							<td ><?php echo $value['1']?></td>
							<td ><?php echo $value['3']?></td>
							<td ><?php echo $value['2']?></td>
							<td >
								<a href="<?php echo $this->base;?>/csvimports/delete/<?php echo $value['0']?>" onclick="if (confirm('Are you sure you want to delete <?php echo $value['1']?> Whole CSV Impodrt data ?')) { return true; } return false;">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php unset($value); ?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function () {
			// $("#inbox").trigger('click');
			// document.getElementById("inbox").click();
				// functin_check ('inbox');

				$('#table_id').DataTable(
				{
					"paging":   false,
					"ordering": false,
					"info":     false,
					"bFilter": false,
				});
			// $('#inbox').click(function()
			// {
			// 	$('#dir').html('From');
			// 	functin_check ('inbox');
			// });
			// $('#Outbox').click(function()
			// {
			// 	$('#dir').html('To');
			// 	functin_check ('Outbox');

			// });
			// function functin_check(someid)
			// {


			// 	$.ajax({
			// 		type: 'GET',
			// 		url: "<?php //echo Router::url(array('controller' => 'messages', 'action' =>'sent_messages'), true); ?>",
			// 		data:{someid:someid},
			// 		success : function(data){
			// 			$('#table_body').empty().html(data);
			// 		}

			// 	});

		}
	});

</script>