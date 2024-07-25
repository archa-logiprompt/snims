<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form action="<?php echo site_url('admin/mark/internalmarks') ?>"  method="post" accept-charset="utf-8" id="schedule-form">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <div class="row">
                                <input type="hidden" name="save_exam" value="search" >                               
                                <?php echo $this->customlib->getCSRF(); ?>
                                <!--<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php //echo $this->lang->line('exam_name'); ?></label>
                                        <select autofocus="" id="exam_id" name="exam_id" class="form-control" >
                                            <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                            <?php
                                            //foreach ($examlist as $exam) {
                                                ?>
                                                <option value="<?php //echo $exam['id'] ?>" <?php
                                                //if ($exam_id == $exam['id']) {
                                                    //echo "selected =selected";
                                                //}
                                                ?>><?php //echo $exam['name'] ?></option>
                                                        <?php
                                                        //$count++;
                                                    //}
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('exam_id'); ?></span>
                                    </div>
                                </div>--><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select  id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
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
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?>  <?php echo $this->lang->line('type'); ?> </label>

                               <select autofocus=""  id="sub_type" name="sub_type" class="form-control" >
                               <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <option <?php if($sub_type=='Theory') { echo 'selected';} ?> value="Theory">Theory</option>
                                 <option <?php if($sub_type=='Practical') { echo  'selected';} ?> value="Practical">Practical</option>            
                                        </select>
                                        <span class="text-danger"><?php echo form_error('sub_type'); ?></span>
                                    </div>

                                </div>
                                
                                
                                
                                <!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </form>
                </div>
                <?php
				//var_dump($studentList[0]);
                if (isset($studentList)) {
			
					
                    ?>


                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('fill_mark'); ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!empty($studentList)) {
							
                                ?>
                                <form role="form" id=""  class="addmarks-form"  method="post" action="<?php echo site_url('admin/mark/internalmarks') ?>">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="sub_type" value="<?php echo $sub_type ?>" />
                                   <!-- <input type="hidden" name="exam_id" value="<?php //echo $exam_id; ?>">-->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <!--<th>
                                                        <?php //echo $this->lang->line('admission_no'); ?>
                                                    </th>-->
                                                    <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                    <th>
                                                        <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    <?php
                                                    //$s = 0;
                                                    //foreach ($studentList[0] as $key => $sub) {
														
                                                        if (!empty($studentList[0])) {
                                                            if ($s == 0) {
															
                                                                foreach ($studentList[0]['sub_array'] as $key => $sub) {
																	
																	
																	
                                                                    ?>
                                                                    <th>
                                                                        <?php
                                                                        echo $sub['name']?> 
                                                                    </th>
                                                                    <?php
                                                                }
                                                           }
                                                        } 
														else {
                                                            ?>

                                                            <?php
                                                        }
                                                        //$s++;
                                                    //}
                                                    ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                              $s=0;
                                                foreach ($studentList as $key => $student) {
													//var_dump($student);
                                                    ?>
                                                 <input type="hidden" name="student[]" value="<?php echo $student['student_id'] ?>">   

                                            <?php if($s==0) { foreach($student['sub_array'] as $key=> $marks){  ?>
                                               
                                                <input type="hidden" name="subject[]" value="<?php echo $marks["subject_id"] ?>">
                                                                   
                                               

                                                <?php
											}} $s++; }
                                            ?>

                                            

                                            <?php foreach ($studentList as $key => $student) {
												
												
                                                ?>
                                               
                                                <tr>
                                                 
                                                    <td>     <?php echo $student['roll_no'] ?></td>
                                <td>        <?php echo $student['firstname'] . " " . $student['lastname']; ?> </td>
                                                   
                                                  
                                                   
                                                            
                                               <?php  foreach($student['sub_array'] as $key=> $marks){?>
                                                            <td>
                                                                <div class="form-group">
                                                                   
                                                                   <!-- <input type="hidden" name="subject[]" value="<?php //echo $marks["subject_id"] ?>">-->
                                                                   
                                                                    <input type="text"  name="studentmark<?php echo $marks['subject_id']."_".$student['student_id']?>" class="form-control input-sm" id="subject_<?php //echo $student['student_id'] . "_" . $exam_schedule['exam_schedule_id']; ?>" value="<?php echo $marks['mark'] ?>" placeholder="Enter Marks">
                                                                </div>
                                                            </td>
                                                            <?php
                                                       
														}
														
                                                    ?>

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right" name="save_exam" value="save_exam"><?php echo $this->lang->line('save'); ?></button>
                                </form>
                                <?php
                            } else {
                                ?>

                                <div class="alert alert-info">
                                    <?php echo $this->lang->line('no_record_found'); ?>
                                </div>


                                <?php
                            }
                            ?>
                        </div><!---./end box-body--->
                    </div>
                </div>            

            </div>   <!-- /.row -->
            <?php
        } else {
            
        }
        ?>

    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
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
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });

                    $('#feetype_id').append(div_data);
                }
            });
        });
    });
    $(document).on('change', '#sub_type', function (e) {
        $("form#schedule-form").submit();
    });
</script>
<script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/custom/bootstrap-datepicker.js"></script>
<script>
    $('.sandbox-container').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $(function () {
        $('.addmarks-form').validate({

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('input[id^="subject_"]').each(function () {
            $(this).rules('add', {
                required: true,
                messages: {
                    required: "Required"
                }
            });
        });
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
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
</script>
