<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        
        <h1>
            <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('clinical_group'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    
                      <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>  
                    
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        
                        <div class="box-tools pull-right">
                    <?php if ($this->rbac->hasPrivilege('add_group', 'can_add')) { ?>
                        <a href="<?php echo base_url(); ?>admin/clinical_group/new_grup" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo 'New Group'; ?>" >
                            <i class="fa fa-plus"></i> <?php echo 'New Group'; ?>
                        </a>
                    <?php } ?>
                </div>
                        
                    </div>

                    <form role="form" action="<?php //echo site_url('admin/assign_ward/viewassign_ward') ?>" method="post" class="">
                        <div class="box-body row">



                     




                            <?php echo $this->customlib->getCSRF(); ?>

                            
                  
                            
                       <div class="box-body table-responsive">
					<div class="download_label">
					<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
					<?php echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>#</th>  
                                   
                                   <th class="pull-center"><?php echo $this->lang->line('group_name'); ?></th>
                                    
                                   
                                    
                              <th class="text-right"><?php echo $this->lang->line('action'); ?></th>   
                               <!-- <th></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								
                                if (empty($group)) {
                                    ?>
                                    <?php
                                } else {
									
                                    
                                   $i=1;foreach($group as $key=>$grp)
								  {
                                        ?>
                                        <tr>
                                        
                                           <td><?php echo $i; ?></td>
                                           <td><?php echo $grp['group_name'] ?></td>
                                            
                                               <td class="pull-right">
                                                   <a href="<?php echo base_url(); ?>admin/clinical_group/deletenewgroup/<?php echo $grp['id'] ?>"class="btn btn-info btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <?php echo "Delete"; ?>
                                                    </a>
                                                    <a  class="btn btn-info btn-xs schedule_modal" data-toggle="tooltip" title="" data-id="<?php echo $grp['id'] ?>" data-class_id="<?php  //echo $ward->class_id?>" data-ward_id="<?php //echo $ward->ward_id ?>" data-original-title="">
            <?php echo $this->lang->line('view_details'); ?>
                                                    </a>
       
                                            </td> 
                                                                            
                                           
                                           
                                        </tr>
                                        <?php
										$i=$i+1;
								  }
                                   
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        
                          <!--<button type="submit" class="allot-fees btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php //echo $this->lang->line('assign'); ?>
                                            </button>-->
                        
                    </div>
                            
                            
                            
                  
                            
                            
                            
                            
                            
                            
                    

                            <!--<div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php //echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>-->

                    </form>
                </div>
            </div>
            
            
            
            <?php
		
            //if (isset($warddetails)) {
                ?>
                <!--<div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php //echo form_error('student'); ?> <?php //echo $this->lang->line('assign_ward') ?></h3>
                     <div class="row">   
                     <div class=" col-md-4" style="margin-top: 12px;">
                     
                     <h5> <?php //echo $this->lang->line('assign_to_ward_name')?></h5>
                                
                     
                     
                     </div>   
                        
                   
                        
                    </div>
                    <div class="box-body table-responsive">
					<div class="download_label"><?php //echo $this->lang->line('student') . " " . $this->lang->line('report'); ?></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                               
                                    
                                   <th><?php //echo $this->lang->line('assign_ward'); ?></th>
                                    <th><?php //echo $this->lang->line('class'); ?></th>
                                    <th><?php //echo $this->lang->line('section'); ?></th>
                                    <th><?php //echo $this->lang->line('no_of_students'); ?></th>
                                    <th><?php //echo $this->lang->line('date'); ?></th>
                                 
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								
                                //if (empty($warddetails)) {
                                    ?>
                                    <?php
                                //} else {
                                    
                                  
                                        ?>
                                        <tr>
                                        <td>
                                        
                                        <?php //echo $warddetails[0]['wardname']." - ".$warddetails[0]['aliasname']." - ".$warddetails[0]['deptname']; ?>
                                        
                                                                                
                                        </td>
                                      <td><?php  //echo $warddetails[0]['class']; ?></td>
                                         
                                       
                                        <td><?php //echo $warddetails[0]['section'];  ?></td>
                                        <td></td> 
                                         <td><?php //echo $warddetails[0]['datefrom']." - ".$warddetails[0]['dateto']; ?></td> 
                                            
                                           
                                           
                                        </tr>
                                        <?php
                                      
                                   
                                //}
                                ?>
                            </tbody>
                        </table>
                        
                        
                          <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php //echo $this->lang->line('assign'); ?>
                                            </button>
                        
                    </div>
                    
                   
                    
                    
                    
                </div>
                <?php
            //}
            ?>
          
        </div>-->       
</div>  
</section>
</div>

<script type="text/javascript">



	$(document).on('click', '#student', function () {
	$("#addstudentmodal").modal('show');
	
     	
	});

/*$("#select_all").change(function () {  //"select all" change 
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });*/


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
	
	/*$(document).on('click', '.schedule_modal', function () {
		
		 $("#scheduleModal").modal('show');
		
	});
	*/
	
	 $(document).on('click', '.schedule_modal', function () {
        $('.modal-title').html("");
		


        
        var group_id = $(this).data('id');
       
		
        $('.modal-title').html("<?php echo 'Groupwise Attendance'; ?> ");
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "admin/clinical_group/get_studentbyournewgroup",
            data: {'group_id': group_id},
            dataType: "json",
            success: function (response) {
				console.log(response);
                var data = "";
                data += '<div class="table-responsive">';
                data += "<p class='lead titlefix pt0'><?php echo $this->lang->line('class') ?>:"+response[0].class+"("+response[0].section +" ) </p>";
                data += '<table class="table table-hover sss">';
                data += '<thead>';
                data += '<tr>';
				data+='<th><input type="checkbox" id="select_all"/> <?php echo $this->lang->line('all'); ?></th>';
               data += "<th><?php echo $this->lang->line('student_name'); ?></th>";
                
                 data += "<th><?php echo $this->lang->line('roll_no'); ?></th>";
                
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    
                   
                    data += '<tr>';
					data +='<td><input class="checkbox" type="checkbox" id="student_session_id[]" name="student_session_id[]"  value="'+obj.student_session_id+'"/></td>';
                    data += '<td class="">' + obj.firstname + ' ' + obj.lastname + '</td>';
                     data += '<td class="">'+obj.roll_no+'</td>';
                   
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '</div>  ';

                $('.modal-body').html(data);

//===========

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
            }
        });
    });
	
	
	
	
	
</script>

<style>

.create{
	
	background: #8BC34A;
    border: 1px solid #4CAF50;
    color: #fff;
    transition: .3s;
	
}



</style>



<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
        
        
         <form role="form" id="release_form" action="<?php echo base_url()?>admin/Clinical_group/release_studfromgroup" method="post" class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
                
                

            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
            
             <button type="button" class=" btn_save create btn btn-success btn-sm" title="Release selected students from group" id="load"> <?php echo $this->lang->line('release'); ?></button>
              
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
            </form>
        </div>
    </div>
</div>







<script>

$(document).on('click', '.btn_save ', function () {
	
   $("form#release_form").submit();	
	
});



</script>
