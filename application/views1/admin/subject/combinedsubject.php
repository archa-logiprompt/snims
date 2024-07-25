<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_add')) {
                ?>
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo "Combined Subject"; ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo base_url() ?>admin/subject/combinedSubject" method="post"
                        accept-charset="utf-8">
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
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small
                                    class="req"> *</small>
                                <select class="form-control" name="class" id="class_id">
                                    <option value=''><?php echo $this->lang->line('select') ?></option>
                                    <?php
                                        foreach ($classlist as $class_key => $class_value) {
                                            ?>

                                    <option value="<?php echo $class_value["id"] ?>"><?php echo $class_value["class"] ?>
                                    </option>
                                    <?php
                                        }
                                        ?>
                                </select>

                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>

                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small
                                    class="req"> * </small>


                                <select class="form-control" id="section_id" name="section">
                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                </select>

                                <span class="text-danger"><?php echo form_error('section'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject 1</label><small class="req"> *</small>
                                <select class="form-control" name="sub1" id="subject1_id">
                                    <option value=''><?php echo $this->lang->line('select') ?></option>

                                </select>

                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject 2</label><small class="req"> * </small>


                                <select class="form-control" id="subject2_id" name="sub2">
                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                </select>

                                <span class="text-danger"><?php echo form_error('section'); ?></span>
                            </div>



                        </div>

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
            if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('class_teacher_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
                                <?php echo $this->lang->line('class_teacher_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('class'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('section'); ?>
                                        </th>
                                        <th>subject 1
                                        </th>
                                        <th>subject 2
                                        </th>

                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;

                                    foreach ($date_items as $items) {
                                        ?>
                                    <tr>
                                        <td class="mailbox-name">
                                            <?php echo getclassname($items["class_id"]); ?>

                                        </td>


                                        <td>

                                            <?php echo getsectionname($items["section_id"]); ?>

                                        </td>
                                        <td>

                                            <?php echo (getsubjectname($items["subject1"])); ?>

                                        </td>
                                        <td>

                                            <?php echo (getsubjectname($items["subject2"])); ?>

                                        </td>

                                        <td class="mailbox-date pull-right">
                                            <?php
                                                if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_edit')) {
                                                    ?>
                                            <a href="<?php echo base_url(); ?>admin/subject/combinedSubjectedit/<?php echo $items["id"]; ?>"
                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                title="<?php echo $this->lang->line('edit'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php
                                                }
                                                if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_delete')) {
                                                    ?>
                                            <a href="<?php echo base_url(); ?>admin/subject/combinedSubjectdelete/<?php echo $items["id"]; ?>"
                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                title="<?php echo $this->lang->line('delete'); ?>"
                                                onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
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

<script type="text/javascript">
function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section +
                        "</option>";
                });

                $('#section_id').append(div_data);
            }
        });
    }
}
$(document).ready(function() {
    $(document).on('change', '#class_id', function(e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.section_id + ">" + obj
                        .section + "</option>";
                });

                $('#section_id').append(div_data);
            }
        });
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';


    $(document).on('change', '#section_id', function(e) {
        $('#subject1_id').html("");
        $('#subject2_id').html("");
        var section_id = $(this).val();
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

        var url = "<?php
       $admin=$this->session->userdata('admin');
       if($admin['roles']['Teacher']) {
            echo "get_subByteacher";
        } else {
            echo "getSubjctByClassandSectionNew";
        }
        ?>";

        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/" + url,
            data: {
                'class_id': class_id,
                'section_id': section_id
            },
            dataType: "json",
            success: function(data) {
                console.log(data);

                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.id + ">" + obj.name +
                        "</option>";
                });

                $('#subject1_id').append(div_data);
                $('#subject2_id').append(div_data);
            }
        });
    });


    $(function() {
        let $subject1 = $('#subject1_id');
        let $subject2 = $('#subject2_id');

        function updateSubjects(changedId, $subjectA, $subjectB) {
            let value = $subjectA.val();
            
            $subjectB.find('option').show().filter(function() {
                return $(this).val() === value;
            }).hide();
        }

        $subject1.on('change', function() {
            updateSubjects('subject1_id', $subject1, $subject2);
        });

        $subject2.on('change', function() {
            updateSubjects('subject2_id', $subject2, $subject1);
        });
    });




});
</script>