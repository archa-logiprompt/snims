
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small> </h1>
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
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('marks_register', 'can_add')) { ?>
                                
                            <?php } ?>
                        </div>
                    </div>
                    <form action="<?php echo site_url('admin/mark/earnedmark') ?>"  method="post" accept-charset="utf-8" id="schedule-form">
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" name="save_exam" value="search" >                               
                                <?php echo $this->customlib->getCSRF(); ?>
                                <!-- /.col -->
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('exam_name'); ?></label>

                                        <select autofocus="" id="exam_id" name="exam_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            
                                        </select>
                                        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                    </div>
                                </div>
                                
                               
                                
                                
                                
                                <!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </form>
                </div>
                <?php
				
                if (isset($studentList)) { 
                    ?>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-list"></i> <?php echo $this->lang->line('marks_register'); ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                           
                                ?>

                                <form role="form" id="" class="" method="post" action="<?php echo site_url('admin/mark/earnedmark') ?>">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <div class="table-responsive">
           <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
							<?php echo $this->lang->line('marks_register'); ?></div>
                                        <table class="table table-striped table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('admission_no'); ?>
                                                    </th>
                                                    
                                                    <th>
                                                        <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('father_name'); ?>
                                                    </th>
                                                    <?php $co=0; foreach ($examsubjects as $key => $value) { 
                                                        // var_dump($examsubjects)?>
                                                    <th>
                                                       <?php
                                                              // echo $value['name'] ;

                                                     if($value['theory']!=null && $value['practical']==null && $value['viva']==null){
                                                        echo $value['name'] ;
                                                       echo '('. $value['theory'] .')' ;
                                                   }
                                                   else if($value['practical']!=null && $value['theory']==null && $value['viva']==null){
                                                      echo $value['name'] ;
                                                       echo '('. $value['practical'] .')' ;
                                                   }
                                             
                                                   else if($value['viva']!=null && $value['practical']==null && $value['theory']==null )  {
                                                    echo $value['name'] ;
                                                       echo '('. $value['viva'] .')' ;
                                                   }

                                                     if($value['theory']!=null && $value['practical']!=null){
                                                  
                                                    echo  $value['name']  ;
                                                     echo '('. $value['theory'] .')' ;
                                                      echo '('. $value['practical'] .')' ;
                                                   }
                                                       $subjectid[$co]['theory']=$value['theory']; 
                                                       $subjectid[$co]['practical']=$value['practical'];
                                                       $subjectid[$co]['viva']=$value['viva'];
                                                       $subjectid[$co]['subjectid']=$value['subject_id']; 
                                                ?>
                                                    </th>
                                                         <?php
                                                         $co++;
                                                    } ?>
                                                    
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                
                                                

                                            <?php
                                            foreach ($studentList as $key => $student) {
												
                                                $total_marks = 0;
                                                $obtain_marks = "0";
                                                $result = "Pass";
                                                ?>
                                                <input type="hidden" name="student[]" value="<?php echo $student['student_id'] ?>">
                                                <input type="hidden" name="exam_id" value="<?php echo $exam_id['exam_id']?>">
                                                
                                                <tr>
                                                    <td>
                                                        <?php echo $student['admission_no'] ?>
                                                    </td>
                                                     
                                                    <td>
                                                        <?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $student['father_name'] ?>
                                                    </td>
                                                   
                                                        <?php foreach ($subjectid as $key => $value) { ?>
                                                    <td>

                                                       <?php  
                                                       if($value['theory']!=NULL ){     

                                                        print_r( getfullmark($value['subjectid'], $student['student_id'],'theory',$exam_id ) );
                                                        if($value['practical']!=NULL){
                                                                  print_r(' - '. getfullmark($value['subjectid'], $student['student_id'],'practical',$exam_id) );
                                                        }
                                                    }
                                                     if($value['practical']!=NULL && $value['theory']==NULL ){
                                                        print_r( getfullmark($value['subjectid'], $student['student_id'],'practical',$exam_id ) );
                                                    }
                                                     if($value['viva']!=NULL){
                                                        print_r( getfullmark($value['subjectid'], $student['student_id'],'viva',$exam_id 
                                                    ) );
                                                    }
                                                    ?>

                                                    </td>
                                                         <?php 
                                                    } ?>
                                                    
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <?php
                             
                            ?>

                        </div><!---./end box-body--->
                    </div>
                </div>
                <!-- right column -->
            </div>   <!-- /.row -->
            <?php
        } 
        ?>
    </section><!-- /.content -->
</div>
<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
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
	
	
	
	
	function getexamtype(exam_id,class_id,section_id) {
            if (exam_id!="") {
                $('#exam_id').html("");
             
              var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/exam/get_examtype",
                     data: {'class_id':class_id,'section_id':section_id},
                    dataType: "json",
                    success: function (data) {
                       
                        
                    $.each(data, function (i, obj)
                    {
						 var sel = "";
                            if (exam_id == obj.id) {
                                sel = "selected";
                            }

                        div_data += "<option value=" + obj.id + " " +sel+ ">" + obj.name + "</option>";

                    });

                    $('#exam_id').append(div_data);
                    }
                });
            }
        }
	
	
	
	
	
	

    $(document).ready(function () {
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
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
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
		var exam_id='<?php echo $exam_id ?>';
        getSectionByClass(class_id, section_id);
		getexamtype(exam_id,class_id,section_id);
		
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
		
		
		
		
		 $(document).on('change', '#section_id', function (e) {
            $('#exam_id').html("");
           var class_id=$('#class_id').val();
			var section_id=$('#section_id').val();
			
			 var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/exam/get_examtype",
                data: {'class_id':class_id,'section_id':section_id},
                dataType: "json",
                success: function (data) {

                      console.log(data);

                    $.each(data, function (i, obj)
                    {

                        div_data += "<option value=" + obj.id + ">" + obj.name + "</option>";

                    });

                    $('#exam_id').append(div_data);
                   }
                 });
                 });
		
		
		
		
		
		
		
    });
    $(document).on('change', '#exam_id', function (e) {
        $("form#schedule-form").submit();
    });
</script>
