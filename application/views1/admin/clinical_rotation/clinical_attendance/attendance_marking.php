<style type="text/css">
    .radio {
        
        padding-left: 20px;}
    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px; }
    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out; }
    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1; }
    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
        opacity: 0.65; }
    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
    .radio.radio-inline {
        margin-top: 0; }
    .radio-primary input[type="radio"] + label::after {
        background-color: #337ab7; }
    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #337ab7; }
    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #337ab7; }
    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f; }
    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de; }
    @media (max-width:767px){
        .radio.radio-inline {display: inherit;}
    }      
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form id='form1' action="<?php echo site_url('admin/clinical_department/mark_attendance') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                        
                        
                        
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
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
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('group'); ?></label>
                                        <select  id="group" name="group" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('group'); ?></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label><small class="req"> *</small>
                                        <select  id="subject" name="subject" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('subject'); ?></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('attendance'); ?>
                                            <?php echo $this->lang->line('date'); ?>
                                        </label>
                                        <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>
                                
                                
                                
                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
                <?php
              

                    if(isset($resultlist)) {
						
						
                        ?>
                        <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
						
                            if (!empty($resultlist)) {
                                $checked = "";
                                if (!isset($msg)) {
                              if ($resultlist[0]['attendance_type_id']!=0) {
                                        //if ($resultlist[0]['attendence_type_id'] != 5) {
											
                                       ?>
                                            <div class="alert alert-warning"><?php echo $this->lang->line('attendance_already_submitted_you_can_edit_record'); ?></div>
                                            <?php
                                        //} else {
                                            //$checked = "checked='checked'";
                                            ?>
                                           <!-- <div class="alert alert-warning"><?php //echo $this->lang->line('attendance_already_submitted_as_holiday'); ?>. <?php //echo $this->lang->line('you_can_edit_record'); ?></div>-->
                                            <?php
                                        //}
                                    }
                                } 
								
								else {
                                    ?>
                                    <div class="alert alert-success"><?php echo $this->lang->line('attendance_saved_successfully'); ?></div>
                                    <?php
                                }
                                ?>
                                <form action="<?php echo site_url('admin/clinical_department/save_batchattendance') ?>" method="post">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="mailbox-controls">
                                        <span class="button-checkbox">
                                           <button type="button" class="btn btn-sm btn-primary" data-color="primary"><?php echo $this->lang->line('mark_as_holiday'); ?></button>
                                             </span>
                                                <div class="pull-right">
                                           <button type="submit" name="search" value="saveattendence" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_attendance'); ?> </button>
      
                                        </div>
                                    </div>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="date" value="<?php echo $date; ?>">
                                      <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                                       <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
             <!--  <input type="hidden" name="total_min" id="total_min" value=""  />-->            
                                     
                                     <div class="table-responsive ptt10">
                                        <table class="table table-hover table-striped example"> 
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                    <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                    <th><?php echo $this->lang->line('name'); ?></th>
                                                    <th class=""><?php echo $this->lang->line('attendance'); ?></th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
												 
                                                $row_count = 1;
                                                foreach ($resultlist as $key => $value) {
											
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="student_session[]" value="<?php echo $value['student_session_id']; ?>">
                                                            <input  type="hidden" value="<?php echo $value['attendance_id']; ?>"  name="attendendence_id<?php echo $value['student_session_id']; ?>">
            <?php echo $row_count; ?>
                                                        </td>
                                                        <td>
            <?php echo $value['admission_no']; ?>
                                                        </td>
                                                        <td>
            <?php echo $value['roll_no']; ?>
                                                        </td>

                                                        <td>
            <?php echo $value['firstname'] . " " . $value['lastname']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $c = 1;
                                                            $count = 0;
															
                                                            foreach ($attendencetypeslist as $key => $type) {
																
																
                                                                if($type['key_value'] != "H") { 
                                                                    $att_type = str_replace(" ", "_", strtolower($type['type']));
                                                if($value['date'] !='xxx') {
													
												
                                                                        ?>
                                                                        <div class="radio radio-info radio-inline">
                                                                            <input <?php if($value['attendance_type_id'] == $type['id']) echo  "checked"; ?> type="radio" id="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>" value="<?php echo $type['id'] ?>" name="attendencetype<?php echo $value['student_session_id']; ?>" >
          <label for="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>">
              <?php echo $this->lang->line($att_type); ?>  </label>
                                                                           
                                                                        </div>
                                                                        <?php
                                                                    }else {
                                                                        ?>
                                                                        <div class="radio radio-info radio-inline">
                                                                            <input <?php if ($c == 1) echo "checked"; ?> type="radio" id="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>" value="<?php echo $type['id'] ?>" name="attendencetype<?php echo $value['student_session_id']; ?>" >
                                                                            <label for="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>"> 
                        <?php echo $this->lang->line($att_type); ?> 
                                                                            </label>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    $c++;
                                                                    $count++;
                                                                }
                                                            }
                                                            ?>

                                                        </td>
                                                        <!--<?php //if($date == 'xxx') { ?> 
                                                            <td><!--<input type="text" name="remark<?php //echo $value["student_session_id"] ?>" >
                                                            
                         <select  id="" name="remark<?php echo $value["student_session_id"];?>" class="form-control" >
                                            <option value="0"><?php echo $this->lang->line('select'); ?></option>
                                            <option <?php if($value['remark']==1){echo 'selected';} ?> value="1">Sick Leave</option>
                                            <option <?php if($value['remark']==2){echo 'selected';} ?> value="2">Any Other Leave</option>
                                        </select>
                                                                                        
                                                            </td>
            <?php //} else { ?>
-->
                                                           <!-- <td>
                                                            
                                                          
                                                 
         <select id="" name="remarks<?php //echo $value["student_session_id"];?>" class="form-control" >
                               <option value="0"><?php //echo $this->lang->line('select'); ?></option>
                               <option <?php //if($value['remark']==1){echo 'selected';} ?> value="1">Sick Leave</option>
                               <option <?php //if($value['remark']==2){echo 'selected';} ?> value="2">Any Other</option>
                                        </select>
                                                            
                                                            </td>-->
                                                    <?php //} ?>
                                                    </tr>
                                                    <?php
                                                    $row_count++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <?php
                            } 
							else {
                                ?>
                                <div class="alert alert-info">No student admitted in this Class-Section</div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                        <?php
                    }
               
                ?>
                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {

                    $('.detail_popover').popover({
                        placement: 'right',
                        title: '',
                        trigger: 'hover',
                        container: 'body',
                        html: true,
                        content: function () {
                            return $(this).closest('th').find('.fee_detail_popover').html();
                        }
                    });
					var group_id = '<?php echo $group_id; ?>';
                    var section_id_post = '<?php echo $section_id; ?>';
                    var class_id_post = '<?php echo $class_id; ?>';
					var subject_id='<?php echo $subject_id ?>';
					
                    populateSection(section_id_post, class_id_post);
			      getgroupByClassandSection(class_id_post, section_id_post,group_id);
					<?php /*?>get_total_min(class_id_post,section_id_post,group_id);<?php */?>
				populatesubject(class_id_post,section_id_post,subject_id);	
					
					
                    function populateSection(section_id_post, class_id_post) {
                        $('#section_id').html("");
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id_post},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    var select = "";
                                    if (section_id_post == obj.section_id) {
                                        var select = "selected=selected";
                                    }
                                    div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    }
					
					
					
	function getgroupByClassandSection(class_id_post, section_id_post,group_id) {
        console.log("rrrr1");
        if (class_id_post != "" && section_id_post != "") {
            $('#group').html("");
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
			 //console.log(div_data);
            $.ajax({
                type: "POST",
                url: base_url + "admin/clinical_department/getGroupByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id_post},
                dataType: "json",
                success: function (data) {
				
                    $.each(data, function (i, obj)
                    {
						
                        var sel = "";
                        if (group_id == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.group_name + "</option>";
						
                    });

                    $('#group').append(div_data);
                }
            });
        }
    }
					
		
						
	function populatesubject(class_id_post, section_id_post,subject_id) {
        console.log("rrrr1");
        if (class_id_post != "" && section_id_post != "") {
            $('#subject').html("");
           
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
			 
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSectionNew",
                data: {'class_id': class_id_post, 'section_id': section_id_post},
                dataType: "json",
                success: function (data) {
				
                    $.each(data, function (i, obj)
                    {
						
                        var sel = "";
                        if (subject_id == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + "(" +obj.type+ ")</option>";
						
                    });

                    $('#subject').append(div_data);
                }
            });
        }
    }
					
		
		
		
		
		
		
		
		
		
		
		
		
		
		<?php /*?>function get_total_min(class_id_post,section_id_post,group_id)
		{
			
			$('#total_min').html("");
			 if (class_id_post != "" && section_id_post != "" && group_id !="") {
			
			  var base_url = '<?php echo base_url() ?>';
			    $.ajax({
                type: "POST",
                url: base_url + "admin/clinical_department/get_total_min",
                data: {'class_id': class_id_post, 'section_id': section_id_post,'group_id':group_id},
                dataType: "json",
                success: function (data) {
				console.log(data);
                 
				 	$('#total_min').val(data.total_hours);
				 
				   
                }
            });
			 }
			
			}
		<?php */?>
		
		
	
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
					
					
					
			$(document).on('change', '#section_id', function (e) {
            $('#group').html("");
			
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/clinical_department/getourgroup",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
					
                    $.each(data, function (i, obj)
                    {
           div_data += "<option value=" + obj.id + ">" + obj.group_name + "</option>";
                    });

                    $('#group').append(div_data);
                }
            });
        });
		
		
		
		
		
					
                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
                    $('#date').datepicker({
                        format: date_format,
                        autoclose: true
                    });
                });
				
				
					
			 $(document).on('change', '#section_id', function (e) {
            $('#subject').html("");
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getavailablesubjects",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subject').append(div_data);
                }
            });
        });
   
				
				
            </script>
            
            
            
            <script type="text/javascript">
                $(function () {
                    $('.button-checkbox').each(function () {
                        var $widget = $(this),
                                $button = $widget.find('button'),
                                $checkbox = $widget.find('input:checkbox'),
                                color = $button.data('color'),
                                settings = {
                                    on: {
                                        icon: 'glyphicon glyphicon-check'
                                    },
                                    off: {
                                        icon: 'glyphicon glyphicon-unchecked'
                                    }
                                };
                        $button.on('click', function () {
                            $checkbox.prop('checked', !$checkbox.is(':checked'));
                            $checkbox.triggerHandler('change');
                            updateDisplay();
                        });
                        $checkbox.on('change', function () {
                            updateDisplay();
                        });

                        function updateDisplay() {
                            var isChecked = $checkbox.is(':checked');
                            $button.data('state', (isChecked) ? "on" : "off");
                            $button.find('.state-icon')
                                    .removeClass()
                                    .addClass('state-icon ' + settings[$button.data('state')].icon);
                            if (isChecked) {
                                $button
                                        .removeClass('btn-success')
                                        .addClass('btn-' + color + ' active');
                            } else {
                                $button
                                        .removeClass('btn-' + color + ' active')
                                        .addClass('btn-primary');
                            }
                        }

                        function init() {
                            updateDisplay();
                            if ($button.find('.state-icon').length == 0) {
                                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                            }
                        }
                        init();
                    });
                });

                $('#checkbox1').change(function () {

                    if (this.checked) {
                        var returnVal = confirm("Are you sure?");
                        $(this).prop("checked", returnVal);

                        $("input[type=radio]").attr('disabled', true);


                    } else {
                        $("input[type=radio]").attr('disabled', false);
                        $("input[type=radio][value='1']").attr("checked", "checked");

                    }

                });
            </script>
            