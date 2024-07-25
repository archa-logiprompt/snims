<style type="text/css">
    .liststyle1 {
        margin: 0;
        list-style: none;
        line-height: 28px;
    }
	
	.switchcheck {
    float: right !important;
   
	}
	

</style>

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
           
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="download_label">
						<?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Hostel Room</th>
                                        <th>Rent for Room</th> 
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($hostel_rooms as $hostel) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $hostel->room_no ?></a>
                                            </td>


                                            <td class="mailbox-name">
                                            <?php echo $hostel->cost_per_bed.' ₹' ?>
                                            </td>
                                            
                                          
                                            <td class="mailbox-date pull-right">
    <?php if ($this->rbac->hasPrivilege('hostel_fee_master', 'can_view')) { ?>
                                                    <a href="<?php echo base_url(); ?>admin/feemaster/hostelassign/<?php echo $hostel->id ?>" 
                                                       class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('assign / view'); ?>">
                                                        <i class="fa fa-tag"></i>
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


                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->


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

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#due_date').datepicker({
            format: date_format,
            autoclose: true
        });
    });


</script>
<script type="text/javascript">
    function valueChanged()
    {
        if ($('#enable_student_img').is(":checked"))
            $("#fineid").show();
			 
        // alert("Hii")
        else
            $("#fineid").hide();
			$("#fixamount").hide();
			$("#percent").hide();
			$("#amounttype_id").val(0);
			$("#finetype_id").val(0);
			
    }
	
	$('#amounttype_id').on('change', function() {
		var val=$(this).val();
		if(val=='Fixed Amount')
		{      $("#percent").hide();	
			  $("#fixamount").show();
			  
			  
		}
		else if(val=='Percentage')
		{
			$("#fixamount").hide();
		    $("#percent").show();	
		}
		
  
  
});
	
	
	
	
	
	
	
	
	
	
</script>
<script type="text/javascript">
    /*function valueChange()
    {
       { if ($('#first'))
            $("#fixamount").show();
			 
        // alert("Hii")
        else
            $("#fixamount").hide();}
			
			{ if ($('#second'))
            $("#percent").show();
			 
        // alert("Hii")
        else
            $("#percent").hide();}
	}*/
	
	
	
	
	
</script>

