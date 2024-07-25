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

                    <form id="warddetail" action="<?php echo base_url() ?>admin/warddetail" name="warddetail"
                        method="post" accept-charset="utf-8">
                        <div class="box-body">
                                                      
                            <?php echo $this->customlib->getCSRF(); ?>
                           

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('aliasname'); ?></label>
                                
                                <input autofocus="" id="aliasname" name="aliasname" placeholder="" type="text"
                                    class="form-control" value="<?php echo set_value('aliasname'); ?>" />
                                <span class="text-danger"><?php echo form_error('aliasname'); ?></span>
                            </div>


                            <div class="form-group">

                                <label
                                    for="exampleInputEmail1">Ward Name</label>
                                    <small class="req">*</small>
                                    <select autofocus="" id="name_department" name="name_department"
                                        class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($departmentlist as $department) {
                                            ?>
                                        <option value="<?php echo $department['id'] ?>" <?php
                                            if (set_value('name_department') == $department['id']) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $department['deptname'] ?></option>
                                        <?php
                                                    $count++;
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('name_department'); ?></span>
                               

                                <!-- <div class="col-md-1">
                                    <div class="form-group" style="width: 4% !important;">
                                        <button class="btn btn-primary btn-sm" type="button" id="append"><i
                                                class="fa fa-plus"></i>


                                        </button>
                                    </div>
                                </div> -->
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('block'); ?></label> 
                                <input autofocus="" id="block" name="block" placeholder="" type="text"
                                    class="form-control" value="<?php echo set_value('block'); ?>" />
                                <span class="text-danger"><?php echo form_error('block'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">No Of Beds</label>
                                
                                <input autofocus="" id="noofbeds" name="noofbeds" placeholder="" type="text"
                                    class="form-control" value="<?php echo set_value('noofbeds'); ?>" />
                                <span class="text-danger"><?php echo form_error('noofbeds'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('landmark'); ?></label>
                                
                                <input autofocus="" id="landmark" name="landmark" placeholder="" type="text"
                                    class="form-control" value="<?php echo set_value('landmark'); ?>" />
                                <span class="text-danger"><?php echo form_error('landmark'); ?></span>
                            </div>

                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1">Ward contact</label>
                                
                                <input autofocus="" id="wardcontactdetails" name="wardcontactdetails" placeholder=""
                                    type="text" class="form-control"
                                    value="<?php echo set_value('wardcontactdetails'); ?>" />
                                <span class="text-danger"><?php echo form_error('wardcontactdetails'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">In Charge</label>
                                
                                <input autofocus="" id="incharge" name="incharge" placeholder="" type="text"
                                    class="form-control" value="<?php echo set_value('incharge'); ?>" />
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


                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
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

                                        <td class="mailbox-date pull-right">
                                            <?php
                                    if ($this->rbac->hasPrivilege('warddetail', 'can_edit')) {
                                            ?>
                                            <a href="<?php echo base_url(); ?>admin/warddetail/edit/<?php echo $warddetail['detailid'] ?>"
                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                title="<?php echo $this->lang->line('edit'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php } ?>
                                            <?php
                                                if ($this->rbac->hasPrivilege('warddetail', 'can_delete')) {
                                                    ?>
                                            <a href="<?php echo base_url(); ?>admin/warddetail/delete/<?php echo $warddetail['detailid'] ?>"
                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                title="<?php echo $this->lang->line('delete'); ?>"
                                                onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
                </div>
            </div>
            <!--/.col (left) -->

            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->



<div class="inc">
</div>

<script>
/////alertbox////////////


function display(wardname, aliasname) {
    /* $('#wardname').html("");
      $('#aliasname').html("");*/



}

$(document).on('click', '#append', function() {
    // $("#scheduleModal").modal('show');
    // var wardname = $('#wardname').val();
    // var aliasname = $('#aliasname').val();


    // localStorage.setItem('myTable2', wardname);
    // localStorage.setItem('myTable3', aliasname);

});




$(document).ready(function() {

    if ('myTable2' in localStorage) {


        // $("#aliasname").val(localStorage.getItem('myTable3'));
        // $("#wardname").val(localStorage.getItem('myTable2'));



    }
    $(document).on("click", "#sub", function() {
        // localStorage.setItem('myTable2', "");
        // localStorage.setItem('myTable3', "");


    });




});
</script>



<form id="warddetail" action="<?php echo base_url() ?>admin/Warddetail/adddepartment" name="warddetail" method="post"
    accept-charset="utf-8">

    <div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="document">
        <div class="modal-dialog modal-lg" style="width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center>
                        <h4 class="modal-title"></h4>Enter the Department Name
                    </center>
                </div>




                <div class="modal-body" id="transcript" style="margin-left: 34px; margin-right: 34px;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1"
                                    style="padding-left: 50px;"><?php echo $this->lang->line('name_department'); ?></label>
                                <!-- -->
                            </div>
                            <div class="col-md-6">
                                <input autofocus="" id="department_name" name="department_name" placeholder=""
                                    type="text" class="form-control"
                                    value="<?php echo set_value('department_name'); ?>" />
                                <span class="text-danger"><?php echo form_error('department_name'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnsub" type="submit"
                        class="allot-fees btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    <!--  <button type="button" class="btn btn-default" data-dismiss="modal"><?php //echo $this->lang->line('cancel'); ?></button>-->
                </div>

            </div>
        </div>
    </div>

</form>