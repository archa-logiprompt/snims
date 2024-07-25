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
<script src='https://meet.jit.si/external_api.js'></script>

<div class="content-wrapper" style="min-height: 946px;">  
	<section class="content-header">
    	<h1><i class="fa fa-mortar-board"></i> Uploaded Class <small></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
     <?php $student=$this->session->userdata('student'); ?>
      
    
    
    
    	<div class="row">
        
       
            
        	
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Uploaded Class</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                   
                        <div class="box-body" id="meet">

                      
                        
                        <div class="row">
       
                        <?php 
					 $currentdate=date('Y-m-d');
					 
					 date_default_timezone_set('Asia/Kolkata');
                    $currentTime = date('h:i A', time () );
					 $time=strtotime($currentTime);
					 
					if(isset($uploaded)) foreach($uploaded  as $up){ 
						$up_time=strtotime($up['time']);
						
						
	       if($up['v_date'] >= $currentdate && $up_time > $time )
	         {
		
		
                     ?>   
                        <div class="col-md-4">
                        <div class="attachment-block clearfix">
                       
                       <video  width="320" height="176" controls>
                   <source src="<?php echo base_url('uploads/gallery/') ?><?php echo $up['video'] ?>" type="video">
                   </video>
                       
                     
                       
                         <a style="color: #a9101a;font-size: medium;" class="attendance" data-student_id="<?php echo $student['student_id'] ?>" data-live_class_id="<?php echo $up['live_class_id'] ?>" href="<?php echo base_url() ?>user/live_class/view_class/<?php echo $up['id']  ?>" >View Class</a>
                        
                        </div>
                        </div><?php  
						}
						
						} ?>
                        
                        
                        </div>
                        
                        
                        

                          
                        </div>
                        
                   
                </div>
 
           
   
</div>
</div>
 </section>
   
   
   <script>
   
    $(document).ready(function () {
   
   
   $(document).on('click', '.attendance', function () 
{
	  var live_class_id=$(this).data('live_class_id');
	  var student_id=$(this).data('student_id');

              $.ajax({
                type: "post",
                url: '<?php echo site_url("user/live_class/attendance") ?>',
                dataType: "json",
                data: {'live_class_id':live_class_id,'student_id':student_id},
                success: function (data) {
					
				}
			    
            });
});
   
});   
   
   
   
   
/*const domain = 'meet.jit.si';
const options = {
    roomName: '<?php //echo $class['apid'] ?>',
    width: 1000,
    height: 500,
	userInfo: {
        email: 'stud@gmail.com',
        displayName: '<?php //echo $student['username']; ?> '
    },
    parentNode: document.querySelector('#meet')
};
const api = new JitsiMeetExternalAPI(domain, options);*/
</script>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
























