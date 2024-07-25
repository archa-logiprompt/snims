<style>
table {
    width: 100%;
}

table th {
    text-align: center
}

.rotate {
    height: 172px;
    transform: rotate(-90deg);
    vertical-align: middle;
}

.bold {
    font-weight: bold
}

td {
    text-align: center;
    height: 38px
}

.totalrow {
    background: gainsboro;
}
</style>



<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/bootstrap-select.min.css" />

<script type="text/javascript" src="<?php echo base_url(); ?>backend/bootstrap/bootstrap-select.min.js"> </script>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
            <small><?php echo $this->lang->line('student_fees1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?>
                </h3>
                <div class="box-tools pull-right">
                    <?php if ($this->rbac->hasPrivilege('assign_class_teacher', 'can_add')) { ?>
                    <a href="<?php echo base_url(); ?>admin/subject/assignsubjecthours" class="btn btn-primary btn-sm"
                        data-toggle="tooltip" title="<?php echo $this->lang->line('assign_subjects'); ?>">
                        <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                    </a>
                    <?php } ?>
                </div>
            </div>
            <form class="assign_teacher_form" action="<?php echo base_url(); ?>admin/subject/subjecthours" method="post"
                enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('msg')) { ?>
                            <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select autofocus="" id="class_id" name="class_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                    <option value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                    <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="class_id_error text-danger"></span>
                            </div>
                        </div>

                    </div>
                    <button type="submit" name="search" class="btn btn-primary btn-sm pull-right"><i
                            class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                </div>
            </form>
        </div>

        <?php 
        if($is_search){ ?>
        <div class="box box-info" id="box_display">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users"> </i> <?php echo $this->lang->line('assign_subject'); ?>
                </h3>
                
            </div>
                        
                <br />
                <!-- <input type="hidden" id="post_class_id" name="class_id" value="<?php //echo $class_id?>">
                <input type="hidden" id="post_section_id" name="section_id" value="<?php //echo $section_id?>"> -->
                <div class="box-body">
                <button type="button" style="margin-right: 10px;margin-top: 10px;" name="search"
                    id="collection_print"  
                    class="btn btn-sm btn-primary fa fa-print pull-right">
                    <?php echo $this->lang->line('print'); ?></button>

                <div class="box-body" id="printcontent">
                    <table border=1 >
                        <thead>
                            <th>Semester</th>
                            <th>Course Code</th>
                            <th>Subject Title</th>
                            <th class='rotate'>Theory Credits</th>
                            <th class='rotate'>Theory <br> contact hours</th>
                            <th class='rotate'>Lab/Skill Lab <br> Credits</th>
                            <th class='rotate'>Lab/Skill Lab <br> Contact Hours</th>
                            <th class='rotate'>Clinical Credits</th>
                            <th class='rotate'>Clinical Contact <br> Hours</th>
                            <th class='rotate'>Total Credits</th>
                            <th class='rotate'>Total Hours</th>
                        </thead>
                        <tbody>
                            <?php 
                            
                            
                            foreach ($sections as $key => $section) {
                                $count = 0;

                                $theory_credits_sum =  array_sum(array_column($section['subject_hours'], 'theory_credits'));
                                $theory_hours =  array_sum(array_column($section['subject_hours'], 'theory_hours'));
                                $lab_credits =  array_sum(array_column($section['subject_hours'], 'lab_credits'));
                                $lab_hours =  array_sum(array_column($section['subject_hours'], 'lab_hours'));
                                $clinical_credits =  array_sum(array_column($section['subject_hours'], 'clinical_credits'));
                                $clinical_hours =  array_sum(array_column($section['subject_hours'], 'clinical_hours'));
                               foreach ($section['subject_hours'] as $key => $subject) {
                               
                                // print_r(array_sum($section['subject_hours']['theory_credits']))

                            ?>

                            <tr>

                                <?php if($count==0){ ?>
                                <td rowspan="<?php echo count($section['subject_hours']) ?>" class='rotate'>
                                    <?php echo $section['section'] ?></td>
                                <?php } ?>
                                <td><?php echo getsubjectcode($subject['subject_id']) ?></td>
                                <td><?php echo getsubjectname_forreport($subject['subject_id']) ?></td>
                                <td class='bold'>
                                    <?php  echo $subject['theory_credits']? $subject['theory_credits']: '-' ?>
                                </td>
                                <td class='bold'>
                                    <?php echo $subject['theory_hours']? $subject['theory_hours']: '-' ?>
                                </td>
                                <td class='bold'>
                                    <?php  echo $subject['lab_credits']? $subject['lab_credits']: '-' ?>
                                </td>
                                <td class='bold'>
                                    <?php echo $subject['lab_hours']? $subject['lab_hours']: '-' ?>
                                </td>
                                <td class='bold'>
                                    <?php  echo $subject['clinical_credits']? $subject['clinical_credits']: '-' ?>
                                </td>
                                <td class='bold'>
                                    <?php echo $subject['clinical_hours']? $subject['clinical_hours']: '-' ?>
                                </td>


                                <td class='bold'>
                                    <?php  $total_credits = array_sum([$subject['theory_credits'], $subject['lab_credits'], $subject['clinical_credits']]);
                                        echo ($total_credits > 0) ? $total_credits : '-'; ?>
                                </td>
                                <td class='bold'>
                                    <?php  $total_hours = array_sum([$subject['theory_hours'], $subject['lab_hours'], $subject['clinical_hours']]);
                                        echo ($total_hours > 0) ? $total_hours : '-'; ?>
                                </td>
                                

                            </tr>

                            <?php
                               $count++;
                        }?>

                <?php if($theory_credits_sum!=0 && $theory_hours!=0 && $lab_credits!=0 && $lab_hours!=0 && $clinical_credits!=0 && $clinical_hours!=0 ){ ?>
                            <tr class='totalrow'>

                                <td class='bold' colspan='2'>Total</td>
                                <td class='bold'> <?php  echo $theory_credits_sum; ?></td>
                                <td class='bold'> <?php  echo $theory_hours; ?></td>
                                <td class='bold'> <?php  echo $lab_credits; ?></td>
                                <td class='bold'> <?php  echo $lab_hours; ?></td>
                                <td class='bold'> <?php  echo $clinical_credits; ?></td>
                                <td class='bold'> <?php  echo $clinical_hours; ?></td>
                                <td class='bold'> <?php  echo $theory_credits_sum+$lab_credits+$clinical_credits; ?></td>
                                <td class='bold'> <?php  echo $theory_hours+$lab_hours+$clinical_hours; ?></td>
                                
                            </tr>
                            <?php
                }
                               
                        }?>
                        </tbody>
                    </table>

                </div>

             
        </div>
        <?php } ?>


    </section>
</div>

<script type="text/javascript">
// $(document).on('click', '#collection_print', function() {


//     var printContents = document.getElementById('box_display').innerHTML;
//     var originalContents = document.body.innerHTML;

//     document.body.innerHTML = printContents;

//     window.print();

//     document.body.innerHTML = originalContents;


// });
$(document).on('click', '#collection_print', function () {
    
    // Get the class value from the data attribute of the button
    let content = $('#printcontent').html();
    content = btoa(content); 
    // Make an AJAX request to the 'printwithheaderandfooter' method
    $.ajax({
        url: '<?php echo base_url('admin/weeklycalendarnew/printwithheaderandfooter'); ?>',
        method: 'post', 
        data: {
            data: content
        },
         beforeSend: function (xhr) {
        xhr.setRequestHeader('Content-Encoding', 'gzip');
    },
        
        success: function (data) {
            console.log(data)
           data =  data.replace(/['"]+/g, '')
            // Redirect to the generated PDF URL
            window.location.href = "<?php echo base_url() ?>" + data;
        },
        error: function (xhr, status, error) {
            console.error('xhr:', xhr);
            console.error('status:', status);
            console.error('error:', error);
        }
    });
});
</script>