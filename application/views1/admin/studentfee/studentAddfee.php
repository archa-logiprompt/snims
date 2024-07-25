<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap-multiselect.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap-multiselect.js"></script>
-->
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>backend/plugins/select2/select2.min.js"></script>


<style>

.select2-container {
    box-sizing: border-box;
    display: inline-block;
    margin: 0;
    position: relative;
    vertical-align: middle;
    width: 100% !important;
	
	
}



.select2-container--default .select2-search--inline .select2-search__field {
    background: transparent;
    border: none;
    outline: 0;
    width: 100% !important;
	
	
}
</style>


<div class="content-wrapper">    
    <div class="row">  
        <div class="col-md-12">
            <section class="content-header">
                <h1>
                    <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?><small><?php echo $this->lang->line('student_fee'); ?></small></h1>
            </section>
        </div>
        <div>    
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">
                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
                                ?>
                                <li <?php
                                if ($student["section_id"] == $svalue["section_id"]) {
                                    echo "class='active'";
                                }
                                ?> ><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]); ?></a></li>
<?php } ?>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php foreach ($class_section as $skey => $snvalue) {
                            ?>
                            <div class="tab-pane <?php
                                 if ($student["section_id"] == $snvalue["section_id"]) {
                                     echo "active";
                                 }
                                 ?>" id="section<?php echo $snvalue["section_id"]; ?>">
    <?php
    foreach ($studentlistbysection as $stkey => $stvalue) {
        if ($stvalue['section_id'] == $snvalue["section_id"]) {
            ?>
                                        <div class="studentname">
                                            <a class="" href="<?php echo base_url() . "studentfee/addfee/" . $stvalue["id"] ?>">
                                                <div class="icon"><img src="<?php echo base_url() . $stvalue["image"]; ?>" alt="User Image"></div>
                                                <div class="student-tittle"><?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?></div></a>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                            </div>
<?php } ?>
                        <div class="tab-pane" id="sectionB">
                            <h3 class="control-sidebar-heading">Recent Activity 2</h3>
                        </div>

                        <div class="tab-pane" id="sectionC">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <div class="tab-pane" id="sectionD">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div> 
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </aside>
        </div></div>  
    <!-- /.control-sidebar -->
    <section class="content">
        <div class="row">
     
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="box-title"><?php echo $this->lang->line('student_fees'); ?></h3>
                            </div>  
                            <div class="col-md-8 ">
                                <div class="btn-group pull-right">
                                    <a href="<?php echo base_url() ?>studentfee" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-arrow-left"></i> <?php echo $this->lang->line('back'); ?></a>
                                </div>
                            </div>
                        </div>  
                    </div><!--./box-header-->    
                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sfborder">  
                                    <div class="col-md-2">
                                        <img width="115" height="115" class="round5" src="<?php if(!empty($student['image'])){ echo base_url() .$student['image']; }else { echo base_url() ."uploads/student_images/no_image.png"; } ?>" alt="No Image">
                                    </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <table class="table table-striped mb0 font13">
                                                <tbody>
                                                    <tr>
                                                        <th class="bozero"><?php echo $this->lang->line('name'); ?></th>
                                                        <td class="bozero"><?php echo $student['firstname'] . " " . $student['lastname'] ?></td>

                                                        <th class="bozero"><?php echo $this->lang->line('class_section'); ?></th>
                                                        <td class="bozero"><?php echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo $this->lang->line('father_name'); ?></th>
                                                        <td><?php echo $student['father_name']; ?></td>
                                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                        <td><?php echo $student['admission_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                                        <td><?php echo $student['mobileno']; ?></td>
                                                        <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                        <td> <?php echo $student['roll_no']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo $this->lang->line('category'); ?></th>
                                                        <td>
                                                            <?php
                                                            foreach ($categorylist as $value) {
                                                                if ($student['category_id'] == $value['id']) {
                                                                    echo $value['category'];
                                                                }
                                                            }
                                                            ?>                                              
                                                        </td>
                                                        <th><?php echo $this->lang->line('rte'); ?></th>
                                                        <td><b class="text-danger"> <?php echo $student['rte']; ?> </b>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div></div>
                            <div class="col-md-12">
                                <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-md-2 mDMb10">
                                <a href="#" class="btn btn-xs btn-info printSelected"><i class="fa fa-print"></i> <?php echo $this->lang->line('print_selected'); ?> </a>
                                <span class="pull-right"><?php echo $this->lang->line('date'); ?>: <?php echo date($this->customlib->getSchoolDateFormat()); ?></span>
                            </div>
                            
                            <div class="col-md-2 mDMb10">
                                <a  data-toggle="modal" data-target="#fee_advance" href="#" class="btn btn-xs btn-info fee_advance "> <?php echo $this->lang->line('fee_advance'); ?> </a></div>
                                
                                 <div class="col-md-2 mDMb10">
                                <a  data-toggle="modal" data-target="#fee_excess" href="#" class="btn btn-xs btn-info fee_excess "> <?php echo $this->lang->line('fee_excess'); ?> </a>
                                
                                
                            </div>
                            
                            
                            
                        </div>   
                        <div class="table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('student_fees') . ": " . $student['firstname'] . " " . $student['lastname'] ?> </div>
                            <table class="table table-striped table-bordered table-hover example table-fixed-header">
                                <thead class="header">
                                    <tr>
                                    <th><?php echo $this->lang->line('all'); ?>
                                    <input type="checkbox" id="select_all"/> </th>
                                                                                 <th align="left"><?php echo $this->lang->line('fees_group'); ?></th>
                                        <th align="left"><?php echo $this->lang->line('fees_code'); ?></th>
                                        <th align="left" class="text text-left"><?php echo $this->lang->line('due_date'); ?></th>
                                        <th align="left" class="text text-left"><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text text-right"><?php echo $this->lang->line('amount') ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                        <th class="text text-left"><?php echo $this->lang->line('payment_id'); ?></th>
                                        <th class="text text-left"><?php echo $this->lang->line('mode'); ?></th>
                                        <th  class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                        <th class="text text-right" ><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                        <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                        <th class="text text-right"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                        <th class="text text-right"><?php echo $this->lang->line('balance'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                        <th class="text text-right"><?php echo $this->lang->line('action'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_amount = 0;
                                    $total_deposite_amount = 0;
                                    $total_fine_amount = 0;
                                    $total_discount_amount = 0;
                                    $total_balance_amount = 0;
                                    $alot_fee_discount = 0;
                                     $bal=array();
									  $ar=array();
									  $stud_id=array();
									  $fine_array=array();
									   
                                    foreach ($student_due_fee as $key => $fee) {
										
									
									
										
										  foreach ($fee->fees as $fee_key => $fee_value) {
								
                                            $fee_paid = 0;
                                            $fee_discount = 0;
                                            $fee_fine = 0;
											$total_fee_paid_fine=0;
											$fixed_fine=0;
										    $amountfine=0;
									$due_date=$fee_value->due_date;
									$current_date=date('Y-m-d');
								   
						
											$date1=date_create($due_date);
											 $date2=date_create($current_date);
											 $diff=date_diff($date1,$date2);
											 $days=$diff->format("%a days");
											  $months=round($days/30);	
                                              $week=round($days/7);
						                 
			                        if($current_date > $due_date)
											 {
											 
											 if($fee_value->finetype=='Monthly')
											 
											{
												
									/*$next_due_date=date('Y-m-d',strtotime('+30 days',strtotime($due_date)));
								   $next_after_due_date = date('Y-m-d', strtotime($next_due_date .' +1 day'));*/	     
								   
								  
								    $i=0;
									while($i<$months){
												
												if($fee_value->amounttype =='Fixed Amount')
												{
												
										$fixed_fine = $fixed_fine+$fee_value->fixedamount;
											
									}	
									
									else if($fee_value->amounttype =='Percentage')
									
									{
										$per=($fee_value->percentage/100)*$fee_value->amount;
										$fixed_fine=$fixed_fine+$per;
						
										}
										
										else{}
									
									$i++;
									}}
												
											 else if($fee_value->finetype=='Weekly')
											 
											 {
					                            $i=0;
												while($i<$week)
												{
												
												if($fee_value->amounttype =='Fixed Amount')
												{
												
										$fixed_fine = $fixed_fine+$fee_value->fixedamount;
											
									}	
												
												else if($fee_value->amounttype =='Percentage')
									
									{
							$per=($fee_value->percentage/100)*$fee_value->amount;
										$fixed_fine=$fixed_fine+$per;
						
										}
										
										else{}
												
											$i++;		
													
													
												} }
												
												
											 
											 else if($fee_value->finetype=='Daily')
											 {
												 $i=0;
												 while($i<$days)
												 {
													if($fee_value->amounttype =='Fixed Amount')
												{
												
										$fixed_fine = $fixed_fine+$fee_value->fixedamount;
											
									}	 
										
										else if($fee_value->amounttype =='Percentage')
									
									{
										$per=($fee_value->percentage/100)*$fee_value->amount;
										$fixed_fine=$fixed_fine+$per;
						
										}
										
										else{}
										
										$i++;
										 } }
												  
												 
											else{}	 
											
											 }
										 
										 if(empty($fee_value->amount_detail))
										 {
											 $amountfine=$fixed_fine;
											 }
										 
										 
											 
											 
                                            if (!empty($fee_value->amount_detail)) {
                                                $fee_deposits = json_decode(($fee_value->amount_detail));
												
                                              
                                                foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
													
                                                  
												
													
                                                    $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                    $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
													$fee_paid = $fee_paid + $fee_deposits_value->amount;
													$total_fee_paid_fine=($fee_deposits_value->amount_fine+$fee_deposits_value->amount)-$fee_deposits_value->amount_discount;
												
											
                                                }
												
												if($fee_fine ==0 && $fixed_fine!=0)
								                 {
									         $amountfine=$fixed_fine;
									
									               }
										
												
                                            }
											
											
											
											
                                            $total_amount = $total_amount + $fee_value->amount;
                                            $total_discount_amount = $total_discount_amount + $fee_discount;
                                            //$total_deposite_amount = $total_deposite_amount + $fee_paid;
											$total_deposite_amount = $total_deposite_amount + $fee_paid+$fee_fine;
											
                                            
											//$total_fine_amount = $total_fine_amount + $fee_fine;
											$total_fine_amount = $total_fine_amount + $fixed_fine;
                                   $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
											
											
                                            $total_balance_amount = $total_balance_amount + $feetype_balance;
											
											
											if($feetype_balance!=0)
											{
											array_push($bal,$feetype_balance);
											
											$arr=$fee_value->fee_groups_feetype_id;
										    array_push($ar,$arr);
										  
											 array_push($stud_id,$fee_value->id);
											 array_push($fine_array,$fixed_fine);
											}
                                            ?>
                                            
                                            
                                            
                                            
                                                <?php
                                                if ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                    ?>
                                                <tr class="danger font12">
                                                    <?php
                                                } else {
                                                    ?>
                                                <tr class="dark-gray">
                                                        <?php
                                                    }
                                                    ?>
                                                <td><input class="checkbox" type="checkbox" name="fee_checkbox" data-fee_master_id="<?php echo $fee_value->id ?>" data-fee_session_group_id="<?php echo $fee_value->fee_session_group_id ?>" data-fee_groups_feetype_id="<?php echo $fee_value->fee_groups_feetype_id ?>"></td>
                                                <td align="left"><?php
                                            echo $fee_value->name;
                                                    ?></td>
                                                    
                                                  
                                                <td align="left"><?php echo $fee_value->code; ?></td>
                                                <td align="left" class="text text-left">

                                                    <?php
                                                    if ($fee_value->due_date == "0000-00-00") {
                                                        
                                                    } else {

                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                    }
                                                    ?>
                                                </td>
                                                <td align="left" class="text text-left width85">
                                                    <?php
                                                     if ($feetype_balance == 0) {
                                                        ?>
                                                        <span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                        } else if (!empty($fee_value->amount_detail)) {
                                                            ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php                             
                                            } else {
                                                ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                            }
                                            ?>
                                            
                                              </td>
                                              
                                              
                                       
                                                <td class="text text-right"><?php echo $fee_value->amount; ?></td>

                                                <td class="text text-left"></td>
                                                <td class="text text-left"></td>
                                                <td class="text text-left"></td>
                                                <td class="text text-right"><?php
                                                 echo (number_format($fee_discount, 2, '.', ''));
                                                    ?></td>
                                                <td class="text text-right"><?php
                                       echo (number_format($amountfine, 2, '.', ''));
                                                    ?></td>
                                                <td class="text text-right"><?php
                                                 echo (number_format($fee_paid, 2, '.', ''));
                                                    ?></td>
                                                <td class="text text-right"><?php
                                                    $display_none = "ss-none";
                                                    if ($feetype_balance > 0) {
                                                        $display_none = "";


                                                        echo (number_format($feetype_balance, 2, '.', ''));
                                                    }
                                                    ?>
                                          <input type="hidden" name="balance" class="hidbalance" value="<?php echo (number_format($feetype_balance, 2, '.', '')) ?>"  />       
                                                </td>
                                                <td>
                                                    <div class="btn-group pull-right"> 
                                                        <button type="button" data-student_session_id="<?php echo $fee->student_session_id; ?>" data-fine="<?php echo (number_format($fixed_fine, 2, '.', ''));  ?>" data-student_fees_master_id="<?php echo $fee->id; ?>" data-fee_groups_feetype_id="<?php echo $fee_value->fee_groups_feetype_id; ?>" 
                                                                data-group="<?php echo $fee_value->name; ?>"
                                                                data-type="<?php echo $fee_value->code; ?>"
                                                                class="btn btn-xs btn-default myCollectFeeBtn <?php echo $display_none; ?>"
                                                                title="<?php echo $this->lang->line('add_fees'); ?>" data-toggle="modal" data-target="#myFeesModal"
                                                                ><i class="fa fa-plus"></i></button>


                                                        <button  class="btn btn-xs btn-default printInv" data-fee_master_id="<?php echo $fee_value->id ?>" data-fee_session_group_id="<?php echo $fee_value->fee_session_group_id ?>" data-fee_groups_feetype_id="<?php echo $fee_value->fee_groups_feetype_id ?>"  
                                                                 title="<?php echo $this->lang->line('print'); ?>"
                                                                 ><i class="fa fa-print"></i> </button>
                                                    </div>        
                                                </td>


                                            </tr>

                                            <?php
                                            if (!empty($fee_value->amount_detail)) {

                                                $fee_deposits = json_decode(($fee_value->amount_detail));
                                                  $total_refund =0;
													
													
													
                                                foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
													
													
													
													
													$total_fee_paid=$fee_deposits_value->amount_fine + $fee_deposits_value->amount;
													


$fine=$fee_deposits_value->amount_fine;




													
                                                    ?>
                                                    
                                                    
                                                    <tr class="white-td">
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                        <td class="text text-left">


                                                            <a href="#" data-toggle="popover" class="detail_popover" > <?php echo  $fee_deposits_value->inv_no; ?></a>
                                                            <div class="fee_detail_popover" style="display: none">
                                                                <?php
                                                                if ($fee_deposits_value->description == "") {
                                                                    ?>
                                                                    <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                    <?php
                }
                ?>
                                                            </div>


                                                        </td>
                                                        <td class="text text-left"><?php echo $fee_deposits_value->payment_mode; ?> <?php echo $fee_deposits_value->description; ?></td>
                                                        <td class="text text-left">

                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                        </td>
                                                        <td class="text text-right"><?php echo ( number_format($fee_deposits_value->amount_discount, 2, '.', '')); ?></td>
                                                        <td class="text text-right"><?php echo ( number_format($fee_deposits_value->amount_fine, 2, '.', '')); ?></td>
                                                        <td class="text text-right"><?php //echo ( number_format($fee_deposits_value->amount, 2, '.', '')); 
														
														
													echo ( number_format($total_fee_paid, 2, '.', ''));	
														
														?></td>
                                                        <td></td>
                                                        <td class="text text-right">
                                                            <div class="btn-group pull-right"> 

                                                                <?php if ($this->rbac->hasPrivilege('collect_fees', 'can_delete')) { ?>
                                                                    <button class="btn btn-default btn-xs" data-invoiceno="<?php echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?>" data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>" data-toggle="modal" data-target="#confirm-delete" title="<?php echo $this->lang->line('revert'); ?>">
                                                                        <i class="fa fa-undo"> </i>
                                                                    </button>
                                                                    
                                                                    
                                                                
                                                                    
                                                    <?php } ?>
                                                                <button  class="btn btn-xs btn-default printDoc" data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>"  title="<?php echo $this->lang->line('print'); ?>"><i class="fa fa-print"></i> </button>
                                                            </div>   
                                                        </td>
                                                    </tr>
                                                    <?php
												$total_refund = $total_refund + $total_fee_paid;	
													
                                                }
													    
											if(isset($fee_value->refund_detail))
												{
												 $r_amount=json_decode($fee_value->refund_detail); 	
												
									$bal_refund_amount=$total_refund - $r_amount->amount; 
												 
												}
												
												else
												{
												$bal_refund_amount=$total_refund;	
													
												}
												
												
												
												
												?>
                                                
                                                 
												       <tr class="white-td"> 
                                                 
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        
                                                        <td align="left"></td>
                                                       
                                                        <td align="left"></td>
                                                         <?php if(!empty($fee_value->refund_detail)) { 
														 
														$refund_detail=json_decode($fee_value->refund_detail) 
														?>
                                                        <td align="left" colspan="2">
                                                        
                                                        <p class="text text-danger">
                                                         Amount Refunded <?php echo $currency_symbol.$refund_detail->amount ?> 
                                                        <p>
                                                         </td>
                                                         
                                                       
                                                        <td align="left"> <?php echo $refund_detail->payment_mode ?> </td>
                                                         <td align="left"><?php echo $refund_detail->date ?></td>
                                                         
                                                        <?php } else { ?>
                                                        
                                                        <td align="left"></td>
														 <td align="left"></td>
                                                        <td align="left"></td>
                                                         <td align="left"></td>
														
														<?php }?>
                                                       
                                                       
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                         <td align="left"></td>
                                                          <td align="left"></td>
                                                        <td align="left">
                                                          <div class="btn-group pull-right"> 
                                                            <button class="btn btn-default btn-xs" data-total_refund_amount="<?php echo $bal_refund_amount?>" data-fine="<?php echo $fine ?>" data-refunded_amount= "<?php echo  $r_amount->amount;  ?>" data-fee_master_id="<?php echo $fee_value->id ?>" data-fee_session_group_id="<?php echo $fee_value->fee_session_group_id ?>" data-fee_groups_feetype_id="<?php echo $fee_value->fee_groups_feetype_id ?>" data-toggle="modal" data-target="#confirm-refund" title="<?php echo $this->lang->line('refund'); ?>">
                                                       <i class="fa fa-reply"> </i>
                                                                    </button>
                                                        </div>
                                                        </td>  
                                                 
                                                 </tr>
												
												
											<?php 	
                                            }
                                            ?>
                                            <?php
											
                                        }
										$feetype=implode(',',$ar);
										$feetbalanceamount=implode(',',$bal);
										$headwise_fine=implode(',',$fine_array);
										
                                    }
									
									$stud_feemaster=implode(',',$stud_id);
									
                                    ?>
                                    <?php 
                                    //if (!empty($student_discount_fee)) {

                                        //foreach ($student_discount_fee as $discount_key => $discount_value) {
											
                                            ?>
                                            <!--<tr class="dark-light">
                                                <td></td>
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
                                                            //if ($discount_value['student_fees_discount_description'] == "") {
                                                                ?>
                                                                <p class="text text-danger"><?php //echo $this->lang->line('no_description'); ?></p>
                                                                <?php
                                                            //} else {
                                                                ?>
                                                                <p class="text text-danger"><?php // $discount_value['student_fees_discount_description'] ?></p>
                                                            <?php
                                                        //}
                                                        ?>

                                                        </div>
                                                        <?php
                                                    //} else {
                                                       // echo '<p class="text text-danger">' . $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']);
                                                    
									
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
                                                <td></td>
                                                <td>
                                                    <div class="btn-group pull-right"> 
                                                        <?php
                                                        //if ($discount_value['status'] == "applied") {
                                                            ?>

                                                            <?php //if ($this->rbac->hasPrivilege('collect_fees', 'can_delete')) { ?>
                                                                <button class="btn btn-default btn-xs" data-discounttitle="<?php //echo $discount_value['code']; ?>" data-discountid="<?php //echo $discount_value['id']; ?>" data-toggle="modal" data-target="#confirm-discountdelete" title="<?php //echo $this->lang->line('revert'); ?>">
                                                                    <i class="fa fa-undo"> </i>
                                                                </button>
                <?php
            //}
       // }
        ?>

                                                        <button type="button" data-modal_title="<?php //echo $this->lang->line('discount') . " : " . $discount_value['code']; ?>" data-student_fees_discount_id="<?php //echo $discount_value['id']; ?>" 
                                                                class="btn btn-xs btn-default applydiscount"
                                                                title="<?php //echo $this->lang->line('apply_discount'); ?>"
                                                                ><i class="fa fa-check"></i>
                                                        </button>

                                                    </div> 
                                                </td>
                                            </tr>-->
        <?php
    //}
//}
?>

        <?php if(!empty($fee_excess))  foreach($fee_excess as $ex_fee) {
	
	$ex_amount=json_decode($ex_fee->amount_detail);
	foreach($ex_amount as $examount)
	{
	
	
	?>



                                                        <tr class="white-td">
                                                        <td align="left"><input class="checkbox" type="checkbox" name="fee_checkbox"></td>
                                                        <td align="left"></td>
                                                        <td align="left"><?php echo $ex_fee->type ?></td>
                                                        <td align="left"></td>
                                                        <td align="left"><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span></td>
                                                       <td align="left"></td>
                                                        <td class="text text-left">


                                                            <a href="#" data-toggle="popover" class="detail_popover" > <?php echo  $examount->invo; ?></a>
                                                            


                                                        </td>
                                                        <td class="text text-left"><?php echo $examount->payment_mode.' '.$examount->description ?> </td>
                                                        <td class="text text-left">

                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($examount->date)); ?>
                                                        </td>
                                                        <td class="text text-right"></td>
                                                        <td class="text text-right"></td>
                                                        <td class="text text-right"><?php echo (number_format($examount->amount, 2, '.', '')); 
														
														
												
														
														?></td>
                                                        <td></td>
                                                        <td class="text text-right">
                                                            <div class="btn-group pull-right"> 

                                                              
                                                                    <button class="btn btn-default btn-xs"  data-id="<?php echo $ex_fee->id ?>"  data-toggle="modal" data-target="#fee_ex_delete" title="<?php echo $this->lang->line('revert'); ?>">
                                                                        <i class="fa fa-undo"> </i>
                                                                    </button>
                                                                  
                                                                <button  class="btn btn-xs btn-default printDoc" data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>"  title="<?php echo $this->lang->line('print'); ?>"><i class="fa fa-print"></i> </button>
                                                            </div>   
                                                        </td>
                                                    </tr>



                                  <?php } }?>





<?php if(!empty($fee_advance)) foreach($fee_advance as $fee_ad) { 

$ad_amount=json_decode($fee_ad->amount_detail);

foreach($ad_amount as $admount){
?>

                                                        <tr class="white-td">
                                                        <td align="left"><input class="checkbox" type="checkbox" name="fee_checkbox"> </td>
                                                        <td align="left"></td>
                                                        <td align="left"><?php echo $fee_ad->type ?></td>
                                                        <td align="left"></td>
                                                        <td align="left"><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span></td>
                                                       <td align="left"></td>
                                                        <td class="text text-left">


                                                            <a href="#" data-toggle="popover" class="detail_popover" > <?php echo  $admount->invo; ?></a>
                                                            


                                                        </td>
                                                        <td class="text text-left"><?php echo $admount->payment_mode .' '.$admount->description ?> </td>
                                                        <td class="text text-left">

                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($admount->date)); ?>
                                                        </td>
                                                        <td class="text text-right"></td>
                                                        <td class="text text-right"></td>
                                                        <td class="text text-right"><?php echo ( number_format($admount->amount, 2, '.', '')); 
														
														
												
														
														?></td>
                                                        <td></td>
                                                        <td class="text text-right">
                                                            <div class="btn-group pull-right"> 

                                                                <?php if ($this->rbac->hasPrivilege('collect_fees', 'can_delete')) { ?>
                                                                    <button class="btn btn-default btn-xs"  data-id="<?php echo $fee_ad->id ?>"   data-toggle="modal" data-target="#fee_ad_delete" title="<?php echo $this->lang->line('revert'); ?>">
                                                                        <i class="fa fa-undo"> </i>
                                                                    </button>
                                                                    
                                                                    
                                                                
                                                                    
                                                    <?php } ?>
                                                                <button  class="btn btn-xs btn-default printDoc" data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>"  title="<?php echo $this->lang->line('print'); ?>"><i class="fa fa-print"></i> </button>
                                                            </div>   
                                                        </td>
                                                    </tr>




 <?php }} ?>











                                    <tr class="box box-solid total-bg">
                                        <td align="left" ></td>
                                        <td align="left" ></td>
                                        <td align="left" ></td>
                                        <td align="left" ></td>
                                        <td align="left" class="text text-left" ><?php echo $this->lang->line('grand_total'); ?></td>
                                        <td class="text text-right" id="grandtotal"><?php
echo ($currency_symbol . number_format($total_amount, 2, '.', ''));
?></td>
                                        <td class="text text-left"></td>
                                        <td class="text text-left"></td>
                                        <td class="text text-left"></td>

                                        <td class="text text-right"><?php
                                            echo ($currency_symbol . number_format($total_discount_amount + $alot_fee_discount, 2, '.', ''));
                                            ?></td>
                                        <td class="text text-right"><?php
                                            echo ($currency_symbol . number_format($total_fine_amount, 2, '.', ''));
                                            ?></td>
                                        <td class="text text-right"><?php
                                            echo ($currency_symbol . number_format($total_deposite_amount, 2, '.', ''));
                                            ?></td>
                                        <td class="text text-right"><?php
										 $display_none = "ss-none";
										 if($total_balance_amount >0)
										 {
											 $display_none="";
                                            echo ($currency_symbol . number_format($total_balance_amount - $alot_fee_discount, 2, '.', '')); }
                                            ?></td>  <td class="text text-right"> 
                                            
                                            
                                            <div class="btn-group pull-right"> 
                                                        <button type="button" data-student_session_id="<?php echo $fee->student_session_id; ?>" data-student_fees_master_id="<?php echo $stud_feemaster; ?>" data-headwise_fine="<?php  echo $headwise_fine?>" data-fee_groups_feetype_id="<?php echo $feetype ?>" data-student_id="<?php echo $fee_value->student_id ?>" data-balance_amount="<?php echo $feetbalanceamount ?>" data-group="Total Fee" 
 class="btn btn-xs btn-default myCollectFeeBtn <?php echo $display_none; ?>"
title="<?php echo $this->lang->line('add_fees'); ?>" data-toggle="modal" data-target="#myFeesModal2">
<i class="fa fa-plus"></i></button>


                                                        <button  class="btn btn-xs btn-default printInv" data-fee_master_id="<?php //echo $fee_value->id ?>" data-fee_session_group_id="<?php //echo $fee_value->fee_session_group_id ?>" data-fee_groups_feetype_id="<?php echo $feetype ?>"  
                                                                 title="<?php echo $this->lang->line('print'); ?>"
                                                                 ><i class="fa fa-print"></i> </button>
                                                    </div>
                                            
                                            
                                            
                                         
                                            </td>
                                            
                                            
                                  
                                            
                                            
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                   
                   <?php if(!empty($billdetail)) { ?>
                   <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                      <!--  <h3 class="box-title titlefix"><i class="fa fa-users"></i>  <?php //echo $this->lang->line('assign_group') ?></h3>-->
                         
                     
                    </div>
                    <div class="box-body table-responsive">
					
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                               <!-- <th><input type="checkbox" id="select_all"/> <?php //echo $this->lang->line('all'); ?></th>-->
                                    
                                    <th><?php echo $this->lang->line('bill_no'); ?></th>
                                   
                                     <th><?php echo $this->lang->line('bill_date'); ?></th>
                                <th><?php echo $this->lang->line('amount'); ?></th>    
                                 <th></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach($billdetail as $key=>$val) {
								 
								   
								   ?>
                                        <tr>
                                      <!--  <td> </td>-->
                                        
                                            <td><?php echo $key; ?></td>
                                            
                                            <td><?php echo $val['date']; ?> 
                                            </td>
                                            
                                            <td> <?php echo $val['amount']; ?></td>
                                          <td> <a href="#" data-billamount="<?php echo $val['amount'] ?>" data-type="<?php echo $val['type'] ?>" data-billdate="<?php echo $val['date'] ?>" data-mode="<?php echo $val['mode'] ?>" data-billno="<?php echo $key ?>"class="btn btn-xs btn-info print_billwise"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?> </a> </td>
                                           
                                        </tr>
                                       
                                       <?php } ?>
                                       
                            </tbody>
                        </table>
                     <div>   
                <!--  <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right schedule_modal" id="load"> <?php //echo $this->lang->line('clinical_group'); ?>-->
                                            </button>
                                            </div>
                                            <div>
                                           
                                            </div>
                         
                        
                    </div>
                    
                   
                    
                    
                    
                </div>
                   
                   
                   
                <?php } ?>   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   

            </div>
            <!--/.col (left) -->

        </div>

    </section>

</div>






<div class="modal fade" id="myFeesModal" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center fees_title"></h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input  type="hidden" class="form-control" id="guardian_phone" value="<?php echo $student['guardian_phone'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="guardian_email" value="<?php echo $student['guardian_email'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="student_fees_master_id" value="0" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="fee_groups_feetype_id" value="0" readonly="readonly"/>
                      <input type="hidden" class="form-control" id="type" value="" />
                      <input type="hidden" class="form-control" id="stud_name" value="<?php echo $student["firstname"] . " " . $student["lastname"]; ?>" />
                      <input type="hidden" class="form-control" id="group" value="" />
                        
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $this->lang->line('date'); ?></label>
                            <div class="col-sm-9">
                                <input  id="date" name="admission_date" placeholder="" type="text" class="form-control date"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('amount'); ?> </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="amount" value="0"  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        
                           <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"> Invoice no </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="ad_invo" name="ad_invo" value=""  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('discount'); ?> <?php echo $this->lang->line('group'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control modal_discount_group" id="discount_group">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>


                        <div class="form-group mb0">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('discount'); ?><small class="req">*</small></label>
                            <div class="col-sm-9">

                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="amount_discount" value="0">

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div> 
                                <div class="col-md-2 col-sm-2 ltextright">

                                    <label for="inputPassword3" class="row control-label"><?php echo $this->lang->line('fine'); ?><small class="req">*</small></label>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="amount_fine" value="0">

                                        <span class="text-danger" id="amount_fine_error"></span>
                                    </div>
                                </div>   

                            </div><!--./col-sm-9-->
                        </div>




                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                
                                 <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Bank"><?php echo $this->lang->line('bank'); ?>
                                </label>
                                
                                
                                
                                <span class="text-danger" id="payment_mode_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                    <button type="button" class="btn cfees save_button" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?> </button>
                </div>
            </div>
            
            
          
            
            
            
            
        </div>

    </div>
</div>



<div class="modal fade" id="myDisApplyModal" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center discount_title"></h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input  type="hidden" class="form-control" id="student_fees_discount_id"  value=""/>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment_id'); ?> </label><small class="req">*</small>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" id="discount_payment_id" >

                                <span class="text-danger" id="discount_payment_id_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('description'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="dis_description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                    <button type="button" class="btn cfees dis_apply_button" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('apply_discount'); ?></button>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="delmodal modal fade" id="confirm-discountdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p>Are you sure want to revert <b class="discount_title"></b> discount, this action is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <input type="hidden" name="discount_id"  id="discount_id" value="">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn-discountdel"><?php echo $this->lang->line('revert'); ?></a>
            </div>
        </div>
    </div>
</div>


<div class="delmodal modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p>Are you sure want to delete <b class="invoice_no"></b> invoice, this action is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <input type="hidden" name="main_invoice"  id="main_invoice" value="">
                <input type="hidden" name="sub_invoice" id="sub_invoice"  value="">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn-ok"><?php echo $this->lang->line('revert'); ?></a>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="confirm-refund" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center fees_title"> Refund  </h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        
                        <input  type="hidden" class="form-control" id="re_student_fees_master_id" value="0" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="re_fee_groups_feetype_id" value="0" readonly="readonly"/>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $this->lang->line('date'); ?></label>
                            <div class="col-sm-9">
                                <input  id="date" name="admission_date" placeholder="" type="text" class="form-control date"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('amount'); ?> </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="refund_amount" value="0"  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                <span class="text-danger" id="payment_mode_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                    <button type="button" class="btn cfees btn-refund" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('refund'); ?> </button>
                </div>
            </div>
            
            
          
            
            
            
            
        </div>

    </div>
</div>







<div class="modal fade" data-refresh="true" id="myFeesModal2" role="dialog" >
    <div class="modal-dialog">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="closemodal" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center fees_title"></h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body" id="m_boxbody">
           <input  type="hidden" class="form-control" id="guardian_phone" value="<?php echo $student['guardian_phone'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="guardian_email" value="<?php echo $student['guardian_email'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="student_fees_master_id1" value="0" readonly="readonly"/>
                        
                        <input  type="hidden" class="form-control" id="fee_groups_feetype_id1" value="" readonly="readonly"/>
                         <input  type="hidden" class="form-control" id="totalbalance_amount" value="0" readonly="readonly"/>
                   <input type="hidden" class="form-control" id="cal_amount" value="0" readonly="readonly"/>
                   <input type="hidden" class="form-control" id="fixed_fine" value="0" readonly="readonly"/> 
                   <input type="hidden" class="form-control" id="stud_name" value="<?php echo $student["firstname"] . " " . $student["lastname"]; ?>" />
                         
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $this->lang->line('date'); ?></label>
                            <div class="col-sm-9">
                                <input  id="t_date" name="admission_date" placeholder="" type="text" class="form-control date"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('amount'); ?> </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="amount2" value=""  >

                                <span class="text-danger" id="amount2_error"></span>
                            </div>
                        </div>
                        
                        
                            <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"> Invoice no </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control" id="invo" name="invo" value=""  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        
                        
                        
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('fee_type'); ?></label><small class="req"> *</small>
                            <div class="col-sm-9" id="selectmulti">
        <select multiple="multiple" name="t_fee_groups_feetype_id" class="form-control t_fee_type selectpicker" id="t_fee_type">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                   
                                </select>

                                <span class="text-danger" id="tfeetype_error"></span>
                            </div>
                        </div>

                        
                        
                        
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('discount'); ?> <?php echo $this->lang->line('group'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control modal_discount_group" id="discount_group2">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>

                          
                          <div id="show_feetype">
                           <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('fees_type'); ?> </label><small class="req"> *</small>
                            <div class="col-sm-9">
                                <select title="Select fee type to apply discount group "   name=" dis_fee_type_id " class="form-control modal_discount_group required" id="dis_fee_type_id" >
                                <option value="0"> <?php echo $this->lang->line('select'); ?>  </option>
                                <?php foreach ($student_due_fee as $key => $fee) { 
								   foreach($fee->fees as $fee_key=>$fee_value)
								   {
								
								?>
                                
                                    <option value="<?php echo  $fee_value->fee_groups_feetype_id ?>"> <?php  echo $fee_value->type ?> </option> <?php  }} ?>
                                </select>

                                <span class="text-danger" id="dis_fee_type_id_error"></span>
                            </div>
                        </div>
                        </div>  
                          

                        <div class="form-group mb0">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('discount'); ?><small class="req">*</small></label>
                            <div class="col-sm-9">

                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="amount_discount2" value="0">

                                        <span class="text-danger" id="amount_error"></span></div>
                                </div> 
                                <div class="col-md-2 col-sm-2 ltextright">

                                    <label for="inputPassword3" class="row control-label"><?php echo $this->lang->line('fine'); ?><small class="req">*</small></label>
                                </div>
                                <div class="col-md-5 col-sm-5">
                             <div class="form-group">
                                        <input type="text" class="form-control" id="fixed" value="<?php  //echo (number_format($total_fine_amount, 2, '.', '')); ?>0.00">

                                        <span class="text-danger" id="amount_fine_error"></span>
                                    </div>
                                </div>   

                            </div><!--./col-sm-9-->
                        </div>




                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Bank"><?php echo $this->lang->line('bank'); ?>
                                </label>
                                
                                
                                
                                <span class="text-danger" id="payment_mode_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                    <button type="button" class="btn cfees save_button2" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?> </button>
                </div>
            </div>
        </div>

    </div>
</div>





<div class="modal fade" id="fee_advance" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
         <!--<form id="form1" action="<?php //echo base_url() ?>studentfee/fee_advance"  name="employeeform" method="post" accept-charset="utf-8">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title text-center fees_title"> Fees received in advance</h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        
              
               
                        <input  type="hidden" class="form-control" name="student_id" id="student_id" value=" <?php echo $student['id'] ?>" readonly="readonly"/>
           <input type="hidden" class="form-control" id="stud_name" value="<?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?>" />
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $this->lang->line('date'); ?></label>
                            <div class="col-sm-9">
                                <input  id="ad_date" name="ad_date" placeholder="" type="text" class="form-control date"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('amount'); ?> </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="ad_amount" name="ad_amount" value=""  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        
                       
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"> Invoice no </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control" id="ad_invoice" name="ad_invoice" value=""  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        
                       
                        
                        

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                
                                
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Bank"><?php echo $this->lang->line('bank'); ?>
                                </label>
                                
                                
                                <span class="text-danger" id="payment_mode_error"></span>
                                  
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="ad_note"  name="ad_note" placeholder=""></textarea>
                            </div>
                        </div>
                         
                         
                         
                           
                    </div>
                           
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                    <button type="submit" class="btn cfees btn_feeadvance" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?> </button>
                </div>
            </div>
            
           <!-- <form>-->
            
        </div>

    </div>
</div>





<div class="modal fade" id="fee_excess" role="dialog">
    <div class="modal-dialog">      
        <div class="modal-content">
         <!--<form id="form1" action="<?php //echo base_url() ?>studentfee/fee_advance"  name="employeeform" method="post" accept-charset="utf-8">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title text-center fees_title"> Fees Received in excess</h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        
              
               
                        <input  type="hidden" class="form-control" name="student_id" id="student_id" value=" <?php echo $student['id'] ?>" readonly="readonly"/>
                        
                          <input type="hidden" class="form-control" id="stud_name" value="<?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?>" />
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $this->lang->line('date'); ?></label>
                            <div class="col-sm-9">
                                <input  id="ex_date" name="ex_date" placeholder="" type="text" class="form-control date"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('amount'); ?> </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="ex_amount" name="ex_amount" value=""  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"> Invoice no </label><small class="req"> *</small>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control" id="ex_invo" name="ex_invo" value=""  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        
                        

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Bank"><?php echo $this->lang->line('bank'); ?>
                                </label>
                                
                                <span class="text-danger" id="payment_mode_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="ex_note"  name="ex_note" placeholder=""></textarea>
                            </div>
                        </div>
                           
                    </div>
                           
                </div>
            </div>
            <div class="modal-footer">
                <div class="box-body">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                    <button type="submit" class="btn cfees btn_feeexcess" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?> </button>
                </div>
            </div>
            
           <!-- <form>-->
            
        </div>

    </div>
</div>



<div class="delmodal modal fade" id="fee_ad_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p>Are you sure want to delete, this action is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <input type="hidden" name="fee_ad_id"  id="fee_ad_id" value="">
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn_fee_ad"><?php echo $this->lang->line('revert'); ?></a>
            </div>
        </div>
    </div>
</div>





<div class="delmodal modal fade" id="fee_ex_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p>Are you sure want to revert, this action is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <input type="hidden" name="fee_ex_id"  id="fee_ex_id" value="">
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn_fee_ex"><?php echo $this->lang->line('revert'); ?></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

     $('.checkbox').click(function(){
       
        var unpaid_id = [];
        var paid_amount = [];
        var payment_mode = [];

       $.each($("input[ type='checkbox']:checked"), function(){             

            unpaid_id.push($(this).val());

        });
        var unpaid_id = unpaid_id.join(",");

       // alert(unpaid_id);

        $.each($("input[ id='paid_amount']"), function(){           
            paid_amount.push($(this).val());
        });
        //alert(paid_amount.join(","));
        var paid_amount = paid_amount.join(",");

       })
	});
      </script> 












<script type="text/javascript">
    $(document).ready(function () {
		
		
		
        $(document).on('click', '.print_billwise', function () {
            var billamount = $(this).data('billamount');
            var billdate = $(this).data('billdate');
			 var billno = $(this).data('billno');
            var studname = '<?php echo $student['firstname'] . " " . $student['lastname'] ?>';
			var type=$(this).data('type');
		    var mode=$(this).data('mode');
			
			console.log(type);
			
            $.ajax({
                url: '<?php echo site_url("studentfee/printBillwise") ?>',
                type: 'post',
                data: {'billamount':billamount,'billdate':billdate,'billno':billno,'studname':studname,'type':type,'mode':mode},
                success: function (response) {
                    Popup(response);
                }
            });
        });
		
		
		
		
		
		
		
        $(document).on('click', '.printDoc', function () {
            var main_invoice = $(this).data('main_invoice');
            var sub_invoice = $(this).data('sub_invoice');
            var student_session_id = '<?php echo $student['student_session_id'] ?>';
            $.ajax({
                url: '<?php echo site_url("studentfee/printFeesByName") ?>',
                type: 'post',
                data: {'student_session_id': student_session_id, 'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function (response) {
                    Popup(response);
                }
            });
        });
		
		
		
		
		
		
        $(document).on('click', '.printInv', function () {
            var fee_master_id = $(this).data('fee_master_id');
            var fee_session_group_id = $(this).data('fee_session_group_id');
            var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
            $.ajax({
                url: '<?php echo site_url("studentfee/printFeesByGroup") ?>',
                type: 'post',
                data: {'fee_groups_feetype_id': fee_groups_feetype_id, 'fee_master_id': fee_master_id, 'fee_session_group_id': fee_session_group_id},
                success: function (response) {
					console.log(response);
					
                    Popup(response);
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.save_button', function (e) {
		alert(1);
        var $this = $(this);
        $this.button('loading');
        var form = $(this).attr('frm');
        var feetype = $('#feetype_').val();
        var date = $('#date').val();
        var amount = $('#amount').val();
		var ad_invo=$('#ad_invo').val();
         
        var amount_discount = $('#amount_discount').val();
        var amount_fine = $('#amount_fine').val();
        var description = $('#description').val();
        var guardian_phone = $('#guardian_phone').val();
        var guardian_email = $('#guardian_email').val();
        var student_fees_master_id = $('#student_fees_master_id').val();
        var fee_groups_feetype_id = $('#fee_groups_feetype_id').val();
        var payment_mode = $('input[name="payment_mode_fee"]:checked').val();
        var student_fees_discount_id = $('#discount_group').val();
		var type =$('#type').val();
		var stud_name=$('#stud_name').val();
		var group= $('#group').val();
		console.log(amount);
		
        $.ajax({
            url: '<?php echo site_url("studentfee/addstudentfee") ?>',
            type: 'post',
            data: {date: date,group:group,feename:type, type: feetype, amount: amount, amount_discount: amount_discount, amount_fine: amount_fine, description: description, student_fees_master_id: student_fees_master_id, fee_groups_feetype_id: fee_groups_feetype_id, payment_mode: payment_mode,stud_name:stud_name, guardian_phone: guardian_phone, guardian_email: guardian_email, student_fees_discount_id: student_fees_discount_id,ad_invo:ad_invo},
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                $this.button('reset');
                if (response.status == "success") {
                    location.reload(true);
                } else if (response.status == "fail") {
                    $.each(response.error, function (index, value) {
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
            }
        });
    });
</script>


<script type="text/javascript">

    $(document).on('click', '.save_button2', function (e) {
		
        var $this = $(this);
        $this.button('loading');
        var form = $(this).attr('frm');
        var feetype = $('#feetype_').val();
        var date = $('#t_date').val();
        var amount = $('#amount2').val();
        var amount_discount = $('#amount_discount2').val();
        var fixed_fine = $('#fixed_fine').val();
        var description = $('#description').val();
        var guardian_phone = $('#guardian_phone').val();
        var guardian_email = $('#guardian_email').val();
	  	var dis_fee_type_id =$('#dis_fee_type_id').val();
	    var cal_amount=$('#cal_amount').val();
	 
        var student_fees_master = $('#student_fees_master_id1').val();
        var fee_groups_feetype_id = $('#fee_groups_feetype_id1').val();
		var stud_name=$('#stud_name').val();
		
		if(fee_groups_feetype_id.length >1)
		{
		 var  feegroupnew = fee_groups_feetype_id.split(','); 	
			
		}
		
		else
		{
			feegroupnew = fee_groups_feetype_id;
			
		}
		
		if(student_fees_master.length > 1)
		{
			 var student_fees_master_id = student_fees_master.split(',');
			
		}
		
		else
		{
			student_fees_master_id = student_fees_master;
		}
        
		
		
		
		 var balance = $('#totalbalance_amount').val();
		 
		 if(balance.length >1)
		 {
		 
		 var  balancenew = balance.split(',');
		 }
		 else
		 {
			balancenew = balance;
		 }
		 
		if(fixed_fine.length >1)
		{
			var amount_fine=fixed_fine.split(',');
		}
		else
		{
			amount_fine=fixed_fine;
		}
		
		 
		

        var payment_mode = $('input[name="payment_mode_fee"]:checked').val();
        var student_fees_discount_id = $('#discount_group').val();
		var invo=$('#invo').val();
		
		
        $.ajax({
            url: '<?php echo site_url("studentfee/addstudentfee2") ?>',
            type: 'post',
            data: {date: date,cal_amount:cal_amount, type: feetype, amount:amount,  amount_discount: amount_discount, amount_fine: amount_fine,dis_fee_type_id:dis_fee_type_id, description: description, student_fees_master_id: student_fees_master_id, fee_groups_feetype_id: feegroupnew, payment_mode: payment_mode, guardian_phone: guardian_phone, guardian_email: guardian_email, student_fees_discount_id: student_fees_discount_id,balance:balancenew,stud_name:stud_name,invo:invo },
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                $this.button('reset');
                if (response.status == "success") {
                    location.reload(true);
                } else if (response.status == "fail") {
                    $.each(response.error, function (index, value) {
						console.log(index);
						
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
            }
        });
    });
	
	
	
	
	<?php /*?>function feegrouptype()
	{
		
		$(".checkbox").each(function(){
   var checkid = $(this).attr('data-fee_groups_feetype_id');

});
return checkid;
	}
	
	function feemasterid()
	{
	
	$(".checkbox").each(function(){
  
 var data-fee_master_id =$(this).attr('data-fee_master_id');
});
 return data-fee_master_id ;	
	}
	
	function balancegroup()
	{

	$(".hidbalance").each(function(){
   var balance = $(this).val();
  
}); return balance ; }	<?php */?>
	
	
	
	
	
</script>




<script>


   



    var base_url = '<?php echo base_url() ?>';
    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        //frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
    $(document).ready(function () {
        $('.delmodal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $('.invoice_no', this).text("");
            $('#main_invoice', this).val("");
            $('#sub_invoice', this).val("");

            $('.invoice_no', this).text($(e.relatedTarget).data('invoiceno'));
            $('#main_invoice', this).val($(e.relatedTarget).data('main_invoice'));
            $('#sub_invoice', this).val($(e.relatedTarget).data('sub_invoice'));


        });
		
		
		
		$('#confirm-refund').on('show.bs.modal', function (e) {
           
            $('#student_fees_master_id', this).val("");
            $('#refund_amount', this).val("");
			$('#fee_groups_feetype_id', this).val("");
		
			

           
            $('#re_student_fees_master_id', this).val($(e.relatedTarget).data('fee_master_id'));
			
            $('#refund_amount', this).val($(e.relatedTarget).data('total_refund_amount'));
			
			$('#re_fee_groups_feetype_id', this).val($(e.relatedTarget).data('fee_groups_feetype_id'));
			


        });
		
		
		 $('#confirm-refund').on('click', '.btn-refund', function (e) {
            
			var $this = $(this);
			
			 $this.button('loading');
            var refund_amount = $('#refund_amount').val();
			var student_fees_master_id = $('#re_student_fees_master_id').val();
			var fee_groups_feetype_id = $('#re_fee_groups_feetype_id').val();
			var date = $('#date').val();
            var payment_mode = $('input[name="payment_mode_fee"]:checked').val();
          
			
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/refund_fee") ?>',
                dataType: 'JSON',
                data: {'refund_amount': refund_amount, 'student_fees_master_id': student_fees_master_id,'fee_groups_feetype_id':fee_groups_feetype_id,'date':date,'payment_mode':payment_mode},
                
				success: function (data) {
					
					console.log(data);
					 $this.button('reset');
					
                    //$modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });

		

        $('#confirm-discountdelete').on('show.bs.modal', function (e) {
            $('.discount_title', this).text("");
            $('#discount_id', this).val("");
            $('.discount_title', this).text($(e.relatedTarget).data('discounttitle'));
            $('#discount_id', this).val($(e.relatedTarget).data('discountid'));
        });

        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var main_invoice = $('#main_invoice').val();
            var sub_invoice = $('#sub_invoice').val();

            $modalDiv.addClass('modalloading');
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteFee") ?>',
                dataType: 'JSON',
                data: {'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });

        $('#confirm-discountdelete').on('click', '.btn-discountdel', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var discount_id = $('#discount_id').val();


            $modalDiv.addClass('modalloading');
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteStudentDiscount") ?>',
                dataType: 'JSON',
                data: {'discount_id': discount_id},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });


        $(document).on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var main_invoice = $('#main_invoice').val();
            var sub_invoice = $('#sub_invoice').val();

            
            $modalDiv.addClass('modalloading');
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteFee") ?>',
                dataType: 'JSON',
                data: {'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    //location.reload(true);
                }
            });


        });


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
    });



</script>


<script type="text/javascript">
    var fee_amount = 0;
   
	var total_feeamount=0;
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';



    $(document).ready(function () {
        $(".date").datepicker({
            format: date_format,
            autoclose: true,
            endDate: '+0d',
            todayHighlight: true
        });
    });
</script>
<script type="text/javascript">


    $("#myFeesModal").on('shown.bs.modal', function (e) {
        console.log("sdrere");
        e.stopPropagation();
        var discount_group_dropdown = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        var data = $(e.relatedTarget).data();
        $('#discount_group').html("");
        $("span[id$='_error']").html("");
        $('.fees_title').html("");
        $('#amount').val("");
        $('#amount_discount').val("0");
        $('#amount_fine').val("0");
        var type = data.type;
        var amount = data.amount;
        var group = data.group;
		var fine=data.fine;
        var fee_groups_feetype_id = data.fee_groups_feetype_id;
        var student_fees_master_id = data.student_fees_master_id;
        var student_session_id = data.student_session_id;

        $('.fees_title').html("<b>" + group + ":</b> " + type);
        $('#fee_groups_feetype_id').val(fee_groups_feetype_id);
        $('#student_fees_master_id').val(student_fees_master_id);
		$('#type').val(type);
		$('#group').val(group);
		
		
          
            

        $.ajax({
            type: "post",
            url: '<?php echo site_url("studentfee/geBalanceFee") ?>',
            dataType: 'JSON',
            data: {'fee_groups_feetype_id': fee_groups_feetype_id,
                'student_fees_master_id': student_fees_master_id,
                'student_session_id': student_session_id,
				'fine':fine
            },
            success: function (data) {
                 
				 //console.log(data);
				 
				 
                if (data.status == "success") {
                    fee_amount = data.balance;
                     
                    $('#amount').val(data.balance);
					$('#amount_fine').val(data.fine);
                    console.log(data.discount_not_applied);

                    $.each(data.discount_not_applied, function (i, obj)
                    {
                        discount_group_dropdown += "<option value=" + obj.student_fees_discount_id + " data-disamount=" + obj.amount + ">" + obj.code + "</option>";
                    });
                    $('#discount_group').append(discount_group_dropdown);




                }
            }
        });


    });

</script>




<script type="text/javascript">

$(".t_fee_type").select2({
  tags: true,
  
	placeholder: "Select Fee Head"  
});
  
    $("#myFeesModal2").on('shown.bs.modal', function (e) {
	
         e.stopPropagation();
		 
		 $('#show_feetype').hide();
        var discount_group_dropdown = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
		
		
		var t_feetype='<option value=""><?php echo $this->lang->line('select'); ?></option>';
		
        var data = $(e.relatedTarget).data();
        $('#discount_group2').html("");
		
		$('#t_fee_type').html("");
        $("span[id$='_error']").html("");
        $('.fees_title').html("");
        $('#amount2').val("");
		$('#cal_amount').val("");
       
        $('#amount_fine').val("0");
        var type = data.type;
        var amount = data.amount;
        var group = data.group;
		var tdiscount=data.tdiscount;
		var grand_amount =data.total_balance_amount;
		var student_id=data.student_id;
		var fee_groups_feetype_id = data.fee_groups_feetype_id;
		
		if(fee_groups_feetype_id.length >1)
		{
		var fee_groups_feetype_idnew = fee_groups_feetype_id.split(',');	
		}
		else
		{
			var array_id=[];
			array_id.push(fee_groups_feetype_id);
			fee_groups_feetype_idnew = array_id;
			
			
			}
 		
		
		if(data.student_fees_master_id.length >1)
		{
		var student_fees_master_id = data.student_fees_master_id.split(',');	
		}
		else
		{
			var stud_array=[];
			stud_array.push(data.student_fees_master_id);
			student_fees_master_id = stud_array ;
			
		}
		
		
        
        var student_session_id = data.student_session_id;
         var balance = data.balance_amount;
		 	 
        $('.fees_title').html("<b>" + group + "</b> ");
        /*$('#fee_groups_feetype_id1').val(fee_groups_feetype_id);*/
        $('#student_fees_master_id1').val(student_fees_master_id);
	/*	$('#totalbalance_amount').val(balance);*/
          if(tdiscount !=null)
		  {  	
				
		$('#amount_discount2').val(tdiscount); 	
		  }
		  else
		  {
			 $('#amount_discount2').val("0");  
			  
		  }
		
		    
			
        $.ajax({
            type: "post",
            url: '<?php echo site_url("studentfee/geBalanceFee2") ?>',
           
            data: {
			'fee_groups_feetype_id': fee_groups_feetype_idnew,
                'student_fees_master_id': student_fees_master_id,
                'student_session_id': student_session_id,
				'student_id':student_id
				
            },
			 dataType: 'json',
            success: function (data) {
                
                 total_feeamount=0;
				 
                if (data.status == "success") {
					$.each(data.balance, function(i,obj)
					{
						 
						total_feeamount = Number(total_feeamount) + Number(obj);
						
						});
					
                    $('#amount2').val(total_feeamount);
					$('#cal_amount').val(total_feeamount);
                     

                    $.each(data.discount_not_applied, function (i, obj)
                    {
                        discount_group_dropdown += "<option value=" + obj.student_fees_discount_id + " data-disamount2=" + obj.amount + ">" + obj.code + "</option>";
                    });
					
                    $('#discount_group2').append(discount_group_dropdown);
					
				      $.each(data.t_fee_type, function (i, obj)
					
					{
				var fixed_fine=0;		
				var d=new Date();
				var current_date=d.getFullYear()+'-'+(d.getMonth() + 1)+'-'+d.getDate() ;
			    var due_date=obj.due_date;
				
			    var difference = Date.parse(current_date) - Date.parse(due_date);	
				
				var days = Math.floor(difference / (1000 * 60 * 60 * 24));
				var months =Math.round(days/30); 		
				var weeks=Math.round(days/7);		
					
					
					
					if(obj.finetype=='Monthly')
						{	
						var i=0;
						
						while(i< months)
						{    
						if(obj.amounttype=='Fixed Amount')
						{
							fixed_fine=Number(fixed_fine)+Number(obj.fixedamount);
							}
							
							else if(obj.amounttype=='Percentage')
							{
								var per= (Number(obj.percentage)/100)*Number(obj.amount);                        fixed_fine= Number(fixed_fine)+Number(per);  
								
								}	
							i++;
							}
							
							
						}
						
						else if(obj.finetype=='Weekly')
						
						{
						i=0;
						
						while(i<weeks)
						{
						if(obj.amounttype=='Fixed Amount')
						{
						 fixed_fine=Number(fixed_fine)+Number(obj.fixedamount); 	
							
						}
						
					else if(obj.amounttype=='Percentage')
							{
								var per= (Number(obj.percentage)/100)*Number(obj.amount);                        fixed_fine= Number(fixed_fine)+Number(per);  
								
								}
								
								i++;	
							}
							
							
							}
							
							else if(obj.finetype=='Daily')
							{
								i=0;
							while(i<days)
						{
						if(obj.amounttype=='Fixed Amount')
						{
						 fixed_fine=Number(fixed_fine)+Number(obj.fixedamount); 	
							
						}
						
					else if(obj.amounttype=='Percentage')
							{
								var per= (Number(obj.percentage)/100)*Number(obj.amount);                        fixed_fine= Number(fixed_fine)+Number(per);  
								
								}
								
								i++;	
							}	
								
								
							}
							
							else
							{
							}
								
					
					
						if(obj.amount_detail== 0)
						{
							
					 t_feetype +="<option data-fine="+fixed_fine+" data-amount="+obj.amount+" value="+obj.fee_groups_feetype_id+ "> "+obj.type+" ["+obj.amount+"]</option>";	
					}
					else 
					{
					var amt=JSON.parse(obj.amount_detail);
			
				    var datafine=0;
					  var fee_paid=0;
					  var discount=0;
					$.each(amt,function(i,t)
					{
						
						
						if(fixed_fine==0)
						{
							
							 datafine=fixed_fine;
							
							}
							else if(fixed_fine !==0 && t.amount_fine==0)
							{
								
								
								 datafine=fixed_fine;
								 console.log(datafine);
								}
						
						
					fee_paid = Number(fee_paid) + Number(t.amount);
					discount=Number(discount)+Number(t.amount_discount); 
					 
					  });
					 	
						
					 var balance_amount=Number(obj.amount)- (Number(fee_paid) +Number(discount));
					 
					
					 if(balance_amount!==0)
					 {
						
						t_feetype +="<option data-fine="+datafine+" data-amount="+balance_amount+" value="+obj.fee_groups_feetype_id+ " > "+obj.type+ " ["+ balance_amount +" ]</option>";	
						}
						
						
						else{}
						
					}
					
					
					});
				
					
					$('#t_fee_type').append(t_feetype);
				
					
                }
            }
        });


    });
	
	
	$("select#t_fee_type").change(function () {
		
    var samplesSelected = $(this).val();
  
	var amt=[];
	var fine=[]
        $("select#t_fee_type option:selected").each(function () {
            //amount += $(this).data("amount") + " ";
			amt.push($(this).data("amount") + " ");
			fine.push($(this).data("fine") + " ");
        });
		

    $('#fee_groups_feetype_id1').val(samplesSelected);
    $('#totalbalance_amount').val(amt);
	$('#fixed_fine').val(fine);
 });
	
	
	
	
	
	
	
	
	/*$('#myFeesModal2').on('click','#closemodal' function(e) {
		alert();
  $(this).find('#myFeesModal2')[0].reset();
});
	*/
	

</script>






<script type="text/javascript">
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    })
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


    $(".applydiscount").click(function () {
        $("span[id$='_error']").html("");
        $('.discount_title').html("");
        $('#student_fees_discount_id').val("");
        var student_fees_discount_id = $(this).data("student_fees_discount_id");
        var modal_title = $(this).data("modal_title");
        student_fees_discount_id

        $('.discount_title').html("<b>" + modal_title + "</b>");

        $('#student_fees_discount_id').val(student_fees_discount_id);
        $('#myDisApplyModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });



    });




   /* $(document).on('click', '.dis_apply_button', function (e) {
        var $this = $(this);
        $this.button('loading');

        var discount_payment_id = $('#discount_payment_id').val();
        var student_fees_discount_id = $('#student_fees_discount_id').val();
        var dis_description = $('#dis_description').val();

        $.ajax({
            url: '<?php //echo site_url("admin/feediscount/applydiscount") ?>',
            type: 'post',
            data: {
                discount_payment_id: discount_payment_id,
                student_fees_discount_id: student_fees_discount_id,
                dis_description: dis_description
            },
            dataType: 'json',
            success: function (response) {
                $this.button('reset');
                if (response.status == "success") {
                    location.reload(true);
                } else if (response.status == "fail") {
                    $.each(response.error, function (index, value) {
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
            }
        });
    });
*/
</script>

<script type="text/javascript">
 $("#select_all").change(function () {  //"select all" change 
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });

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

    $(document).ready(function () {
        $(document).on('click', '.printSelected', function () {
            var array_to_print = [];
            $.each($("input[name='fee_checkbox']:checked"), function () {
                var fee_session_group_id = $(this).data('fee_session_group_id');
                var fee_master_id = $(this).data('fee_master_id');
                var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
                item = {}
                item ["fee_session_group_id"] = fee_session_group_id;
                item ["fee_master_id"] = fee_master_id;
                item ["fee_groups_feetype_id"] = fee_groups_feetype_id;

                array_to_print.push(item);
            });
            if (array_to_print.length == 0) {
                alert("no record selected");
            } else {
                $.ajax({
                    url: '<?php echo site_url("studentfee/printFeesByGroupArray") ?>',
                    type: 'post',
                    data: {'data': JSON.stringify(array_to_print)},
                    success: function (response) {
                        Popup(response);
                    }
                });
            }
        });
    });


    $(function () {
        $(document).on('change', "#discount_group", function () {
            var amount = $('option:selected', this).data('disamount');

            var balance_amount = (parseFloat(fee_amount) - parseFloat(amount)).toFixed(2);
			console.log(fee_amount);
            if (typeof amount !== typeof undefined && amount !== false) {
                $('div#myFeesModal').find('input#amount_discount').prop('readonly', true).val(amount);
                $('div#myFeesModal').find('input#amount').val(balance_amount);
                
				    } else {
                $('div#myFeesModal').find('input#amount').val(fee_amount);
                $('div#myFeesModal').find('input#amount_discount').prop('readonly', false).val(0);
            }

        });
    });
	
	
	
	$(function () {
        $(document).on('change', "#discount_group2", function () {
            var amount = $('option:selected', this).data('disamount2');
            console.log(amount);
	        
            var balance_amount = (parseFloat(total_feeamount) - parseFloat(amount)).toFixed(2);
            if (typeof amount !== typeof undefined && amount !== false) {
                $('div#myFeesModal2').find('input#amount_discount2').prop('readonly', true).val(amount);
                $('div#myFeesModal2').find('input#amount2').val(balance_amount);
                 $('#show_feetype').show();
               

            } else {
                $('div#myFeesModal2').find('input#amount2').val(total_feeamount);
                $('div#myFeesModal2').find('input#amount_discount2').prop('readonly', false).val(0);
            }

        });
    });
	
	
	
	
	
	
</script>
<!--///////////////////fees recived advance and excess////////////////////////-->

<script type="text/javascript">


	 $(document).on('click', '.btn_feeadvance', function (e) {
           
		   
		    var $this = $(this);
            $this.button('loading');
            var form = $(this).attr('frm');
            var ad_amount = $('#ad_amount').val();
            var ad_date = $('#ad_date').val();
			var ad_note = $('#ad_note').val();
            var payment_mode = $('input[name="payment_mode_fee"]:checked').val();
           var ad_invo = $('#ad_invoice').val();
		  var student_id=$('#student_id').val();
		  var stud_name=$('#stud_name').val();
			
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/fee_advance") ?>',
                dataType: 'JSON',
                data: {'ad_amount': ad_amount, 'ad_date': ad_date,'ad_note':ad_note,'payment_mode_fee':payment_mode,'student_id':student_id,'stud_name':stud_name,ad_invo:ad_invo},
                success: function (data) {
					
                  $this.button('reset');
                if (data.status == "success") {
                    location.reload(true);
                } else if (data.status == "fail") {
                    $.each(data.error, function (index, value) {
						console.log(index);
						
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
                }
            });


        });
	
	
	$(document).on('click', '.btn_feeexcess', function (e) {
           
		   
		    var $this = $(this);
            $this.button('loading');
            var form = $(this).attr('frm');
            var ex_amount = $('#ex_amount').val();
            var ex_date = $('#ex_date').val();
			var ex_note = $('#ex_note').val();
            var payment_mode = $('input[name="payment_mode_fee"]:checked').val();
            var ex_invo = $('#ex_invo').val();
			var student_id=$('#student_id').val();
			var stud_name=$('#stud_name').val();
			 
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/fee_excess") ?>',
                dataType: 'JSON',
                data: {'ex_amount': ex_amount, 'ex_date': ex_date,'ex_note':ex_note,'payment_mode_fee':payment_mode,'student_id':student_id,'stud_name':stud_name,ex_invo:ex_invo},
				
                success: function (data) {
					
                  $this.button('reset');
                if (data.status == "success") {
                    location.reload(true);
                } else if (data.status == "fail") {
                    $.each(data.error, function (index, value) {
						console.log(index);
						
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
                }
            });


        });
	
	
	
	
	
        $('#fee_ad_delete').on('show.bs.modal', function (e) {
           $('#fee_ad_id', this).val("");
		   
            $('#fee_ad_id', this).val($(e.relatedTarget).data('id'));


        });
		
		
		
		
		$(document).on('click', '.btn_fee_ad', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var fee_ad_id = $('#fee_ad_id').val();
           
             $modalDiv.addClass('modalloading');
            
          
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteFee_ad") ?>',
                dataType: 'JSON',
                data: {'id': fee_ad_id},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });

		
		 $('#fee_ex_delete').on('show.bs.modal', function (e) {
           $('#fee_ex_id', this).val("");
		   
            $('#fee_ex_id', this).val($(e.relatedTarget).data('id'));


        });
		
        
		
		 $(document).on('click', '.btn_fee_ex', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var fee_ex_id = $('#fee_ex_id').val();
           
             $modalDiv.addClass('modalloading');
            
          
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteFee_ex") ?>',
                dataType: 'JSON',
                data: {'id': fee_ex_id},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });
	
	
	
	

</script>

