<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('fees_year', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_fees_year'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo base_url() ?>admin/feeyear"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>

                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1"><?php //echo $this->lang->line('fees_year'); ?></label> <small class="req">*</small>
                                    <input autofocus="" id="year" name="year" type="text" class="form-control"  value="<?php //echo set_value('year'); ?>" />
                                    <span class="text-danger"><?php //echo form_error('year'); ?></span>
                                </div>-->
                                


                                
                                <div class="form-group">
                                            <label for="pwd"><?php echo $this->lang->line('fees_year'); ?></label> 
                                         <select name="year" class="form-control"  >
                                         <option value="">Select</option>
                                         <option value="2010">2010</option>
                                         <option value="2011">2011</option>
                                         <option value="2012">2012</option>
                                         <option value="2013">2013</option>
                                         <option value="2014">2014</option>
                                         <option value="2015">2015</option>
                                         <option value="2016">2016</option>
                                         <option value="2017">2017</option>
                                         <option value="2018">2018</option>
                                         <option value="2019">2019</option>
                                         <option value="2020">2020</option>
                                         <option value="2021">2021</option>
                                         <option value="2022">2022</option>
                                         <option value="2023">2023</option>
                                         <option value="2024">2024</option>
                                         <option value="2025">2025</option>
                                         <option value="2026">2026</option>
                                         <option value="2027">2027</option>
                                         <option value="2028">2028</option>
                                         <option value="2029">2029</option>
                                         <option value="2030">2030</option>
                                         <option value="2031">2031</option>
                                         <option value="2032">2032</option>
                                         <option value="2033">2033</option>
                                         <option value="2034">2034</option>
                                         <option value="2035">2035</option>
                                         <option value="2036">2036</option>
                                         <option value="2037">2037</option>
                                         <option value="2038">2038</option>
                                         <option value="2039">2039</option>
                                         <option value="2040">2040</option>
                                         <option value="2041">2041</option>
                                         <option value="2042">2042</option>
                                         <option value="2043">2043</option>
                                         <option value="2044">2044</option>
                                         <option value="2045">2045</option>
                                         <option value="2046">2046</option>
                                         <option value="2047">2047</option>
                                         <option value="2048">2048</option>
                                         <option value="2049">2049</option>
                                         <option value="2050">2050</option>
                                                        
                                                 
                                         </select>    
                                            <span class="text-danger"><?php echo form_error('year'); ?></span>
                                        </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('fees_year', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('fee_year_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">
						<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('fee_year_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('fees_year'); ?>
                                        </th>
                                      <!--  <th><?php //echo $this->lang->line('fees_code'); ?></th>-->



                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									
                                    foreach ($feeyearlist as $feeyear) {
                                        ?>
                                        <tr>
                                            <!--<td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php //echo $feetype['type'] ?></a>

                                                <div class="fee_detail_popover" style="display: none">
                                                    <?php
                                                    //if ($feetype['description'] == "") {
                                                        ?>
                                                        <p class="text text-danger"><?php //echo $this->lang->line('no_description'); ?></p>
                                                        <?php
                                                    //} else {
                                                        ?>
                                                        <p class="text text-info"><?php //echo $feetype['description']; ?></p>
                                                        <?php
                                                    //}
                                                    ?>
                                                </div>
                                            </td>-->
                                            <td class="mailbox-name">
                                                <?php echo $feeyear['year']; ?>
                                            </td>

                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('fees_year', 'can_edit')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/feeyear/edit/<?php echo $feeyear['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('fees_year', 'can_delete')) {
                                                    ?>
                                                    <a href="<?php echo base_url(); ?>admin/feeyear/delete/<?php echo $feeyear['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>