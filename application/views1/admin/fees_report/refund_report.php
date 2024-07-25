<?php

$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i>
            <?php echo $this->lang->line('mess'); ?>
            <?php echo $this->lang->line('fees_collection'); ?> <small>
                <?php echo $this->lang->line('filter_by_name1'); ?>
            </small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!--<div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php //echo $this->lang->line('select_criteria'); ?></h3>
                    </div>-->
                    <form action="<?php echo site_url('studentfee/refund_report') ?>" method="post"
                        accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                 
                                <div class="col-sm-6">
                                    <label>
                                        <?php echo $this->lang->line('date_from'); ?>
                                    </label>
                                    <input autofocus="" id="datefrom" name="date_from" placeholder="" type="text"
                                        class="form-control date"
                                        value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>"
                                        readonly="readonly" />
                                    <span class="text-danger">
                                        <?php echo form_error('date_from'); ?>
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <label>
                                        <?php echo $this->lang->line('date_to'); ?>
                                    </label>
                                    <input id="dateto" name="date_to" placeholder="" type="text"
                                        class="form-control date"
                                        value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>"
                                        readonly="readonly" />
                                </div>


                            </div>
                        </div>
                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i>
                                <?php echo $this->lang->line('search'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($refund_data)) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info" id="transfee">
                                <div class="box-header ptbnull">
                                    <h3 class="box-title titlefix"><i class="fa fa-users"></i>
                                        <?php echo $this->lang->line('balance_fees_report'); ?>
                                    </h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <div class="download_label">
                                        <?php echo $this->Setting_model->getCurrentSchoolName(); ?></br>
                                        <?php echo $this->lang->line('balance_fees_report'); ?>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover example">
                                        <thead>
                                            <tr>
                                                <th class="text text-left">
                                                    <?php echo $this->lang->line('student_name'); ?>
                                                </th>
                                                <th class="text text-left">
                                                    <?php echo $this->lang->line('admission_no'); ?>
                                                </th> 
                                                <th class="text text-left">
                                                    <?php echo 'Details'; ?>
                                                </th>
                                                <th class="text text-left">
                                                    <?php echo 'Mode'; ?>
                                                </th>
                                                <th class="text text-left">
                                                    <?php echo 'Refund By'; ?>
                                                </th>
                                                <th class="text text-left">
                                                    <?php echo 'Class'; ?>
                                                </th>
                                                <th class="text text-left">
                                                    <?php echo 'Date'; ?>
                                                </th>
                                               
                                                <th class="text text-left">
                                                    <?php echo 'Date'; ?>
                                                </th>
                                               
                                                <th class="text text-right">
                                                    <?php echo $this->lang->line('amount'); ?> <span>
                                                        <?php echo "(" . $currency_symbol . ")"; ?>
                                                    </span>
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            if (!empty($refund_data)) {
                                                foreach ($refund_data as $key => $student) {

 
                                                    ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $student['studentname']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $student['admission_no']; ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $student['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $student['mode']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $student['reverted_by']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo getclassname($student['class']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo getsectionname($student['section']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $student['date']; ?>
                                                        </td>

                                                        <td class="text text-right">

                                                             
                                                        <?php echo (number_format($student['amount'], 2, '.', ''));?>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="8" class="text-danger text-center">
                                                        <span class="input input-danger">
                                                            <?php echo $this->lang->line('no_record_found'); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <?php
                                            }
                                            ?>
                                        

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
    </section>
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
        		
  var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(),['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
  
  //var date_format = '<?php //echo $result = strtr($this->customlib->getSchoolDateFormat(), array('d' => "dd", 'm' => "mm", 'Y' => "yyyy",)) ?>';
        $(".date").datepicker({
            format: date_format,
            autoclose: true,
            todayHighlight: true
        });
    
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
            getStudentsByClassAndSection();
        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
    });
    function getStudentsByClassAndSection() {
        $('#student_id').html("");
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: { 'class_id': class_id, 'section_id': section_id },
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                });
                $('#student_id').append(div_data);
            }
        });
    }

    $(document).ready(function () {
        $("ul.type_dropdown input[type=checkbox]").each(function () {
            $(this).change(function () {
                var line = "";
                $("ul.type_dropdown input[type=checkbox]").each(function () {
                    if ($(this).is(":checked")) {
                        line += $("+ span", this).text() + ";";
                    }
                });
                $("input.form-control").val(line);
            });
        });
    });
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });
</script>