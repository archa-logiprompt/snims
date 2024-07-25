<style type="text/css">
.radio {
    padding-left: 20px;
}

.radio label {
    display: inline-block;
    vertical-align: middle;
    position: relative;
    padding-left: 5px;
}

.radio label::before {
    content: "";
    display: inline-block;
    position: absolute;
    width: 17px;
    height: 17px;
    left: 0;
    margin-left: -20px;
    border: 1px solid #cccccc;
    border-radius: 50%;
    background-color: #fff;
    -webkit-transition: border 0.15s ease-in-out;
    -o-transition: border 0.15s ease-in-out;
    transition: border 0.15s ease-in-out;
}

.radio label::after {
    display: inline-block;
    position: absolute;
    content: " ";
    width: 11px;
    height: 11px;
    left: 3px;
    top: 3px;
    margin-left: -20px;
    border-radius: 50%;
    background-color: #555555;
    -webkit-transform: scale(0, 0);
    -ms-transform: scale(0, 0);
    -o-transform: scale(0, 0);
    transform: scale(0, 0);
    -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
}

.radio input[type="radio"] {
    opacity: 0;
    z-index: 1;
}

.radio input[type="radio"]:focus+label::before {
    outline: thin dotted;
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
}

.radio input[type="radio"]:checked+label::after {
    -webkit-transform: scale(1, 1);
    -ms-transform: scale(1, 1);
    -o-transform: scale(1, 1);
    transform: scale(1, 1);
}

.radio input[type="radio"]:disabled+label {
    opacity: 0.65;
}

.radio input[type="radio"]:disabled+label::before {
    cursor: not-allowed;
}

.radio.radio-inline {
    margin-top: 0;
}

.radio-primary input[type="radio"]+label::after {
    background-color: #337ab7;
}

.radio-primary input[type="radio"]:checked+label::before {
    border-color: #337ab7;
}

.radio-primary input[type="radio"]:checked+label::after {
    background-color: #337ab7;
}

.radio-danger input[type="radio"]+label::after {
    background-color: #d9534f;
}

.radio-danger input[type="radio"]:checked+label::before {
    border-color: #d9534f;
}

.radio-danger input[type="radio"]:checked+label::after {
    background-color: #d9534f;
}

.radio-info input[type="radio"]+label::after {
    background-color: #5bc0de;
}

.radio-info input[type="radio"]:checked+label::before {
    border-color: #5bc0de;
}

.radio-info input[type="radio"]:checked+label::after {
    background-color: #5bc0de;
}

@media (max-width:767px) {
    .radio.radio-inline {
        display: inherit;
    }
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>
<div class="content-wrapper" style="/* [disabled]min-height: 946px; */">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
            <small><?php echo $this->lang->line('student_fees1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>
                            <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>


                    <form role="form" id="" class="addmarks-form" method="post"
                        action="<?php echo site_url('admin/weeklycalendarteacher/create') ?>">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
foreach ($classlist as $class) {
    ?>
                                            <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
    }
    ?>>
                                                <?php echo $class['class'] ?></option>
                                            <?php
$count++;
}
?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>


                            </div>
                            <input type="submit" class="btn btn-primary pull-right" name="search"
                                value="Search"></input>
                        </div>

                    </form>


                </div>


                <?php if ($issearch) {?>

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i>
                            <?php echo $this->lang->line('class_timetable'); ?></h3>
                    </div>
                    <div class="box-body">

                        <section class="content">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-12 col-sm-12">



                                            <div class="box box-primary">
                                                <div class="box-body">
                                                    <!-- THE CALENDAR -->
                                                    <div id="weekcalendar"></div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /. box -->

                                        </div>
                                    </div>
                                </div>


                            </div>


                    </div> 

                    <div id="viewEventModal" class="modal fade " role="dialog">
                        <div class="modal-dialog modal-dialog2 modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo "View Event"; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- <form role="form" id="updatecalendar_form" method="post"
                                            enctype="multipart/form-data"
                                            action="<?php //echo base_url().'admin/weeklycalendarnew/updatecalendar' ?>"> -->


                                        <input type="hidden" name='hidden_class' value="<?php echo $class_id ?>">
                                        <input type="hidden" name='hidden_section' value="<?php echo $section_id ?>">
                                        <input type="hidden" name='hidden_id' id='update_id_hidden' value="">
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1">
                                                <?php echo $this->lang->line('date'); ?></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" autocomplete="off" readonly name="event_dates"
                                                    class="form-control pull-right text-center"
                                                    id="date-field-weekcalendar-view">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <div class="col-md-6" style="text-align:end">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Class</label>
                                                        <input type="radio" name="period_type" id="period_type_id"
                                                            value="class" checked>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="radio" name="period_type" id="period_type_id"
                                                            value="activity">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group period-time-div col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Select Period</label>
                                                        <select autofocus="" id="period_id" name="class_id"
                                                            class="form-control period_dropdown">
                                                            <option value="">
                                                                <?php echo $this->lang->line('select'); ?></option>
                                                            <option value="eight_to_nine_div" data-period="period_one"><?php echo "$period_list->period_one_from - $period_list->period_one_to"?>
                                                            </option>
                                                            <option value="nine_to_ten_div" data-period="period_two"><?php echo "$period_list->period_two_from - $period_list->period_two_to"?>
                                                            </option>
                                                            <option value="ten_to_eleven_div" data-period="period_three"><?php echo "$period_list->period_three_from - $period_list->period_three_to"?>
                                                            </option>
                                                            <option value="eleven_to_twelve_div" data-period="period_four"><?php echo "$period_list->period_four_from - $period_list->period_four_to" ?>
                                                            </option>
                                                            <option value="twelve_to_one_div" data-period="period_five"><?php echo  "$period_list->period_five_from - $period_list->period_five_to"?>
                                                            </option>
                                                            <option value="two_to_three_div" data-period="period_six"><?php echo "$period_list->period_six_from - $period_list->period_six_to" ?>
                                                            </option>
                                                            <option value="three_to_four_div" data-period="period_seven"><?php echo "$period_list->period_seven_from - $period_list->period_seven_to"?>
                                                            </option>
                                                            <option value="four_to_five_div" data-period="period_eight"><?php echo "$period_list->period_eight_from - $period_list->period_eight_to"?>
                                                            </option>

                                                        </select>
                                                        <span
                                                            class="text-danger"><?php echo form_error('class_id'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12" style="display:none">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Select Period</label>
                                                        <select autofocus="" id="period_activity_id"
                                                            name="period_activity"
                                                            class="form-control period_activity_dropdown">
                                                            <option value="">
                                                                <?php echo $this->lang->line('select'); ?></option>

                                                        </select>
                                                        <span
                                                            class="text-danger"><?php echo form_error('class_id'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity-div" style="display:none">

                                            <div class="form-group col-md-12">

                                                <label for="exampleInputEmail1">Activity</label>

                                                <input type="text" name="period_activity" placeholder="Activity"
                                                    class="form-control" id="activity_input">
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-primary save-activity pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div eight_to_nine_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_one' class="period_div"><?php echo "$period_list->period_one_from - $period_list->period_one_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass eight_to_nine_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

                                                <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">




                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File
                                                        </p>
                                                        <p class="dropify-error">Ooops, something wrong appended.
                                                        </p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span> <span
                                                                        class="dropify-filename-inner"></span></p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="eight_to_nine_link link_file"> Click To View </a>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control eight_to_nine_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div nine_to_ten_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_two' class="period_div"><?php echo "$period_list->period_two_from - $period_list->period_two_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass nine_to_ten_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

                                                 <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span> <span
                                                                        class="dropify-filename-inner"></span></p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="nine_to_ten_link link_file">
                                                    Click To View </a>


                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control nine_to_ten_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div ten_to_eleven_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_three' class="period_div"><?php echo "$period_list->period_three_from - $period_list->period_three_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass ten_to_eleven_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

 <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="ten_to_eleven_link link_file"> Click To View </a>


                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control ten_to_eleven_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div eleven_to_twelve_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_four' class="period_div"><?php echo "$period_list->period_four_from - $period_list->period_four_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass eleven_to_twelve_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

                                                 <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="eleven_to_twelve_link link_file "> Click To View </a>




                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control eleven_to_twelve_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div twelve_to_one_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_five' class="period_div"><?php echo "$period_list->period_five_from - $period_list->period_five_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass twelve_to_one_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

                                                     <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="twelve_to_one_link link_file"> Click To View </a>


                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control twelve_to_one_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div two_to_three_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_six' class="period_div"><?php echo "$period_list->period_six_from - $period_list->period_six_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass two_to_three_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>
  <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="two_to_three_link link_file">
                                                    Click To View </a>


                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control two_to_three_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div three_to_four_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_seven' class="period_div"><?php echo "$period_list->period_seven_from - $period_list->period_seven_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass three_to_four_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

 <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="three_to_four_link link_file"> Click To View </a>


                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control three_to_four_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button "> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                        <div class="teacher-div four_to_five_div">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="exampleInputEmail1"id='period_eight' class="period_div"><?php echo "$period_list->period_eight_from - $period_list->period_eight_to"?></label>

                                            </div>

                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Subject</label>
                                                <select id="subject_id" readonly disabled name="subject_id[]"
                                                    class="form-control subjectclass four_to_five_subject">
                                                    <option value="">Select</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Topic</label>

                                                     <textarea name="topic_teached" placeholder="Topic Teached"
                                                    class="form-control" id="topic_id"></textarea>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="form-group col-md-3 ">


                                                <label for="exampleInputEmail1">Assign Work</label>
                                                <div class="dropify-wrapper" style="height: 32px;">
                                                    <div class="dropify-message">
                                                        <p><i class="fa fa-cloud-upload dropi18"></i>Upload A File</p>
                                                        <p class="dropify-error">Ooops, something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input class="form-control" data-height="20" type="file"
                                                        name="work_assigned" id="work_assigned_id" size="20">
                                                    <div class="dropify-preview"><span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename"><span
                                                                        class="file-icon"></span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                                <p class="dropify-infos-message">Click
                                                                    to replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" id='file-view-id' target="_blank"
                                                    class="four_to_five_link link_file">
                                                    Click To View </a>


                                            </div>
                                            <div class="form-group col-md-3">

                                                <label for="exampleInputEmail1">Assign Other Teacher</label>

                                                <select id="teacher_id" name="teacher_id[]"
                                                    class="form-control four_to_five_teacher">

                                                </select>
                                                <span class="text-danger"><?php echo form_error('title'); ?></span>

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-success attendance-button"> Attendance
                                                    <button class="btn btn-primary save-period pull-right"> Save
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="AttendanceModal" class="modal fade " role="dialog">
                        <div class="modal-dialog modal-dialog2 modal-lg" style="width:80%">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close-attendance" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo "View Event"; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style='padding: 22px;'>
                                        <form action="" id="attendance-form">
                                            <input type="radio" name="pt" value=1>Practical
                                            <input type="radio"name="pt" value=0 checked>Theory
                                            <input type="hidden" name='hidden_class' value="<?php echo $class_id ?>">
                                            <input type="hidden" name='hidden_section'
                                                value="<?php echo $section_id ?>">
                                            <input type="hidden" name='hidden_id' id='update_id_hidden' value="">
                                            <div class="table-responsive ptt10">
                                                <table class="table table-hover table-striped example">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Admission Number</th>
                                                            <th>Roll Number</th>
                                                            <th>Name</th>
                                                            <th>Attendance</th>
                                                            <th>Leave Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                    $count = 0;  
                                                     foreach ($students as $key => $value) {
                                                    ?>
                                                        <tr class="student-row">
                                                            <td><?php echo $count+1; ?></td>
                                                            <td><?php echo $value['admission_no']; ?></td>
                                                            <td><?php echo $value['roll_no']; ?></td>
                                                            <td><?php echo $value['firstname'].' '.$value['lastname']; ?>
                                                            </td>
                                                            <input type="hidden" name="hdnstudentid[]"
                                                                value="<?php echo $value['student_id'] ?>">
                                                            <td>
                                                                <?php foreach (['Present','Absent'] as $radiokey => $radiovalue) { 
                                                                   
                                                                   ?>
                                                                <div class="radio radio-info radio-inline">
                                                                    <input <?php if($radiokey==0){echo 'checked';} ?>
                                                                        type="radio"
                                                                        id="attendencetype<?php echo "$count-$radiokey"; ?>"
                                                                        value="<?php echo $radiokey ?>"
                                                                        name="attendencetype[<?php echo $count; ?>]">
                                                                    <label
                                                                        for="attendencetype<?php echo "$count-$radiokey"; ?>">
                                                                        <?php echo $radiovalue ?>
                                                                    </label>
                                                                </div>

                                                                <?php } ?>

                                                            </td>
                                                            <td>
                                                                <select id="" name="remark[<?php echo $count; ?>]" class="form-control">
                                                                    <option value="0">
                                                                        <?php echo $this->lang->line('select'); ?>
                                                                    </option>
                                                                    <option value="1">Sick Leave</option>
                                                                    <option value="2">Any Other Leave</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                $count++;
                                                } ?>
                                                    </tbody>
                                                </table>
                                            </div>




                                            <div class="activity-div">


                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <button class="btn btn-primary save-attendance pull-right"
                                                        data-isupdate='0'> Save
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>






            </div>
            <?php }?>
        </div>
</div>


</section>
</div>




<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '.attendance-button', function() {

        $parent = $(this).parent().parent()

        $period_time = $parent.prevAll('.period-time-div').find('#period_id')

        let period = $period_time.val()

        let subject = $parent.find('#subject_id').val()

        let topic = $parent.find('#topic_id').val()

        let date = $('#date-field-weekcalendar-view').val()


        let class_id = $('#class_id').val()
        let section_id = $('#section_id').val()
        var base_url = '<?php echo base_url() ?>';


        $.ajax({
            type: 'POST',
            url: base_url + "admin/weeklycalendarteacher/getattendance",
            data: {
                class_id: class_id,
                section_id: section_id,
                period: period,
                date: date
            },
            success: function(data) { 
                if(data!='[]'){
                    let attendance = JSON.parse(data)

                
              

                attendance.forEach((element, index) => {
                    $attendencetype = $(`input[name="attendencetype[${index}]"]`);
                    $attendenceremark = $(`select[name="remark[${index}]"] option`);
                    
                    $attendencetype.each((typeIndex, typeElement) => {
                        
                        if ($(typeElement).val() == element.attendencetype) {
                            $(typeElement).prop('checked', true);
                        }
                    });
                    $attendenceremark.each((remarkIndex, remarkElement) => {
                         
                        if ($(remarkElement).val() == element.remark) {
                            $(remarkElement).prop('selected', true);
                        }
                    });
                });
                $('.save-attendance').data('isupdate','1')
                $('.save-attendance').text('Update')
            }else{
                $attendencetype = $(`input[name^="attendencetype"]`);
                $attendenceremark = $(`select[name^="remark"] option`);
                console.log($attendenceremark)
                $attendencetype.each((typeIndex, typeElement) => {
                        
                        if ($(typeElement).val() == 0) {
                            $(typeElement).prop('checked', true);
                        }
                    });
                    
                    $attendenceremark.each((remarkIndex, remarkElement) => {
                         
                         if ($(remarkElement).val() ==0) {
                             $(remarkElement).prop('selected', true);
                         }
                     });
                $('.save-attendance').data('isupdate','0')
                $('.save-attendance').text('Save')
            }
            }
        })






        $('.save-attendance').data('period', period)
        $('.save-attendance').data('subject', subject)
        $('.save-attendance').data('topic', topic)
        $('.save-attendance').data('date', date)



        $('#AttendanceModal').modal('show')


    })

    $(document).on('click', '.save-attendance', function(e) {
        e.preventDefault()
        var form = $('#attendance-form')[0]


        let formdata = new FormData(form)

        formdata.append('period', $(this).data('period'))
        formdata.append('subject', $(this).data('subject'))
        formdata.append('topic', $(this).data('topic'))
        formdata.append('date', $(this).data('date'))
        formdata.append('isupdate', $(this).data('isupdate'))

        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: 'POST',
            url: base_url + "admin/weeklycalendarteacher/saveattendance",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#AttendanceModal').modal('hide')
            }
        })





    })
})
$(document).ready(function() {


    $('.teacher-div').hide()



    var nonteachingperiods = [];


    let userid = "<?php echo $userid; ?>"





    $(document).on('change', '#period_id', function(e) {

        // console.log(e.target)


        $('.teacher-div').hide()
        $('.no-duty').hide()


        $('.link_file').hide()

        $('.dropify-message').html(`
        <p><i class="fa fa-cloud-upload dropi18"></i>
        Upload A File</p>
        <p class="dropify-error">Ooops, something went wrong.</p>
        `)



        let divname = e.target.value;
        if ($(`.${divname}`).find('#teacher_id').val() == userid) {

            setPeriodValues(divname, userid)

            $(`.${divname}`).show()
        } else {
            $('#period_id').after(`
            <div class='no-duty'>
            <br>
            <h4 class='text-center' style="color:green">
            There is No Duties Assigned For You In This Period
            </h4>
            </div>
            `)
        }

    })

    function setPeriodValues(period, userid) {
        setTimeout(() => {


            var selectedOption = $('#subject_id:visible option:selected');
            let subject = selectedOption.val();
            let calendarid = $('#update_id_hidden').val()
            var base_url = '<?php echo base_url() ?>';

            $('.save-period').each(function() {
                $(this).attr('is-update', 'false')

            });

            $.ajax({
                type: "POST",
                url: base_url + "admin/weeklycalendarteacher/getPeriod",
                data: {
                    'period': period.replace(/_div/g, ""),
                    'calendarid': calendarid,
                    'userid': userid,
                    'subject': subject
                },
                dataType: "json",
                success: function(data) {



                    if (data) {

                        let $topicid = document.querySelectorAll('#topic_id')

                        $topicid.forEach(function(myInput) {


                            let parent = myInput.parentElement.parentElement
                                .classList[1];

                            if (parent.replace(/_div/g, "") == data.period) {
                                myInput.value = data.topic;

                                myInput.parentElement.parentElement
                                    .getElementsByClassName(
                                        'save-period')[0].setAttribute('is-update',
                                        'true')
                                myInput.parentElement.parentElement
                                    .getElementsByClassName(
                                        'save-period')[0].setAttribute('data-id',
                                        data.id)

                            }

                            var teacherselect = parent.replace(/_div/g, "_teacher")

                            var teacher = $(`#${teacherselect}`)

                            var options = teacher.find('option');

                            // var link_to_file = $('#file-view-id:visible');


                            var link_to_file = parent.replace(/_div/g, "_link")


                            $(`.${link_to_file}`).show()
                            if ($(`.${link_to_file}`).is(':visible')) {

                                if (data.works != '') {

                                    $(`.${link_to_file}`).attr('href', baseurl +
                                        data.works);

                                } else {
                                    $(`.${link_to_file}`).hide()
                                }


                            }



                            options.each(function() {
                                if ($(this).val() == data
                                    .assigned_teacher) {
                                    $(this).prop('selected', true);
                                }
                            });





                        });

                    }
                }
            });

        }, 1000);

    }
    let workfile = '';

    $(document).on('change', '#work_assigned_id', function(e) {
        let filename = e.target.files[0].name
        workfile = e.target.files[0]

        $(this).parent().find('.dropify-message').html(
            `<p><i class="fa fa-cloud-upload dropi18"></i>
         ` + filename + `</p>
         <p class="dropify-error">Ooops, something wrong appended.</p>
            `
        )

    })



    $(document).on('click', '.save-activity', function(e) {
        e.preventDefault()

        let $actbtn = $(this)

        let activity = $actbtn.parent().parent().find('#activity_input').val()

        let actperiod = $actbtn.parent().parent().parent().find('.period_activity_dropdown').val()

        let calendarid = $('#update_id_hidden').val()

        const formData = new FormData()

        formData.append('teacher_id', '')
        formData.append('subject_id', '')
        formData.append('topic', '')
        formData.append('calendarid', calendarid)
        formData.append('assigned_work', '')
        formData.append('period', actperiod)
        formData.append('activity', activity)

        let isupdate = $(this).attr('is-update');

        let tableid = $(this).attr('is-update') ? $(this).attr('data-id') : '0';


        formData.append('id', $(this).attr('data-id'))
        formData.append('isupdate', isupdate)




        var base_url = '<?php echo base_url() ?>';

        var url = isupdate == 'true' ? 'updateActivity' : "addActivity"

        $.ajax({
            url: base_url + "admin/weeklycalendarteacher/" + url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                window.location.reload(true) // handle the response from the server
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(
                    errorThrown); // handle any errors that occur during the request
            }
        });


    })



    $(document).on('click', '.save-period', function(e) {

        let $button = $(this)

        let $parent = $button.parent().parent()

        let teacher = $parent.find('#teacher_id').val();

        let subject = $parent.find('#subject_id').val();

        let topic = $parent.find('#topic_id').val();

        let calendarid = $('#update_id_hidden').val()

        let assigned_work = workfile

        let period = ($('#period_id').val()).replace(/_div/g, "")

        let isupdate = $(this).attr('is-update');

        let tableid = $(this).attr('is-update') ? $(this).attr('data-id') : '0';

        const formData = new FormData()

        formData.append('teacher_id', teacher)
        formData.append('subject_id', subject)
        formData.append('topic', topic)
        formData.append('calendarid', calendarid)
        formData.append('assigned_work', assigned_work)
        formData.append('period', period)
        formData.append('id', tableid)
        formData.append('isupdate', isupdate)

        var base_url = '<?php echo base_url() ?>';
        var url = isupdate == 'true' ? 'updateperiod' : "saveperiod"

        $.ajax({
            url: base_url + "admin/weeklycalendarteacher/" + url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                window.location.reload(true) // handle the response from the server
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(
                    errorThrown); // handle any errors that occur during the request
            }
        });

    })








    $(document).on('change', '#class_id', function(e) {

        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        var url = "<?php
                $userdata = $this->customlib->getUserData();
                if (($userdata["role_id"] == 2)) {
                    echo "getClassTeacherSection";
                } else {
                    echo "getByClass";
                }
                ?>";
        $.ajax({
            type: "GET",
            url: base_url + "sections/" + url,
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {

                    div_data += "<option value=" + obj.section_id + ">" + obj
                        .section +
                        "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    });





    $(document).on('change', '#section_id', function(e) {

        $('.subjectclass').each(function() {
            $(this).html('')
        })

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
                    div_data += "<option value=" + obj.id + ">" + obj.name +
                        "</option>";
                });

                $('.subjectclass').each(function() {
                    $(this).append(div_data);
                })

            }
        });
    });

    $(document).on('change', '#subject_id', function(e) {

        let $div = $(this);
        ($div.parent().parent().find('#teacher_id')).html("");

        var subject_id = $(this).val();

        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/get_subjectteachers",
            data: {
                'subject_id': subject_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {

                    div_data += "<option value=" + obj.id + ">" + obj.name + " " +
                        "</option>";
                });
                ($div.parent().parent().find('#teacher_id')).append(div_data);
            }
        });
    });


});




$(function() {

    $(".timepicker").timepicker({
        showInputs: false,
        defaultTime: false,
        explicitMode: false,
        minuteStep: 1
    });
});
let options = ''
$(document).ready(function() {
    var class_id = $('#class_id').val();
    var section_id = '<?php echo $section_id ?>';
    var subject_id = '';
    var teacher_id = '';

    getSectionByClass(class_id, section_id);
    getSubjectByClassandSection(class_id, section_id, subject_id);
    // getSubjectTeachers(class_id, section_id, subject_id,teacher_id);



    //     options.each(function() {
    //   console.log($(this).text());
    // });
    // console.log(options)

});




function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value="">Select</option>';
        var url = "getByClass";
        $.ajax({
            type: "GET",
            url: base_url + "sections/" + url,
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

function getSubjectByClassandSection(class_id, section_id, subject_id) {

    if (class_id != "" && section_id != "") {
        $('.subjectclass').each(function() {
            $(this).html('')
        })
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value="">Select</option>';
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
                    var sel = "";
                    if (subject_id == obj.id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + " (" + obj
                        .type + ")" + "</option>";
                });

                $('.subjectclass').each(function() {
                    $(this).append(div_data);
                })
            }
        });
    }
}



var modal = document.getElementById("viewEventModal");
let originalContent = modal.innerHTML;

$(document).ready(function() {



    $('.fc-agendaWeek-button').hide()
    $('.fc-agendaDay-button').hide()
    $('.fc-month-button').hide()

    $calendar = $('#weekcalendar');
    var base_url = '<?php echo base_url() ?>';
    today = new Date();
    y = today.getFullYear();
    m = today.getMonth();
    d = today.getDate();
    var viewtitle = 'month';
    var pagetitle = "<?php
if (isset($title)) {
    echo 'Week Calendar';
}
?>";



    $('body').on('click', '.close', function(e) {

        // $('.modal-body').html(eventmodal);

        modal.innerHTML = '';
        modal.innerHTML = originalContent;
        var class_id = $('#class_id').val();
        var section_id = '<?php echo $section_id ?>';
        var subject_id = '';

        getSubjectByClassandSection(class_id, section_id, subject_id);
        $('#viewEventModal').modal('hide');
    })





    if (pagetitle == "Dashboard") {

        viewtitle = 'agendaWeek';
    }

    $calendar.fullCalendar({




        viewRender: function(view, element) {
            // We make sure that we activate the perfect scrollbar when the view isn't on Month
            //if (view.name != 'month'){
            //  $(element).find('.fc-scroller').perfectScrollbar();
            //}
        },

        header: {
            center: 'title',
            right: '',
            left: 'prev,next,today'
        },
        defaultDate: today,
        defaultView: viewtitle,
        selectable: true,
        selectHelper: true,
        views: {
            month: { // name of view
                titleFormat: 'MMMM YYYY'
                // other view-specific options here
            },
            week: {
                titleFormat: " MMMM D YYYY"
            },
            day: {
                titleFormat: 'D MMM, YYYY'
            }
        },
        timezone: "Asia/Kolkata",
        draggable: false,

        editable: false,
        eventLimit: false, // allow "more" link when too many events


        // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
        events: {
            url: base_url + 'admin/weeklycalendarteacher/getcalendar',
            data: {
                section_id: "<?php echo $section_id ?>",
                class_id: "<?php echo $class_id ?>",
                user_id: "<?php echo $userid ?>"
            },
            method: "POST",

        },



        eventRender: function(event, element) {

            var colors = ["#ffadad", "#ffd6a5", "#fdffb6", "#caffbf", "#9bf6ff", "#a0c4ff",
                "#bdb2ff", "#ffc6ff"
            ];

            // Get the index of the day in the month (0-based)
            var dayOfMonth = event.start.date() - 1;

            // Set the background color of the event element to the corresponding color in the array
            element.css('background-color', colors[dayOfMonth % colors.length]);
            element.css('color', '#000');
            element.css('font-size', '10px');

            element.attr('title', event.title);
            element.attr('onclick', event.onclick);
            // element.attr('data-toggle', 'tooltip');
            if ((!event.url) && (event.event_type != 'task')) {
                // element.attr('title', event.title + '-' + event.description);
                element.click(function(e) {

                    view_event(event.id);
                });
            }

        },
        dayClick: function(date, jsEvent, view) {
            var d = date.format('DD/MM/YYYY');


        },


    });


    function view_event(id) {

        nonteachingperiods = []

        $('#update_id_hidden').val(id)

        let user = <?php echo $userid; ?>


        options = $('.period_dropdown option')

        $.ajax({
            url: base_url + 'admin/weeklycalendarnew/view_event/' + id,
            type: 'POST',
            dataType: "json",
            success: function(msg) { 
                
                options.each(function(){
                    $(this).text(msg[$(this).data('period')]) 
                })


                $period_labels = $('.period_div'); 

                $period_labels.each(function(){
                    
                   $(this).text(msg[$(this).attr('id')])
                })



                getPeriods(msg)
                setTimeout(() => {

                    $('#viewEventModal').modal('show');
                    $('.teacher-div').hide()
                }, 900);

                $('#date-field-weekcalendar-view').val(msg.date)

                for (let key in msg) {
                    if (key.endsWith('_teacher')) {
                        $(`.${key} option`).each(function(e) {
                            $(this).prop("selected", false);
                        });

                    }
                }

                for (let key in msg) {
                    if (key.endsWith('_subject')) {
                        $(`.${key} option`).each(function(e) {
                            if ($(this).val() === msg[key]) {
                                var teacherid = key.replace(/subject/g, "teacher");
                                getTeachersBySubject(msg[key], key, msg[teacherid])
                                $(this).prop("selected", true);
                            } else {
                                $(this).prop("selected", false);

                            }

                            if (msg[key] == 0) {
                                let $zerodiv = $(`.${key}`);
                                ($zerodiv.parent().parent()).remove();

                            }
                        });

                    }
                }
            }
        });



    }



    $(document).on('change', '#period_type_id', function() {

        $('#period_activity_dropdown option:not(:first-child)').remove();
        let form_groups = $(this).parent().parent().parent().parent().nextAll('.form-group').filter(':lt(2)')


        if ($(this).val() == 'class') {

            $('.activity-div').hide()
            $('#period_id').val() && $('#period_id').trigger('change')
            $(form_groups[0]).show()
            $(form_groups[1]).hide()


        } else if ($(this).val() == 'activity') {

            $('.teacher-div').hide()
            $('#period_activity_id').val() && $('.activity-div').show()
            $(form_groups[0]).hide()
            $(form_groups[1]).show()

            nonteachingperiods.forEach(element => {
                if ($(element).val()) {


                    $('.period_activity_dropdown').append($('<option>', {
                        value: $(element).val(),
                        text: $(element).text()
                    }));

                }
            });
            nonteachingperiods = []
        }

    })

    $(document).on('change', '#period_activity_id', function(e) {
        let period = e.target.value

        let userid = '<?php echo $userid; ?>'


        setTimeout(() => {
            $('.activity-div').show()
            $('#activity_input').val('')


            var selectedOption = $('#subject_id:visible option:selected');
            let subject = selectedOption.val();
            let calendarid = $('#update_id_hidden').val()
            var base_url = '<?php echo base_url() ?>';

            $('.save-activity').each(function() {
                $(this).attr('is-update', 'false')
                $(this).attr('data-id', '')

            });

            $.ajax({
                type: "POST",
                url: base_url + "admin/weeklycalendarteacher/getPeriod",
                data: {
                    'period': period.replace(/_div/g, ""),
                    'calendarid': calendarid,
                    'userid': userid,
                    'subject': 0
                },
                dataType: "json",
                success: function(data) {



                    if (data) {

                        $('#activity_input').val(data.activity)

                        $('.save-activity').attr('is-update', 'true')
                        $('.save-activity').attr('data-id', data.id)

                    }
                }
            });

        }, 1000);



    })



    function getPeriods(periods) {
     

        nonteachingperiods = []

        let user = "<?php echo $userid; ?>";
        let filteredKeys = []
        filteredKeys = Object.keys(periods).filter(key => {
            return (periods[key] == user && key.endsWith("teacher"))

        });
        options.each(function() {
          
            if (!(filteredKeys.includes($(this).val().replace(/_div/g, "_teacher")))) {
               $(this).prop('selected',false)
               $(this).hide()
               nonteachingperiods.push($(this))
            }else{
                
                $(this).prop('selected',false)
                $(this).show()
            }
        });



    }




    function getTeachersBySubject(id, key, teacherid) {



        let $div = $(`.${key}`);
        ($div.parent().parent().find('#teacher_id')).html("");


        var subject_id = id;
        let user = "<?php echo $userid; ?>"



        var base_url = '<?php echo base_url() ?>';
        var div_data = '';
        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/get_subjectteachers",
            data: {
                'subject_id': subject_id
            },
            dataType: "json",
            success: function(data) {
                // console.log(data)

                $.each(data, function(i, obj) {


                    var sel = "";
                    if (teacherid == obj.id) {
                        sel = "selected";
                    } else {
                        sel = "";

                    }

                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name +
                        " " + "</option>";

                });

                ($div.parent().parent().find('#teacher_id')).append(div_data);
            }
        });
    }



});



$(document).ready(function() {

    $(document).on('click', '.close_notice', function() {
        var data = $(this).data();


        $.ajax({
            type: "POST",
            url: base_url + "admin/notification/read",
            data: {
                'notice': data.noticeid
            },
            dataType: "json",
            success: function(data) {
                if (data.status == "fail") {

                    errorMsg(data.msg);
                } else {
                    successMsg(data.msg);
                }

            }
        });


    });
});
</script>