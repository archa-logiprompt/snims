

<!--<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/bootstrap-select.min.css"/>

 <script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/bootstrap-select.min.js"> </script>
 -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

<style type="text/css">
    .nav-tabs-custom>.nav-tabs>li.active {
        border-top-color: #faa21c;
    }
	
	.dash
	{
	   border-bottom:1px dashed;	
		
	}
	
	
	
	/*.tg  {border-collapse:collapse;border-spacing:0; border:1px;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 10px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 10px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:black;}
.tg .tg-0lax{text-align:left;vertical-align:top}
.tg .tg-pcvp{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-ihkz{border-color:inherit;text-align:center;vertical-align:top}*/

.table-bordered {
    border: 1px solid #121213 !important;
}

.table>tbody>tr>td{
    border-top: unset !important;
}
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-line-chart"></i><?php echo $this->lang->line('mess'); ?> <?php echo $this->lang->line('reports'); ?> <small> </small>   </h1>
    </section>
    <!-- Main content -->
    <section class="content">
     <form  action="<?php echo site_url('admin/fees_report') ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                               
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                    
                                    <div class="col-sm-12">
                                            <label><?php echo $this->lang->line('fee_category'); ?></label>
                                            <!--<select multiple="multiple" id="fee_category" name="fee_category[]" class="form-control" >
                                            <option class="select_all" id="select_all" value="all"><?php echo $this->lang->line('all'); ?></option>
                                            <?php
                                            //foreach ($category_list as $category) {
												
												
                                                ?>
                                                <option <?php if($feetype==$category['id']) echo 'selected="selected"'; ?> class="category" value="<?php echo $category['id'] ?>"><?php echo $category['type'] ?></option>
                                                <?php
                                                $count++;
                                            //}
                                            ?>
                                        </select>-->
                                         <div class="row">
                                      <div class="col-md-5">
                                        <input <?php if($feetype=='all') { echo 'checked=checked';} ?> type="checkbox" name="fee_category" value="all" id="select_all"/> <?php echo $this->lang->line('all'); ?></div></div>
                                      <span class="text-danger"><?php echo form_error('fee_category'); ?></span>  
                                        <?php
                                       //if(isset($category_list)) foreach ($category_list as $category) {
										   //if(is_array($feetype) && in_array($category['id'],$feetype) )
										   //{
											  //$check='checked'; 
											   //}
										   
										   
										   
												
                                                ?>
                                      <!--<div class="row">
                                      <div class="col-md-1">
                                        <input  <?php  //echo  $check  ?> class="checkbox" type="checkbox" name="fee_category[]"  value="<?php  //echo $category['id']; ?>" /></div>
                                         <div class="col-md-11">
                                         <?php //echo $category['type']; ?></div></div>-->
                                          <?php
                                                
                                            //}
                                            ?>
                                        
                                        
                                           
                                           
                                            
                                        </div>
                                    
                                    
                                        
                                    </div>
                                   
                             
                            </div>
                        </div>
                          <div class="around10">  
                         <div class="row">
                           <div class="col-sm-12">
                         <label > Detailed Report</label>
                                              <div>
                                  <input <?php if($billno_feeheadwise=='billno_feeheadwise') { echo 'checked=checked';} ?> type="radio"  name="billno_feeheadwise"    value="billno_feeheadwise"> Billno and feehead wise details 
                                           </div>
                                           
                                           
                                            <span class="text-danger"><?php echo form_error('billno_feeheadwise'); ?></span>  
                                           
                                           <!--<div>
                                           
           <input type="radio"  name="guardian_is" value="mother"> <?php echo $this->lang->line('mother'); ?>
                                            </div>
                                            <div>
                                                <input type="radio"  name="guardian_is" <?php
                                                //echo set_value('guardian_is') == "other" ? "checked" : "";
                                                ?>   value="other"> <?php //echo $this->lang->line('other'); ?>
                                          </div>-->
                        
                        
                       
                        </div></div> </div>
                        
                        
                        
                        
                    </div>
                </div>
                </div>
                
                
                <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                       
                    </div>
                    <div class="box-body">
                  
                        <div class="row">
                            <div class="col-md-12">
                                <!--<form role="form" action="<?php //echo site_url('admin/fee_transaction/fees_category_report') ?>" method="post" class="form-horizontal">-->
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                    
                                    
                                        <div class="col-sm-4">
                                            <label><?php echo $this->lang->line('date_from'); ?></label>
                                            <input autofocus="" id="datefrom" name="date_from" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                            <span class="text-danger"><?php echo form_error('date_from'); ?></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <label><?php echo $this->lang->line('date_to'); ?></label>
                                            <input id="dateto" name="date_to" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                        </div>
                                        
                                     
                                       <div class="col-sm-4">
                                            <label><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                                               
                                            <select  id="payment_mode" name="payment_mode" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <option <?php if($payment_mode=='Cash'){ echo 'selected=selected';} ?> value="Cash"><?php echo $this->lang->line('cash'); ?></option>
                                       <option <?php if($payment_mode=='Cheque'){ echo 'selected=selected';} ?> value="Cheque"><?php echo $this->lang->line('cheque'); ?></option>
                                      <option <?php if($payment_mode=='DD'){ echo 'selected=selected';} ?> value="DD"><?php echo $this->lang->line('dd'); ?></option>
                                      <option <?php if($payment_mode=='Bank'){ echo 'selected=selected';} ?> value="Bank"><?php echo $this->lang->line('bank'); ?></option>
                                 
                                          
                                        </select>
                                           
                                          <span class="text-danger"><?php echo form_error('payment_mode'); ?></span>   
                                            
                                        </div>
                                       
                                       
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                    
                            </div>
                        </div>
                        
                        
                         <div class="around10">  
                        <div class="row">
                            <div class="col-md-12">
                               
                                    <?php echo $this->customlib->getCSRF(); ?>
                                 
                                    
                                    
                                        <!--<div class="col-sm-4">
                                            
                                            <div class="form-group">
                                            <label><?php //echo $this->lang->line('class'); ?></label> 
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php //echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    //foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php //echo $class['id'] ?>" <?php //if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php //echo $class['class'] ?></option>
                                                        <?php
                                                        //$count++;
                                                    //}
                                                    ?>
                                                </select>
                                        </div>
                                       </div>-->
                                     
                                        
                                   
                                    
                            </div>
                        </div>
                        </div>
                        
                         <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                        
                    
                    </div>
                </div>
                </div>
                
                </div>
                </form>
                
                
                <?php  if(isset($feeList)) {
					 ?>
                    
                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary" >
                        <h3 class="titless pull-left"><i class="fa fa-money"></i> <?php echo $exp_title; ?>
                    
                        </h3>
                       
                        <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search" id="collection_print" value="" class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right"> <?php echo $this->lang->line('print'); ?></button>     
                        
                       <!-- <div class="nav-tabs-custom">    -->
                            <!--<ul class="nav nav-tabs pull-right">
                                <?php
                               
                                ?>
                                <?php
                                ?>   
                                <?php
                                //if ($this->module_lib->hasActive('fees_collection')) {
                                    ?>                     
                                    <li class="active"><a href="#tab_students" data-toggle="tab"><?php// echo $this->lang->line('fees_collection_details'); ?></a></li>
                                <?php //} ?>                  
                            </ul>-->
                            <div class="box-body" id="collection_report"> 
                             <div class="row">
                             
                              <div class="col-md-12 ">    
                              <!--  <div class="tab-content">-->
                                   <!-- <div class="tab-pane active table-responsive" 
                                   id="tab_students">-->
                                   
                                    <div class="box-header with-border">
                                   <div class="row">
                                   <div class="col-sm-2" style="width:20%;"> 
         <img class="profile-user-img img-responsive img-circle" style="float:left;margin-right:5px;" src=" <?php echo base_url()?>uploads/school_content/logo/<?php echo $this->setting_model->getcollegelogo(); ?>" alt=""  height="236">
         </div>
         <div class="col-sm-8">
                         <h3><?php echo strtoupper($this->setting_model->getCurrentSchoolName()); ?></h3>
                            <h3> Collection Report-BillNumber and FeeHeadwise Details   </h3>
                            
                            
                            </div>
                                    </div>
                                    
                                    </div>
                                   
                                        <div class="download_label"> <?php //echo $exp_title; ?> </div>
                                        
                                        <table  style="width: 100%;">   
                                        
                                        <thead>
                                        <tr>
                                        <th style="width: 10px;" >FromDate</th><th>: <?php echo $from ?></th>
                                        <th ></th>
                                        <th style="width: 10px;">ToDate</th><th>: <?php echo $to; ?></th>
                                        <th ></th>
                                        <th style="width:103px;">Academic Year</th><th>:</th>
                                        <th ></th>
                                        
                                        
                                        </tr>
                                        
                                        </thead>
                                       
                                        
                                        
                                        </table>
                                        
                                        <table style="width: 100%; ">
                                          <thead style="border-bottom: double; border-top: double;">
                                        
         <tr>
    <th style="padding:5px 10px" colspan="3"> User Name</th><th> :</th> <th style="width: 216px;" colspan="7"></th>
    <th style="padding:5px 10px" colspan="4"> Payment Mode</th><th> :  <?php echo $payment_mode ?></th><th style="width: 216px;" colspan="7"></th>
        </tr></thead>
        
     <tbody style="border-bottom: double; border-top: double;">   
  <tr>
    <td  style="padding:0px 6px;" colspan="3">Programme</td><td>:</td><td style="width: 216px;" colspan="3"></td>
    <td  style="padding:0px 6px;" colspan="2" >Course</td><td>:</td><td style="width: 216px;"  colspan="2"></td>
    <td  style="padding:0px 6px;" colspan="3" >Batch </td><td>:</td> <td style="width: 216px;" colspan="3"></td>
  </tr>
  <tr >
    <td style="padding:0px 6px;" colspan="3">Department</td><td>:</td><td style="width: 216px;" colspan="3"></td>
    <td style="padding:0px 6px;" colspan="2">Subject </td><td> :</td><td style="width: 216px;" colspan="2"></td>
    <td style="padding:0px 6px;" colspan="3">Sem/Year</td><td>:</td><td style="width: 216px;" colspan="3"></td>
  </tr></tbody>
  </table>
                                        
                                        
                                        
            <table  style="border-left: 1px solid;border-right: 1px solid;width: 100%;">
                                        
                                            <thead class="header">
                                                <tr style="border-top: 1px solid;">
                                                    <th style="padding: 5px;"><?php echo $this->lang->line('sl_no'); ?></th>
                                                    <th style="padding: 5px;"><?php echo $this->lang->line('admission_no'); ?></th>
                                                    <th style="padding: 5px;"><?php echo $this->lang->line('name'); ?></th>
                                                    <th style="padding: 5px;"><?php echo $this->lang->line('bill_no'); ?></th>  
                                                    <th style="padding: 5px;"><?php echo $this->lang->line('bill_date'); ?></th>
                                                    <th style="padding: 5px;">Fee head</th>
                                                  

                                                    <th style="padding: 5px;" class="text text-right"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th style="padding: 5px;"class="text text-right"><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th style="padding: 5px;" class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th style="padding: 5px;" class="text text-right"><?php echo $this->lang->line('total'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
												
												
                                                if (empty($feeList)) {
                                                    ?>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="9" class="text-danger text-center"><?php echo $this->lang->line('no_transaction_found'); ?></td>
                                                    </tr>
                                                </tfoot>
                                                <?php
                                            } else {
                                                $count = 1;
                                               $student_total=0;
                                                foreach ($feeList as $key => $value) {

                                              
                                                  
                                                    ?>
                                                    <tr style="border-bottom: 1px dashed;border-top: 1px solid;">
                                                        <td >
                                                            <?php echo $count;
															
															?>
                                                        </td>
                                                        <td >
                                                            <?php echo $value->admission_no ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                        </tr>
                                               
                                               <?php 
                                               $total_amount = 0;
                                                $discount = 0;
                                                $fine = 0;
                                                $total = 0;
                                                $grd_total = 0;?>
                                                        
                                         <?php  foreach($value->collection_record as $key => $record)
										 { 
										 
										
										
										$total_amount=$total_amount+$record['amount'];
										$discount = $discount + $record['amount_discount'];
										$fine=$fine+$record['amount_fine'];
										$total=($total_amount + $fine) - $discount;
										//$student_total=$student_total+$total;
										
										 ?>
                                          
                                         
                                                        
                                                        <tr>
                                                        
                                                      <td></td>
                                                      <td></td>  
                                                        
                                                        <td >
                                                            <?php echo $record['firstname'] . " " . $record['lastname']; ?>
                                                        </td >
                                                        <td>
                                                            <?php echo $record['inv_no']; ?>
                                                        </td>
                                                        <td >
                                                            <?php echo $record['date']; ?>
                                                        </td>
                                                        <td >
                                                            <?php echo $record['type']; ?>
                                                        </td>
                                                        
                                                  
                                                        <td class="text text-right">
                                         <?php echo number_format($record['amount'], 2, '.', ''); ?>
                                                        </td>
                                                       
                                                      
                                                        <td  class="text text-right">
                                    <?php echo number_format($record['amount_discount'], 2, '.', ''); ?>
                                                        </td>
                                                        
                                                        <td  class="text text-right">
                                       <?php echo (number_format($record['amount_fine'], 2, '.', '')); ?>
                                                        </td>
                                                          
                                                        <td  class="text text-right">
                                                            <?php
                                                            $t = ($record['amount'] + $record['amount_fine']) - $record['amount_discount'];
                                                            echo (number_format($t, 2, '.', ''))
                                                            ?>
                                                        </td>
                                                       
                                                    
                                                    </tr>
                                                    
                                                     <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <!--<td style="border-bottom: 1px dashed;
    border-top: 1px dashed;"></td>-->
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"> Bill Total:</td>
                                                    <td  style="border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right">  <?php echo number_format($record['amount'], 2, '.', ''); ?>  </td>
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right" ><?php echo number_format($record['fine'], 2, '.', ''); ?>    </td>
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"> <?php echo number_format($record['amount_discount'], 2, '.', ''); ?> </td>
                                                    <td style=" border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"><?php  $t = ($record['amount'] + $record['amount_fine']) - $record['amount_discount'];
                                                            echo (number_format($t, 2, '.', '')) ?></td>
                                                    
                                                    
                                                    </tr>
                                                    
                                                    
                                                    
                                                    
                                                    <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <!--<td style="border-bottom: 1px dashed;
    border-top: 1px dashed;"></td>-->
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"><?php echo $record['payment_mode'].' ' .$record['description'] ?></td>
                                                    <td  style="border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right">   </td>
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right" >  </td>
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right">  </td>
                                                    <td style=" border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right">
                                                            </td>
                                                    
                                                    
                                                    </tr>
                                                    
                                                    
                                                    
                                                     <?php  } ?>
                                                   
                                                    
                                                    
                                                    
                                                     <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <!--<td style="border-bottom: 1px dashed;
    border-top: 1px dashed;"></td>-->
                                                    <td style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"> Student Total:</td>
                                                    <td style="border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right">  <?php echo number_format($total_amount, 2, '.', ''); ?>  </td>
                                                    <td style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right" ><?php echo number_format($discount , 2, '.', ''); ?>    </td>
                                                    <td style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"> <?php echo number_format($fine , 2, '.', ''); ?> </td>
                                                    <td style="border-bottom: 1px dashed;border-top: 1px dashed;" class="text text-right"><?php  
                                                            echo (number_format($total, 2, '.', '')) ?></td>
                                                    
                                                    
                                                    </tr>
                                                    
                                                    
                                                    <?php
													
													$student_total=$student_total+$total_amount;
													
													  $count++;
                                                }
												
												
                                            }
                                            ?>
                                            
                                            
                                            
                                            <tr class="box box-solid total-bg" style="border-top: 1px solid;">
                                                <td class="text-right"> <?php echo $this->lang->line('total'); ?> (Fee collection) </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style=" border-bottom: 1px dashed;" class="text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"><?php echo ($currency_symbol . number_format($student_total, 2, '.', '')); ?></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"> 0.00</td></tr>
                                                
                                                
                                                   <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td  class="text-right"><?php echo $this->lang->line('collection');  ?> :</td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td class="text text-right"></td>
                                                <td  class="text text-right"> <?php echo ($currency_symbol . number_format($student_total, 2, '.', '')); ?></td>
                                                </tr>
                                                
                                                 <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td style=" border-bottom: 1px dashed;" style=" border-bottom: 1px dashed;" class="text-right"><?php echo $this->lang->line('deleted_amount');  ?> :</td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"><?php echo  ($currency_symbol . number_format($deleted_amount['deleted_amount'], 2, '.', '')); ?></td></tr>
                                                
                                             <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td   class="text-right"><?php echo $this->lang->line('total_collection');  ?> :</td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td class="text text-right"></td>
                                                <td class="text text-right"> 
												<?php 
												
												$total=$student_total+$deleted_amount['deleted_amount'];
												
												echo ($currency_symbol . number_format($total, 2, '.', '')); ?>  </td></tr>
                                                
                                            
                                            
                                            <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td style=" border-bottom: 1px dashed;" style=" border-bottom: 1px dashed;" class="text-right"><?php echo $this->lang->line('refund');  ?> :</td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"> </td></tr>
                                                
                                            
                                            
                                            
                                   
                                            <tr class="box box-solid total-bg" style="border-bottom: 1px solid;">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td   class="text-right"><?php echo $this->lang->line('cash_hand');  ?> :</td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"> <?php echo ($currency_symbol . number_format($student_total, 2, '.', '')); ?> </td></tr>
                                                
                                                           
                                                
                                                
                                                <tr class="box box-solid " >
                                                        
                                                      <td class="text-right" style="font-weight:bold;">Other Payments</td>
                                                      <td></td>  
                                                         <td > </td >
                                                       
                                                          <td></td>
                                                       
                                                          <td ></td>
                                                           
                                                          <td >  </td>
                                                        <td class="text text-right"></td>
                                                          <td  class="text text-right"></td>
                                      <td  class="text text-right">
                                      </td>
                                             <td  class="text text-right"> </td>     
                                                            
                                                  </tr>        
                                                                
                                                     
                                                <?php 
												
												$other_student_total=0;
												$other_cancelled=0;
												
												if(isset($otherpay)) foreach($otherpay as $pay) {                                       
												
												
												if($pay['is_cancelled']==1)
												{
													$other_cancelled=$other_cancelled+$pay['amount'];
													
													}
												
												?> 
                                               
                                                   
                                                         <tr>
                                                      <td></td>
                                                      <td></td>  
                                                        
                                                        <td >
                                                            <?php echo $pay['name']?>
                                                        </td >
                                                        <td>
                                                            <?php echo $pay['invo']; ?>
                                                        </td>
                                                        <td >
                                                            <?php echo $pay['date']; ?>
                                                        </td>
                                                        <td >
                                                            <?php echo $pay['income_category']; ?>
                                                        </td>
                                                        
                                                  
                                                        <td class="text text-right">
                                         <?php echo number_format($pay['amount'], 2, '.', ''); ?>
                                                        </td>
                                                       
                                                      
                                                        <td  class="text text-right">
                                    0.00
                                                        </td>
                                                        
                                                        <td  class="text text-right">
                                    0.00
                                                        </td>
                                                          
                                                        <td  class="text text-right">
                                                            <?php
                                                            $t = $pay['amount'] ;
                                                            echo (number_format($t, 2, '.', ''));
                                                            ?>
                                                        </td>
                                                       
                                                    
                                                    </tr>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"> Bill Total:</td>
                                                    <td  style="border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right">  <?php echo number_format($pay['amount'], 2, '.', ''); ?>  </td>
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right" > 0.00  </td>
                                                    <td  style="    border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"> 0.00 </td>
                                                    <td style=" border-bottom: 1px dashed;
    border-top: 1px dashed;" class="text text-right"><?php  $t = $pay['amount'];
                                                            echo (number_format($t, 2, '.', '')) ?></td>
                                                    
                                                    
                                                    </tr >
                                                    
                                                    
                                                    
                                                    
                                                <?php $other_student_total=$other_student_total+$t; } ?>
                                                
                                              
                                                
                                                <tr  style="border-bottom:1px solid;">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <!--<td style="border-bottom: 1px dashed;
    border-top: 1px dashed;"></td>-->
                                                    <td style="border-bottom: 1px dashed;border-top: 1px dashed; font-weight:bold;" class="text text-right"> Student Total:</td>
                                                    <td style="border-bottom: 1px dashed;
    border-top: 1px dashed;font-weight:bold;" class="text text-right">  <?php echo number_format($other_student_total, 2, '.', ''); ?>  </td>
                                                    <td style="    border-bottom: 1px dashed;
    border-top: 1px dashed;font-weight:bold;" class="text text-right" >0.00    </td>
                                                    <td style="    border-bottom: 1px dashed;
    border-top: 1px dashed;font-weight:bold;" class="text text-right"> 0.00 </td>
                                                    <td style="border-bottom: 1px dashed;border-top: 1px dashed;font-weight:bold;" class="text text-right"><?php  
                                                            echo (number_format($student_total, 2, '.', '')) ?></td>
                                                    
                                                    
                                                    </tr>
                                                
                                                
                                                
                                               <tr class="box box-solid total-bg" style="border-top: 1px solid;">
                                                <td class="text-right"> <?php echo $this->lang->line('total'); ?> (Other payments) </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style=" border-bottom: 1px dashed;" class="text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"><?php echo ($currency_symbol . number_format($other_student_total, 2, '.', '')); ?></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"> 0.00</td></tr>
                                                
                                                
                                                   <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td  class="text-right"><?php echo $this->lang->line('collection');  ?> :</td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td class="text text-right"></td>
                                                <td  class="text text-right"> <?php echo ($currency_symbol . number_format($other_student_total, 2, '.', '')); ?></td>
                                                </tr>
                                                
                                                 <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td style=" border-bottom: 1px dashed;" style=" border-bottom: 1px dashed;" class="text-right"><?php echo $this->lang->line('deleted_amount');  ?> :</td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"><?php echo  ($currency_symbol . number_format($other_cancelled, 2, '.', '')); ?></td></tr>
                                                
                                             <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td   class="text-right"><?php echo $this->lang->line('total_collection');  ?> :</td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td class="text text-right"></td>
                                                <td class="text text-right"> 
												<?php 
												
												$total=$other_student_total+$other_cancelled;
												
												echo ($currency_symbol . number_format($total, 2, '.', '')); ?>  </td></tr>
                                                
                                            
                                            
                                            <tr class="box box-solid total-bg">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td style=" border-bottom: 1px dashed;" style=" border-bottom: 1px dashed;" class="text-right"><?php echo $this->lang->line('refund');  ?> :</td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"> </td></tr>
                                                
                                            
                                            
                                            
                                   
                                            <tr class="box box-solid total-bg" style="border-bottom: 1px solid;">
                                                <td class="text-right"> </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td   class="text-right"><?php echo $this->lang->line('cash_hand');  ?> :</td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"> <?php echo ($currency_symbol . number_format($other_student_total, 2, '.', '')); ?> </td></tr>
                                                
                                               <tr  style="border-bottom: 1px solid;">
                                                <td class="text-right" style="color: #e80a0a;font-weight:bold;">Grand Total </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td   class="text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right" style="color: #e80a0a;font-weight:bold;"><?php 
												
												$grand_total=$other_student_total+$student_total;
												
												
												echo ($currency_symbol . number_format($grand_total, 2, '.', '')); ?>  </td></tr> 
                                                
                                                
                                            </tbody>
                                        </table>
                                        
                                     
                                        
                                                 
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                       
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>    
                                     
                                    

                                    
                                </div>

                            </div>
                            <div class="box-footer">
                                <div class="mailbox-controls"> 
                                    <div class="pull-right">
                                    </div>
                                </div>
                            </div>
                       <!-- </div>-->
                        
                        </div>
                    <?php
                }
                ?>
            </div>  
        </div>

    </section>
</div>

<script type="text/javascript">

 //$('.selectpicker').selectpicker({});

 /*$("#select_all").change(function () {  //"select all" change 
        $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });*/

//".checkbox" change 
    /*$('.checkbox').change(function () {
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if (false == $(this).prop("checked")) { //if this item is unchecked
            $("#select_all").prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $("#select_all").prop('checked', true);
        }
    });*/

  



    $(document).ready(function () {
		
		
		 $('#fee_category').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'320px'
 });
		
		
		
		
  var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(),['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
  
  //var date_format = '<?php //echo $result = strtr($this->customlib->getSchoolDateFormat(), array('d' => "dd", 'm' => "mm", 'Y' => "yyyy",)) ?>';
        $(".date").datepicker({
            format: date_format,
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
		
		
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    })
    $(document).ready(function () {
        $('.table-fixed-header').fixedHeader();
    });

    (function ($) {

        $.fn.fixedHeader = function (options) {
            var config = {
                topOffset: 50

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

</script>


<script type="text/javascript">
  
   $(document).on('click', '#collection_print', function () {
	
   
     var printContents = document.getElementById('collection_report').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

   
   });
   
   
   
   
   </script> 
