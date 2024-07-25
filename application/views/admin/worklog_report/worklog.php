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
th, td {
    white-space: normal;
    overflow: hidden; /* Hide overflowing content */
    text-overflow: ellipsis; /*  /* Allow text to wrap */
    font-size: 15px;
    }

.tabledesign td {
        width: 125px;
        padding: 2px;
}
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
            <small><?php echo $this->lang->line('student_fees1'); ?></small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title; ?></h3>

                    </div>

                    <form action="" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>

                            <?php if($usertype=='Super Admin'){ ?>
                            <div class="col-md-4">

                                <label for="exampleInputEmail1"><?php echo $this->lang->line('teacher'); ?></label>
                                <select autofocus="" id="teacher_id" name="teacher_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?>
                                    </option>
                                    <?php
                                    foreach ($teacherlist as $teacher) {
                                        ?>
                                    <option value="<?php echo $teacher['id'] ?>"
                                        <?php if (set_value('teacher_id') == $teacher['id']) echo "selected=selected"; ?>>
                                        <?php echo $teacher['name'] ?></option>
                                    <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('teacher_id'); ?></span>

                            </div>
                            <?php }else{?>
                                <input type="hidden" name="teacher_id" value=<?php echo $userid ?>>
                            <?php }?>
                            <div class="col-md-<?php if($usertype=='Super Admin'){ echo 4; }else{echo 6;}?>">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
                                <div class="input-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('datefrom'); ?></label>
                                    <input autocomplete='false' name="datefrom" type="text" class="form-control date"
                                        value="<?php echo !$is_search?date($this->customlib->getSchoolDateFormat()):$from; ?>" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </div>
                                </div>

                                <span class="text-danger"><?php echo form_error('datefrom'); ?></span>


                            </div>


                            <div class="col-md-<?php if($usertype=='Super Admin'){ echo 4; }else{echo 6;}?>">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?></label>
                                <div class="input-group">
                                    <input autocomplete='false' name="dateto" type="text" class="form-control date"
                                        value="<?php echo !$is_search?date($this->customlib->getSchoolDateFormat()):$to; ?>" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </div>
                                </div>
                                <span class="text-danger"><?php echo form_error('dateto'); ?></span>


                            </div>

                        </div>
                        <div class="box-footer">

                            <button type="submit"
                                class="btn btn-info pull-right"><?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    

    <?php  if ($is_search){?>
                <div class="box box-primary">
                    <h3 class="titless pull-left"><i class="fa fa-money"></i> <?php echo 'Work Log Report'; ?>

                    </h3>

                    <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search"
                        id="collection_print" value=""
                        class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        <?php echo $this->lang->line('print'); ?></button>


                    <div class="box-body" id="printcontent">

                        <div class="row">

                            <div class="col-md-12 ">


                                <div class="box-header print with-border">
                                    <div class="row">
                                        <div class="col-sm-2" style="width:20%;">

                                        </div>
                                        <div class="col-sm-8">
                                            <!-- <h3><?php echo strtoupper($this->setting_model->getCurrentSchoolName()); ?>
                                            </h3> -->
                                            <h3><center> Work Log Report</center></h3>
                                            <p style="margin: 0;padding-top:20px"><span>Date: </span><b> <?php echo "$from $to" ?></b></p>


                                        </div>
                                    </div>

                                </div>


                                <table  class="tabledesign" style="width:100%;" border="1">
                               
                                    <thead>
                                        <tr>
                                            <th style="padding: 5px;">Date</th>

                                            <th style="padding: 5px;"></th>
                                         

                                            <!-- <th style="padding: 5px;">8:00 AM to 9:00 AM</th>
                                            <th style="padding: 5px;">9:00 AM to 10:00 AM</th>
                                            <th style="padding: 5px;">10:00 AM to 10:45 AM</th>
                                            <th style="padding: 5px;">11:15 AM to 12:00 PM</th>
                                            <th style="padding: 5px;">12:00 PM to 1:00 PM</th>
                                            <th style="padding: 5px;">2:00 PM to 3:00 PM</th>
                                            <th style="padding: 5px;">3:00 PM to 4:00 PM</th>
                                            <th style="padding: 5px;">4:00 PM to 5:00 PM</th> -->
                                            <th style="padding: 5px;">1st Period</th>
                                            <th style="padding: 5px;">2nd Period</th>
                                            <th style="padding: 5px;">3rd Period</th>
                                            <th style="padding: 5px;">4th Period</th>
                                            <th style="padding: 5px;">5th Period</th>
                                            <th style="padding: 5px;">6th Period</th>
                                            <th style="padding: 5px;">7th Period</th>
                                            <th style="padding: 5px;">8th Period</th>
 

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // print_r($worklog);
                                        // $dates = array_column($worklog, 'date');

                                        // $unique_dates = array_unique($dates);


                                        $grouped_items = array();
                                        foreach ($worklog as $item) {
                 
                                        $date = $item->date;
                                        if (!isset($grouped_items[$date])) {
                                            $grouped_items[$date] = array();
                                        }
                                        $grouped_items[$date][] = $item;
                                        }




                                        foreach($grouped_items as $date=>$datevalue){
                                        // var_dump($datevalue);
                                        
                                        ?>
                      <tr>
                                            <td style="text-align:center"><?php echo $date;?></td>
                                            <td style="text-align:center">
                                                Batch
                                                <br>
                                                Sub
                                                <br>
                                                Topic
                                            </td>
                                            <td style="text-align:center">

                                            <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='eight_to_nine'){
                                                        if(!$value->activity){

                                                            echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{

                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='nine_to_ten'){
                                                         if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='ten_to_eleven'){

                                                        if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='eleven_to_twelve'){

                                                         if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='twelve_to_one'){

                                                         if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='two_to_three'){

                                                         if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='three_to_four'){

                                                        if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td style="text-align:center">

                                             <?php
                                                foreach ($datevalue as $key => $value) {
                                                    if($value->period=='four_to_five'){

                                                         if(!$value->activity){

                                                             echo (getclassname($value->class_id)) . " : " . (getsectionname($value->section_id));
                                                            echo '<br/>';
                                                            echo getsubjectname($value->subject_id);
                                                            echo '<br/>';
                                                            echo $value->topic; 
                                                        }else{
                                                            
                                                        }
                                                        echo $value->activity;
                                                    }
                                                }
                                            ?>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>

                                         

                                    </tbody>

                                </table>







                            
                            </table>
                            <br>
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
                        <br>  <br>  <br>  <br>
                        <table style="width:100%;">
                            <tr>
                                <td>Signature Class Coordinator</td>
                                <td>UG Coordinator</td>
                                <td style="text-align: right;">Signature Principal</td>
                            </tr>
                        </table>
                    </div>          

                       
                        <div class="box-header print with-border">
                                <div class="row">
                                    <style>
                                        /* .div_pdf_footer {
                                            position: relative;
                                        }

                                        .div_pdf_footer_img {
                                            position: absolute;
                                            bottom: 0;
                                            left: 0;
                                            right: 0;
                                        } */
                                    </style>
                                    <div class="col-sm-8 div_pdf_footer">


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

</div>

<script type="text/javascript">
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
var date_format =
    '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
$('body').on('focus', ".date", function() {
    $(this).datepicker({
        format: date_format,
        autoclose: true
    });
});


function Popup(data) {

    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({
        "position": "absolute",
        "top": "-1000000px"
    });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ?
        frame1[0]
        .contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html>');
    frameDoc.document.write('<head>');
    frameDoc.document.write('<title></title>');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/bootstrap/css/bootstrap.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/dist/css/font-awesome.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/dist/css/ionicons.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/dist/css/AdminLTE.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/dist/css/skins/_all-skins.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/iCheck/flat/blue.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/morris/morris.css">');


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