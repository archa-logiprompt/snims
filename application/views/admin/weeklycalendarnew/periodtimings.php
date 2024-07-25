 <style>
.multiselect {
    width: 340px !important;
}
 </style>


 <!--<link rel="stylesheet" href="<?php //echo base_url(); ?>backend/bootstrap/bootstrap-select.min.css"/>
 <script src="<?php //echo base_url(); ?>backend/bootstrap/bootstrap-select.min.js"></script>
 -->
 <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css" />
 <script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>


 <!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/plugins/select2/select2.min.js"></script>
-->
 <div class="content-wrapper" style="min-height: 946px;">
     <section class="content-header">
         <h1>
             <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
         </h1>
     </section>
     <!-- Main content -->
     <section class="content">
          
 
         <div class="box box-info" id="box_display">
             <div class="box-header with-border">
                 <h3 class="box-title"><i class="fa fa-users"> </i> <?php echo $this->lang->line('assign_subject'); ?>
                 </h3>

               
             </div>
             <form action="<?php echo base_url() ?>admin/weeklycalendarnew/savePeriodAttendance" method="POST"
                 id="formSubjectTeacher">
                 <?php echo $this->customlib->getCSRF(); ?>
                 <br />
                 
                 <div class="box-body">
                  
                     <div class="row">

                     <input type="hidden" name="is_update" value="<?php echo $is_update; ?>">
                     <input type="hidden" name="period_id" value="<?php echo $perioddata->id; ?>">
                         <?php 
                         if($is_update) { ?>
                         
                     <input type="hidden" name="class_id" value="<?php echo $perioddata->class_id; ?>">
                     <input type="hidden" name="section_id" value="<?php echo $perioddata->section_id; ?>">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label>Template Name</label>
                                 <input type="text" name="templatename"  value="<?php echo $perioddata->template_name ?>" placeholder="Template Name" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>1st Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_1" value="<?php echo convertTimeTo24HR($perioddata->period_one_from) ?>" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>1st Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_1" value="<?php echo convertTimeTo24HR($perioddata->period_one_to) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>2nd Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_2" value="<?php echo convertTimeTo24HR($perioddata->period_two_from) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>2nd Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_2" value="<?php echo convertTimeTo24HR($perioddata->period_two_to) ?>" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>3rd Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_3"value="<?php echo convertTimeTo24HR($perioddata->period_three_from) ?>"   placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>3rd Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_3" value="<?php echo convertTimeTo24HR($perioddata->period_three_to) ?>" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>4th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_4" value="<?php echo convertTimeTo24HR($perioddata->period_four_from) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>4th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_4"value="<?php echo convertTimeTo24HR($perioddata->period_four_to) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>5th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_5" value="<?php echo convertTimeTo24HR($perioddata->period_five_from) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>5th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_5"value="<?php echo convertTimeTo24HR($perioddata->period_five_to) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>6th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_6" value="<?php echo convertTimeTo24HR($perioddata->period_six_from) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>6th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_6"value="<?php echo convertTimeTo24HR($perioddata->period_six_to) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>7th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_7" value="<?php echo convertTimeTo24HR($perioddata->period_seven_from) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>7th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_7" value="<?php echo convertTimeTo24HR($perioddata->period_seven_to) ?>" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>8th Period From</label>
                                 <input type="time" onfocus="this.showPicker()"  name="time_from_8" value="<?php echo convertTimeTo24HR($perioddata->period_eight_from) ?>"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>8th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_8" value="<?php echo convertTimeTo24HR($perioddata->period_eight_to) ?>" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <?php }else{ ?>

                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                     <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label>Template Name</label>
                                 <input type="text" name="templatename"  placeholder="Template Name" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                            <div class="col-md-6">
                             <div class="form-group">
                                 <label>1st Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_1"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>1st Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_1" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>2nd Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_2"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>2nd Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_2" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>3rd Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_3"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>3rd Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_3" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>4th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_4"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>4th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_4" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>5th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_5"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>5th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_5" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>6th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_6"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>6th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_6" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>7th Period From</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_from_7"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>7th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_7" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>8th Period From</label>
                                 <input type="time" onfocus="this.showPicker()"  name="time_from_8"  placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                                 <label>8th Period To</label>
                                 <input type="time" onfocus="this.showPicker()" name="time_to_8" placeholder="From" class="form-control">
                                 <span class="class_id_error text-danger"></span>
                             </div>
                         </div>
                         <?php } ?>

                        
                     </div> 
                     <div class="box-footer">
                         <button type="submit" class="btn btn-primary btn-sm btn pull-right "
                             ><?php echo $this->lang->line('save'); ?></button>
                     </div>
                 </div>
                
             </form>
         </div> 
     </section>
 </div>

 <script type="text/javascript">
$(document).ready(function() {
    //$('.selectpicker').multiselect();
    //$('.selectpicker').selectpicker({});

    getSectionByClass($('#class_id').val())


    // $('#btnAdd').hide();



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




    function getSectionByClass(class_id){
        
        $('#section_id').html("");


        var section_id = "<?php echo $section_id;?>"
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
                    console.log(obj)
                    div_data += '<option value="' + obj.section_id + '" ' + (obj.section_id==section_id ? 'selected' : '') + '>' + obj.section + '</option>';
                });
                $('#section_id').append(div_data);
            }
         
    });
    }
});




$(document).on('click', '#btnRemove', function() {
    // $(this).parents('.form-group').remove();
});
 </script>