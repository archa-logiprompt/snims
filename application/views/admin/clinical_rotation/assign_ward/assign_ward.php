<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('assign_ward'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    
                    
                    
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        
                        <div class="box-tools pull-right">
                   
                        <a href="<?php echo base_url(); ?>admin/assign_ward/viewassign_ward" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('back'); ?>" >
                            <i class="fa fa-arrow-left"></i> 
                        </a>
                   
                </div>
                        
                    </div>

                    <form role="form" action="<?php echo site_url('admin/assign_ward') ?>" method="post" class="">
                        <div class="box-body row">


 


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
            
            
             <form role="form" method="post" action="<?php echo site_url('admin/assign_ward/assign') ?>" id="assign_form">
              <?php echo $this->customlib->getCSRF(); ?>
             
                      
            <?php
	     
		 
            if (isset($group_list)) {
                ?>
                
                 <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
                      <input type="hidden" name="section_id" value="<?php echo $section_id ?>" />
                
                <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo form_error('student'); ?> <?php echo $this->lang->line('assign_ward') ?></h3>
                        
                         <input type="hidden" name="show_error" id="show_error" />
                     <span class="text-danger"></span> 
                     <div class="row"> 
                    
                     <div class="col-md-3" style="margin-top: 12px;">
                    
                              <div class="form-group">  
                                    <label style="color: #a9181a;" >Assign To Ward Name</label>
                                    <select  id="wardname" name="wardname" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php if(isset($warddetails)) foreach($warddetails as $ward) {?>
                                        <option value="<?php echo $ward['detailid'] ?>"><?php echo $ward['deptname']?> </option>
                                        <?php  }?>
                                        
                                    </select>
                                    <span class="text-danger"><?php echo form_error('wardname'); ?></span>
                                </div>  
                     
                     
                     </div>   
                        
                        <div class="col-md-5" style="margin-top: 12px;">
                        <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                        <label style="color: #a9181a;"><?php echo $this->lang->line('date'); ?></label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="date" class="form-control" id="startdate" name="startdate" value="">
                                            <span class="input-group-addon">to</span>
                                            <input type="date" class="form-control" id="enddate" name="enddate" value="">
                                        </div>
                                    </div>
                        </div>
                        
               <!--<input type="hidden" value="" name="start_time" id="in_time"  />
               <input type="hidden" value="" name="end_time" id="out_time"  />-->
                        
                        <!--<div class="col-md-3" style="margin-top: 12px;">
                    
                              <div class="form-group">  
                                    <label style="color: #a9181a;" ><?php //echo $this->lang->line('session'); ?></label>
                                    <select  id="clinic_session" name="clinic_session" class="form-control" >
                                    <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                    <?php //if(isset($sessionlist)) foreach($sessionlist as $list) {?>
                                        <option value="<?php //echo $list['id'] ?>"><?php //echo $list['session']?> </option>
                                        <?php  //}?>
                                        
                                    </select>
                                    <span class="text-danger"><?php //echo form_error('wardname'); ?></span>
                                </div>  
                     
                     
                     </div>-->
                        
                    </div>    
                        
                     
                        
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label"><?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th><input type="checkbox" id="select_all"/> <?php echo $this->lang->line('all'); ?></th>
                                    
                                   <!-- <th><?php //echo $this->lang->line('roll_no'); ?></th>-->
                                   
                                     <th><?php echo $this->lang->line('group_name'); ?></th>
                                  
                                 
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								
                                if (empty($group_list)) {
                                    ?>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($group_list as $group) {
										
									
										
                                        ?>
                                        <tr>
                                        <td>
                                        <input class="checkbox" type="checkbox" id="group_id" name="group_id[]"  value="<?php echo $group['group_id']; ?>"/>
                                        
                                        <!--<input type="hidden" name="sectionid_<?php //echo $group['group_id']; ?>" value="<?php //echo $group['group_id']; ?>">-->
                  <!--<input type="hidden" name="classid_<?php //echo $student['student_session_id'];?>" value="<?php //echo $student['class_id']; ?>">
                              -->          
                                        
                                        </td>
                                            <!--<td><?php //echo $student['roll_no']; ?></td>-->
                                            
                                            <td>
                                              <?php echo $group['group_name']; ?>
                                               
                                            </td>
                                           
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('assign'); ?>
                                            </button>
                          <!--<button type="submit" name="assign" value="assign_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php //echo $this->lang->line('assign'); ?></button>-->
                        
                    </div>
                    
                   
                    
                    
                    
                </div>
                <?php
            }
            ?>
            
            </form>
        </div>       
</div>  
</section>
</div>

<script type="text/javascript">

$("#select_all").change(function () {  //"select all" change 
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });


/* $('.checkbox').change(function () {
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if (false == $(this).prop("checked")) { //if this item is unchecked
            $("#select_all").prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $("#select_all").prop('checked', true);
        }
    });*/





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
	
	
	
	 $("#assign_form").submit(function (e) {
        if (confirm('Are you sure?')) {
            var $this = $('.allot-fees');
            $this.button('loading');
            $.ajax({
                type: "POST",
                dataType: 'Json',
                url: $("#assign_form").attr('action'),
                data: $("#assign_form").serialize(), // serializes the form's elements.
                success: function (data)
                { console.log(data);
				   $this.button('reset');
				  
                    if (data.status == "fail") {
						var div="";
						if(data.error !='')
						{
                        $.each(data.error, function (index, value) {
                         div +=' <span class="text-danger">'+value+'</span> '
						
                        //errorMsg(data.message);
						
						 $('.ptbnull').append(div);
						  
                        });
						}
						else{
						alert(data.message);
						
						//div +=' <span class="text-danger">'+data.message+'</span> '
						
                        //errorMsg(data.message);
						
						 //$('.ptbnull').append(div);
						 
						}
                    } else {
                        successMsg(data.message);
						location.reload(true);
                    }

                   
                }
            });

        }
        e.preventDefault();

    });


	
	
	
	
	<?php /*?> $(document).on('change', '#clinic_session', function (e) {
            $('#in_time').html("");
			 $('#out_time').html("");
			 
            var id = $(this).val();
			
            var base_url = '<?php echo base_url() ?>';
           
            $.ajax({
                type: "post",
                url: base_url + "admin/assign_ward/get_time",
                data: {'id': id},
                dataType: "json",
                success: function (data) {
					
					
                    
                    $('#in_time').val(data.in_time);
					  $('#out_time').val(data.out_time);
					
                }
            });
        });
	<?php */?>
	
	
	
	
	
	
	
	
</script>