
  <div class="row">
      <div class="col-md-6">
           <!-- BEGIN SAMPLE FORM PORTLET-->
  <div class="portlet light bordered">
  <?php echo $this->Session->flash('auth'); ?>
      <?php echo $this->Session->flash('error'); ?>
      <?php echo $this->Session->flash('successfully'); ?>
    <div class="portlet-title">
                                    <div class="caption font-green">
                                        <i class="icon-pin font-green"></i>
                                        <span class="caption-subject bold uppercase"> Form to input data</span>
                                    </div></div>
     <div class="portlet-body form">
         <!-- <form role="form" action="add"> -->
         <?php echo $this->form->create('User',array('id'=>'','action'=>'index')); ?>
            <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input form-md-floating-label">
                     <input type="text" class="form-control" id="username" name="username" >
                     <label for="form_control_1">User Name</label>
                     <span class="help-block">Enter user name</span>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input form-md-floating-label">
                     <input type="email" class="form-control" id="form_control_1" name="email">
                     <label for="form_control_1">Email Id</label>
                     <span class="help-block">Enter Email Id</span>
                     </div>
                </div> 
            </div>
             <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input form-md-floating-label">
                     <input type="text" class="form-control" id="form_control_1" name="cell" >
                     <label for="form_control_1">Cell Number</label>
                     <span class="help-block">Enter Cell Number</span>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input form-md-floating-label">
                     <input type="text" class="form-control" id="form_control_1"  name="city">
                     <label for="form_control_1">City Name</label>
                     <span class="help-block">Enter City Name</span>
                     </div>
                </div> 
            </div>
            </div>
            <div class="form-actions noborder">
                 <button type="Submit" class="btn blue">Submit</button>
                 <button type="button" class="btn default">Cancel</button>
                </div>
         <!-- </form> -->
     </div>

                            <!-- END SAMPLE FORM PORTLET-->
      </div>
    </div>
      <div class="col-md-6">
        
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Table to Show form input values</span>
                                    </div></div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                <span></span>
                                </label>
                            </th>
                            <th> Username </th>
                            <th> Email </th>
                            <th> Cell </th>
                            <th> City </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($Users as $user ): ?>
                     
                       <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="checkboxes" value="1" />
                            <span></span>
                            </label>
                        </td>
                        <td> <?php echo $user['User']['username']; ?></td>
                        <td>
                        <a href="#"> <?php echo $user['User']['email']; ?> </a>
                        </td>
                        <td>
                        <span > <?php echo $user['User']['cell']; ?> </span>
                        </td>
                        <td class="center"> <?php echo $user['User']['city']; ?> </td>
                        
                       </tr>
                    <?php  endforeach; ?>                    
                    </tbody>
                </table>
            </div>
        </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
    </div>
                         
                          
</div>


