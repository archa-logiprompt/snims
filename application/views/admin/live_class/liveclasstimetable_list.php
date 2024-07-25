<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    .print, .print *
    {
        display: none;
    }
	
	
	
	
</style>

<div class="content-wrapper" style="min-height: 946px;">  
	<section class="content-header">
    	<h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
    	<div class="row">       
        	<div class="col-md-12">          
            	<div class="box box-primary">
                	<div class="box-header with-border">
                    	<h3 class="box-title">
                        	<i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                            
                       	<div class="box-tools pull-right">
                            <?php  if ($this->rbac->hasPrivilege('live_class', 'can_add')) { ?>
                        	<a href="<?php echo base_url(); ?>admin/live_class/create" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('add_timetable'); ?>" >
                            	<i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                        	</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                  <?php  $admin=$this->session->userdata('admin'); ?>
                    <form action="<?php echo site_url('admin/live_class/index')?>" method="post" accept-charset="utf-8">
                    	<div class="box-body live_class">
                        	<?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($classlist as $class) { ?>
                                           	<option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>><?php echo $class['class'] ?></option>
                                            <?php $count++; } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($result_array)) { ?>
                    <div class="box box-info" id="timetable">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('class_timetable'); ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="row print" >
                                <div class="col-md-12">
                                    <div class="col-md-offset-4 col-md-4">
                                        <center><b><?php echo $this->lang->line('class'); ?>: </b> <span class="cls"></span></center> 
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!empty($result_array)) { ?>
                                <div class="table-responsive">
                                	<div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?> </br>
										<?php echo $this->lang->line('class_timetable'); ?></div>
                                    	<table class="table table-bordered example">
                                        	<thead>
                                            	<tr>
                                                	<th>
                                                    	<?php echo $this->lang->line('subject'); ?>
                                                	</th>
                                                	<?php foreach($getDaysnameList as $key=>$value){  ?>
                                                    <th class="text text-center">
                                                        <?php echo $value;?>
                                                    </th>
                                                <?php }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  foreach ($result_array as $key => $timetable){ 
											
										 
											?>
                                            <tr>
                                            	<th><?php echo $key; ?></th>
                                                <?php foreach ($timetable as $key => $value) {?>
                                                <td class="text text-center">	 
												<?php if(!isset($value->status)){foreach ($value as $key => $valtime) {
                                             	$status = $valtime->status; if ($status == "Yes"){?> 
                                                	<div class="attachment-block clearfix">
                                                   	<?php if ($valtime->start_time != "" && $valtime->end_time != "") { ?>
                                                    	<strong class="text-green"><?php echo $valtime->start_time; ?></strong>
                                                     	<b class="text text-center">-</b>
                                                        <strong class="text-green"><?php echo $valtime->end_time; ?></strong><br/>
                                                       
     <strong class="text-green"><?php echo $valtime->teacher; ?></strong><br />
    <?php  if($admin['roles']['Teacher']) {?>
     <center >
     <?php if($valtime->is_live=='0') { ?>
     <a href="#"  class="generate_link"  data-id="<?php echo $valtime->id ?>" data-apid="<?php echo $valtime->apid ?>"  data-status="1"><?php echo $this->lang->line('start'); ?></a><?php } else if($valtime->is_live=='1') { ?> <a href="#" class="live_class_start_<?php echo $valtime->id ?>" id="live_class_start" data-id="<?php echo $valtime->id ?>" data-apid="<?php echo $valtime->apid ?>" data-status="0"><?php echo $this->lang->line('end'); ?></a>  <?php } ?>
     
     
     
     
     </center> <?php } ?>
     
                                                             <?php } else { ?>
                                                      	<b class="text text-center"><?php echo $this->lang->line('not'); ?> <br/><?php echo $this->lang->line('scheduled'); ?></b><br/>
                                                  		<strong class="text-green"></strong>
                                                        <?php } ?>
                                                  	</div>
                                                    <?php } else {  ?>
                                                    <div class="attachment-block clearfix">
                                                                    <strong class="text-red"><?php echo $valtime->start_time; ?></strong>
                                                                </div>
                                                            
                                                            <?php
                                                        }
                                                    }}else{?>
													 <div class="attachment-block clearfix">
                                                                    <strong class="text-red"><?php echo $value->start_time?$value->start_time:"N/A"; ?></strong>
                                                                </div>	
														
													<?php }
                                                    ?>
                                                    </td>
                                                   <?php }?>
                                                    
                                                     </tr> 
                                                <?php
                                            }
                                            ?> 
                                          
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
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





<div class="modal fade modalliveclass" id="modalliveclass"  role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Upload</h4>
            </div>


           <form  action="<?php echo site_url('admin/live_class/uploaded_class') ?>"  id="liveclass-form"  name="liveclass" method="post"  enctype='multipart/form-data' >
            <div class="modal-body">
            
             
              <input type="hidden" id="key_id" name="key_id" value="" />
               
                <div class="form-group">
                     <div class="around10">
                
                     <div class="row">
                         <div class="col-md-6">
                          <label >Date</label><small class="req"> *</small>
                          
                           <!--<input  id="date" name="admission_date" placeholder="" type="text" class="form-control date"  value="" />-->
                           
                           
                            <input  id="upload_date" name="upload_date" placeholder="" type="text" class="form-control date"  value="" />
                           
                           <span class="text-danger" id="upload_date_error"></span>
                         </div>
                         
                           <div class="col-md-6 bootstrap-timepicker">
                          <label for="exampleInputFile">Time</label><small class="req"> *</small>
              <input type="text" name="etime" class="form-control timepicker etime" id="etime" value="">
                  <span class="text-danger" id="etime_error"></span>
                         </div>
                         
                     </div> </div>
                  
              
                        <div class="around10">
                                                 
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label >Upload</label><small class="req"> *</small>
                 <input class="filestyle form-control"  type='file' name='videofile' id="file" />

                                        </div>
                                       <!-- <span class="text-danger"><?php //echo form_error('file'); ?></span>-->
                                    </div>
                                </div> </div>
                                
                                
                                
                              </div>  
                                
                                
                                
                        
                                
               
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn_save btn-primary btn-sm"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"  id="load"> <?php echo $this->lang->line('submit'); ?>
                                            </button>
              
            </div>
            
            
             </form>       
            
        </div>
    </div>
</div>







   <div class="modal fade generatelink" id="generatelink"  role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Upload Link</h4>
            </div>

 <form  action="<?php echo site_url('admin/live_class/generate_apid') ?>"  id="liveclass-form"  name="liveclass" method="post"  enctype='multipart/form-data' >
            <div class="modal-body">
             <input type="hidden" id="timetable_id" name="timetable_id" value="" />
               
                <div class="form-group">
                     <div class="around10">
                
                     <div class="row">
                         <div class="col-md-12">
                          <label>Apid</label><small class="req"> *</small>
                          
                             <input   name="apid" placeholder="Enter the link" type="text" id="apid-input" class="form-control"  value="" />
                           
                           <span class="text-danger" id="upload_date_error"></span>
                         </div>
                          
                     </div>    </div>
                     
                       <div class="around10">
                     <div class="row">
                         <div class="col-md-12">
                         
               <button type="button"  class="btn btn-sm pull-right" id="meet"> Generate Link</button>
                           
                          
                         </div>
                          
                     </div></div>
                     
                          </div>  
                  
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing" > <?php echo $this->lang->line('submit'); ?>
                                            </button>
              <!--  <button type="button" class="btn btn-default" data-dismiss="modal"><?php //echo $this->lang->line('cancel'); ?></button>-->
               
            </div>
            
            
             </form>       
            
        </div>
    </div>
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
        getSectionByClass(class_id, section_id);
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
    });

   
   
   
   
   $(document).on('click', '#live_class_start', function () 
{
	  var id=$(this).data('id');
	  var status=$(this).data('status');

              $.ajax({
                type: "post",
                url: '<?php echo site_url("admin/live_class/class_start") ?>',
                dataType: "json",
                data: {'id':id,'status':status},
                success: function (data) {
					
					console.log(data);
				 /* if(data.status==1)
				  {	
				  window.location.href="<?php echo base_url();?>admin/live_class/live_class_start/"+data.id;
				  }*/
				  
				  if(data.status==0)
				  {
					//   var end=' <button style="color: red;" type="button" class="video_uploader" data-toggle="tooltip"  id="video_uploader" data-liveclass_id="'+data.id+'"> Upload</button>';
					//   //$("#liveclass_upload").modal('show');
					//    $('.live_class_start_'+data.id).html(end);
					  
					  }
				  
				  else
				  {
					 location.reload(); 
					  
					  }
				  
                }
            });
});

  /* $(document).on('click', '#video_uploader', function () 
{ 
 
   var key=$(this).data('key');
   
  $("#liveclass_upload").modal('show');
 
   
   });*/
   
   
     
</script>

<script type="text/javascript">
 

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


</script>


<script type="text/javascript">



    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        var cls = $("#class_id option:selected").text();
        var sec = $("#section_id option:selected").text();
        $('.cls').html(cls + '(' + sec + ')');
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>





<script type="text/javascript">

 var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

$(document).ready(function() {
   
        $(".date").datepicker({
		
            format:date_format,
            autoclose: true,
           
        });
		
		 });
		
		
   
		

    $(document).on('click', '.btn_save', function (e) {
	   var $this = $(this);
        $this.button('loading');
	   var id=$('#key_id').val();
      var upload_date=$('#upload_date').val();
	  var etime=$('#etime').val();
     
        
		
        $.ajax({
            url: '<?php echo site_url('admin/live_class/uploaded_class_validation') ?>',
            type: 'post',
            data: {upload_date: upload_date, etime: etime,id:id},
            dataType: 'json',
            success: function (response) {
                 console.log(response);
                  $this.button('reset');
                  if (response.status == "fail") {
                     $.each(response.error, function (index, value) {
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
				
				else
				{
					$("form#liveclass-form").submit();
					
					  
					}
				
				
				
            }
        });
    });
</script>


<script type="text/javascript">

/*$('#modalliveclass').on('show.bs.modal', function (e) {
        console.log('sdree');
	    var data = $(e.relatedTarget).data();
		  
		    var id = data.liveclass_id;
             $('#key_id').val(id); 
		
           $('#sub_invoice', this).val("");
        $('#key_id', this).val($(e.relatedTarget).data('liveclass_id'));
           


        });
	   */
	   
	   
	    $(document).on('click', '.video_uploader', function () {
	   
	    var id = $(this).data('liveclass_id');
            $('#key_id').val(id); 
	   $("#modalliveclass").modal('show');
	   });
     
	 
	 
	  $(document).on('click', '.generate_link', function () {
	   
	    var id = $(this).data('id');
	    var apid = $(this).data('apid');
       $('#timetable_id').val(id); 
       $('#apid-input').val(apid); 
	   $("#generatelink").modal('show');
	   });


     $(document).on('click', '#meet', function () {
	   
	   window.open('https://meet.google.com/');
	   });
	 


</script>









