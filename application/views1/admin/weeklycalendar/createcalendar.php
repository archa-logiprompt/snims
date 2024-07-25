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
                        action="<?php echo site_url('admin/weeklycalendar/create') ?>">
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
                                            <option value="<?php echo $class['id'] ?>"
                                                <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>>
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


                <?php 
                if(!$isupdate && $issearch){

                
                ?>
                <form role="form" id="" class="addmarks-form" method="post"
                    action="<?php echo site_url('admin/weeklycalendar/create') ?>">


                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i>
                                <?php echo $this->lang->line('class_timetable'); ?></h3>
                        </div>
                        <div class="box-body">


                            <input type="hidden" name="class_id" value="<?php echo $class_id ?>">
                            <input type="hidden" name="section_id" value="<?php echo $section_id ?>">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="container w-100">

                                <div class="wrapping-container">
                                    <input type="hidden" name="planid[]" value="<?php echo 0 ?>">
                                    <div class="row" style='display: flex;align-items: flex-end;width:111%'>

                                        <div class="col-md-5">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
                                            <div class="input-group">
                                                <input name="datefrom[]" placeholder="" type="text"
                                                    class="form-control date"
                                                    value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-5">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?></label>
                                            <div class="input-group">
                                                <input name="dateto[]" placeholder="" type="text"
                                                    class="form-control date"
                                                    value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" />

                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-1">


                                            <button class="btn btn-success btn-sm checkbox-toggle pull-right btnAddWeek"
                                                style="background-color: #085d35fc !important;display: block;"
                                                type="button"><i class="fa fa-plus"></i> Add</button>
                                        </div>

                                    </div>



                                    <div class="plan-row">

                                        <div class="row"
                                            style='margin-top: 20px;width: 100%;margin-left: 2px;display: flex;align-items: flex-end;'>


                                            <div class="col-md-10">

                                                <label for="exampleInputEmail1">Plan</label>

                                                <textarea id="stopic" name="plan[0][]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-2">


                                                <button id="btnAdd" data-planid='0'
                                                    class="btn btn-success btn-sm checkbox-toggle pull-right btnAdd"
                                                    style="background-color: #085d35fc !important;display: block;"
                                                    type="button"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <input type="submit" class="btn btn-primary pull-right" name="search" value="Save"></input>

                        </div>
                    </div>
                </form>
                <?php } ?>


                <!-- To Update -->
                <?php 
                if($isupdate){

                
                    $weekplan = (json_decode($weekcalendar[0]['plan']));
                  
                ?>



                <form role="form" id="" class="addmarks-form" method="post"
                    action="<?php echo site_url('admin/weeklycalendar/create') ?>">

                    <input type="hidden" name="hiddenplanid" value="<?php echo$weekcalendar[0]['id']  ?>">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i>
                                <?php echo $this->lang->line('class_timetable'); ?></h3>
                        </div>
                        <div class="box-body">



                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="container w-100">
                                <?php
                           $i=0;
                           foreach ($weekplan as $key => $value) {?>
                                <div class="wrapping-container">
                                    <input type="hidden" name="planid[]" value="<?php echo $i ?>">
                                    <div class="row" style='display: flex;align-items: flex-end;width:111%'>

                                        <div class="col-md-5">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
                                            <div class="input-group">
                                                <input name="datefrom[<?php echo $i ?>]" type="text"
                                                    class="form-control date"
                                                    value="<?php echo set_value('date', $value->datefrom); ?>" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-5">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?></label>
                                            <div class="input-group">
                                                <input name="dateto[<?php echo $i ?>]" type="text"
                                                    class="form-control date"
                                                    value="<?php echo set_value('date', date($value->dateto)); ?>" />

                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-1">


                                            <button class="btn btn-success btn-sm checkbox-toggle pull-right btnAddWeek"
                                                style="background-color: #085d35fc !important;display: block;"
                                                type="button"><i class="fa fa-plus"></i> Add</button>

                                        </div>
                                        <div class="col-md-1">

                                            <button
                                                class="btn btn-success btn-sm checkbox-toggle pull-right btnRemoveWeek"
                                                style="background-color: #af2f2f !important;display: block;"
                                                type="button"><i class="fa fa-trash"></i>Remove</button>
                                        </div>

                                    </div>

                                    <?php foreach ($value->plan as $plankey => $planvalue) { ?>

                                    <div class="plan-row">

                                        <div class="row"
                                            style='margin-top: 20px;width: 100%;margin-left: 2px;display: flex;align-items: flex-end;'>


                                            <div class="col-md-10">

                                                <label for="exampleInputEmail1">Plan</label>

                                                <textarea id="stopic" name="plan[<?php echo $i ?>][]"
                                                    class="form-control"><?php echo $planvalue ?></textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <button id="btnAdd" data-planid="<?php echo $i ?>"
                                                    class="btn btn-success btn-sm checkbox-toggle pull-right btnAdd"
                                                    style="background-color: #085d35fc !important;display: block;"
                                                    type="button"><i class="fa fa-plus"></i> Add</button>
                                            </div>

                                            <div class="col-md-1">

                                                <button
                                                    class="btn btn-success btn-sm checkbox-toggle pull-right btnremove"
                                                    style="background-color: #af2f2f !important;display: block;"
                                                    type="button"><i class="fa fa-trash"></i> Remove</button>

                                            </div>
                                        </div>


                                    </div>
                                    <?php }?>

                                </div>
                                <?php $i++;
                            $weekcalendarid = $weekcalendar[0]['id'];
                            }?>

                            </div>
                            <a href='<?php echo site_url("admin/weeklycalendar/delete/$weekcalendarid") ?>'
                                style="margin-top :70px" class="btn btn-danger pull-right"> <i class="fa fa-trash"></i>
                            </a>
                            <input type="submit" class="btn btn-primary pull-right"
                                style="margin-top :70px;margin-right:20px" name="search" value="Update"></input>

                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>

    </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
    <?php 
       if(!$isupdate){ ?>
    let wrapid = 0;
    <?php } ?>
    <?php if($isupdate){ ?>
    let wrapid = <?php echo  $i-1?>;
    <?php } ?>
    var date_format =
        '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
    $('body').on('focus', ".date", function() {
        $(this).datepicker({
            format: date_format,
            autoclose: true
        });
    });

    //$('.selectpicker').multiselect();
    $(document).on('click', '.btnAdd', function(e) {
        e.preventDefault()


        var data = '';
        var id = $(this).data('planid');
        var plan = $(this).closest('.plan-row');
        data += ` <div class="row"  
                    style='margin-top: 20px;width: 100%;margin-left: 2px;display: flex;align-items: flex-end;'>

                    <div class="col-md-10">

                        <label for="exampleInputEmail1">Plan</label>

                        <textarea id="stopic" name="plan[` + id + `][]" class="form-control"> </textarea>
                    </div>

                    <div class="col-md-1">


                        <button  
                            class="btn btn-success btn-sm checkbox-toggle pull-right btnAdd"
                            style="background-color: #085d35fc !important;display: block;"
                            type="button" data-planid="` + id + `"><i class="fa fa-plus"></i> Add</button>
                            
                    </div>

                    <div class="col-md-1">


                        <button  
                            class="btn  btn-success btn-sm checkbox-toggle pull-right btnremove"
                            style="background-color: #af2f2f !important;display: block;"
                            type="button"><i class="fa fa-trash"></i> Remove</button>
                            
                    </div>



                </div>`;

        plan.append(data);



    });

    $(document).on('click', '.btnremove', function(e) {

        $(this).parent().parent().remove();

    });
    $(document).on('click', '.btnAddWeek', function(e) {
        e.preventDefault()

        wrapid++
        var data = '';
        var plan = $(this).closest('.container');


        data += `  
        
        <div class='wrapping-container'>


        <input type="hidden"  name="planid[]" value="` + wrapid + `">

        <div class="row"  style='display: flex;align-items: flex-end;width: 111%;margin-top:20px'>

                                        <div class="col-md-5">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
                                            <div class="input-group">
                                                <input  name="datefrom[` + wrapid + `]" placeholder="" type="text"
                                                    class="form-control date"
                                                    value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-5">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?></label>
                                            <div class="input-group">
                                                <input  name="dateto[` + wrapid + `]" placeholder="" type="text"
                                                    class="form-control date"
                                                    value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" />

                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-1">

                                        <button  
                                            class="btn btn-success btn-sm checkbox-toggle pull-right btnAddWeek"
                                            style="background-color: #085d35fc !important;display: block;"
                                            type="button" ><i class="fa fa-plus"></i> Add</button>
                                        </div>

                                        <div class="col-md-1">


                                        <button  
                                            class="btn btn-success btn-sm checkbox-toggle pull-right btnRemoveWeek"
                                            style="background-color: #af2f2f !important;display: block;"
                                            type="button"><i class="fa fa-trash"></i>Remove</button>
                                        </div>
                                    </div> 
                                    <div class="plan-row">

                                        <div class="row"
                                            style='margin-top: 20px;width: 100%;margin-left: 2px;display: flex;align-items: flex-end;'>


                                            <div class="col-md-10">

                                                <label for="exampleInputEmail1">Plan</label>

                                                <textarea id="stopic" name="plan[` + wrapid + `][]" class="form-control"> </textarea>
                                            </div>

                                            <div class="col-md-2">


                                                <button id="btnAdd" data-planid="` + wrapid + `"
                                                    class="btn btn-success btn-sm checkbox-toggle pull-right btnAdd"
                                                    style="background-color: #085d35fc !important;display: block;"
                                                    type="button"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </div>

                                        </div>
                                    </div>`;

        plan.append(data);



    });

    $(document).on('click', '.btnRemoveWeek', function(e) {

        $(this).parent().parent().parent().remove();

    });



    $(document).on('change', '.stime', function(e) {
        var stime = $(this).val();
        var day = $(this).parent().parent().parent().parent().parent().find('.edit_day').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var subject_id = $('#subject_id').val();
        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/timetable/check_exists",
            data: {
                'stime': stime,
                'day': day,
                'class_id': class_id,
                'section_id': section_id,
                'subject_id': subject_id
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                //$('#teacher_id').append(div_data);
            }
        });
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

        $('#subject_id').html("");
        var section_id = $(this).val();
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "POST",
            url: base_url + "admin/teacher/getSubjctBySection",
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
                $('#subject_id').append(div_data);
                $('.selectpicker').multiselect();
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
    var section_id = '<?php echo set_value('section_id') ?>';
    var subject_id = '<?php echo set_value('subject_id') ?>';
    var department_id = '<?php echo set_value('department_id') ?>';

    getSectionByClass(class_id, section_id);
    // getSubjectByClassandSection(class_id, section_id, subject_id);
    // getSubjctBySection(class_id, section_id, subject_id);
    // getSubjectDepartment(class_id, section_id, subject_id,department_id);

});

function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
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
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>