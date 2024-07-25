<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style>
    .checkbox label {
        display: block;
        margin-right: 10px;
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i>
            <?php echo $this->lang->line('fees_collection'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>
                            <?php echo $this->lang->line('select_criteria'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="<?php echo site_url('admin/feemaster/hostelassign/' . $id) ?>"
                            method="post" class="form-horizontal">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label>
                                        <?php echo $this->lang->line('class'); ?>
                                    </label>
                                    <select autofocus="" id="class_id" name="class_id" class="form-control">
                                        <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                            <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id'])
                                                   echo "selected=selected" ?>>
                                                <?php echo $class['class'] ?>
                                            </option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger">
                                        <?php echo form_error('class_id'); ?>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <label>
                                        <?php echo $this->lang->line('section'); ?>
                                    </label>
                                    <select id="section_id" name="section_id" class="form-control">
                                        <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        <?php echo form_error('section_id'); ?>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <label>
                                        <?php echo $this->lang->line('category'); ?>
                                    </label>
                                    <select id="category_id" name="category_id" class="form-control">
                                        <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                        <?php
                                        foreach ($categorylist as $category) {
                                            ?>
                                            <option value="<?php echo $category['id'] ?>" <?php if (set_value('category_id') == $category['id'])
                                                   echo "selected=selected"; ?>>
                                                <?php echo $category['category'] ?>
                                            </option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>
                                        <?php echo $this->lang->line('gender'); ?>
                                    </label>
                                    <select class="form-control" name="gender">
                                        <option value="">
                                            <?php echo $this->lang->line('select'); ?>
                                        </option>
                                        <?php
                                        foreach ($genderList as $key => $value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key)
                                                   echo "selected"; ?>>
                                                <?php echo $value; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="col-sm-2">
                                    <label><?php echo $this->lang->line('rte'); ?></label>
                                    <select  id="rte" name="rte" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($RTEstatusList as $k => $rte) {
                                            ?>
                                            <option value="<?php echo $k; ?>" <?php if (set_value('rte') == $k)
                                                   echo "selected"; ?>><?php echo $rte; ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div> -->
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter"
                                        class="btn btn-primary pull-right btn-sm checkbox-toggle"><i
                                            class="fa fa-search"></i>
                                        <?php echo $this->lang->line('search'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <form method="post" action="<?php echo site_url('studentfee/addhostelfeegroup') ?>" id="assign_form">


                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="box box-info">

                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-users"></i>
                                    <?php echo $this->lang->line('assign_fees_group'); ?>
                                    </i>
                                    <?php echo form_error('student'); ?>
                                </h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">

                                    <div class="col-md-12">


                                        <div class="col-md-4">

                                            <div class="table-responsive">
                                                <?php

                                                foreach ($feegroupList as $feegroup) {
                                                    ?>
                                                    <h4>
                                                        <input type="hidden" name="fee_session_groups"
                                                            value="<?php echo $feegroup->id; ?>">
                                                        <a href="#" data-toggle="popover" class="detail_popover">
                                                            <?php echo $feegroup->group_name; ?>
                                                        </a>
                                                    </h4>
                                                    <table class="table">
                                                        <tbody>
                                                            <?php
                                                            if (empty($feegroup->feetypes)) {
                                                                ?>

                                                                <td colspan="5" class="text-danger text-center">
                                                                    <?php echo $this->lang->line('no_record_found'); ?>
                                                                </td>
                                                                <?php
                                                            } else {
                                                                
                                                                // var_dump($feegroup->feetypes);
    
                                                                foreach ($feegroup->feetypes as $feetype_key => $feetype_value) {
                                                                    ?>
                                                                    <tr class="mailbox-name">
                                                                        <td>
                                                                            <?php echo $feetype_value->code; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $currency_symbol . $feetype_value->amount; ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <input type="hidden" name="hostel_room" value="<?php echo $id ?>">
                                                                                        <input type="hidden" name="hostel_room_nos" value="<?php echo $hostelroomnumber ?>" id="hostel_room_nos">

                                            <input type="hidden" name="feegroupname"
                                                value="<?php echo $feegroupList[0]->group_name; ?>">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="select-all-months"> Yearly
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="january"
                                                        class='collected_in'> January
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="february"
                                                        class='collected_in'> February
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="march"
                                                        class='collected_in'> March
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="april"
                                                        class='collected_in'> April
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="may" class='collected_in'>
                                                    May
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="june"
                                                        class='collected_in'> June
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="july"
                                                        class='collected_in'> July
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="august"
                                                        class='collected_in'> August
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="september"
                                                        class='collected_in'> September
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="october"
                                                        class='collected_in'> October
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="november"
                                                        class='collected_in'> November
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="months[]" value="december"
                                                        class='collected_in'> December
                                                </label>
                                            </div>


                                            <!-- <button type="button" class="check-month btn btn-primary btn-sm pull-right"
                                                id="load"
                                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">
                                                Check
                                            </button> -->

                                        </div>
                                        <div class="col-md-8">
                                            <div class=" table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th><input type="checkbox" id="select_all" />
                                                                <?php echo $this->lang->line('all'); ?>
                                                            </th>

                                                            <th>
                                                                <?php echo $this->lang->line('admission_no'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('student_name'); ?>
                                                            </th>

                                                            <th>
                                                                <?php echo $this->lang->line('class'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('father_name'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('category'); ?>
                                                            </th>
                                                            <th>
                                                                <?php echo $this->lang->line('gender'); ?>
                                                            </th>

                                                        </tr>
                                                        <?php
                                                        if (empty($resultlist)) {
                                                            ?>
                                                            <tr>
                                                                <td colspan="7" class="text-danger text-center">
                                                                    <?php echo $this->lang->line('no_record_found'); ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        } else {
                                                            $count = 1;
                                                            foreach ($resultlist as $student) {

                                                                ?>
                                                                <tr>

                                                                    <td>
                                                                        <?php
                                                                        if ($student['student_fees_master_id'] != 0) {
                                                                            $sel = "checked='checked'";
                                                                        } else {
                                                                            $sel = "";
                                                                        }
                                                                        ?>
                                                                        <input class="checkbox" type="checkbox"
                                                                            name="student_session_id[]"
                                                                            value="<?php echo $student['student_session_id']; ?>"  />
                                                                        <input type="hidden"
                                                                            name="student_fees_master_id_<?php echo $student['student_session_id']; ?>"
                                                                            value="<?php echo $student['student_fees_master_id']; ?>">
                                                                        <input type="hidden" name="student_ids[]"
                                                                            value="<?php echo $student['student_session_id']; ?>">
                                                                        <input type="hidden"
                                                                            name="student_id_<?php echo $student['student_session_id']; ?>"
                                                                            value="<?php echo $student['id']; ?>">
                                                                    </td>

                                                                    <td>
                                                                        <?php echo $student['admission_no']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $student['class'] . "(" . $student['section'] . ")" ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $student['father_name']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $student['category']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $student['gender']; ?>
                                                                    </td>

                                                                </tr>
                                                                <?php
                                                            }
                                                            $count++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <button type="button" class="remove-fees btn btn-danger btn-sm remove_students" id="load"
                                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">
                                                Remove
                                            </button>

                                            <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right"
                                                id="load"
                                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">
                                                <?php echo $this->lang->line('save'); ?>
                                            </button>


                                            <br />
                                            <br />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>

        </div>

    </section>
</div>

<script>
    $(document).ready(function () {
        // Get the "Select All" checkbox
        var selectAllCheckbox = $('#select-all-months');

        // Get all individual month checkboxes
        var monthCheckboxes = $('.collected_in');

        // Add event listener to the "Select All" checkbox
        selectAllCheckbox.change(function () {
            // Toggle the state of all individual checkboxes based on the state of the "Select All" checkbox
            monthCheckboxes.prop('checked', $(this).prop('checked'));
            // Trigger change event on each checkbox
            $('.collected_in').trigger('change');
        });
    });
</script>
<script type="text/javascript">

    //select all checkboxes
    $("#select_all").change(function () {  //"select all" change 
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });

    //".checkbox" change 
    $('.checkbox').change(function () {
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if (false == $(this).prop("checked")) { //if this item is unchecked
            $("#select_all").prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $("#select_all").prop('checked', true);
        }
    });

    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: { 'class_id': class_id },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }

    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
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
    });



    $('[name="student_session_id[]"]').change(function (e) {

        let numberofbeds = $('#hostel_room_nos').val()
        
        var checkedCount = $('[name="student_session_id[]"]:checked').length;
      
        if (checkedCount >= numberofbeds) {
            $('input[type="checkbox"]:not(:checked)').prop('disabled', true);
        } else {
            $('input[type="checkbox"]:not(:checked)').prop('disabled', false);
        }

    });


    $(".collected_in").change(function (e) {
        $('[name="student_session_id[]"]').prop('checked', false);


        let selectedMonths = $('[name="months[]"]:checked');


        let hostelId = $('[name="hostel_room"]').val();
        let base_url = '<?php echo base_url() ?>';

        // Convert selected checkboxes to an array of values
        let selectedMonthsArray = selectedMonths.map(function () {
            return this.value;
        }).get();

        if (selectedMonthsArray.length != 0) {

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: base_url + "Studentfee/checkStudentHostelMonths",
                data: { 'months': JSON.stringify(selectedMonthsArray), 'hostelid': hostelId },
                success: function (data) {

                    data.forEach(element => {

                        var months = element.months;
                        months = months.split(',')

                        if (assignDoesExist(months, selectedMonthsArray)) {

                            var student_session_ids = element.student_session_ids
                            student_session_ids = student_session_ids.split(',')

                            student_session_ids.forEach(student_session_id => {

                                var checkbox = $('[name="student_session_id[]"][value="' + student_session_id + '"]');
                                if (checkbox.length > 0) {
                                    checkbox.prop('checked', true);
                                }
                            });


                        }

                    });

                }

            });
        }

    });

    function assignDoesExist(array1, array2) {

        if (array1.length !== array2.length) {
            return false;
        }

        const sortedArray1 = array1.slice().sort();
        const sortedArray2 = array2.slice().sort();

        for (let i = 0; i < sortedArray1.length; i++) {
            if (sortedArray1[i] !== sortedArray2[i]) {
                return false;
            }
        }
        return true;
    }


    $("#assign_form").submit(function (e) {
        e.preventDefault();
        let selectedmonths = ($('[name="months[]"]:checked').length)
        let selectedstudents = ($('[name="student_session_id[]"]:checked').length)

        if (selectedmonths == 0) {
            errorMsg('Select at least a month');
            return false;

        }
        if (selectedstudents == 0) {
            errorMsg('Select at least a student');
            return false;

        }

        if (confirm('Are you sure?')) {
            var $this = $('.allot-fees');
            $this.button('loading');
            $.ajax({
                type: "POST",
                dataType: 'Json',
                url: $("#assign_form").attr('action'),
                data: $("#assign_form").serialize(), // serializes the form's elements.
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                    }

                    $this.button('reset');
                }
            });

        }


    });
    $(".remove_students").on('click',function (e) {
        console.log('gfds');
        let selectedmonths = ($('[name="months[]"]:checked').length)
        let selectedstudents = ($('[name="student_session_id[]"]:checked').length)

        if (selectedmonths == 0) {
            errorMsg('Select at least a month');
            return false;

        }
        if (selectedstudents == 0) {
            errorMsg('Select at least a student');
            return false;

        }

        if (confirm('Are you sure?')) {
            var $this = $('.remove-fees');
            $this.button('loading');
            $.ajax({
                type: "POST",
                dataType: 'Json',
                url: base_url + "Studentfee/removeHostelAssign",
                data: $("#assign_form").serialize(), // serializes the form's elements.
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg('Successfully removed student');
                    }

                    $this.button('reset');
                }
            });

         }


    });


</script>