<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-building-o"></i> <?php echo $this->lang->line('hostel'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
            </div>           
            <div class="col-md-12">  
             <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php
                        foreach ($childs as $each_child_key => $each_child_value) {
                            $act = "";
                            if ($each_child_key == 0) {
                                $act = "active";
                            }
                            ?>
                            <li class="<?php echo $act; ?>"><a href="#tab_1-<?php echo $each_child_value['student_session_id']; ?>" data-toggle="tab"><?php echo $each_child_value['firstname'] . " " . $each_child_value['lastname']; ?></a></li>
                            <?php
                        }
                        ?>


                    </ul>
                      <div class="tab-content">
                        <?php
 
                        foreach ($childs as $each_child_key => $each_child_value) {
                       
                          $student_hostel = $each_child_value['hostelroomid'];
                            $act = "";
                            if ($each_child_key == 0) {
                                $act = "active";
                            }
                            ?>

                            <div class="tab-pane <?php echo $act; ?>" id="tab_1-<?php echo $each_child_value['student_session_id']; ?>">            
                
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('hostel'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('hostel_name'); ?>
                                        </th  >
                                        <th><?php echo $this->lang->line('type'); ?>
                                        </th>
                                        <th><?php echo 'Room Number'; ?>
                                        </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($each_child_value)) {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        
                                           
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"> <?php echo $each_child_value['hostel_name'] ?></td>
                                                <td class="mailbox-name"> <?php echo $each_child_value['room_type'] ?></td> 
                                                <td class="mailbox-name"> <?php echo $each_child_value['room_no'] ?></td> 
                                                
                                            </tr>
                                            <?php
                                     
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>         
        </div>
        <div class="row">         
            <div class="col-md-12">
            </div>
        </div> 
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>