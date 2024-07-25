<div class="content-wrapper">
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
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_subject'); ?></h3>
                    </div>
                    <form id="form1" action='<?php echo site_url("admin/masterrotation/updateitem/$item_id") ?>' id="employeeform"
                        name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">

                            <?php echo $this->customlib->getCSRF(); ?>
                            <?php echo validation_errors(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                <select autofocus="" id="class_id" name="class_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                    <option value="<?php echo $class['id'] ?>"
                                        <?php if ($class_id == $class['id']) echo "selected=selected"; ?>>
                                        <?php echo $class['class'] ?></option>
                                    <?php
                                                $count++;
                                            }
                                            ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                <select id="section_id" name="section_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label>
                                <input autofocus="" id="category" name="name" placeholder="" type="text"
                                    class="form-control" value="<?php echo $edititem->name; ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>




                        </div>
                        <div class="box-footer">
                            <button type="submit"
                                class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('subject_list'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        
                                        <th class="pull-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($items)) {
                                        ?>
                                    <tr>
                                        <td colspan="12" class="text-danger text-center">
                                            <?php echo $this->lang->line('no_record_found'); ?></td>
                                    </tr>
                                    <?php
                                    } else {
                                        $count = 1;
                                        foreach ($items as $item) {
                                            ?>
                                    <tr>
                                        <td class="mailbox-name"><?php echo $item['name']?></td>
                                        <td class="mailbox-name"><?php echo $item['class'] ?></td>
                                        <td class="mailbox-name"><?php echo $item['section'] ?></td>
                                        <td class="mailbox-date pull-right">
                                            
                                            <a href="<?php echo base_url(); ?>admin/masterrotation/itemedit/<?php echo $item['itemid'] ?>"
                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                title="<?php echo $this->lang->line('edit'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="<?php echo base_url(); ?>admin/masterrotation/deleteitem/<?php echo $item['itemid'] ?>"
                                                class="btn btn-default btn-xs" data-toggle="tooltip"
                                                title="<?php echo $this->lang->line('delete'); ?>"
                                                onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                <i class="fa fa-remove"></i>
                                            </a>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#btnreset").click(function() {
        $("#form1")[0].reset();
    });

    var class_id = $('#class_id').val();
    var section_id = '<?php echo $section_id ?>';

    getSectionByClass(class_id, section_id);


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
</script>