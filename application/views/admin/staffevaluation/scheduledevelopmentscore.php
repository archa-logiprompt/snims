<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    .print, .print *
    {
        display: none;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
	<section class="content-header">
    	<h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
    	<div class="row">       
        	<div class="col-md-12">          
                
                    <div class="box box-info" id="timetable">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo "Staff Evaluation" ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="row print" >
                                <div class="col-md-12">
                                    <div class="col-md-offset-4 col-md-4">
                                        <center><b><?php echo $this->lang->line('class'); ?>: </b> <span class="cls"></span></center> 
                                    </div>
                                </div>
                            </div>
                             
                            
                                <div class="table-responsive">
                                	<div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?> </br>
										<?php echo $this->lang->line('class_timetable'); ?></div>
                                    	<table class="table table-bordered example">
                                        	<thead>
                                            	<tr>
                                                	<th>
                                                    	<?php echo "Allotted API Score (Total : 10)";?> 
                                                	</th>
                                                	 
                                                   
                                                     <th class="text text-center">
                                                        <?php echo "API Score Secured";?>
                                                    </th>
                                                      
                                                      
                                                      
                                                    
                                                 
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                             
                                            <tr>
                                            	<th>  </th>
                                                 
                                             </tr>
                                             
                                             <tr>
                                            	<th height="40"><?php echo "Departmental Schedule preparation Teaching & clinical : 2
";?> </th>
                                                <td><input type="text" id="lectures" name="lectures" class="form-control"/></td> 
                                                 
                                                 
                                                
                                             </tr> 
                                             <tr>
                                            	<th height="40"><?php echo "Documentation of conducting Teaching schedules : 2
";?> </th>
                                                <td><input type="text" id="lectures" name="lectures" class="form-control"/></td> 
                                                 
                                                 
                                                
                                             </tr> 
                                             <tr>
                                            	<th height="40"><?php echo "Documentation of conducting Clinical schedules : 2 
";?> </th>
                                                <td><input type="text" id="lectures" name="lectures" class="form-control"/></td> 
                                                 
                                                 
                                                
                                             </tr> 
                                              <tr>
                                            	<th height="40"><?php echo "Documentation of conducting Clinical schedules : 2 
";?> </th>
                                                <td><input type="text" id="lectures" name="lectures" class="form-control"/></td> 
                                                 
                                                 
                                                
                                             </tr> 
                                              <tr>
                                            	<th height="40"><?php echo "Monthly Statement submission to authorities : 2
";?> </th>
                                                <td><input type="text" id="lectures" name="lectures" class="form-control"/></td> 
                                                 
                                                 
                                                
                                             </tr> 
                                              <tr>
                                            	<th height="40"><?php echo "Yearly report compliance as per schedule : 2
";?> </th>
                                                <td><input type="text" id="lectures" name="lectures" class="form-control"/></td> 
                                                 
                                                 
                                                
                                             </tr> 
                                               
                                               
                                               
                                                 
                                                   
                                                    
                                             
                                                 
                                          
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                            </div>
                             
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
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });

                    $('#feetype_id').append(div_data);
                }
            });
        });
    });

    $(document).on('change', '#section_id', function (e) {
        $("form#schedule-form").submit();
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        var cls = $("#class_id option:selected").text();
        var sec = $("#section_id option:selected").text();
        $('.cls').html(cls + '(' + sec + ')');
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>