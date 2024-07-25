
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
                        
                    </div>
                    <form action="<?php echo site_url('admin/mark/supplementry_exam') ?>"  method="post" accept-charset="utf-8" id="schedule-form">
                        <div class="box-body">
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
                                                ?>><?php //echo $exam['name'].' [ '.$exam['exam_type'].' ]'; ?></option>
                                                        <?php
                                                        //$count++;
                                                    //}
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('exam_id'); ?></span>
                                    </div>
                                </div>--><!-- /.col -->
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </form>
                </div>
                <?php
				
                if (isset($examSchedule)) { ?>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-list"></i> <?php echo $this->lang->line('marks_register'); ?></h3>
                        </div>
                        <div class="box-body">
                           <?php
                            if (!empty($examSchedule)) {
                                ?>

                                <form role="form" id="" class="" method="post" action="<?php echo site_url('admin/mark/create') ?>">
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
                                                        <?php echo $this->lang->line('roll_no'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    
 <th>
                                                        <?php echo $this->lang->line('gender'); ?>
                                                    </th>
                                                <th>   </th>    
                                                    
                                                    
                                                    
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                           <?php foreach($examSchedule as $key=>$student) {   ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $student['admission_no'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $student['roll_no'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                    </td>
                                                   
                                                   <td><?php echo $student['gender']; ?>   </td> 
                                                   
                                                   <td> <a  class="btn btn-primary btn-sm supplementry" data-toggle="tooltip" title=""   data-student_id=" <?php echo $student['id'] ?>"  data-student_session_id=" <?php echo $student['student_session_id']; ?>  " >  <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('add'); ?> </a>  </td>
                                                     

                                                </tr> <?php  }?>
                                            

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            }
                            ?>

                        </div><!---./end box-body--->
                    </div>
                </div>
                <!-- right column -->
            </div> 
            
             <?php
        } else {
            
        }
        ?>  <!-- /.row -->
            
    </section><!-- /.content -->
</div>
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

    $(document).ready(function () 
	{   
        $(document).on('change', '#class_id', function (e) 
		{
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                	type: "GET",
                	url: base_url + "sections/getByClass",
                	data: {'class_id': class_id},
                	dataType: "json",
                	success: function (data) 
					{
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
        getSectionByClass(class_id, section_id);
		
        $(document).on('change', '#feecategory_id', function (e) 
		{
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
    $(document).on('change', '#section_id', function (e) {
        $("form#schedule-form").submit();
    });
	
	
	
	$(document).on('click', '.supplementry', function () 
{
	

var student_id=$(this).data('student_id');

	
$.ajax({
                type: "post",
                url: '<?php echo site_url("admin/mark/supple_report") ?>',
               
                data: {'student_id':student_id},
                success: function (response) {
					
					console.log(response);
					
				$('#supple').html(response);
				
				$(".hide_supplementry").hide();
   
                     $(".modal_date").datepicker( {
						  autoclose: true,
                          format: "MM-yyyy",
                           startView: "year", 
                           minViewMode: "months"
					  });
		
				 $("#scheduleModal").modal('show');	
					
                   
                }
            });
});

$(document).on('click', '.div-close', function () 
{ 	
$(".hide_supplementry").hide();
});

$(document).on('click', '.hide_supple', function () 
{ 
	var student_id=$(this).attr('data-studid');
	var class_id=$(this).attr('data-classid');
	var section_id=$(this).attr('data-sectionid'); 
	var appeared_id=$(this).attr('data-appearedid'); 
	var subject_id=$(this).attr('data-subjectid'); 

	$.ajax({
            type: "post",
            url: '<?php echo site_url("admin/mark/supply_exam_result") ?>',   
            data: {'student_id':student_id,'class_id':class_id,'section_id':section_id,'appeared_id':appeared_id,'subject_id':subject_id},
            success: function (response) 
			{
				$('.tbody').html(response);
				$(".modal_date").datepicker({
						  autoclose: true,
                          format: "MM-yyyy",
                           startView: "year", 
                           minViewMode: "months"
				});
				$(".hide_supplementry").show();
            }
      });
});
	
</script>





<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="document">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <center> <h4 class="modal-title"> University Exam Supplementry Details </h4>    </center>
            </div>
            <div class="modal-body" id="supple" style="margin-left: 34px; margin-right: 34px;">
            
            
            
            </div>
            <div class="modal-footer">
             <!--<button type="button" aria-controls="DataTables_Table_0" class="btn btn-sm btn-danger login-submit-cs fa fa-print buttons-print" id="printtrans"><?php// echo $this->lang->line('print'); ?></button>-->
                <button type="button" class="btn btn-default " data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>



