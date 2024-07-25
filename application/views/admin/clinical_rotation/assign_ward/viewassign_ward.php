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
                    <?php if ($this->rbac->hasPrivilege('viewassign_ward', 'can_add')) { ?>
                        <a href="<?php echo base_url(); ?>admin/assign_ward" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('assign_ward'); ?>" >
                            <i class="fa fa-plus"></i> <?php echo $this->lang->line('assign_ward'); ?>
                        </a>
                    <?php } ?>
                </div>
                        
                    </div>

                    <form role="form" action="<?php echo site_url('admin/assign_ward/viewassign_ward') ?>" method="post" class="">
                        <div class="box-body row">


 
                            <?php echo $this->customlib->getCSRF(); ?>

                           <div class="col-sm-7 col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
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
                                    <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>  
                            </div>
                            
                  <?php //var_dump($warddetails); ?>
                            
                 <!--      <div class="box-body table-responsive">
					<div class="download_label"><?php //echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                               
                                    
                                   <th><?php //echo $this->lang->line('group_name'); ?></th>
                                    <th><?php //echo $this->lang->line('class'); ?></th>
                                    <th><?php //echo $this->lang->line('section'); ?></th>
                                    <th><?php //echo $this->lang->line('no_of_students'); ?></th>
                                    <th><?php //echo $this->lang->line('date'); ?></th>
                                    
                              <th class="text-right"><?php //echo $this->lang->line('action'); ?></th>   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								
                                //if (empty($warddetails)) {
                                    ?>
                                    <?php
                                //} else {
                                    
                                  //foreach($warddetails as $key=>$ward)
								  //{
                                        ?>
                                        <tr>
                                        <td>
                                        
                                        <?php //echo $ward->group_name ?>
                                        
                                                                                
                                        </td>
                                      <td><?php  //echo $ward->class; ?></td>
                                         
                                       
                                        <td><?php //echo $ward->section;  ?></td>
                                        <td><?php //echo $ward->student_count;  ?></td> 
                                         <td><?php //echo $ward->datefrom." - ".$ward->dateto; ?></td> 
                     
                     
                     
                                               <td class="pull-right">
                                                   
                                                    <a  class="btn btn-info btn-xs schedule_modal" data-toggle="tooltip" title="" data-section_id="<?php //echo $ward->section_id ?>" data-class_id="<?php  //echo $ward->class_id?>" data-ward_id="<?php //echo $ward->ward_id ?>" data-group_id="<?php  //echo $ward->group_id?>" data-original-title="">
            <?php //echo $this->lang->line('view_details'); ?>
                                                    </a>
       
                                            </td>                                 
                                           
                                           
                                        </tr>
                                        <?php
								  //}
                                   
                                //}
                                ?>
                            </tbody>
                        </table>
                        
                        
                          <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php //echo $this->lang->line('assign'); ?>
                                            </button>
                        
                    </div>-->
                            
                            
                            
                    

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
            
            
            
            <?php
		
		
            if (isset($warddetails)) {
                ?>
                <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php //echo form_error('student'); ?> <?php echo $this->lang->line('assign_ward') ?></h3>
                     
                     
                    </div>
                    
                          <div class="box-body table-responsive">
					<div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
					<?php //echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                               
                                    
                                   <th><?php echo $this->lang->line('group_name'); ?></th>
                                    <th><?php echo $this->lang->line('ward_name'); ?></th>
                                      <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                    <th><?php echo $this->lang->line('no_of_students'); ?></th>
                                    <th><?php echo $this->lang->line('date'); ?></th>
                                    
                              <th class="text-right"><?php echo $this->lang->line('action'); ?></th>   
                                   
                                </tr>
                            </thead>
                            <tbody>

                                <?php
								
                                if (empty($warddetails)) {
                                    ?>
                                    <?php
                                } else {
                                    //var_dump($warddetails);
                                  foreach($warddetails as $key=>$ward)
								  {
                                        ?>
                                        <tr>
                                        <td><?php echo $ward->group_name ?></td>
                                         <td><?php echo $ward->deptname ?></td>
                                          <td><?php echo $ward->class ?></td>
                                           <td><?php echo $ward->section ?></td>
                                      
                                        <td><?php echo $ward->student_count;  ?></td> 
                                         <td><?php echo $ward->datefrom." - ".$ward->dateto; ?></td> 
                     
                     
                     
                                               <td class="pull-right">

                                                <a href="<?php echo base_url(); ?>admin/assign_ward/deletes/<?php echo $ward->group_id ?>/<?php echo $ward->datefrom ?>/<?php echo $ward->dateto ?>"class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <?php echo "Delete"; ?>
                                                    </a>

                                                   
                                                    <a  class="btn load btn-info btn-xs schedule_modal" data-toggle="tooltip" title="" data-section_id="<?php //echo $ward->section_id ?>" data-class_id="<?php  //echo $ward->class_id?>" data-ward_id="<?php //echo $ward->ward_id ?>" data-datefrom="<?php echo $ward->datefrom." - ".$ward->dateto; ?>" data-wardname="<?php echo $ward->wardname ?>"  id="load" data-group_id="<?php  echo $ward->group_id?>" data-original-title="" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.." >
            <?php echo $this->lang->line('view_details'); ?>
                                                    </a>
       
                                            </td>                                 
                                           
                                           
                                        </tr>
                                        <?php
								  }
                                   
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        
                        <!--  <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php //echo $this->lang->line('assign'); ?>
                                            </button>-->
                        
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
	
	
	
	
	 $(document).on('click', '.schedule_modal', function () {
        $('.modal-title').html("");
        
		
		var $this = $(this);
            $this.button('loading');
        
		var group_id=$(this).data('group_id');
		var wardname=$(this).data('wardname');
		var datefrom=$(this).data('datefrom');
		
        $('.modal-title').html("<?php echo $this->lang->line('student_detail'); ?> ");
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "admin/assign_ward/getstudentdetail",
            data: {'group_id': group_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="table-responsive">';
				 data += "<p class='lead titlefix pt0' style='font-size: 16px; color: #a9181a;'> Ward : "+ wardname  +"</p>";
				 data += "<p class='lead titlefix pt0' style='font-size: 16px; color: #a9181a;'> Date : "+ datefrom  +"</p>";
				
                data += '<table class="table table-hover sss">';
                data += '<thead>';
                data += '<tr>';
                data += "<th><?php echo $this->lang->line('student_name'); ?></th>";
                data += "<th><?php echo $this->lang->line('admission_no'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('roll_no'); ?></th>";
                
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    
                   
                    data += '<tr>';
                    data += '<td class="">' + obj.firstname + ' ' + obj.lastname + '</td>';
                    data += '<td class="">' + obj.admission_no + '</td> ';
                    data += '<td style="width:200px;" class="text text-center">' + obj.roll_no + '</td> ';
                   
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '</div>  ';

                $('.modal-body').html(data);

//===========

                var dtable = $('.sss').DataTable();
                $('div.dataTables_filter input').attr('placeholder', 'Search...');
                new $.fn.dataTable.Buttons(dtable, {

                    buttons: [

                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            titleAttr: 'Columns',
                            postfixButtons: ['colvisRestore']
                        },
                    ]
                });

                dtable.buttons(0, null).container().prependTo(
                        dtable.table().container()
                        );

//===========

                $("#scheduleModal").modal('show');
				$this.button('reset');
            }
        });
    });
	
	
	
	
	
</script>





<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <center> <h4 class="modal-title"></h4></center>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>




