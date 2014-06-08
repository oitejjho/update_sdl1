<section class="wrapper" style="margin-top:-30px">    
    <div class="row" style="margin-left: 20px">
        <div class="row">
            <div class="col-lg-12" > 
                <!-- START TEST -->
                <?php
                foreach ($current_attendance as $today_dashboard) {
                    //$total_employee = round(($today_dashboard->Total_employee / $today_dashboard->Total_employee) * 100);
                    $present_view = round(($today_dashboard->Total_present / $today_dashboard->Total_employee) * 100);
                    $absent_view = round(($today_dashboard->Total_absent / $today_dashboard->Total_employee) * 100);
                    $on_leave = round(($today_dashboard->On_leave / $today_dashboard->Total_employee) * 100);
                    ?>
                    <div class="row-fluid hideInIE8">
                        <div class="span12">
                            <div class="circleStats">
                                <div class="col-lg-3" ontablet="span4" ondesktop="span2">
                                    <div class="circleStatsItemBox">
                                        <div class="header">মোট কর্মী</div>                            
                                        <span class="percent">শতাংশ</span>                            
                                        <div class="circleStat">
                                            <input type="text" value="<?php echo $today_dashboard->Total_employee; ?>" class="whiteCircle" />
                                        </div>		
                                        <div class="footer">
                                            <span class="count">
                                                <span class="number"><?php echo $today_dashboard->Total_employee; ?></span>
                                            </span>                               
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3" ontablet="span4" ondesktop="span2">
                                    <div class="circleStatsItemBox">
                                        <div class="header">মোট উপস্থিত</div>
                                        <span class="percent">শতাংশ</span>                            
                                        <div class="circleStat">                                
                                            <input type="text" value="<?php echo $present_view; ?>" class="whiteCircle" />
                                        </div>                            
                                        <div class="footer">
                                            <span class="count">
                                                <span class="number"><?php echo $today_dashboard->Total_present; ?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3" ontablet="span4" ondesktop="span2">
                                    <div class="circleStatsItemBox">
                                        <div class="header">মোট অনুপস্থিত</div>
                                        <span class="percent">শতাংশ</span>
                                        <div class="circleStat">
                                            <input type="text" value="<?php echo $absent_view; ?>" class="whiteCircle" />
                                        </div>
                                        <div class="footer">
                                            <span class="count">
                                                <span class="number"><?php echo $today_dashboard->Total_absent; ?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>                    
                                <div class="col-lg-3 noMargin" ontablet="span4" ondesktop="span2">
                                    <div class="circleStatsItemBox">
                                        <div class="header">ছুটিতে</div>
                                        <span class="percent">শতাংশ</span>
                                        <div class="circleStat">
                                            <input type="text" value="<?php echo $on_leave; ?>" class="whiteCircle" />
                                        </div>
                                        <div class="footer">
                                            <span class="count">
                                                <span class="number"><?php echo $today_dashboard->On_leave; ?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>                   
                            </div>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" >                 
                <div class="row">
                    <div class="col-lg-6" >            
                        <!--custom chart start-->
                        <div class="border-head">
                            <h3>সাপ্তাহিক উপস্থিত গ্রাফ রিপোর্ট (শেষ ৭ দিন এর জন্য)</h3>
                        </div>
                        <div class="custom-bar-chart">
                            <?php
                            $i = 0;
                            foreach ($tbl_dashboard_report as $view_dashboard) {
                                if ($i < 7) {
                                    $i++;
                                    $persent_view = round(($view_dashboard->Total_present / $view_dashboard->Total_employee) * 100);
                                    ?>
                                    <div class="bar">
                                        <div class="title"><?php echo date('d-M', strtotime($view_dashboard->Date)); ?></div>
                                        <div class="value tooltips" data-original-title="<?php echo $persent_view; ?>%" data-toggle="tooltip" data-placement="top"><?php echo $persent_view; ?>%</div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6" >            
                        <!--custom chart start-->
                        <div class="border-head">
                            <h3>সাপ্তাহিক অনুপস্থিত গ্রাফ রিপোর্ট (শেষ ৭ দিন এর জন্য)</h3>
                        </div>
                        <div class="custom-bar-chart">
                            <?php
                            $i = 0;
                            foreach ($tbl_dashboard_report as $view_dashboard) {
                                if ($i < 7) {
                                    $i++;
                                    $absent_view = round(($view_dashboard->Total_absent / $view_dashboard->Total_employee) * 100);
                                    ?>
                                    <div class="bar">
                                        <div class="title"><?php echo date('d-M', strtotime($view_dashboard->Date)); ?></div>
                                        <div class="value tooltips" data-original-title="<?php echo $absent_view; ?>%" data-toggle="tooltip" data-placement="top"><?php echo $absent_view; ?>%</div>
                                    </div>
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
<script>

    //owl carousel

    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true
        });
    });
    //custom select box
    $(function() {
        $('select.styled').customSelect();
    });
</script>
<!-- start: JavaScript-->
<script src="<?php echo base_url(); ?>js1/jquery-migrate-1.2.1.min.js"></script>	
<script src="<?php echo base_url(); ?>js1/jquery-ui-1.10.3.custom.min.js"></script>	
<script src="<?php echo base_url(); ?>js1/jquery.ui.touch-punch.js"></script>	    
<script src="<?php echo base_url(); ?>js1/jquery.knob.modified.js"></script>	
<script src="<?php echo base_url(); ?>js1/jquery.sparkline.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var a = $("div");
        $(".whiteCircle").knob({
            min: 0,
            max: 100,
            readOnly: true,
            width: 120,
            height: 120,
            bgColor: "rgba(255,255,255,0.5)",
            fgColor: "rgba(255,255,255,0.9)",
            dynamicDraw: true,
            thickness: 0.2,
            tickColorizeValues: true
        });
    });
</script>