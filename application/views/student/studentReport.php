<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-line-chart"></i> <?php echo $this->lang->line('reports'); ?> <small> <?php echo $this->lang->line('filter_by_name1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form role="form" action="<?php echo site_url('student/studentreport') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label> <small class="req">*</small>
                                    <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                            <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>
                            </div> 
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">  
                                    <label><?php echo $this->lang->line('section'); ?></label><small class="req">*</small>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>  
                            </div>
                            <!-- <div class="col-sm-3 col-md-3">
                                <div class="form-group"> 
                                    <label><?php echo $this->lang->line('category'); ?></label>
                                    <select  id="category_id" name="category_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($categorylist as $category) {
                                            ?>
                                            <option value="<?php echo $category['id'] ?>" <?php if (set_value('category_id') == $category['id']) echo "selected=selected"; ?>><?php echo $category['category'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div> -->
                            <!-- <div class="col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('gender'); ?></label>
                                    <select class="form-control" name="gender">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($genderList as $key => $value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key) echo "selected"; ?>><?php echo $value; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div> -->
                            <!-- <div class="col-sm-3 col-md-2">
                                <div class="form-group"> 
                                    <label><?php echo $this->lang->line('rte'); ?></label>
                                    <select  id="rte" name="rte" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($RTEstatusList as $k => $rte) {
                                            ?>
                                            <option value="<?php echo $k; ?>" <?php if (set_value('rte') == $k) echo "selected"; ?>><?php echo $rte; ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div> -->

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
            <?php
            // var_dump($resultlist);exit;
            if (isset($resultlist)) {
				//var_dump($resultlist);
				
				
                ?>
                <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo form_error('student'); ?> <?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></h3>
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label"> <?php echo $this->Setting_model->getCurrentSchoolName();?></br>
					<?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('section'); ?></th>
                                    <th><?php echo $this->lang->line('admission_no'); ?></th>
                                    <th><?php echo $this->lang->line('student_name'); ?></th>
                                    <th><?php echo $this->lang->line('father_name'); ?></th>
                                    <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                   <th><?php echo $this->lang->line('gender'); ?></th>
                                  <th><?php echo $this->lang->line('category'); ?></th>
                                 <th><?php echo $this->lang->line('mobile_no'); ?></th>
                 <th><?php echo $this->lang->line('national_identification_no'); ?></th>
                                    <th><?php echo $this->lang->line('local_identification_no'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($resultlist)) {
                                    ?>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($resultlist as $student) {
                                        ?>
                                        <tr>
                                            <td><?php echo $student['section']; ?></td>
                                            <td><?php echo $student['admission_no']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $student['father_name']; ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                            <td><?php echo $student['gender']; ?></td>
                                            <td><?php echo $student['category']; ?></td>
                                            <td><?php echo $student['mobileno']; ?></td>
                                            <td><?php echo $student['samagra_id']; ?></td>
                                            <td><?php echo $student['adhar_no']; ?></td>
                                            <td> <a  class="btn btn-primary btn-sm cumulative_record" data-toggle="tooltip" title=""  data-class_id=" <?php echo $student['class_id']; ?>" data-student_id=" <?php echo $student['id'] ?>" data-section_id="<?php echo $student['section_id']; ?>"  data-student_session_id=" <?php echo $student['student_session_id']; ?>  " >  <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('view'); ?> </a>  </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>       
</div>  
</section>
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

    $(document).ready(function () {
		
		
		
		
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
		
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
		
		
		
    });
</script>


<script>




$(document).on('click', '.cumulative_record', function () 
{
	
var class_id=$(this).data('class_id');
var section_id=$(this).data('section_id');
var student_id=$(this).data('student_id');
var student_session_id=$(this).data('student_session_id');	
	
$.ajax({
                type: "post",
                url: '<?php echo site_url("student/cumulative_record") ?>',
               
                data: {'student_session_id' :student_session_id,'student_id':student_id,'class_id' :class_id,'section_id':section_id},
                success: function (response) {
					
					//console.log(response);
					
				$('#crecord').html(response);
				
				 $("#scheduleModal").modal('show');	
					
                   
                }
            });



	
	
	
	
	
});

</script>
<style>


</style>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="document">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <center> <h4 class="modal-title"> Cumulative Record </h4>    </center>
            </div>
            <div class="modal-body" id="crecord" style="margin-left: 70px; margin-right: 34px;">
            
            
            
            </div>
            <div class="modal-footer">
             <button type="button" aria-controls="DataTables_Table_0" class="btn btn-sm btn-danger login-submit-cs fa fa-print buttons-print" id="printtrans"><?php echo $this->lang->line('print'); ?></button>
                <button type="button" class="btn btn-default " data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
   $(document).on('click', '#printtrans', function () {
	 
     /*var printContents = document.getElementById('crecord').innerHTML;
     var originalContents = document.body.innerHTML; 
     document.body.innerHTML = printContents;
	 //window.open();
     window.print(); 
     document.body.innerHTML = originalContents;  */
	    
	         var gridData = document.getElementById('crecord');
            var windowUrl = ' ';
            //set print document name for gridview
            var uniqueName = new Date();
            var windowName = 'Print_' + uniqueName.getTime();
            var prtWindow = window.open(windowUrl, windowName, 'left=0,top=0,right=0,bottom=0,width=screen.width,height=screen.height,margin=0,0,0,0');
			
            //prtWindow.document.write('<html><head><font size="5">TITLE</font></head>');
            //prtWindow.document.write('<body style="background:none !important; font-size:10pt !important">');
            prtWindow.document.write(gridData.outerHTML);
           // prtWindow.document.write('</body></html>');
            prtWindow.document.close();
            prtWindow.focus();
            prtWindow.print();
            prtWindow.close();
 
 
 
   });
   
   
   
   
   </script> 