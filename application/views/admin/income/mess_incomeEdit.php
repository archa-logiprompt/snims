<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('income'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('income', 'can_add') || $this->rbac->hasPrivilege('income', 'can_edit')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_income'); ?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <form action="<?php echo site_url("admin/mess_income/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                                
                                
                                 <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                                    <input id="personname" name="personname" placeholder="" type="text" class="form-control"  value="<?php echo set_value('personname',$income['person_name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('personname'); ?></span>
                                </div>  
                                
                                
                                
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo $this->lang->line('income_head'); ?></label>
                                    
                                      <select autofocus="" id="head_id" name="head_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($incomehead as $inchead) {
                                            ?>
                                            <option value="<?php echo $inchead['id'] ?>"<?php
                                            if ($income['head_id'] == $inchead['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $inchead['category'] ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>

                                    
                                    <span class="text-danger"><?php echo form_error('head_id'); ?></span>
                                </div>
                                
                                
                                
                                                    
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                                    <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $income['name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                    <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($income['date']))); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?><small class="req"> *</small></label>
                                    <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount', $income['amount']); ?>" />
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                                
                                <div class="form-group">
                            
                          
                                <label class="radio-inline">
                                    <input <?php if($income['payment_mode']=='Cash')  { echo 'checked=checked'; } ?> type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input <?php if($income['payment_mode']=='Cheque')  { echo 'checked=checked'; } ?> type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input <?php if($income['payment_mode']=='DD')  { echo 'checked=checked'; } ?> type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                
                                
                                <label class="radio-inline">
                                    <input <?php if($income['payment_mode']=='Bank')  { echo 'checked=checked'; } ?> type="radio" name="payment_mode_fee" value="Bank"><?php echo $this->lang->line('bank'); ?>
                                </label>
                                
                                
                                <span class="text-danger" id="payment_mode_error"></span>
                                  
                            
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                           
        <textarea class="form-control" rows="3" id="ad_note"  name="ad_note" placeholder=""><?php echo $income['description'] ?></textarea>
                           
                        </div>
                        
                        
                                
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <?php //echo json_decode($income['note']); ?>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?><?php echo set_value('description', $income['note']) ?></textarea>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
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
            if ($this->rbac->hasPrivilege('income', 'can_add') || $this->rbac->hasPrivilege('income', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('income_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"> <?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('income_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                     <th> <?php echo $this->lang->line('name'); ?>
                                        </th>
                                    
                                        <th><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('name'); ?>
                                        </th>
                                       
                                        <th><?php echo $this->lang->line('date'); ?>
                                        </th>
                                     
                                        <th><?php echo $this->lang->line('amount'); ?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($incomelist)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($incomelist as $income) {
                                            ?>
                                            <tr>
                                            
                                             <td class="mailbox-name"><?php echo $income['person_name'] ?></td>
                                            
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $income['name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($income['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $income['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($income['date'])) ?></td>

                                              
                                                <td class="mailbox-name"><?php echo ($currency_symbol . $income['amount']); ?></td>
                                                <td class="mailbox-date pull-right">
                                                   

                                                    <?php
                                                    if ($this->rbac->hasPrivilege('income', 'can_edit')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/mess_income/edit/<?php echo $income['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('income', 'can_delete')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/mess_income/delete/<?php echo $income['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            endDate: '+0d',
            autoclose: true
        });
    });
</script>
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