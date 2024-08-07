<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?php echo $this->customlib->getAppName(); ?></title> -->
    <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="<?php echo base_url(); ?>backend/images/s_logo.png"
                        alt="<?php echo $this->customlib->getAppName() ?>" width />
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="<?php echo base_url(); ?>backend/images/snims-logo.png"
                        alt="<?php echo $this->customlib->getAppName() ?>" height="80px" />
                </a>
            </ul>


            <div class="col-md-3 text-end">
                <?php $commentCount = count($commentdetails); ?>
                <button class="btn btn-outline-secondary me-2 position-relative"
                    style="margin-top: 4px; margin-right: 4px" data-toggle="modal"
                    data-target="#previouscommentsModal"><i class="fas fa-bell"></i><span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $commentCount ?>
                    </span></button>
                  
                    <!-- <?php if ($status['status'] == '1'): ?>
                            <a href="<?php echo base_url('temporary_user/TemporaryUser/payment/'.$userdata['id']) ?>" type="button" class="btn btn-outline-primary me-2">Payment</a>
                    <?php endif; ?> -->

                 

    <?php if (!empty($paymentsucceess) && $paymentsucceess['temporary_student_id'] == $userdata['id']): ?>
    <a href="<?php echo base_url('temporary_user/TemporaryUser/downloadreceipt/' . $userdata['id']) ?>" type="button" class="btn btn-outline-primary me-2">Download Receipt</a>
    <?php elseif ($status['status'] == '1'): ?>
    <a href="<?php echo base_url('temporary_user/TemporaryUser/payment/' . $userdata['id']) ?>" type="button" class="btn btn-outline-primary me-2">Payment</a>
<?php endif; ?>

             
                <a href="<?php echo base_url('site/logout') ?>" type="button"
                    class="btn btn-outline-primary me-2">Logout</a>
            </div>
        </header>
    </div>

    <div class="modal fade" id="previouscommentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">View Comments</h5>

                </div>
                <div class="modal-body">

                    <div class="form-group">

                        <table class="table table-bordered">
                            <tbody>
                                <?php foreach ($commentdetails as $comment) {
                                    ?>
                                    <tr>
                                        <td>
                                            <h3><?php echo $comment['comment']; ?></h3>
                                            <span><?php echo $comment['commented_by']; ?></span><span
                                                class="-pull-right float-end"><?php echo date('d/m/Y', strtotime($comment['created_at'])); ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary " data-dismiss="modal"
                        aria-label="Close">Close</button>

                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> -->


                </div>
            </div>
        </div>
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