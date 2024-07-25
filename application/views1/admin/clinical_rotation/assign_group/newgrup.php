<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo $this->lang->line('clinical_group'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    
                    
                    
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        
                        <!--<div class="box-tools pull-right">
                   
                        <a href="<?php //echo base_url(); ?>admin/assign_ward/viewassign_ward" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php //echo $this->lang->line('back'); ?>" >
                            <i class="fa fa-arrow-left"></i> 
                        </a>
                   
                </div>-->
                        
                    </div>
                      <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                       
                    <form role="form" action="<?php echo site_url('admin/clinical_group/new_grup') ?>" method="post" class="">
                        

                      <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>   




                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-7 col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label>
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
                            <div class="col-sm-7 col-md-6">
                                <div class="form-group">  
                                    <label><?php echo $this->lang->line('section'); ?></label>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>  
                            </div>
                            
                            
                      

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                           

                    </form>
                </div>
            </div>
             </div>
            </div>
            <?php
	
	
            if (isset($student_list)) {
                ?>
                
                <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo form_error('student'); ?> <?php echo $this->lang->line('assign_group') ?></h3>
                         
                        
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label">
					<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
					<?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th><input type="checkbox" id="select_all"/> <?php echo $this->lang->line('all'); ?></th>
                                    
                                    <th><?php echo $this->lang->line('roll_no'); ?></th>
                                   
                                     <th><?php echo $this->lang->line('student_name'); ?></th>
                                  
                                 
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								
                                if (empty($student_list)) {
									
                                    ?>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($student_list as $student) {
										
                                        ?>
                                        <tr>
                                        <td>
                                        <input class="checkbox" type="checkbox" id="student_session_id[]" name="type"  value="<?php echo $student['student_session_id']; ?>"/>
                                        
                                        <input type="hidden" name="sectionid_<?php echo $student['student_session_id']; ?>" value="<?php echo $student['section_id']; ?>">
                  <input type="hidden" name="classid_<?php echo $student['student_session_id'];?>" value="<?php echo $student['class_id']; ?>">
                                        
                                        
                                        </td>
                                            <td><?php echo $student['roll_no']; ?></td>
                                            
                                            <td>
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                </a>
                                            </td>
                                           
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                     <div>   
                  <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right schedule_modal" id="load"> <?php echo $this->lang->line('clinical_group'); ?>
                                            </button>
                                            </div>
                                            <div>
                                            <?php /*?> <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right schedule_modal_new" id="load" style="margin-right: 19px;"> <?php echo $this->lang->line('existing_group'); ?>
                                            </button><?php */?>
                                            </div>
                         
                        
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

$("#select_all").change(function () {  //"select all" change 
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });


 $('.checkbox').change(function () {
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if (false == $(this).prop("checked")) { //if this item is unchecked
            $("#select_all").prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $("#select_all").prop('checked', true);
        }
    });





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
	
	
	
	
	
	 $(document).on('click', '.schedule_modal', function () {
		 
		 
          var checkedvalue=Array();
		 
		$("input:checkbox[name=type]:checked").each(function(){
    checkedvalue.push($(this).val());
        });
		 $('#studentsessionid').val(checkedvalue);

		 $("#scheduleModal").modal('show'); 
       
    });
	
	//////existing group/////////////
	 <!--$(document).on('click', '.schedule_modal_new', function () {
		 
		 //alert();
        /*  var checkedvalue=Array();
		 
		$("input:checkbox[name=type]:checked").each(function(){
    checkedvalue.push($(this).val());
        });
		 $('#studentsessionid').val(checkedvalue);
*/
		// $("#scheduleModals").modal('show'); 
       
  //  });-->
	
	
</script>


<!--<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 37%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Create Group </h4>
            </div>
            <div class="modal-body">
             <div class="box-body row">
             
             <div class="col-sm-7 col-md-6">
                                <div class="form-group">  
                                    <label>Enter Group name</label>
                                    
                                       
                                </div>  
                            </div>
             
             <div class="col-sm-7 col-md-6">
                                <div class="form-group">  
                                    
                                    <input type="text" name="groupname" value="" />
                                       
                                </div>  
                            </div>
             
             
             
             </div>
            
            </div>
            <div class="modal-footer">
            <button type="submit" class="allot-fees btn btn-primary btn-sm" id="load"> <?php echo $this->lang->line('create'); ?>
                                            </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                
            </div>
        </div>
    </div>
</div>-->

  

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 37%;">
        <div class="modal-content">
           <form role="form" action="<?php echo site_url('admin/clinical_group/new_grup') ?>" method="post" class="">
           <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>   

                               <?php echo validation_errors(); ?>
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Create Group </h4>
            </div>
          
            <div class="modal-body">
            <input type="hidden"  class="form-control" name="student_session_id[]" id="studentsessionid" value="0" />
            
            
             <div class="box-body row">
             
             <div class="col-sm-7 col-md-6">
                                <div class="form-group">  
                                
                                    <label>Enter Group name</label>
                                    
                                       
                                </div>  
                            </div>
             
             <div class="col-sm-7 col-md-6" style="width: 170px;">
                                <div class="form-group groupname">  
                                    
                                    <input type="text" id="groupname" name="groupname" value="<?php echo set_value('groupname'); ?>" />
                                       <span class="text-danger"><?php echo form_error('groupname'); ?></span> 
                                </div>  
                            </div>
      
      
      <div class="box-body row">
             <div class="col-sm-7 col-md-6">
                <div class="form-group">  
                       <label>Existing group</label>
                          </div>  
                            </div>
                               <div class="row col-md-11" style="width:46.333333%">
<select autofocus="" id="group" name="group" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
                  <?php
                        foreach ($grouplist as $group) {
                            ?>
                   <option value="<?php echo $group['id'] ?>"
                           <?php
                         if (set_value('group') == $group['id']) {
                              echo "selected =selected";
                              }
                               ?>
                          ><?php echo $group['group_name'] ?></option>
                               <?php
                                    $count++;
                                 }
                                  ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('group'); ?></span>
                                    </div>
             </div>
      
      
      
             </div>
             
            </div>
            <div class="modal-footer">
            <button type="button" class=" btn_save btn btn-primary btn-sm" id="load"> <?php echo $this->lang->line('create'); ?>
                                            </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                
            </div>
        </div>
        </form>
    </div>
</div>
</div>




<script type="text/javascript">
    $(document).on('click', '.btn_save', function (e) {
		
      var class_id=$('#class_id').val();
	  var section_id=$('#section_id').val();
        var groupname = $('#groupname').val();
		var studentsessionid = $('#studentsessionid').val();
		var student_sess_id=studentsessionid.split(',');
        
        $.ajax({
            url: '<?php echo site_url("admin/clinical_group/assign_ourgroup") ?>',
            type: 'post',
            data: {groupname: groupname, student_sess_id: student_sess_id,class_id: class_id,section_id: section_id},
            dataType: 'json',
            success: function (response) {
                 console.log(response);
                //$this.button('reset');
                if (response.status == "success") {
					
                    //location.reload(true);
					document.location ='<?php echo site_url("admin/clinical_group/view_addedgroups") ?>';
					
                } else if (response.status == "fail") {
                    $.each(response.error, function (index, value) {
						
						var errorDiv='<span class="text-danger">'+value+'</span>'; 
                       $('.groupname').append(errorDiv);
                    });
                }
            }
        });
    });
</script>


