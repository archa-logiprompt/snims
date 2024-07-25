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
    }
</style>

<html lang="en">
    <head>
        
       <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> -->
        <!--<link rel="stylesheet" href="<?php //echo base_url(); ?>backend/dist/css/AdminLTE.min.css">-->
    </head>
    <body >       
       <!-- <div class="container">-->
       <?php //print_r($appearence); ?>
       
     <!-- <style>

@page :left {
  margin-left: 3cm;
}

@page :right {
  margin-left: 4cm;
}

</style>-->
           <div class="row pull-left" style="width:100% !important;"> 

           <img  style="float:left;    border-radius: 50%;    margin: 0 auto;
    width: 100px; padding: 3px; border: 3px solid #d2d6de;" class="profile-user-img img-responsive img-circle" src="<?php if(!empty($student['image'])){ echo base_url() .$student['image']; }else { echo base_url()."uploads/student_images/no_image.png"; } ?>" alt="User profile picture">
           
            </div>
            <div style="clear:both !important;"></div>  
            <div class="row" style="margin-top: 30px;width:100% !important;">
           
             <div class="col-md-6" style="width: 50% !important;float: left;">
             
            <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Name in full</label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div> 
           <div class="col-md-5" style="width: 50.66666667% !important;float: left;"><?php echo $student['firstname'].' '.$student['lastname'] ?>  </div> 
          </div>
           <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Date of Birth</label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div>
           
           <div class="col-md-5" style="width: 50.66666667% !important;float: left;"> <?php echo $student['dob']; ?></div> 
           
          </div>
           <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Sex</label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div>
           
           <div class="col-md-5" style="width: 50.66666667% !important;float: left;"><?php echo $student['gender']; ?></div>
           
           
          </div>
          
          
           <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Name of Guardian(with relationship)</label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"> <?php echo $student['guardian_name'] .'('. $student['guardian_is'].')'; ?></div>
           </div>
          
          <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Permanent Address </label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"> <?php echo $student['permanent_address'] ?> </div>
           </div>
          
          
           <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Religion / Caste </label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"><?php echo $student['religion'].'/'.$student['cast'] ?></div>
           </div>
          
           <div class="row"> 
            <div class=" col-md-4" style="width: 40.33333333% !important;float: left;">    
           <label> Kuhs Reg No.	 </label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"><?php echo $student['kuhs_reg_no'] ?></div>
           </div>
          
          
          
          
          
           
           </div>
           
            <div class="col-md-6" style="width: 50% !important;float: left;">
           
           <!-- <div class="row"> -->
           <!-- <div class=" col-md-5" style="width: 40.66666667% !important;float: left;">    -->
           <!--<label> Batch No.	 </label>-->
           <!--</div>-->
           <!--<div class="col-md-1" style="width: 8.33333333% !important;"> : </div>-->
           <!--<div class="col-md-5" style="width: 50.66666667% !important;"></div>-->
           <!--</div>-->
           
            <div class="row"> 
            <div class=" col-md-5" style="width: 40.66666667% !important;float: left;">    
           <label> Year of Admission </label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;float: left;"> <?php  $year=strtotime($student['admission_date']); 
		  $y=date('Y',$year);
		   echo $y;
		   
		   ?> </div>
           </div>
           
            <div class="row"> 
            <div class=" col-md-5" style="width: 40.66666667% !important;float: left;">    
           <label> Admission No. </label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;float: left;"> <?php echo $student['admission_no']; ?> </div>
           </div>
           
           
           <div class="row"> 
            <div class=" col-md-5" style="width: 40.66666667% !important;float: left;">    
           <label> Date of Admission </label>
           </div>
           <div class="col-md-1" style="width: 8.33333333% !important;float: left;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;float: left;"> <?php echo $student['admission_date']; ?></div>
           </div>
           
           
           <div class="row"> 
            <div class=" col-md-5" style="width: 50.66666667% !important;float: left;">    
           <label> Date of completion </label>
           </div>
           <div class="col-md-1" style="width: 50.66666667% !important;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"> <?php echo $student['date_completion']; ?>  </div>
           </div>
           
           <!--<div class="row"> -->
           <!-- <div class=" col-md-5" style="width: 50.66666667% !important;float: left;">    -->
           <!--<label> Date of commencement	   </label>-->
           <!--</div>-->
           <!--<div class="col-md-1" style="width: 50.66666667% !important;"> : </div>-->
           <!--<div class="col-md-5" style="width: 50.66666667% !important;"><?   echo $student['date_of_completion']?></div>-->
           <!--</div>-->
           <div class="row"> 
            <div class=" col-md-5" style="width: 50.66666667% !important;float: left;">    
           <label> Previous School Attended :  </label>
           </div>
           <div class="col-md-1" style="width: 50.66666667% !important;"><?   echo $student['previous_school']?>  </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"></div>
           </div>
           
           <!-- <div class="row"> 
            <div class=" col-md-5" style="width: 50.66666667% !important;float: left;">    
           <label> Month & Year of Final year Exam
        </label>
           </div> -->
           <!-- <div class="col-md-1" style="width: 50.66666667% !important;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"></div>
           </div> -->
           
           
           
           <!-- <div class="row"> 
            <div class=" col-md-5" style="width: 50.66666667% !important;float: left;">    
           <label> 	KNMC Reg. No.	
</label>
           </div>
           <div class="col-md-1" style="width: 50.66666667% !important;"> : </div>
           <div class="col-md-5" style="width: 50.66666667% !important;"></div>
           </div> -->
           
           
            </div>
            </div>  
            <div style="clear:both !important;"></div>  
           <div class="row" style="margin-top: 20px;width:100% !important; ">
            <!-- <table style="width: 100%;" border="1">    
           <thead>
      <tr>
        <th>COURSE</th>
        <th>INSTITUTION</th>
        <th>PERIOD OF ATTENDANCE</th>
        <th>PERCENTAGE OF MARKS</th>
       
      </tr>
    </thead>
           
         <tbody>
         <tr>
         <td>S.S.L.C</td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         <tr>
         <td>PRE-DREGREE / +2</td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         
          <tr>
         <td>DEGREE</td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         </tr> 
         
         
         
         
         </tbody>  
           
           
           
           
           
                
            </table>  -->
            </div> 
             
             
    
             
               
               
          
          <div class="row" style="margin-top: 28px;">
           <center><label> <b> LEAVE PARTICULARS </b> </label></center>
            <table style="width: 100%;" border="1">    
           <thead>
      <tr>
        <th style="text-align:center;">YEAR</th>
        <th style="text-align:center;">NO. OF WORKING DAYS</th>
        <th style="text-align:center;">ANNUAL LEAVE </th>
        <th style="text-align:center;">SICK LEAVE </th>
         <th style="text-align:center;">ANY OTHER </th>
        
       
      </tr>
    </thead>
           
         <tbody>
         <?php if(isset($working_days)) 
		 
		 foreach($working_days as $key=>$work)
		 {
		 ?>
         <tr>
         <td style="text-align:center;"> <?php if(!empty($work['section'])) echo $work['section'] ?></td>
         <td style="text-align:center;"><?php if(!empty($work['working_day'])) echo $work['working_day'] ?> </td>
         <td style="text-align:center;"> <?php if(!empty($work['annual_leave'])) echo $work['annual_leave'] ?></td>
         <td style="text-align:center;"><?php if(!empty($work['sick_leave']))  echo $work['sick_leave'] ?></td>
         <td style="text-align:center;"><?php  if(!empty($work['anyother_leave'])) echo $work['anyother_leave'] ?></td>
         </tr>
         <?php  }?>
         
         </tbody>  
           
           
           
           
           
                
            </table> 
            </div>     
            <table style="width: 100%;margin-top: 21px;" border="1" class="tg" >
            
            <tr>
          <th  rowspan="3" style="text-align:center;font-weight: 100 !important;">Subjects</th>
           <th  colspan="3" style="font-weight: 100 !important;">Theory(in hours)</th>
          <th  colspan="3" style="font-weight: 100 !important;">Clinical Practice(in hours)</th>
          
          
      <th style="font-weight: 100 !important;"  colspan="3">Total Marks</th></tr>
      <tr >
   <th style="font-weight: 100 !important;" rowspan="2">In syllabus</th>          
  <th style="font-weight: 100 !important;" rowspan="2">Conducted</th>
  <th rowspan="2" style="font-weight: 100 !important;">Attended</th>
  <th rowspan="2" style="font-weight: 100 !important;">In syllabus</th>
  <th style="font-weight: 100 !important;" rowspan="2">Conducted</th>
  <th style="font-weight: 100 !important;" rowspan="2">Attended</th>
  <th style="font-weight: 100 !important;">Max.marks</th>
   <th style="font-weight: 100 !important;">Marks secured</th>
   
  
  </tr>';
       
      <tbody>
     
      <?php if(!empty($markdetails))
	  
	  foreach($markdetails as $key=>$marks)
	  {
		 
		 
		  
	   $total_mark=0;
	  ?> 
      <tr>
      
     
      <th style="font-size: 13px;font-weight: bold;text-align: left; padding-left: 11px;" colspan="10"> <?php echo $marks->section;  ?>  </th>
  
     <?php  $t=0;foreach($marks->subject as $s_key=>$sub) { 
	 
	 
	 
	$total_mark=$total_mark+$sub->marks_secured->marks;

	 $t=$t+$sub->marks_secured->full_marks;
	 ?> 
      <tr > 
      <td style="text-align: left; padding-left: 11px;"> <?php echo $sub->name ?> </td>
      <td style="text-align:center;"> - </td>
      <td style="text-align:center;"> <?php if(!empty($sub->conducted)) echo $sub->conducted.'hr';?></td>
      <td style="text-align:center;"> <?php if(!empty($sub->total_hour))echo $sub->total_hour.'hr'; ?> </td>
      <td style="text-align:center;"></td>
      <td style="text-align:center;"><?php if(!empty($sub->clinical_conducted)) echo $sub->clinical_conducted .' hr'; ?></td>
      <td style="text-align:center;"><?php if(!empty($sub->clinical_totalhr)) echo $sub->clinical_totalhr.' hr'; ?></td>
      <td style="text-align:center;"><?php echo  $sub->marks_secured->full_marks ?></td>
      <td style="text-align:center;"><?php if(!empty($sub->marks_secured)) echo $sub->marks_secured->marks ?></td>
      </tr>
      
      <?php } ?>
      
      <tr>
      
      <tr> <td style="text-align:center;font-size: 15px; font-weight: bold"> Total</td>   
      <td style="text-align:center;"></td> 
      <td style="text-align:center;"></td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"><?php echo  $t  ?></td> 
      <td style="text-align:center;font-size: 15px; font-weight: bold"><?php if(!empty($total_mark )) echo $total_mark ?> </td> 
     
      
      
      </tr>
      
      <?php  }?>
      
      
      </tbody> 
       
       
       
       
       
       
       
            
            
        </table>  
             
             
             <!-- <div class="row" style="margin-top: 28px;">
           <center><label> <b> CHARACTER & CONDUCT </b> </label></center>
            <table style="width: 100%;" border="1">     -->
           
           
      
         <!-- <?php if(isset($character)) 
		//  VAR_DUMP($markdetails);exit;
		 foreach($markdetails as $key=>$marks)
		 {
		 
		 ?>
         <tr>
         <td style="text-align:center; width: 170px; font-weight: bold;"><?php echo $char['section'] ?></td>
         <td style="text-align:center;"><?php echo $char['remarks'] ?> </td>
         
         </tr>
         <?php } ?> -->
        
         
        
         <table style="width: 100%;" border="1"> 
<tr style="text-align:center;font-weight: bold;">
  <td style="text-align:center;font-weight: bold;">OVERALL GRADE</td>
  <td>
    <?php  
    $per = $total_mark / $t * 100;
    if ($per >= 90) {
        echo "<strong>A+</strong>";
    } elseif ($per >= 80) {
        echo "<strong>B+</strong>";
    } elseif($per>=70) {
        echo "<strong>B</strong>";
    }
    elseif($per>=60) {
        echo "<strong>C+</strong>";
    }
       elseif($per>=50) {
        echo "<strong>C</strong>";
    }
    else
    {
        echo " ";
    }
    ?>
  </td>
</tr>

</TABLE>  
         
         
         
         
         
           
           
           
           
           
                
            </table> 
            </div>
            
            
            <div class="row" style="margin-top: 28px;">
            <!-- <table style="width: 100%;margin-top: 21px;" border="1" class="tg" >
            
            <tr>
          <th  rowspan="3" style="text-align:center;font-weight: 100 !important;">Subjects</th>
           <th  colspan="3" style="font-weight: 100 !important;">Theory(in hours)</th>
          <th  colspan="3" style="font-weight: 100 !important;">Clinical Practice(in hours)</th>
          
          
      <th style="font-weight: 100 !important;"  colspan="3">Total Marks</th></tr>
      <tr >
   <th style="font-weight: 100 !important;" rowspan="2">In syllabus</th>          
  <th style="font-weight: 100 !important;" rowspan="2">Conducted</th>
  <th rowspan="2" style="font-weight: 100 !important;">Attended</th>
  <th rowspan="2" style="font-weight: 100 !important;">In syllabus</th>
  <th style="font-weight: 100 !important;" rowspan="2">Conducted</th>
  <th style="font-weight: 100 !important;" rowspan="2">Attended</th>
  <th style="font-weight: 100 !important;">Max.marks</th>
   <th style="font-weight: 100 !important;">Marks secured</th>
  
  </tr>';
       
      <tbody>
     
      <?php if(!empty($markdetails))
	  
	  foreach($markdetails as $key=>$marks)
	  {
		 
		 
		  
	   $total_mark=0;
	  ?> 
      <tr>
      
     
      <th style="font-size: 13px;font-weight: bold;text-align: left; padding-left: 11px;" colspan="10"> <?php echo $marks->section;  ?>  </th>
     
     <?php foreach($marks->subject as $s_key=>$sub) { 
	 
	 
	 
	$total_mark=$total_mark+$sub->marks_secured->marks;
	 
	 ?> 
      <tr > 
      <td style="text-align: left; padding-left: 11px;"> <?php echo $sub->name ?> </td>
      <td style="text-align:center;"> - </td>
      <td style="text-align:center;"> <?php if(!empty($sub->conducted)) echo $sub->conducted.'hr';?></td>
      <td style="text-align:center;"> <?php if(!empty($sub->total_hour))echo $sub->total_hour.'hr'; ?> </td>
      <td style="text-align:center;"></td>
      <td style="text-align:center;"><?php if(!empty($sub->clinical_conducted)) echo $sub->clinical_conducted .' hr'; ?></td>
      <td style="text-align:center;"><?php if(!empty($sub->clinical_totalhr)) echo $sub->clinical_totalhr.' hr'; ?></td>
      <td style="text-align:center;"><?php echo  $sub->marks_secured->full_marks ?></td>
      <td style="text-align:center;"><?php if(!empty($sub->marks_secured)) echo $sub->marks_secured->marks ?></td>
      </tr>
      
      <?php } ?>
      
      <tr>
      
      <tr> <td style="text-align:center;font-size: 15px; font-weight: bold"> Total</td>   
      <td style="text-align:center;"></td> 
      <td style="text-align:center;"></td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;"> </td> 
      <td style="text-align:center;font-size: 15px; font-weight: bold"><?php if(!empty($total_mark )) echo $total_mark ?> </td> 
     
      
      
      </tr>
      
      <?php  }?>
      
      
      </tbody> 
       
       
       
       
       
       
       
            
            
        </table>     -->
            
            
            
            
            </div>
                
                
                
                
                
                
                  
          <!--  </div>
        </div>-->
        <div class="clearfix"></div>
        <footer>           
        </footer>
    </body>
</html>




