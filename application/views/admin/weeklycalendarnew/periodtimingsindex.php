<style>
    .multiselect {
        width: 340px !important;
    }
</style>


<!--<link rel="stylesheet" href="<?php //echo base_url();  ?>backend/bootstrap/bootstrap-select.min.css"/>
 <script src="<?php //echo base_url();  ?>backend/bootstrap/bootstrap-select.min.js"></script>
 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/plugins/select2/select2.min.js"></script>
-->
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i>
            <?php echo $this->lang->line('academics'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">


        <div class="box box-info" id="box_display">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users"> </i> Assign Period </h3>


            </div>

            <table class="table table-striped table-bordered table-hover example">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Section</th>
                        <th>Templates</th> 
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    
                    foreach ($class_sections as $class_section) {
                        ?>
                        <tr>

                            <td rowspan="<?php echo count($class_section['sections'])+1 ?>">
                                <?php echo $class_section['class']['class']?>
                            </td>

                            <?php foreach($class_section['sections'] as $sections){ ?>
                            <tr>
                                <td>
                                    <ul class="liststyle1">
    
                                   
                                    <li> 
                                        <div class="col-md-4">
    
                                            <?php echo $sections['section'] ?>
                                        </div>
                                        <div class="col-md-2">
    
                                            <a href="<?php echo base_url(); ?>admin/weeklycalendarnew/periodtimingTemplateCreate/<?php echo $class_section['class']['id'] ?>/<?php echo $sections['id'] ?>"
                                                data-toggle="tooltip" title="Add" >Add <i class="fa fa-plus"></i>
                                            </a> 
                                        </div>
                                    </li>
                                    
                                </ul>
                            </td>
                          
                                <td>
                                    <ul class="liststyle1">
                                    <?php 
                                    $periodarray =array_merge(...$class_section['periodtiming']);
                                    
                                    
                                    $sectionid =$sections['id'];
                                    $classid = $class_section['class']['id'];
                                    
                                    $filteredperiods = array_filter($periodarray,function($period) use($sectionid,$classid){
                                        return $period->section_id == $sectionid && $period->class_id == $classid;

                                    });
 
                                    foreach($filteredperiods as $periodtiming){ 
                                         
                                        ?>
                                        <li style="font-size:14px;<?php if($periodtiming->is_active==1){echo 'color:green;font-weight:bold';} ?>" > 
                                        <?php echo $periodtiming->template_name  ?> &nbsp;
                                            <a href="<?php echo base_url(); ?>admin/weeklycalendarnew/periodtimingTemplateEdit/<?php echo $periodtiming->id ?>"
                                                data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>&nbsp;
                                            <?php if($periodtiming->is_active!=1){ ?>
                                            <a href="<?php echo base_url(); ?>admin/weeklycalendarnew/periodtimingTemplateUse/<?php echo $periodtiming->class_id ?>/<?php echo $periodtiming->section_id ?>/<?php echo $periodtiming->id ?>"
                                                data-toggle="tooltip" title="use" >
                                                <i class="fa fa-check"></i>
                                            </a>&nbsp;
                                            <?php } ?>
                                            <?php if($periodtiming->is_active!=1){ ?>
                                            <a href="<?php echo base_url(); ?>admin/weeklycalendarnew/periodtimingTemplateRemove/<?php echo $periodtiming->id ?>"
                                                data-toggle="tooltip" title="remove"  onclick="confirmDelete(); return false;">
                                                <i class="fa fa-remove"></i>
                                            </a>&nbsp;
    
                                            <?php } ?>
                                        </li> 
                                        
                                        <?php } ?>
                                        
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                           
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </section>
</div>

<script>
    function confirmDelete() {
      // Ask for confirmation
      var result = confirm("Are you sure you want to delete this entry?");
      
      // If user confirms, proceed with the deletion
      if (result) {
        // Get the href of the clicked link
        var href = document.getElementById("deleteLink").getAttribute("href");
        // Navigate to the href
        window.location.href = href;
      } else {
        // If user cancels, do nothing
        // Alternatively, you can perform some other action here
      }
    }
  </script>

<script type="text/javascript">
    $(document).ready(function () {
        //$('.selectpicker').multiselect();
        //$('.selectpicker').selectpicker({});

        getSectionByClass($('#class_id').val())


        // $('#btnAdd').hide();



        $(document).on('change', '#class_id', function (e) {
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
                success: function (data) {
                    $.each(data, function (i, obj) {
                        div_data += "<option value=" + obj.section_id + ">" + obj
                            .section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });




        function getSectionByClass(class_id) {

            $('#section_id').html("");


            var section_id = "<?php echo $section_id; ?>"
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj) {
                        console.log(obj)
                        div_data += '<option value="' + obj.section_id + '" ' + (obj.section_id == section_id ? 'selected' : '') + '>' + obj.section + '</option>';
                    });
                    $('#section_id').append(div_data);
                }

            });
        }
    });




    $(document).on('click', '#btnRemove', function () {
        // $(this).parents('.form-group').remove();
    });
</script>