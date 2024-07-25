<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> <?php echo 'Feedback'; ?><small><?php echo $this->lang->line('student1'); ?></small>        </h1>
    </section>   
    <style type="text/css">
        .box-body{
            background-color: #fde4cfba;
        }
        .font-color{
            color: #0077b6;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-md-12">               
                <div class="box box-primary">
                   <form method="post" action="" name="feedform"> 
                    <div class="box-body box-profile">
                         <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            
                            <li class="list-group-item">
                               <center class="font-color"> <b><u>Sree Narayana College of Nursing , Parents Feedback Form</u> </b> </center>
                            </li>
                            
                             <li class="list-group-item">
                              <center>
                              This questionnaire is intended to improve the quality of teaching and learning in the college by collecting information from the parents and to evaluate the educational related activities. Mark your comments in the appropriate column.
                                </center><br>
                                <center class="font-color">
                                (We will keep the information collected confidential...)
                                </center>
                            </li>
                            <style type="text/css">
                                .mb-5{
                                    margin-bottom:8rem !important; 
                                }
                                .mt-5{
                                    margin-top:3rem !important; 
                                }
                            </style>
                            <table>
                                <tr>
                                <div class="mb-5 mt-5">
                                  <input type="hidden" name="parent_id" value="<?php echo set_value('id', $resultlist['id']); ?>">
                                  
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo "Parent's Name:"; ?></label>
                                        <input  id="pname" style="width:400px" name="pname" placeholder="" type="text" class="form-control" value="<?php echo $resultlist['pname']; ?>" />
                                        <span class="text-danger"><?php echo form_error('pname'); ?></span>
                                    </div>


                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'Address:'; ?></label>
                                        <input autofocus="" id="address" style="width:400px" name="address" placeholder="" type="text"  class="form-control" value="<?php echo $resultlist['address'];?>" />
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                    </div><br>
                                </div>
                                  </tr>
                               <tr>
                                <div class="mb-5">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo "Student's Name:"; ?></label>
                                        <input autofocus="" id="sname" style="width:400px" name="sname" placeholder="" type="text" class="form-control" value="<?php echo $resultlist['sname']; ?>"/>
                                        <span class="text-danger"><?php echo form_error('sname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'Year:'; ?></label>
                                        <input autofocus="" id="year" style="width:400px" name="year" placeholder="" type="text" class="form-control"  value="<?php echo $resultlist['year']; ?>"/>
                                        <span class="text-danger"><?php echo form_error('year'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo  'Phone Number:'; ?></label>
                                        <input autofocus="" id="phone" style="width:400px" name="phone" placeholder="" type="text" class="form-control"  value="<?php echo $resultlist['phone']; ?>" />
                                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                    </div>
                                </div>

                            </tr>
                            </table><br><br><br>

                            <table border="1" style="width:100%">
                                
                                   <th class="font-color">Serial no</th><br><br>
                                   <th class="font-color"><center>Statement</center></th><br><br>
                                   <th class="font-color"><center>Comment</center></th> 
                                   <tr>
                                       <td><center>1.</center></td>
                                   
                                       <td><u>a.Teaching and Systems</u><br> 
                                       How satisfied are you with the quality of teaching?  </td>
                                    <td>
                                        <input <?php echo set_radio('review', '0', $resultlist['review'] == '0'); ?>  id="review" name="review" type="radio" class="" <?php if($review=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review', 0); ?> />
                                          <label for="review" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review', '1', $resultlist['review'] == '1'); ?> id="review" name="review" type="radio" class="" <?php if($review=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review', 1); ?> />
                                          <label for="review" class="">Satisfied</label>

                                         <input <?php echo set_radio('review', '2', $resultlist['review'] == '2'); ?> id="review" name="review" type="radio" class="" <?php if($review=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review', 2); ?> />
                                         <label for="review" class="">Neutral</label>
                                    </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>b.Are the children satisfied with the practical training they get? </td>
                                       <td>
                                           <input <?php echo set_radio('review1', '0', $resultlist['review1'] == '0'); ?> id="review1" name="review1" type="radio" class="" <?php if($review1=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review1', 0); ?> />
                                          <label for="review1" class="">Very satisfied</label>

                                         <input  <?php echo set_radio('review1', '1', $resultlist['review1'] == '1'); ?> id="review1" name="review1" type="radio" class="" <?php if($review1=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review1', 1); ?> />
                                          <label for="review1" class="">Satisfied</label>

                                         <input  <?php echo set_radio('review1', '2', $resultlist['review1'] == '2'); ?> id="review1" name="review1" type="radio" class="" <?php if($review1=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review1', 2); ?> />
                                         <label for="review1" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>c.Teacher's approach to children? </td>
                                       <td>
                                           <input <?php echo set_radio('review2', '0', $resultlist['review2'] == '0'); ?> id="review2" name="review2" type="radio" class="" <?php if($review2=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review2', 0); ?> />
                                          <label for="review2" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review2', '1', $resultlist['review2'] == '1'); ?>  id="review2" name="review2" type="radio" class="" <?php if($review2=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review2', 1); ?> />
                                          <label for="review2" class="">Satisfied</label>

                                         <input <?php echo set_radio('review2', '2', $resultlist['review2'] == '2'); ?> id="review2" name="review2" type="radio" class="" <?php if($review2=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review2', 2); ?> />
                                         <label for="review2" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>d.Satisfied with the examination system of children?</td>
                                       <td>
                                           <input <?php echo set_radio('review3', '0', $resultlist['review3'] == '0'); ?> id="review3" name="review3" type="radio" class="" <?php if($review3=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review3', 0); ?> />
                                          <label for="review3" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review3', '1', $resultlist['review3'] == '1'); ?> id="review3" name="review3" type="radio" class="" <?php if($review3=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review3', 1); ?> />
                                          <label for="review3" class="">Satisfied</label>

                                         <input <?php echo set_radio('review3', '2', $resultlist['review3'] == '2'); ?> id="review3" name="review3" type="radio" class="" <?php if($review3=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review3', 2); ?> />
                                         <label for="review3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>e.Are children satisfied with the role of practicals teachers?</td>
                                       <td>
                                           <input <?php echo set_radio('review4', '0', $resultlist['review4'] == '0'); ?> id="review4" name="review4" type="radio" class="" <?php if($review4=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review4', 0); ?> />
                                          <label for="review4" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review4', '1', $resultlist['review4'] == '1'); ?> id="review4" name="review4" type="radio" class="" <?php if($review4=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review4', 1); ?> />
                                          <label for="review4" class="">Satisfied</label>

                                         <input<?php echo set_radio('review4', '2', $resultlist['review4'] == '2'); ?>  id="review4" name="review4" type="radio" class="" <?php if($review4=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review4', 2); ?> />
                                         <label for="review4" class="">Neutral</label>
                                       </td>
                                   </tr>

                                    <tr>
                                    <td></td>
                                       <td>f.Are you satisfied with the study facility of the college ?</td>
                                       <td>
                                           <input <?php echo set_radio('review5', '0', $resultlist['review5'] == '0'); ?> id="review5" name="review5" type="radio" class="" <?php if($review5=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review5', 0); ?> />
                                          <label for="review5" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review5', '1', $resultlist['review5'] == '1'); ?> id="review5" name="review5" type="radio" class="" <?php if($review5=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review5', 1); ?> />
                                          <label for="review5" class="">Satisfied</label>

                                         <input <?php echo set_radio('review5', '2', $resultlist['review5'] == '2'); ?>  id="review5" name="review5" type="radio" class="" <?php if($review5=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review5', 2); ?> />
                                         <label for="review5" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>1. <u>The library</u><br>
                                        *Books
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review6', '0', $resultlist['review6'] == '0'); ?>  id="review6" name="review6" type="radio" class="" <?php if($review6=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review6', 0); ?> />
                                          <label for="review6" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review6', '1', $resultlist['review6'] == '1'); ?> id="review6" name="review6" type="radio" class="" <?php if($review6=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review6', 1); ?> />
                                          <label for="review6" class="">Satisfied</label>

                                         <input <?php echo set_radio('review6', '2', $resultlist['review6'] == '2'); ?> id="review6" name="review6" type="radio" class="" <?php if($review6=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review6', 2); ?> />
                                         <label for="review6" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *Periodicals Publication 
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review7', '0', $resultlist['review7'] == '0'); ?> id="review7" name="review7" type="radio" class="" <?php if($review7=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review7', 0); ?> />
                                          <label for="review7" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review7', '1', $resultlist['review7'] == '1'); ?> id="review7" name="review7" type="radio" class="" <?php if($review7=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review7', 1); ?> />
                                          <label for="review7" class="">Satisfied</label>

                                         <input <?php echo set_radio('review7', '2', $resultlist['review7'] == '2'); ?> id="review7" name="review7" type="radio" class="" <?php if($review7=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review7', 2); ?> />
                                         <label for="review7" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *Library hours 
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review8', '0', $resultlist['review8'] == '0'); ?> id="review8" name="review8" type="radio" class="" <?php if($review8=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review8', 0); ?> />
                                          <label for="review8" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review8', '1', $resultlist['review8'] == '1'); ?> id="review8" name="review8" type="radio" class="" <?php if($review8=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review8', 1); ?> />
                                          <label for="review8" class="">Satisfied</label>

                                         <input <?php echo set_radio('review8', '2', $resultlist['review8'] == '2'); ?> id="review8" name="review8" type="radio" class="" <?php if($review8=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review8', 2); ?> />
                                         <label for="review8" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>2. <u>Laboratory</u><br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review9', '0', $resultlist['review9'] == '0'); ?> id="review9" name="review9" type="radio" class="" <?php if($review9=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review9', 0); ?> />
                                          <label for="review9" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review9', '1', $resultlist['review9'] == '1'); ?> id="review9" name="review9" type="radio" class="" <?php if($review9=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review9', 1); ?> />
                                          <label for="review9" class="">Satisfied</label>

                                         <input <?php echo set_radio('review9', '2', $resultlist['review9'] == '2'); ?> id="review9" name="review9" type="radio" class="" <?php if($review9=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review9', 2); ?> />
                                         <label for="review9" class="">Neutral</label>
                                       </td>
                                   </tr>
                                    <tr>
                                    <td><center>2.</center></td>
                                       <td>A mechanism for improving the quality of learning<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review10', '0', $resultlist['review10'] == '0'); ?> id="review10" name="review10" type="radio" class="" <?php if($review10=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review10', 0); ?> />
                                          <label for="review10" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review10', '1', $resultlist['review10'] == '1'); ?> id="review10" name="review10" type="radio" class="" <?php if($review10=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review10', 1); ?> />
                                          <label for="review10" class="">Satisfied</label>

                                         <input <?php echo set_radio('review10', '2', $resultlist['review10'] == '2'); ?> id="review10" name="review10" type="radio" class="" <?php if($review10=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review10', 2); ?> />
                                         <label for="review10" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Evening study schedule <br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review11', '0', $resultlist['review11'] == '0'); ?> id="review11" name="review11" type="radio" class="" <?php if($review11=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review11', 0); ?> />
                                          <label for="review11" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review11', '1', $resultlist['review11'] == '1'); ?> id="review11" name="review11" type="radio" class="" <?php if($review11=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review11', 1); ?> />
                                          <label for="review11" class="">Satisfied</label>

                                         <input <?php echo set_radio('review11', '2', $resultlist['review11'] == '2'); ?> id="review11" name="review11" type="radio" class="" <?php if($review11=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review11', 2); ?> />
                                         <label for="review11" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Directed by Teacher Guardian<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review29', '0', $resultlist['review29'] == '0'); ?> id="review29" name="review29" type="radio" class="" <?php if($review29=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review29', 0); ?> />
                                          <label for="review29" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review29', '1', $resultlist['review29'] == '1'); ?> id="review29" name="review29" type="radio" class="" <?php if($review29=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review29', 1); ?> />
                                          <label for="review29" class="">Satisfied</label>

                                         <input <?php echo set_radio('review29', '2', $resultlist['review29'] == '2'); ?> id="review29" name="review29" type="radio" class="" <?php if($review29=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review29', 2); ?> />
                                         <label for="review29" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Counseling <br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review12', '0', $resultlist['review12'] == '0'); ?> id="review12" name="review12" type="radio" class="" <?php if($review12=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review12', 0); ?> />
                                          <label for="review12" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review12', '1', $resultlist['review12'] == '1'); ?> id="review12" name="review12" type="radio" class="" <?php if($review12=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review12', 1); ?> />
                                          <label for="review12" class="">Satisfied</label>

                                         <input <?php echo set_radio('review12', '2', $resultlist['review12'] == '2'); ?> id="review12" name="review12" type="radio" class="" <?php if($review12=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review12', 2); ?> />
                                         <label for="review12" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center></center></td>
                                       <td>On demand classes from medical college<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review13', '0', $resultlist['review13'] == '0'); ?> id="review13" name="review13" type="radio" class="" <?php if($review13=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review13', 0); ?> />
                                          <label for="review13" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review13', '1', $resultlist['review13'] == '1'); ?> id="review13" name="review13" type="radio" class="" <?php if($review13=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review13', 1); ?> />
                                          <label for="review13" class="">Satisfied</label>

                                         <input <?php echo set_radio('review13', '2', $resultlist['review13'] == '2'); ?> id="review13" name="review13" type="radio" class="" <?php if($review13=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review13', 2); ?> />
                                         <label for="review13" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Participation of children in health awareness programs<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review14', '0', $resultlist['review14'] == '0'); ?> id="review14" name="review14" type="radio" class="" <?php if($review14=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review14', 0); ?> />
                                          <label for="review14" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review14', '1', $resultlist['review14'] == '1'); ?> id="review14" name="review14" type="radio" class="" <?php if($review14=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review14', 1); ?> />
                                          <label for="review14" class="">Satisfied</label>

                                         <input <?php echo set_radio('review14', '2', $resultlist['review14'] == '2'); ?> id="review14" name="review14" type="radio" class="" <?php if($review14=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review14', 2); ?> />
                                         <label for="review14" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Are you satisfied with providing the information you need to improve your child's academic performance ?<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review15', '0', $resultlist['review15'] == '0'); ?> id="review15" name="review15" type="radio" class="" <?php if($review15=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review15', 0); ?> />
                                          <label for="review15" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review15', '1', $resultlist['review15'] == '1'); ?> id="review15" name="review15" type="radio" class="" <?php if($review15=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review15', 1); ?> />
                                          <label for="review15" class="">Satisfied</label>

                                         <input <?php echo set_radio('review15', '2', $resultlist['review15'] == '2'); ?> id="review15" name="review15" type="radio" class="" <?php if($review15=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review15', 2); ?> />
                                         <label for="review15" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td><center>3.</center></td>
                                       <td><u>Hostel</u><br>
                                        *.Hostel facilities
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review16', '0', $resultlist['review16'] == '0'); ?> id="review16" name="review16" type="radio" class="" <?php if($review16=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review16', 0); ?> />
                                          <label for="review16" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review16', '1', $resultlist['review16'] == '1'); ?> id="review16" name="review16" type="radio" class="" <?php if($review16=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review16', 1); ?> />
                                          <label for="review16" class="">Satisfied</label>

                                         <input <?php echo set_radio('review16', '2', $resultlist['review16'] == '2'); ?> id="review16" name="review16" type="radio" class="" <?php if($review16=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review16', 2); ?> />
                                         <label for="review16" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Food quality<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review17', '0', $resultlist['review17'] == '0'); ?> id="review17" name="review17" type="radio" class="" <?php if($review17=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review17', 0); ?> />
                                          <label for="review17" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review17', '1', $resultlist['review17'] == '1'); ?> id="review17" name="review17" type="radio" class="" <?php if($review17=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review17', 1); ?> />
                                          <label for="review17" class="">Satisfied</label>

                                         <input <?php echo set_radio('review17', '2', $resultlist['review17'] == '2'); ?> id="review17" name="review17" type="radio" class="" <?php if($review17=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review17', 2); ?> />
                                         <label for="review17" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Diet<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review18', '0', $resultlist['review18'] == '0'); ?> id="review18" name="review18" type="radio" class="" <?php if($review18=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review18', 0); ?> />
                                          <label for="review18" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review18', '1', $resultlist['review18'] == '1'); ?> id="review18" name="review18" type="radio" class="" <?php if($review18=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review18', 1); ?> />
                                          <label for="review18" class="">Satisfied</label>

                                         <input <?php echo set_radio('review18', '2', $resultlist['review18'] == '2'); ?> id="review18" name="review18" type="radio" class="" <?php if($review18=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review18', 2); ?> />
                                         <label for="review18" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Drinking water<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review19', '0', $resultlist['review19'] == '0'); ?> id="review19" name="review19" type="radio" class="" <?php if($review19=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review19', 0); ?> />
                                          <label for="review19" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review19', '1', $resultlist['review19'] == '1'); ?> id="review19" name="review19" type="radio" class="" <?php if($review19=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review19', 1); ?> />
                                          <label for="review19" class="">Satisfied</label>

                                         <input <?php echo set_radio('review19', '2', $resultlist['review19'] == '2'); ?> id="review19" name="review19" type="radio" class="" <?php if($review19=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review19', 2); ?> />
                                         <label for="review19" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Phone<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review20', '0', $resultlist['review20'] == '0'); ?> id="review20" name="review20" type="radio" class="" <?php if($review20=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review20', 0); ?> />
                                          <label for="review20" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review20', '1', $resultlist['review20'] == '1'); ?> id="review20" name="review20" type="radio" class="" <?php if($review20=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review20', 1); ?> />
                                          <label for="review20" class="">Satisfied</label>

                                         <input <?php echo set_radio('review20', '2', $resultlist['review20'] == '2'); ?> id="review20" name="review20" type="radio" class="" <?php if($review20=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review20', 2); ?> />
                                         <label for="review20" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Hostel Timings<br>
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review21', '0', $resultlist['review21'] == '0'); ?> id="review21" name="review21" type="radio" class="" <?php if($review21=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review21', 0); ?> />
                                          <label for="review21" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review21', '1', $resultlist['review21'] == '1'); ?> id="review21" name="review21" type="radio" class="" <?php if($review21=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review21', 1); ?> />
                                          <label for="review21" class="">Satisfied</label>

                                         <input <?php echo set_radio('review21', '2', $resultlist['review21'] == '2'); ?> id="review21" name="review21" type="radio" class="" <?php if($review21=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review21', 2); ?> />
                                         <label for="review21" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Sports competitions
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review22', '0', $resultlist['review22'] == '0'); ?> id="review22" name="review22" type="radio" class="" <?php if($review22=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review22', 0); ?> />
                                          <label for="review22" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review22', '1', $resultlist['review22'] == '1'); ?> id="review22" name="review22" type="radio" class="" <?php if($review22=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review22', 1); ?> />
                                          <label for="review22" class="">Satisfied</label>

                                         <input <?php echo set_radio('review22', '2', $resultlist['review22'] == '2'); ?> id="review22" name="review22" type="radio" class="" <?php if($review22=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review22', 2); ?> />
                                         <label for="review22" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* National Service Scheme Programmes
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review23', '0', $resultlist['review23'] == '0'); ?> id="review23" name="review23" type="radio" class="" <?php if($review23=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review23', 0); ?> />
                                          <label for="review23" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review23', '1', $resultlist['review23'] == '1'); ?> id="review23" name="review23" type="radio" class="" <?php if($review23=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review23', 1); ?> />
                                          <label for="review23" class="">Satisfied</label>

                                         <input <?php echo set_radio('review23', '2', $resultlist['review23'] == '2'); ?> id="review23" name="review23" type="radio" class="" <?php if($review23=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review23', 2); ?> />
                                         <label for="review23" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>*  Union Activities 
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review24', '0', $resultlist['review24'] == '0'); ?> id="review24" name="review24" type="radio" class="" <?php if($review24=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review24', 0); ?> />
                                          <label for="review24" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review24', '1', $resultlist['review24'] == '1'); ?> id="review24" name="review24" type="radio" class="" <?php if($review24=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review24', 1); ?> />
                                          <label for="review24" class="">Satisfied</label>

                                         <input <?php echo set_radio('review24', '2', $resultlist['review24'] == '2'); ?> id="review24" name="review24" type="radio" class="" <?php if($review24=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review24', 2); ?> />
                                         <label for="review24" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Spiritual growth classes
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review25', '0', $resultlist['review25'] == '0'); ?> id="review25" name="review25" type="radio" class="" <?php if($review25=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review25', 0); ?> />
                                          <label for="review25" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review25', '1', $resultlist['review25'] == '1'); ?> id="review25" name="review25" type="radio" class="" <?php if($review25=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review25', 1); ?> />
                                          <label for="review25" class="">Satisfied</label>

                                         <input <?php echo set_radio('review25', '2', $resultlist['review25'] == '2'); ?> id="review25" name="review25" type="radio" class="" <?php if($review25=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review25', 2); ?> />
                                         <label for="review25" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center>5.</center></td>
                                       <td><u>Parent meeting and assessment </u><br>
                                        a.  Are you satisfied with the communication from the college when organizing parent meeting?

                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review26', '0', $resultlist['review26'] == '0'); ?> id="review26" name="review26" type="radio" class="" <?php if($review26=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review26', 0); ?> />
                                          <label for="review26" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review26', '1', $resultlist['review26'] == '1'); ?> id="review26" name="review26" type="radio" class="" <?php if($review26=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review26', 1); ?> />
                                          <label for="review26" class="">Satisfied</label>

                                         <input <?php echo set_radio('review26', '2', $resultlist['review26'] == '2'); ?> id="review26" name="review26" type="radio" class="" <?php if($review26=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review26', 2); ?> />
                                         <label for="review26" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>b. Are you satisfied with the way you are treated when you raise your needs?
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review27', '0', $resultlist['review27'] == '0'); ?> id="review27" name="review27" type="radio" class="" <?php if($review27=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review27', 0); ?> />
                                          <label for="review27" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review27', '1', $resultlist['review27'] == '1'); ?> id="review27" name="review27" type="radio" class="" <?php if($review27=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review27', 1); ?> />
                                          <label for="review27" class="">Satisfied</label>

                                         <input <?php echo set_radio('review27', '2', $resultlist['review27'] == '2'); ?> id="review27" name="review27" type="radio" class="" <?php if($review27=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review27', 2); ?> />
                                         <label for="review27" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>c.Have your needs addressed
                                        
                                       </td>
                                       <td>
                                           <input <?php echo set_radio('review28', '0', $resultlist['review28'] == '0'); ?> id="review28" name="review28" type="radio" class="" <?php if($review28=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review28', 0); ?> />
                                          <label for="review28" class="">Very satisfied</label>

                                         <input <?php echo set_radio('review28', '1', $resultlist['review28'] == '1'); ?> id="review28" name="review28" type="radio" class="" <?php if($review28=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review28', 1); ?> />
                                          <label for="review28" class="">Satisfied</label>

                                         <input <?php echo set_radio('review28', '2', $resultlist['review28'] == '2'); ?> id="review28" name="review28" type="radio" class="" <?php if($review28=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review28', 2); ?> />
                                         <label for="review28" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                   
                            </table>
                            <br><br>

                            <table style="width=100%">
                                <tr>
                                1. Are there any other specific issues you would like to bring to the attention of the college authorities? Explain
                                    <div class="mb-5">
                                     
                                    
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="problem" style="width:400px" name="problem" placeholder="" class="form-control"><?php echo $resultlist['problem']; ?></textarea>
                                        <span class="text-danger"><?php echo form_error('problem'); ?></span>
                                    </div>
       
                                </div>
                                </tr>


                                <tr>
                                2.The quality of the college is determined by the main emphasis
                                    <div class="mb-5">
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="problemnew" style="width:400px" name="problemnew" placeholder="" class="form-control"><?php echo $resultlist['problemnew']; ?></textarea>
                                        <span class="text-danger"><?php echo form_error('problemnew'); ?></span>
                                    </div>
                                </div>
                                </tr>
                                <tr>
                                3.Your general opinion about the college
                                    <div class="mb-5">
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="college" style="width:400px" name="college" placeholder="" class="form-control"><?php echo $resultlist['college']; ?></textarea>
                                        <span class="text-danger"><?php echo form_error('college'); ?></span>
                                    </div>
                                </div>
                                </tr>
                                <tr>
                                (Return the form to the class teacher after completion.) Thank you for your comment
                                </tr><br><br>
                                <tr>
                                <div class="mb-5">
                                     
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'Date :'; ?></label>
                                        <input autofocus="" id="date" style="width:400px" name="date" placeholder="" type="date" class="form-control" value="<?php echo $resultlist['date']; ?>" />
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>

                                </div>
                            </tr><center>
                            
                        </center>
                            </table>
                            
                               
                                
                           

                        </ul>
                    </div>
                </form>
                </div>
            </div>

        </div>
</div>
</section>
</div>