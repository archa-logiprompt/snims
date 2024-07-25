<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>11</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('exam', 'can_add') || $this->rbac->hasPrivilege('exam', 'can_edit')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_exam'); ?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <form action="<?php echo site_url("admin/exam/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('exam'); ?>  <?php echo $this->lang->line('type'); ?></label><small class="req"> *</small>
                                        <select  id="exam_type" name="exam_type" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <option <?php if($exam['exam_type']=='university exam') {echo 'selected="selected"';} ?>  value="university exam"> University Exam  </option>
                                            <option <?php if($exam['exam_type']=='college Exam') {echo 'selected="selected"';} ?>   value="college Exam"> College Exam</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('exam_type'); ?></span>
                                    </div>
                                
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $exam['name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                
                                <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>

                                        <select  id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($exam['class_id'] == $class['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>

                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>


                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
                                    <textarea class="form-control" id="note" name="note" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('note'); ?><?php echo set_value('note', $exam['note']) ?></textarea>
                                    <span class="text-danger"><?php echo form_error('note'); ?></span>
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
            if ($this->rbac->hasPrivilege('exam', 'can_add') || $this->rbac->hasPrivilege('exam', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('exam_list'); ?></h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->

                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
							<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
							<?php echo $this->lang->line('exam_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('name'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($examlist)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($examlist as $exam) {
                                            ?>

                                            <tr>

                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover" ><?php echo $exam['name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($exam['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $exam['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-date pull-right">
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('exam', 'can_edit')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/exam/edit/<?php echo $exam['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('exam', 'can_delete')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/exam/delete/<?php echo $exam['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <a href="<?php echo base_url(); ?>admin/exam/examclasses/<?php echo $exam['id'] ?>"class="btn btn-info btn-xs">
                                                        <?php echo $this->lang->line('view_status'); ?></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
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



 function getSectionByClass(class_id, section_id) 
	{
        if (class_id != "" && section_id != "") 
		{
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                	type: "GET",
                	url: base_url + "sections/getByClass",
                	data: {'class_id': class_id},
                	dataType: "json",
                	success: function (data) {
						$.each(data, function (i, obj)
						{
							var sel = "";
							if (section_id == obj.section_id) {
								sel = "selected";
							}
							div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
						});
                    	$('#section_id').append(div_data);
                	}
            });
        }
    }





    $(document).ready(function () {

        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });

$(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            var url = "<?php
        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2)) {
            echo "getClassTeacherSection";
        } else {
            echo "getByClass";
        }
        ?>";
            $.ajax({
                type: "GET",
                url: base_url + "sections/" + url,
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });

                    $('#section_id').append(div_data);
                }
            });
        });




     




      var class_id='<?php echo $exam['class_id'] ?>';
		var section_id='<?php echo $exam['section_id'] ?>';
		getSectionByClass(class_id, section_id);



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