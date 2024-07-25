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
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            </i> <?php echo $this->lang->line('staff_report'); ?> <small> <?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section> -->
    <section class="content">
        <div class="row">   
            <div class="col-md-12">
                
                    <form id='form1' action="<?php echo site_url('admin/staffevaluation/clinicalReportApprove') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                            <?php //var_dump(validation_errors()); ?>
                                
                                
                                
                            </div>
                        </div>
                       
                    </form>
            
                <?php
                // if ($this->module_lib->hasActive('staff_report')) {

                    if (isset($report)) {
                        ?>
                        <div class="box box-info" id="attendencelist">
                            <div class="box-header with-border" >
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h3 class="box-title"><i class="fa fa-users"></i> <?php echo 'Clinical Report Approval'; ?> </h3>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        

                                    </div>
                                </div></div>
                            <div class="box-body table-responsive">


                                <?php 
                                if (!empty($report)) {
                                    ?>
                                    <div class="mailbox-controls">
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                    <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></div>
                                    <table class="table table-striped table-bordered table-hover example xyz">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Course
                                                </th>
                                                <th>
                                                    Section
                                                </th>
                                                <th>
                                                    Subject
                                                </th>
                                                
                                                
                                                <th>
                                                    Date
                                                </th>
                                                <th>
                                                    session
                                                </th>
                                                <!-- <th>
                                                    Hours 
                                                </th> -->
                                                <!-- <th>
                                                    HOD 
                                                </th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($report)) {
                                                ?>
                                                
                                                <?php
                                            } else {
                                                $total = 0;
                                                $i = 0;
                                                //echo "<pre>";
  //var_dump($student_array);
                                                foreach ($report as $val) {
													// $total=$total+$val['total_hour'];
													
                                                    //echo $i;
										// if($student_value['date'] >= $from && $student_value['date']<= $to){?>
                                                    <tr><!-- 
                                                        <th class="tdclsname">
                                                            <span data-toggle="popover" class="detail_popover" data-original-title="" title=""><a href="#" style="color:#333"><?php echo $student_value['teacher_name']?></a></span>
                                                           
                                                        </th>
                                                        <th class="tdclsname">
                                                            <span data-toggle="popover" class="detail_popover" data-original-title="" title=""><a href="#" style="color:#333"><?php echo $student_value['total_hour'] ?></a></span>
                                                            
                                                        </th>  -->
                                                        <td><?php echo $val['name']?></td>
                                                        <td><?php echo $val['class']?></td>

                                                     <td><?php echo $val['section']?></td> 
                                                      <td><?php echo $val['sname']?></td> 
                                                       
                                                      
                                                      <td><?php echo $val['date']?></td>
                                                       <td><?php echo $val['session']?></td>
                                                      <!--  <td><?php echo $val['total_hour']?></td>  -->
                                                   <!-- <input type="hidden" name="hid" value="<?php echo $val['evid']; ?>"/> -->
                                                   <?php
                                    if ($this->rbac->hasPrivilege('staff_reportapprove', 'can_edit')) {
                                        ?> 
                                                   <td> <a  href="<?php echo base_url(); ?>admin/staffevaluation/approvenew/<?php echo $val['sid'] ?>" class="btn btn-success" data-original-title="">
              <?php echo 'Approve'; ?>
                                                    </a>
                                            </td>
                                            <?php } ?>



                                                        <?php }
                                                        ?>


                                                        <?php
                                                        $i++;
                                                        ?>


                                                    </tr>
                                                    <?php
													}
													?>
                                                    
                                                    <!-- <tr><td colspan="9" style="text-align:right;font-size:15px;font-weight:bold;">Total Hours </td><td style="font-size:15px;font-weight:bold;"><?php echo $total; ?></td></tr> -->
												<?php	
												}
                                            
                                            ?>
                                        </tbody>
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
                    
                
                ?>
                </div>
                </div>
                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
					 var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
$('.date').datepicker({
                        format: date_format,
                        autoclose: true 
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
                    var staff_id_post = '<?php echo $staff_id; ?>';
                    populateSection(section_id_post, class_id_post);
					getSubjectByClassandSection(class_id_post, section_id_post, sub_id_post);
                    getSubjectByStaffClassandSection(class_id_post, section_id_post, sub_id_post,staff_id_post);
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

function getSubjectByStaffClassandSection(class_id_post, section_id_post, sub_id_post,staff_id_post) {
        console.log("rrrr1");
        if (class_id_post != "" && section_id_post != "" && sub_id_post != "" && staff_id_post != "") {
            $('#subject_id').html("");
            var class_id = $('#class_id').val();
            var subject_id = $('#subject_id').val();
            var staff_id = $('#staff_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
             //console.log(div_data);
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjectByStaffClassandSection",
                data: {'class_id': class_id,'subject_id': subject_id, 'section_id': section_id_post},
                dataType: "json",
                success: function (data) {
                
                    $.each(data, function (i, obj)
                    {
                        
                        var sel = "";
                        if (sub_id_post == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.teacher_name + " (" + obj.type + ")" + "</option>";
                        
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
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSectionnew",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subject_id').append(div_data);
                }
            });
        });
          $(document).on('change', '#subject_id', function (e) {
            $('#staff_id').html("");
            var subject_id = $(this).val();
            var section_id = $('#section_id').val();
            var class_id = $('#class_id').val();
            var staff_id = $('#staff_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/get_subjectteachersnew",
                data: {'class_id': class_id,'subject_id': subject_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.name + "</option>";
                    });

                    $('#staff_id').append(div_data);
                }
            });
        });
   
					
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
            </script>