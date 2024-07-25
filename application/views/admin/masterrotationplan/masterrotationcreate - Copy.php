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

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;

    border: 1px solid #ccc;
}

th.rotate {
    /* Set the width and height of the rotated cell */

    height: 172px;
    /* Rotate the content 90 degrees clockwise */
    transform: rotate(-90deg);
    /* Move the content to the right to align with the top of the cell */
    text-align: right;
    vertical-align: middle;
    /* Set a minimum width to prevent the rotated text from overlapping */
    min-width: 1.5em;
    /* Prevent text from wrapping */
    white-space: nowrap;

}

th>span {
    width: 8px;
    display: flex;
    justify-content: space-around;
}

input[type="radio"] {
    display: none;
}

.color-box {
    display: flex;
    margin-bottom: 10px;
    cursor: pointer;
    justify-content: space-evenly;
}

.color {
    width: 20px;
    height: 20px;
    margin: auto;
    border-radius: 50%;
    border: 2px solid #ccc;
}

.weekno {
    cursor: pointer;
}


.name {
    font-size: 16px;
    font-weight: bold;
}
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
                    <form method="post" accept-charset="utf-8">
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
                                            <?php foreach ($classlist as $class) { ?>
                                            <option value="<?php echo $class['id'] ?>"
                                                <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>>
                                                <?php echo $class['class'] ?></option>
                                            <?php $count++; } ?>
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
                                        <label for="exampleInputEmail1">Select Year</label><small class="req"> *</small>
                                        <input name="date" id='year_id' type="text" class="form-control date-picker"
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



                <?php  if ($is_search){?>
                <div class="box box-primary">
                    <h3 class="titless pull-left"><i class="fa fa-money"></i> <?php echo 'Monthly Academic Report'; ?>

                    </h3>

                    <!-- <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search"
                        id="collection_print" value=""
                        class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right">
                        <?php //echo $this->lang->line('print'); ?></button> -->


                    <div class="box-body" id="collection_report">

                        <div class="row">

                            <div class="col-md-12 ">


                                <div class="box-header print  with-border">


                                </div>

                                <br>
                                <br>

                                <div class="color-box">

                                    <?php 
                                    foreach ($plan_items as $key => $value) {
                                        
                                    ?>
                                    <div class="col">

                                        <div class="color" data-id="<?php echo $value['id'] ?>"
                                            data-color=" <?php echo $value['color'] ?>" id="plan_item_id"
                                            style="background-color: <?php echo $value['color'] ?>;">
                                        </div>
                                        <div class="name"><?php echo $value['name'] ?></div>
                                    </div>

                                    <?php }?>

                                </div>


                                <?php if(!$calendar){ ?>

                                <table style="width:100%;" border="1">

                                    <thead>
                                        <tr>
                                            <th class='rotate'>Date</th>

                                            <?php 
                                            $count =1;
                                            foreach ($weeks as $key => $value) {
                                                ?>

                                            <th class='rotate'>
                                                <span>

                                                    <?php echo date('d.m.y', strtotime($value['start_date'])).'-'.date('d.m.y', strtotime($value['end_date'])) ; ?>
                                                </span>
                                            </th>
                                            <?php 
                                            $count++;
                                            } ?>

                                        </tr>
                                        <tr>
                                            <th>Week</th>

                                            <?php 
                                            $count =1;
                                            foreach ($weeks as $key => $value) {
                                                ?>

                                            <th id="week-id" class="weekno" data-id="" data-color=""
                                                data-week-no="<?php echo $count; ?>"><?php echo $count; ?></th>
                                            <?php 
                                            $count++;
                                            } ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td></td>
                                            <?php 
                                            $count =1;
                                            foreach ($weeks as $key => $value) {
                                                ?>

                                            <td style="height:100px;border:none" id="week-td-id"> </td>

                                            <?php 
                                            $count++;
                                            } ?>

                                        </tr>
                                    </tbody>


                                </table>

                                <div class="box-footer">
                                    <button class="btn btn-primary pull-right btn-sm" id="save-calendar" data-type="save">  Save</button>
                                </div>
                                <?php } ?>
                                <?php if($calendar){ ?>

                                <table style="width:100%;" border="1">

                                    <thead>
                                        <tr>
                                            <th class='rotate'>Date</th>

                                            <?php 
                                            $count =1;
                                            foreach ($weeks as $key => $value) {
                                                ?>

                                            <th class='rotate'>
                                                <span>

                                                    <?php echo date('d.m.y', strtotime($value['start_date'])).'-'.date('d.m.y', strtotime($value['end_date'])) ; ?>
                                                </span>
                                            </th>
                                            <?php 
                                            $count++;
                                            } ?>

                                        </tr>
                                        <tr>
                                            <th>Week</th>

                                            <?php 
                                            $count =1;
                                            foreach (json_decode($calendar->calendar) as $key => $value) {
                                                ?>


                                            <th id="week-id" style="background-color:<?php echo $value->color; ?>" class="weekno" data-id="<?php echo $value->id; ?>" data-color="<?php echo $value->color; ?>" data-week-no="<?php echo $count; ?>"><?php echo $count; ?></th>
                                           
                                           <?php 
                                            $count++;
                                            } ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td></td>
                                            <?php 
                                            $count =1;
                                            foreach (json_decode($calendar->calendar) as $key => $value) {
                                                ?>

                                            <td 
                                            style="height:100px;border:none;background-color:<?php echo $value->color; ?>" id="week-td-id"> </td>

                                            <?php 
                                            $count++;
                                            } ?>

                                        </tr>
                                    </tbody>


                                </table>

                                <div class="box-footer">
                                    <button class="btn btn-primary pull-right btn-sm" id="save-calendar" data-tableid="<?php echo $calendar->id?>" data-type="update">
                                        Update</button>
                                </div>



                                <?php } ?>








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
            </div>

            <?php }?>
        </div>

    </section>
</div>




<?php 

function getdateformat($date){

    $date_string = $date;
    $date_format = 'd/m/Y';
    $dateformat = DateTime::createFromFormat($date_format, $date_string); 
    return $dateformat->format('l'). ' ('. $dateformat->format('d/m/Y') .')'; 
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

let selectedplancolor = '';
let selectedplanid = '';

$(document).ready(function() {

    $firstitem = $('.color').eq(0)

    $firstitem.css('border', '2px solid #2196F3')
    selectedplancolor = $firstitem.data('color')
    selectedplanid = $firstitem.data('id')

})
$(document).on('click', '#plan_item_id', function(e) {
    $('.color').css('border', '')
    $(this).data('color')
    $(this).css('border', '2px solid #2196F3')

    selectedplancolor = $(this).data('color')
    selectedplanid = $(this).data('id')


})
$(document).on('click', '#week-id', function(e) {

    $(this).css('backgroundColor', selectedplancolor)

    $(this).data('id', selectedplanid)
    $(this).data('color', selectedplancolor)

    var index = $(this).index();

    $("td").eq(index).css('backgroundColor', selectedplancolor);

})


$(document).on('click', '#save-calendar', function(e) {

    e.preventDefault()
    let calendardata = []
    $('.weekno').each(function() {
        var obj = {
            week: $(this).data('week-no'),
            id: $(this).data('id'),
            color: $(this).data('color'),
        }
        calendardata.push(obj)
    })


    let class_id = $('#class_id').val()
    let section_id = $('#section_id').val()

    let year = $('#year_id').val()
    var base_url = '<?php echo base_url() ?>';
    var type=$(this).data('type');
    var url = type=='save'?'savemasterrotation':'updatemasterrotation'
    let tableid= type=='update'&&$(this).data('tableid')


    $.ajax({
        type: "POST",
        url: base_url + "admin/masterrotation/"+url,
        data: {
            'calendar': calendardata,
            'class_id': class_id,
            'section_id': section_id,
            'year': year,
            'id':tableid
        },
        dataType: "json",
        success: function(data) {
            window.location.reload(true)
        }
    });

})
</script>

<script type="text/javascript">
var base_url = '<?php echo base_url() ?>';

function printDiv(elem) {
    var cls = $("#class_id option:selected").text();
    var sec = $("#section_id option:selected").text();
    $('.cls').html(cls + '(' + sec + ')');
    Popup(jQuery(elem).html());
}

function Popup(data) {

    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({
        "position": "absolute",
        "top": "-1000000px"
    });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0]
        .contentDocument.document : frame1[0].contentDocument;
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


    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/datepicker/datepicker3.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url +
        'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
    frameDoc.document.write('</head>');
    frameDoc.document.write('<body>');
    frameDoc.document.write(data);
    frameDoc.document.write('</body>');
    frameDoc.document.write('</html>');
    frameDoc.document.close();
    setTimeout(function() {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);


    return true;
}
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