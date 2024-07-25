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
    	<h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('live_class'); ?> <small></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
     <?php $admin=$this->session->userdata('admin'); ?>
     
    
   
    
      <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Live Class</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                   
                        <div class="box-body" id="meet">
                           
                           <div style="text-align: center;">
                           <a target="new" class="btn btn-primary" href="<?php echo $class['apid'] ?>">
                           Start Meeting
                          </a> </div>
                           <!--<button type="button" class="btn btn-primary">Join Meet</button>-->
                        </div>
                        
                   
                </div>
           
    </section>
</div>

<script>
/*const domain = 'meet.jit.si';
const options = {
    roomName: '<?php //echo $class['apid'] ?>',
    width: 1000,
    height: 500,
	userInfo: {
        email: 'test@gmail.com',
        displayName: '<?php //echo $admin['username']; ?>'
    },
    parentNode: document.querySelector('#meet')
};
const api = new JitsiMeetExternalAPI(domain, options);*/
</script>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
























