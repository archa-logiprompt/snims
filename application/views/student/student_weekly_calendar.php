<style>
select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: none;
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
                                        <form role="form" id="updatecalendar_form" method="post"
                                            enctype="multipart/form-data"
                                            action="<?php echo base_url().'admin/weeklycalendarnew/updatecalendar' ?>">


                                            <input type="hidden" name='hidden_class' value="<?php echo $class_id?>">
                                            <input type="hidden" name='hidden_section' value="<?php echo $section_id?>">
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
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_one" class="period-label"><?php echo "$period_list->period_one_from - $period_list->period_one_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass eight_to_nine_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control eight_to_nine_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_two" class="period-label"><?php echo "$period_list->period_two_from - $period_list->period_two_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass nine_to_ten_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control nine_to_ten_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_three" class="period-label"><?php echo "$period_list->period_three_from - $period_list->period_three_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass ten_to_eleven_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control ten_to_eleven_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>

                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_four" class="period-label"><?php echo "$period_list->period_four_from - $period_list->period_four_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass eleven_to_twelve_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control eleven_to_twelve_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_five" class="period-label"><?php echo "$period_list->period_five_from - $period_list->period_five_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass twelve_to_one_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control twelve_to_one_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_six" class="period-label"><?php echo "$period_list->period_six_from - $period_list->period_six_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass two_to_three_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control two_to_three_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_seven" class="period-label"><?php echo "$period_list->period_seven_from - $period_list->period_seven_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass three_to_four_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control three_to_four_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

                                                </div>
                                            </div>
                                            <div class="teacher-div">
                                                <div class="form-group col-md-12 text-center">
                                                    <label for="exampleInputEmail1" id="period_eight" class="period-label"><?php echo "$period_list->period_eight_from - $period_list->period_eight_to"?></label>

                                                </div>

                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Subject</label>
                                                    <select id="subject_id" disabled name="subject_id[]"
                                                        class="form-control subjectclass four_to_five_subject">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                <div class="form-group col-md-6">

                                                    <label for="exampleInputEmail1">Teacher</label>

                                                    <select id="teacher_id" disabled name="teacher_id[]"
                                                        class="form-control four_to_five_teacher">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('title'); ?></span>

                                                </div>
                                                 <div class="form-group col-md-12" style="display:none">

                                                    <label for="exampleInputEmail1">Activity</label>
                                                    <input type="text" readonly id="activity_id"
                                                        class="form-control" >
                                                    <span
                                                        class="text-danger"><?php echo form_error('Activity'); ?></span>

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
        </div>


    </section>
</div>

<script type="text/javascript">
$(document).ready(function() {




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
                console.log(data);
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
                console.log(data)
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
                    console.log(obj)
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
    var section_id = '<?php echo $section_id?>';
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

    console.log('hello')
    if (class_id != "" && section_id != "") {
        $('.subjectclass').each(function() {
            $(this).html('')
        })
        var class_id = '<?php echo $class_id ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value="">Select</option>';
        $.ajax({
            type: "POST",
            url: base_url + "user/weeklycalendarstudent/getSubjctByClassandSectionnew",
            data: {
                'class_id': class_id,
                'section_id': section_id
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
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
            url: base_url + 'user/weeklycalendarstudent/getcalendar',
            data: {
                section_id: "<?php echo $section_id?>",
                class_id: "<?php echo $class_id?>"
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
            url: base_url + 'user/weeklycalendarstudent/view_event/' + id,
            type: 'POST',
            dataType: "json",
            success: function(msg) {


                $period_labels = $('.period-label'); 
                $period_labels.each(function(){
                    
                    $(this).text(msg[$(this).attr('id')])
                 })

                
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
                                // console.log($(this).val())
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


                            // const $formGroups = $(`.${teacher}`).parent().parent().find(
                            //         '.form-group')

                                 

                                // $formGroups.slice(4).find('#activity_id').val()
                                // $formGroups.slice(4).hide();
                                // $formGroups.slice(2, 4).show();



                            if (msg[activity] != '' && msg[activity] != null) {
                                const $formGroups = $(`.${teacher}`).parent().parent().find(
                                    '.form-group')

                               

                                $formGroups.slice(3).find('#activity_id').val(msg[activity])
                                $formGroups.slice(3).show();
                                $formGroups.slice(1, 3).hide();
                            }

                            if (($(`.${teacher}`).val() == '' || $(`.${teacher}`).val() ==
                                    0) && (msg[activity] == '' || msg[activity] == null)) {


                                $(`.${teacher}`).parent().parent().hide()
                            }

                            
                          
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
            url: base_url + "user/weeklycalendarstudent/get_subjectteachers",
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