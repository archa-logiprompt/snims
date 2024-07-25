<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>
<div class="content-wrapper" style="/* [disabled]min-height: 946px; */">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <form action="<?php echo site_url('admin/timetablenew/create') ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-3">                                   
                                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>><?php echo $class['class'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
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
                                        <label for="exampleInputEmail1" style="width:100%"><?php echo $this->lang->line('subject'); ?></label>
                                        <select  id="subject_id" name="subject_id[]" class="form-control selectpicker" multiple="multiple" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                    </div>
                            
                         </div>
                         
                         <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="width:100%"><?php echo $this->lang->line('department'); ?></label>
                                        <select  id="department_id" name="department_id[]" class="form-control selectdep"  multiple="multiple" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('department_id'); ?></span>
                                    </div>
                            
                         </div>
     
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-sm"><?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
                <?php
                if (!empty($timetableSchedule)) {  //var_dump($timetableSchedule);
                    ?>
                    
                    
                    
                    
                    
                    
                    
                     <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('class_timetable'); ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!empty($timetableSchedule)) {
                                ?>
                                <form role="form" id=""  class="addmarks-form"  method="post" action="<?php echo site_url('admin/timetablenew/create') ?>">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('day'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('start_time'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('end_time'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('room_no'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($timetableSchedule)) {
                                                    foreach ($timetableSchedule as $key => $value) {
									
									
												
									if(!empty($value))
									{
									if(array_keys($value)> 0)
														{
														$i=0; foreach($value as $val)
														{
                                                        ?>
      
                                                    <tr id="<?php echo $key ?>">  <input type="hidden" value="<?php echo $key; ?>"  class="edit_day" name="i[]"> </input>
<input type="hidden" value="<?php echo $val->post_id;?>" class="edit_id" name="edit_<?php echo $key;?>"></input>
                                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                                                    <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                                                        <th>
                                                            <?php if($i==0){  echo $key; } ?>
                                                            <input type="hidden" name="key[]" value="<?php echo $key ?>"/>     
                                                        </th>
                                                        <th>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="stime_<?php echo $key; ?>[]" class="form-control timepicker stime" id="stime_" value="<?php echo $val->starting_time; ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                        </th>
                                                        <th>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="etime_<?php echo $key; ?>[]" class="form-control timepicker etime" id="etime_" value="<?php echo $val->ending_time; ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group">
                                                                <input type="text" name="room_<?php echo $key; ?>[]" class="form-control"  id="room_" value="<?php echo $val->room_no; ?>" placeholder="<?php echo $this->lang->line('enter_room_no'); ?>">
                                                            </div>
                                                        </th>
                                                        
                                                        <th>
                                                        <?php if($i==0){ ?>
                                                        <button id="btnAdd" class="btn btn-success btn-sm checkbox-toggle pull-right btnAdd" style="background-color: #085d35fc !important;display: block;" value="<?php echo $key ?>" type="button"><i class="fa fa-plus"></i> Add</button><?php }else { ?><button id="btnAdd" class="btn btn-primary btn-sm checkbox-toggle pull-right btnremove" value="" type="button"  style="display: block;"><i class="fa fa-trash"></i></button><?php } ?>
                                                        </th>
                                                        
                                                        
                                                        
                                                    </tr>
                                                  
                                                    
                                                   
                                                    
                                                    
                                                    <?php
                                                $i++;}} }
												
												else{ ?>
													
													<tr id="<?php echo $key ?>">  <input type="hidden" value="<?php echo $key; ?>"  class="edit_day" name="i[]"> </input>
<input type="hidden" value="<?php //echo $value->post_id;?>" class="edit_id" name="edit_<?php echo $key;?>"></input>
                                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                                                    <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                                                        <th>
                                                            <?php echo $key; ?>
                                                            <input type="hidden" name="key[]" value="<?php echo $key ?>"/>     
                                                        </th>
                                                        <th>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="stime_<?php echo $key; ?>[]" class="form-control timepicker stime" id="stime_" value="<?php echo $value->starting_time; ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                        </th>
                                                        <th>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="etime_<?php echo $key; ?>[]" class="form-control timepicker etime" id="etime_" value="<?php echo $value->ending_time; ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group">
                                                                <input type="text" name="room_<?php echo $key; ?>[]" class="form-control"  id="room_" value="<?php echo $value->room_no; ?>" placeholder="<?php echo $this->lang->line('enter_room_no'); ?>">
                                                            </div>
                                                        </th>
                                                        
                                                        <th>
                                                        <button id="btnAdd" class="btn btn-success btn-sm checkbox-toggle pull-right btnAdd" style="background-color: #085d35fc !important;display: block;" value="<?php echo $key ?>" type="button"><i class="fa fa-plus"></i> Add</button>
                                                        </th>
                                                        
                                                        
                                                        
                                                    </tr>
													
													
													<?php 
													
													
													}
												
												
												
                                            }}
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right" name="save_exam" value="save_exam"><?php echo $this->lang->line('save'); ?></button>
                                </form>
                                <?php
                            } else {
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                     
                     
                     
                     
                     
                     
                     
                </div> 
            </div> 
            <?php
        } else {
            
        }
        ?>
    </section>
</div>

<script type="text/javascript">

    $(document).ready(function () {
	 //$('.selectpicker').multiselect();
	$(document).on('click', '.btnAdd', function (e) 
	{
		 
		 var datePickerOptions = {
             showInputs: false,
            defaultTime: false,
            explicitMode: false,
            minuteStep: 1
}
	   var data='';
	 var key=$(this).val();
	 var day=$(this).parent().parent('#'+key);
	  data +='<tr><th><input type="hidden" name="key[]" value="'+key+'"></th><th><div class="bootstrap-timepicker"><div class="form-group"><div class="input-group"><input type="text" name="stime_'+key+'[]" class="form-control timepicker stime" id="stime_'+key+' " value=""><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></div></div></th><th><div class="bootstrap-timepicker"><div class="form-group"><div class="input-group"><input type="text" name="etime_'+key+'[]" class="form-control timepicker etime" id="etime_" value=""><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></div></div></th><th><div class="form-group"><input type="text" name="room_'+key+'[]" class="form-control"  id="room_" value="<?php //echo $value->room_no; ?>" placeholder="<?php echo $this->lang->line('enter_room_no'); ?>"></div></th><th><button id="btnAdd" class="btn btn-primary btn-sm checkbox-toggle pull-right btnremove" value="" type="button"  style="display: block;"><i class="fa fa-trash"></i></button> </th></tr>';
	
	day.after(data);
	
        $(".timepicker").timepicker({datePickerOptions});
         
	});

	$(document).on('click', '.btnremove', function (e) 
	{
		
		$(this).parent().parent().remove();
		
	});
	
	
		
	$(document).on('change', '.stime', function (e) 
	{ 
		var stime=$(this).val();
		var day=$(this).parent().parent().parent().parent().parent().find('.edit_day').val();
		var class_id=$('#class_id').val();
		var section_id=$('#section_id').val();
		var subject_id=$('#subject_id').val();
        var base_url = '<?php echo base_url() ?>';
            
        $.ajax({
                type: "POST",
                url: base_url + "admin/timetable/check_exists",
                data: {'stime': stime,'day': day,'class_id': class_id,'section_id': section_id,'subject_id': subject_id},
                dataType: "json",
                success: function (data) 
				{
					console.log(data);
                	//$('#teacher_id').append(div_data);
                }
        });
	});
		
		
		
		
        $(document).on('change', '#class_id', function (e) {
			//alert(0);
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
                    console.log(data);
                $.each(data, function (i, obj)
                {
                        div_data += "<option value=" + obj.id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
		
		
		
		
		
        $(document).on('change', '#section_id', function (e) {
            $('#subject_id').html("");
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctBySection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.name + "</option>";
                    });
                    $('#subject_id').append(div_data);
					 $('.selectpicker').multiselect();
                }
            });
        });
		
		$(document).on('change', '#subject_id', function (e) {
            $('#department_id').html("");
            var subject_id = $('#subject_id').val();
			//var section_id = $('#section_id').val();
            //var class_id = $('#class_id').val();
			
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/get_subjectdepartment",
                data: {'subject_id': subject_id},
                dataType: "json",
                success: function (data) {
                $.each(data, function (i, obj)
                {
                   div_data += "<option value=" + obj.id + ">" + obj.department_name + " " + "</option>";
                });
                $('#department_id').append(div_data);
				 $('.selectdep').multiselect();
                }
            });
        });
    });
	
</script>

<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    $(function () {

        $(".timepicker").timepicker({
            showInputs: false,
            defaultTime: false,
            explicitMode: false,
            minuteStep: 1
        });
    });

    $(document).ready(function () {
		 
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        var subject_id = '<?php echo set_value('subject_id') ?>';
		 var department_id = '<?php echo set_value('department_id') ?>';
		
        getSectionByClass(class_id, section_id);
       // getSubjectByClassandSection(class_id, section_id, subject_id);
	    getSubjctBySection(class_id, section_id, subject_id);
		getSubjectDepartment(class_id, section_id, subject_id,department_id);
		
    });

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

    function getSubjectByClassandSection(class_id, section_id, subject_id) {
        console.log("rrrr");
        if (class_id != "" && section_id != "" && subject_id != "") {
            $('#subject_id').html("");
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subject_id == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subject_id').append(div_data);
                }
            });
        }
    }
	
	
	
	function getSubjctBySection(class_id, section_id, subject_id) {
       
        if (class_id != "" && section_id != "" && subject_id != "") {
            $('#subject_id').html("");
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctBySection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subject_id == obj.id) {
                            sel = "selected";
                        }
             div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name +"</option>";
                    });

                    $('#subject_id').append(div_data);
                }
            });
        }
    }
	
	
	
	function getSubjectDepartment(class_id, section_id, subject_id,department_id) {
         console.log("department_id");
        if (class_id != "" && section_id != "" && subject_id != ""&& department_id != "") {
            $('#department_id').html("");
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/department/get_subjectdepartment",
                data: {'subject_id': subject_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (department_id == obj.id) {
                            sel = "selected";
                        }
      div_data += "<option value=" + obj.id + " " + sel + ">" + obj.department_name + "</option>";
                    });

                    $('#department_id').append(div_data);
                }
            });
        }
    }
	
	
	
	    
	
	
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>