<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
    @media print {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
        table.hidden-xs {
            display: table;
        }
        tr.hidden-xs {
            display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }
        .hidden-xs.hidden-print {
            display: none !important;
        }
        .hidden-sm {
            display: none !important;
        }
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
		
		
	/*	@page {
    size: 350mm 250mm; 
    
		}*/
		
   <!--.container { page-break-after: always; }-->

		
    }
</style>

<html lang="en">
    <head>
      <!--  <title><?php //echo $this->lang->line('fees_receipt'); ?></title>-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>       
        <div class="container">
            <div class="row">
          
                <div id="content" class="col-lg-12 col-sm-12 ">
                    <div class="invoice">
                        <div class="row header" style="margin-top:30px;">
                            <div class="col-sm-2">
                                <?php
                                if ($settinglist[0]['image'] != "") {
                                    ?>

                                    <img style="height:70px; " src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>">
                                    <?php
                                }
                                ?>
                           </div>
                            <div class="col-sm-8">
                                <center>
                                <strong style="font-size: 18px;"><?php echo strtoupper ($settinglist[0]['name']); ?><br>
                          <?php echo strtoupper ($settinglist[0]['address']); ?><br>
   Phone:- <?php echo $settinglist[0]['phone']; ?> <br> </strong></center>
                                

                            </div>
                        </div>
                        <div class="row">                           
                            <div class="col-xs-5">
                                <br/>
                               <label style="font-size:14px">No:<?php echo $billno ?></label>
                            </div>
                            
                             <div class="col-xs-4">
                                <br/>
                              <label style="font-size:17px">RECEIPT</label>
                            </div>
                            
                             <div class="col-xs-3">
                                <br/>
                             <label style="font-size:14px">DATE: <?php echo  $billdate ?></label>
                            </div>
                            
                          
                        </div>
                       
                        <div class="row" >
                           
                                 <div class="col-xs-12" style="margin-top:25px;">
                                 
                          
                                 <p style="font-size:14px;line-height:45px;"> Received with thanks from &nbsp <strong><?php echo strtoupper($studname); ?> </strong> &nbsp&nbsp  sum of rupees  <strong><?php echo  $currency_symbol.$billamount ?> </strong>&nbsp being payment of &nbsp&nbsp <strong><?php echo $type  ?> </strong>. &nbsp&nbsp <?php echo $mode ?> <br/>
  </p>                    </div>  
          <div class="col-xs-6" >
           <br/>                      
         <strong style="font-size:14px;">  Ref.no: <?php echo $admin_no ?></strong>  
         </div>
                                 
                                 
   <div class="col-xs-6 text-right" >
   <br/>
 <!-- <strong style="font-size:14px;"> Dated: <?php //echo $billdate ?> </strong>-->
  </div>
 </div>
  <br/>                               
<div class="row">
  <div class="col-xs-8" text-left>                              
<strong style="font-size:14px;">Received by:<?php $admin=$this->session->userdata('admin'); echo $admin['username']; ?> </strong></div>

<div class="col-xs-4 text-left">

<strong style="font-size:14px;margin-right:25px;">for </strong><br>

<strong><?php echo $settinglist[0]['name']; ?> </strong> </div>

</div>

</div>



                        </div>
                    </div>
                </div> 
                
                
                
                
                
                
                
                <div class="container" style="margin-top:98px;">
            <div class="row">
          
                <div id="content" class="col-lg-12 col-sm-12 ">
                    <div class="invoice">
                        <div class="row header" style="margin-top:30px;">
                            <div class="col-sm-2">
                                <?php
                                if ($settinglist[0]['image'] != "") {
                                    ?>

                                    <img style="height:70px; " src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php echo $settinglist[0]['image']; ?>">
                                    <?php
                                }
                                ?>
                           </div>
                            <div class="col-sm-8">
                                <center>
                                <strong style="font-size: 18px;"><?php echo strtoupper ($settinglist[0]['name']); ?><br>
                          <?php echo strtoupper ($settinglist[0]['address']); ?><br>
   Phone:- <?php echo $settinglist[0]['phone']; ?> <br> </strong></center>
                                

                            </div>
                        </div>
                        <div class="row">                           
                            <div class="col-xs-5">
                                <br/>
                               <label style="font-size:14px">No:<?php echo $billno ?></label>
                            </div>
                            
                             <div class="col-xs-4">
                                <br/>
                              <label style="font-size:17px">RECEIPT</label>
                            </div>
                            
                             <div class="col-xs-3">
                                <br/>
                             <label style="font-size:14px">DATE: <?php echo  $billdate ?></label>
                            </div>
                            
                          
                        </div>
                       
                        <div class="row" >
                           
                                 <div class="col-xs-12" style="margin-top:25px;">
                                 
                          
                                 <p style="font-size:14px;line-height:45px;"> Received with thanks from &nbsp <strong><?php echo strtoupper($studname); ?> </strong> &nbsp&nbsp  sum of rupees  <strong><?php echo  $currency_symbol.$billamount ?> </strong>&nbsp being payment of &nbsp&nbsp <strong><?php echo $type  ?> </strong>. &nbsp&nbsp <?php echo $mode ?> <br/>
  </p>                    </div>  
          <div class="col-xs-6" >
           <br/>                      
         <strong style="font-size:14px;">  Ref.no: <?php echo $admin_no ?></strong>  
         </div>
                                 
                                 
   <div class="col-xs-6 text-right" >
   <br/>
  <!--<strong style="font-size:14px;"> Dated: <?php //echo $billdate ?> </strong>-->
  </div>
 </div>
  <br/>                               
<div class="row">
  <div class="col-xs-8" text-left>                              
<strong style="font-size:14px;">Received by:<?php $admin=$this->session->userdata('admin'); echo $admin['username']; ?> </strong></div>

<div class="col-xs-4 text-left">

<strong style="font-size:14px;margin-right:25px;">for </strong><br>

<strong><?php echo $settinglist[0]['name']; ?> </strong> </div>

</div>

</div>



                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                
                
                
              <!--<div class="container">
            <div class="row">
             
   <div class="card" style="height:581.4px;width:532px; float:left;">
  <div class="card-body" >
    <h4 class="card-title" style="height:50.48;"> </h4>
    <p class="card-text"> </p>
    <div class="row" style="height:94.49px; width:532px;">
    <div class="col-sm-1"></div>
    <div class="col-sm-5" style="font-family: Verdana,Tahoma !important; font-size: 14px;">
      <?php echo $billno ?> </td><br>
      <?php echo strtoupper($studname); ?><br>
      <?php echo $admin_no ?><br>
        <?php echo $course ?>
    
    </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-3" style="font-family: Verdana, Tahoma !important; font-size: 14px;" >
     <?php $date= date('d-m-Y');  echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date)); ?>
    
    
    </div>
    
    
    </div>
    
     <div class="row" style="height:55px;">
     
      <div class="col-sm-8" >
     
       </div>
       
        <div class="col-sm-4" style="text-align:center;" >
      
       </div>
     </div>
    
     <div class="row" style=" height:453.54px; font-family: Verdana,Tahoma !important;">
        <?php if(!empty($type)) foreach($type as $t) {
			
			
			$part=explode(',',$t);
			?>
             <div class="row" >
             <div class="col-sm-12">
             <div class="col-sm-8"  >
             <span style="font-size:16px;"><?php echo $part[0]; ?></span>
            </div>
          <div class="col-sm-4" style="text-align:center;" >
        <span style="font-size:14px;"><?php echo $part[1]; ?></span>
         </div></div></div>
       
  
    <?php } ?>
    </div>
    
    
     <div class="row" style=" height:37.795px;">
      <div class="col-sm-8" ></div>
       <div class="col-sm-4" style="text-align:center;font-size:14px; font-family: Verdana,Tahoma !important;" >
       <?php echo $currency_symbol.$billamount?>
       </div>
   
   
    </div>
    
    
  </div>
</div>
          
  
  
  
  
  
   
          
  
  
  
  
             
            
              <!--<div class=" col-sm-6 ">
              
            <table style="border-top:solid; width:100%; border-left:solid;border-right:solid; border-bottom:solid; margin-top:50px;" >
            <tr style="border-bottom:solid;">
              <td>
                        <?php
                                //if ($settinglist[0]['image'] != "") {
                                    ?>

                                    <img style="height:60px; margin-left:10px; " src="<?php echo base_url(); ?>/uploads/school_content/logo/<?php// echo $settinglist[0]['image']; ?>">
                                    <?php
                                //}
                                ?></td>
              
            <td>
              
               <strong style="font-size: 18px;"><?php //echo strtoupper ($settinglist[0]['name']); ?><br>
                          <?php //echo strtoupper ($settinglist[0]['address']); ?><br>
   Phone:- <?php //echo $settinglist[0]['phone']; ?> <br> </strong> </td>
   <td>  RECEIPT  </td> </tr>
     </table>
     
     <table style="width:100%; height:25px;margin-top:100px;" >
     <tr > 
     <th ></th>  
     <td > <?php //echo $billno ?> </td>
      <th > </th> 
      
      <td > <?php //$date= date('d-m-Y');  echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date)); ?></td>
      
      </tr>
     
     
      <tr> 
      <th > </th> 
      <td ><?php //echo strtoupper($studname); ?>  </td> 
      <td> </td> 
      <td> </td>
      </tr>
      
    <tr > 
    <th > </th> 
    <td ><?php //echo $admin_no ?> </td>
      <th>  </th> 
      <td> </td>
     
      </tr>
      
      
       <tr > 
       <th > </th> 
       <td ><?php //echo $course ?> </td>
      <th>  </th> 
      <td> </td>
     
      </tr>
     
     </table>
     
     
      <table style="width:100%;height:100px;margin-top:100px; " >
       <tr >
       <th style="text-align:center;"></th>
        <th style="text-align:center;"> </th>
       
       </tr>
        <?php //foreach($type as $t) {
			
			//$part=explode(',',$t);
			?>
         <tr style="height:50px;margin-top:100px;">
       
       <td > <?php //echo $part[0]; ?></td>
        <td ><?php //echo $part[1]; ?></td>
       
       </tr><?php //} ?>
       
       <tr style="height:100px;">
       <td style="text-align:center;"></td>
       
       <td ><?php //echo $currency_symbol.$billamount?></td>
       
       
       </tr>
       
        <tr style="height:50px;">
       <td ></td>
       
       <td ></td>
       
       
       </tr>
       
       
         
          </table>    
         
            
            </div>-->  
              
              
           
            </div> </div>     
                
                
                 
            </div>
        </div>
        <div class="clearfix"></div>
        <footer>           
        </footer>
    </body>
</html>
