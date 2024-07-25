<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i><?php echo $this->lang->line('student_information'); ?>  </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('exam_list'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="tshadow mb25"> 
                            <?php
                            if (empty($examSchedule)) {
                                ?>
                                <div class="alert alert-danger">
                                    No Exam Found.
                                </div>
                                <?php
                            } else {
                                foreach ($examSchedule as $key => $value) {
                                    ?>
                                    <h4 class="pagetitleh"><?php echo $value['exam_name']; ?></h4>
                                    <?php
                                    if (empty($value['exam_result'])) {
                                        ?>
                                        <div class="alert alert-info"><?php echo $this->lang->line('no_result_prepare'); ?></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="table-responsive borgray around10">  
                                            <div class="download_label"><?php echo $this->lang->line('exam_marks_report'); ?></div>
                                            <table class="table table-striped table-hover tmb0 example">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <?php echo $this->lang->line('subject'); ?>
                                                        </th>
                                                        <th>
                                                            <?php echo $this->lang->line('full_marks'); ?>
                                                        </th>
                                                        <th>
                                                            <?php echo $this->lang->line('passing_marks'); ?>
                                                        </th>
                                                        <th>
                                                            <?php echo $this->lang->line('obtain_marks'); ?>
                                                        </th>
                                                        <th class="text text-right">
                                                            <?php echo $this->lang->line('result'); ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $obtain_marks = 0;
                                                    $total_marks = 0;
                                                    $result = "Pass";
                                                    $exam_results_array = $value['exam_result'];
                                                    $s = 0;
                                                    // var_dump($exam_results_array);

                                                    foreach ($exam_results_array as $result_k => $result_v) {
                                                        $total_marks = $total_marks + $result_v['full_marks'];
                                                        ?>
                                                        <tr>
                                                            <td>  <?php
                                                                echo $result_v['exam_name'] . " (" . substr($result_v['exam_type'], 0, 2) . ".) ";
                                                                ?></td>
                                                            <td><?php echo $result_v['full_marks']; ?></td>
                                                            <td><?php echo $result_v['passing_marks']; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($result_v['attendence'] == "pre") {
                                                                    echo $get_marks_student = $result_v['get_marks'];
                                                                    $passing_marks_student = $result_v['passing_marks'];
                                                                    if ($result == "Pass") {
                                                                        if ($get_marks_student < $passing_marks_student) {
                                                                            $result = "Fail";
                                                                        }
                                                                    }
                                                                    $obtain_marks = $obtain_marks + $result_v['get_marks'];
                                                                } else {
                                                                    $result = "Fail";
                                                                    echo ($result_v['attendence']);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text text-center">
                                                                <?php
                                                                if ($result_v['attendence'] == "pre") {
                                                                    $passing_marks_student = $result_v['passing_marks'];
                                                                    if ($get_marks_student < $passing_marks_student) {
                                                                        echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                    } else {
                                                                        echo "<span class='label pull-right bg-green'>" . $this->lang->line('pass') . "</span>";
                                                                    }
                                                                } else {
                                                                    echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                    $s++;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        if ($s == count($exam_results_array)) {
                                                            $obtain_marks = 0;
                                                        }
                                                    }
                                                    $obtain_mark=0;
                                                    $total_mark = 0;
                                                    $results = "Pass";
                                                    $y = 0;

                                                    $prac_results_array = $value['pracexam_result'];
                                                    foreach ($prac_results_array as $result_pr => $result_val) { 
                                                        $total_mark = $total_mark + $result_val['total_marksallowed'];
                                                        if($result_val['prac_exam']!=''){
                                                        ?>
                                                        <tr>
                                                            <td>  <?php
                                                           
                                                                echo $result_val['prac_exam'] ;
                                                                ?></td>
                                                            <td><?php echo $result_val['total_marksallowed']; ?></td>
                                                            <td><?php echo $result_val['pass_marks']; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($result_val['attendences'] == "pre") {
                                                                    echo $result_val['get_mark'];
                                                                $get_marks_prac = $result_val['get_mark'];
                                                                    $passing_marks_prac = $result_val['pass_marks'];
                                                                    if ($results == "Pass") {
                                                                        if ($get_marks_prac < $passing_marks_prac) {
                                                                            $results = "Fail";
                                                                        }
                                                                    }
                                                                    $obtain_mark = $obtain_mark + $result_val['get_mark'];
                                                                } else {
                                                                    $results = "Fail";
                                                                    echo ($result_val['attendences']);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text text-center">
                                                                <?php
                                                                if ($result_val['attendences'] == "pre") {
                                                                    $passing_marks_prac = $result_val['pass_marks'];
                                                                    if ($get_marks_prac < $passing_marks_prac) {
                                                                        echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                    } else {
                                                                        echo "<span class='label pull-right bg-green'>" . $this->lang->line('pass') . "</span>";
                                                                    }
                                                                } else {
                                                                    echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                    $y++;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php

                                                        if ($y == count($prac_results_array)) {
                                                            $obtain_mark = 0;
                                                        }
                                                    }




                                                    
                                                }
                                                $vivaobtain_mark=0;
                                                    $vivatotal_mark = 0;
                                                    $vivapass_marks = "Pass";
                                                    $z = 0;

                                                    $viva_results_array = $value['vivaexam_result'];
                                                    foreach ($viva_results_array as $result_vi => $result_viv) { 
                                                        $vivatotal_mark = $vivatotal_mark + $result_viv['viva_fullmark'];
                                                        if($result_viv['viva_examname']!=''){
                                                        ?>
                                                        <tr>
                                                            <td>  <?php
                                                           
                                                                echo $result_viv['viva_examname'] ;
                                                                ?></td>
                                                            <td><?php echo $result_viv['viva_fullmark']; ?></td>
                                                            <td><?php echo $result_viv['vivapass_marks']; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($result_viv['viva_attendence'] == "pre") {
                                                                    echo $result_viv['marks_earned'];
                                                                $get_marks_viva = $result_viv['marks_earned'];
                                                                    $passing_marks_viva = $result_viv['vivapass_marks'];
                                                                    if ($vivapass_marks == "Pass") {
                                                                        if ($get_marks_viva < $passing_marks_viva) {
                                                                            $vivapass_marks = "Fail";
                                                                        }
                                                                    }
                                                                    $vivaobtain_mark = $vivaobtain_mark + $result_viv['marks_earned'];
                                                                } else {
                                                                    $vivapass_marks = "Fail";
                                                                    echo ($result_viv['viva_attendence']);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text text-center">
                                                                <?php
                                                                if ($result_viv['viva_attendence'] == "pre") {
                                                                    $passing_marks_viva = $result_viv['vivapass_marks'];
                                                                    if ($get_marks_viva < $passing_marks_viva) {
                                                                        echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                    } else {
                                                                        echo "<span class='label pull-right bg-green'>" . $this->lang->line('pass') . "</span>";
                                                                    }
                                                                } else {
                                                                    echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                                    $z++;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php

                                                        if ($z == count($viva_results_array)) {
                                                            $vivaobtain_mark = 0;
                                                        }
                                                    }

                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="bgtgray">
                                                    <?php
                                                    $foo = "";
                                                    ?>         
                                                    <div class="col-sm-3 pull">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><?php echo $this->lang->line('result'); ?> :
                                                                <span class="description-text">
                                                                    <?php
                                                                    if ($result == "Pass") {
                                                                        ?>
                                                                        <b class='text text-success'><?php echo $result; ?></b>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <b class='text text-danger'><?php echo $result; ?></b>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </h5>
                                                        </div>                                          
                                                    </div>	
                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><?php echo $this->lang->line('grand_total'); ?> :
                                                                <span class="description-text"><?php echo $obtain_marks . "/" . $total_marks; ?></span>
                                                            </h5>
                                                        </div>                                           
                                                    </div>  
                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><?php echo $this->lang->line('percentage'); ?>:
                                                                <span class="description-text"><?php
                                                                    $foo = ($obtain_marks * 100) / $total_marks;
                                                                    echo number_format((float) $foo, 2, '.', '');
                                                                    ?>
                                                                </span>
                                                            </h5>
                                                        </div>                                          
                                                    </div>                                     

                                                    <div class="col-sm-3">
                                                        <div class="description-block">
                                                            <h5 class="description-header">
                                                                <span class="description-text"><?php
                                                                    if (!empty($gradeList)) {

                                                                        foreach ($gradeList as $key => $value) {
                                                                            if ($foo >= $value['mark_from'] && $foo <= $value['mark_upto']) {
                                                                                ?>
                                                                                <?php echo $this->lang->line('grade') . ": " . $value['name']; ?>
                                                                                <?php
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></span>
                                                            </h5>
                                                        </div>                                            
                                                    </div> 
                                                </div></div>                                    
                                        </div>
                                    <?php }
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                        </div>  
                    </div>                
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });
</script>    