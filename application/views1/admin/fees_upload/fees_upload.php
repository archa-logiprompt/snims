<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('upload', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('fees'); ?> <?php echo $this->lang->line('upload'); ?></h3>
                        </div><!-- /.box-header -->

          <form id="form1" action="<?php echo base_url() ?>admin/upload"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                                    <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                    <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                    <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control" data-height="40"  value="<?php echo set_value('documents'); ?>" />
                                    <span class="text-danger"><?php echo form_error('documents'); ?></span>
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
            if ($this->rbac->hasPrivilege('income', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
               <h3 class="box-title titlefix"> <?php echo $this->lang->line('fees'); ?> <?php echo $this->lang->line('upload') ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('fees'); ?>  <?php echo $this->lang->line('upload'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th> <?php echo $this->lang->line('name'); ?>
                                        </th>
                                       
                                        <th><?php echo $this->lang->line('date'); ?>
                                        </th>
                                       
                                       <th></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($list)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($list as $list) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $list['name'] ?></a>
     
                                                </td>
                                                
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($list['date'])) ?></td>
                                               
                                                <td class="mailbox-date pull-right">
                                                   
                                                        
                                                       <!-- <a href="<?php //echo base_url(); ?>admin/upload/download/<?php //echo $list['file'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php //echo $this->lang->line('download'); ?>">
                                                            <i class="fa fa-download"></i>
                                                        </a>-->
                                                        <a href="<?php echo base_url(); ?>admin/upload/download/<?php echo $list['file'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                   
                                                    

                                                    
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('upload', 'can_delete')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/upload/delete/<?php echo $list['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            //endDate: '+0d',
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

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

