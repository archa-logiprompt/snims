<style type="text/css">
@media print {

    .no-print,
    .no-print * {
        display: none !important;
    }
}

.print,
.print * {
    display: none;
}

table {}

th {}

th.rotate {}

th>span {}



.color-box {}

.color {}


.name {}
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
            <small><?php echo $this->lang->line('student_fees1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?>
                        </h3>

                    </div>
                    <form action="<?php echo site_url('admin/masterrotation/clinicalrotation') ?>" method="post"
                        accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small
                                            class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($classlist as $class) {?>
                                            <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) {
    echo "selected=selected";
}
    ?>>
                                                <?php echo $class['class'] ?></option>
                                            <?php $count++;}?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small
                                            class="req"> *</small>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Year</label>
                                        <input name="date" id='month_id' type="text" class="form-control date-picker"
                                            value="<?php echo $date ?>" />
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-search"></i>
                                <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>



                <?php
                 
                if ($is_search) {?>
                <div class="box box-primary">
                    <h3 class="titless pull-left"><i class="fa fa-money"></i> <?php echo 'Monthly Academic Report'; ?>

                    </h3>

                    <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search"
                        id="collection_print" value=""
                        class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        <?php echo $this->lang->line('print'); ?></button>


                    <div class="box-body" id="collection_report">

                        <div class="row">

                            <div class="col-md-12 ">


                                <div class="box-header print  with-border">
                                    <div class="row text-center">
                                        <div class="col-sm-2" style="width:20%;">

                                        </div>
                                        <div class="col-sm-8">
                                            <h3><?php echo strtoupper($this->setting_model->getCurrentSchoolName()); ?>
                                            </h3>
                                            <h3> Programme And Batch: <?php echo "$class_name $section_name" ?></h3>
                                            <h3> Clinical Rotation Plan - <?php echo $date; ?></h3>


                                        </div>





                                    </div>

                                </div>

                                <br>
                                <br>
                                





                                <table style=" width: 100%;border-collapse: collapse;" border="1">

                                    <thead>
                                        <tr>

                                            <th style="text-align:center;padding:5px">Group</th>

                                            <?php

    foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] as $key => $value) {
        ?>

                                            <th style="text-align:center;padding:5px">


                                                <?php echo $value; ?>

                                            </th>
                                            <?php
}?>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
    $groupArrays = array();
    foreach ($groups as $item) {
       
        $groupArrays[$item['group_name']][] = $item;
    }

    // Output the resulting array

    foreach ($groupArrays as $key => $value) {
        ?>
                                        <tr>
                                            <td style="text-align:center;padding:5px"><?php echo $key ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[0]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[1]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[2]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[3]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[4]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[5]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[6]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[7]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[8]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[9]['aliasname'] ?></td>
                                            <td style="text-align:center;padding:5px">
                                                <?php echo $value[10]['aliasname'] ?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>




                                </table>
                                <br>

                                <div class="row">

                                    <?php
                                        foreach ($wardlist as $key => $value) {

                                                     ?>
                                    <div class="col-md-4">


                                        <div class="name"><?php echo $value['deptname'] ." : ". $value['aliasname'] ?>
                                        </div>
                                    </div>

                                    <?php }?>

                                </div>

                                <div class="row print" style="display: flex;justify-content: space-around;">
                                    <div class="col-4">
                                        <h5> Class Co Ordinator</h5>
                                        <br>
                                    </div>
                                    <div class="col-4">
                                        <h5>UG Coordinator</h5>
                                    </div>
                                    <div class="col-4">
                                        <h5>Principal</h5>
                                    </div>
                                </div>


                              








                            </div>


                        </div>


                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>

                </div>

                <?php }?>
            </div>

    </section>
</div>




<?php

function getdateformat($date)
{

    $date_string = $date;
    $date_format = 'd/m/Y';
    $dateformat = DateTime::createFromFormat($date_format, $date_string);
    return $dateformat->format('l') . ' (' . $dateformat->format('d/m/Y') . ')';
}

?>


<script type="text/javascript">
$(document).on('ready', function() {
    $(function() {

        $(".date-picker").datepicker({
            format: "yyyy",
            startView: "years",
            minViewMode: "years",
        })


    });

});

function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
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
$(document).ready(function() {
    $(document).on('change', '#class_id', function(e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.section_id + ">" + obj
                        .section + "</option>";
                });

                $('#section_id').append(div_data);
            }
        });
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    $(document).on('change', '#feecategory_id', function(e) {
        $('#feetype_id').html("");
        var feecategory_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "feemaster/getByFeecategory",
            data: {
                'feecategory_id': feecategory_id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += "<option value=" + obj.id + ">" + obj.type +
                        "</option>";
                });

                $('#feetype_id').append(div_data);
            }
        });
    });
});

$(document).on('change', '#section_id', function(e) {
    $("form#schedule-form").submit();
});
</script>



<script type="text/javascript">
$(document).on('click', '#collection_print', function() {


    var printContents = document.getElementById('collection_report').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;


});
</script>