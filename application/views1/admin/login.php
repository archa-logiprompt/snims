<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="<?php echo base_url(); ?>backend/landing_login_assets/assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <title>Edusoft - Login</title>

  <link href="<?php echo base_url(); ?>backend/landing_login_assets/assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>backend/landing_login_assets/sign-in.css" rel="stylesheet">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="sign-in.css" rel="stylesheet">
</head>

<body class="-bg-body-primary">

  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>

  <header class="fixed-top">
    <div class="container d-flex flex-wrap justify-content-start justify-content-lg-center py-3 mb-4">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <!-- <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap" />
        </svg> -->
        <img src="<?php echo base_url(); ?>backend/landing_login_assets/assets/brand/edusoft_logo.png" alt="Logo" class="edusoft-logo">
        <!-- <span class="fs-4">Simple header</span> -->
      </a>
    </div>
  </header>

  <!-- Dark Mode Toggle  -->
  <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
      aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
      <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
        <use href="#circle-half"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
            <use href="#sun-fill"></use>
          </svg>
          Light
          <svg class="bi ms-auto d-none" width="1em" height="1em">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
            <use href="#moon-stars-fill"></use>
          </svg>
          Dark
          <svg class="bi ms-auto d-none" width="1em" height="1em">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
          aria-pressed="true">
          <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
            <use href="#circle-half"></use>
          </svg>
          Auto
          <svg class="bi ms-auto d-none" width="1em" height="1em">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
    </ul>
  </div>

  <main>
    <section class="container vh-100 overflow-hidden">
      <img src="<?php echo base_url(); ?>backend/landing_login_assets/icons/circle.png" class="circle-login position-fixed" alt="circle">
      <img src="<?php echo base_url(); ?>backend/landing_login_assets/icons/cube.png" class="cube-login position-fixed z-0" alt="cube">
      <img src="<?php echo base_url(); ?>backend/landing_login_assets/icons/triangle.png" class="triangle-login position-fixed" alt="triangle">
      <img src="<?php echo base_url(); ?>backend/landing_login_assets/icons/home-banner.svg" class="home-banner position-fixed d-none d-lg-block" alt="banner-image">

      <div class="row h-100 align-items-center">
        <div class="col-12 col-lg-4">
          <h1>
            <span class="text-secondary">We are</span><br> tech consultants
          </h1>
          
          <p class="mb-5">
            Welcome back, <br>
            Please login to your account.
          </p>
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

          <form class="form-signin w-100 -m-auto " action="<?php echo site_url('site/login') ?>" method="post">
            <div class="form-floating ">
            <?php 
                        $empty_notice=0;
                        $offset="";
if(empty($notice)){
    $empty_notice=1;
    $offset="col-md-offset-3";

}
                         ?>
                         
                         <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" class="form-username form-control" id="email"> <span class="text-danger"><?php echo form_error('username'); ?></span>
              <label for="floatingInput">Username</label>

            </div>
            <div class="form-floating mb-4">
            <input type="password" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="password"> <span class="text-danger"><?php echo form_error('password'); ?></span>
              <label for="floatingPassword">Password</label>
            </div>
            <div>
              <div class="form-check text-start my-3 d-flex justify-content-between mb-5">
                <div>
                  <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault"> Remember me </label>
                </div>
                <div>
                  <a href="" class="text-underline">Forgot password?</a>
                </div>
              </div>
            </div>
            <div class="d-flex gap-4">
              <button class="btn btn-primary px-5 w-100 py-2 z-1 position-relative" type="submit"> <?php echo $this->lang->line('sign_in'); ?></button>
              <button class="btn btn-outline-secondary px-5 w-100 py-2" type="submit">Sign Up</button>
            </div>
            <!-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> -->
          </form>

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
    </section>

  </main>

  <script src="<?php echo base_url(); ?>backend/landing_login_assets/assets/dist/js/bootstrap.bundle.min.js"></script>

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