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
            if ($this->rbac->hasPrivilege('subject', 'can_add') || $this->rbac->hasPrivilege('subject', 'can_edit')) {
                ?>         
                <div class="col-md-4">            
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_subject'); ?></h3>
                        </div>
                        <form action="<?php echo site_url("admin/subject/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>   
                                <?php echo $this->customlib->getCSRF();  ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_name'); ?></label> <small class="req"> *</small>
                                    <input autofocus="" id="category" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $subject['name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                               <!-- <label class="radio-inline">
                                    <input type="radio" value="Theory" name="type"  <?php //if (set_value('type', $subject['type']) == "Theory") echo "checked"; ?> checked><?php //echo $this->lang->line('theory'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" <?php //if (set_value('type', $subject['type']) == "Practical") echo "checked"; ?> value="Practical"><?php //echo $this->lang->line('practical'); ?>
                                </label>-->
                                
                                       <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="theory" value="Theory" <?php if(set_value('theory',$subject['theory']) == "Theory") echo "checked"; ?> ><?php echo $this->lang->line('theory'); ?> 
                                            </label>
                                            
                                             <label>
                                                <input type="checkbox" name="practical" <?php if (set_value('practical',$subject['practical']) == "Practical") echo "checked"; ?> value="Practical"  > <?php echo $this->lang->line('practical'); ?> 
                                            </label>
                                            <label>
                                             <?php
                                                if ($centre_id == 1) {
                                                    echo '<input type="checkbox" name="lab" value="lab" id="viva"> Lab';
                                                } else {
                                                    echo '<input type="checkbox" name="viva" value="viva" id="viva"> Viva';
                                                }
                                                ?>
                                                        </label>
                                                        <label>
                                                        <?php
                                    if ($centre_id == 1) {?>
                                        <input type="checkbox" name="cocurricular" <?php if(set_value('cocurricular',$subject['cocurricular']) == "Cocurricular") echo "checked"; ?>  value="Cocurricular" id="cocurricular"> Cocurricular
                                <?php     } 
                                    ?>
                                            </label>
                                            <label>
                                                <!-- <input type="checkbox" name="clinical" <?php if (set_value('clinical') == "clinical") echo "checked"; ?> value="clinical"  id='clinical'> <?php echo 'Clinical'; ?>  -->
                                                <input type="checkbox" name="clinical" <?php if(set_value('clinical',$subject['clinical']) == "clinical") echo "checked"; ?>  value="clinical" id="clinical"> Clinical

                                            </label>
                                       </div>
                                
                              
                              
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_code'); ?></label>
                                    <input id="category" name="code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('code', $subject['code']); ?>" />
                                    <span class="text-danger"><?php echo form_error('code'); ?></span>
                                </div>
                                
                                
                                 <!--<div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php //echo $this->lang->line('subject_code_practical'); ?></label>
                                    <input id="category" name="code1" placeholder="" type="text" class="form-control"  value="<?php //echo set_value('code1',$subject['code2']); ?>" />
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
            if ($this->rbac->hasPrivilege('subject', 'can_add') || $this->rbac->hasPrivilege('subject', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">            
                <div class="box box-primary" id="sublist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('subject_list'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
							<?php echo $this->lang->line('subject_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('subject_code'); ?></th>
                                         <th><?php echo $this->lang->line('theory/practical/clinical/lab'); ?></th>
                                      <?php /*?>  
                                        <th><?php echo $this->lang->line('subject'); ?>
                                            <?php echo $this->lang->line('type'); ?>
                                        </th><?php */?>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    // var_dump($subjectlist);exit;
                                    foreach ($subjectlist as $subject) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject['name'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['code'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['theory']."".$subject['practical'] ."".$subject['lab']." ".$subject['clinical']."".$subject['lab']?> </td>
                                            <td class="mailbox-date pull-right no-print">
                                                <?php
                                                if ($this->rbac->hasPrivilege('subject', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/subject/edit/<?php echo $subject['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('subject', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/subject/delete/<?php echo $subject['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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

    function Popup(data) {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        mywindow.document.write('<style type="text/css">.test { color:red; } </style></head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
    }
</script>