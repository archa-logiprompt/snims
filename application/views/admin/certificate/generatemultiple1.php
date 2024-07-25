<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

    table {
        font-family: 'arial';
        margin: 0;
        padding: 0;
        font-size: 12px;
        color: #000;
    }

    .tc-container {
        width: 100%;
        position: relative;
        text-align: center;
        margin-bottom: 60px;
        padding-bottom: 10px;
    }

    .tcmybg {
        background: top center;
        background-size: contain;
        position: absolute;
        left: 0;
        bottom: 10px;
        width: 160px;
        height: 160px;
        margin-left: auto;
        margin-right: auto;
        right: 0;
        opacity: 0.10;
    }

    /*begin students id card*/
    .studentmain {
        background: #efefef;
        width: 100%;
        margin-bottom: 30px;
    }

    .studenttop img {
        width: 30px;
        vertical-align: top;
    }

    .studenttop {
        background: #453278;
        padding: 2px;
        color: #fff;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .sttext1 {
        font-size: 24px;
        font-weight: bold;
        line-height: 30px;
    }

    .stgray {
        background: #efefef;
        padding-top: 5px;
        padding-bottom: 10px;
    }

    .staddress {
        margin-bottom: 0;
        padding-top: 2px;
    }

    .stdivider {
        border-bottom: 2px solid #000;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .stlist {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .stlist li {
        text-align: left;
        display: inline-block;
        width: 100%;
        padding: 0px 5px;
    }

    .stlist li span {
        width: 65%;
        float: right;
    }

    .stimg {
        /*margin-top: 5px;*/
        width: 80px;
        height: 80px;
        margin: 10px auto;
    }

    .stimg img {
        width: 100%;
        height: 100%;
        border-radius: 2px;
        border: 1px solid black;
        display: block;
        object-fit: cover;
    }

    .staround {
        padding: 3px 10px 3px 0;
        position: relative;
        overflow: hidden;
    }

    .staround2 {
        position: relative;
        z-index: 9;
    }

    .stbottom {
        background: #453278;
        height: 20px;
        width: 100%;
        clear: both;
        margin-bottom: 5px;
    }

    /*.stidcard{margin-top: 0px;
        color: #fff;font-size: 16px; line-height: 16px;
        padding: 2px 0 0; position: relative; z-index: 1;
        background: #453277;
        text-transform: uppercase;}*/
    .principal {
        margin-top: -40px;
        margin-right: 10px;
        float: right;
    }

    .stred {
        color: #000;
    }

    .spanlr {
        padding-left: 5px;
        padding-right: 5px;
    }

    .cardleft {
        width: 20%;
        float: left;
    }

    .cardright {
        width: 77%;
        float: right;
    }

    /* .pt15{padding-top: 15px;}
     .p10tb{padding-bottom: 10px; padding-top: 10px;}*/
    .width32 {
        width: 32.75%;
        padding: 3px;
        float: left;
    }

    /*END students id card*/
    .tcmybg {
        background-color: #ff0000;
    }
</style>

<?php
$school = $sch_setting[0];
$i = 0;
?>
<?php
// var_dump($id_card[0]->background);exit;
foreach ($students as $student) {
    $i++;
    ?>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="width32">
                <table cellpadding="0" cellspacing="0" width="100%" class="tc-container">
                    <!-- <tr>
                        <td valign="top">
                            <img  alt="hi" src="<?php //echo base_url('uploads/student_id_card/background/' . $id_card[0]->logo); ?>" class="tcmybg" />
                        </td>
                    </tr> -->
                    <tr>
                        <td valign="top">
                            <div class="studenttop" style="background: <?php echo $id_card[0]->header_color ?>">

                                <div class="sttext1"><img
                                        src="<?php echo base_url('uploads/student_id_card/logo/' . $id_card[0]->logo); ?>"
                                        width="30" height="30" />
                                </div>
                                <b>
                                    <?php echo $id_card[0]->school_name ?>
                                </b>
                            </div>
                            <?php //echo $id_card[0]->title ?>
                        </td>
                    </tr>
            </td>
        </tr>

        <tr>
            <td valign="top"
                style="color: #fff;font-size: 16px; padding: 2px 0 0; position: relative; z-index: 1;background: <?php echo $id_card[0]->header_color ?>;text-transform: uppercase;">
            </td>
        </tr>

        <tr>
            <td valign="top">
                <div class="staround">
                    <div class="cardcentre">
                        <style>
                            .cardcentre {
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            }

                            .stud_name {
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            }
                        </style>
                        <div class="stimg">
                            <img src="<?php echo base_url($student->image); ?>" class="img-responsive" />
                        </div>
                    </div>

                    <div>
                        <b>
                            <?php
                            if ($id_card[0]->enable_student_name == 1) {
                                echo $student->firstname . " " . $student->lastname;
                            }
                            ?>
                        </b>
                    </div>

                    <div class="carddet" style="text-align: center;margin-top: 10px;">
                        <div style="display: flex;align-items: center;justify-content: center;flex-direction: column;">

                            <table>
                                <tr>
                                    <td align="right">D.O.B:</td>
                                    <td>
                                        <b>
                                        <?php if ($id_card[0]->enable_dob == 1) {
                                            echo $student->dob;
                                        } ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">COURSE:</td>
                                    <td>
                                        <b>
                                        <?php if ($id_card[0]->enable_class == 1) {
                                            echo $student->class ;
                                        } ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">BATCH:</td>
                                    <td>
                                        <b>
                                        <?php
        if ($id_card[0]->enable_class == 1) {
            $admissionDate = $student->admission_date;
            $admissionYear = date('Y', strtotime($admissionDate));
            
            // Add 5 years to the admission year
            $courseDurationYear = $admissionYear + 5;
            
            echo             $admissionYear.'-'. $courseDurationYear;
        }
        ?>

                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">ADMISSION NO:</td>
                                    <td>
                                        <b>
                                        <?php if ($id_card[0]->enable_admission_no == 1) {
                                            echo $student->admission_no;
                                        } ?>
                                        </b>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <ul class="stlist">
                            <?php
                            /* if ($id_card[0]->enable_student_name == 1) { ?>
                                <li align="center">
                                        <span style="justify-content: center"
                                            ;>
                                            <?php echo $student->firstname . " " . $student->lastname; ?>
                                        </span>
                                </li>
                                <?php } 
                            
                            ?>

                            <?php if ($id_card[0]->enable_dob == 1) { ?>
                                <li>
                                    <div>
                                        D.O.B:
                                        <span>
                                            <?php echo $student->dob; ?>
                                        </span>
                                    </div>
                                </li>
                            <?php } ?>

                            <li>
                                <?php if ($id_card[0]->enable_class == 1) { ?>Class:<span>
                                        <?php echo $student->class . ' - ' . $student->section; ?>
                                    </span>
                                </li>
                            <?php } ?>

                            <li>
                                <?php if ($id_card[0]->enable_class == 1) { ?>Batch:<span>
                                        <?php echo $school['current_session']['session']; ?>
                                    </span>
                                </li>
                            <?php } ?>

                            <li>
                                <?php if ($id_card[0]->enable_admission_no == 1) { ?>Admission No:<span>
                                        <?php echo $student->admission_no; ?>
                                    </span>
                                </li>
                            <?php } 
                            */
                            ?>

                            <!-- Add more details as needed -->
                            <li>
                                <div
                                    style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
                                    <img style="text-align:center;"
                                        src="<?php echo base_url('uploads/student_id_card/signature/' . $id_card[0]->sign_image); ?>"
                                        width="50" />
                                    <p style="font-size: 10px;color:red;">Principal</p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </td>

        </tr>
        <tr>

            <?php /* 
        <tr>
            <td valign="top" align="right" class="principal">
                <img src="<?php echo base_url('uploads/student_id_card/signature/' . $id_card[0]->sign_image); ?>"
                    width="44" height="20" />Principal
            </td>

        </tr>
     */?>

        </tr>

        <tr>
            <td valign="top" align="center" style="padding: 10px; position: relative; z-index: 1;background-color:#13702a">
                <p style="font-size: 10px;color: white;">
                    <?php echo $id_card[0]->school_address ?>
                </p>

            </td>
        </tr>

    </table>
    </td>

    <?php
    if ($i == 3) {
        // three items in a row. Edit this to get more or less items on a row
        ?>
        </tr>
        <tr>
            <?php
            $i = 0;
    }
    ?>
    </tr>

    </table>
    <?php
}
?>