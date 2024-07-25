<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-university"></i> <?php echo $this->lang->line('centre'); ?></h1>
    </section>
    <!-- Main content -->










    
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('centre', 'can_add')) {
                ?>        
                <div class="col-md-4">          
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('centre'); ?></h3>
                        </div>
                        <form id="form1" enctype="multipart/form-data" action="<?php echo site_url("admin/centre/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        
                        
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>     
                                <?php echo $this->customlib->getCSRF(); ?>
                                
                                
                          
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('code'); ?></label><small class="req"> *</small>
                                    <input id="centre_code" name="centre_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('centre_code',$centreedit['centre_code']); ?>" />
                                    <span class="text-danger"><?php echo form_error('centre_code'); ?></span>
                                </div>
                                
                                <input type="hidden"  name="id" value="<?php echo $centreedit['id']?>"  /> 
                                
                                
                                 <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                    <input id="centre_name" name="centre_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('centre_name',$centreedit['centre_name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('centre_name'); ?></span>
                                </div>
                                
                          
                                 <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('address'); ?> 1</label>
                                    <textarea  class="form-control" name="centre_add1" id="centre_add1"><?php echo $centreedit['centre_add1']; ?> </textarea>
                                    <span class="text-danger"><?php echo form_error('centre_add1') ?></span>
                                </div>
                                
                                  <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('address'); ?> 2</label>
                                    <textarea  class="form-control" name="centre_add2" id="centre_add2"> <?php echo $centreedit['centre_add2'] ?></textarea>
                                    <span class="text-danger"><?php echo form_error('centre_add2'); ?></span>
                                </div>
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('email'); ?> </label><small class="req"> *</small>
                                     <input id="centre_email" name="centre_email" placeholder="" type="email" class="form-control"  value="<?php echo set_value('centre_email',$centreedit['centre_email']); ?>" />
                                    <span class="text-danger"><?php echo form_error('centre_email'); ?></span>
                                </div>
                               
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('mobile_no'); ?> </label><small class="req"> *</small>
                                     <input id="centre_phone" name="centre_phone" placeholder="" type="number" class="form-control"  value="<?php echo set_value('centre_phone',$centreedit['centre_phone']); ?>" />
                                    <span class="text-danger"><?php echo form_error('centre_phone'); ?></span>
                                </div>
                               
                               
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('image');   ?></label>
                                    <input id="file" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="file">
                                </div>
                               
                               
                               
                               <div class="form-group">
 <label for="exampleInputEmail1"><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('active'); ?></label> <small class="req">*</small>
 					              
                                  <select autofocus="" id="centre_active" name="centre_active" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                      <option <?php if($centreedit['centre_active']=='active') {echo 'selected="selected"';}?>value="active">Active</option>
                                       <option <?php if($centreedit['centre_active']=='inactive') {echo 'selected="selected"';}?> value="inactive">Inactive </option>                     
                                          </select>
                                   <span class="text-danger"><?php echo form_error('centre_active'); ?></span>
                                        </div>
                               
                               
                               
                               
                                
                                
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('centre', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">            
                <div class="box box-primary" id="sublist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('centre_list'); ?></h3>
                    </div>
                         <?php //$college_name=$this->setting_model->getschoolname();  

?>
   
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label">
							 <?php echo $college_name['centre_name'];?><br />
							<?php echo $this->lang->line('centre_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('code'); ?></th>
                                        <th><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('address'); ?></th>
                                        <th><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('mobile_no'); ?></th>
                                         <th><?php echo $this->lang->line('centre'); ?> <?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($centrelist as $centre) {
										
										
										 
                                        ?>
                                      
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $centre['centre_code'] ?></td>
                                            <td class="mailbox-name"><?php echo $centre['centre_name'] ?></td>
                                            <td class="mailbox-name"><?php echo $centre['centre_add1'] ?></td>
                                            <td class="mailbox-name"><?php echo $centre['centre_phone'] ?></td>
                                            <td class="mailbox-name"><?php echo $centre['centre_email'] ?></td>
                                             <td class="mailbox-name"><?php if($centre['centre_active'] =='active') {?>
                                              
                                              <div style="color: rgb(20, 146, 29);">
                                                 <?php echo $centre['centre_active'] ?>
                                                 </div>
                                                 
                                                <?php } else if($centre['centre_active'] =='inactive') {?>
                                                
                                                 <div style="color: #e2220b;">
                                                 <?php echo $centre['centre_active'] ?></div><?php } else{ }?>
											 </td>
                                            
                                            <td class="mailbox-date pull-right no-print">
                                                <?php
                                                if ($this->rbac->hasPrivilege('centre', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/subject/edit/<?php echo $centre['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('centre', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/centre/delete/<?php echo $centre['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                                
                                                 <?php  //var_dump($centre['centre_image']);
												if ($centre['centre_image'] !== "") { ?>
                                     <a href="<?php echo base_url().'uploads/centre_image/'.$centre['centre_image']; ?>" class="btn btn-default btn-xs" download data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('download') ?>">
                                                            <i class="fa fa-download"></i>
                                                        </a>  <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

        </div> 
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
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