<div class="content-wrapper" style="min-height: 348px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-ioxhost"></i> <?php echo "Upload Signature" ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('visitor_book', 'can_add')) { ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo "Upload Signature"  ?></h3>
                        </div><!-- /.box-header -->
                        <?php //echo $this->session->flashdata('msg')  ?>
                        <form id="form1" action="<?php echo site_url('admin/temporary_admission/upload_signature') ?>"   method="post" accept-charset="utf-8" enctype="multipart/form-data" >
                        <div class="box-body">
    <?php echo $this->session->flashdata('msg') ?>

    <div class="form-group">
        <label for="pwd"><?php echo "Name of the Staff" ?></label>  <small class="req"> *</small>
        <input type="text" class="form-control" value="<?php echo set_value('name'); ?>" name="staffname" id="staffname">
        <span class="text-danger"><?php echo form_error('name'); ?></span>
    </div>

    <div class="form-group">
        <label for="pwd"><?php echo "Mail Id" ?></label>
        <input type="text" class="form-control" value="<?php echo set_value('contact'); ?>" name="mail" id="mail">
    </div>

    <div class="form-group">
        <label for="pwd"><?php echo "X-coordinate"?></label>
        <input type="text" class="form-control" value="<?php echo set_value('id_proof'); ?>" name="xcordinate">
    </div>

    <div class="form-group">
        <label for="email"><?php echo "Y-coordinate" ?></label> 
        <input type="text" class="form-control" value="<?php echo set_value('pepples'); ?>" name="ycoordinate">
    </div>

    <div class="form-group">
        <label for="email"><?php echo "Hierarchy of mail" ?></label> 
        <input type="text" class="form-control" value="<?php echo set_value('order'); ?>" name="orders">
    </div>
    <div class="form-group">
    <label for="hierarchy"><?php echo "Select Role" ?></label> 
    <select class="form-control" id="role" name="role">
        <option value="">Select Role</option>
        <?php foreach($roles as $role): ?>
            <option value="<?php echo $role['id']; ?>" <?php echo set_select('orders', $role['id']); ?>>
                <?php echo $role['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


    <div class="form-group">
        <label for="email"><?php echo "Page No" ?></label> 
        <input type="text" class="form-control" value="<?php echo set_value('page_no'); ?>" name="page_no">
    </div>

    <div class="form-group">
        <label for="exampleInputFile"> <?php echo $this->lang->line('attach_document'); ?></label>
        <div>
            <input class="filestyle form-control" type='file' name='file' id="file_upload" />
        </div>
        <span class="text-danger"><?php echo form_error('file'); ?></span>
    </div>

    <div class="form-group">
        <input type="checkbox" id="picked_by_id" name="picked_by_id" value="1" onclick="toggleFields()"> Tick if you are the picked by staff
    </div>
    <div class="form-group">
        <input type="checkbox" id="picked_by_id" name="enable" value="1" onclick="toggleFields()"> Whatsapp Enable
    </div>
    
</div>
                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>

            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('visitor_book', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo "Upload Signature" ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('visitor'); ?> <?php echo $this->lang->line('list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo "Staff Name"; ?>
                                        </th>
                                        <th><?php echo "Mail id" ?>
                                        </th>
                                        <th><?php echo "X-coordinate" ?>
                                        </th>
                                        <th><?php echo "Y-coordinate" ?></th>
                                        <th><?php echo "Hierarchy "?>
                                        </th>
                                        <th><?php echo "Role "?>
                                        </th>
                                        <th><?php echo "Page No "?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($res)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($res as $key => $value) {
                                            ?>
                                            <tr>
                                            <td class="mailbox-name">
    <?php echo !empty($value['staffname']) ? $value['staffname'] : 'Pickup Staff'; ?>
</td>
<td class="mailbox-name">
    <?php echo !empty($value['mail']) ? $value['mail'] : 'Pickup Mail'; ?>
</td>

                                                <td class="mailbox-name"><?php echo $value['xcordinate']; ?> </td>
                                                <td class="mailbox-name"> <?php echo $value['ycoordinate']; ?></td>
                                                <td class="mailbox-name"> <?php echo $value['orders']; ?></td>
                                                <td class="mailbox-name">
                                                    <?php 
                                                    foreach ($roles as $role) {
                                                        if ($role['id'] == $value['role']) { 
                                                            echo $role['name']; 
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                                <td class="mailbox-name"> <?php echo $value['pageno']; ?></td>
                                                <td class="mailbox-date pull-right" "="">
                                                   
                                                <?php if (!empty($value['file'])) { ?>
    <a href="<?php echo base_url($value['file']); ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>" download>
        <i class="fa fa-download"></i>
    </a>
<?php } else { ?>
    
<?php } ?>

        <?php if ($this->rbac->hasPrivilege('visitor_book', 'can_edit')) { ?>
                                                        <a href="<?php echo base_url(); ?>admin/temporary_admission/signedit/<?php echo $value['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <?php }
                                                    ?>

        <?php if ($this->rbac->hasPrivilege('visitor_book', 'can_delete')) { ?>
                                                        <?php if ($value['file'] !== "") { ?><a href="<?php echo base_url(); ?>admin/temporary_admission/signdelete/<?php echo $value['id']; ?><?php echo $value['image']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" data-original-title="<?php echo $this->lang->line('delete'); ?>">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
            <?php } else { ?>
                                                            <a href="<?php echo base_url(); ?>admin/temporary_admission/signdelete/<?php echo $value['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" data-original-title="Delete">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
            <?php }
        }
        ?>
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
            </div><!--/.col (left) col-8 end-->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- new END -->
<div id="visitordetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('details'); ?></h4>
            </div>
            <div class="modal-body" id="getdetails">


            </div>
        </div>
    </div>
</div>
</div><!-- /.content-wrapper -->
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
function toggleFields() {
    var isChecked = document.getElementById('picked_by_id').checked;
    document.getElementById('staffname').disabled = isChecked;
    document.getElementById('mail').disabled = isChecked;
    document.getElementById('file_upload').disabled = isChecked;
    document.getElementById('role').disabled = isChecked;

}
</script>
<script type="text/javascript">





                                                $(function () {

                                                    $(".timepicker").timepicker({
                                                        // showInputs: false,
                                                        // defaultTime: false,
                                                        // explicitMode: false,
                                                        // minuteStep: 1
                                                    });
                                                });

                                                $(document).ready(function () {
                                                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

                                                    $('#date').datepicker({
                                                        //  format: "dd-mm-yyyy",
                                                        format: date_format,
                                                        autoclose: true
                                                    });



                                                });

                                                function getRecord(id) {
                                                    //alert(id);
                                                    $.ajax({
                                                        url: '<?php echo base_url(); ?>admin/visitors/details/' + id,
                                                        success: function (result) {
                                                            //alert(result);
                                                            $('#getdetails').html(result);
                                                        }


                                                    });

                                                }

</script>
