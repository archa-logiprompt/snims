<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>Smart School : School Management System</title>
        <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
        <style type="text/css">
            .width100, .width50{font-size: 12px !important;}  
            .discover{margin-top: -90px;position: relative;z-index: -1;}
            /*.form-bottom {box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.35);}*/
            .gradient{margin-top: 40px;text-align: right;padding: 10px;background: rgb(72,72,72);
                      background: -moz-linear-gradient(left, rgba(72,72,72,1) 1%, rgba(73,73,73,1) 44%, rgba(73,73,73,1) 100%);
                      background-image: linear-gradient(to right, rgba(72, 72, 72, 0.23) 1%, rgba(37, 37, 37, 0.64) 44%, rgba(73, 73, 73, 0) 100%);
                      background-position-x: initial;
                      background-position-y: initial;
                      background-size: initial;
                      background-repeat-x: initial;
                      background-repeat-y: initial;
                      background-attachment: initial;
                      background-origin: initial;
                      background-clip: initial;
                      background-color: initial;
                      background: -webkit-linear-gradient(left, rgba(72,72,72,1) 1%,rgb(73, 73, 73) 44%,rgba(73,73,73,1) 100%);
                      background: linear-gradient(to right, rgba(72, 72, 72, 0.02) 1%,rgba(37, 37, 37, 0.67) 30%,rgba(73, 73, 73, 0) 100%);
                      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#484848', endColorstr='#494949',GradientType=1 );}        
            @media (min-width: 320px) and (max-width: 991px){
                .width100{width: 100% !important;display: block !important;
                          float: left !important; margin-bottom: 5px !important;
                          border-radius: 2px !important;}
                .width50{width: 50% !important;
                         margin-bottom: 5px !important;
                         display: block !important;
                         border-radius:2px 0px 0px 2px !important;
                         float: left !important;
                         margin-left: 0px !important; }
                .widthright50{width: 50% !important;
                              display: block !important;
                              margin-bottom: 5px !important;
                              border-radius: 0px 2px 2px 0px !important;
                              float: left !important;margin-left: 0px !important;} }
            input[type="text"], input[type="password"], textarea, textarea.form-control {
                height: 40px;border: 1px solid #999;}

            input[type="text"]:focus, input[type="password"]:focus, textarea:focus, textarea.form-control:focus {border: 1px solid #424242;}

            button.btn {height: 40px;line-height: 40px;}
                  
            @media(max-width:767px){
                .discover{margin-top: 10px}
                .gradient {text-align: center;}
                .logowidth{padding-right:0px;}     
            }  
            @media(min-width:768px) and (max-width:992px){
                .discover{margin-top: 10px}
                .logowidth{padding-right:0px;} 
                .gradient {text-align: center;}  
            }

/*.backstretch{position: relative;}
.backstretch:after {
    position: absolute;
    z-index: 2;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background-color: rgba(0, 0, 0, 0.16);
}*/
 .col-md-offset-3 { margin-left: 29%;}

 .loginbg {
    background: rgba(0, 0, 0, 0.81);
    max-height: 390px;
    box-shadow: 0px 7px 12px rgba(0, 0, 0, 0.29);
    border-radius: 4px;
}
.loginright {
    text-align: left;
    color: #fff;
    max-height: 385px;
    /* padding-right: 20px; */
    overflow: auto;
    position: relative;
    width: 100%;
    max-width: 100%;
    height: 385px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.logdivider {
    background: rgba(255, 253, 253, 0.7);
    clear: both;
    width: 100%;
    height: 1px;
    margin: 15px 0 15px;
}

.separatline {
    margin-left: 30px;
    width: 1px;
    height: 450px;
    background: rgba(255, 253, 253, 0.7);
}
.loginright h3 {
    font-size: 22px;
    color: #eae8e8;
    margin-top: 10px;
    line-height: normal;
    font-weight: 500;
    padding-bottom: 10px;
}
.col-md-offset-3 { margin-left: 29%;}
@media (max-width: 767px) {
.separatline {
    margin-left: 0;
    width: 100%;
    height: 2px;
    margin: 35px auto 0px auto;
}
.col-md-offset-3 {margin-left: 0;}
}
 .footer-bottom{
            margin-top: 15rem;
            /*background-color: #de995e1a;*/
            color: white;
            display: flex;
            flex-wrap: wrap;
            padding: 1rem;
            justify-content: center;
            gap: 30px;
            border-radius: 10px;
       }
        .footer-bottom a{
            color: white;
            font-size: 12px;
        }
         .footer-bottom a:hover{
            color: #de995e;
            
        }
        .modal-dialog{
            width:  80vw;
        }
        .modal-body{
            font-size: 14px;
    line-height: 1.8;
    text-align: justify;
    padding: 2rem 5rem;
        }
        </style>
    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                          <?php 
                        $empty_notice=0;
                        $offset="";
if(empty($notice)){
    $empty_notice=1;
    $offset="col-md-offset-3";

}
                         ?>
                        <div class="col-lg-5 col-sm-5 <?php echo $offset; ?> form-box">
                            <div class="loginbg">
                              <div class="form-top">
                                <div class="form-top-left">
                                    <img src="<?php echo base_url(); ?>backend/images/s_logo.png" class="logowidth">
                                    
                                </div>
                                <div class="form-top-right"> <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <h3 class="font-white"><?php echo $this->lang->line('user_login'); ?></h3>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php
                                if ($this->session->flashdata('message')) {
                                    echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
                                };
                                ?>
                                <form action="<?php echo site_url('site/userlogin') ?>" method="post">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">
                                            <?php echo $this->lang->line('username'); ?></label>
                                        <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" class="form-username form-control" id="email"> <span class="text-danger"><?php echo form_error('username'); ?></span>
                                    </div>
                                    <div class="form-group">                                        
                                        <input type="password" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="password"> <span class="text-danger"><?php echo form_error('password'); ?></span>
                                    </div>
                                    <button type="submit" class="btn">
                                        <?php echo $this->lang->line('sign_in'); ?></button>
                                </form>
                                
                                <p><a href="<?php echo site_url('site/ufpassword') ?>" class="forgot"> <i class="fa fa-key"></i> <?php echo $this->lang->line('forgot_password'); ?></a> </p> 
                            </div>
                          </div>  
                        </div>
                        <div class="col-lg-12">
                            <div class="footer-bottom">
                                <!-- Button trigger modal -->
                                <a type="button" class="btn btn-link" data-toggle="modal" data-target="#TermsandConditionsModal">
                                  Terms and Conditions
                                </a>
                                 <a type="button" class="btn btn-link" data-toggle="modal" data-target="#PrivacyPolicyModal">
                                  Privacy Policy
                                </a>
                                 <a type="button" class="btn btn-link" data-toggle="modal" data-target="#RefundPolicyModal">
                                  Refund Policy
                                </a>
                                 <a type="button" class="btn btn-link" data-toggle="modal" data-target="#CancelandReturnPolicyModal">
                                  Cancel and Return Policy
                                </a>
                               
                            </div>
                        </div>
                   <?php 
                  if(!$empty_notice){
?>
  <div class="col-lg-1 col-sm-1"><div class="separatline"></div></div> 
                      <div class="col-lg-6 col-sm-6 col-sm-6">
                        <div class="loginright form-box  mCustomScrollbar">
                        <div class="messages">    
                             <h3><?php echo $this->lang->line('what_is_new_in'); ?> <?php echo $school['name']; ?></h3>
<?php 
                                    foreach ($notice as $notice_key => $notice_value) {
                                        ?>
                            <h4><?php echo $notice_value['title']; ?></h4>
                           
                                        <?php
                                        $string = ($notice_value['description']);
                                        $string = strip_tags($string);
                                        if (strlen($string) > 100) {

                                            // truncate string
                                            $stringCut = substr($string, 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');

                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... <a class=more href="'.site_url('read/'.$notice_value['slug']).'">Read More</a>';
                                        }
                                        echo '<p>'.$string.'</p>';
                                        ?>
                        <div class="logdivider"></div>
                                        <?php

                                      }

 ?>

                           
                          
                          
                        </div>  
                    </div>
                        <!-- <img src="<?php echo base_url(); ?>backend/usertemplate/assets/img/backgrounds/bg3.jpg" class="img-responsive" style="border-radius:4px;" /> -->
                      </div><!--./col-lg-6-->
<?php
}
?>
                  
                        <!-- <div class="col-md-6 col-sm-12 discover">
                            <img src="<?php //echo base_url(); ?>backend/usertemplate/assets/img/backgrounds/discover.png">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="TermsandConditionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <p>The Terms and Conditions contained herein shall apply to any person (“User”) using the services of 
        Pushpagiri College of Dental Sciences for making online payments through an online payment gateway service (“Service”) through Pushpagiri College of Dental Sciences website i.e. https://pcds.pushpagiri.net/. Each User is therefore deemed to have read and accepted these Terms and Conditions.
        General Terms and Conditions for Online-Payments</p>
        <p>•   1. Once a User has accepted these Terms and Conditions, he/ she may register and avail the Services. A User may either register on Pushpagiri College of Dental Sciences website or by any other manner as may be specified by Pushpagiri College of Dental Sciences from time to time.</p>
        <p>•   2. Pushpagiri College of Dental Sciences  rights, obligations, undertakings shall be subject to the laws in force in India, as well as any directives/ procedures of Government of India, and nothing contained in these Terms and Conditions shall be in derogation of Pushpagiri College of Dental Sciences right to comply with any law enforcement agencies request or requirements relating to any User’s use of the website or information provided to or gathered by Pushpagiri College of Dental Sciences  with respect to such use. Each User accepts and agrees that the provision of details of his/ her use of the Website to regulators or police or to any other third party in order to resolve disputes or complaints which relate to the Website shall be at the absolute discretion of Pushpagiri College of Dental Sciences .</p>
        <p>•   3. If any part of these Terms and Conditions are determined to be invalid or unenforceable pursuant to applicable law including, but not limited to, the warranty disclaimers and liability limitations set forth herein, then the invalid or unenforceable provision will be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original provision and the remainder of these Terms and Conditions shall continue in effect.</p>
        <p>•   4. These Terms and Conditions constitute the entire agreement between the User and Pushpagiri College of Dental Sciences. These Terms and Conditions supersede all prior or contemporaneous communications and proposals, whether electronic, oral, or written, between the User and Pushpagiri College of Dental Sciences. A printed version of these Terms and Conditions and of any notice given in electronic form shall be admissible in judicial or administrative proceedings based upon or relating to these Terms and Conditions to the same extent and subject to the same conditions as other business documents and records originally generated and maintained in printed form.</p>
        <p>•   5. The entries in the books of Pushpagiri College of Dental Sciences and/or the Payment Service Providers kept in the ordinary course of business of Pushpagiri College of Dental Sciences  and/or the Payment Service Providers with regard to transactions covered under these Terms and Conditions and matters therein appearing shall be binding on the User and shall be conclusive proof of the genuineness and accuracy of the transaction.</p>
        <p>•   6. Refund for Charge Back Transaction: In the event there is any claim for/ of charge back by the User for any reason whatsoever, such User shall immediately approach Pushpagiri College of Dental Sciences  with his/ her claim details and claim refund from Pushpagiri College of Dental Sciences  alone. Such refund (if any) shall be affected only by Pushpagiri College of Dental Sciences  via payment gateway or by means of a demand draft or such other means as Pushpagiri College of Dental Sciences  deems appropriate. No claims for refund/ charge back shall be made by any User to the Payment Service Provider(s) and in the event such claim is made it shall not be entertained.</p>
        <p>•   7. In these Terms and Conditions, the term “Charge Back” shall mean, approved and settled credit card or net banking transaction(s) which are at any time refused, debited or charged back to merchant account (and shall also include similar debits to Payment Service Provider's accounts, if any) by the acquiring bank or credit card company for any reason whatsoever, together with the bank fees, penalties and other charges incidental thereto.</p>
        <p>•   8. Refund for fraudulent/duplicate transaction(s): The User shall directly contact Pushpagiri College of Dental Sciences  for any fraudulent transaction(s) on account of misuse of Card/ Bank details by a fraudulent individual/party and such issues shall be suitably addressed by Pushpagiri College of Dental Sciences  alone in line with their policies and rules.</p>
        <p>•   9. Server Slow Down/Session Timeout: In case the Website or Payment Service Provider’s webpage, that is linked to the Website, is experiencing any server related issues like ‘slow down’ or ‘failure’ or ‘session timeout’, the User shall, before initiating the second payment,, check whether his/her Bank Account has been debited or not and accordingly resort to one of the following options:
        In case the Bank Account appears to be debited, ensure that he/ she does not make the payment twice and immediately thereafter contact Pushpagiri College of Dental Sciences  via e-mail or any other mode of contact as provided by Pushpagiri College of Dental Sciences  to confirm payment.
        In case the Bank Account is not debited, the User may initiate a fresh transaction to make payment. However, the User agrees that under no circumstances the Payment Gateway Service Provider shall be held responsible for such fraudulent/duplicate transactions and hence no claims should be raised to Payment Gateway Service Provider No communication received by the Payment Service Provider(s) in this regards shall be entertained by the Payment Service Provider(s).
        Limitation of Liability</p>
        <p>•   1. Pushpagiri College of Dental Sciences  has made this Service available to the User as a matter of convenience. of Kerala Pushpagiri College of Dental Sciences  expressly disclaims any claim or liability arising out of the provision of this Service. The User agrees and acknowledges that he/ she shall be solely responsible for his/ her conduct and that Pushpagiri College of Dental Sciences reserves the right to terminate the rights to use of the Service immediately without giving any prior notice thereof.</p>
        <p>•   2. Pushpagiri College of Dental Sciences  and/or the Payment Service Providers shall not be liable for any inaccuracy, error or delay in, or omission of (a) any data, information or message, or (b) the transmission or delivery of any such data, information or message; or (c) any loss or damage arising from or occasioned by any such inaccuracy, error, delay or omission, non-performance or interruption in any such data, information or message. Under no circumstances shall Pushpagiri College of Dental Sciences and/or the Payment Service Providers, its employees, directors, and its third party agents involved in processing, delivering or managing the Services, be liable for any direct, indirect, incidental, special or consequential damages, or any damages whatsoever, including punitive or exemplary arising out of or in any way connected with the provision of or any inadequacy or deficiency in the provision of the Services or resulting from unauthorized access or alteration of transmissions of data or arising from suspension or termination of the Services.</p>
        <p>•   3. Pushpagiri College of Dental Sciences ) and the Payment Service Provider(s) assume no liability whatsoever for any monetary or other damage suffered by the User on account of: The delay, failure, interruption, or corruption of any data or other information transmitted in connection with use of the Payment Gateway or Services in connection thereto; and/ or Any interruption or errors in the operation of the Payment Gateway.</p>
        <p>•   4. The User shall indemnify and hold harmless the Payment Service Provider(s) and Pushpagiri College of Dental Sciences and their respective officers, directors, agents, and employees, from any claim or demand, or actions arising out of or in connection with the utilization of the Services.</p>
        <p>•   5. The User agrees that Pushpagiri College of Dental Sciences  or any of its employees will not be held liable by the User for any loss or damages arising from your use of, or reliance upon the information contained on the Website, or any failure to comply with these Terms and Conditions where such failure is due to circumstance beyond Pushpagiri College of Dental Sciences )’reasonable control.
        Miscellaneous Conditions:</p>
        <p>•   1. Any waiver of any rights available to Pushpagiri College of Dental Sciences  under these Terms and Conditions shall not mean that those rights are automatically waived.</p>
        <p>•   2. The User agrees, understands and confirms that his/ her personal data including without limitation details relating to debit card/ credit card transmitted over the Internet may be susceptible to misuse, hacking, theft and/ or fraud and that Pushpagiri College of Dental Sciences  or the Payment Service Provider(s) have no control over such matters.</p>
        <p>•   3. Although all reasonable care has been taken towards guarding against unauthorized use of any information transmitted by the User Pushpagiri College of Dental Sciences does not represent or guarantee that the use of the Services provided by/ through it will not result in theft and/or unauthorized use of data over the Internet.</p>
        <p>•   4. Pushpagiri College of Dental Sciences, the Payment Service Provider(s) and its affiliates and associates shall not be liable, at any time, for any failure of performance, error, omission, interruption, deletion, defect, delay in operation or transmission, computer virus, communications line failure, theft or destruction or unauthorized access to, alteration of, or use of information contained on the Website.</p>
        <p>•   5. The User may be required to create his/ her own User ID and Password in order to register and/ or use the Services provided by Pushpagiri College of Dental Sciences  on the Website. By accepting these Terms and Conditions the User aggress that his/ her User ID and Password are very important pieces of information and it shall be the User’s own responsibility to keep them secure and confidential. In furtherance hereof, the User agrees to; choose a new password, whenever required for security reasons. Keep his/ her User ID & Password strictly confidential. Be responsible for any transactions made by User under such User ID and Password. The User is hereby informed that Pushpagiri College of Dental Sciences  will never ask the User for the User’s password in an unsolicited phone call or in an unsolicited email. The User is hereby required to sign out of his/ her Pushpagiri College of Dental Sciences  account on the Website and close the web browser window when the transaction(s) have been completed. This is to ensure that others cannot access the User’s personal information and correspondence when the User happens to share a computer with someone else or is using a computer in a public place like a library or Internet café.
        Debit/Credit Card, Bank Account Details</p>
        <p>•   1. The User agrees that the debit/credit card details provided by him/ her for use of the aforesaid Service(s) must be correct and accurate and that the User shall not use a debit/ credit card, that is not lawfully owned by him/ her or the use of which is not authorized by the lawful owner thereof. The User further agrees and undertakes to provide correct and valid debit/credit card details.</p>
        <p>•   2. The User may pay his/ her fees to Pushpagiri College of Dental Sciences  by using a debit/credit card or through online banking account. The User warrants, agrees and confirms that when he/ she initiates a payment transaction and/or issues an online payment instruction and provides his/ her card / bank details: The User is fully and lawfully entitled to use such credit / debit card, bank account for such transactions; The User is responsible to ensure that the card/ bank account details provided by him/ her are accurate; The User is authorizing debit of the nominated card/ bank account for the payment of course fees selected by such User along with the applicable Fees.
        The User is responsible to ensure sufficient credit is available on the nominated card/ bank account at the time of making the payment to permit the payment of the dues payable or the bill(s) selected by the User inclusive of the applicable Fee. The User agrees that, to the extent required or permitted by law, Pushpagiri College of Dental Sciences  and/ or the Payment Service Provider(s) may also collect, use and disclose personal information in connection with security related or law enforcement investigations or in the course of cooperating with authorities or complying with legal requirements.</p>
        <p>•   1. The User agrees that any communication sent by the User vide e-mail, shall imply release of information therein/ therewith to Pushpagiri College of Dental Sciences . The User agrees to be contacted via e-mail on such mails initiated by him/ her.</p>
        <p>•   2. In addition to the information already in the possession of Pushpagiri College of Dental Sciences  and/ or the Payment Service Provider(s), Pushpagiri College of Dental Sciences ) may have collected similar information from the User in the past. By entering the Website the User consents to the terms of Pushpagiri College of Dental Sciences  information privacy policy and to Pushpagiri College of Dental Sciences  continued use of previously collected information. By submitting the User’s personal information to Pushpagiri College of Dental Sciences , the User will be treated as having given his/her permission for the processing of the User’s personal data as set out herein.</p>
        <p>•   3. The User acknowledges and agrees that his/ her information will be managed in accordance with the laws for the time in force.
        G.Payment Gateway Disclaimer
        The Service is provided in order to facilitate access to view and pay online. Pushpagiri College of Dental Sciences  or the Payment Service Provider(s) do not make any representation of any kind, express or implied, as to the operation of the Payment Gateway other than what is specified in the Website for this purpose. By accepting/ agreeing to these Terms and Conditions, the User expressly agrees that his/ her use of the aforesaid online payment Service is entirely at own risk and responsibility of the User.</p>
                             

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--         <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="PrivacyPolicyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <p>We do not sell or forward or rent your personal information what you share with The Pushpagiri College of Dental Sciences  through the site http://pcds.pushpagiri.net, to any third party for any purposes like marketing, promotion etc. without your consent. This privacy policy is applicable to our services available under the aforesaid domain name.
            Wherever your Personal Information is held within The Pushpagiri College of Dental Sciences, the college shall take reasonable steps to protect it from unauthorized access or disclosure. The Pushpagiri College of Dental Sciences  is committed to protecting the security of your personal information. We store the personal information you provide on computer systems with limited access, which are located in controlled facilities. When we transmit highly confidential information, we protect it through the use of encryption.
            This Privacy Policy describes Pushpagiri College of Dental Sciences  treatment of personally identifiable information that Pushpagiri College of Dental Sciences  collects when User is on the Pushpagiri College of Dental Sciences ’ website. Like any business interested in offering the highest quality of service to clients, Pushpagiri College of Dental Sciences  may, from time to time, send email and other communication to the User tell them about the various services, features, functionality and content offered by Pushpagiri College of Dental Sciences  website or seek voluntary information from you.
            Please be aware, however, that Pushpagiri College of Dental Sciences  will release specific personal information about the User if required to do so in the following circumstances:
            In order to comply with any valid legal process such as a search warrant, statute, or court order, or If any of User’s actions on Pushpagiri College of Dental Sciences ’ website violate the Terms of Service or any of Pushpagiri College of Dental Sciences  guidelines for specific services, or To protect or defend Association Of The Pushpagiri College of Dental Sciences  legal rights or property, The Pushpagiri College of Dental Sciences site, or Pushpagiri College of Dental Sciences Users; or To investigate, prevent, or take action regarding illegal activities, suspected fraud, situations involving potential threats to the security, integrity of Pushpagiri College of Dental Sciences )website/offerings. Please note that this Privacy Policy may keep changing from time to time without notice at the sole discretion of The Pushpagiri College of Dental Sciences . If you have any questions about The Pushpagiri College of Dental Sciences  Privacy Policy, collection, use, or disclosure of your personal information, please e-mail us at dentalcollege@pushpagiri.in.</p>

             

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="RefundPolicyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Refund Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Fee once paid will not be refunded. However, if there is any excess payment or double payment for any reason whatsoever, the student may file his/her claim with the Finance & Accounts Section of Pushpagiri College of Dental Sciences.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="CancelandReturnPolicyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cancel And Return Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       PCDS is an education organisation and we use payment gateways for fees collection, So the cancellation and return policies are not applicable
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = '<?php echo base_url(); ?>';
        $.backstretch([
            base_url + "backend/usertemplate/assets/img/backgrounds/user15.jpg"
        ], {duration: 3000, fade: 750});
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>