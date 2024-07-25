<style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        @media print {
            .print-container {
                page-break-inside: avoid;
            } 
            
            .print-table {
                /* Your table styles here */
            }
        
            .page-break  {
                display:block !important; 
                page-break-after:always !important; 
            }
        }

        .front-footer {
            position: absolute;
            height: 28px;
            padding: 10px;
            inset: auto 0 0 0;
            overflow: hidden;
        }

        .front_principal_sign {
            position: absolute;
            right: 12px;
            bottom: 46px;
        }

        .front-footer::after {
            content: '';
            position: absolute;
            inset: 0px -10px 0px -10px;
            background: rgb(0, 128, 0);
            z-index: -1;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .front-footer p {
            font-size: 8px;
            color: white;
            padding: 0 1.2rem;
            text-align: center;
        }
</style>

 
    <?php
        // var_dump($id_card[0]->background);exit;
        foreach ($students as $student) {
        $i++;
    ?> 
    <div class="print-container" style="width: 100%; height:100%; margin-bottom: 1rem; position:relative; overflow: hidden;">
        <div style="background: rgb(0,128,0); background: linear-gradient(0deg, rgba(0,128,0,0) 0%, rgba(0,128,0,1) 30%); height: 100px; position:absolute; inset:0 0 100px 0;z-index: 0;">
            <div style="padding:10px;text-align:center; ">
                <div>
                    <img src="<?php echo base_url('uploads/student_id_card/logo/' . $id_card[0]->logo); ?>" width="30" height="30" />
                </div>
                <h1 style="font-size: 9px; color: white;text-transform: uppercase; margin:0px;">
                    <?php echo $id_card[0]->school_name ?>
                </h1>
                <p style="font-size: 8.5px; color: white; margin:0px;">
                    (A Venture Of Gurudev Charitable Trust)
                </p>
            </div>
        </div>

        <div
            style="height:100%; display:flex; flex-direction: column; align-items: center; justify-content: center;position: relative; z-index: 1;">
            <div>
                <img style="border: 1px solid black; width: 80px; height: 90px;" src="<?php if(!empty($student->image)){ echo base_url($student->image); } else { echo base_url() . "uploads/student_images/no_image.png"; } ?>" />
            </div>

            <div style="text-align: center; margin-top:10px;">
                <b style="color:maroon; font-size: 11px; text-transform: uppercase;">
                    <?php
                        if ($id_card[0]->enable_student_name == 1) {
                            echo $student->firstname . " " . $student->lastname;
                        }
                    ?>
                </b>
            </div>

            <div style="text-align: center; margin-top: 6px;">

                <table style="border-collapse:separate; border-spacing:0 3px; font-size:9px !important;">
                    <tr>
                        <td align="left">D.O.B</td>
                        <td style="padding:0px 10px;">:</td>
                        <td align="left">
                            <b>
                               <?php if ($id_card[0]->enable_dob == 1) {
                                    echo $student->dob;
                                } ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">COURSE</td>
                        <td style="padding:0px 10px;">:</td>
                        <td align="left">
                            <b>
                               <?php if ($id_card[0]->enable_class == 1) {
                                    echo $student->class ;
                                } ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">BATCH</td>
                        <td style="padding:0px 10px;">:</td>
                        <td align="left">
                            <b> 
                            <?php
                                if ($id_card[0]->enable_class == 1) {
                                    $admissionDate = $student->admission_date;
                                    $admissionYear = date('Y', strtotime($admissionDate));
                                    
                                    // Add 5 years to the admission year
                                    $courseDurationYear = $admissionYear + 5;
                                    
                                    echo $admissionYear.'-'. $courseDurationYear;
                                }
                            ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">ADMISSION NO</td>
                        <td style="padding:0px 10px;">:</td>
                        <td align="left">
                            <b>
                                <?php if ($id_card[0]->enable_admission_no == 1) {
                                    echo $student->admission_no;
                                } ?>
                            </b>
                        </td>
                    </tr>
                </table>


                <div class="front_principal_sign"
                    style="display: flex;align-items: center; justify-content: center; flex-direction: column;">
                    <img style="text-align:center;" src="<?php echo base_url('uploads/student_id_card/signature/' . $id_card[0]->sign_image); ?>" width="26" />
                    <p style="font-size: 8px;color:maroon;margin: 0;">Principal</p>
                </div>

            </div>
        </div>

        <div class="front-footer">
            <p>
                <?php echo $id_card[0]->school_address ?>
            </p>
        </div>
        <div class="page-break"></div>
    </div>
    
    

    <div class="print-container" style="width: 100%; height:100%; margin-bottom: 1rem; position:relative; overflow: hidden;">
        <div style="background: rgb(0,128,0); height: 40px; position:absolute; inset:0 0 40px 0;z-index: 0;">
        </div>

        <div
            style="height:100%; display:flex; flex-direction: column; align-items: center; justify-content: center;position: relative; z-index: 1;">
            <div
                style="display: flex; align-items: center; justify-content: center; flex-direction: column; padding:10px; height: 100%; position: relative;">
                <table
                    style="border-collapse:separate; border-spacing:0 10px; position: relative; z-index: 1; font-size: 9px;">
                    <tr>
                        <td align="left" style="white-space: nowrap;">Father's Name</td>
                        <td style="padding:0px 6px;">:</td>
                        <td>
                            <b> 
                            <?php if ($id_card[0]->enable_dob == 1) {
                                echo $student->father_name;
                            } ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="white-space: nowrap;">Mobile No</td>
                        <td style="padding:0px 6px;">:</td>
                        <td>
                            <b> 
                            <?php if ($id_card[0]->enable_dob == 1) {
                                echo $student->mobile_no;
                            } ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="white-space: nowrap;">Mother's Name</td>
                        <td style="padding:0px 6px;">:</td>
                        <td>
                            <b> 
                            <?php if ($id_card[0]->enable_class == 1) {
                                echo $student->mother_name ;
                            } ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="white-space: nowrap; vertical-align: top;">Address</td>
                        <td style="padding:0px 6px; vertical-align: top;">:</td>
                        <td>
                            <b>
                               <?php
                                    if ($id_card[0]->enable_class == 1) {
                                        $admissionDate = $student->current_address;
                                        // $admissionYear = date('Y', strtotime($admissionDate));
                                        
                                        // Add 5 years to the admission year
                                        // $courseDurationYear = $admissionYear + 5;
                                        
                                        echo $admissionDate;
                                    }
                                ?>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="white-space: nowrap;">Blood</td>
                        <td style="padding:0px 6px;">:</td>
                        <td>
                            <b>
                                <?php if ($id_card[0]->enable_admission_no == 1) {
                                    echo $student->blood_group;
                                } ?>
                            </b>
                        </td>
                    </tr>
                </table>
                <img src="<?php echo base_url('uploads/student_id_card/logo/' . $id_card[0]->logo); ?>" width="100%" style="position: absolute;top:50%;left: 50%;transform: translate(-50%,-50%);z-index: 0;opacity: .2;" />
            </div>
        </div>

        <div class="front-footer">
        </div> 
    </div>
    
    
   
    <?php
        }
    ?>