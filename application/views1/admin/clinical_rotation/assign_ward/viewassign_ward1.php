<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('clinical_rotation'); ?>         </h1>
    </section>
    <!-- Main content -->
    <section class="content"> 
     <div class="row">      
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                <div class="box-tools pull-right">
                    <?php if ($this->rbac->hasPrivilege('assign_ward', 'can_add')) { ?>
                        <a href="<?php echo base_url(); ?>admin/assign_ward" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('assign_ward'); ?>" >
                            <i class="fa fa-plus"></i> <?php echo $this->lang->line('assign_ward'); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <form  class="assign_teacher_form" action="<?php //echo base_url(); ?>admin/teacher/getSubjectTeachers" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                        <option value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="class_id_error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                <select  id="section_id" name="section_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="section_id_error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    
                    
                 <!--    <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th><input type="checkbox" id="select_all"/> <?php //echo $this->lang->line('all'); ?></th>
                                    
                                    <th><?php //echo $this->lang->line('assign_ward'); ?></th>
                                      <th><?php //echo $this->lang->line('class'); ?></th>
                                        <th><?php //echo $this->lang->line('section'); ?></th>
                                   
                                     <th><?php //echo $this->lang->line('no_of_students'); ?></th>
                                  
                                 
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								
                                //if (empty($warddetails)) {
                                    ////?>
                                    <?php
                                //} else {
                                    //$count = 1;
                                   //foreach ($warddetails as $key => $ward) {
                                        ?>
                                        <tr>
                                        <td>
                                        
                                      <?php //echo $ward->wardname."-".$ward->aliasname."-".$ward->deptname; ?>
                                        
                                        
                                        </td>
                                            <td></td>
                                            
                                            <td>
                                                <a href="<?php //echo base_url(); ?>student/view/<?php //echo $student['id']; ?>"><?php //echo $student['firstname'] . " " . $student['lastname']; ?>
                                                </a>
                                            </td>
                                           
                                        </tr>
                                        <?php
                                        //$count++;
                                    //}
                                //}
                                ?>
                            </tbody>
                        </table>-->
                    
                    
                    
                    
                    <button type="submit" id="search_filter" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>                 
                </div>
            </form>
        </div>
        <div class="col-md-12" id="errorinfo">

        </div>
        
        
       <!-- <div class="box box-info" id="box_display" style="display:none">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users"> </i> <?php echo $this->lang->line('assign_subject'); ?></h3>

                <div class="box-tools pull-right">
                    <button id="btnAdd"  class="btn btn-primary btn-sm checkbox-toggle pull-right" type="button"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                </div>
            </div>
            <form action="<?php echo base_url() ?>admin/teacher/assignteacher" method="POST" id="formSubjectTeacher">
                <?php echo $this->customlib->getCSRF(); ?>
                <br/>
                <input type="hidden" value="0" id="post_class_id" name="class_id">
                <input type="hidden" value="0" id="post_section_id" name="section_id">
                <div class="form-horizontal" id="TextBoxContainer" role="form">
                </div>
                <div class="box-footer">

                    <button type="submit" class="btn btn-primary btn-sm btn pull-right save_button" style="display: none;"><?php echo $this->lang->line('save'); ?></button>

                </div>
            </form>
        </div>       -->
        
        <?php if(isset($warddetails)) { ?>
        
        
        <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> </h3>
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label"></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('assign_ward'); ?></th>
                                    <th><?php echo $this->lang->line('class'); ?></th>
                                    <th><?php echo $this->lang->line('section'); ?></th>
                                    <th><?php echo $this->lang->line('no_of_students'); ?></th>
                                   
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
        
        
        <?php } ?>
        
        
        
        
        
        
        
        
     </div>   
    </section>
</div>


<script type="text/javascript">
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
    });

    

    
   
</script>