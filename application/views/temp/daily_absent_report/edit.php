<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-timepicker.min.css"/>
<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-timepicker.js"></script>
<script>
    $(document).ready(function() {
        $("#absentCorrectionEditForm").validate({
            rules: {
                InTime: {
                    required: true,
                    date: true
                },
                OutTime: {
                    required: true,
                    date: true
                }
            },
            messages: {
                InTime: {
                    required: "অনুগ্রহ করে গ্রবেশের সময় নির্বাচন করুন",
                    date: "অনুগ্রহ করে সঠিক তারিখ এবং সময় নির্বাচন করুন"
                },
                OutTime: {
                    required: "অনুগ্রহ করে বাহিরের সময় নির্বাচন করুন",
                    date: "অনুগ্রহ করে সঠিক তারিখ এবং সময় নির্বাচন করুন"
                }
            }
        });
    });
</script>

<div class='row'>
    <div class='col-lg-3'></div>
    <div class='col-lg-6'>
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4> 
                        পূর্ববর্তী অনুপস্থিতি সংশোধন করুন                
                    </h4>                
                </header> 
                <div class="panel-body">  
                    <?php
                    //$bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'id' => 'absentCorrectionEditForm'
                    );
                    echo form_open('con_pro_daily_absent_report/InsertAbsentEmployee', $attr);
                    foreach ($anEmployeeInfo as $employee) {
                        ?>
                        <input type="hidden" name="CardNo" value="<?php $employee['CardNo']; ?>"/>
                        <div class="form-group">
                            <label for="CardNo" class="col-sm-3 control-label" >কার্ড নং</label>
                            <div class="col-sm-9">
                                <input type="text" name="CardNo"  class="form-control" id="CardNo" value="<?php echo $employee['CardNo']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Name" class="col-sm-3 control-label" >নাম</label>
                            <div class="col-sm-9">
                                <input type="text" name="Name"  class="form-control" id="Name" value="<?php echo $employee['Name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Department" class="col-sm-3 control-label" >সেকশন</label>
                            <div class="col-sm-9">
                                <input type="text" name="Department"  class="form-control" id="Department" value="<?php echo $employee['Department']; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="InTime" class="col-sm-3 control-label" >প্রবেশের সময়</label>
                            <div class="col-sm-9">
                                <input type="text" name="InTime"  class="form-control" id="InTime" >
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="OutTime" class="col-sm-3 control-label" >বাহিরের সময়</label>
                            <div class="col-sm-9">
                                <input type="text" name="OutTime"  class="form-control" id="OutTime" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" name="update"  class="btn btn-primary" id="update" value="সংশোধন করুন">
                            </div>
                        </div>
                        <?php
                    }
                    echo form_close();
                    ?>
                </div>
            </div>
        </section>        
    </div>
    <div class='col-lg-3'>
    </div>
</div>