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
                               <center class="font-color"> <h3><b><u>Pushpagiri Dental College ,Thiruvalla, Parents Feedback Form</h3></u> </b> </center>
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
                                        <input autofocus="" id="pname" style="width:400px" name="pname" placeholder="" type="text" class="form-control" value="<?php echo set_value('pname'); ?>" />
                                        <span class="text-danger"><?php echo form_error('pname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'മേൽവിലാസം:'; ?></label>
                                        <input autofocus="" id="address" style="width:400px" name="address" placeholder="" type="text"  class="form-control" value="<?php echo set_value('address'); ?>" />
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                    </div><br>
                                </div>
                                  </tr>
                               <tr>
                                <div class="mb-5">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'വിദ്യാർഥി/വിദ്യാർഥിനിയുടെ പേര്:'; ?></label>
                                        <input autofocus="" id="sname" style="width:400px" name="sname" placeholder="" type="text" class="form-control" value="<?php echo set_value('sname'); ?>" />
                                        <span class="text-danger"><?php echo form_error('sname'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'വർഷം:'; ?></label>
                                        <input autofocus="" id="year" style="width:400px" name="year" placeholder="" type="text" class="form-control"  value="<?php echo set_value('year'); ?>" />
                                        <span class="text-danger"><?php echo form_error('year'); ?></span>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="exampleInputEmail1"><?php echo 'ഫോൺ നമ്പർ:'; ?></label>
                                        <input autofocus="" id="phone" style="width:400px" name="phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('phone'); ?>" />
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
                                        <input id="review" name="review" type="radio" class="" <?php if($review=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review', 0); ?> />
                                          <label for="review" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review" name="review" type="radio" class="" <?php if($review=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review', 1); ?> />
                                          <label for="review" class="">സംതൃപ്തം</label>

                                         <input id="review" name="review" type="radio" class="" <?php if($review=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review', 2); ?> />
                                         <label for="review" class="">നിഷ്പക്ഷം</label>
                                    </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>b.കുട്ടികൾക്ക് കിട്ടുന്ന പ്രായോഗിക പരിശീലനത്തിൽ തൃപ്തരാണോ? </td>
                                       <td>
                                           <input id="review1" name="review1" type="radio" class="" <?php if($review1=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review1', 0); ?> />
                                          <label for="review1" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review1" name="review1" type="radio" class="" <?php if($review1=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review1', 1); ?> />
                                          <label for="review1" class="">സംതൃപ്തം</label>

                                         <input id="review1" name="review1" type="radio" class="" <?php if($review1=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review1', 2); ?> />
                                         <label for="review1" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>c.കുട്ടികളോടുള്ള അധ്യാപകരുടെ സമീപനരീതി? </td>
                                       <td>
                                           <input id="review2" name="review2" type="radio" class="" <?php if($review2=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review2', 0); ?> />
                                          <label for="review2" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review2" name="review2" type="radio" class="" <?php if($review2=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review2', 1); ?> />
                                          <label for="review2" class="">സംതൃപ്തം</label>

                                         <input id="review2" name="review2" type="radio" class="" <?php if($review2=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review2', 2); ?> />
                                         <label for="review2" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>d.കുട്ടികളുടെ പരീക്ഷാസംവിധാനത്തിൽ തൃപ്തരാണോ?</td>
                                       <td>
                                           <input id="review3" name="review3" type="radio" class="" <?php if($review3=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review3', 0); ?> />
                                          <label for="review3" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review3" name="review3" type="radio" class="" <?php if($review3=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review3', 1); ?> />
                                          <label for="review3" class="">സംതൃപ്തം</label>

                                         <input id="review3" name="review3" type="radio" class="" <?php if($review3=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review3', 2); ?> />
                                         <label for="review3" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>e.കുട്ടികളുടെ പ്രായോഗിക പരിശീലനം അഥവാ പ്രാക്ടിക്കൽസ് അധ്യാപകരുടെ പങ്കിൽ തൃപ്തരാണോ ?</td>
                                       <td>
                                           <input id="review4" name="review4" type="radio" class="" <?php if($review4=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review4', 0); ?> />
                                          <label for="review4" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review4" name="review4" type="radio" class="" <?php if($review4=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review4', 1); ?> />
                                          <label for="review4" class="">സംതൃപ്തം</label>

                                         <input id="review4" name="review4" type="radio" class="" <?php if($review4=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review4', 2); ?> />
                                         <label for="review4" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                    <tr>
                                    <td></td>
                                       <td>f.കോളേജിൻറെ പഠന സൗകര്യത്തിൽ തൃപ്തരാണോ ?</td>
                                       <td>
                                           <input id="review5" name="review5" type="radio" class="" <?php if($review5=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review5', 0); ?> />
                                          <label for="review5" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review5" name="review5" type="radio" class="" <?php if($review5=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review5', 1); ?> />
                                          <label for="review5" class="">സംതൃപ്തം</label>

                                         <input id="review5" name="review5" type="radio" class="" <?php if($review5=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review5', 2); ?> />
                                         <label for="review5" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>1. <u>ലൈബ്രറി</u><br>
                                        *പുസ്തകങ്ങൾ
                                       </td>
                                       <td>
                                           <input id="review6" name="review6" type="radio" class="" <?php if($review6=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review6', 0); ?> />
                                          <label for="review6" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review6" name="review6" type="radio" class="" <?php if($review6=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review6', 1); ?> />
                                          <label for="review6" class="">സംതൃപ്തം</label>

                                         <input id="review6" name="review6" type="radio" class="" <?php if($review6=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review6', 2); ?> />
                                         <label for="review6" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *ആനുകാലിക പ്രസിദ്ധീകരണങ്ങൾ 
                                       </td>
                                       <td>
                                           <input id="review7" name="review7" type="radio" class="" <?php if($review7=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review7', 0); ?> />
                                          <label for="review7" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review7" name="review7" type="radio" class="" <?php if($review7=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review7', 1); ?> />
                                          <label for="review7" class="">സംതൃപ്തം</label>

                                         <input id="review7" name="review7" type="radio" class="" <?php if($review7=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review7', 2); ?> />
                                         <label for="review7" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td></td>
                                       <td>
                                        *ലൈബ്രറി സമയം 
                                       </td>
                                       <td>
                                           <input id="review8" name="review8" type="radio" class="" <?php if($review8=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review8', 0); ?> />
                                          <label for="review8" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review8" name="review8" type="radio" class="" <?php if($review8=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review8', 1); ?> />
                                          <label for="review8" class="">സംതൃപ്തം</label>

                                         <input id="review8" name="review8" type="radio" class="" <?php if($review8=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review8', 2); ?> />
                                         <label for="review8" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>2. <u>ലബോറട്ടറി</u><br>
                                        
                                       </td>
                                       <td>
                                           <input id="review9" name="review9" type="radio" class="" <?php if($review9=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review9', 0); ?> />
                                          <label for="review9" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review9" name="review9" type="radio" class="" <?php if($review9=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review9', 1); ?> />
                                          <label for="review9" class="">സംതൃപ്തം</label>

                                         <input id="review9" name="review9" type="radio" class="" <?php if($review9=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review9', 2); ?> />
                                         <label for="review9" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                    <tr>
                                    <td><center>2.</center></td>
                                       <td>പഠന നിലവാരം ഉയർത്താനുള്ള സംവിധാനം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review10" name="review10" type="radio" class="" <?php if($review10=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review10', 0); ?> />
                                          <label for="review10" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review10" name="review10" type="radio" class="" <?php if($review10=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review10', 1); ?> />
                                          <label for="review10" class="">സംതൃപ്തം</label>

                                         <input id="review10" name="review10" type="radio" class="" <?php if($review10=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review10', 2); ?> />
                                         <label for="review10" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>വൈകുന്നേരം ഉള്ള പഠനക്രമം <br>
                                        
                                       </td>
                                       <td>
                                           <input id="review11" name="review11" type="radio" class="" <?php if($review11=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review11', 0); ?> />
                                          <label for="review11" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review11" name="review11" type="radio" class="" <?php if($review11=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review11', 1); ?> />
                                          <label for="review11" class="">സംതൃപ്തം</label>

                                         <input id="review11" name="review11" type="radio" class="" <?php if($review11=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review11', 2); ?> />
                                         <label for="review11" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>ടീച്ചർ ഗാർഡിയൻ സംവിധാനം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="c" name="review29" type="radio" class="" <?php if($review29=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review29', 0); ?> />
                                          <label for="review29" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review29" name="review29" type="radio" class="" <?php if($review29=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review29', 1); ?> />
                                          <label for="review29" class="">സംതൃപ്തം</label>

                                         <input id="review29" name="review29" type="radio" class="" <?php if($review29=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review29', 2); ?> />
                                         <label for="review29" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>കൗൺസിലിംഗ് <br>
                                        
                                       </td>
                                       <td>
                                           <input id="review12" name="review12" type="radio" class="" <?php if($review12=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review12', 0); ?> />
                                          <label for="review12" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review12" name="review12" type="radio" class="" <?php if($review12=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review12', 1); ?> />
                                          <label for="review12" class="">സംതൃപ്തം</label>

                                         <input id="review12" name="review12" type="radio" class="" <?php if($review12=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review12', 2); ?> />
                                         <label for="review12" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center></center></td>
                                       <td>മെഡിക്കൽ കോളേജിൽ നിന്നും ആവശ്യാനുസരണമുള്ള ക്ലാസുകൾ<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review13" name="review13" type="radio" class="" <?php if($review13=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review13', 0); ?> />
                                          <label for="review13" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review13" name="review13" type="radio" class="" <?php if($review13=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review13', 1); ?> />
                                          <label for="review13" class="">സംതൃപ്തം</label>

                                         <input id="review13" name="review13" type="radio" class="" <?php if($review13=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review13', 2); ?> />
                                         <label for="review13" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>ആരോഗ്യ ബോധവൽക്കരണ പരിപാടികളിൽ കുട്ടികളുടെ പങ്കാളിത്തം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review14" name="review14" type="radio" class="" <?php if($review14=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review14', 0); ?> />
                                          <label for="review14" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review14" name="review14" type="radio" class="" <?php if($review14=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review14', 1); ?> />
                                          <label for="review14" class="">സംതൃപ്തം</label>

                                         <input id="review14" name="review14" type="radio" class="" <?php if($review14=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review14', 2); ?> />
                                         <label for="review14" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>നിങ്ങളുടെ കുട്ടിയുടെ പഠന നിലവാരം ഉയർത്തുന്നതിന് ആവശ്യമായ വിവരങ്ങൾ നൽകുന്നതിൽ സംതൃപ്തരാണോ ?<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review15" name="review15" type="radio" class="" <?php if($review15=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review15', 0); ?> />
                                          <label for="review15" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review15" name="review15" type="radio" class="" <?php if($review15=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review15', 1); ?> />
                                          <label for="review15" class="">സംതൃപ്തം</label>

                                         <input id="review15" name="review15" type="radio" class="" <?php if($review15=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review15', 2); ?> />
                                         <label for="review15" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>

                                   <tr>
                                    <td><center>3.</center></td>
                                       <td><u>ഹോസ്റ്റൽ</u><br>
                                        *.ഹോസ്റ്റൽ സൗകര്യങ്ങൾ 
                                       </td>
                                       <td>
                                           <input id="review16" name="review16" type="radio" class="" <?php if($review16=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review16', 0); ?> />
                                          <label for="review16" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review16" name="review16" type="radio" class="" <?php if($review16=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review16', 1); ?> />
                                          <label for="review16" class="">സംതൃപ്തം</label>

                                         <input id="review16" name="review16" type="radio" class="" <?php if($review16=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review16', 2); ?> />
                                         <label for="review16" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഭക്ഷണ നിലവാരം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review17" name="review17" type="radio" class="" <?php if($review17=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review17', 0); ?> />
                                          <label for="review17" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review17" name="review17" type="radio" class="" <?php if($review17=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review17', 1); ?> />
                                          <label for="review17" class="">സംതൃപ്തം</label>

                                         <input id="review17" name="review17" type="radio" class="" <?php if($review17=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review17', 2); ?> />
                                         <label for="review17" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഭക്ഷണക്രമീകരണം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review18" name="review18" type="radio" class="" <?php if($review18=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review18', 0); ?> />
                                          <label for="review18" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review18" name="review18" type="radio" class="" <?php if($review18=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review18', 1); ?> />
                                          <label for="review18" class="">സംതൃപ്തം</label>

                                         <input id="review18" name="review18" type="radio" class="" <?php if($review18=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review18', 2); ?> />
                                         <label for="review18" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* കുടിവെള്ളം<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review19" name="review19" type="radio" class="" <?php if($review19=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review19', 0); ?> />
                                          <label for="review19" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review19" name="review19" type="radio" class="" <?php if($review19=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review19', 1); ?> />
                                          <label for="review19" class="">സംതൃപ്തം</label>

                                         <input id="review19" name="review19" type="radio" class="" <?php if($review19=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review19', 2); ?> />
                                         <label for="review19" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഫോൺ<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review20" name="review20" type="radio" class="" <?php if($review20=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review20', 0); ?> />
                                          <label for="review20" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review20" name="review20" type="radio" class="" <?php if($review20=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review20', 1); ?> />
                                          <label for="review20" class="">സംതൃപ്തം</label>

                                         <input id="review20" name="review20" type="radio" class="" <?php if($review20=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review20', 2); ?> />
                                         <label for="review20" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* ഹോസ്റ്റൽ സമയക്രമങ്ങൾ<br>
                                        
                                       </td>
                                       <td>
                                           <input id="review21" name="review21" type="radio" class="" <?php if($review21=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review21', 0); ?> />
                                          <label for="review21" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review21" name="review21" type="radio" class="" <?php if($review21=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review21', 1); ?> />
                                          <label for="review21" class="">സംതൃപ്തം</label>

                                         <input id="review21" name="review21" type="radio" class="" <?php if($review21=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review21', 2); ?> />
                                         <label for="review21" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>കായികമത്സരങ്ങൾ
                                        
                                       </td>
                                       <td>
                                           <input id="review22" name="review22" type="radio" class="" <?php if($review22=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review22', 0); ?> />
                                          <label for="review22" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review22" name="review22" type="radio" class="" <?php if($review22=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review22', 1); ?> />
                                          <label for="review22" class="">സംതൃപ്തം</label>

                                         <input id="review22" name="review22" type="radio" class="" <?php if($review22=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review22', 2); ?> />
                                         <label for="review22" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* നാഷണൽ സർവീസ് സ്കീം പരിപാടികൾ
                                        
                                       </td>
                                       <td>
                                           <input id="review23" name="review23" type="radio" class="" <?php if($review23=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review23', 0); ?> />
                                          <label for="review23" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review23" name="review23" type="radio" class="" <?php if($review23=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review23', 1); ?> />
                                          <label for="review23" class="">സംതൃപ്തം</label>

                                         <input id="review23" name="review23" type="radio" class="" <?php if($review23=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review23', 2); ?> />
                                         <label for="review23" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* യൂണിയൻ പ്രവർത്തനങ്ങൾ 
                                        
                                       </td>
                                       <td>
                                           <input id="review24" name="review24" type="radio" class="" <?php if($review24=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review24', 0); ?> />
                                          <label for="review24" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review24" name="review24" type="radio" class="" <?php if($review24=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review24', 1); ?> />
                                          <label for="review24" class="">സംതൃപ്തം</label>

                                         <input id="review24" name="review24" type="radio" class="" <?php if($review24=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review24', 2); ?> />
                                         <label for="review24" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>* അധ്യാത്മിക വളർച്ച ക്ലാസുകൾ 
                                        
                                       </td>
                                       <td>
                                           <input id="review25" name="review25" type="radio" class="" <?php if($review25=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review25', 0); ?> />
                                          <label for="review25" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review25" name="review25" type="radio" class="" <?php if($review25=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review25', 1); ?> />
                                          <label for="review25" class="">സംതൃപ്തം</label>

                                         <input id="review25" name="review25" type="radio" class="" <?php if($review25=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review25', 2); ?> />
                                         <label for="review25" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td><center>5.</center></td>
                                       <td><u>രക്ഷകർതൃ യോഗവും വിലയിരുത്തലും </u><br>
                                        a. രക്ഷകർതൃ യോഗം സംഘടിപ്പിക്കുമ്പോൾ കോളേജിൽ നിന്നുമുള്ള ആശയവിനിമയത്തിൽ നിങ്ങൾ സംതൃപ്തരാണോ
                                        
                                       </td>
                                       <td>
                                           <input id="review26" name="review26" type="radio" class="" <?php if($review26=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review26', 0); ?> />
                                          <label for="review26" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review26" name="review26" type="radio" class="" <?php if($review26=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review26', 1); ?> />
                                          <label for="review26" class="">സംതൃപ്തം</label>

                                         <input id="review26" name="review26" type="radio" class="" <?php if($review26=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review26', 2); ?> />
                                         <label for="review26" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>b. നിങ്ങളുടെ ആവശ്യങ്ങൾ ഉന്നയിക്കുമ്പോൾ നിങ്ങളോടുള്ള സമീപനത്തിൽ സംതൃപ്തരാണോ 

                                        
                                       </td>
                                       <td>
                                           <input id="review27" name="review27" type="radio" class="" <?php if($review27=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review27', 0); ?> />
                                          <label for="review27" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review27" name="review27" type="radio" class="" <?php if($review27=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review27', 1); ?> />
                                          <label for="review27" class="">സംതൃപ്തം</label>

                                         <input id="review27" name="review27" type="radio" class="" <?php if($review27=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review27', 2); ?> />
                                         <label for="review27" class="">നിഷ്പക്ഷം</label>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td></td>
                                       <td>c.നിങ്ങളുടെ ആവശ്യങ്ങൾ പരിഹരിക്കപ്പെടാൻ ഉണ്ടോ
                                        
                                       </td>
                                       <td>
                                           <input id="review28" name="review28" type="radio" class="" <?php if($review28=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('review28', 0); ?> />
                                          <label for="review28" class="">വളരെ സംതൃപ്തം</label>

                                         <input id="review28" name="review28" type="radio" class="" <?php if($review28=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('review28', 1); ?> />
                                          <label for="review28" class="">സംതൃപ്തം</label>

                                         <input id="review28" name="review28" type="radio" class="" <?php if($review28=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('review28', 2); ?> />
                                         <label for="review28" class="">നിഷ്പക്ഷം</label>
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
                                        <input autofocus="" id="ptname" style="width:400px" name="ptname" placeholder="" type="text" class="form-control" value="<?php echo set_value('ptname'); ?>" />
                                        <span class="text-danger"><?php echo form_error('ptname'); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1"><?php echo 'തീയതി :'; ?></label>
                                        <input autofocus="" id="date" style="width:400px" name="date" placeholder="" type="date" class="form-control" value="<?php echo set_value('date'); ?>" />
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