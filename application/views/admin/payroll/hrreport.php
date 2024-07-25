<style type="text/css">
    .nav-tabs-custom>.nav-tabs>li.active {
        border-top-color: #faa21c;
    }
	
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url('admin/payroll/hrreport') ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label><?php echo $this->lang->line('role'); ?></label>
                                            <select name="role" class="form-control">
                                                <option value="select"><?php
                                                    echo $this->lang->line(
                                                            'select')
                                                    ?></option>
                                                <?php foreach ($role as $rolekey => $rolevalue) { ?>
                                                    <option <?php
                                                        if ($rolevalue["id"] == $role_select) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?php echo $rolevalue["id"] ?>"><?php echo $rolevalue["type"]; ?></option>
<?php } ?>   
                                            </select>
                                            <span class="text-danger"><?php echo form_error('role'); ?></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <label><?php echo $this->lang->line('month'); ?></label>
                                        <!--    <select name="month" class="form-control">
                                                <option value=""><?php
                                                    echo $this->lang->line(
                                                            'select')
?></option>
                                                    <?php foreach ($monthlist as $monthkey => $monthvalue) { ?>
                                                    <option <?php
                                                    if ($month == $monthvalue) {
                                                        echo "selected";
                                                    }
                                                    ?> value="<?php echo $monthkey; ?>"><?php echo $monthvalue; ?></option>
<?php } ?>   
                                            </select>-->
                                            <select name="month" class="form-control">
                                                <option value=""><?php
                                                    echo $this->lang->line(
                                                            'select')
?></option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
 
                                            </select>
                                            
                                            <span class="text-danger"><?php echo form_error('month'); ?></span>
                                        </div>
                                     
                                        <div class="col-sm-4">
                                            <label><?php echo $this->lang->line('year'); ?></label>
                                            <select name="year" class="form-control">
                                                <option value=""><?php
                                                    echo $this->lang->line(
                                                            'select')
                                                    ?></option>
                                  <?php foreach ($yearlist as $yearkey => $yearvalue) { 
//var_dump('$yearvalue');

?>

                                                    <option <?php
                                       if (($year == $yearvalue["year"]) || ($yearvalue["year"] == date("Y"))) {
                                                echo "selected";
                                          }
                            ?> value="<?php echo $yearvalue["year"]; ?>"><?php echo $yearvalue["year"]; ?></option>
<?php } ?>   
                                            </select>
                                            <span class="text-danger"><?php echo form_error('year'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<?php if (isset($result)) {
    ?>
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo 'HR Report'; ?></h3>
                        </div>      
                        <div class="box-body table-responsive">     
                            <div class="tab-content">
                                <div class="tab-pane active table-responsive" id="tab_parent">
                                    <!--<div class="download_label"><?php //echo $this->lang->line('payroll'); ?> <?php //echo $this->lang->line('report_for'); ?> <?php// echo $month . " " . $year; ?></div>-->
                                    <table class="table table-striped table-bordered table-hover example table-fixed-header">
                                        <thead class="header">
                                            <tr>



                                                <th><?php echo 'SI#'; ?></th>
                                                <th><?php echo 'Employee Name'; ?></th>
                                                <th><?php echo 'Employee Code' ?></th>
                                                <th><?php echo 'Designation' ?></th>
                                                <th><?php echo 'Department'; ?></th>
                                                 
                                                
                                            <?php
                                            foreach ($res as $rest) {
                                                ?>  <th>  
                                           <?php echo $rest['type'] ?>
                                           
                                                     </th>
                                                        <?php
                                                    }
                                                    ?>
                                                <th><?php echo 'Actual Days Worked'; ?></th>
                                                <th><?php echo 'Lop-Current Month'; ?></th>
                                                <th><?php echo 'Eligible Working Days For Salary'; ?></th>
                                        </thead>
                                       
                                         <?php 
                                            foreach ($result as $key => $value) {
?>
                                                   <td></td>
                                                   
                                                   <td style="text-transform: capitalize;">
                                                        <span data-toggle="popover" class="detail_popover" data-original-title="" title=""><a href="#"><?php echo $value['employ_name']; ?></a></span></td>
                                                        <td>
                                                       <?php echo ": " . $value['employ_code']; ?></div>
                                                    </td>
                                                    <td>
            <?php echo $value['user_type']; ?>
                                                    </td>
                                                  
                                                    <td>
                                                        <span  data-original-title="" title=""><?php echo $value['department'];
            ;
            ?></span>

                                                    </td>
                                                     <?php
                                            foreach ($res as $rest) {
                                                ?>  <td>  
                                      <?php $c=leavecount($value['id'],$rest['id'],$month,$year);
									  
									     echo $c;
									   ?>
                                              
                                                     </td>
                                                       <?php
                                                    }
                                                    ?>
                                                   <?php ?>  <td>  
                                      <?php $m=actualwork($value['id'],$month,$year);
									  
									     echo $m;
									   ?>
                                             
                                                     </td>
                                                        
                                                    
                                                   <?php ?>  <td>  
                                      <?php $l=lopmonth($value['id'],$month,$year);
									  
									     echo $l;
									   ?>
                                             
                                                     </td>
                                                         
                                                    <?php ?>  <td>  
                                      <?php $q=salarys($value['id'],$month,$year);
									  
									     echo $q;
									   ?>
                                             
                                                     </td>
                                                       
                                                <?php /*?><td>  
                                      <span  data-original-title="" title=""><?php echo $work['leave_days'];
            	
            ?></span>
                                           
                                                     </td><?php */?>
                                                  

                                                    
                                                   
                                                    
                                                </tr>
            <?php
           // $count++;
        }
        ?>
                                           <!-- <tr class="box box-solid total-bg">

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right"><?php //echo $this->lang->line('grand_total'); ?> </td>
                                                <td class="text text-right"><?php //echo ($currency_symbol . number_format($basic, 2, '.', '')); ?></td>

                                                <td class="text text-right"><?php //echo ($currency_symbol . number_format($earnings, 2, '.', '')); ?></td>
                                                <td class="text text-right"><?php // echo ($currency_symbol . number_format($deduction, 2, '.', '')); ?></td>
                                                <td class="text text-right"><?php //echo ($currency_symbol . number_format($gross, 2, '.', '')); ?></td>
                                                <td class="text text-right"><?php //echo ($currency_symbol . number_format($tax, 2, '.', '')); ?></td>
                                                <td class="text text-right"><?php //echo ($currency_symbol . number_format($net, 2, '.', '')); ?></td>



                                            </tr>-->
                    <?php } ?>
                                        </tbody>
                                    </table>
                                </div>    


                            </div>

                        </div>
                    </div><!--./tabs--> 
    <?php

?>
            </div>  
        </div>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $(".date").datepicker({
            format: date_format,
            autoclose: true,
            todayHighlight: true
        });
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    })
    $(document).ready(function () {
        $('.table-fixed-header').fixedHeader();
    });

    (function ($) {

        $.fn.fixedHeader = function (options) {
            var config = {
                topOffset: 50

            };
            if (options) {
                $.extend(config, options);
            }

            return this.each(function () {
                var o = $(this);

                var $win = $(window);
                var $head = $('thead.header', o);
                var isFixed = 0;
                var headTop = $head.length && $head.offset().top - config.topOffset;

                function processScroll() {
                    if (!o.is(':visible')) {
                        return;
                    }
                    if ($('thead.header-copy').size()) {
                        $('thead.header-copy').width($('thead.header').width());
                    }
                    var i;
                    var scrollTop = $win.scrollTop();
                    var t = $head.length && $head.offset().top - config.topOffset;
                    if (!isFixed && headTop !== t) {
                        headTop = t;
                    }
                    if (scrollTop >= headTop && !isFixed) {
                        isFixed = 1;
                    } else if (scrollTop <= headTop && isFixed) {
                        isFixed = 0;
                    }
                    isFixed ? $('thead.header-copy', o).offset({
                        left: $head.offset().left
                    }).removeClass('hide') : $('thead.header-copy', o).addClass('hide');
                }
                $win.on('scroll', processScroll);

                // hack sad times - holdover until rewrite for 2.1
                $head.on('click', function () {
                    if (!isFixed) {
                        setTimeout(function () {
                            $win.scrollTop($win.scrollTop() - 47);
                        }, 10);
                    }
                });

                $head.clone().removeClass('header').addClass('header-copy header-fixed').appendTo(o);
                var header_width = $head.width();
                o.find('thead.header-copy').width(header_width);
                o.find('thead.header > tr:first > th').each(function (i, h) {
                    var w = $(h).width();
                    o.find('thead.header-copy> tr > th:eq(' + i + ')').width(w);
                });
                $head.css({
                    margin: '0 auto',
                    width: o.width(),
                    'background-color': config.bgColor
                });
                processScroll();
            });
        };

    })(jQuery);

</script>
