<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics') ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_add') || $this->rbac->hasPrivilege('assign_class_teacher', 'can_edit')) {
                ?>
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo "Edit Combined Subject" ?></h3>

                    </div><!-- /.box-header -->
                    <form id="form1" method="post" action="<?php echo base_url() ?>admin/subject/combinedSubjectedit/<?php echo $itemid ?>" accept-charset="utf-8">
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

                                    <?php
                                        foreach ($classlist as $class_key => $class_value) {
                                                ?>

                                    <option <?php
                                            if ($item['class_id'] == $class_value["id"]) {
                                                echo "selected=selected";
                                            }
                                            ?> value="<?php echo $class_value["id"] ?>">
                                        <?php echo $class_value["class"] ?></option>
                                    <?php
                                            } 
                                            ?>
                                </select>

                                <span class="text-danger"><?php echo form_error('class'); ?></span>
                            </div>

                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small
                                    class="req"> *</small>

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
            if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_add') || $this->rbac->hasPrivilege('assign_class_teacher', 'can_edit')) {
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
                                        <th>Subject 1
                                        </th>
                                        <th>Subject 2
                                        </th>

                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;

                                    foreach ($items as $items) {
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
    if (class_id != "") {
        
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '';
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
function getSubjectsByClassandSection(class_id, section_id,subject_id1,subject_id2) {
        $('#subject1_id').html("");
        $('#subject2_id').html("");
        var section_id = section_id;
        var class_id = class_id;
        var base_url = '<?php echo base_url() ?>';
        var div_data1 = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        var div_data2 = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

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

                    var sel1 = "";
                    var sel2 = "";
                    if (subject_id1 == obj.id) {
                        sel1 = "selected";
                    }
                    if (subject_id2 == obj.id) {
                        sel2 = "selected";
                    }

                         
                    div_data1 += "<option value=" + obj.id + " " + sel1 + ">" + obj.name +
                        "</option>";
                    
                        
                     div_data2 += "<option value=" + obj.id + " " + sel2 + ">" + obj.name +
                        "</option>";
                        
                     
                });
                
                  $('#subject1_id').append(div_data1);
                $('#subject2_id').append(div_data2);
                
                let $subject1 = $('#subject1_id');
                let $subject2 = $('#subject2_id');
                updateSubjects('subject1_id', $subject1, $subject2);
                updateSubjects('subject2_id', $subject2, $subject1);
                
                function updateSubjects(changedId, $subjectA, $subjectB) {
                let value = $subjectA.val();
                $subjectB.find('option').show().filter(function() {
                return $(this).val() === value;
                }).hide();
                }
        
           


              
            }
        });
}


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
        updateSubjects('subject1_id', $subject1, $subject2);
        updateSubjects('subject2_id', $subject2, $subject1);
    });


var section_id = "<?php echo $item['section_id'] ?>";
var subject_id1 = "<?php echo $item['subject1'] ?>";
var subject_id2 = "<?php echo $item['subject2'] ?>";

getSectionByClass('<?php echo $item['class_id'] ?>', '<?php echo $item['section_id'] ?>');
getSubjectsByClassandSection('<?php echo $item['class_id'] ?>', '<?php echo $item['section_id'] ?>',subject_id1,subject_id2);



$(document).on('change','#class_id',function(e){
    let class_id = $(this).val()
    
    getSectionByClass(class_id,0)
})

var date_format =
    '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
$('body').on('focus', ".date", function() {
    $(this).datepicker({
        format: date_format,
        autoclose: true
    });
});
</script>

<?php

 
?>