


<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('transcript'); ?> <small><?php echo $this->lang->line('student1'); ?></small>  </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form action="<?php echo site_url('admin/Transcript/get_student') ?>"  method="post" accept-charset="utf-8">
                 
                  
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                               <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php //echo $this->lang->line('student'); ?></label><small class="req"> *</small>
                                        <select  id="student_id" name="student_id" class="form-control" >
                                            <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('student_id'); ?></span>
                                    </div>
                                </div>-->
                                
                                
                                
                                <div class="col-sm-12">

                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
<?php //var_dump($student_list); ?>

                <?php
                if (isset($student_list)) {
					
					
                    ?>



<div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?>  <?php echo $this->lang->line('view'); ?></a></li>
                            <!--<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php //echo $this->lang->line('details'); ?> <?php //echo $this->lang->line('view'); ?></a></li>-->
                        </ul>
                        <div class="tab-content">
                            <div class="download_label"><?php echo $title; ?></div>
                            <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <?php /*?><th><?php echo $this->lang->line('class'); ?></th>
                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th><?php echo $this->lang->line('gender'); ?></th>
                                            <th><?php echo $this->lang->line('category'); ?></th>
                                            <th><?php echo $this->lang->line('mobile_no'); ?></th><?php */?>

                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($student_list)) {
											
											
											
                                            ?>
                                                            <!-- <tr>
                                                                <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                            </tr> -->
                                            <?php
                                        } else {
                                            $count = 1;
                                            foreach ($student_list as $student) {
												
												//var_dump($student);
												
                                                ?>
                                                <tr>
                                                    <td><?php echo $student['admission_no']; ?></td>
                                                    <td>
                                                    
                                                    
                                                    <?php echo strtoupper($student['firstname'] . " " . $student['lastname']); ?>
                                                        <!--<a href="<?php //echo base_url(); ?>student/view/
                                                        </a>-->
                                                    </td>
                                                    
                                                  <td class="pull-right">   
                                                  
                                                  
                                                  <a  class="btn btn-primary btn-sm schedule_modal" data-toggle="tooltip" title="" data-examname="<?php //echo $exam['name']; ?>"  data-studname="<?php echo ucfirst($student['firstname'])." ".ucfirst($student['lastname']); ?>"   data-gender="<?php echo $student['gender'] ?>" data-parent="<?php echo ucfirst($student['guardian_name']); ?>"  data-pm_address="<?php echo $student['permanent_address'] ?>" data-dob="<?php echo date('d-m-Y',strtotime($student['dob'] ))?>" data-nationality="<?php  echo $student['nationality']?>" data-kuhs_reg_no="<?php echo $student['kuhs_reg_no'] ?>" data-date_completion="<?php echo date($student['date_completion'])?>" data-class_name="<?php echo $student['class'] ?>" data-admission_date="<?php echo date('d-m-Y',strtotime($student['admission_date'])) ?>" data-awarded_by="<?php echo $student['awarded_by'] ?>" data-student_session_id="<?php echo $student['student_session_id'] ?>" data-student_id="<?php echo $student['student_id'] ?>"  data-examid="<?php //echo $exam['exam_id']; ?>" data-original-title=" <?php echo $this->lang->line('show_transcript'); ?>" data-sectionid='<?php //echo $section_id ?>' data-classid='<?php echo $student['class_id'] ?>' data-classname="<?php //echo $exam['class_name'] ?>"  data-sectionname="<?php //echo $exam['section_name'] ?>">
                                       <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('view'); ?>
                                                    </a>
                                                  
                                                  
                                                  
                                                 <!-- <a href="" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php //echo $this->lang->line('show_transcript'); ?>" >
                                                            <i class="fa fa-reorder"></i>
                                                            
                                                     </a>  -->         
                                                        
                                                        
                                                     </td>  
                                                    
                                                    
                                                    <!--<td><?php //echo $student['class'] . "(" . $student['section'] . ")" ?></td>-->
                                                    <!--<td><?php //echo $student['father_name']; ?></td>
                                                    <td><?php  //if($student["dob"] != null){ echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])) ; }?></td>
                                                    <td><?php //echo $student['gender']; ?></td>
                                                    <td><?php //echo $student['category']; ?></td>
                                                    <td><?php //echo $student['mobileno']; ?></td>-->

                                                    <!--<td class="pull-right">
                                                        <a href="<?php //echo base_url(); ?>student/view/<?php //echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php //echo $this->lang->line('show'); ?>" >
                                                            <i class="fa fa-reorder"></i>
                                                        </a>
                                                         <?php 
                                        //if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                            ?>
                                                        <a href="<?php //echo base_url(); ?>student/edit/<?php //echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php //echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                         <?php //}
                                        //if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) {
                                            ?>
                                                        <a href="<?php //echo base_url(); ?>studentfee/addfee/<?php //echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
                                                            <?php //echo $currency_symbol; ?>
                                                        </a>
                                                    <?php //} ?>
                                                    </td>-->
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>                           
                            <!--<div class="tab-pane" id="tab_2">
                                <?php //if (empty($resultlist)) {
                                    ?>
                                    <div class="alert alert-info"><?php //echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
                                //} else {
                                    //$count = 1;
                                    //foreach ($resultlist as $student) {
//
//                                        if(empty($student["image"])){
//                                           $image = "uploads/student_images/no_image.png"; 
//                                        }else{
//                                            $image = $student['image'];
//                                        } 
                                        ?>
                                        <div class="carousel-row">
                                            <div class="slide-row">
                                                <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a href="<?php //echo base_url(); ?>student/view/<?php //echo $student['id'] ?>"> <img class="img-responsive img-thumbnail width150" alt="<?php //echo $student["firstname"]." ".$student["lastname"] ?>" src="<?php //echo base_url() .$image; ?>" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4><a href="<?php //echo base_url(); ?>student/view/<?php //echo $student['id'] ?>"> <?php //echo $student['firstname'] . " " . $student['lastname'] ?></a></h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                <strong><b><?php //echo $this->lang->line('class'); ?>: </b><?php //echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                                <b><?php //echo $this->lang->line('admission_no'); ?>: </b><?php //echo $student['admission_no'] ?><br/>
                                                                <b><?php //echo $this->lang->line('date_of_birth'); ?>:
                                                                    <?php //echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?><br>
                                                                    <b><?php //echo $this->lang->line('gender'); ?>:&nbsp;</b><?php //echo $student['gender'] ?><br>
                                                                    </address>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b><?php //echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php //echo $student['samagra_id'] ?><br>
                                                                        <b><?php //echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php //echo $student['guardian_name'] ?><br>
                                                                        <b><?php //echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php //echo $student['guardian_phone'] ?><br>
                                                                        <b><?php //echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php //echo $student['current_address'] ?> <?php //echo $student['city'] ?><br>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="slide-footer">
                                                                        <span class="pull-right buttons">
                                                                            <a href="<?php //echo base_url(); ?>student/view/<?php //echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php //echo $this->lang->line('show'); ?>" >
                                                                                <i class="fa fa-reorder"></i>
                                                                            </a>
                                                                             <?php 
                                        //if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                            ?>
                                                                            <a href="<?php //echo base_url(); ?>student/edit/<?php //echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php //echo $this->lang->line('edit'); ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </a>
                                                                             <?php //}
                                        //if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) {
                                            ?>
                                                                            <a href="<?php //echo base_url(); ?>studentfee/addfee/<?php //echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php //echo $this->lang->line('add_fees'); ?>">    
                                                                                <?php //echo $currency_symbol; ?>
                                                                            </a>
                                                                        <?php //} ?>
                                                                        </span>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <?php
                                                                //}
                                                                //$count++;
                                                            //}
                                                            ?>
                                                            </div>-->                                                          
                                                            </div>                                                         
                                                            </div>















<?php } ?>







                    <!--<div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">

                                <i class="fa fa-file-text-o"></i> <?php //echo $this->lang->line('fees_statement'); ?>
                            </h3>
                        </div>
                        <div class="box-body" style="padding-top:0;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sfborder">  
                                        <div class="col-md-2">
                                            <img width="115" height="115" class="round5" src="<?php //echo base_url() . $student['image'] ?>" alt="No Image">
                                        </div>

                                        <div class="col-md-10">
                                            <div class="row">
                                                <table class="table table-striped mb0 font13">
                                                    <tbody>
                                                        <tr>
                                                            <th class="bozero"><?php //echo $this->lang->line('name'); ?></th>
                                                            <td class="bozero"><?php //echo $student['firstname'] . " " . $student['lastname'] ?></td>

                                                            <th class="bozero"><?php //echo $this->lang->line('class_section'); ?></th>
                                                            <td class="bozero"><?php //echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php //echo $this->lang->line('father_name'); ?></th>
                                                            <td><?php //echo $student['father_name']; ?></td>
                                                            <th><?php //echo $this->lang->line('admission_no'); ?></th>
                                                            <td><?php //echo $student['admission_no']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php //echo $this->lang->line('mobile_no'); ?></th>
                                                            <td><?php //echo $student['mobileno']; ?></td>
                                                            <th><?php //echo $this->lang->line('roll_no'); ?></th>
                                                            <td> <?php //echo $student['roll_no']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php //echo $this->lang->line('category'); ?></th>
                                                            <td>
                                                                <?php
                                                                //foreach ($categorylist as $value) {
                                                                    //if ($student['category_id'] == $value['id']) {
                                                                        //echo $value['category'];
                                                                    //}
                                                                //}
                                                                ?>                                              
                                                            </td>
                                                            <th><?php //echo $this->lang->line('rte'); ?></th>
                                                            <td><b class="text-danger"> <?php //echo $student['rte']; ?> </b>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>   
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                                    <p class="dates"><?php //echo $this->lang->line('date'); ?>: <?php //echo date($this->customlib->getSchoolDateFormat()); ?></p></div>
                            </div>    

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover example table-fixed-header">

                                    <thead class="header">
                                        <tr>
                                            <th><?php //echo $this->lang->line('fees_group'); ?></th>
                                            <th><?php //echo $this->lang->line('fees_code'); ?></th>
                                            <th class="text text-left"><?php //echo $this->lang->line('due_date'); ?></th>
                                            <th class="text text-left"><?php //echo $this->lang->line('status'); ?></th>
                                            <th class="text text-right"><?php //echo $this->lang->line('amount'); ?> <span><?php //echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-left"><?php //echo $this->lang->line('payment_id'); ?></th>
                                            <th class="text text-left"><?php //echo $this->lang->line('mode'); ?></th>
                                            <th class="text text-left"><?php //echo $this->lang->line('date'); ?></th>
                                            <th class="text text-right" ><?php //echo $this->lang->line('discount'); ?> <span><?php //echo "(" . $currency_symbol . ")"; ?></span></th>

                                            <th class="text text-right"><?php //echo $this->lang->line('fine'); ?> <span><?php //echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php //echo $this->lang->line('paid'); ?> <span><?php //echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php //echo $this->lang->line('balance'); ?> <span><?php //echo "(" . $currency_symbol . ")"; ?></span></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       // $total_amount = "0";
//                                        $total_deposite_amount = "0";
//                                        $total_fine_amount = "0";
//                                        $total_discount_amount = "0";
//                                        $total_balance_amount = "0";
//                                        $alot_fee_discount = 0;
//                                        foreach ($student_due_fee as $key => $fee) {
//
//                                            foreach ($fee->fees as $fee_key => $fee_value) {
//                                                $fee_paid = 0;
//                                                $fee_discount = 0;
//                                                $fee_fine = 0;
//
//
//
//                                                if (!empty($fee_value->amount_detail)) {
//                                                    $fee_deposits = json_decode(($fee_value->amount_detail));
//
//                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
//                                                        $fee_paid = $fee_paid + $fee_deposits_value->amount;
//                                                        $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
//                                                        $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
//                                                    }
//                                                }
//                                                $total_amount = $total_amount + $fee_value->amount;
//                                                $total_discount_amount = $total_discount_amount + $fee_discount;
//                                                $total_deposite_amount = $total_deposite_amount + $fee_paid;
//                                                $total_fine_amount = $total_fine_amount + $fee_fine;
//                                                $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
//                                                $total_balance_amount = $total_balance_amount + $feetype_balance;
                                                ?>
                                                <?php
                                                //if ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                    ?>
                                                    <tr class="danger">
                                                        <?php
                                                    //} else {
                                                        ?>
                                                    <tr class="dark-gray">
                                                        <?php
                                                    //}
                                                    ?>


                                                    <td><?php
                                                        //echo $fee_value->name;
                                                        ?></td>
                                                    <td><?php //echo $fee_value->code; ?></td>
                                                    <td class="text text-left">

                                                        <?php
                                                        //if ($fee_value->due_date == "0000-00-00") {
                                                            
                                                        //} else {

                                                            //echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                        //}
                                                        ?>
                                                    </td>
                                                    <td class="text text-left width85">
                                                        <?php
                                                        //if ($feetype_balance == 0) {
                                                            ?><span class="label label-success"><?php //echo $this->lang->line('paid'); ?></span><?php
                                                        //} else if (!empty($fee_value->amount_detail)) {
                                                            ?><span class="label label-warning"><?php //echo $this->lang->line('partial'); ?></span><?php
                                                        //} else {
                                                            ?><span class="label label-danger"><?php //echo $this->lang->line('unpaid'); ?></span><?php
                                                            //}
                                                            ?>

                                                    </td>
                                                    <td class="text text-right"><?php //echo $fee_value->amount; ?></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text text-right"><?php
                                                        //echo (number_format($fee_discount, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        //echo (number_format($fee_fine, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        //echo (number_format($fee_paid, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        //$display_none = "ss-none";
//                                                        if ($feetype_balance > 0) {
//                                                            $display_none = "";
//
//
//                                                            echo (number_format($feetype_balance, 2, '.', ''));
//                                                        }
                                                        ?>

                                                    </td>




                                                </tr>

                                                <?php
                                                //if (!empty($fee_value->amount_detail)) {

                                                    //$fee_deposits = json_decode(($fee_value->amount_detail));

                                                    //foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        ?>
                                                        <tr class="white-td">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-right"><img src="<?php //echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                            <td class="text text-left">


                                                                <a href="#" data-toggle="popover" class="detail_popover" > <?php //echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                <div class="fee_detail_popover" style="display: none">
                                                                    <?php
                                                                    //if ($fee_deposits_value->description == "") {
                                                                        ?>
                                                                        <p class="text text-danger"><?php //echo $this->lang->line('no_description'); ?></p>
                                                                        <?php
                                                                    //} else {
                                                                        ?>
                                                                        <p class="text text-info"><?php //echo $fee_deposits_value->description; ?></p>
                                                                        <?php
                                                                    //}
                                                                    ?>
                                                                </div>


                                                            </td>
                                                            <td class="text text-left"><?php //echo $fee_deposits_value->payment_mode; ?></td>
                                                            <td class="text text-left">

                                                                <?php //echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                            </td>
                                                            <td class="text text-right"><?php //echo (number_format($fee_deposits_value->amount_discount, 2, '.', '')); ?></td>
                                                            <td class="text text-right"><?php //echo (number_format($fee_deposits_value->amount_fine, 2, '.', '')); ?></td>
                                                            <td class="text text-right"><?php //echo (number_format($fee_deposits_value->amount, 2, '.', '')); ?></td>
                                                            <td></td>



                                                        </tr>
                                                        <?php
                                                    //}
                                               // }
                                                ?>
                                                <?php
                                            //}
                                        //}
                                        ?>
                                        <?php
                                        //if (!empty($student_discount_fee)) {

                                            //foreach ($student_discount_fee as $discount_key => $discount_value) {
                                                ?>
                                                <tr class="dark-light">
                                                    <td align="left"> <?php //echo $this->lang->line('discount'); ?> </td>
                                                    <td align="left">
                                                        <?php //echo $discount_value['code']; ?>
                                                    </td>
                                                    <td align="left"></td>
                                                    <td align="left" class="text text-left">
                                                        <?php
                                                        //if ($discount_value['status'] == "applied") {
                                                            ?>
                                                            <a href="#" data-toggle="popover" class="detail_popover" >

                                                                <?php //echo $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']) . " : " . $discount_value['payment_id']; ?>

                                                            </a>
                                                            <div class="fee_detail_popover" style="display: none">
                                                                <?php
                                                                //if ($fee_deposits_value->description == "") {
                                                                    ?>
                                                                    <p class="text text-danger"><?php //echo $this->lang->line('no_description'); ?></p>
                                                                    <?php
                                                                //} else {
                                                                    ?>
                                                                    <p class="text text-danger"><?php //echo $discount_value['student_fees_discount_description'] ?></p>
                                                                    <?php
                                                                //}
                                                                ?>

                                                            </div>
                                                            <?php
                                                        //} else {
                                                            //echo '<p class="text text-danger">' . $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']);
                                                        //}
                                                        ?>

                                                    </td>
                                                    <td></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td  class="text text-right">
                                                        <?php
                                                        //$alot_fee_discount = $alot_fee_discount;
                                                        ?>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td ></td>

                                                </tr>
                                                <?php
                                            //}
                                        //}
                                        ?>

                                        <tr class="box box-solid total-bg">
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td class="text text-left" ><?php //echo $this->lang->line('grand_total'); ?></td>
                                            <td class="text text-right"><?php
                                                //echo ($currency_symbol . number_format($total_amount, 2, '.', ''));
                                                ?></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td class="text text-right"><?php
                                                //echo ($currency_symbol . number_format($total_discount_amount + $alot_fee_discount, 2, '.', ''));
                                                ?></td>

                                            <td class="text text-right"><?php
                                                //echo ($currency_symbol . number_format($total_fine_amount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                                //echo ($currency_symbol . number_format($total_deposite_amount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                               // echo ($currency_symbol . number_format($total_balance_amount - $alot_fee_discount, 2, '.', ''));
                                                ?></td> 

                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                    </div>-->
                    <?php
				//}} 
                ?>

            </div>
        </div>
        <!-- /.row -->
    </section>

    <!-- /.content -->
    <div class="clearfix"></div>
</div>


<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id !== "" && section_id !== "") {
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
                        if (section_id === obj.section_id) {
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
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

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
        $(document).on('change', '#section_id', function (e) {

            getStudentsByClassAndSection();

        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        if (class_id != "" || section_id != "") {
            postbackStudentsByClassAndSection(class_id, section_id);
        }
    });
    function getStudentsByClassAndSection() {

        $('#student_id').html("");
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                });
                $('#student_id').append(div_data);
            }
        });
    }

    function postbackStudentsByClassAndSection(class_id, section_id) {
        $('#student_id').html("");
        var student_id = '<?php echo set_value('student_id') ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (student_id == obj.id) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.firstname + " " + obj.lastname + "</option>";
                });
                $('#student_id').append(div_data);
            }
        });
    }
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $('.table-fixed-header').fixedHeader();
    });

//  $(window).on('resize', function () {
//    $('.header-copy').width($('.table-fixed-header').width())
//});

    (function ($) {

        $.fn.fixedHeader = function (options) {
            var config = {
                topOffset: 50
                        //bgColor: 'white'
            };
            if (options) {
                $.extend(config, options);
            }

            return this.each(function () {
                var o = $(this);

                var $win = $(window);
                var $head = $('thead.header', o);
                var isFixed = 0;
                var headTop = $head.length && $head.offset().top - config.topOffset;

                function processScroll() {
                    if (!o.is(':visible')) {
                        return;
                    }
                    if ($('thead.header-copy').size()) {
                        $('thead.header-copy').width($('thead.header').width());
                    }
                    var i;
                    var scrollTop = $win.scrollTop();
                    var t = $head.length && $head.offset().top - config.topOffset;
                    if (!isFixed && headTop !== t) {
                        headTop = t;
                    }
                    if (scrollTop >= headTop && !isFixed) {
                        isFixed = 1;
                    } else if (scrollTop <= headTop && isFixed) {
                        isFixed = 0;
                    }
                    isFixed ? $('thead.header-copy', o).offset({
                        left: $head.offset().left
                    }).removeClass('hide') : $('thead.header-copy', o).addClass('hide');
                }
                $win.on('scroll', processScroll);

                // hack sad times - holdover until rewrite for 2.1
                $head.on('click', function () {
                    if (!isFixed) {
                        setTimeout(function () {
                            $win.scrollTop($win.scrollTop() - 47);
                        }, 10);
                    }
                });

                $head.clone().removeClass('header').addClass('header-copy header-fixed').appendTo(o);
                var header_width = $head.width();
                o.find('thead.header-copy').width(header_width);
                o.find('thead.header > tr:first > th').each(function (i, h) {
                    var w = $(h).width();
                    o.find('thead.header-copy> tr > th:eq(' + i + ')').width(w);
                });
                $head.css({
                    margin: '0 auto',
                    width: o.width(),
                    'background-color': config.bgColor
                });
                processScroll();
            });
        };

    })(jQuery);
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });
</script>
<style>
.tacenter td{
	text-align:center !important}
</style>

<script type="text/javascript">


$(document).on('click', '.schedule_modal', function () {
	//$("#scheduleModal").modal('show');
        $('.modal-title').html("");
		
		   var studname =$(this).data('studname');
		   var gender = $(this).data('gender');
		   var parent = $(this).data('parent');    
		   var pm_address = $(this).data('pm_address');
		   var dob = $(this).data('dob');
		   var nationality=$(this).data('nationality');
		   var kuhs_reg_no=$(this).data('kuhs_reg_no');
		   var date_completion=$(this).data('date_completion');
		   var class_name=$(this).data('class_name');
           console.log(class_name);
		   var admission_date=$(this).data('admission_date');
		   var awarded_by=$(this).data('awarded_by');
		   var class_id = $(this).data('classid'); 
		   var student_session_id=$(this).data('student_session_id');
		   var student_id=$(this).data('student_id');	
          
          
           //var classname = $(this).data('classname');
           //var sectionname = $(this).data('sectionname');
		  var college_name='<?php echo $this->setting_model->getCurrentSchoolName()?>';
        $('.modal-title').html(" <?php echo strtoupper($this->setting_model->getCurrentSchoolName());?>");
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "admin/Transcript/get_transcript",
            data: {'class_id': class_id,'student_session_id':student_session_id,'student_id':student_id},
            dataType: "json",
            success: function (response) {
				console.log(response);
                var data = "";
				
				data +='<center><label><h4><?php echo strtoupper($this->lang->line('transcript')); ?></h4></label><br><label> BACHELOR OF SCIENCE IN NURSING - B.Sc NURSING </label> </center>';
                data +='<div class="row" style="margin-top: 17px;" >';
				data +=' <div class="col-md-9"><div class="row"> <div class="col-md-5"> <label><?php echo $this->lang->line('name_of_student'); ?></label> </div> <div class="col-md-1"> :</div> <div class="col-md-6"> <label>'+studname+'</label> </div> </div>';
				
				data +='<div class="row"> <div class="col-md-5"> <label><?php echo $this->lang->line('gender'); ?></label> </div>  <div class="col-md-1"> :</div>  <div class="col-md-6"> <label>'+gender+'</label> </div> </div>';
				
				data +='<div class="row"> <div class="col-md-5"> <label><?php echo $this->lang->line('parent'); ?></label> </div> <div class="col-md-1"> :</div> <div class="col-md-6"> <label>'+parent+'</label> </div> </div>';
				data +='<div class="row"> <div class="col-md-5"> <label><?php echo $this->lang->line('permanent_address'); ?></label> </div> <div class="col-md-1"> :</div>  <div class="col-md-6"> <label>'+pm_address+'</label> </div> </div>';
				
				data +='<div class="row"> <div class="col-md-5"> <label><?php echo $this->lang->line('date_of_birth'); ?></label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+dob+'</label> </div> </div>';
				
				data +='<div class="row"> <div class="col-md-5"> <label><?php echo $this->lang->line('nationality'); ?></label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+nationality+'</label> </div> </div>';
				
				<!--////////////////////-->	
				
			data +='<div class="row"> <div class="col-md-5"> <label>KUHS Registration Number</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+kuhs_reg_no+' </label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Name of the course</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+class_name+'</label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Medium of Instruction</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label></label> English </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Degree awarded by </label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+awarded_by+'</label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Name of the College of study</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+college_name+'</label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Duration of the course</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label></label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Date of admission</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+admission_date+'</label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Date of completion of course</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label>'+date_completion+'</label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Date of publication of Final Result </label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label></label> </div> </div>';
			data +='<div class="row"> <div class="col-md-5"> <label>Registration No with Kerala Nurses & <br>Midwives Council</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label></label> </div> </div></div><div class="col-md-3"><img src="<?php echo base_url() . "uploads/student_images/no_image.png" ?>" style="width:96px;height:95px;border:0px solid black;"></div>';
			
			data +='</div>';
			
		
		data +='<table style="width: 100%;margin-top: 21px;" border="1" class="tg" ><tr><th  rowspan="3" style="text-align:center;font-weight: 100 !important;">Subjects</th><th  colspan="2" style="font-weight: 100 !important;">Theory(in hours)</th><th  colspan="2" style="font-weight: 100 !important;">Clinical Practice(in hours)</th><th  colspan="4" style="font-weight: 100 !important;"><center>Marks Awarded</center></th><th style="font-weight: 100 !important;"  rowspan="3">Total Marks</th></tr><tr ><th style="font-weight: 100 !important;" rowspan="2">Allotted</th><th rowspan="2" style="font-weight: 100 !important;">Attended</th><th style="font-weight: 100 !important;" rowspan="2">Allotted</th><th style="font-weight: 100 !important;" rowspan="2">Attended</th><th style="font-weight: 100 !important;" colspan="2">Theory</th><th style="font-weight: 100 !important;" colspan="2">Practical&VivaVoce </th></tr><tr><th style="font-weight: 100 !important;">Internal marks</th><th style="font-weight: 100 !important;">University marks</th><th style="font-weight: 100 !important;">Internal marks</th><th style="font-weight: 100 !important;" >University marks </th> </tr>';
		
	$.each(response,function(i,obj)	
			{	
			var c=1;
			var grandtotal=0;
data +='<tr><th style="font-size: 13px;font-weight: bold;text-align: left; padding-left: 11px;" colspan="10">'+obj.section+'</th></tr>';
 
  $.each(obj.section_id,function(i,obj)
  {
	  
data +='<tr > <td style="text-align: left; padding-left: 11px;">'+c+'. '+obj.name+' </td><td style="text-align:center;">60</td>';
if(obj.total_hour == null)
{
data +='<td style="text-align:center;"> - </td>';
}
else
{
data +='<td style="text-align:center;">'+obj.total_hour+' </td>';
}
data +='<td style="text-align:center;">60</td>';
//if(obj.type=="Practical")
//{
//data +='<td style="text-align:center;">'+obj.total_hour+' </td>';}
//else {
	data +='<td style="text-align:center;"> </td>';
	//}
  var result=Number(obj.mark) + Number(obj.university_mark);
   grandtotal=grandtotal + result ;
 
  if(obj.mark==null)
  {
data +='<td style="text-align:center;">-</td>';
  }
  else
  {
	data +='<td style="text-align:center;">'+obj.mark+'</td>';  
  }
  if(obj.university_mark==null)
  {
data +='<td style="text-align:center;">-</td>';
  }
  else
  {
	  data +='<td style="text-align:center;">'+obj.university_mark+'</td>';
	  }
  
data +='<td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">'+result+'/100 </td></tr>'; 
c=c+1;
});
<?php /*?><tr class="tacenter"><td>2.Physiology </td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr class="tacenter"><td>3.Microbiology </td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr class="tacenter" ><td> 4.Psychology</td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr><th style="font-size: 16px;font-weight: bold;text-align: left;">Total</th><th></th><th> </th><th></th><th></th><th></th><th></th><th>-</th><th></th><th></th></tr><?php */?>
data +='</tr><tr><th style="font-size: 16px;font-weight: bold;text-align: left;">Total</th><th></th><th> </th><th></th><th></th><th></th><th></th><th> </th><th></th><th>'+grandtotal+'/800</th></tr>';
			});
		
		<?php /*?>data +='<tr><th style="font-size: 16px;font-weight: bold;text-align: left;" colspan="10">Second Year</th></tr><tr class="tacenter"><td>1.MedicalSurgical Nursing 1 </td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr class="tacenter"><td>2.Surgical Nursing  </td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr class="tacenter"><td>3. Pharmacology  </td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr class="tacenter" ><td> 4. Community Health Nursing 1 </td><td>60</td><td> </td><td>-</td><td>-</td><td>/25</td><td>/75</td><td>-</td><td>-</td><td>100</td></tr><tr><th style="font-size: 16px;font-weight: bold;text-align: right;">Total</th><th></th><th> </th><th></th><th></th><th></th><th></th><th>-</th><th></th><th></th></tr>';<?php */?>
		
	
	
	
		
		data +='</table>';		
			 
			     
			  data += '<div class="row" style="margin-top: 64px;"> <div class="col-md-3"> <label>Aggregate Marks</label> </div><div class="col-md-1"> :</div>    <div class="col-md-3"> <label></label> </div><div class="col-md-4"> <label> Max Marks(Four Years) : 3250</label> </div>  </div> ';
			 
			  data +='<div class="row"> <div class="col-md-3"> <label>Percentage Marks</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label></label></div> </div> ';
			 
			  data +='<div class="row"> <div class="col-md-3"> <label>Class</label> </div>  <div class="col-md-1"> :</div>    <div class="col-md-6"> <label></label> </div> </div> ';
			 
			 
		data +='<div class="row" style="margin-top: 19px;"> <center><label style="font-weight:bold;"> CERTIFICATE </label></center>';
		data +='</div>';
		
		data +='<div class="row" style="text-align: justify;"><p>This is to certify and confirm that Mr./Ms '+studname+' with KUHS Registration No'+kuhs_reg_no+' was a bonafide student of '+class_name+' course from '+admission_date+' to ' +date_completion+ ' at '+college_name+'(Name of College).  This is a regular course conducted as per requirements prescribed by the Kerala University of Health Sciences, Thrissur, Kerala, Indian Nursing Council, New Delhi, and Kerala Nurses and Midwives Council, Thiruvananthapuram, Kerala. He/She has successfully completed the course and was awarded the degree at the convocation held on '+date_completion+' </p>';
		data +='</div>';
		
		data +='<div class="row" style="margin-top: 34px;">';	
		data +='<div class="col-md-8">';	
		
		data +='<div class="row"> Place </div>';
		data +='<div class="row"> Date </div>';
		
		
			
		data +='</div>'; 
		
		data +='<div class="col-md-4"> <b> Name & Signature of College Principal </b>';
		data +='</div>';	
		data +='</div>';	
		data +='<div class="row" style="text-align:center;"> Seal </div>';
		
		
			
				
                //data += '<tbody>';
                //$.each(response, function (i, obj)
                //{
                    //var now = new Date(obj.date_of_exam);
                    //var str = now.toString(date_format);
                    //var date = Date.parse(str);
                    //date_formatted = (date.toString(date_format));
                    
					//data += '<tr>';
               // data += "<td><?php //echo $this->lang->line('name_of_student'); ?> </td> <td > :</td>";
				//data +='</tr>';
				//data += '<tr>';
				//data +="<td> <?php //echo $this->lang->line('gender'); ?>  </td> <td> :</td>";
				//data +='</tr>' ;
			
				
				
				
                    //data += '<td class="">' + obj.name + ' (' + obj.type.substring(2, 0) + '.)</td>';
                    //data += '<td class="">' + date_formatted + '</td> ';
                    //data += '<td style="width:200px;" class="text text-center">' + obj.start_to + '</td> ';
                    //data += '<td style="width:200px;" class="text text-center">' + obj.end_from + '</td> ';
                    //data += '<td class="text text-center">' + obj.room_no + '</td> ';
                    //data += '<td class="text text-center">' + obj.full_marks + '</td>';
                    //data += '<td class="text text-center">' + obj.passing_marks + '</td>';
                    //data += '</tr>';
                
                //data += '</tbody>';
                //data += '</table>';
                //data += '</div>  ';

                $('.modal-body').html(data);

//===========

                //var dtable = $('.sss').DataTable();
               

                //dtable.buttons(0, null).container().prependTo(
                        //dtable.table().container()
                        //);

//===========

                $("#scheduleModal").modal('show');
            }
        });
    });

</script>

<script type="text/javascript">
  
   /*$(document).on('click', '#printtrans', function () {
	
   
     var printContents = document.getElementById('transcript').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

   
   });
   
   */
   
   
   </script>  







<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="document">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <center> <h4 class="modal-title"></h4></center>
            </div>
            <div class="modal-body" id="transcript" style="margin-left: 34px; margin-right: 34px;">
            
            </div>
            <div class="modal-footer">
             <button type="button" aria-controls="DataTables_Table_0" class="btn btn-sm btn-danger login-submit-cs fa fa-print buttons-print" id="printtrans"><?php echo $this->lang->line('print'); ?></button>
                <button type="button" class="btn btn-default " data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>





