<style type="text/css">
@media print {

    .no-print,
    .no-print * {
        display: none !important;
    }
}

.print,
.print * {
    display: none;
}
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
            <small><?php echo $this->lang->line('student_fees1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?>
                        </h3>

                    </div>
                    <form action="<?php echo site_url('admin/monthlyacademicreport/fullreport')?>" method="post"
                        accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small
                                            class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($classlist as $class) { ?>
                                            <option value="<?php echo $class['id'] ?>"
                                                <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>>
                                                <?php echo $class['class'] ?></option>
                                            <?php $count++; } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small
                                            class="req"> *</small>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Month</label><small class="req">
                                            *</small>
                                        <input name="date" id='month_id' type="text" class="form-control date-picker"
                                            value="<?php echo date('m-Y') ?>" />
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-search"></i>
                                <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>



                <?php  if ($is_search){?>
                <div class="box box-primary">
                    <h3 class="titless pull-left"><i class="fa fa-money"></i> <?php echo 'Monthly Academic Report'; ?>

                    </h3>

                    <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search"
                        id="collection_print" value=""
                        class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        <?php echo $this->lang->line('print'); ?></button>


                    <div class="box-body" id="printcontent">

                        <div class="row">

                            <div class="col-md-12 ">


                                <div class="box-header print  with-border">
                                    <div class="row text-center">
                                        <div class="col-sm-2" style="width:20%;">

                                        </div>
                                        <div class="col-sm-8">  

                                            <!-- <h3><?php echo strtoupper($this->setting_model->getCurrentSchoolName()); ?> -->
                                            </h3>
                                            <h3> Monthly Academic Report</h3>


                                        </div>
                                        <div class="col-sm-8">

                                            <h3> Month And Year: <?php  echo "$month_name $year" ?></h3>


                                        </div>
                                        <div class="col-sm-8">

                                            <h3> Programme And Batch: <?php  echo "$class_name $section_name" ?></h3>


                                        </div>
                                    </div>

                                </div>

                                <br>
                                <br>
 
                                <table style="width:100%;" border="1">
                                    <thead>
                                        <tr>
                                            <th style="padding: 5px;" rowspan="2">SL NO.</th>

                                            <th style="padding: 5px;text-align:center" rowspan="2">Subject</th>

                                            <th style="padding: 5px;text-align:center" colspan="3">Theory</th>

                                            <th style="padding: 5px;text-align:center" colspan="3">Practical</th>

                                        </tr>
                                        <tr>

                                            <th style="padding: 5px;text-align:center">Required</th>
                                            <th style="padding: 5px;text-align:center">Completed</th>
                                            <th style="padding: 5px;text-align:center">Planned</th>
                                            <th style="padding: 5px;text-align:center">Required</th>
                                            <th style="padding: 5px;text-align:center">Completed</th>
                                            <th style="padding: 5px;text-align:center">Planned</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                    $count =1; 
                                    foreach ($subjects_teachers_theory as $key => $value) {
                                         
                                      ?>
                                        <tr>
                                            <td style="padding: 5px;text-align:center"><?php echo $count ?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo $key ?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo getSubjectHoursByClassAndSection($class_id,$section_id,$value['subject_id'])['theory_hours'].' hrs'?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo $value['completed_hours_this_month']." hrs"; ?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo $value['total_hours']." hrs"; ?></td>
                                            <td style="padding: 5px;text-align:center">-</td>
                                            <td style="padding: 5px;text-align:center">-</td>
                                            <td style="padding: 5px;text-align:center">-</td>
                                        </tr>

                                    <?php 
                                    $count++;
                                    } ?>
                                    <?php  
                                    // var_dump($subjects_teachers_practical);exit;
                                    foreach ($subjects_teachers_practical as $key => $value) {
                                         
                                      ?>
                                        <tr>
                                            <td style="padding: 5px;text-align:center"><?php echo $count ?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo $key ?></td>
                                            <td style="padding: 5px;text-align:center">-</td>
                                            <td style="padding: 5px;text-align:center">-</td>
                                            <td style="padding: 5px;text-align:center">-</td>
                                           
                                            <td style="padding: 5px;text-align:center"><?php echo getSubjectHoursByClassAndSection($class_id,$section_id,$value['subject_id'])['theory_hours'].' hrs'?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo $value['completed_hours_this_month']." hrs"; ?></td>
                                            <td style="padding: 5px;text-align:center"><?php echo $value['total_hours']." hrs"; ?></td>
                                        </tr>

                                    <?php 
                                    $count++;
                                    } ?>
                                    

                                    </tbody>

                                </table>
                                <div class="row" style="padding-top:12px;display: flex;margin-left:2px">
                                    <div class="col-12">
                                        <h5>Specify the name of students who have not acquired 80% attendance in each subject - No One</h5>
                                        <h5>Number of Holidays in given month - 1 Day</h5>
                                         <h5 style="font-weight:bold">Details of Examinations</h5> 
                                         <h5 style="font-weight:bold">Details of university/sessional/unit tests</h5> 
                                         <div class="row">
                                            <ol>
                                            <?php foreach ($exam_list as $key => $value) {
                                            ?>
                                            <li><?php echo $value['subname'] ." ". $value['examname'] ." held on ". $value['date_of_exam']  ?></li>
                                            <?php } ?>
                                               
                                            </ol>
                                         </div>
                                         <h6 style="font-weight:bold">Details of remediation program / advanced learner program</h6> 
                                         <div class="row">
                                             <!-- <ol>
                                                 <li>Community health nursing revision was conducted for slow learners from 2nd sessional exam portians and later unit test was conducted for the entire batch.</li>
                                                 
                                                </ol> -->
                                            </div>
                                    </div>
                                </div>

                                <div class="row print" >
                        <!-- <div class="col-md-4">
                            <span>Signature Class Coordinator</span>
                        </div>
                        <div class="col-md-4">
                            <span>UG Coordinator</span>
                        </div>
                        
                        <div class="col-md-4">
                            <span>Signature Principal</span>
                        </div> -->
                        <br>  <br>  <br>
                        <table style="width:100%;">
                            <tr>
                                <td>Signature Class Coordinator</td>
                                <td>UG Coordinator</td>
                                <td style="text-align: right;">Signature Principal</td>
                            </tr>
                        </table>
                    </div>





                            </div>


                        </div>
                        


                    </div>
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php }?>
        </div>

    </section>
</div>




<?php 

function getdateformat($date){

    $date_string = $date;
    $date_format = 'd/m/Y';
    $dateformat = DateTime::createFromFormat($date_format, $date_string); 
    return $dateformat->format('l'). ' ('. $dateformat->format('d/m/Y') .')'; 
}


?>


<script type="text/javascript">
$(document).on('ready', function() {
    $(function() {

        $(".date-picker").datepicker({
            format: "mm-yyyy",
            startView: "months",
            minViewMode: "months",
        })


    });

});

function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section +
                        "</option>";
                });

                $('#section_id').append(div_data);
            }
        });
    }
}
$(document).ready(function() {
    $(document).on('change', '#class_id', function(e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.section_id + ">" + obj
                        .section + "</option>";
                });

                $('#section_id').append(div_data);
            }
        });
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    $(document).on('change', '#feecategory_id', function(e) {
        $('#feetype_id').html("");
        var feecategory_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "feemaster/getByFeecategory",
            data: {
                'feecategory_id': feecategory_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.id + ">" + obj.type +
                        "</option>";
                });

                $('#feetype_id').append(div_data);
            }
        });
    });
});

$(document).on('change', '#section_id', function(e) {
    $("form#schedule-form").submit();
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

function Popup(data) {

    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({
        "position": "absolute",
        "top": "-1000000px"
    });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0]
        .contentDocument.document : frame1[0].contentDocument;
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


    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/datepicker/datepicker3.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
    frameDoc.document.write('</head>');
    frameDoc.document.write('<body>');
    frameDoc.document.write(data);
    frameDoc.document.write('</body>');
    frameDoc.document.write('</html>');
    frameDoc.document.close();
    setTimeout(function() {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);


    return true;
}
</script>


<script type="text/javascript">
// $(document).on('click', '#collection_print', function() {


//     var printContents = document.getElementById('collection_report').innerHTML;
//     var originalContents = document.body.innerHTML;

//     document.body.innerHTML = printContents;

//     window.print();

//     document.body.innerHTML = originalContents;


// });
$(document).on('click', '#collection_print', function () {
    
    // Get the class value from the data attribute of the button
    let content = $('#printcontent').html();
    content = btoa(content); 
    // Make an AJAX request to the 'printwithheaderandfooter' method
    $.ajax({
        url: '<?php echo base_url('admin/weeklycalendarnew/printwithheaderandfooter'); ?>',
        method: 'post', 
        data: {
            data: content
        },
         beforeSend: function (xhr) {
        xhr.setRequestHeader('Content-Encoding', 'gzip');
    },
        
        success: function (data) {
            console.log(data)
           data =  data.replace(/['"]+/g, '')
            // Redirect to the generated PDF URL
            window.location.href = "<?php echo base_url() ?>" + data;
        },
        error: function (xhr, status, error) {
            console.error('xhr:', xhr);
            console.error('status:', status);
            console.error('error:', error);
        }
    });
});
</script>