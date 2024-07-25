<!DOCTYPE html>
<html>
    
<head>
	<title>Smart School : School Management System</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>backend/login/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="<?php echo base_url(); ?>backend/login/jquery.min.js"></script>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
     
	
<style>
/* Coded with love by Mutiullah Samim */
		body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #60a3bc !important;
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #60a3bc;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
</style>
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div>
                    </div>
                    <div>
                    
				<div class="d-flex justify-content-center form_container">
                
					 <form action="<?php echo site_url('site/login') ?>" method="post">
                     
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
                     
						<div class="input-group mb-3">
                         
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							 <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" value="" class="form-username form-control" id="form-username">
              
						</div>
                        <span style="color: #0a78ca;"><?php echo form_error('username'); ?></span>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-key"></i></span>
							</div>
							<input type="password" value="" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="form-password">
                                            
						</div>
                        <span style="color: #0a78ca;"><?php echo form_error('password'); ?></span>
						<!--<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>-->
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit"  class="btn login_btn"><?php echo $this->lang->line('sign_in'); ?></button>
                    
                    
				   </div>
					</form>
                    
                   
				</div>
		
				<div class="mt-4">
					<!--<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>-->
					<div class="d-flex justify-content-center links">
						 <a href="<?php echo site_url('site/forgotpassword') ?>" class="forgot"><?php echo $this->lang->line('forgot_password'); ?>?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <!--<script src="<?php //echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>-->
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
        
        
    
    
</body>
</html>

        
        <script type="text/javascript">
    $(document).ready(function () {
        var base_url = '<?php echo base_url(); ?>';
        $.backstretch([
            base_url + "backend/usertemplate/assets/img/backgrounds/11.jpg"
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