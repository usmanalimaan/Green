<div id="alert-success" class="alert alert-success">
	<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Success!</strong> <?php echo $message; ?>
</div>

<script language="javascript" type="text/javascript">
   $(document).ready(function(){
   		setTimeout(function(){
			$(".alert-success").hide('slow')
			},2000
		);
   		
   });
</script>