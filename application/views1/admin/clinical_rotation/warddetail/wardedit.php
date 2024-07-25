<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-money"></i> <?php echo $this->lang->line('warddetail'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
          if ($this->rbac->hasPrivilege('warddetail', 'can_add')) {
             ?>
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('warddetail'); ?></h3>
                    </div>
                    <!-- /.box-header -->

                    <form id="warddetail" action="<?php echo base_url() ?>admin/Warddetail/edit/<?php echo $id; ?>"
                        name="warddetail" method="post" accept-charset="utf-8">
                        <div class="box-body">

                            <?php echo $this->customlib->getCSRF(); ?>
                            <input name="id" type="hidden" class="form-control"
                                value="<?php echo $warddetail->id; ?>" />


                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('aliasname'); ?></label>
                                <small class="req">*</small>
                                <input autofocus="" id="aliasname" name="aliasname" placeholder="" type="text"
                                    class="form-control" value="<?php echo $warddetail->aliasname; ?>" />
                                <span class="text-danger"><?php echo form_error('aliasname'); ?></span>
                            </div>

                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1">Ward Name</label>
                                <small class="req">*</small>

                                <select autofocus="" id="name_department" name="name_department" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                                foreach ($departmentlist as $department) {
                                                    ?>
                                    <option value="<?php echo $department['id'] ?>" <?php
			if (set_value('name_department',$warddetail->deptnames) == $department['id']) {
                                                        echo "selected =selected";
                                                    }
                                                    ?>><?php echo $department['deptname'] ?></option>

                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                </select>

                                <span class="text-danger"><?php echo form_error('name_department'); ?></span>

                                <!--<div class="col-md-1">
           <div class="form-group" style="width: 4% !important;">
       <button class="btn btn-primary btn-sm" type="button" id="append"><i class="fa fa-plus"></i>
       
                          
							</button>
                                 </div>
                                    </div>-->
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('block'); ?></label> <small
                                    class="req">*</small>
                                <input autofocus="" id="block" name="block" placeholder="" type="text"
                                    class="form-control"
                                    value="<?php echo set_value('block',$warddetail->block); ?>" />
                                <span class="text-danger"><?php echo form_error('block'); ?></span>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">No Of Beds</label>
                                <small class="req">*</small>
                                <input autofocus="" id="noofbeds" name="noofbeds" placeholder="" type="text"
                                    class="form-control"
                                    value="<?php echo set_value('noofbeds',$warddetail->noofbeds); ?>" />
                                <span class="text-danger"><?php echo form_error('noofbeds'); ?></span>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('landmark'); ?></label>
                                <small class="req">*</small>
                                <input autofocus="" id="landmark" name="landmark" placeholder="" type="text"
                                    class="form-control"
                                    value="<?php echo set_value('landmark',$warddetail->landmark); ?>" />
                                <span class="text-danger"><?php echo form_error('landmark'); ?></span>
                            </div>


                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1">Ward Contact Details</label>
                                <small class="req">*</small>
                                <input autofocus="" id="wardcontactdetails" name="wardcontactdetails" placeholder=""
                                    type="text" class="form-control"
                                    value="<?php echo set_value('wardcontactdetails',$warddetail->wardcontact); ?>" />
                                <span class="text-danger"><?php echo form_error('wardcontactdetails'); ?></span>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">In charge</label>
                                <small class="req">*</small>
                                <input autofocus="" id="incharge" name="incharge" placeholder="" type="text"
                                    class="form-control"
                                    value="<?php echo set_value('incharge'),$warddetail->incharge; ?>" />
                                <span class="text-danger"><?php echo form_error('incharge'); ?></span>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit"
                                class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div>
            <!--/.col (right) -->
            <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('warddetail', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('warddetail'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">
                            <?php echo $this->Setting_model->getCurrentSchoolName();?></br>
                            <?php echo $this->lang->line('warddetail'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>
                                            Ward Name
                                        </th>


                                        <th>
                                            <?php echo $this->lang->line('block'); ?>
                                        </th>



                                        <th>
                                            <?php echo $this->lang->line('incharge'); ?>
                                        </th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($warddetaillist as $warddetail) {
                                        ?>
                                    <tr>
                                        <td class="mailbox-name"><?php echo $warddetail['deptname'] ?></td>

                                        <td class="mailbox-name"><?php echo $warddetail['block'] ?></td>

                                        <td class="mailbox-name"><?php echo $warddetail['incharge'] ?></td>
 
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div>
            <!--/.col (left) -->

            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div>
            <!--/.col (right) -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
$(document).on('click', '#append', function() {
    $("#scheduleModal").modal('show');


});
</script>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="document">
    <div class="modal-dialog modal-lg" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center>
                    <h4 class="modal-title"></h4>Enter the Department Name
                </center>
            </div>

            <form id="warddetail" action="<?php echo base_url() ?>admin/Warddetail/editdepartment/<?php echo $id; ?>"
                name="warddetail" method="post" accept-charset="utf-8">
                <input name="id" type="hidden" class="form-control"
                    value="<?php echo set_value('id', $department['id']); ?>" />

                <div class="modal-body" id="transcript" style="margin-left: 34px; margin-right: 34px;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1"
                                    style="padding-left: 50px;"><?php echo $this->lang->line('name_department'); ?></label>
                                <!-- <small class="req">*</small>-->
                            </div>
                            <div class="col-md-6">
                                <input autofocus="" id="department_name" name="department_name" placeholder=""
                                    type="text" class="form-control"
                                    value="<?php echo set_value('department_name',$department['deptname']); ?>" />
                                <span class="text-danger"><?php echo form_error('department_name'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    <!--  <button type="button" class="btn btn-default" data-dismiss="modal"><?php //echo $this->lang->line('cancel'); ?></button>-->
                </div>
            </form>
        </div>
    </div>
</div>