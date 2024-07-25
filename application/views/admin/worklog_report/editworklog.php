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
                               Work Log
                            </h3>
                        </div>
                        <div class="box-body">
 


                            <?php 
                                $worklog = json_decode($log['log']);
                                
                            ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="container w-100">

                                <div class="wrapping-container">
                                    <input type="hidden" name="workid[]" value="<?php echo 0 ?>">
                                    <div class="row" style='display: flex;align-items: flex-end;width:111%'>

                                        <div class="col-md-11">
                                            <label
                                                for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
                                            <div class="input-group">
                                                <input name="date[]" placeholder="" type="text"
                                                    class="form-control date"
                                                    value="<?php echo $log['date'] ?>" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                            </div>


                                        </div>


                                        

                                    </div>




                                    <?php
                                    $logcount = 0;

                                    
                                    foreach ($worklog as $key => $value) {
                                          
                                      ?>

                                    <div class="plan-row">

                                        <div class="row"
                                            style='margin-top: 20px;width: 100%;margin-left: 2px;display: flex;align-items: flex-end;'>


                                            <div class="col-md-2">
                                                <div class="bootstrap-timepicker">
                                                    <label for="exampleInputEmail1">From</label>

                                                    <div class="input-group">
                                                        <input type="text" name="timefrom[0][]"
                                                            class="form-control timepicker stime" id="stime_"
                                                            value="<?php echo $value->timefrom; ?>">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="bootstrap-timepicker">
                                                    <label for="exampleInputEmail1">To</label>

                                                    <div class="input-group">
                                                        <input type="text" name="timeto[0][]"
                                                            class="form-control timepicker stime" id="stime_"
                                                            value="<?php echo $value->timeto; ?>">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">

                                                <label for="exampleInputEmail1">Type</label>

                                                <select name="worktype[0][]" id="worktype" class='form-control'>
                                                    <option value="0">Class </option>
                                                    <option value="1">Other</option>
                                                </select>
                                            </div> 
                                            <div class="col-md-2 classlist">
                                                
                                                    <label
                                                        for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                                    <select autofocus="" id="class_id" name="class_id[0][]"
                                                        class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select'); ?>
                                                        </option>
                                                        <?php
                                                        foreach ($classlist as $class) {
                                                            ?>
                                                                    <option value="<?php echo $class['id'] ?>"
                                                                        <?php if (($value->class_id) == $class['id']) echo "selected=selected"; ?>>
                                                                        <?php echo $class['class'] ?></option>
                                                                    <?php
                                                           
                                                        }
                                                        ?>
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo form_error('class_id'); ?></span>
                                           
                                            </div>
                                            <div class="col-md-2 classlist" >
                                                
                                                    <label
                                                        for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                                    <select id="section_id" name="section_id[0][]" class="form-control">
                                                    <?php
                                                        foreach (getSectionByClass($value->class_id) as $section) {
                                                            ?>
                                                                    <option value="<?php echo $section['section_id'] ?>"
                                                                        <?php if (($value->section_id) == $section['section_id']) echo "selected=selected"; ?>>
                                                                        <?php echo $section['section'] ?></option>
                                                                    <?php
                                                           
                                                        }
                                                        ?> 
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo form_error('section_id'); ?></span>
                                                
                                            </div>
                                            <div class="col-md-2 classlist" >
                                            
                                                    <label
                                                        for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label>
                                                    <select id="subject_id" name="subject_id[0][]" class="form-control">
                                                    <?php
                                                        foreach (getSubjectBySection($value->section_id) as $subject) {
                                                            ?>
                                                                    <option value="<?php echo $subject->id ?>"
                                                                        <?php if (($value->subject_id) == $subject->id) echo "selected=selected"; ?>>
                                                                        <?php echo $subject->name ?></option>
                                                                    <?php
                                                           
                                                        }
                                                        ?> 
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                               

                                            </div> 


                                            <div class="col-md-2">

                                                <label for="exampleInputEmail1">Remarks</label>

                                                <textarea id="stopic" name="worktopic[0][]" 
                                                    class="form-control"><?php echo $value->worktopic; ?></textarea>
                                            </div>

                                         
                                             
                                        </div>


                                    </div>

                                    <?php $logcount++;}?>

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

    $(document).on('change','#worktype',(e)=>{
        let value= e.target.value;
         console.log( $(e.target).parent())
        if(value==1){
            $(e.target).closest('.row').find('.classlist').hide()
        }else{
            $(e.target).closest('.row').find('.classlist').show()

        }
    })
    $(document).on('click', '.btnAdd', function(e) {
        e.preventDefault()


        var data = '';
        var id = $(this).data('planid');
        var plan = $(this).closest('.plan-row');
        data += ` 
        <div class="row" style='margin-top: 20px;width: 100%;margin-left: 2px;display: flex;align-items: flex-end;'>


                                            <div class="col-md-2">
                                                <div class="bootstrap-timepicker">
                                                    <label for="exampleInputEmail1">From</label>

                                                    <div class="input-group">
                                                        <input type="text" name="timefrom[0][]"
                                                            class="form-control timepicker stime" id="stime_"
                                                            value="<?php echo '01:00 AM'; ?>">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="bootstrap-timepicker">
                                                    <label for="exampleInputEmail1">To</label>

                                                    <div class="input-group">
                                                        <input type="text" name="timeto[0][]"
                                                            class="form-control timepicker stime" id="stime_"
                                                            value="<?php echo '01:00 AM'; ?>">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">

                                                <label for="exampleInputEmail1">Type</label>

                                                <select name="worktype[0][]" id="worktype" class='form-control'>
                                                    <option value="0">Class </option>
                                                    <option value="1">Other</option>
                                                </select>
                                            </div> 
                                            <div class="col-md-2 classlist">
                                                
                                                    <label
                                                        for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                                    <select autofocus="" id="class_id" name="class_id[0][]"
                                                        class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select'); ?>
                                                        </option>
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
                                                    <span
                                                        class="text-danger"><?php echo form_error('class_id'); ?></span>
                                           
                                            </div>
                                            <div class="col-md-2 classlist" >
                                                
                                                    <label
                                                        for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                                    <select id="section_id" name="section_id[0][]" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select'); ?>
                                                        </option>
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo form_error('section_id'); ?></span>
                                                
                                            </div>
                                            <div class="col-md-2 classlist" >
                                                
                                                    <label
                                                        for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label>
                                                    <select id="subject_id" name="subject_id[0][]" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select'); ?>
                                                        </option>
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                               

                                            </div> 


                                            <div class="col-md-2">

                                                <label for="exampleInputEmail1">Remarks</label>

                                                <textarea id="stopic" name="worktopic[0][]"
                                                    class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-1">


                                                <button id="btnAdd" data-planid="0"
                                                    class="btn btn-success btn-sm checkbox-toggle btnAdd"
                                                    style="background-color: #085d35fc !important;display: block;"
                                                    type="button"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                            <div class="col-md-1">

                                            <button class="btn btn-success btn-sm checkbox-toggle   btnremove"
                                            style="background-color: #af2f2f !important;display: block;"
                                            type="button"><i class="fa fa-trash"></i></button>
                                            
                                            </div>
                                            
                                        </div>

        `;

        plan.append(data);



    });

    $(document).on('click', '.btnremove', function(e) {

        $(this).parent().parent().remove();

    }); 

   




    $(document).on('change', '#class_id', function(e) {
        //alert(0);
        $(e.target).closest('.row').find('#section_id').html("");
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
                $(e.target).closest('.row').find('#section_id').append(div_data);
            }
        });
    });





    $(document).on('change', '#section_id', function(e) {
        // console.log( $(e.target).closest('.row'))

        $(e.target).closest('.row').find('#subject_id').html("");
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
                $(e.target).closest('.row').find('#subject_id').append(div_data);
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

    $('body').on('focus',".timepicker", function(){

    $(this).timepicker({
        showInputs: false,
        defaultTime: false,
        explicitMode: false,
        minuteStep: 1
    });
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