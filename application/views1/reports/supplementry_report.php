<html lang="en">
    <head>
        
       <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> -->
        <!--<link rel="stylesheet" href="<?php //echo base_url(); ?>backend/dist/css/AdminLTE.min.css">-->
    </head>
    <body>       
       <!-- <div class="container">-->
       
       
      
           <!--<div class="row pull-left" > 
           
          
           <img class="profile-user-img img-responsive img-circle" src="<?php //if(!empty($student['image'])){ echo base_url() .$student['image']; }else { echo base_url() ."uploads/student_images/no_image.png"; } ?>" alt="User profile picture">
           
            </div>-->
           
            
            <?php if(!empty($exam)) { ?>    
           <div class="row" style="margin-top: 28px;">
            <table style="width:100%;" border="1"> 
            
            <?php if(isset($exam))
			foreach($exam as $key=>$ex)
			{
				
			
			
			?>   
           <thead>
           
           <tr style="height: 30px !important;"> <th colspan="3" style="padding-left:10px;"> <?php echo $ex->section  .' [ Appeared :'.$ex->appeared.' ] ' ; ?>     </th> </tr>
           
      <tr style="height: 30px !important;">
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Mark</th>
        <th style="text-align:center;">Passed/Failed</th>
       
      </tr>
        </thead>
         <tbody>
         <?php foreach($ex->exam_result as $result) { //var_dump($ex->max_appeared->maxappeared); ?>
         <tr style="height: 30px !important;">
         <td style="text-align:center;"> <?php echo $result->name ?> </td>
         <td style="text-align:center;"> <?php echo $result->get_marks ?> </td>
         <?php if($result->get_marks < $result->passing_marks) { ?>
         <td style="text-align:center;"><label class='label label-danger'> Failed  </label>
         <?php if($ex->appeared==$result->max_appeared->maxappeared) {?>
         <a class='btn btn-link hide_supple' style="text-decoration:none;" data-studid="<?php echo $ex->student_id;?>" data-classid="<?php echo $ex->class_id;?>" data-sectionid="<?php echo $ex->section_id;?>" data-appearedid="<?php echo $ex->appeared;?>" data-subjectid="<?php echo $result->subject_id;?>"> Click to add supplementry marks </a>
         <?php }?>
         </td>
         
         <?php } else { ?>
         
         <td style="text-align:center;"><label class='label label-success'> Passed </label> </td>
         
         <?php  } ?>
         
         </tr>
         
         
         <?php } ?>
         </tbody>  
           
           
           
          <?php  } ?> 
           
                
            </table> 
            </div> 
            
            <?php } else { ?>
               <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div> <?php }?> 
             
             
             <div class="row" style="margin-top: 28px;">
             
     <!-- <button type="button" class="btn btn-success hide_supple">Click to add supplementry marks</button>-->
              
             <div class="box box-info hide_supplementry" style="margin-top: 28px;">
            <button type="button" class="close div-close" style="color: #a80f1b; margin-right: 1%;">×</button>
             <form role="form" id=""  class="addmarks-form"  method="post" action="<?php echo site_url('admin/mark/appeared') ?>">
             <span class="tbody"></span>
             <?php //var_dump($exam);?> 
                 <?php /*?> <?php foreach($exam as $key=>$exam){?>  
                    <input type="hidden" name="student_id" value="<?php echo $exam->student_id; ?>">     
                    <input type="hidden" name="class_id" value="<?php echo $exam->class_id; ?>">     
                    <input type="hidden" name="section_id" value="<?php echo $exam->section_id; ?>">   
                        <div class="box-body">
                        <h4 class="box-title">
                <?php echo $exam->section;?></h4> 
                                   
<div class="table-responsive">

<div class="col-md-12" >
<div class="row">
<div class="col-md-2" style="font-weight:bold">Exam Month </div>
<div class="col-md-4"> <input class="modal_date" id="date" name="date"  type="text" value="<?php echo set_value('date'); ?>"  /> </div>
<div class="col-md-2" style="font-weight:bold"> No. of appearance </div>
 <div class="col-md-4"> 
 
 <select  id="appearence" name="appearence" class="form-control" >
 <option value="0">Select</option>
 
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
 <option value="5">5</option>
 <option value="6">6</option>
  </select> </div>

</div>
</div>

<table class="table table-striped table-bordered table-hover"> 
    <thead> 
        <tr>
            <th>
                Subject 
            </th>
           <th>
               Marks
            </th> 
        </tr>
    </thead>
    <tbody class="tbody"> 
	<?php /*?><?php foreach($exam->exam_result as $ex){ 
			if($ex['get_marks'] < $ex['passing_marks']){?>
			<input type="hidden" name="exam_schedule[]" value="<?php echo $ex['exam_schedule_id'] ?>">
        <tr>
            <td>
             <?php echo $ex['name']; ?>  
            </td>
            
            <td>
               <input type="text" name="mark_<?php echo $ex['exam_schedule_id'] ?>" value=""> 
            </td>
            
        </tr> 
    <?php  }} ?> 

    </tbody>
    
</table>
</div>
                        
 </div>
 
 <?php } ?><?php */?>
 
 <button type="submit" class="btn btn-primary pull-right" style="margin-top: 10px;" name="save_exam" value="save_exam"><?php echo $this->lang->line('save'); ?></button>
 <!---./end box-body--->
  </form>
  </div>
             </div> 
               
          <!--  </div>
        </div>-->
        <div class="clearfix"></div>
        <footer>           
        </footer>
    </body>
</html>