<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Session->flash('error'); ?>
<?php echo $this->Session->flash('successfully'); ?>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-upload"></i> CSV Data Import  </div>
                    <!-- <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div> -->
                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo $this->base;?>/csvimports/import" enctype="multipart/form-data" id="myform" method="post" class="form-horizontal">
                    <br><div class="row">
                    <div class="col-md-1"></div>
                      <div class="form-group col-md-5 btn">
                        
                        <a href="<?php echo $this->base;?>/csvimports/csvdell" onclick="if (confirm('Are you sure you want to delete the whole previous data upload by CSV  ?')) { return true; } return false;">
                            <i class="fa fa-trash-o btn btn-circle blue-chambray"> Delete All CSV Upload Data</i>
                        </a>
                        
                      </div>
                    </div>
                    <!--  -->
                    <div class="row">
                    <div class="col-md-1"></div>
                      <div class="form-group col-md-5">
                        <label for="id_country">Select Category</label>
                        <select  id="id_country" class="form-control" name="data[Category][category_id]"  required>
                          <?php foreach ($someinfo as $value):?>
                            <option value="<?php echo $value['CategoryDescription']['category_id']?>">
                              <?php echo $value['CategoryDescription']['name'];?>
                            </option>
                          <?php endforeach;?>
                        </select>  
                      </div>
                    </div>
                    <!--  -->
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="exampleInputFile"> Select File 
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="file" id="exampleInputFile" name="data[Csvimport][file_name]" required>
                                            <p class="help-block"> Accepts up to 1MB & format CSV </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="disc">
                                <li>
                                    Column order should not be changed
                                </li>
                                <li>
                                    All Fields are compulsory
                                </li>
                                <li>
                                    All date fields should be in YYYY-MM-DD format
                                </li>
                                <li>
                                    Use Id for fields which are given in id                    
                                </li>
                                <!-- <li>
                                    Each import file should be configured for 100 records or less 
                                </li>
                                <li>
                                    Multiple import files may be required                    
                                </li> -->
                                <!-- <li>Sample CSV file:
                                    <a href="<?php //echo $this->base;?>/csvimports/download" class="download" target="_blank" title="Download">Download</a>
                                </li> -->
                                 <li>Sample CSV file:
                                   <!--  <a href="<?php //echo $this->base;?>/csvimports/download" class="download" target="_blank" title="Download">Download</a> -->
                                </li>
                             </ul>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-circle blue-chambray" type="submit"> Upload </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
<script type="text/javascript">

  $(document).ready(function() { 
  $("#chat_id").animate({ scrollTop: $('#chat_id').prop("scrollHeight") }, 1000);
  return false;


});
var someid=$('#someid').val();
setTimeout(function(){
    // alert('ready');
   startRefresh();
}, 2000);

function startRefresh() {
    // alert(someid);

setTimeout(startRefresh,1000);
      $.ajax({ 
       url     : "<?php echo Router::url(array( 'action' =>'updated_messages'), true); ?>",
       type    : "get",
       cache   : false,
       dataType: 'html',
       data    : {someid:someid },
       success : function(data){
         // $('.chats:last').after(data);
         $('#chat_id').html(data);
         //alert(data);
      }
    });
}
$('#btn_reply').click({
  alert('hahahahha');
  save_messages();
alert("hahahahfhahsdh");});
  function save_messages()
{
  alert('hahahahha');
  var reply=$('#Message_replys').val();
    $.ajax({ 
     url     : "<?php echo Router::url(array( 'action' =>"save_reply"), true); ?>",
     type    : "get",
     cache   : false,
     data    : {messa:reply,id:someid },
  });
  // $('#Message_replys').val('');

};
$('#Message_replys').addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        save_messages();
    }
});
</script>