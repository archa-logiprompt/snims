<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('income'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/income/incomeSearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date_from'); ?></label>
                                                <input  id="datefrom" name="date_from" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date_to'); ?></label>
                                                <input  id="dateto" name="date_to" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                            </div> 
                                        </div>
                                        
                                        
                                         <div class="col-sm-4">
                                            <div class="form-group">
                                            
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('income_head'); ?><small class="req"> *</small></label>
                                               <select autofocus="" id="inc_head_id" name="inc_head_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($incheadlist as $inchead) {
                                            ?>
                                            <option value="<?php echo $inchead['id'] ?>"<?php
                                            if (set_value('inc_head_id') == $inchead['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $inchead['income_category'] ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                            </div> 
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                            
                            
                            <div class="col-md-4">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/income/incomeSearch') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search'); ?></label>
                                                <input autofocus="" type="text" value="<?php echo set_value('search_text', ""); ?>" name="search_text"  class="form-control" placeholder="Search by Income">
                                                <span class="text-danger"><?php echo form_error('search_text'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>

                        </div>

                    </div>

                </div>
                <?php if (isset($resultList)) {
                    ?><div class="box box-info" id="exp">
                    <form method="post" action="<?php echo base_url(); ?>admin/excel_export">
                    <input type="hidden" name="date_from" value="<?php echo $date_from ?>" />
                    <input type="hidden" name="date_to" value="<?php echo $date_to ?>" /> 
                    <input type="hidden" name="income_head" value="<?php echo $income_head ?>" />  
                    
                    
                      <button type="submit" style="margin-right: 10px;margin-top: 10px;" name="search"  value="" class="btn btn-sm btn-primary login-submit-cs fa fa-file-excel-o pull-right"> Excel Export</button>
                      </form>  



                        <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search" id="collection_print" value="" class="btn btn-sm btn-primary login-submit-cs fa fa-print pull-right"> <?php echo $this->lang->line('print'); ?></button>     
                        
                                <div class="box-body" >
                                 <?php if(!empty($resultList)) {
								
								
								 ?> 
                              <div class="row" id="collection_report">
                               <div class="col-md-12 ">  
                               
                               
                               
                               <div class="box-header with-border">
                                   <div class="row">
                                   <div class="col-sm-2" style="width:20%;"> 
         
                          </div>
                   <div class="col-sm-12">
                 <center>
                     <h3 style="font-family: initial !important;"><?php echo strtoupper($this->setting_model->getCurrentSchoolName()); ?></h3>
                      </center>
                            <h4 style="font-family: initial !important;"> <?php echo $inc_title ?>    </h4>
                            
                            </div>
                                    </div>
                                    
                                    </div>
                               
                               
                                 
                            <table style="width:100%;" border="1">
                                        
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center !important;"><?php echo $this->lang->line('sl_no'); ?></th>
                                                    
                                   <th style="text-align:center !important;"><?php echo $this->lang->line('bill_no'); ?></th>  
                                   <th style="text-align:center !important;"><?php echo $this->lang->line('bill_date'); ?></th>
                                   <th style="text-align:center !important;">Fee Head</th>
                                    <th style="text-align:center !important;">Description</th>
                  
                     <th style="text-align:center !important;"><?php echo $this->lang->line('name'); ?></th>
                                     <th style="text-align:center !important;" class="text"> <?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th style="text-align:center !important;" class="text"><?php echo $this->lang->line('cancelled'); ?> <?php echo $this->lang->line('bill_no'); ?> </th>
                                                    
                                                    <th class="text" style="text-align:center !important;"><?php echo $this->lang->line('cancelled'); ?> <?php echo $this->lang->line('bill_date'); ?>  </th>
                                                    
                                                   <th style="text-align:center !important;" class="text"><?php echo $this->lang->line('cancelled'); ?> <?php echo $this->lang->line('amount'); ?>  </th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                           	
                                            <?php  
											
											 $each_id=array();
											 $total=0;
											 $deleted_amount=0;
											if(isset($resultList)) $i=1; foreach($resultList as $income) {
											$total=$total+$income['amount'];
											
											
											?>
                                            
                                              <tr>
                                              
                                              <td style="text-align:center"> <?php echo $i; ?></td>
                                              <td style="text-align:center"><?php echo $income['invoice_no'] ?></td>
                                              <td style="text-align:center"> <?php  echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($income['date']));?></td>
                                                <td style="text-align:center"> <?php echo $income['name']; ?></td>
                                                <td style="text-align:center"> <?php echo $income['mode'].'/'. $income['description']; ?></td>
                                              
                                              <td style="text-align:center"> <?php echo $income['person_name'] ?></td>
                                              <td style="text-align:center"><?php echo $income['amount'] ?></td>
                                              
                                            <?php if($income['is_cancelled']==1) { $deleted_amount=$deleted_amount+$income['amount'];?>
                                            
                                   <td style="text-align:center"><?php echo $income['invoice_no'] ?></td>
                                       <td style="text-align:center"> <?php  echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($income['cancelled_date']));?></td>
                                       <td style="text-align:center"><?php echo $income['amount']  ?> </td>
                                               <?php } else {?>      
                                              
                                              
                                           <td style="text-align:center"> </td>
                                                <td style="text-align:center"> </td>
												 <td style="text-align:center"> </td>
												
												<?php } ?>
                                              
                                              
                                              </tr>
                                              <?php  $i= $i+1; } ?> 
                                              
                                              </tbody></table>
                                              <table style="width:100%;border-left: 1px solid;border-right: 1px solid;" border="0">
                                              
                                              <tr class="box box-solid total-bg">
                                                <td class="text-right"> <?php echo $this->lang->line('total'); ?>  </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style=" border-bottom: 1px dashed;" class="text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"></td>
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"> <?php echo ($currency_symbol . number_format($total, 2, '.', '')); ?></td></tr>
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
                                                <td  class="text text-right"> <?php echo ($currency_symbol . number_format($total, 2, '.', '')); ?></td>
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
                                                <td style=" border-bottom: 1px dashed;" class="text text-right"><?php echo  ($currency_symbol . number_format($deleted_amount, 2, '.', '')); ?></td></tr>
                                                
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
												
												$total_collection=$total-$deleted_amount;
												
												echo ($currency_symbol . number_format($total_collection, 2, '.', '')); ?>  </td></tr>
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
                                                <td  class="text text-right"> <?php echo ($currency_symbol . number_format($total, 2, '.', '')); ?> </td></tr>
                                              
                                              <tr  style="border-bottom: 1px solid;">
                                                <td class="text-right" style="color: #e80a0a;">Grand Total </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td ></td>
                                                <td   class="text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right"></td>
                                                <td  class="text text-right" style="color: #e80a0a;"><?php echo ($currency_symbol . number_format($total, 2, '.', '')); ?>  </td></tr>
                                              
                                              
                                              
                                                    
                                            </tbody>
                                            
                                        </table>
                       </div>
                       </div>
                       
                        <?php } else { ?>
                              
                              <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div><?php } ?>  

                    </div></div>
                    <?php
                }
                ?>

            </div>      

        </div>   <!-- /.row -->

    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $(".date").datepicker({
            // format: "dd-mm-yyyy",
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
    });

    // $(document).ready(function () {
    //     $('.example').dataTable({
    //         "bSort": false,
    //         "paging": false,

    //     });

    // })
</script>
<script type="text/javascript">

    var base_url = '<?php echo base_url() ?>';

    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

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
        frameDoc.document.write('<title></title>');
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



