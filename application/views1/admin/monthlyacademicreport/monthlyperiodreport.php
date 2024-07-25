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
table, th, td {
  /* border: 1px solid black; */
  border-collapse: collapse;
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
                    <form action="<?php echo site_url('admin/monthlyacademicreport/monthlyattendancereport')?>"
                        method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Month</label>
                                        <input name="date" id='month_id' type="text" class="form-control date-picker"
                                            value="<?php echo $date?>" />
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label><small
                                            class="req"> *</small>
                                        <select id="subject_id" name="subject_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
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
                <?php  if (!$all_subject){?>
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


                                <div class="box-header print">
                                    <div class="row text-center">
                                        <div class="col-sm-2" style="width:20%;">
                                        </div>
                                       
                                        <div class="col-sm-8">
                                            <h4> Monthly Attendence Report</h4>
                                        </div>
                                        <div class="col-sm-8">
                                            <h4> Month And Year: <?php  echo "$month_name $year" ?></h4>
                                        </div>
                                        <div class="col-sm-8">
                                            <h4> Programme And Batch: <?php  echo "$class_name $section_name" ?></h4>
                                        </div>
                                        <div class="col-sm-8">
                                            <h4> Subject: <?php  echo "$subject_name" ?></h4>
                                        </div>
                                    </div>
              

                                </div>

                                <br>
                                <br>




                                <table style="width:100%;height:90%"    border="1">

                                    <thead>
                                        <tr>
                                            <th style="padding: 5px; text-align:center" rowspan='3'>SL NO.</th>

                                            <th style="padding: 5px; text-align:center" rowspan='3'>Name Of Student</th>
                                            
                                            <th style="padding: 5px; text-align:center;font-size:19px" colspan='4'>
                                                <?php 
                                                // $total_hours = round($subjects_teachers[$subject_name]['total_hours']);
                                                // $alloted = $subjects_teachers[$subject_name]['alloted_hours_this_month'];
                                                
                                                // echo $subject_name .' ('. ceil($alloted).' HRS) ' 
                                                echo "Theory";
                                                ?>
                                            </th>
                                            <th style="padding: 5px; text-align:center;font-size:19px" colspan='5'>
                                                <?php 
                                                // $total_hours = round($subjects_teachers[$subject_name]['total_hours']);
                                                // $alloted = $subjects_teachers[$subject_name]['alloted_hours_this_month'];
                                                
                                                // echo $subject_name .' ('. ceil($alloted).' HRS) ' 
                                                echo "Practical";
                                                ?>
                                                
                                            </th>
                                            

                                        </tr>
                                        <tr>
                                            
                                            <th style="padding: 5px; text-align:center">Previous Month</th>

                                                    <th style="padding: 5px; text-align:center">Current Month</th>
                                                    <!-- <th style="padding: 5px; text-align:center;font-size:19px" colspan='6'> -->

                                                    <th style="padding: 5px; text-align:center">Total</th>

                                                    <th style="padding: 5px; text-align:center">Percentage %</th>
                                                    <th style="padding: 5px; text-align:center">Previous Month</th>

                                                    <th style="padding: 5px; text-align:center">Current Month</th>

                                                    <th style="padding: 5px; text-align:center">Total</th>

                                                    <th style="padding: 5px; text-align:center">Percentage %</th>

                                                <!-- <th style="padding: 5px; text-align:center">Final %</th> -->

                                                    <th style="padding: 5px; text-align:center">Signature</th>
                                        </tr>
                                        <tr>
                                              

                                                    <td style="padding: 5px; text-align:center"><i>Hours</i></td>
                                                    <!-- <th style="padding: 5px; text-align:center;font-size:19px" colspan='6'> -->

                                                    <td style="padding: 5px; text-align:center"><i>Hours</i</td>

                                                    <td style="padding: 5px; text-align:center"><i>Hours</i</td>
                                                    <td style="padding: 5px; text-align:center"><i>%</i></td>

                                                    <td style="padding: 5px; text-align:center"><i>Hours</i</td>

                                                    <td style="padding: 5px; text-align:center"><i>Hours</i</td>

                                                    <td style="padding: 5px; text-align:center"><i>Hours</i</td>

                                                <!-- <th style="padding: 5px; text-align:center">Final %</th> -->

                                                    <td style="padding: 5px; text-align:center"><i>%</i></td>
                                                    <td style="padding: 5px; text-align:center"></td>
                                        </tr>
                                        
                                    </thead>
                                    

                                    <tbody>
                                        <?php 
                                          $count = 1 ;

                                        foreach  ($students as $key => $value) {
                                            $totalSubject= get_total_subject_attendence($value['id'],$class_id,$section_id,$subject_id,$date,0);
                                            $totalPracticalSubject= get_total_subject_attendence($value['id'],$class_id,$section_id,$subject_id,$date,1);
                                            
                                            $total = get_monthly_student_attendance_total($value['id'],$class_id,$section_id,$subject_id,$date,0);
                                            
                                            $totalPractical = get_monthly_student_attendance_total($value['id'],$class_id,$section_id,$subject_id,$date,1);
                                            // var_dump($total);
                                            $monthly_cm = get_monthly_student_attendance_cm($value['id'],$class_id,$section_id,$subject_id,$date,0);
                                            $monthlyPractical_cm = get_monthly_student_attendance_cm($value['id'],$class_id,$section_id,$subject_id,$date,1);
                                            $monthly_pm = abs($total-$monthly_cm);
                                            $monthlyPractical_pm = abs($totalPractical-$monthlyPractical_cm);
                                            // $total=54;
                                            
                                            $percentage=0;
                                            $practicalPercentage=0;
                                            
                                            if($total!=0 || $total_hours!=0){
                                                // var_dump($total_hours);exit;
                                                $percentage = $total/ $totalSubject * 100;
                                           }

                                           if($totalPractical!=0 || $total_hours!=0){
                                            // var_dump($total_hours);exit;
                                            $practicalPercentage = $totalPractical/ $totalPracticalSubject * 100;
                                       }



                                           ?>
                                           
                                        <tr>
                                            
                                            <td style="padding: 5px; text-align:center"><?php echo $count?></td>
                                            <td style="padding: 5px; text-align:center">
                                                <?php echo $value['firstname'].' '.$value['lastname'] ?></td>
                                            <td style="padding: 5px; text-align:center"><?php echo($monthly_pm) ?></td>
                                            <td style="padding: 5px; text-align:center"><?php echo $monthly_cm ?></td>
                                            <td style="padding: 5px; text-align:center"><?php echo $total ?></td>
                                            <td style="padding: 5px; text-align:center">
                                                <?php echo number_format($percentage);?> </td>
                                            
                                                <td style="padding: 5px; text-align:center"><?php echo($monthlyPractical_pm) ?></td>
                                            <td style="padding: 5px; text-align:center"><?php echo $monthlyPractical_cm ?></td>

                                            <td style="padding: 5px; text-align:center"><?php echo $totalPractical ?></td>
                                                <td style="padding: 5px; text-align:center">
                                                <?php echo number_format($practicalPercentage);?> </td>
                                            <td style="padding: 5px; text-align:center">
                                                <?php ?></td>
                                            <!-- <td style="padding: 5px; text-align:center"> </td> -->
                                        </tr>
                                        <?php
                                    $count++;
                                    } ?>

                                    
                                    </tbody>

                                </table>
                                
                                </div>
                                <div class="box-header print with-border">
                                <div class="row">
                                    <!-- <style>
                                        .div_pdf_footer {
                                            position: relative;
                                        }
        
                                        .div_pdf_footer_img {
                                            position: absolute;
                                            bottom: 0;
                                            left: 0;
                                            right: 0;
                                        }
                                    </style> -->
                                    <br>  <br>      <br>  <br>

                        <table style="width:100%;">
                            <tr>
                                <td>Signature Class Coordinator</td>
                                <td>UG Coordinator</td>
                                <td style="text-align: right;">Signature Principal</td>
                            </tr>
                        </table>
<br/>
<br/> 
<br/> 
                           






                            </div>


                        </div>


                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php }?>
            <?php  if ($all_subject){?>
            <div class="box box-primary">
                <h3 class="titless pull-left"><i class="fa fa-money"></i> <?php echo 'Monthly Academic Report'; ?>

                </h3>

                <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search" id="collection_print"
                    value="" class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                    <?php echo $this->lang->line('print'); ?></button>


                <div class="box-body" id="collection_report">

                    <div class="row">

                        <div class="col-md-12 ">


                            <div class="box-header print  with-border">
                                <div class="row text-center">
                                    <div class="col-sm-2" style="width:20%;">

                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <h3><?php echo strtoupper($this->setting_model->getCurrentSchoolName()); ?> -->
                                        </h3>
                                        <h3>Monthly Attendence Report</h3>


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


                        <?php 
                        $colcount =  count($subjects_list)*4+2;
                        // var_dump($subjects_list);
                        
                        ?>

                            <table style="width:100%;" border="1">

                                <thead>
                                    <tr>
                                        <th style="text-align:center" rowspan='3'>SL NO.</th>

                                        <th style="text-align:center" rowspan='3'>Name Of Student</th>

                                        <th style="text-align:center;font-size:19px" colspan='<?php echo $colcount ?>'>
                                            <?php echo $month_name; ?>
                                        </th>

                                    </tr>
                                    <tr>
                                        
                                    <?php foreach ($subjects_teachers as $key => $value) {
                                                                                      
                                     ?>
                                        <th style="text-align:center" colspan='4'><?php echo $key .' ( '.$value['alloted_hours_this_month'] .'  HRS )'?></th>
                                        <?php }?>
                                         
                                        <th style="text-align:center" rowspan='2'>Exc</th>

                                        <th style="text-align:center" rowspan='2'>Signature</th>
                                    </tr>
                                    <tr>

                                    <?php foreach ($subjects_teachers as $key => $value) {
                                        
                                        ?>

                                        <th style="text-align:center">PM</th>

                                        <th style="text-align:center">CM</th>

                                        <th style="text-align:center">T</th>

                                        <th style="text-align:center">%</th>


                                        <?php }?>
                                         





                                    </tr>
                                </thead>

                                <tbody>

                                    
                                <?php $c=1; foreach ($students as $studentskey => $studentsvalue) {
                                    
                                ?>
                                    <tr>
                                        <!-- Nursing Foundation II ( 4 HRS ) -->
        
                                        <td style="text-align:center"><?php echo $c; $c++;?></td>
                                        <td style="text-align:center"><?php echo $studentsvalue['firstname'].' '.$studentsvalue['lastname'] ?></td>
                                        <?php  foreach ($subjects_teachers as $key => $value) {
                                               $total = get_monthly_student_attendance_total($studentsvalue['id'],$class_id,$section_id,$value['id'],$date);
                                            //    var_dump($total);

                                               $monthly_cm = get_monthly_student_attendance_cm($studentsvalue['id'],$class_id,$section_id,$value['id'],$date);
                                            //    var_dump($monthly_cm);exit;
                                               $monthly_pm = $total-$monthly_cm;
                                                    //  var_dump($monthly_pm);exit;(169)
                                               $count = 0 ;
                                               $percentage = 0;
                                            //    var_dump($percentage);exit;
                                               $total_hours= ['total_hours'];
                                            //    echo $total;
                                            //    echo '<br/>';
                                            //    echo $total_hours;
                                            //    echo '<br/>';
                                            // var_dump($total_hours);exit;
                                               if($total_hours){
                                                   $percentage = ($monthly_pm/$total)*100;                                          
                                                }

                                                
           
                                        ?>
                                        <td style="text-align:center"><?php echo($monthly_pm) ?></td>
                                        <td style="text-align:center"><?php echo($monthly_cm) ?></td>
                                        <td style="text-align:center"><?php echo $total ?></td>
                                        <td style="text-align:center"><?php echo round($percentage);?></td>
                                        <?php }?>
                                          

                                        <td style="text-align:center"></td>
                                        <td style="text-align:center"></td>

                                    </tr>
                            <?php }?>
                                </tbody>


                            </table>

                            <div class="row print" style="display: flex;justify-content: space-around;">
                                <div class="col-6">
                                    <h5>Signature Class Co Ordinator</h5>
                                    <br>
                                </div>
                                <div class="col-6">
                                    <h5>Signature Principal</h5>
                                </div>
                            </div>






                        </div>


                    </div>


                </div>
                <div class="box-footer">
                    <div class="mailbox-controls">
                        <div class="pull-right">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php }?>


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
    var subject_id = '<?php echo set_value('subject_id') ?>';

    getSectionByClass(class_id, section_id);
    getSubjectByClassandSection(class_id, section_id, subject_id);
    $(document).on('change', '#section_id', function(e) {
        $('#subject_id').html("");
        var section_id = $(this).val();
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/getSubjctByClassandSectionnew",
            data: {
                'class_id': class_id,
                'section_id': section_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.id + ">" + obj.name + " (" +
                        obj.type + ")" + "</option>";
                });

                $('#subject_id').append(div_data);
            }
        });
    });
});

function getSubjectByClassandSection(class_id_post, section_id_post, sub_id_post) {

    if (class_id_post != "" && section_id_post != "" && sub_id_post != "") {
        $('#subject_id').html("");
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        //console.log(div_data);
        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/getSubjctByClassandSectionnew",
            data: {
                'class_id': class_id,
                'section_id': section_id_post
            },
            dataType: "json",
            success: function(data) {

                $.each(data, function(i, obj) {

                    var sel = "";
                    if (sub_id_post == obj.id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + " (" + obj
                        .type + ")" + "</option>";

                });

                $('#subject_id').append(div_data);
            }
        });
    }
}

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