
<style>


/*:root {
--primary-color: 19, 122, 249;
}*/

.clockpicker-popover .popover-header {

align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    background-color: #e8ecf1 !important;
    color: #337ab7 !important;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-size: 3rem;
    font-weight: 400;
    letter-spacing: normal;
    text-align: center;
    padding: .5rem;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
	
}


</style>









<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-clock-o"></i> <?php echo $this->lang->line('minutes'); ?></h1>
    </section>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/djibe/clockpicker@1d03466e3b5eebc9e7e1dc4afa47ff0d265e2f16/dist/bootstrap4-clockpicker.min.css">
<script src="https://cdn.jsdelivr.net/gh/djibe/clockpicker@6d385d49ed6cc7f58a0b23db3477f236e4c1cd3e/dist/bootstrap4-clockpicker.min.js"> </script>



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('minutes', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('minutes'); ?></h3>
                        </div><!-- /.box-header -->
       <form id="form1" action="<?php echo site_url("admin/minutes/edit/" . $id) ?> " id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
 
 
 
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('minutes'); ?> <?php echo $this->lang->line('title'); ?></label> <small class="req">*</small>
                                    <input autofocus="" id="min_title" name="min_title" type="text" class="form-control"  value="<?php echo set_value('min_title',$minute['min_title']); ?>" />
                                    <span class="text-danger"><?php echo form_error('min_title'); ?></span>
                                </div>
                                


                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                     
 <textarea id="description" name="description" class="form-control compose-textarea">
                                                    <?php echo set_value('message',$minute['min_desc']); ?>
                                                </textarea>
                                </div>
                                
                               
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('information'); ?></label>
                                     
 <textarea id="information" name="information" class="form-control compose-textarea">
                                            <?php echo set_value('information',$minute['information']); ?>
                                                </textarea>
                                </div>
                                
                               <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('report'); ?></label>
                                     
 <textarea id="report" name="report" class="form-control compose-textarea">
                                                    <?php echo set_value('report',$minute['report']); ?>
                                                </textarea>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('meeting_adjourned'); ?></label> <small class="req">*</small>
                                    <input autofocus="" id="meeting_adjourned" name="meeting_adjourned" type="text" class="form-control clockpicker"  value="<?php echo set_value('meeting_adjourned',$minute['meeting_adj']); ?>" />
                                    <span class="text-danger"><?php //echo form_error('name'); ?></span>
                                </div>
                                
                                
                                
                                     
                                
                                
                             
                                
                                   
                                
                            </div>
                            
                            
                        
                            
                            
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('minutes', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('minutes'); ?> <?php echo $this->lang->line('list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('minutes'); ?> <?php echo $this->lang->line('list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                     <th><?php echo $this->lang->line('minutes'); ?> <?php echo $this->lang->line('title'); ?></th>
                                    
                                        <th><?php echo $this->lang->line('meeting_adjourned'); ?> 
                                        </th>
                             



               <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									
                                    foreach ($minute_list as $list) {
									
                                        ?>
                                        <tr>
                                           
                                            <td class="mailbox-name">
                                                <?php echo $list['min_title']; ?>
                                                
                                            </td>
                                             <td class="mailbox-name">
                                                <?php echo $list['meeting_adj']; ?>
                                                
                                            </td>
                                            
                                            
                                            <td class="mailbox-date pull-right"> 
                                            
                      
                       <button  data-id="<?php  echo $list['id'];?>"  type="button" id="minutes" > <i class="fa fa-eye"></i>  </button>
                                            
                                            </td>
                                            
                                            
                                            
                                            
                                            
                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('minutes', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/minutes/edit/<?php echo $list['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php
                      if ($this->rbac->hasPrivilege('minutes', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/minutes/delete/<?php echo $list['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">


$('.clockpicker').clockpicker({
'default': 'now',
vibrate: true,
placement: "top",
align: "left",
autoclose: false,
twelvehour: true
});



    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
	
	$('.compose-textarea').wysihtml5({
        toolbar: {
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": false, //Button to insert an image. Default true,
            "color": false, //Button to change color of font  
            "blockquote": false, //Blockquote  
            "size": 'sm' //default: none, other options are xs, sm, lg
        }, "events": {
            "load": function () {
                var $data = $(this.composer);
                var text_id = $data[0].parent.textarea.element.id;
                var $body = $(this.composer.element);
                $body.bind('keypress keyup keydown paste change focus blur', function (e) {
                    var total_length = $body[0].innerText.length;
                    $('.tot_count_' + text_id).html("Character Count: " + total_length);
                });
            }


        }
    });

	
	
	
	
	
</script>





<script>

	$(document).on('click', '#minutes', function () 
{
	
var id=$(this).data('id');

$.ajax({
                type: "post",
                url: '<?php echo site_url("admin/minutes/minutes_pdf") ?>',
               
                data: {'id':id},
                success: function (response) {
					
					console.log(response);
					
				$('.modal-body').html(response);
				
				 $("#scheduleModal").modal('show');	
					
                   
                }
            });
});

</script>	




<script type="text/javascript">	


	$(document).on('click', '#printminutes', function () {
	
   
     var printContents = document.getElementById('print_minutes').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

   
   });

</script>


<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="document">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <center> <h4 class="modal-title"> Minutes </h4>    </center>
            </div>
            <div class="modal-body" id="print_minutes" style="margin-left: 34px; margin-right: 34px;">
            
            
            
            </div>
            <div class="modal-footer">
             <button type="button" aria-controls="DataTables_Table_0" class="btn btn-sm btn-danger login-submit-cs fa fa-print buttons-print" id="printminutes"><?php echo $this->lang->line('print'); ?></button>
                <button type="button" class="btn btn-default " data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>

