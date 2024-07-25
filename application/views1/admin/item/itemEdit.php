<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-object-group"></i> <?php echo $this->lang->line('inventory'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('item', 'can_add') || $this->rbac->hasPrivilege('item', 'can_edit')) { ?> 
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_item'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url('admin/item/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" >
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
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $item['name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label>

                                    <select  id="item_category_id" name="item_category_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemcatlist as $item_category) {
                                            ?>
                                            <option value="<?php echo $item_category['id'] ?>"<?php
                                            if (set_value('item_category_id', $item['item_category_id']) == $item_category['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $item_category['item_category'] ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
                                </div>





                          <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('price'); ?></label>
                                    <input autofocus="" id="price" name="price" placeholder="" type="text" class="form-control"  value="<?php echo set_value('price',$item['price']); ?>" />
                                    <span class="text-danger"><?php echo form_error('price'); ?></span>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description', $item['description']); ?></textarea>
                                    <span class="text-danger"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Experiment name</label>
                                    <input autofocus="" id="exp" name="exper" placeholder="" type="text" class="form-control"  value="<?php echo set_value('experiment',$item['experiment']); ?>" />
                                    <span class="text-danger"><?php echo form_error('exper'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Make/Model</label>
                                    <input autofocus="" id="make" name="make" placeholder="" type="text" class="form-control"  value="<?php echo set_value('make',$item['make']); ?>" />
                                    <span class="text-danger"><?php echo form_error('make'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Serial-Number</label>
                                    <input autofocus="" id="serial" name="serial" placeholder="" type="text" class="form-control"  value="<?php echo set_value('serialno',$item['serialno']); ?>" />
                                    <span class="text-danger"><?php echo form_error('serial'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Asset-ID</label>
                                    <input autofocus="" id="asset" name="asset" placeholder="" type="text" class="form-control"  value="<?php echo set_value('assetid',$item['assetid']); ?>" />
                                    <span class="text-danger"><?php echo form_error('asset'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Installation-Date</label>
                                    <input autofocus="" id="inst" name="inst" placeholder="" type="text" class="form-control"  value="<?php echo set_value('installation_date',$item['installation_date']); ?>" />
                                    <span class="text-danger"><?php echo form_error('inst'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date of Purchase</label>
                                    <input autofocus="" id="pur" name="pur" placeholder="" type="text" class="form-control"  value="<?php echo set_value('	purchase',$item['purchase']); ?>" />
                                    <span class="text-danger"><?php echo form_error('con'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact Type</label><small class="req"> *</small>
                                    <input autofocus="" id="con" name="con" placeholder="" type="text" class="form-control"  value="<?php echo set_value('contype',$item['contype']); ?>" />
                                    <span class="text-danger"><?php echo form_error('con'); ?></span>
                                </div>
                                
                                

                            <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo 'Department'; ?></label>

                                    <select  id="department" name="department" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($department as $department) {
                                            ?>
                                            <option value="<?php echo $department['id'] ?>"<?php
                                            if (set_value('department', $item['department']) == $department['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $department['department_name'] ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('department'); ?></span>
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Working status</label>
                                    <input autofocus="" id="work" name="work" placeholder="" type="text" class="form-control"  value="<?php echo set_value('	working',$item['working']); ?>" />
                                    <span class="text-danger"><?php echo form_error('con'); ?></span>
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <input autofocus="" id="remark" name="remark" placeholder="" type="text" class="form-control"  value="<?php echo set_value('	remark',$item['remark']); ?>" />
                                    <span class="text-danger"><?php echo form_error('con'); ?></span>
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
            if ($this->rbac->hasPrivilege('item', 'can_add') || $this->rbac->hasPrivilege('item', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?> ">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('item_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
							<?php echo $this->lang->line('item_list'); ?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('item'); ?></th>                                 
                                        <th><?php echo $this->lang->line('category'); ?>
                                        </th>
                                        <th><?php echo "Price"; ?>
                                        </th>
                                        <th><?php echo $this->lang->line('department'); ?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($itemlist)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($itemlist as $items) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $items['name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($items['description'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $items['description']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>


                                                <td class="mailbox-name">
        <?php echo $items['item_category']; ?>

                                                </td>
                                                <td class="mailbox-name">
                                                        <?php
                                                        echo $items['price'];
                                                        ;
                                                        ?>

                                                    </td>
                                                    <td class="mailbox-name">

        <?php echo $items['department']; ?>

                                                </td>
           


                                                <td class="mailbox-date pull-right"">
        <?php if ($this->rbac->hasPrivilege('item', 'can_edit')) { ?> 
                                                        <a href="<?php echo base_url(); ?>admin/item/edit/<?php echo $items['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
        <?php }if ($this->rbac->hasPrivilege('item', 'can_delete')) { ?>  
                                                        <a href="<?php echo base_url(); ?>admin/item/delete/<?php echo $items['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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

                                           $('#inst').datepicker({
                                            //  format: "dd-mm-yyyy",
                                            format: date_format,
                                            autoclose: true
                                            });
											
											
											 $('#pur').datepicker({
                                            //  format: "dd-mm-yyyy",
                                            format: date_format,
                                            autoclose: true
                                            });

                                            $("#btnreset").click(function () {
                                            $("#form1")[0].reset();
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