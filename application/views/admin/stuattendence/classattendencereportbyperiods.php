<style type="text/css">
     @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }

        body {
            padding: 0;
            margin: 0;
        }
        .np-color {
            color: black;
        }

        .a-color {
            color: red;
        }

        .p-color {
            color: green;
        }
     }

    .np-color {
        color: black;
    }

    .a-color {
        color: red;
    }

    .p-color {
        color: green;
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/stuattendence/classattendencereportbyperiod') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                            <?php //var_dump(validation_errors()); ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>


                              
                                 
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input id="date" name="date" placeholder="" type="text" class="form-control date" autocomplete="off" value="<?php echo date('m-Y') ?>"/>
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                        <?php /*?><select  id="year" name="year" class="form-control" >

                                            <?php
                                            // $yearlist  = array('2018' => '2018' );
                                            foreach ($yearlist as $y_key => $year) {
                                                ?>
                                                <option value="<?php echo $year["year"] ?>" <?php
                                                if ($year_selected == $year["year"]) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $year["year"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                        </select><?php */?>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label>
                                        <select  id="subject_id" name="subject_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('subject'); ?></span>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
                <?php
                if ($this->module_lib->hasActive('student_attendance')) {

                    if (isset($result)) {
                        ?>
                           <!-- <button class="btn btn-info fa fa-print pull-right" id="print_btn" type="button">Print</button> -->
                           <button type="button" style="margin-right: 10px;margin-top: 10px;" id="convert_to_excel" class="btn btn-success btn-sm fa fa-sheet-plastic pull-right">
                           Excel</button>

                        <div class="box box-info" id="attendencelist">
                            <div class="box-header with-border" >
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></h3>
                                        
                                        
                                    </div>
                                    <div class="pull-right">
                                    
                                    
                </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="lateday">
                                           
                                        </div>

                                    </div>
                                </div></div>
                            <div class="box-body table-responsive">


                                <?php

// var_dump($students);exit;
                                if (!empty($students)) {
                                    ?>
                                    <div class="mailbox-controls">
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                    <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></div>
                                    <!-- <button class="btn btn-info fa fa-print pull-right" id="print_btn" type="button">Print</button> -->
                                    <button type="button" style="margin-right: 10px;margin-top: 10px;" id="convert_to_excel" class="btn btn-success btn-sm fa fa-sheet-plastic pull-right">
                           Excel</button>
                                    <div id="collection_report">
                                    <table class="table table-striped table-bordered table-hover  xyz">
                                        <thead>
                                            <tr>
                                                
                                                <th>
                                                <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                        title=""><a href="#" style="color:#333 ;font-size:12px">
                                                    <?php echo $this->lang->line('student'); ?>
                                                </th>
                                                <th>
                                                P
                                                </th>
                                                <th>
                                                A
                                                </th>
                                                <?php
                                            foreach ($dates as $date) {
                                                ?>
                                                &nbsp;&nbsp;
                                                <b>
                                                    <th>
                                                    <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                        title=""><a href="#" style="color:#333 ;font-size:12px">
                                                    <?php
                                                   echo date('d',strtotime($date));
                                                    ?>
                                                    </th>
                                                </b>
                                                <?php
                                            }
                                            ?>
                                                
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              
                                           // var_dump($student_array);
                                            if (empty($students)) {
                                                ?>
                                                <tr>
                                                <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                        title=""><a href="#" style="color:#333 ;font-size:10px">
                                                    <td colspan="32" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                </tr>
                                                <?php
                                            } else {
                                                $row_count = 1;
                                                
                                                //echo "<pre>";
  //var_dump($student_array);


$i=0;
                                       foreach($students as $index=> $student){
$present_count =0;
         $absent_count=0; 
                                                    foreach ($dates as $key=> $date) { 
                                                              $present_count = $present_count+$student['present'][$key];
                                                    $absent_count = $absent_count+$student['absent'][$key];
                                                           } 
                                                   
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        
                                                        <th>
                                                        <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                        title=""><a href="#" style="color:#333 ;font-size:10px">
                                                            <?php echo $student['firstname']." ". $student['lastname']?>
                                                        </th>
                                                        <th>
                                                        <?php echo $present_count ?>
                                                    </th>
                                                    <th>
                                                            <?php echo $absent_count ?>
                                                        
                                                        </th>
                                                        
                                                           <?php
                                                           $j=0;
                                                             foreach ($dates as $key=> $date) { ?>
                                                             <td><?php echo $student['present'][$key]?></td>
                                                             
                                                          <?php } 
                                                         
                                                          }
                                                            ?>
                                                        
                                                   
                                                    </tr>
                                                    <?php
                                                }

												}
                                            
                                            ?>
                                        </tbody>
                                            </div>
                                    </table>
                                    <?php
                                } else {
                                    ?>
                                    <div class="alert alert-info">
                                    <?php echo $this->lang->line('no_attendance_prepare'); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php  
                    } 
                
                ?>
                </div>
                </div>
                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
					 var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
                     $('.date').datepicker({
    format: "mm-yyyy",
    autoclose: true,
    minViewMode: "months",
    startView: "months"
});
					
                    $('.detail_popover').popover({
                        placement: 'right',
                        title: '',
                        trigger: 'hover',
                        container: 'body',
                        html: true,
                        content: function () {
                            return $(this).closest('th').find('.fee_detail_popover').html();
                        }
                    });
					var sub_id_post = '<?php echo $subject_id; ?>';
                    var section_id_post = '<?php echo $section_id; ?>';
                    var class_id_post = '<?php echo $class_id; ?>';
                    populateSection(section_id_post, class_id_post);
					getSubjectByClassandSection(class_id_post, section_id_post, sub_id_post);
                    function populateSection(section_id_post, class_id_post) {
                        $('#section_id').html("");
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id_post},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    var select = "";
                                    if (section_id_post == obj.section_id) {
                                        var select = "selected=selected";
                                    }
                                    div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    }
					
	function getSubjectByClassandSection(class_id_post, section_id_post, sub_id_post) {
        console.log("rrrr1");
        if (class_id_post != "" && section_id_post != "" && sub_id_post != "") {
            $('#subject_id').html("");
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
			 //console.log(div_data);
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id_post},
                dataType: "json",
                success: function (data) {
				
                    $.each(data, function (i, obj)
                    {
						
                        var sel = "";
                        if (sub_id_post == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + " (" + obj.type + ")" + "</option>";
						
                    });

                    $('#subject_id').append(div_data);
                }
            });
        }
    }
					
					
					
					
					
                    $(document).on('change', '#class_id', function (e) {
                        $('#section_id').html("");
                        var class_id = $(this).val();
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    });

                      
            $(document).on('change', '#section_id', function (e) {
            $('#subject_id').html("");
            var section_id = $('#section_id').val();
            var types = "Theory";
            var class_id = $('#class_id').val();
            
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id,'types':types},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                     console.log(obj);
                    

                        div_data += "<option value=" + obj.id + ">" + obj.name  + "</option>";

                    });

                    $('#subject_id').append(div_data);
                }
            });
        });
		
			// $(document).on('change', '#section_id', function (e) {
   //          $('#subject_id').html("");
   //          var section_id = $(this).val();
   //          var class_id = $('#class_id').val();
   //          var base_url = '<?php echo base_url() ?>';
   //          var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
   //          $.ajax({
   //              type: "POST",
   //              url: base_url + "admin/teacher/getSubjctByClassandSectionnew",
   //              data: {'class_id': class_id, 'section_id': section_id},
   //              dataType: "json",
   //              success: function (data) {
   //                  $.each(data, function (i, obj)
   //                  {
   //                      div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.type + ")" + "</option>";
   //                  });

   //                  $('#subject_id').append(div_data);
   //              }
   //          });
   //      });
   
					
                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
                    $('#date').datepicker({
                        format: date_format,
                        autoclose: true
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
                $(document).on('click', '#print_btn', function () {
        var printContents = document.getElementById('collection_report').innerHTML;
        var originalContents = document.body.innerHTML;

        // Add a print-only style to the document
        var style = document.createElement('style');
        style.innerHTML = '@media print {.collection_report  { padding: 0; margin: 0; } }';
        document.head.appendChild(style);

        document.body.innerHTML = printContents;

        window.print();

        // Remove the print-only style after printing
        document.head.removeChild(style);

        document.body.innerHTML = originalContents;
    });
    $(document).on('click', '#convert_to_excel', function() {


TableToExcel.convert(document.getElementById("collection_report"));



});

            </script>