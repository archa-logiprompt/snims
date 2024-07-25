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
            if ($this->rbac->hasPrivilege('subject', 'can_add')) {
                ?>        
                <div class="col-md-4">          
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_subject'); ?></h3>
                        </div>
                        <form  action="<?php echo site_url('admin/subject/create') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>     
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="subname" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                              <!--  <label class="radio-inline">
                                    <input type="radio" value="Theory" name="type"  <?php //if (set_value('type') == "Theory") echo "checked"; ?> checked><?php echo $this->lang->line('theory'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" <?php //if (set_value('type') == "Practical") echo "checked"; ?> value="Practical"><?php echo $this->lang->line('practical'); ?>
                                </label>-->
                                
                                
                                <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="practical" <?php if (set_value('practical') == "practical") echo "checked"; ?> value="Practical" id='practical' > <?php echo 'Practical'; ?> 
                                            </label>
                                            
                                             <label>
                                                <input type="checkbox" name="theory" <?php if (set_value('theory') == "theory") echo "checked"; ?> value="Theory"  id='theory'> <?php echo 'Theory'; ?> 
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
                                    if ($centre_id == 1) {
                                        echo '<input type="checkbox" name="cocurricular"   value="Cocurricular" id="cocurricular" > Cocurricular';
                                    } 
                                    ?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="clinical" <?php if (set_value('clinical') == "clinical") echo "checked"; ?> value="clinical"  id='clinical'> <?php echo 'Clinical'; ?> 
                                            </label>
                                       </div>
                                 <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label
                                                    for="exampleInputFile"><?php //echo $this->lang->line('photo'); ?></label>
                                                <div><input class="filestyle form-control" type='file' name='filedemo'
                                                        id="filecsv" size='20' />
                                                </div>
                                                <span class="text-danger"><?php //echo form_error('file'); ?></span>
                                            </div>
                                        </div>
                                 -->
                                
                                <div class="form-group"><br>
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject_code'); ?></label>
                                    <input id="subcode" name="code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('code'); ?></span>
                                </div>
                                
                                
                                
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
            if ($this->rbac->hasPrivilege('subject', 'can_add')) {
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
                                         <th><?php echo 'theory/practical/lab/clinical'; ?></th>
                                       <?php /*?> <th><?php echo $this->lang->line('subject'); ?>
                                            <?php echo $this->lang->line('type'); ?><?php */?>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    // var_dump($subjectlist);exit;
                                    // echo "hi";exit;
                                    foreach ($subjectlist as $subject) {
										
										
                                        ?>
                                      
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject['name'] ?></td>
                                            <td class="mailbox-name"><?php echo $subject['code'] ?></td>
                                                                                       <td class="mailbox-name"><?php echo $subject['theory']."".$subject['practical'] ."".$subject['lab']." ".$subject['clinical']."".$subject['lab']."".$subject['viva']?> </td>

                                            
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.js"
    integrity="sha512-M0cjXJTonbWEdLI3HJIoJSQBb9980RWmOCk+tvWkhgFrAZqSSIg1+1Db/vDu7Qk9W3L90gBynve17PYvarjfQA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
const input = document.querySelector('input[id="filecsv"]');

input.addEventListener('change', function() {
    const file = input.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', function() {
        const csv = reader.result;
        const results = Papa.parse(csv);
        results.data.forEach(row => {
        

            
            $('#subname').val(row[1])
            $('#subcode').val(row[0])


            if(row[5]=='Theory'){
                $('#theory').prop('checked',true)
                $('#practical').prop('checked',false)
            }
            if(row[5]=='Practical'){
                $('#theory').prop('checked',false)
                $('#practical').prop('checked',true)
            }
            if(row[5]=='Theory/ Practical'){
                
                $('#theory').prop('checked',true)
                $('#practical').prop('checked',true)
            }

            // auth()



           
           

            // Wrap the AJAX request in an async function
            async function sendFormData() {
                var form = $('#employeeform');
                var formData = form.serialize(); // get form data
                try {
                    const response = await $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: formData
                    });
                    // console.log(response);
                } catch (error) {
                    // console.log(error);
                }
            }

            sendFormData(); // Call the async function to send the AJAX request
            return false; // prevent default form submission

        });
    });

    reader.readAsText(file);
});
</script>