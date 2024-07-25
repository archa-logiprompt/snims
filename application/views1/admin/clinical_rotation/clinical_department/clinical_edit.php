<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
      <h1><i class="fa fa-plus-square"></i> <?php echo $this->lang->line('clinical_department'); ?></h1>
    	</section>

    <!-- Main content -->
 <section class="content">
    <div class="row">
        <?php
          if ($this->rbac->hasPrivilege('clinical_department', 'can_add')) {
             ?>
           <div class="col-md-4">
            <!-- Horizontal Form -->
             <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('update_department'); ?></h3>
                 </div>
                 <!-- /.box-header -->
                 
                        <form id="clinical_department" action="<?php echo base_url() ?>admin/clinical_department/edit/<?php echo $id; ?>"  name="clinical_department" method="post" accept-charset="utf-8">
                     <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) { ?>
                         <?php echo $this->session->flashdata('msg') ?>
                          <?php } ?>
                       <?php
                       if (isset($error_message)) {
                        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                             }
                             ?>
                       <?php echo $this->customlib->getCSRF(); ?>
 <input name="id" type="hidden" class="form-control" value="<?php echo set_value('id', $department['id']); ?>" />



<div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('name_department'); ?></label> 								           <small class="req">*</small>
              <input autofocus="" id="department_name" name="department_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('department_name',$department['deptname']); ?>" />
                 <span class="text-danger"><?php echo form_error('department_name'); ?></span>                     </div>

        
                
             
             
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
            if ($this->rbac->hasPrivilege('clinical_department', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
            
            
            
                 <!-- general form elements -->
                <?php ?><div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('clinical_department'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">
						<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('clinical_department'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>
										<?php echo $this->lang->line('name_department'); ?>
                                        </th>

                                        
											  
  													
 													
 								<th class="text-right"><?php echo $this->lang->line('action'); ?></th>					


                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($clinical_department_list as $department) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"><?php echo $department['deptname'] ?></td>
                                            
                                  <td class="mailbox-date pull-right">
                                     <?php
                                    if ($this->rbac->hasPrivilege('clinical_department', 'can_edit')) {
                                            ?>
     <a href="<?php echo base_url(); ?>admin/clinical_department/edit/<?php echo $department['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('clinical_department', 'can_delete')) {
                                                    ?>
   <a href="<?php echo base_url(); ?>admin/clinical_department/delete/<?php echo $department['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
                </div><?php ?>
            
            
            
            
              
            </div><!--/.col (left) -->

            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>