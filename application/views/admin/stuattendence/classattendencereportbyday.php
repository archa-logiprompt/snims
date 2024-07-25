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
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i>
            <?php echo $this->lang->line('attendance'); ?> <small>
                <?php echo $this->lang->line('by_date1'); ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>
                            <?php echo $this->lang->line('select_criteria'); ?>
                        </h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/stuattendence/classattendencereportbyday') ?>"
                        method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <?php //var_dump(validation_errors()); ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('class'); ?>
                                        </label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
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
                                        <span class="text-danger">
                                            <?php echo form_error('class_id'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('section'); ?>
                                        </label><small class="req"> *</small>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value="">
                                                <?php echo $this->lang->line('select'); ?>
                                            </option>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo form_error('section_id'); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('from'); ?>
                                        </label><small class="req"> *</small>
                                        <?php /*?><select  id="month" name="month" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($monthlist as $m_key => $month) {
?>
<option value="<?php echo $m_key ?>" <?php
if ($month_selected == $m_key) {
echo "selected =selected";
}
?>><?php echo $month; ?></option>
<?php
$count++;
}
?>
</select><?php */?>

                                        <input id="date" name="from" placeholder="" type="text"
                                            class="form-control date" autocomplete="off"
                                            value="<?php echo set_value('from'); ?>" />
                                        <span class="text-danger">
                                            <?php echo form_error('from'); ?>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('to'); ?>
                                        </label><small class="req"> *</small>
                                        <input id="date" name="to" placeholder="" type="text" class="form-control date"
                                            autocomplete="off" value="<?php echo set_value('to'); ?>" />
                                        <span class="text-danger">
                                            <?php echo form_error('to'); ?>
                                        </span>
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
                                <?php /*?><!--<div class="col-md-2">
<div class="form-group">
<label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label>
<select  id="subject_id" name="subject_id" class="form-control" >
<option value=""><?php echo $this->lang->line('select'); ?></option>
</select>
<span class="text-danger"><?php echo form_error('subject'); ?></span>
</div>
</div>--><?php */?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="search" value="search"
                                class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i>
                                <?php echo $this->lang->line('search'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                if ($this->module_lib->hasActive('student_attendance')) {

                    if ($multiple == false) {
                        ?>
                        <div class="box box-info" id="attendencelist">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h3 class="box-title"><i class="fa fa-users"></i>
                                            <?php echo $this->lang->line('student'); ?>
                                            <?php echo $this->lang->line('attendance'); ?>
                                            <?php echo $this->lang->line('report'); ?>
                                        </h3>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="lateday">
                                            <?php
                                            foreach ($attendencetypeslist as $key_type => $value_type) {
                                                ?>
                                                &nbsp;&nbsp;
                                                <b>
                                                    <?php
                                                    $att_type = str_replace(" ", "_", strtolower($value_type['type']));
                                                    if (strip_tags($value_type["key_value"]) != "E") {

                                                        echo $this->lang->line($att_type) . ": " . $value_type['key_value'] . "";
                                                    }
                                                    ?>
                                                </b>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="box-body table-responsive">


                                <?php
                                if ($multiple == false) {
                                    ?>
                                    <div class="mailbox-controls">
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                    <div class="download_label">
                                        <?php echo $this->lang->line('student'); ?>
                                        <?php echo $this->lang->line('attendance'); ?>
                                        <?php echo $this->lang->line('report'); ?>
                                    </div>
                                    <button class="btn btn-info fa fa-print pull-right" id="print_btn" type="button">Print</button>
                                    <div id=collection_report>
                                        <h3 style="text-align:center">Student Attendance Report </h3>
                                        <h5 style="text-align:center">of
                                            <?php echo getclassname($class_id) . " " ?>
                                            <?php echo getsectionname($section_id) ?> for the month of
                                            <?php echo date('F', mktime(0, 0, 0, $month_selected, 1)) ?>
                                        </h5>
                                        <table class="table table-striped table-bordered table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $this->lang->line('student'); ?> 
                                                    </th>
                                                    <!--<th><br/><span data-toggle="tooltip" title="<?php echo "Gross Present Percentage(%)"; ?>">%</span></th>-->

                                                    <?php /*
                                                                                                                                                                                                                                             foreach ($attendencetypeslist as $key => $value) {
                                                                                                                                                                                                                                              //   echo "<pre>";
                                                                                                                                                                                                                                                // print_r($value);
                                                                                                                                                                                                                                                 if (strip_tags($value["key_value"]) != "E") {
                                                                                                                                                                                                                                                     ?>
                                                                                                                                                                                                                                                     <th colspan="" ><br/><span data-toggle="tooltip" title="<?php echo "Total " . $value["type"]; ?>"><?php echo strip_tags($value["key_value"]); ?>

                                                                                                                                                                                                                                                         </span></th>

                                                                                                                                                                                                                                                 <?php  }
                                                                                                                                                                                                                                             }*/
                                                    ?>
                                                    <?php //var_dump(($attendence_array));
                                                                foreach ($attendence_array as $at_key => $at_value) {

                                                                    if (date('D', $this->customlib->dateyyyymmddTodateformat($at_value)) == "Sun") {
                                                                        if ($at_value >= $from && $at_value <= $to) {
                                                                            ?>
                                                                <th class="tdcls text text-center bg-danger" colspan="">
                                                                    <?php
                                                                    echo date('d', $this->customlib->dateyyyymmddTodateformat($at_value)) . "<br/>"

                                                                        ?>
                                                                </th>
                                                                <?php
                                                                        }
                                                                    } else {
                                                                        if ($at_value >= $from && $at_value <= $to) {
                                                                            ?>
                                                                <th class="tdcls text text-center" colspan="">
                                                                    <?php
                                                                    echo date('d', $this->customlib->dateyyyymmddTodateformat($at_value)) . "<br/>"
                                                                        ?>
                                                                </th>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($student_array)) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="32" class="text-danger text-center">
                                                            <?php echo $this->lang->line('no_record_found'); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    $row_count = 1;
                                                    $i = 0;
                                                    //echo "<pre>";
                                                    //var_dump($student_array);
                                                    foreach ($student_array as $student_key => $student_value) {


                                                        // echo $i;
                                                        //var_dump($monthAttendance[$i][$student_value['student_session_id']]);
                                                        //if($student_value['date'] >= $from && $student_value['date']<= $to){
                                                        ?>
                                                        <tr>
                                                            <th class="tdclsname">
                                                                <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                    title="">
                                                                        <?php echo $student_value['firstname'] . " " . $student_value['lastname']; ?>
                                                                   </span>
                                                                <div class="fee_detail_popover" style="display: none">
                                                                    <?php echo "Admission No: " . $student_value['admission_no']; ?>
                                                                </div>
                                                            </th>
                                                            <!--<th>-->
                                                            <?php /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                             // var_dump($monthAttendance[$i][$student_value['student_session_id']]);exit;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $total_present = ($monthAttendance[$i][$student_value['student_session_id']]['present'] + $monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse'] + $monthAttendance[$i][$student_value['student_session_id']]['half_day'] + $monthAttendance[$i][$student_value['student_session_id']]['late']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $month_number = date("m", strtotime($month_selected));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, date("Y"));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $total_school_days = $monthAttendance[$i][$student_value['student_session_id']]['present'] + $monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse'] + $monthAttendance[$i][$student_value['student_session_id']]['late'] + $monthAttendance[$i][$student_value['student_session_id']]['half_day'] + $monthAttendance[$i][$student_value['student_session_id']]['absent'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 if ($total_school_days == 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $percentage = -1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $print_percentage = "-";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } else {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $percentage = ($total_present / $total_school_days) * 100;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $print_percentage = round($percentage, 0);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 if (($percentage < 75) && ($percentage >= 0)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $label = "class='label label-danger'";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } else if ($percentage > 75) {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $label = "class='label label-success'";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } else {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $label = "class='label label-default'";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 echo "<label $label>" . $print_percentage . "</label>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 */?>
                                                            <!--</th>-->

                                                            <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['present']); ?></th>-->
                                                            <!--th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse']); ?></th-->
                                                            <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['late'] + $monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse']); ?></th>-->
                                                            <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['absent']); ?></th>-->
                                                            <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['holiday']); ?></th>-->
                                                            <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['half_day']); ?></th>-->


                                                            <?php
                                                            // var_dump($attendence_array);exit;
                                                            foreach ($attendence_array as $at_key => $at_value) {

                                                                if ($at_value >= $from && $at_value <= $to) { ?>
                                                                    <th class="tdcls text text-center">

                                                                        <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                            title="">
                                                                                <?php
                                                                                if (strip_tags($resultlist[$at_value][$student_value['student_session_id']]['key']) == "E") {

                                                                                    $attendence_key = "L";
                                                                                    $remark = "Late With Excuse";
                                                                                } else {

                                                                                    $attendence_key = $resultlist[$at_value][$student_value['student_session_id']]['key'];

                                                                                    //var_dump($resultlist[$at_value][$student_value['student_session_id']]['date']);																		
                                                    
                                                                                    $remark = $resultlist[$at_value][$student_value['student_session_id']]['remark'];
                                                                                }
                                                                                if ($resultlist[$at_value][$student_value['student_session_id']]['date'] == $at_value) {
                                                                                    print_r($attendence_key);
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        <div class="fee_detail_popover" style="display: none">
                                                                            <?php echo $remark; ?>
                                                                        </div>

                                                                    </th>



                                                                <?php }



                                                            }
                                                            ?>


                                                            <?php
                                                            $i++;
                                                            ?>


                                                        </tr>
                                                        <?php
                                                        //}
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
                    } else {
                        ?>
                        <div class="box box-info" id="attendencelist">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h3 class="box-title"><i class="fa fa-users"></i>
                                            <?php echo $this->lang->line('student'); ?>
                                            <?php echo $this->lang->line('attendance'); ?>
                                            <?php echo $this->lang->line('report'); ?>
                                        </h3>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="lateday">
                                            <?php
                                           


                                                foreach ($attendencetypeslist as $key_type => $value_type) {
                                                    ?>
                                                    &nbsp;&nbsp;
                                                    <b>
                                                        <?php
                                                        $att_type = str_replace(" ", "_", strtolower($value_type['type']));
                                                        if (strip_tags($value_type["key_value"]) != "E") {

                                                            echo $this->lang->line($att_type) . ": " . $value_type['key_value'] . "";
                                                        }
                                                        ?>
                                                    </b>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                    <button class="btn btn-info fa fa-print pull-right" id="print_btn" type="button">Print</button>

                            </div>

                            <div id=collection_report >
                        <?php

                        foreach ($monthAttendance as $j => $month) {  
                            ?>
                            <div class="box-body table-responsive" >


                                    <?php
                                    if ($multiple == true) {
                                        ?>
                                        <div class="mailbox-controls">
                                            <div class="pull-right">
                                            </div>
                                        </div>
                                        <div class="download_label">
                                            <?php echo $this->lang->line('student'); ?>
                                            <?php echo $this->lang->line('attendance'); ?>
                                            <?php echo $this->lang->line('report'); ?>
                                        </div>
                                        
                                            <h3 style="text-align:center">Student Attendance Report</h3>
                                            <h5 style="text-align:center">of
                                                <?php echo getclassname($class_id) . " " ?>
                                                <?php echo getsectionname($section_id) ?> for the month of
                                                <?php echo date('F', mktime(0, 0, 0, $monthnum[$j], 1))?>
                                                

                                               
                                            </h5>

                                            <table class="table table-striped table-bordered ">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <?php echo $this->lang->line('student'); ?> 
                                                        </th>
                                                        <!--<th><br/><span data-toggle="tooltip" title="<?php echo "Gross Present Percentage(%)"; ?>">%</span></th>-->

                                                        <?php /*
                                                                                                                                                                                                                                                                                             foreach ($attendencetypeslist as $key => $value) {
                                                                                                                                                                                                                                                                                              //   echo "<pre>";
                                                                                                                                                                                                                                                                                                // print_r($value);
                                                                                                                                                                                                                                                                                                 if (strip_tags($value["key_value"]) != "E") {
                                                                                                                                                                                                                                                                                                     ?>
                                                                                                                                                                                                                                                                                                     <th colspan="" ><br/><span data-toggle="tooltip" title="<?php echo "Total " . $value["type"]; ?>"><?php echo strip_tags($value["key_value"]); ?>

                                                                                                                                                                                                                                                                                                         </span></th>

                                                                                                                                                                                                                                                                                                 <?php  }
                                                                                                                                                                                                                                                                                             }*/
                                                        ?>
                                                        <?php //var_dump(($attendence_array));
                                                                        foreach ($attendence_array[$j] as $at_key => $at_value) {

                                                                            if (date('D', $this->customlib->dateyyyymmddTodateformat($at_value)) == "Sun") {
                                                                                if ($at_value >= $from && $at_value <= $to) {
                                                                                    ?>
                                                                    <th class="tdcls text text-center bg-danger" colspan=""  style="font-size:10px">
                                                                        <?php
                                                                        echo date('j', $this->customlib->dateyyyymmddTodateformat($at_value)) . "<br/>"

                                                                            ?>
                                                                    </th>
                                                                    <?php
                                                                                }
                                                                            } else {
                                                                                if ($at_value >= $from && $at_value <= $to) {
                                                                                    ?>
                                                                    <th class="tdcls text text-center" colspan=""  style="font-size:10px">
                                                                        <?php
                                                                        echo date('j', $this->customlib->dateyyyymmddTodateformat($at_value)) . "<br/>"
                                                                            ?>
                                                                    </th>
                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (empty($student_array[$j])) {
                                                        ?>
                                                        <tr>
                                                            <td colspan="32" class="text-danger text-center">
                                                                <?php echo $this->lang->line('no_record_found'); ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        $row_count = 1;
                                                        $i = 0;
                                                        //echo "<pre>"; 
                                                        foreach ($student_array[$j] as $student_key => $student_value) {

// var_dump($student_value);
                                                            // echo $i;
                                                            //var_dump($monthAttendance[$i][$student_value['student_session_id']]);
                                                            //if($student_value['date'] >= $from && $student_value['date']<= $to){
                                                            ?>
                                                            <tr>
                                                                <th class="tdclsname" style="font-size:10px">
                                                                    <span data-toggle="popover" class="detail_popover" data-original-title=""
                                                                        title="">
                                                                            <?php echo $student_value['firstname'] . " " . $student_value['lastname']; ?>
                                                                        </span>
                                                                    <div class="fee_detail_popover" style="display: none">
                                                                        <?php echo "Admission No: " . $student_value['admission_no']; ?>
                                                                    </div>
                                                                </th>
                                                                <!--<th>-->
                                                                <?php /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             // var_dump($monthAttendance[$i][$student_value['student_session_id']]);exit;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $total_present = ($monthAttendance[$i][$student_value['student_session_id']]['present'] + $monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse'] + $monthAttendance[$i][$student_value['student_session_id']]['half_day'] + $monthAttendance[$i][$student_value['student_session_id']]['late']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $month_number = date("m", strtotime($month_selected));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, date("Y"));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $total_school_days = $monthAttendance[$i][$student_value['student_session_id']]['present'] + $monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse'] + $monthAttendance[$i][$student_value['student_session_id']]['late'] + $monthAttendance[$i][$student_value['student_session_id']]['half_day'] + $monthAttendance[$i][$student_value['student_session_id']]['absent'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 if ($total_school_days == 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $percentage = -1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $print_percentage = "-";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } else {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $percentage = ($total_present / $total_school_days) * 100;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $print_percentage = round($percentage, 0);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 if (($percentage < 75) && ($percentage >= 0)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $label = "class='label label-danger'";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } else if ($percentage > 75) {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $label = "class='label label-success'";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } else {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $label = "class='label label-default'";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 echo "<label $label>" . $print_percentage . "</label>";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 */?>
                                                                <!--</th>-->

                                                                <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['present']); ?></th>-->
                                                                <!--th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse']); ?></th-->
                                                                <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['late'] + $monthAttendance[$i][$student_value['student_session_id']]['late_with_excuse']); ?></th>-->
                                                                <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['absent']); ?></th>-->
                                                                <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['holiday']); ?></th>-->
                                                                <!--<th><?php print_r($monthAttendance[$i][$student_value['student_session_id']]['half_day']); ?></th>-->


                                                                <?php

                                                                $count = 0;
                                                                //  var_dump($resultlist[$j]);
                                                                
                                                                    foreach ($attendence_array[$j] as $at_key => $at_value) {
                                                                         
                                                                        if ($at_value >= $from && $at_value <= $to) { ?>
                                                                            <th class="tdcls text text-center" style="font-size:10px">
                                                                                

                                                                                <span data-toggle="" class="detail_popover" data-original-title=""
                                                                                    title="">
                                                                                        <?php
                                                                                        if (strip_tags($resultlist[$j][$at_value][$student_value['student_session_id']]['key']) == "E") {

                                                                                            $attendence_key = "L";
                                                                                            $remark = "Late With Excuse";
                                                                                        } else {

                                                                                            $attendence_key = $resultlist[$j][$at_value][$student_value['student_session_id']]['key'];

                                                                                            //var_dump($resultlist[$j][$at_value][$student_value['student_session_id']]['date']);																		
                                                    
                                                                                            $remark = $resultlist[$j][$at_value][$student_value['student_session_id']]['remark'];
                                                                                        }
                                                                                        if ($resultlist[$j][$at_value][$student_value['student_session_id']]['date'] == $at_value) {
                                                                                            print_r($attendence_key);
                                                                                        }
                                                                                        ?>
                                                                                  </span>
                                                                                

                                                                            </th>



                                                                            <?php $count++;
                                                                        }



                                                                    }
                                                                
                                                                ?>


                                                                <?php
                                                                ?>


</tr>
<?php
                                                            //}
                                                        }
                                                        $i++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                       
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-info">
                                            <?php echo $this->lang->line('no_attendance_prepare'); ?>
                                        </div>
                                        <?php
                                    }
                                    
                                            }
                                            ?>
                             </div>
                        </div>
                        </div>
                        <?php
                    }
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
            format: "mm/yyyy",
            minViewMode: 1,
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
        populateSection(section_id_post, class_id_post);
        getSubjectByClassandSection(class_id_post, section_id_post, sub_id_post);
        function populateSection(section_id_post, class_id_post) {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: { 'class_id': class_id_post },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
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
                    data: { 'class_id': class_id, 'section_id': section_id_post },
                    dataType: "json",
                    success: function (data) {

                        $.each(data, function (i, obj) {

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
                data: { 'class_id': class_id },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
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
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: { 'class_id': class_id, 'section_id': section_id },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
                        div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subject_id').append(div_data);
                }
            });
        });


        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#date').datepicker({
            format: "mm/yyyy",
            minViewMode: 1,
            autoclose: true
        });

    });
</script>
<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }
    function Popup(data) {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
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


</script>