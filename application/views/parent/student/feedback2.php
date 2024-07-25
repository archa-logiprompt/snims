<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> <?php echo 'Feedback'; ?><small><?php echo $this->lang->line('student1'); ?></small>        
            <button class="btn btn-info pull-right btn-sm" id="englishbtn" type="button" style="display:block">English</button>
            <button class="btn btn-info pull-right btn-sm" id="malayalambtn" type="button" style="display:none">Malayalam</button> </h1>
           
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
                <div class="box box-primary" id="malayalam" >
                   <form method="post" action="" name="feedform"> 
                    <div class="box-body box-profile">
                         <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            
                            <li class="list-group-item">
                               <center class="font-color"> <h3><b><u>Sree Narayana College of Nursing , Parents Feedback Form</h3></u> </b> </center>
                            </li>
                            
                             <li class="list-group-item">
                              <center>
                                മാതാപിതാക്കളിൽ നിന്നുള്ള വിവരശേഖരണത്തിലൂടെ കോളേജിലെ അദ്ധ്യാപന-പഠന നിലവാരം മെച്ചപ്പെടുത്തുന്നതിനും, വിദ്യാഭ്യാസ അനുബന്ധ പ്രവർത്തനങ്ങളുടെ വിലയിരുത്തലുമാണ് ഈ ചോദ്യാവലികൊണ്ട് ഉദ്ദേശിക്കുന്നത് .നിങ്ങളുടെ അഭിപ്രായങ്ങൾ ഉചിതമായ കോളത്തിൽ  അടയാളപ്പെടുത്തുക.
                                </center><br>
                                <center class="font-color">
                                  (ശേഖരിക്കുന്ന വിവരങ്ങൾ ഞങ്ങൾ രഹസ്യമായി സൂക്ഷിക്കുന്നതാണ്...)
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
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'രക്ഷകർത്താവിന്റെ പേര്:'; ?></label>
                                        <input autofocus="" id="pname" style="width:400px" name="pname" placeholder="" type="text" class="form-control" value="<?php echo $parent_details->guardian_name; ?>" />
                                        <span class="text-danger"><?php echo form_error('pname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'മേൽവിലാസം:'; ?></label>
                                        <input autofocus="" id="address" style="width:400px" name="address" placeholder="" type="text"  class="form-control" value="<?php echo $parent_details->guardian_address; ?>" />
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                    </div><br>
                                </div>
                                  </tr>
                               <tr>
                                <div class="mb-5">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'വിദ്യാർഥി/വിദ്യാർഥിനിയുടെ പേര്:'; ?></label>
                                        <input autofocus="" id="sname" style="width:400px" name="sname" placeholder="" type="text" class="form-control" value="<?php echo $parent_details->firstname." ".$parent_details->lastname; ?>" />
                                        <span class="text-danger"><?php echo form_error('sname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'വർഷം:'; ?></label>
                                        <input autofocus="" id="year" style="width:400px" name="year" placeholder="" type="text" class="form-control"  value="<?php echo $parent_details->session; ?>" />
                                        <span class="text-danger"><?php echo form_error('year'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'ഫോൺ നമ്പർ:'; ?></label>
                                        <input autofocus="" id="phone" style="width:400px" name="phone" placeholder="" type="text" class="form-control"  value="<?php echo $parent_details->guardian_phone; ?>" />
                                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                    </div>
                                </div>

                            </tr>
                            </table><br><br><br>

                            <table border="1">
                                
                                   <th class="font-color">ക്രമനമ്പർ</th><br><br>
                                   <th class="font-color"><center>പ്രസ്താവന</center></th><br><br>
                                   <th class="font-color"><center>അഭിപ്രായം</center></th> 
                                   <tr>
                                       <td><center>1.</center></td>
                                   
                                       <td><u>a.അധ്യാപനവും സംവിധാനങ്ങളും</u><br> 
                                  അധ്യാപന നിലവാരത്തിൽ നിങ്ങൾ <br>എത്രമാത്രം തൃപ്തരാണ്? </td>
                                    <td>
                                        <input id="review1" name="review" type="radio" checked class="" <?php if ($review == '0')
                                            echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review', 0); ?> />
                                          <label for="review1" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review2" name="review" type="radio" class="" <?php if ($review == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review', 1); ?> />
                                          <label for="review2" class="">സംതൃപ്തം</label>

                                         <input id="review3" name="review" type="radio" class="" <?php if ($review == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review', 2); ?> />
                                         <label for="review3" class="">നിഷ്പക്ഷം</label>
                                    </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>b.കുട്ടികൾക്ക് കിട്ടുന്ന പ്രായോഗിക പരിശീലനത്തിൽ തൃപ്തരാണോ? </td>
                                       <td>
                                           <input id="review11" name="review1" type="radio" class="" checked <?php if ($review1 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review1', 0); ?> />
                                          <label for="review11" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review12" name="review1" type="radio" class="" <?php if ($review1 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review1', 1); ?> />
                                          <label for="review12" class="">സംതൃപ്തം</label>

                                         <input id="review13" name="review1" type="radio" class="" <?php if ($review1 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review1', 2); ?> />
                                         <label for="review13" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>c.കുട്ടികളോടുള്ള അധ്യാപകരുടെ സമീപനരീതി? </td>
                                       <td>
                                           <input id="review21" name="review2" type="radio" class=""checked <?php if ($review2 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review2', 0); ?> />
                                          <label for="review21" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review22" name="review2" type="radio" class="" <?php if ($review2 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review2', 1); ?> />
                                          <label for="review22" class="">സംതൃപ്തം</label>

                                         <input id="review23" name="review2" type="radio" class="" <?php if ($review2 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review2', 2); ?> />
                                         <label for="review23" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>d.കുട്ടികളുടെ പരീക്ഷാസംവിധാനത്തിൽ തൃപ്തരാണോ?</td>
                                       <td>
                                           <input id="review31" name="review3" type="radio" class=""checked <?php if ($review3 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review3', 0); ?> />
                                          <label for="review31" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review32" name="review3" type="radio" class="" <?php if ($review3 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review3', 1); ?> />
                                          <label for="review32" class="">സംതൃപ്തം</label>

                                         <input id="review33" name="review3" type="radio" class="" <?php if ($review3 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review3', 2); ?> />
                                         <label for="review33" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>e.കുട്ടികളുടെ പ്രായോഗിക പരിശീലനം അഥവാ പ്രാക്ടിക്കൽസ് അധ്യാപകരുടെ പങ്കിൽ തൃപ്തരാണോ ?</td>
                                       <td>
                                           <input id="review41" name="review4" type="radio" class="" checked<?php if ($review4 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review4', 0); ?> />
                                          <label for="review41" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review42" name="review4" type="radio" class="" <?php if ($review4 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review4', 1); ?> />
                                          <label for="review42" class="">സംതൃപ്തം</label>

                                         <input id="review43" name="review4" type="radio" class="" <?php if ($review4 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review4', 2); ?> />
                                         <label for="review43" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                    <tr>
                                    <td></td>
                                       <td>f.കോളേജിൻറെ പഠന സൗകര്യത്തിൽ തൃപ്തരാണോ ?</td>
                                       <td>
                                           <input id="review51" name="review5" type="radio" class=""checked <?php if ($review5 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review5', 0); ?> />
                                          <label for="review51" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review52" name="review5" type="radio" class="" <?php if ($review5 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review5', 1); ?> />
                                          <label for="review52" class="">സംതൃപ്തം</label>

                                         <input id="review53" name="review5" type="radio" class="" <?php if ($review5 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review5', 2); ?> />
                                         <label for="review53" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>1. <u>ലൈബ്രറി</u><br>
                                        *പുസ്തകങ്ങൾ
                                       </td>
                                       <td>
                                           <input id="review61" name="review6" type="radio" class="" checked<?php if ($review6 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review6', 0); ?> />
                                          <label for="review61" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review62" name="review6" type="radio" class="" <?php if ($review6 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review6', 1); ?> />
                                          <label for="review62" class="">സംതൃപ്തം</label>

                                         <input id="review63" name="review6" type="radio" class="" <?php if ($review6 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review6', 2); ?> />
                                         <label for="review63" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *ആനുകാലിക പ്രസിദ്ധീകരണങ്ങൾ 
                                       </td>
                                       <td>
                                           <input id="review71" name="review7" type="radio" class=""checked<?php if ($review7 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review7', 0); ?> />
                                          <label for="review71" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review72" name="review7" type="radio" class="" <?php if ($review7 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review7', 1); ?> />
                                          <label for="review72" class="">സംതൃപ്തം</label>

                                         <input id="review73" name="review7" type="radio" class="" <?php if ($review7 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review7', 2); ?> />
                                         <label for="review73" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *ലൈബ്രറി സമയം 
                                       </td>
                                       <td>
                                           <input id="review81" name="review8" type="radio" class=""checked <?php if ($review8 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review8', 0); ?> />
                                          <label for="review81" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review82" name="review8" type="radio" class="" <?php if ($review8 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review8', 1); ?> />
                                          <label for="review82" class="">സംതൃപ്തം</label>

                                         <input id="review83" name="review8" type="radio" class="" <?php if ($review8 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review8', 2); ?> />
                                         <label for="review83" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>2. <u>ലബോറട്ടറി</u><br>
                                        
                                       </td>
                                       <td>
                                           <input id="review91" name="review9" type="radio" class="" checked<?php if ($review9 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review9', 0); ?> />
                                          <label for="review91" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review92" name="review9" type="radio" class="" <?php if ($review9 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review9', 1); ?> />
                                          <label for="review92" class="">സംതൃപ്തം</label>

                                         <input id="review93" name="review9" type="radio" class="" <?php if ($review9 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review9', 2); ?> />
                                         <label for="review93" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                    <tr>
                                    <td><center>2.</center></td>
                                       <td>പഠന നിലവാരം ഉയർത്താനുള്ള സംവിധാനം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review101" name="review10" type="radio" class=""checked <?php if ($review10 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review10', 0); ?> />
                                          <label for="review101" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review102" name="review10" type="radio" class="" <?php if ($review10 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review10', 1); ?> />
                                          <label for="review102" class="">സംതൃപ്തം</label>

                                         <input id="review103" name="review10" type="radio" class="" <?php if ($review10 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review10', 2); ?> />
                                         <label for="review103" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>വൈകുന്നേരം ഉള്ള പഠനക്രമം <br>
                                        
                                       </td>
                                       <td>
                                           <input id="review111" name="review11" type="radio" class=""checked <?php if ($review11 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review11', 0); ?> />
                                          <label for="review111" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review112" name="review11" type="radio" class="" <?php if ($review11 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review11', 1); ?> />
                                          <label for="review112" class="">സംതൃപ്തം</label>

                                         <input id="review113" name="review11" type="radio" class="" <?php if ($review11 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review11', 2); ?> />
                                         <label for="review113" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>ടീച്ചർ ഗാർഡിയൻ സംവിധാനം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review291" name="review29" type="radio" class="" checked<?php if ($review29 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review29', 0); ?> />
                                          <label for="review291" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review292" name="review29" type="radio" class="" <?php if ($review29 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review29', 1); ?> />
                                          <label for="review292" class="">സംതൃപ്തം</label>

                                         <input id="review239" name="review29" type="radio" class="" <?php if ($review29 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review29', 2); ?> />
                                         <label for="review293" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>കൗൺസിലിംഗ് <br>
                                        
                                       </td>
                                       <td>
                                           <input id="review121" name="review12" type="radio"checked class="" <?php if ($review12 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review12', 0); ?> />
                                          <label for="review121" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review122" name="review12" type="radio" class="" <?php if ($review12 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review12', 1); ?> />
                                          <label for="review122" class="">സംതൃപ്തം</label>

                                         <input id="review123" name="review12" type="radio" class="" <?php if ($review12 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review12', 2); ?> />
                                         <label for="review123" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center></center></td>
                                       <td>മെഡിക്കൽ കോളേജിൽ നിന്നും ആവശ്യാനുസരണമുള്ള ക്ലാസുകൾ<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review131" name="review13" type="radio" class="" <?php if ($review13 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review13', 0); ?> />
                                          <label for="review131" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review132" name="review13" type="radio" class="" <?php if ($review13 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review13', 1); ?> />
                                          <label for="review132" class="">സംതൃപ്തം</label>

                                         <input id="review133" name="review13" type="radio" class=""checked <?php if ($review13 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review13', 2); ?> />
                                         <label for="review133" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>ആരോഗ്യ ബോധവൽക്കരണ പരിപാടികളിൽ കുട്ടികളുടെ പങ്കാളിത്തം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review141" name="review14" type="radio" class=""checked <?php if ($review14 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review14', 0); ?> />
                                          <label for="review141" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review142" name="review14" type="radio" class="" <?php if ($review14 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review14', 1); ?> />
                                          <label for="review142" class="">സംതൃപ്തം</label>

                                         <input id="review143" name="review14" type="radio" class="" <?php if ($review14 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review14', 2); ?> />
                                         <label for="review143" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>നിങ്ങളുടെ കുട്ടിയുടെ പഠന നിലവാരം ഉയർത്തുന്നതിന് ആവശ്യമായ വിവരങ്ങൾ നൽകുന്നതിൽ സംതൃപ്തരാണോ ?<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review151" name="review15" type="radio" class=""checked <?php if ($review15 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review15', 0); ?> />
                                          <label for="review151" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review152" name="review15" type="radio" class="" <?php if ($review15 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review15', 1); ?> />
                                          <label for="review152" class="">സംതൃപ്തം</label>

                                         <input id="review153" name="review15" type="radio" class="" <?php if ($review15 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review15', 2); ?> />
                                         <label for="review153" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td><center>3.</center></td>
                                       <td><u>ഹോസ്റ്റൽ</u><br>
                                        *.ഹോസ്റ്റൽ സൗകര്യങ്ങൾ 
                                       </td>
                                       <td>
                                           <input id="review161" name="review16" type="radio" class=""checked <?php if ($review16 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review16', 0); ?> />
                                          <label for="review161" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review162" name="review16" type="radio" class="" <?php if ($review16 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review16', 1); ?> />
                                          <label for="review162" class="">സംതൃപ്തം</label>

                                         <input id="review163" name="review16" type="radio" class="" <?php if ($review16 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review16', 2); ?> />
                                         <label for="review163" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഭക്ഷണ നിലവാരം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review171" name="review17" type="radio" class=""checked <?php if ($review17 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review17', 0); ?> />
                                          <label for="review171" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review172" name="review17" type="radio" class="" <?php if ($review17 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review17', 1); ?> />
                                          <label for="review172" class="">സംതൃപ്തം</label>

                                         <input id="review173" name="review17" type="radio" class="" <?php if ($review17 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review17', 2); ?> />
                                         <label for="review173" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഭക്ഷണക്രമീകരണം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review181" name="review18" type="radio" class="" checked<?php if ($review18 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review18', 0); ?> />
                                          <label for="review181" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review182" name="review18" type="radio" class="" <?php if ($review18 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review18', 1); ?> />
                                          <label for="review182" class="">സംതൃപ്തം</label>

                                         <input id="review183" name="review18" type="radio" class="" <?php if ($review18 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review18', 2); ?> />
                                         <label for="review183" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* കുടിവെള്ളം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review191" name="review19" type="radio" class="" checked<?php if ($review19 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review19', 0); ?> />
                                          <label for="review191" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review192" name="review19" type="radio" class="" <?php if ($review19 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review19', 1); ?> />
                                          <label for="review192" class="">സംതൃപ്തം</label>

                                         <input id="review193" name="review19" type="radio" class="" <?php if ($review19 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review19', 2); ?> />
                                         <label for="review193" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഫോൺ<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review201" name="review20" type="radio" class=""checked <?php if ($review20 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review20', 0); ?> />
                                          <label for="review201" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review202" name="review20" type="radio" class="" <?php if ($review20 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review20', 1); ?> />
                                          <label for="review202" class="">സംതൃപ്തം</label>

                                         <input id="review203" name="review20" type="radio" class="" <?php if ($review20 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review20', 2); ?> />
                                         <label for="review203" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഹോസ്റ്റൽ സമയക്രമങ്ങൾ<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review211" name="review21" type="radio" class="" checked<?php if ($review21 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review21', 0); ?> />
                                          <label for="review211" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review212" name="review21" type="radio" class="" <?php if ($review21 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review21', 1); ?> />
                                          <label for="review212" class="">സംതൃപ്തം</label>

                                         <input id="review213" name="review21" type="radio" class="" <?php if ($review21 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review21', 2); ?> />
                                         <label for="review213" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>കായികമത്സരങ്ങൾ
                                        
                                       </td>
                                       <td>
                                           <input id="review221" name="review22" type="radio" class=""checked <?php if ($review22 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review22', 0); ?> />
                                          <label for="review221" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review222" name="review22" type="radio" class="" <?php if ($review22 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review22', 1); ?> />
                                          <label for="review222" class="">സംതൃപ്തം</label>

                                         <input id="review223" name="review22" type="radio" class="" <?php if ($review22 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review22', 2); ?> />
                                         <label for="review223" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* നാഷണൽ സർവീസ് സ്കീം പരിപാടികൾ
                                        
                                       </td>
                                       <td>
                                           <input id="review231" name="review23" type="radio" class=""checked <?php if ($review23 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review23', 0); ?> />
                                          <label for="review231" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review232" name="review23" type="radio" class="" <?php if ($review23 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review23', 1); ?> />
                                          <label for="review232" class="">സംതൃപ്തം</label>

                                         <input id="review233" name="review23" type="radio" class="" <?php if ($review23 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review23', 2); ?> />
                                         <label for="review233" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* യൂണിയൻ പ്രവർത്തനങ്ങൾ 
                                        
                                       </td>
                                       <td>
                                           <input id="review241" name="review24" type="radio" class=""checked <?php if ($review24 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review24', 0); ?> />
                                          <label for="review241" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review242" name="review24" type="radio" class="" <?php if ($review24 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review24', 1); ?> />
                                          <label for="review242" class="">സംതൃപ്തം</label>

                                         <input id="review243" name="review24" type="radio" class="" <?php if ($review24 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review24', 2); ?> />
                                         <label for="review243" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* അധ്യാത്മിക വളർച്ച ക്ലാസുകൾ 
                                        
                                       </td>
                                       <td>
                                           <input id="review251" name="review25" type="radio" class=""checked <?php if ($review25 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review25', 0); ?> />
                                          <label for="review251" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review252" name="review25" type="radio" class="" <?php if ($review25 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review25', 1); ?> />
                                          <label for="review252" class="">സംതൃപ്തം</label>

                                         <input id="review253" name="review25" type="radio" class="" <?php if ($review25 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review25', 2); ?> />
                                         <label for="review253" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center>5.</center></td>
                                       <td><u>രക്ഷകർതൃ യോഗവും വിലയിരുത്തലും </u><br>
                                        a. രക്ഷകർതൃ യോഗം സംഘടിപ്പിക്കുമ്പോൾ കോളേജിൽ നിന്നുമുള്ള ആശയവിനിമയത്തിൽ നിങ്ങൾ സംതൃപ്തരാണോ
                                        
                                       </td>
                                       <td>
                                           <input id="review261" name="review26" type="radio" class="" checked<?php if ($review26 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review26', 0); ?> />
                                          <label for="review261" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review262" name="review26" type="radio" class="" <?php if ($review26 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review26', 1); ?> />
                                          <label for="review262" class="">സംതൃപ്തം</label>

                                         <input id="review263" name="review26" type="radio" class="" <?php if ($review26 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review26', 2); ?> />
                                         <label for="review263" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>b. നിങ്ങളുടെ ആവശ്യങ്ങൾ ഉന്നയിക്കുമ്പോൾ നിങ്ങളോടുള്ള സമീപനത്തിൽ സംതൃപ്തരാണോ 

                                        
                                       </td>
                                       <td>
                                           <input id="review271" name="review27" type="radio" class=""checked <?php if ($review27 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review27', 0); ?> />
                                          <label for="review271" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review272" name="review27" type="radio" class="" <?php if ($review27 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review27', 1); ?> />
                                          <label for="review272" class="">സംതൃപ്തം</label>

                                         <input id="review273" name="review27" type="radio" class="" <?php if ($review27 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review27', 2); ?> />
                                         <label for="review273" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>c.നിങ്ങളുടെ ആവശ്യങ്ങൾ പരിഹരിക്കപ്പെടാൻ ഉണ്ടോ
                                        
                                       </td>
                                       <td>
                                           <input id="review281" name="review28" type="radio" class=""checked <?php if ($review28 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review28', 0); ?> />
                                          <label for="review281" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review282" name="review28" type="radio" class="" <?php if ($review28 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review28', 1); ?> />
                                          <label for="review282" class="">സംതൃപ്തം</label>

                                         <input id="review283" name="review28" type="radio" class="" <?php if ($review28 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review28', 2); ?> />
                                         <label for="review283" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                   
                            </table>
                            <br><br>

                            <table>
                                <tr>
                                    1.മറ്റെന്തെങ്കിലും പ്രത്യേക പ്രശ്നങ്ങൾ കോളേജ് അധികൃതരുടെ ശ്രദ്ധയിൽ പെടുത്താൻ നിങ്ങൾ ആഗ്രഹിക്കുന്നുണ്ടോ? വിശദമാക്കുക.
                                    <div class="mb-5">
                                     
                                    
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="problem" style="width:400px" name="problem" placeholder="" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('problem'); ?></span>
                                    </div>
       
                                </div>
                                </tr>


                                <tr>
                                    2.കോളേജിന്റെ നിലവാരം നിർണയിക്കുന്നത് പ്രധാനമായും ഊന്നൽ നൽകേണ്ട കാര്യങ്ങൾ ?
                                    <div class="mb-5">
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="problemnew" style="width:400px" name="problemnew" placeholder="" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('problemnew'); ?></span>
                                    </div>
                                </div>
                                </tr>
                                <tr>
                                    3.കോളേജിനെ കുറിച്ചുള്ള നിങ്ങളുടെ പൊതുവായ അഭിപ്രായം?
                                    <div class="mb-5">
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="college" style="width:400px" name="college" placeholder="" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('college'); ?></span>
                                    </div>
                                </div>
                                </tr>
                                <tr>
                                    (പൂർത്തിയാക്കിയതിനുശേഷം ഫോം ക്ലാസ് ടീച്ചറെ ഏൽപ്പിക്കുക.) നിങ്ങളുടെ അഭിപ്രായത്തിന് നന്ദി
                                </tr><br><br>
                                <tr>
                                <div class="mb-5">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'രക്ഷാകർത്താവിന്റെ പേര്:'; ?></label>
                                        <input autofocus="" id="ptname" style="width:400px" name="ptname" placeholder="" type="text" class="form-control" value="<?php echo $parent_details->guardian_name; ?>" />
                                        <span class="text-danger"><?php echo form_error('ptname'); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'തീയതി :'; ?></label>
                                        <input autofocus="" id="date" style="width:400px" name="date" placeholder="" type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" />

                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>

                                </div>
                            </tr><center>
                            <div class="box-footer">
                            <button type="submit" name="submit" value="submit" class="btn btn-success" style="width: 300px"></i> <?php echo $this->lang->line('submit'); ?></button>
                        </div>
                        </center>
                            </table>
                            
                               
                                
                           

                        </ul>
                    </div>
                </form>
                </div>



                <div class="box box-primary" id="english" style="display:none">
                   <form method="post" action="" name="feedform"> 
                    <div class="box-body box-profile">
                         <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            
                            <li class="list-group-item">
                               <center class="font-color"> <h3><b><u>Sree Narayana College of Nursing , Parents Feedback Form</h3></u> </b> </center>
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
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo "Parent's Name:"; ?></label>
                                        <input autofocus="" id="pname" style="width:400px" name="pname" placeholder="" type="text" class="form-control" value="<?php echo $parent_details->guardian_name; ?>" />
                                        <span class="text-danger"><?php echo form_error('pname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'Address:'; ?></label>
                                        <input autofocus="" id="address" style="width:400px" name="address" placeholder="" type="text"  class="form-control" value="<?php echo $parent_details->guardian_address; ?>" />
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                    </div><br>
                                </div>
                                  </tr>
                               <tr>
                                <div class="mb-5">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo "Student's Name:"; ?></label>
                                        <input autofocus="" id="sname" style="width:400px" name="sname" placeholder="" type="text" class="form-control" value="<?php echo $parent_details->firstname." ".$parent_details->lastname; ?>" />
                                        <span class="text-danger"><?php echo form_error('sname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'Year:'; ?></label>
                                        <input autofocus="" id="year" style="width:400px" name="Year" placeholder="" type="text" class="form-control"  value="<?php echo $parent_details->session; ?>" />
                                        <span class="text-danger"><?php echo form_error('year'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'Phone Number:'; ?></label>
                                        <input autofocus="" id="phone" style="width:400px" name="phone" placeholder="" type="text" class="form-control"  value="<?php echo $parent_details->guardian_phone; ?>" />
                                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                    </div>
                                </div>

                            </tr>
                            </table><br><br><br>

                            <table border="1" style='width:100%'>
                                
                                   <th class="font-color">Serial no</th><br><br>
                                   <th class="font-color"><center>Statement</center></th><br><br>
                                   <th class="font-color"><center>Comment</center></th> 
                                   <tr>
                                       <td><center>1.</center></td>
                                   
                                       <td><u>a.Teaching and Systems</u><br>
                                  How satisfied are you with the quality of teaching? </td>
                                    <td>
                                        <input id="reviewe1" name="review" type="radio" class="" checked value="0" <?php echo $this->form_validation->set_radio('review', 0); ?> />
                                          <label for="review1" class="">Very satisfied</label>

                                         <input id="reviewe2" name="review" type="radio" class="" <?php if ($review == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review', 1); ?> />
                                          <label for="reviewe2" class="">Satisfied</label>

                                         <input id="reviewe3" name="review" type="radio" class="" <?php if ($review == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review', 2); ?> />
                                         <label for="reviewe3" class="">Neutral</label>
                                    </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>b.Are the children satisfied with the practical training they get? </td>
                                       <td>
                                           <input id="review1e1" name="review1" type="radio" class=""checked <?php if ($review1 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review1', 0); ?> />
                                          <label for="review1e1" class="">Very satisfied</label>

                                         <input id="review1e2" name="review1" type="radio" class="" <?php if ($review1 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review1', 1); ?> />
                                          <label for="review1e2" class="">Satisfied</label>

                                         <input id="review1e3" name="review1" type="radio" class="" <?php if ($review1 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review1', 2); ?> />
                                         <label for="review13" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>c.Teacher's approach to children? </td>
                                       <td>
                                           <input id="review2e1" name="review2" type="radio" class=""checked <?php if ($review2 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review2', 0); ?> />
                                          <label for="review2e1" class="">Very satisfied</label>

                                         <input id="review2e2" name="review2" type="radio" class="" <?php if ($review2 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review2', 1); ?> />
                                          <label for="review2e2" class="">Satisfied</label>

                                         <input id="review2e3" name="review2" type="radio" class="" <?php if ($review2 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review2', 2); ?> />
                                         <label for="review2e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>d.Satisfied with the examination system of children?
</td>
                                       <td>
                                           <input id="review3e1" name="review3" type="radio" class=""checked <?php if ($review3 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review3', 0); ?> />
                                          <label for="review3e1" class="">Very satisfied</label>

                                         <input id="review3e2" name="review3" type="radio" class="" <?php if ($review3 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review3', 1); ?> />
                                          <label for="review3e2" class="">Satisfied</label>

                                         <input id="review3e3" name="review3" type="radio" class="" <?php if ($review3 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review3', 2); ?> />
                                         <label for="review3e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>e.Are children satisfied with the role of practicals teachers?
</td>
                                       <td>
                                           <input id="review4e1" name="review4" type="radio" class=""checked <?php if ($review4 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review4', 0); ?> />
                                          <label for="review4e1" class="">Very satisfied</label>

                                         <input id="review4e2" name="review4" type="radio" class="" <?php if ($review4 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review4', 1); ?> />
                                          <label for="review4e2" class="">Satisfied</label>

                                         <input id="review4e3" name="review4" type="radio" class="" <?php if ($review4 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review4', 2); ?> />
                                         <label for="review4e3" class="">Neutral</label>
                                       </td>
                                   </tr>

                                    <tr>
                                    <td></td>
                                       <td>f.Are you satisfied with the study facility of the college ?</td>
                                       <td>
                                           <input id="review5e1" name="review5" type="radio" class=""checked <?php if ($review5 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review5', 0); ?> />
                                          <label for="review5e1" class="">Very satisfied</label>

                                         <input id="review5e2" name="review5" type="radio" class="" <?php if ($review5 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review5', 1); ?> />
                                          <label for="review5e2" class="">Satisfied</label>

                                         <input id="review5e3" name="review5" type="radio" class="" <?php if ($review5 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review5', 2); ?> />
                                         <label for="review5e3" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>1. <u>The library
</u><br>
                                        *Books
                                       </td>
                                       <td>
                                           <input id="review6e1" name="review6" type="radio" class=""checked <?php if ($review6 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review6', 0); ?> />
                                          <label for="review6e1" class="">Very satisfied</label>

                                         <input id="review6e2" name="review6" type="radio" class="" <?php if ($review6 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review6', 1); ?> />
                                          <label for="review6e2" class="">Satisfied</label>

                                         <input id="review6e3" name="review6" type="radio" class="" <?php if ($review6 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review6', 2); ?> />
                                         <label for="review6e3" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *Periodicals Publications 
                                       </td>
                                       <td>
                                           <input id="review7e1" name="review7" type="radio" class="" checked<?php if ($review7 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review7', 0); ?> />
                                          <label for="review7e1" class="">Very satisfied</label>

                                         <input id="review7e2" name="review7" type="radio" class="" <?php if ($review7 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review7', 1); ?> />
                                          <label for="review7e2" class="">Satisfied</label>

                                         <input id="review7e3" name="review7" type="radio" class="" <?php if ($review7 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review7', 2); ?> />
                                         <label for="review7e3" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                       *Library hours 
                                       </td>
                                       <td>
                                           <input id="review8e1" name="review8" type="radio" class="" checked<?php if ($review8 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review8', 0); ?> />
                                          <label for="review8e1" class="">Very satisfied</label>

                                         <input id="review8e2" name="review8" type="radio" class="" <?php if ($review8 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review8', 1); ?> />
                                          <label for="review8e2" class="">Satisfied</label>

                                         <input id="review8e3" name="review8" type="radio" class="" <?php if ($review8 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review8', 2); ?> />
                                         <label for="review8e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>2. <u>Laboratory</u><br>
                                        
                                       </td>
                                       <td>
                                           <input id="review9e1" name="review9" type="radio" class="" checked<?php if ($review9 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review9', 0); ?> />
                                          <label for="review9e1" class="">Very satisfied</label>

                                         <input id="review9e2" name="review9" type="radio" class="" <?php if ($review9 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review9', 1); ?> />
                                          <label for="review9e2" class="">Satisfied</label>

                                         <input id="review9e3" name="review9" type="radio" class="" <?php if ($review9 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review9', 2); ?> />
                                         <label for="review9e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                    <tr>
                                    <td><center>2.</center></td>
                                       <td>A mechanism for improving the quality of learning
<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review10e1" name="review10" type="radio" class=""checked <?php if ($review10 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review10', 0); ?> />
                                          <label for="review10e1" class="">Very satisfied</label>

                                         <input id="review10e2" name="review10" type="radio" class="" <?php if ($review10 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review10', 1); ?> />
                                          <label for="review10e2" class="">Satisfied</label>

                                         <input id="review10e3" name="review10" type="radio" class="" <?php if ($review10 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review10', 2); ?> />
                                         <label for="review10e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Evening study schedule <br>
                                        
                                       </td>
                                       <td>
                                           <input id="review11e1" name="review11" type="radio" class="" checked<?php if ($review11 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review11', 0); ?> />
                                          <label for="review11e1" class="">Very satisfied</label>

                                         <input id="review11e2" name="review11" type="radio" class="" <?php if ($review11 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review11', 1); ?> />
                                          <label for="review11e2" class="">Satisfied</label>

                                         <input id="review11e3" name="review11" type="radio" class="" <?php if ($review11 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review11', 2); ?> />
                                         <label for="review11e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Directed by Teacher Guardian<br>
                                        
                                       </td>
                                       <td>
                                           <input id="c" name="review29e1" type="radio" class="" checked<?php if ($review29 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review29', 0); ?> />
                                          <label for="review29e1" class="">Very satisfied</label>

                                         <input id="review29e2" name="review29" type="radio" class="" <?php if ($review29 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review29', 1); ?> />
                                          <label for="review29e2" class="">Satisfied</label>

                                         <input id="review29e3" name="review29" type="radio" class="" <?php if ($review29 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review29', 2); ?> />
                                         <label for="review29e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Counseling <br>
                                        
                                       </td>
                                       <td>
                                           <input id="review12e1" name="review12" type="radio" class="" checked<?php if ($review12 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review12', 0); ?> />
                                          <label for="review12e1" class="">Very satisfied</label>

                                         <input id="review12e2" name="review12" type="radio" class="" <?php if ($review12 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review12', 1); ?> />
                                          <label for="review12e2" class="">Satisfied</label>

                                         <input id="review12e3" name="review12" type="radio" class="" <?php if ($review12 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review12', 2); ?> />
                                         <label for="review12e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center></center></td>
                                       <td>On demand classes from medical college<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review13e1" name="review13" type="radio" class="" checked<?php if ($review13 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review13', 0); ?> />
                                          <label for="review13e1" class="">Very satisfied</label>

                                         <input id="review13e2" name="review13" type="radio" class="" <?php if ($review13 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review13', 1); ?> />
                                          <label for="review13e2" class="">Satisfied</label>

                                         <input id="review13e3" name="review13" type="radio" class="" <?php if ($review13 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review13', 2); ?> />
                                         <label for="review13e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Participation of children in health awareness programs<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review14e1" name="review14" type="radio" class=""checked <?php if ($review14 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review14', 0); ?> />
                                          <label for="review14e1" class="">Very satisfied</label>

                                         <input id="review14e2" name="review14" type="radio" class="" <?php if ($review14 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review14', 1); ?> />
                                          <label for="review14e2" class="">Satisfied</label>

                                         <input id="review14e3" name="review14" type="radio" class="" <?php if ($review14 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review14', 2); ?> />
                                         <label for="review14e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Are you satisfied with providing the information you need to improve your child's academic performance ?<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review15e1" name="review15" type="radio" class="" checked<?php if ($review15 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review15', 0); ?> />
                                          <label for="review15e1" class="">Very satisfied</label>

                                         <input id="review15e2" name="review15" type="radio" class="" <?php if ($review15 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review15', 1); ?> />
                                          <label for="review15e2" class="">Satisfied</label>

                                         <input id="review15e3" name="review15" type="radio" class="" <?php if ($review15 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review15', 2); ?> />
                                         <label for="review15e3" class="">Neutral</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td><center>3.</center></td>
                                       <td><u>Hostel</u><br>
                                        *.Hostel facilities 
                                       </td>
                                       <td>
                                           <input id="review16e1" name="review16" type="radio" class="" checked<?php if ($review16 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review16', 0); ?> />
                                          <label for="review16e1" class="">Very satisfied</label>

                                         <input id="review16e2" name="review16" type="radio" class="" <?php if ($review16 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review16', 1); ?> />
                                          <label for="review16e2" class="">Satisfied</label>

                                         <input id="review16e3" name="review16" type="radio" class="" <?php if ($review16 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review16', 2); ?> />
                                         <label for="review16e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Food quality<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review17e1" name="review17" type="radio" class=""checked <?php if ($review17 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review17', 0); ?> />
                                          <label for="review17e1" class="">Very satisfied</label>

                                         <input id="review17e2" name="review17" type="radio" class="" <?php if ($review17 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review17', 1); ?> />
                                          <label for="review17e2" class="">Satisfied</label>

                                         <input id="review17e3" name="review17" type="radio" class="" <?php if ($review17 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review17', 2); ?> />
                                         <label for="review17e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Diet<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review18e1" name="review18" type="radio" class=""checked <?php if ($review18 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review18', 0); ?> />
                                          <label for="review18e1" class="">Very satisfied</label>

                                         <input id="review18e2" name="review18" type="radio" class="" <?php if ($review18 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review18', 1); ?> />
                                          <label for="review18e2" class="">Satisfied</label>

                                         <input id="review18e3" name="review18" type="radio" class="" <?php if ($review18 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review18', 2); ?> />
                                         <label for="review18e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Drinking water
<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review19e1" name="review19" type="radio" class="" checked<?php if ($review19 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review19', 0); ?> />
                                          <label for="review19e1" class="">Very satisfied</label>

                                         <input id="review19e2" name="review19" type="radio" class="" <?php if ($review19 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review19', 1); ?> />
                                          <label for="review19e2" class="">Satisfied</label>

                                         <input id="review19e3" name="review19" type="radio" class="" <?php if ($review19 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review19', 2); ?> />
                                         <label for="review19e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Phone<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review20e1" name="review20" type="radio" class="" checked<?php if ($review20 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review20', 0); ?> />
                                          <label for="review20e1" class="">Very satisfied</label>

                                         <input id="review20e2" name="review20" type="radio" class="" <?php if ($review20 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review20', 1); ?> />
                                          <label for="review20e2" class="">Satisfied</label>

                                         <input id="review20e3" name="review20" type="radio" class="" <?php if ($review20 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review20', 2); ?> />
                                         <label for="review20e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Hostel Timings<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review21e1" name="review21" type="radio" class=""checked <?php if ($review21 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review21', 0); ?> />
                                          <label for="review21e1" class="">Very satisfied</label>

                                         <input id="review21e2" name="review21" type="radio" class="" <?php if ($review21 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review21', 1); ?> />
                                          <label for="review21e2" class="">Satisfied</label>

                                         <input id="review21e3" name="review21" type="radio" class="" <?php if ($review21 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review21', 2); ?> />
                                         <label for="review21e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>Sports competitions
                                        
                                       </td>
                                       <td>
                                           <input id="review22e1" name="review22" type="radio" class=""checked <?php if ($review22 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review22', 0); ?> />
                                          <label for="review22e1" class="">Very satisfied</label>

                                         <input id="review22e2" name="review22" type="radio" class="" <?php if ($review22 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review22', 1); ?> />
                                          <label for="review22e2" class="">Satisfied</label>

                                         <input id="review22e3" name="review22" type="radio" class="" <?php if ($review22 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review22', 2); ?> />
                                         <label for="review22e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* National Service Scheme Programmes
                                        
                                       </td>
                                       <td>
                                           <input id="review23e1" name="review23" type="radio" class="" checked<?php if ($review23 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review23', 0); ?> />
                                          <label for="review23e1" class="">Very satisfied</label>

                                         <input id="review23e2" name="review23" type="radio" class="" <?php if ($review23 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review23', 1); ?> />
                                          <label for="review23e2" class="">Satisfied</label>

                                         <input id="review23e3" name="review23" type="radio" class="" <?php if ($review23 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review23', 2); ?> />
                                         <label for="review23e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Union Activities 
                                        
                                       </td>
                                       <td>
                                           <input id="review24e1" name="review24" type="radio" class=""checked <?php if ($review24 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review24', 0); ?> />
                                          <label for="review24e1" class="">Very satisfied</label>

                                         <input id="review24e2" name="review24" type="radio" class="" <?php if ($review24 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review24', 1); ?> />
                                          <label for="review24e2" class="">Satisfied</label>

                                         <input id="review24e3" name="review24" type="radio" class="" <?php if ($review24 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review24', 2); ?> />
                                         <label for="review24e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* Spiritual growth classes
 
                                        
                                       </td>
                                       <td>
                                           <input id="review25e1" name="review25" type="radio" class=""checked <?php if ($review25 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review25', 0); ?> />
                                          <label for="review25e1" class="">Very satisfied</label>

                                         <input id="review25e2" name="review25" type="radio" class="" <?php if ($review25 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review25', 1); ?> />
                                          <label for="review25e2" class="">Satisfied</label>

                                         <input id="review25e3" name="review25" type="radio" class="" <?php if ($review25 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review25', 2); ?> />
                                         <label for="review25e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center>5.</center></td>
                                       <td><u>Parent meeting and assessment </u><br>
                                        a. Are you satisfied with the communication from the college when organizing parent meeting?

                                        
                                       </td>
                                       <td>
                                           <input id="review26e1" name="review26" type="radio" class="" checked<?php if ($review26 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review26', 0); ?> />
                                          <label for="review26e1" class="">Very satisfied</label>

                                         <input id="review26e2" name="review26" type="radio" class="" <?php if ($review26 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review26', 1); ?> />
                                          <label for="review26e2" class="">Satisfied</label>

                                         <input id="review26e3" name="review26" type="radio" class="" <?php if ($review26 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review26', 2); ?> />
                                         <label for="review26e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>b. Are you satisfied with the way you are treated when you raise your needs?
 

                                        
                                       </td>
                                       <td>
                                           <input id="review27e1" name="review27" type="radio" class=""checked <?php if ($review27 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review27', 0); ?> />
                                          <label for="review27e1" class="">Very satisfied</label>

                                         <input id="review27e2" name="review27" type="radio" class="" <?php if ($review27 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review27', 1); ?> />
                                          <label for="review27e2" class="">Satisfied</label>

                                         <input id="review27e3" name="review27" type="radio" class="" <?php if ($review27 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review27', 2); ?> />
                                         <label for="review27e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>c.Have your needs addressed
                                        
                                       </td>
                                       <td>
                                           <input id="review28e1" name="review28" type="radio" class=""checked <?php if ($review28 == '0')
                                               echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review28', 0); ?> />
                                          <label for="review28e1" class="">Very satisfied</label>

                                         <input id="review28e2" name="review28" type="radio" class="" <?php if ($review28 == '1')
                                             echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review28', 1); ?> />
                                          <label for="review28e2" class="">Satisfied</label>

                                         <input id="review28e3" name="review28" type="radio" class="" <?php if ($review28 == '2')
                                             echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review28', 2); ?> />
                                         <label for="review28e3" class="">Neutral</label>
                                       </td>
                                   </tr>
                                   <tr>
                                   
                            </table>
                            <br><br>

                            <table>
                                <tr>
                                1. Are there any other specific issues you would like to bring to the attention of the college authorities? Explain
.
                                    <div class="mb-5">
                                     
                                    
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="problem" style="width:400px" name="problem" placeholder="" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('problem'); ?></span>
                                    </div>
       
                                </div>
                                </tr>


                                <tr>
                                    2.The quality of the college is determined by the main emphasis
 ?
                                    <div class="mb-5">
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="problemnew" style="width:400px" name="problemnew" placeholder="" class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('problemnew'); ?></span>
                                    </div>
                                </div>
                                </tr>
                                <tr>
                                    3.Your general opinion about the college
?
                                    <div class="mb-5">
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"></label>
                                        <textarea id="college" style="width:400px" name="college" placeholder="" class="form-control"></textarea>
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
                                        <label for="exampleInputEmail1"><?php echo "Guardian's Name:"; ?></label>
                                        <input autofocus="" id="ptname" style="width:400px" name="ptname" placeholder="" type="text" class="form-control" value="<?php echo $parent_details->guardian_name; ?>" />
                                        <span class="text-danger"><?php echo form_error('ptname'); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'Date :'; ?></label>
                                        <input autofocus="" id="date" style="width:400px" name="date" placeholder="" type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" />

                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>

                                </div>
                            </tr><center>
                            <div class="box-footer">
                            <button type="submit" name="submit" value="submit" class="btn btn-success" style="width: 300px"></i> <?php echo $this->lang->line('submit'); ?></button>
                        </div>
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



<script>
$(document).ready(function() {
     
    $("#englishbtn").click(function() {
        document.getElementById("english").style.display = "block";
        document.getElementById("malayalam").style.display = "none";
        document.getElementById("englishbtn").style.display = "none";
        document.getElementById("malayalambtn").style.display = "block";
        });

        $("#malayalambtn").click(function() {
        document.getElementById("english").style.display = "none";
        document.getElementById("malayalam").style.display = "block";
        document.getElementById("englishbtn").style.display = "block";
        document.getElementById("malayalambtn").style.display = "none";
        });

    });
    
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>