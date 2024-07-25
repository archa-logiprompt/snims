<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('starting_invoice', 'can_add')) { ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('invoice'); ?></h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('invoice/create') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?> 
                                <?php echo $this->customlib->getCSRF(); ?>
                                
                             
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="invoice" name="invoice" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice',$list->starting_inv); ?>" />
                                    <span class="text-danger"><?php echo form_error('invoice'); ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $list->id ?>" />
                            
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>  
                </div>
            <?php } ?>
            <!--<div class="col-md-<?php
            if ($this->rbac->hasPrivilege('starting_invoice', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>"> 
                    
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('invoice'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('list_msg')) { ?>
                            <?php echo $this->session->flashdata('list_msg') ?>
                        <?php } ?>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('invoice'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('invoice'); ?></th>
                                        
                                        <th><?php echo $this->lang->line('active'); ?></th>
                                        <th><?php echo $this->lang->line('activate'); ?></th>
                                         <th><?php echo $this->lang->line('action'); ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
								
                                    //foreach ($list as $listyear) {
										
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"><?php //echo $listyear['financial_year'] ?></td>
                                            <td class="mailbox-name"><?php
                                                //if ($listyear['is_active'] =='yes') {
                                                    ?>
                                                    <span class="label bg-green"><?php echo $this->lang->line('active'); ?></span>
                                                    <?php
                                               // } else {
                                                    
                                                //}
                                                ?></td>
                                           <td>     <button data-id="<?php echo $listyear['id'];  ?>"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing" id="activate" type="button" class="btn-success "><?php echo $this->lang->line('activate'); ?></button></td>
                                           <td>
                                           
                                            <?php  if ($this->rbac->hasPrivilege('financial_year', 'can_delete')) { ?>
                                                    <a href="<?php echo base_url(); ?>financial_year/delete/<?php echo $listyear['id'] ?>"class="btn btn-default btn-xs "data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                           <?php } ?>
                                           
                                           </td>
                                           
                                           
                                           
                                        </tr>
                                        <?php
                                        $count++;
                                   //}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>-->

        </div> 
    </section>
</div>
<script type="text/javascript">
    $("#btnreset").click(function () {
        $("#form1")[0].reset();
    });
	
	 $(document).ready(function () {
	
	
	$(document).on('click', '#activate', function (e) {
            
             var id=$(this).data('id');
              var $this = $(this);
             $this.button('loading');
          
            $.ajax({
                type: "post",
                url: '<?php echo site_url("financial_year/activate") ?>',
                dataType: 'JSON',
                data: {'id': id},
                success: function (data) {
                  
				   $this.button('reset');
                    location.reload(true);
                }
            });


        });

	
	 });
	
	
	
</script>