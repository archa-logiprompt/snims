<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
    @media print {
        /* your existing print styles here */
    }
</style>

<html lang="en">
    <head>
        <title>Fees Receipt</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>      
        <?php for($i=0;$i<=1;$i++){?>
        <div class="container">
            <div class="row">
                <div id="content" class="col-lg-12 col-sm-12 ">
                    <!-- Invoice Header -->
                    <div class="invoice">
                        <div class="row header" style="margin-top:30px;">
                            <div class="col-xs-2">
                                <?php if ($settinglist[0]['image'] != ""): ?>
                                    <img style="height:70px; " src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-8">
                                <center>
                                    <strong style="font-size: 18px;"><?php echo strtoupper($settinglist[0]['name']); ?><br>
                                    <?php echo strtoupper($settinglist[0]['address']); ?><br>
                                    Phone:- <?php echo $settinglist[0]['phone']; ?> <br> </strong>
                                </center>
                            </div>
                        </div>

                        <!-- Invoice Details -->
                        <div class="row">                           
                            <div class="col-xs-5">
                                <br/>
                                <?php if($rectype=='Refund'){?>
                                <label style="font-size:14px">No:RF<?php echo $billno ?></label>
                                <?php }else if($rectype=='Revert'){?>
                                    <label style="font-size:14px">No:RV<?php echo $billno ?></label>
                                    <?php }else{?>
                                        <label style="font-size:14px">No:<?php echo $billno ?></label>
                                        <?php }?>

                            </div>

                            <div class="col-xs-3">
                                <br/>
                                <label style="font-size:17px">RECEIPT</label>
                            </div>

                            <div class="col-xs-4">
                                <br/>
                                <label style="font-size:14px">DATE: <?php echo date('Y-m-d h:i A') ?></label>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="row">
                            <div class="col-xs-12" style="margin-top:25px;">
                        <table style="width:100%; border-collapse: collapse; border: 1px solid #000;">
                      
                        <tr>
                            <td colspan="7" style="text-align:center; font-size:16px; border: 1px solid #000;"><strong>Bill Details</strong></td>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:center; font-size:14px; border: 1px solid #000;"><strong>Name:</strong></th>
                            <th colspan="2" style="text-align:center; font-size:14px; border: 1px solid #000;"><strong>Admission No:</strong></th>

                            <th style="width:16.66%; padding: 10px; border: 1px solid #000;"><strong>Amount:</strong></th>
                            <?php if($rectype=='Collection'){ ?>
                            <th style="width:16.66%; padding: 10px; border: 1px solid #000;"><strong>Mode of Payment:</strong></th>
                            <th colspan="2" style="padding: 10px; border: 1px solid #000;"><strong>Payment Type:</strong></th>
                            <?php } ?>
                            <?php if($rectype=='Refund'){ ?>
                            <th style="width:16.66%; padding: 10px; border: 1px solid #000;"><strong>Refunded From</strong></th>
                            <th colspan="2" style="padding: 10px; border: 1px solid #000;"><strong>Refunded By</strong></th>
                            <?php } ?>
                            <?php if($rectype=='Revert'){ ?>
                            <th style="width:16.66%; padding: 10px; border: 1px solid #000;"><strong>Reverted From</strong></th>
                            <th colspan="2" style="padding: 10px; border: 1px solid #000;"><strong>Reverted By</strong></th>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid #000;"><?php echo strtoupper($studname); ?></td>
                            <td colspan="2" style="border: 1px solid #000;"><?php echo strtoupper($admin_no); ?></td>

                            <td style="border: 1px solid #000;"><?php echo $currency_symbol . $billamount; ?></td>
                            <?php if($rectype=='Collection'){ ?> 
                                <td style="border: 1px solid #000;"><?php echo $mode; ?></td>
                                <td style="border: 1px solid #000;"><?php echo $type?></td>
                                <?php }?> 
                            <?php if($rectype=='Refund' ||$rectype=='Revert'){ ?> 
                                <td style="border: 1px solid #000;"> <?php echo $refundtype == 0 ? 'Fees' : ($refundtype == 1 ? 'Advance' : ($refundtype == 2 ? 'Excess' : '')); ?></td>
                                <td style="border: 1px solid #000;"><?php echo $reverted_by?></td>
                                <?php }?> 
                                

                        </tr>
    
</table>





                            </div>

                            <div class="col-xs-6">
                                <br/>
                                <strong style="font-size:14px;">  Ref.no: <?php echo $admin_no ?></strong>  
                            </div>

                            <div class="col-xs-6 text-right">
                                <br/>
                                <!--<strong style="font-size:14px;"> Dated: <?php //echo $billdate ?> </strong>-->
                            </div>
                        </div>

                        <!-- Received by and School Details -->
                        <div class="row">
                            <div class="col-xs-8">
                                <strong style="font-size:14px;">Received by:<?php $admin = $this->session->userdata('admin'); echo $admin['username']; ?> </strong>
                            </div>

                            <div class="col-xs-4">
                                <strong style="font-size:14px;margin-right:25px;">for </strong><br>
                                <strong><?php echo $settinglist[0]['name']; ?> </strong>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <?php }?>

        <div class="clearfix"></div>
        <footer>           
        </footer>
    </body>
</html>
