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
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('device_type', 'can_add')) {
                ?>        
                <div class="col-md-4">          
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_subject'); ?></h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('admin/devicetype/create') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>     
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo 'Device Type' ?></label><small class="req"> *</small>
                                    <input autofocus="" id="devicetype" name="devicetype" placeholder="" type="text" class="form-control"  value="<?php echo set_value('devicetype'); ?>" />
                                    <span class="text-danger"><?php echo form_error('devicetype'); ?></span>
                                </div>
                                
                              <!--  <label class="radio-inline">
                                    <input type="radio" value="Theory" name="type"  <?php //if (set_value('type') == "Theory") echo "checked"; ?> checked><?php /*?><?php echo $this->lang->line('theory'); ?><?php */?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" <?php //if (set_value('type') == "Practical") echo "checked"; ?> value="Practical"><?php /*?><?php echo $this->lang->line('practical'); ?><?php */?>
                                </label>-->
                                
                                
                                <?php /*?><!--<div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="theory" value="Theory" <?php if(set_value('theory') == "Theory") echo "checked"; ?> ><?php echo $this->lang->line('theory'); ?> 
                                            </label>
                                            
                                             <label>
                                                <input type="checkbox" name="practical" <?php if (set_value('practical') == "Practical") echo "checked"; ?> value="Practical"  > <?php echo $this->lang->line('practical'); ?> 
                                            </label>
                                       </div>
                                --><?php */?>
                                
                                
                                <?php /*?><div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_code'); ?></label>
                                    <input id="category" name="code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('code'); ?></span>
                                </div>
                                <?php */?>
                                
                                
                  <!--<div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php //echo $this->lang->line('subject_code_practical'); ?></label>
                                    <input id="category" name="code1" placeholder="" type="text" class="form-control"  value="<?php //echo set_value('code1'); ?>" />
                                    <span class="text-danger"><?php //echo form_error('code1'); ?></span>
                                </div>-->              
                                
                                
                                
                                
                                
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('device_type', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">            
                <div class="box box-primary" id="sublist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo 'Device Type'; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
							<?php echo 'Device Type'; ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo 'Devicetype'; ?></th>
                                        <?php /*?><th><?php echo $this->lang->line('subject_code'); ?></th>
                                         <th><?php echo $this->lang->line('theory/practical'); ?></th><?php */?>
                                       <?php /*?> <th><?php echo $this->lang->line('subject'); ?>
                                            <?php echo $this->lang->line('type'); ?><?php */?>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($devicelist as $subject) {
										
										
										  //var_dump($subject);
                                        ?>
                                      
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject['devicetype'] ?></td>
                                            <?php /*?><td class="mailbox-name"><?php echo $subject['code'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['theory'].'&'.$subject['practical'] ?></td>
                                            <?php */?>
                                            <td class="mailbox-date pull-right no-print">
                                                <?php
                                                if ($this->rbac->hasPrivilege('device_type', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/devicetype/edit/<?php echo $subject['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('device_type', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/devicetype/delete/<?php echo $subject['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
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