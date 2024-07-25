<!DOCTYPE html>
<html>

<head>
    <title>Attendance View</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/bootstrap-select.min.css">
</head>

<body>

    <style>
        @media print {
            .college-heading {
                display: block;
            }

            .print-btn {
                display: none;

            }
        }

        .college-heading {
            display: none;
        }
    </style>
    <div class="content-wrapper" style="min-height: 946px;">
        <section class="content-header">
            <h1>
                <i class="fa fa-mortar-board"></i> <?php echo 'Attendence'; ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>
            </h1>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                </div>
                <form class="assign_teacher_form" id="attendance_form" action="<?php echo base_url(); ?>admin/teacher/viewattendence" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small>
                                    <select autofocus="" id="class_id" name="class_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($classlist as $class) {
                                        ?>
                                            <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                    <select id="section_id" name="section_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo 'From Date'; ?></label><small class="req"> *</small>
                                    <input type="date" name="fromdate" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo 'To Date'; ?></label><small class="req"> *</small>
                                    <input type="date" name="dateto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button name="search" id="searchattendence" class="btn btn-success" style="margin-top: 19px;">Search Attendance</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php

            function getDateFromLog($data)
            {

                // Convert the string to a DateTime object
                $date = new DateTime($data);

                // Format the date as yyyy-mm-dd
                $formattedDate = $date->format('H:m:s');

                return $formattedDate;
            }

            function DateDifference($d1, $d2)
            {
                $datetime1 = new DateTime($d1);
                $datetime2 = new DateTime($d2);

                $interval = $datetime1->diff($datetime2);

                $hours = $interval->h;
                $minutes = $interval->i;

                $formattedDifference = sprintf("%02dh:%02dm", $hours, $minutes);

                echo $formattedDifference;
            }


            ?>

            <!-- Display the table -->

            <?php if ($issearch) {
            ?>


                <div id="attendance_table_container">
                    <div class="box box-primary">
                        <h1 class="text-center college-heading"> Caritas College Of Nursing </h1>
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Library Attendance</h3>
                        </div>
                        <div class="box-body">
                            <button id='print' class='btn btn-info print-btn'>Print</button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Punch Date</th>
                                        <th>Punch In Time</th>
                                        <th>Punch Out Time</th>
                                        <th>Duration</th>
                                        <!-- Add other table headers as per your data -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($student_attendance as $attendance) {
                                        // var_dump($attendance);
                                    ?>
                                        <tr>
                                            <td><?php echo $attendance->studentadmno; ?></td>
                                            <td><?php echo $attendance->firstname; ?></td>
                                            <td><?php echo $attendance->class; ?></td>
                                            <td><?php echo $attendance->section; ?></td>
                                            <td><?php echo $attendance->date; ?></td>
                                            <td><?php echo getDateFromLog($attendance->punchintime); ?></td>
                                            <td><?php echo getDateFromLog($attendance->punchouttime); ?></td>
                                            <td><?php echo DateDifference($attendance->punchintime, $attendance->punchouttime); ?></td>
                                            <!-- Add other table data as per your data -->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>

    <script src="<?php echo base_url(); ?>backend/bootstrap/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#print').on('click', function() {

            var printContent = document.getElementById('attendance_table_container');
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent.innerHTML;
            window.print();

            // Restore the original content after printing
            document.body.innerHTML = originalContent;
        })
    </script>
    <script type="text/javascript">
        function getSectionByClass(class_id, section_id) {
            if (class_id != "" && section_id != "") {
                $('#section_id').html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "sections/getByClass",
                    data: {
                        'class_id': class_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(i, obj) {
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
        $(document).ready(function() {
            var class_id = $('#class_id').val();
            var section_id = '<?php echo set_value('section_id') ?>';
            getSectionByClass(class_id, section_id);
            $(document).on('change', '#class_id', function(e) {
                $('#section_id').html("");
                var class_id = $(this).val();
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "sections/getByClass",
                    data: {
                        'class_id': class_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(i, obj) {
                            div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    }
                });
            });
        });
    </script>

</body>

</html>