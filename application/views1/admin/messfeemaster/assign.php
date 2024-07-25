<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">   
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('mess_fee'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="<?php echo site_url('admin/messfeemaster/assign') ?>" method="post" class="form-horizontal">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                            <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>
                                <div class="col-sm-2">
                                    <label><?php echo $this->lang->line('section'); ?></label>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>
                                
                                
                                  <div class="col-sm-2">    
                             
                                    <label ><?php echo $this->lang->line('month'); ?><small class="req"> *</small></label>
                                    <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                
                               
                               <div class="col-sm-2">    
                             
                                    <label ><?php echo $this->lang->line('due_date'); ?></label>
                                    <input id="due_date" name="due_date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('due_date'); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('due_date'); ?></span>
                                </div>
                                
                               
                               
                               
                               
                                
                                
                                
                                
                                <!--<div class="col-sm-2">
                                    <label><?php //echo $this->lang->line('category'); ?></label>
                                    <select  id="category_id" name="category_id" class="form-control" >
                                        <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                        <?php
                                        //foreach ($categorylist as $category) {
                                            ?>
                                            <option value="<?php //echo $category['id'] ?>" <?php //if (set_value('category_id') == $category['id']) echo "selected=selected"; ?>><?php echo $category['category'] ?></option>
                                            <?php
                                            //$count++;
                                        //}
                                        ?>
                                    </select>
                                </div>-->
                                
                                
                                
                                
                              
                                
                                <!--<div class="col-sm-2">
                                    <label><?php //echo $this->lang->line('gender'); ?></label>
                                    <select class="form-control" name="gender">
                                        <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                        <?php
                                        //foreach ($genderList as $key => $value) {
                                            ?>
                                            <option value="<?php //echo $key; ?>" <?php //if (set_value('gender') == $key) echo "selected"; ?>><?php //echo $value; ?></option>
                                            <?php
                                       // }
                                        ?>
                                    </select>
                                </div>-->
                                <!--<div class="col-sm-2">
                                    <label><?php //echo $this->lang->line('rte'); ?></label>
                                    <select  id="rte" name="rte" class="form-control" >
                                        <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                        <?php
                                        //foreach ($RTEstatusList as $k => $rte) {
                                            ?>
                                            <option value="<?php //echo $k; ?>" <?php //if (set_value('rte') == $k) echo "selected"; ?>><?php //echo $rte; ?></option>

                                            <?php
                                            //$count++;
                                        //}
                                        ?>
                                    </select>
                                </div>-->
                                
                                
                                
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <form method="post" action="<?php echo site_url('studentmessfee/addmessfeegroup') ?>" id="assign_form">


                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('assign_fees_group'); ?>
                                    </i> <?php echo form_error('student'); ?></h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-md-12">
                                       
                                        <div class="col-md-12">
                                            <div class=" table-responsive">
                                            
                                      <input type="hidden" name="date" value="<?php echo $date ?>" />
                                     <input type="hidden" name="due_date" value="<?php echo $due_date ?>" />
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th><input type="checkbox" id="select_all"/> <?php echo $this->lang->line('all'); ?></th>

                                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                            <th><?php echo $this->lang->line('student_name'); ?></th>

                                                            <th><?php echo $this->lang->line('class'); ?></th>
                                                          <th><?php echo $this->lang->line('amount'); ?></th> 

                                                        </tr>
                                                        <?php
                                                        if (empty($resultlist)) {
                                                            ?>
                                                            <tr>
                                                                <td colspan="7" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                            </tr>
                                                            <?php
                                                        } else {
                                                            $count = 1;
                                                            foreach ($resultlist as $student) {
																
														   
                                                                ?>
                                                                <tr>

                                                                    <td> 
                                                                        <?php
                                                                        if ($student['student_messfees_master_id'] != 0) {
																			
                                                                            $sel = "checked='checked'";
                                                                        } 
																		
																		else {
                                                                            $sel = "";
                                                                        }
                                                                        ?>
                                                                        <input class="checkbox" type="checkbox" name="student_session_id[]"  value="<?php echo $student['student_session_id']; ?>" <?php echo $sel; ?>/>
                                                                        <input type="hidden" name="student_messfees_master_id_<?php echo $student['student_session_id']; ?>"  value="<?php echo $student['student_messfees_master_id']; ?>">
                                                                        <input type="hidden" name="student_ids[]" value="<?php echo $student['student_session_id']; ?>">
                                                                        
  <input type="hidden" name="student_id_<?php echo $student['student_session_id']; ?>" value="<?php echo $student['id']; ?>">                                                                 
                                                                    </td>

                                                                    <td><?php echo $student['admission_no']; ?></td>
                                                                    <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
                                                                    <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                                    
                                                                    <td>
                                                                   <?php  if ($student['student_messfees_master_id'] != 0) {?>
                                        <input id="amount" name="amount_<?php echo $student['student_session_id']; ?>" placeholder="" type="text" class="form-control"  value="<?php echo $student['amount'] ?>"  />    <?php } else {?>                                    
                                                                     
                                                                    <input id="amount" name="amount_<?php echo $student['student_session_id']; ?>" placeholder="" type="text" class="form-control"  value="<?php echo $amount['amount'] ?>"  />  
                                                                    
                             <?php } ?>                                       
                                                                    
                                                                    </td>
                                                                    

                                                                </tr>
                                                                <?php
                                                            }
                                                            $count++;
                                                        }
                                                        ?>
                                                    </tbody></table>

                                            </div>
                                            <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('save'); ?>
                                            </button>

                                            <br/>
                                            <br/>
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
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
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
		
		  var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#due_date').datepicker({
            format: date_format,
            autoclose: true
        });
    
		
		$("#date").datepicker( {
    format: "MM-yyyy",
     startView: "year", 
    minViewMode: "months",
	  autoclose: true
	
});

		
		
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
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });

    $("#assign_form").submit(function (e) {
        if (confirm('Are you sure?')) {
            var $this = $('.allot-fees');
            $this.button('loading');
            $.ajax({
                type: "POST",
                dataType: 'Json',
                url: $("#assign_form").attr('action'),
                data: $("#assign_form").serialize(), // serializes the form's elements.
                success: function (data)
                {
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
        e.preventDefault();

    });


</script>