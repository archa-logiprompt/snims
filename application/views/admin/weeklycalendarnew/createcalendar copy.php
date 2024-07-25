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


    <style>
    .flex-4 {
        flex: 1 0 21%;
    }

    .flex-parent {
        display: flex;
        flex-wrap: wrap;
    }
    </style>
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
                        action="<?php echo site_url('admin/weeklycalendarnew/create') ?>">
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
                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id'])
                                                       echo "selected=selected"; ?>>
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


                <?php if ($issearch) { ?>

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
                        <div id="newEventModal" class="modal fade " role="dialog">
                            <div class="modal-dialog modal-dialog2 modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?php echo "Add New Timetable"; ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name='hidden_class' value="<?php echo $class_id ?>">
                                        <input type="hidden" name='hidden_section' value="<?php echo $section_id ?>">


                                        <div class="row">
                                            <form role="form" id="addcalendar_form" method="post"
                                                enctype="multipart/form-data"
                                                action="<?php echo base_url() . 'admin/weeklycalendarnew/savecalendar' ?>">


                                                <input type="hidden" name='hidden_class' value="<?php echo $class_id ?>">
                                                <input type="hidden" name='hidden_section'
                                                    value="<?php echo $section_id ?>">



                                                <div class="form-group col-md-12">
                                                    <label for="exampleInputEmail1">
                                                        <?php echo $this->lang->line('date'); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" autocomplete="off" readonly name="event_dates"
                                                            class="form-control pull-right text-center"
                                                            id="date-field-weekcalendar">
                                                    </div>
                                                </div>
                                                <input class="form-check-input" id='multiple-period-checkbox'
           type="checkbox" value="holiday">
    <label for="multiple-period-checkbox">Holiday</label>          
                                                <?php

                                                // $period_list_array = [
                                                //     [
                                                //         'time' => '8:00 AM - 9:00 AM',
                                                //         'value' => 'eight_to_nine'
                                                //     ],
                                                //     [
                                                //         'time' => '9:00 AM - 10:00 AM',
                                                //         'value' => 'nine_to_ten'
                                                //     ],
                                                //     [
                                                //         'time' => '10:00 AM - 10:45 AM',
                                                //         'value' => 'ten_to_eleven'
                                                //     ],
                                                //     [
                                                //         'time' => '11:15 AM - 12:00 PM',
                                                //         'value' => 'eleven_to_twelve'
                                                //     ],
                                                //     [
                                                //         'time' => '12:00 PM - 01:00 PM',
                                                //         'value' => 'twelve_to_one'
                                                //     ],
                                                //     [
                                                //         'time' => '02:00 PM - 03:00 PM',
                                                //         'value' => 'two_to_three'
                                                //     ],
                                                //     [
                                                //         'time' => '03:00 PM - 04:00 PM',
                                                //         'value' => 'three_to_four'
                                                //     ],
                                                //     [
                                                //         'time' => '04:00 PM - 05:00 PM',
                                                //         'value' => 'four_to_five'
                                                //     ],

                                                // ];
                                                $period_list_array = [
                                                    [
                                                        'time' => "$period_list->period_one_from - $period_list->period_one_to",
                                                        'value' => 'eight_to_nine'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_two_from - $period_list->period_two_to",
                                                        'value' => 'nine_to_ten'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_three_from - $period_list->period_three_to",
                                                        'value' => 'ten_to_eleven'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_four_from - $period_list->period_four_to",
                                                        'value' => 'eleven_to_twelve'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_five_from - $period_list->period_five_to",
                                                        'value' => 'twelve_to_one'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_six_from - $period_list->period_six_to",
                                                        'value' => 'two_to_three'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_seven_from - $period_list->period_seven_to",
                                                        'value' => 'three_to_four'
                                                    ],
                                                    [
                                                        'time' => "$period_list->period_eight_from - $period_list->period_eight_to",
                                                        'value' => 'four_to_five'
                                                    ],

                                                ];
                                                ?>
                                                
                                                <div class="form-group col-md-12">
                                                    <label for="exampleInputEmail1">
                                                        <!-- <?php echo $this->lang->line('date'); ?></label> -->



                                                    <h3 class='text-center mb-4'>Select Multiple Periods</h3>
                                                    <div class="input-group flex-parent">


                                                        <?php foreach ($period_list_array as $key => $value) {

                                                            ?>

                                                            <div class="form-check flex-4">
                                                                <input class="form-check-input" id='multiple-period-checkbox'
                                                                    type="checkbox" value="<?php echo $value['value'] ?>"
                                                                    label="<?php echo $value['time'] ?>" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    <?php echo $value['time'] ?>
                                                                </label>
                                                            </div>

                                                        <?php } ?>
                                                        <input type="text" name="multiple-activity" style="display:none"
                                                            id="multiple_activity_id" class="form-control"
                                                            placeholder="Enter Activity"> 
                                                    </div>
                                                </div>


                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">8:00 AM - 9:00 AM</label>

                                                    </div>

                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[0]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[0]" class="periodtype-radio"
                                                            value="other">
                                                    </div>

                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">9:00 AM - 10:00 AM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[1]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[1]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">10:00 AM - 10:45 AM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[2]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[2]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>

                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">11:15 AM - 12:00 PM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[3]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[3]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">12:00 PM - 01:00 PM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[4]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[4]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">02:00 PM - 03:00 PM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[5]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[5]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">03:00 PM - 04:00 PM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[6]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[6]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">04:00 PM - 05:00 PM</label>

                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[7]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[7]" class="periodtype-radio"
                                                            value="other">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]" class="form-control">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                
                                                </div>




                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input type="submit" class="btn btn-primary submit_addevent pull-right"
                                                        value="<?php echo $this->lang->line('save'); ?>">
                                                </div>
                                            </form>
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
                                            <form role="form" id="updatecalendar_form" method="post"
                                                enctype="multipart/form-data"
                                                action="<?php echo base_url() . 'admin/weeklycalendarnew/updatecalendar' ?>">


                                                <input type="hidden" name='hidden_class' value="<?php echo $class_id ?>">
                                                <input type="hidden" name='hidden_section'
                                                    value="<?php echo $section_id ?>">
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
                                                <h3 class='text-center mb-4'>Select Multiple Periods</h3>

                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">8:00 AM - 9:00 AM</label>

                                                    </div>

                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[0]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[0]" class="periodtype-radio"
                                                            value="other">
                                                    </div>



                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass eight_to_nine_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control eight_to_nine_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control" placeholder="Enter Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">9:00 AM - 10:00 AM</label>

                                                    </div>

                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[1]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[1]" class="periodtype-radio"
                                                            value="other">
                                                    </div>



                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass nine_to_ten_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control nine_to_ten_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control" placeholder="Enter Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">10:00 AM - 10:45 AM</label>

                                                    </div>



                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[2]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[2]" class="periodtype-radio"
                                                            value="other">
                                                    </div>


                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass ten_to_eleven_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control ten_to_eleven_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control" placeholder="Enter Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>

                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">11:15 AM - 12:00 PM</label>

                                                    </div>



                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[3]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[3]" class="periodtype-radio"
                                                            value="other">
                                                    </div>



                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass eleven_to_twelve_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control eleven_to_twelve_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control" placeholder="Enter Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">12:00 PM - 01:00 PM</label>

                                                    </div>


                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[4]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[4]" class="periodtype-radio"
                                                            value="other">
                                                    </div>




                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass twelve_to_one_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control twelve_to_one_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control" placeholder="Enter Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">02:00 PM - 03:00 PM</label>

                                                    </div>


                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[5]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[5]" class="periodtype-radio"
                                                            value="other">
                                                    </div>


                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass two_to_three_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control two_to_three_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">03:00 PM - 04:00 PM</label>

                                                    </div>



                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[6]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[6]" class="periodtype-radio"
                                                            value="other">
                                                    </div>


                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass three_to_four_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control three_to_four_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>
                                                <div class="teacher-div">
                                                    <div class="form-group col-md-12 text-center">
                                                        <label for="exampleInputEmail1">04:00 PM - 05:00 PM</label>

                                                    </div>

                                                    <div class="form-group text-center">
                                                        <label for="typeofperiod">Class</label>
                                                        <input type="radio" name="periodtype[7]" class="periodtype-radio"
                                                            value="class" checked>
                                                        <label for="typeofperiod">Other</label>
                                                        <input type="radio" name="periodtype[7]" class="periodtype-radio"
                                                            value="other">
                                                    </div>



                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Subject</label>
                                                        <select id="subject_id" name="subject_id[]"
                                                            class="form-control subjectclass four_to_five_subject">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <label for="exampleInputEmail1">Teacher</label>

                                                        <select id="teacher_id" name="teacher_id[]"
                                                            class="form-control four_to_five_teacher">
                                                            <option value="">Select</option>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                    </div>
                                                    <div class="form-group col-md-12" style="display:none">

                                                        <label for="exampleInputEmail1">Activity</label>
                                                        <input type="text" name="activity_id[]" id="activity_id"
                                                            class="form-control activityclass" placeholder="Activity">
                                                        <span
                                                            class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                    </div>
                                                </div>




                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <input type="submit" class="btn btn-primary submit_addevent pull-right"
                                                        value="<?php echo $this->lang->line('save'); ?>">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>
                <?php } ?>
            </div>
        </div>


    </section>
</div>

<script type="text/javascript">
$(document).ready(function() {






    $(document).on('change', '#multiple-period-checkbox', function(e) {

        $modal = $(this).closest('.modal')
        $this = $(this)

        let ischecked = $(this).prop('checked')

        $activities = [];

        let otherradio;


        $modal.find('.teacher-div').each(function() {
            var labeltext = $(this).find('label').eq(0).text()

            if (labeltext == $this.attr('label')) {

                if (ischecked) {

                    otherradio = $(this).find('.periodtype-radio').eq(1)

                    otherradio.prop('checked', true).change()

                    $activities.push(otherradio.closest('.teacher-div').find('#activity_id'))


                } else {
                    otherradio = $(this).find('.periodtype-radio').eq(0)

                    otherradio.prop('checked', true).change()
                }


                $('#multiple_activity_id').show()
            }
        })


        $("#multiple_activity_id").on('keyup', function() {



            otherradio.closest('.teacher-div').find('#activity_id').val($(this).val())


        });

    })



    var selected = [];
    var topic = '';
    $(document).on('change', '.periodtype-radio', function(e) {
        const $this = $(this);
        const periodname = $this.attr('name');
        const x = periodname.slice(periodname.indexOf('[') + 1, periodname.indexOf(']'));
        const $formGroups = $this.parent().nextAll('.form-group');


        $formGroups.slice(0, 2).each(function() {
            $(this).find('select').each(function() {
                selected.push($(this).val());
            })
        })


        if ($this.val() == 'other') {
            $formGroups.slice(2).show();
            $formGroups.slice(0, 2).hide();


            $formGroups.slice(0, 2).each(function() {
                $(this).find('select').each(function() {
                    $(this).find('option').prop('selected', false)
                })
            })

            $formGroups.slice(2).each(function() {
                $(this).find('#activity_id').val(topic)
            })



        } else {
            let prevselected = selected
                .filter(value => value !== '')
                .slice(-2);

            $formGroups.slice(0, 2).each(function() {
                let selectboxarray = $(this).find('select');

                if (selectboxarray.attr('id') == 'subject_id') {

                    selectboxarray.find('option').each(function() {

                        if (prevselected[0] == $(this).val()) {
                            $(this).prop('selected', true)
                        }
                    })
                } else {
                    selectboxarray.find('option').each(function() {

                        if (prevselected[1] == $(this).val()) {
                            $(this).prop('selected', true)
                        }
                    })

                }

            })


            $formGroups.slice(2).each(function() {
                topic = $(this).find('#activity_id').val()
                $(this).find('#activity_id').val('')
            })

            $formGroups.slice(2).hide();
            $formGroups.slice(0, 2).show();
        }
    });




    $(document).on('change', '#class_id', function(e) {
        //alert(0);
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
                // console.log(data);
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

        // $('#subject_id').html("");


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
                // console.log(data)
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.id + ">" + obj.name +
                        "</option>";
                });


                // $('#subject_id').append(div_data);

                $('.subjectclass').each(function() {
                    $(this).append(div_data);
                })

                // $('.selectpicker').multiselect();
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
                    // console.log(obj)
                    div_data += "<option value=" + obj.id + ">" + obj.name + " " +
                        "</option>";
                });
                ($div.parent().parent().find('#teacher_id')).append(div_data);
            }
        });
    });


});
</script>

<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
$(function() {

    $(".timepicker").timepicker({
        showInputs: false,
        defaultTime: false,
        explicitMode: false,
        minuteStep: 1
    });
});

$(document).ready(function() {
    var class_id = $('#class_id').val();
    var section_id = '<?php echo $section_id ?>';
    var subject_id = '';
    var teacher_id = '';

    getSectionByClass(class_id, section_id);
    getSubjectByClassandSection(class_id, section_id, subject_id);
    // getSubjectTeachers(class_id, section_id, subject_id,teacher_id);

});

$("#addcalendar_form").on('submit', (function(e) {

    e.preventDefault();
    $.ajax({
        url: "<?php echo site_url("admin/weeklycalendarnew/savecalendar") ?>",
        type: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {



            if (res.status == "fail") {

                var message = "";
                $.each(res.error, function(index, value) {

                    message += value;
                });
                errorMsg(message);

            } else {

                successMsg(res.message);

                window.location.reload(true);
            }
        }
    });
}));
$("#updatecalendar_form").on('submit', (function(e) {

    e.preventDefault();
    $.ajax({
        url: "<?php echo site_url("admin/weeklycalendarnew/updatecalendar") ?>",
        type: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {



            if (res.status == "fail") {

                var message = "";
                $.each(res.error, function(index, value) {

                    message += value;
                });
                errorMsg(message);

            } else {

                successMsg(res.message);

                window.location.reload(true);
            }
        }
    });
}));



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
                // console.log(data)
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
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>
<script type="text/javascript">
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

    if (pagetitle == "Dashboard") {

        viewtitle = 'agendaWeek';
    }

    function getSamePeriods() {
        $('.fc-event-container').each(function(index, element) {
            let eventcontent = $(element).find('.fc-title').html();

            let contentarray = eventcontent.split('<br>');

            const result = [];
            let previousTitle = "";

            contentarray.forEach(contentelement => {
                const [time, data] = contentelement.split(":");
                const [from, to] = time.split("-").map(value => value.trim());

                if (from && to && data) {
                    const title = data.trim();

                    if (title === previousTitle) {
                        result[result.length - 1].to = to;
                    } else {
                        const obj = {
                            from,
                            to,
                            title
                        };
                        result.push(obj);
                        previousTitle = title;
                    }
                }
            });
            const formattedResult = result.map(obj => `${obj.from} - ${obj.to} : ${obj.title}`).join(
                '<br>');
            $(element).find('.fc-title').html(formattedResult);


        });
        // console.log('data')
    }


    $calendar.fullCalendar({




        viewRender: function(view, element) {
            // We make sure that we activate the perfect scrollbar when the view isn't on Month
            //if (view.name != 'month'){
            //  $(element).find('.fc-scroller').perfectScrollbar();
            //}
            setTimeout(() => {

                getSamePeriods()
            }, 1500);
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
            url: base_url + 'admin/weeklycalendarnew/getcalendar',
            data: {
                section_id: "<?php echo $section_id ?>",
                class_id: "<?php echo $class_id ?>"
            },
            method: "POST",

        },



        eventRender: function(event, element) {


            // console.log(event)


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


            //var vformat = (app_time_format == 24 ? app_date_format + ' H:i' : app_date_format + ' g:i A');



            $("#input-field").val('');
            $("#desc-field").text('');
            $('#date-field-weekcalendar').val(d)
            $('#newEventModal').modal('show');


        },


    });


    function view_event(id) {

        $('#update_id_hidden').val(id)
        $('.teacher-div').show()

        $.ajax({
            url: base_url + 'admin/weeklycalendarnew/view_event/' + id,
            type: 'POST',
            dataType: "json",
            success: function(msg) {

                console.log(msg)
                // $('#viewEventModal').modal('show');
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
                        });

                    }
                }

                setTimeout(() => {

                    for (let key in msg) {
                        if (key.endsWith('_subject')) {
                            var teacher = key.replace(/subject/g, "teacher");
                            var activity = key.replace(/subject/g, "activity");


                            const $formGroups = $(`.${teacher}`).parent().parent().find(
                                '.form-group')

                            $formGroups.slice(1).find('.periodtype-radio').each(
                                function() {
                                    if ($(this).val() == 'class') {
                                        $(this).prop('checked', true)
                                    } else {
                                        $(this).prop('checked', false)

                                    }
                                })

                            $formGroups.slice(4).find('#activity_id').val()
                            $formGroups.slice(4).hide();
                            $formGroups.slice(2, 4).show();



                            if (msg[activity] != '' && msg[activity] != null) {
                                const $formGroups = $(`.${teacher}`).parent().parent().find(
                                    '.form-group')

                                $formGroups.slice(1).find('.periodtype-radio').each(
                                    function() {
                                        if ($(this).val() == 'other') {
                                            $(this).prop('checked', true)
                                        } else {
                                            $(this).prop('checked', false)

                                        }
                                    })

                                $formGroups.slice(4).find('#activity_id').val(msg[activity])
                                $formGroups.slice(4).show();
                                $formGroups.slice(2, 4).hide();
                            }

                            // if (($(`.${teacher}`).val() == '' || $(`.${teacher}`).val() ==
                            //         0) && (msg[activity] == '' || msg[activity] == null)) {


                            //     $(`.${teacher}`).parent().parent().hide()
                            // }


                        }
                    }
                    $('#viewEventModal').modal('show');
                }, 1200);
            }
        });


    }


    function getTeachersBySubject(id, key, teacherid) {


        let $div = $(`.${key}`);
        ($div.parent().parent().find('#teacher_id')).html("");

        var subject_id = id;

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


                    var sel = "";
                    if (teacherid == obj.id) {
                        sel = "selected";
                    } else {
                        sel = "";

                    }

                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name +
                        " " +
                        "</option>";
                });
                ($div.parent().parent().find('#teacher_id')).append(div_data);
            }
        });
    }



});



$(document).ready(function() {


    $(document).on('click', '.close', function() {
        // window.location.reload()
    })

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

$(document).ready(function() {
    $('#multiple-period-checkbox').on('change', function() {
        const isChecked = $(this).prop('checked');
        const otherRadio = $('input[type="radio"][value="other"]');
        const teacherSection = $('.form-group.col-md-6');
        const activitySection = $('.form-group.col-md-12');

        if (isChecked) {
            otherRadio.prop('checked', true);
            teacherSection.hide(); // Hide the "Teacher" section
            activitySection.show(); // Show the "Activity" section
            $('.activityclass').val('Holiday')
        } else {
            // If you want to uncheck the "Other" radio when the checkbox is unchecked, add this line:
            // otherRadio.prop('checked', false);
            teacherSection.show(); // Show the "Teacher" section
            activitySection.show(); // Hide the "Activity" section
        }
    });
});





</script>