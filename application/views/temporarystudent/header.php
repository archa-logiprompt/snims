<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?php echo $this->customlib->getAppName(); ?></title> -->
    <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="<?php echo base_url(); ?>backend/images/s_logo.png" alt="<?php echo $this->customlib->getAppName() ?>" width />
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="<?php echo base_url(); ?>backend/images/snims-logo.png" alt="<?php echo $this->customlib->getAppName() ?>" height="80px" />
                </a>
            </ul>

            <div class="col-md-3 text-end">
                <a  href="<?php echo base_url('site/logout')?>"type="button" class="btn btn-outline-primary me-2">Logout</a>
            </div>
        </header>
    </div>


    <!-- 
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="<?php echo base_url(); ?>backend/images/s_logo.png" alt="<?php echo $this->customlib->getAppName() ?>" />
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="<?php echo base_url(); ?>backend/images/snims-logo.png" alt="<?php echo $this->customlib->getAppName() ?>" height="80px" />
                </a>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">Logout</button>
            </div>
        </header>
    </div> -->
</body>

</html>