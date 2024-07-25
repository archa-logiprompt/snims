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
    	<h1><i class="fa fa-mortar-board"></i> Class <small></small></h1>
    </section>
    <!-- Main content -->
    
    <?php 
   
   $path=$video['video'];
   
  
   ?>
    
    
    <section class="content">
    
   
   
    
    	
        
        
            
        	<div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Class</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                   
                        <div class="box-body" id="meet">

                            <?php  echo $this->customlib->getCSRF(); ?>
                            
                            
                            
                             <video  width="900" height="500" controls>
  <source src="<?php echo base_url('uploads/gallery/'.$video['video']) ?>" type="video/mp4">
 <!--  <source src="<?php //echo base_url('uploads/gallery/'.$video['video']) ?>" type="video/ogg">-->
                   </video>
                            
                          
                        </div>
                        
                   
                </div>
 
           
   
</div>
</div>

 </section>
   
   
   <script>
/*const domain = 'meet.jit.si';
const options = {
    roomName: '<?php echo $class['apid'] ?>',
    width: 1000,
    height: 500,
	userInfo: {
        email: 'stud@gmail.com',
        displayName: '<?php echo $student['username']; ?> '
    },
    parentNode: document.querySelector('#meet')
};
const api = new JitsiMeetExternalAPI(domain, options);*/
</script>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
























