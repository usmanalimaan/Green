<div id="alert-danger" class="alert alert-danger">
	<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Error!</strong> <?php echo $message; ?>
</div>

<script language="javascript" type="text/javascript">
   $(document).ready(function(){
   		setTimeout(function(){
			$(".alert-danger").hide('slow')
			},2000
		);
   		
   });
</script>