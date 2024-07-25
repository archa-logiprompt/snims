<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('class_timetable'); ?> </h1>
    </section>
    
    <?php $student=$this->session->userdata('student'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        
            <div class="col-md-12">
                <?php
                if (isset($result_array)) {
                    ?>
                    <div class="box box-warning">
                        <div class="box-body">
                            <?php
                            if (!empty($result_array)) {
                                ?>
                                <div class="table-responsive">
                                    <div class="download_label"><?php echo $this->lang->line('class_timetable'); ?></div>
                                    <table class="table  table-bordered example">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('subject'); ?>
                                                </th>
                                                <?php foreach ($getDaysnameList as $key => $value) { 
                                                    ?>
                                                    <th class="text text-center">
                                                        <?php echo $value; ?>
                                                    </th>
                                                <?php }
                                                ?>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            <?php   foreach ($result_array as $key => $timetable){ ?>
                                            <tr>
                                            	
                                            
                                            	<th><?php echo $key; ?></th>
                                                
                                                <?php foreach ($timetable as $t_key => $value) {
													
													 ?>
                                                <td class="text text-center">	 
								<?php if(!isset($value->status)){foreach ($value as $key => $valtime) {
								
									$status = $valtime->status; if ($status == "Yes"){?> 
                                                	<div class="attachment-block clearfix">
                                                   	<?php if ($valtime->start_time != "" && $valtime->end_time != "") { ?>
                                                    	<strong class="text-green"><?php echo $valtime->start_time; ?></strong>
                                                     	<b class="text text-center">-</b>
                                                        <strong class="text-green"><?php echo $valtime->end_time; ?></strong><br/>
                                                       
     <strong class="text-green"><?php echo $valtime->teacher; ?></strong><br />
   
     <center >
    
  
    <?php if($valtime->is_live==1){ ?>
    <a class="attendance" data-start_time="<?php echo $valtime->start_time ?>" data-student_id="<?php echo $student['student_id']?>"  data-live_class_id="<?php echo $valtime->id ?>" href="<?php echo $valtime->apid ?>" ><?php echo $this->lang->line('join'); ?></a><?php } ?>
    
     
     <!--<a  href="<?php //echo base_url() ?>user/live_class/uploaded_class/<?php //echo $valtime->id  ?>" >Uploaded Class</a>-->
    
    
     </center> 
     
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

<script>
   
    $(document).ready(function () {
   
   
   $(document).on('click', '.attendance', function () 
{
	  var live_class_id=$(this).data('live_class_id');
	  var student_id=$(this).data('student_id');
	  var start_time=$(this).data('start_time');

                
              $.ajax({
                type: "post",
                url: '<?php echo site_url("user/live_class/attendance") ?>',
                dataType: "json",
                data: {'live_class_id':live_class_id,'student_id':student_id,'start_time':start_time},
                success: function (data) {
					
				}
			    
            });
});
   
});   


</script>


 <!-- user/live_class/live_class_join/-->

