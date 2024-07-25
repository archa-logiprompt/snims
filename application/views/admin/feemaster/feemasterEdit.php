
<style>
.switchcheck {
    float: right !important;
   
	}
	</style>






<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('fees_master', 'can_add') || $this->rbac->hasPrivilege('fees_master', 'can_edit')) { ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_fees_master') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url("admin/feemaster/edit/" . $feegroup_type->id) ?>"  id="feemasterform" name="feemasterform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>

                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="<?php echo $feegroup_type->id; ?>">
                                        
                                        
                                        
                                       <!-- <div class="form-group">
                                            <label for="exampleInputEmail1"><?php //echo $this->lang->line('year'); ?></label> <small class="req">*</small>

                                            <select autofocus="" id="year" name="year" class="form-control" >
                                                <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                                <?php
                                                //foreach ($feeyearlist as $feeyear) {
                                                    ?>
                                                    <option value="<?php //echo $feeyear['id'] ?>"<?php
                                                    //if (set_value('year',$feegroup_type->year) == $feeyear['id']) {
                                                        //echo "selected =selected";
                                                    //}
                                                    ?>><?php //echo $feeyear['year'] ?></option>

                                                    <?php
                                                    //$count++;
                                                //}
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('year'); ?></span>
                                        </div>-->
                                        
                                        
                                        
                                      
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_group'); ?></label><small class="req"> *</small>

                                            <select autofocus="" id="fee_groups_id" name="fee_groups_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php 
                                                foreach ($feegroupList as $feegroup) {
                                                    ?>
                                                    <option value="<?php echo $feegroup['id'] ?>"<?php
                                                    if (set_value('fee_groups_id', $feegroup_type->fee_groups_id) == $feegroup['id']) {
                                                        echo "selected =selected";
                                                    }
                   ?>><?php echo $feegroup['name'] .' [ '. $feegroup['year'].' ] ';  ?></option>

                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('fee_groups_id'); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_type'); ?></label><small class="req"> *</small>

                                            <select  id="feetype_id" name="feetype_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($feetypeList as $feetype) {
                                                    ?>
                                                    <option value="<?php echo $feetype['id'] ?>"<?php
                                                    if (set_value('feetype_id', $feegroup_type->feetype_id) == $feetype['id']) {
                                                        echo "selected =selected";
                                                    }
                                                    ?>><?php echo $feetype['type'] ?></option>

                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('feetype_id'); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('due_date'); ?></label>
                                            <input id="due_date" name="due_date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('due_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($feegroup_type->due_date))); ?>" readonly="readonly" />
                                            <span class="text-danger"><?php echo form_error('due_date'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label><small class="req">*</small>
                                            <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount', $feegroup_type->amount); ?>" />
                                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                        </div>



										<div class="form-group">
                                        <div  class="col-md-12 col-sm-12 img_div_modal minh45">
                                           <!-- <div class="switch-inline">-->
                                                <label><?php echo $this->lang->line('add_fine'); ?> </label>
                                                <div class="material-switch switchcheck">
                                                
                                                    <input  id="enable_student_img" name="is_active_student_img" type="checkbox" class="chk"  value="1" onclick="valueChanged()"<?php if($feegroup_type->addfine==1){
														echo 'checked'; }?>>
                                                    
                                                    <label for="enable_student_img" class="label-success"></label>
                                                </div>
                                          <!--  </div>-->
                                        </div>
                                        </div>
                                        
                                      
                                        <div id="fineid" >
                                        <div class="form-group" id="finetype" >
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fine_type'); ?></label><small class="req"> *</small>

                                            <select  id="finetype_id" name="finetype_id" class="form-control">
                                                <option value="0"><?php echo $this->lang->line('select'); ?></option>
             
                                                
 <option <?php if($feegroup_type->finetype=='Monthly') echo 'selected="selected"'; ?> value="Monthly">Monthly</option>
 <option <?php if($feegroup_type->finetype=='Weekly') echo 'selected="selected"'; ?> value="Weekly">Weekly</option>
   <option <?php if($feegroup_type->finetype=='Daily') echo 'selected="selected"'; ?> value="Daily">Daily</option>
                                                   
                                            </select>
                                            <span class="text-danger"><?php echo form_error('finetype_id'); ?></span>
                                        </div>
                                        
                                        <div class="form-group" id="amounttype">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('amount_type'); ?></label><small class="req"> *</small>

                                            <select  id="amounttype_id" name="amounttype_id" class="form-control" >
                                                <option value="0"><?php echo $this->lang->line('select'); ?></option>
                                               <option  <?php if($feegroup_type->amounttype=='Fixed Amount') echo 'selected="selected"'; ?>id="first" value="Fixed Amount">Fixed Amount</option>
                                               
                                           <option <?php if($feegroup_type->amounttype=='Percentage') echo 'selected="selected"'; ?> id="second" value="Percentage">Percentage</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('amounttype_id'); ?></span>
                                        </div>
                                        
                                     
                                        
                                         <div class="form-group"  id="fixamount" <?php if($feegroup_type->fixedamount){echo '';}else{echo 'hidden';}?>>
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fixed_amount'); ?></label><small class="req"> *</small>
                                          <input id="fixedamount" name="fixedamount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fixed_amount', $feegroup_type->fixedamount); ?>" />
                                            <span class="text-danger"><?php echo form_error('fixed_amount'); ?></span>
                                        </div>
                                        
                                        <div class="form-group"  id="percent" <?php if($feegroup_type->percentage){echo '';}else{echo 'hidden';}?>>
                                           <label for="exampleInputEmail1"><?php echo $this->lang->line('percentage'); ?></label><small class="req"> *</small>
                                            <input id="percentage" name="percentage" placeholder="" type="text" class="form-control"  value="<?php echo set_value('percentage', $feegroup_type->percentage); ?>" />
                                            <span class="text-danger"><?php echo form_error('percentage'); ?></span>
                                        </div>

                                    </div>



                                    </div>
                                    
                                    
             
            
               
                                    
                                    
                                    
                                    
                                    
                                    <div class="col-md-6">

                                    </div>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">

                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('fees_master', 'can_add') || $this->rbac->hasPrivilege('fees_master', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="download_label">
						<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('fees_group'); ?></th>
                                        <th><?php echo $this->lang->line('fees_code'); ?></th>

                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($feemasterList as $feegroup) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $feegroup->group_name." "."(".$feegroup->year.")" ?></a>


                                            </td>


                                            <td class="mailbox-name">
                                                <ul class="liststyle1">
                                                    <?php
                                                    foreach ($feegroup->feetypes as $feetype_key => $feetype_value) {
                                                        ?>
                                                        <li> <i class="fa fa-money"></i>  
                                                            <?php echo $feetype_value->code . " " . $currency_symbol . $feetype_value->amount; ?> &nbsp;&nbsp;
                                                            <?php if ($this->rbac->hasPrivilege('fees_master', 'can_edit')) { ?>
                                                                <a href="<?php echo base_url(); ?>admin/feemaster/edit/<?php echo $feetype_value->id ?>"   data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>&nbsp;
                                                            <?php
                                                            }
                                                            if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) {
                                                                ?>
                                                                <a href="<?php echo base_url(); ?>admin/feemaster/delete/<?php echo $feetype_value->id ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                    <i class="fa fa-remove"></i>
                                                                </a>
        <?php } ?>

                                                        </li>

                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </td>

                                            <td class="mailbox-date pull-right">
    <?php if ($this->rbac->hasPrivilege('fees_group_assign', 'can_view')) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/assign/<?php echo $feegroup->id ?>" 
                                                       class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('assign / view'); ?>">
                                                        <i class="fa fa-tag"></i>
                                                    </a>
                                                <?php } ?>
    <?php if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/deletegrp/<?php echo $feegroup->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
    <?php } ?>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->


                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->


        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->





<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#due_date').datepicker({
            format: date_format,
            autoclose: true
        });
    });


</script>


<script type="text/javascript">




 if ($('#enable_student_img').is(":checked"))
 {
	 
	  $("#fineid").show();
	  
	 
 }
 
 else{
	 $("#fineid").hide(); 
	 
 }

 
	
	$('#amounttype_id').on('change', function() {
		var val=$(this).val();
		if(val=='Fixed Amount')
	
		{ 
		     $("#percent").val(0);
		     $("#percent").hide();
		      
			
			  $("#fixamount").show();
			  
			  
		}
		else if(val=='Percentage')
		{
			$("#fixamount").val(0);
			$("#fixamount").hide();
			
			
		    $("#percent").show();	
		}
		
  
  
});

</script>
<script>
 function valueChanged()
    {
        if ($('#enable_student_img').is(":checked"))
            $("#fineid").show();
			 
       
        else
            $("#fineid").hide();
			
			
    }
</script>	
	

