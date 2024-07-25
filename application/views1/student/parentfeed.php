<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo 'Parent Feedback'; ?>
		</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
           <div class="col-md-12">
                <div class="box box-primary"> 
                    <form role="form" action="<?php echo site_url('student/feedreport') ?>" method="post" class="">
                     
                    </form>
                </div>
            </div>
            
              <div class="box box-info" style="padding:5px;">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo form_error('student'); ?> <?php echo 'Feedback'; ?></h3>
                    </div>
                    <div class="box-body table-responsive">
                    <div class="download_label"> <?php echo $this->Setting_model->getCurrentSchoolName();?></br>
					<?php echo $this->lang->line('guardian_report'); ?></div>
                         <table class="table table-striped table-bordered table-hover example">
                                    <thead>
                                        <tr> 
                                             <th><?php echo $this->lang->line('guardian_name'); ?></th>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('guardian_phone'); ?></th>

                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($resultlist)) {
                                            ?>

                                            <?php
                                        } else {
                                            $count = 1;
                                            foreach ($resultlist as $student) {
                                             
                                                ?>
                                                <tr>
                                                    
                                                   <td>
                                                       <a href="<?php echo base_url(); ?>student/feeds/<?php echo $student['id']; ?>"><?php echo $student['pname']; ?>
                                                        </a>
                                                   </td>
                                                    <td>
                                                        <?php echo $student['sname']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['phone']; ?></td>
                                                      
                                                   

                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>   
        </div>  
    </section>
</div>


<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }

    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });
</script>