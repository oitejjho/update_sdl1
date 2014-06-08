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
        $("#mismatchCorrectionEditForm").validate({
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
                        পূর্ববর্তী উপস্থিতি অমিল সংশোধন করুন                
                    </h4>                
                </header> 
                <div class="panel-body">  
                    <?php
                    //$bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'id' => 'mismatchCorrectionEditForm'
                    );
                    echo form_open('con_pro_attn_mismatch_report/insert1', $attr);
                    foreach ($tbl_mismatch_report as $rec_mismatch_report) {
                        ?>
                        <input type="hidden" name="CardNo" value="<?php $rec_mismatch_report->CardNo; ?>"/>
                        <div class="form-group">
                            <label for="CardNo" class="col-sm-3 control-label" >কার্ড নং</label>
                            <div class="col-sm-9">
                                <input type="text" name="CardNo"  class="form-control" id="CardNo" value="<?php echo $rec_mismatch_report->CardNo; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Percentage" class="col-sm-3 control-label" >নাম</label>
                            <div class="col-sm-9">
                                <input type="text" name="Percentage"  class="form-control" id="id_Percentage" value="<?php echo $rec_mismatch_report->Name; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Head" class="col-sm-3 control-label" >সেকশন</label>
                            <div class="col-sm-9">
                                <input type="text" name="Head"  class="form-control" id="id_Head" value="<?php echo $rec_mismatch_report->Department; ?>" readonly>
                            </div>
                        </div>

                        <?php //if($rec_mismatch_report->DateTime < date('Y-m-d', strtotime($rec_mismatch_report->DateTime))." 05:59:59"){ ?>
                        <div class="form-group">
                            <label for="InTime" class="col-sm-3 control-label" >প্রবেশের সময়</label>
                            <div class="col-sm-9">
                                <input type="text" name="InTime"  class="form-control" id="InTime" value="<?php if ($rec_mismatch_report->DateTime < date('Y-m-d', strtotime($rec_mismatch_report->DateTime)) . " 05:59:59") echo date('Y-m-d H:i:s', strtotime('+6 hours', strtotime($rec_mismatch_report->DateTime))); ?>">
                            </div>
                        </div>
                        <?php //}else{ ?>
                        <div class="form-group">
                            <label for="OutTime" class="col-sm-3 control-label" >বাহিরের সময়</label>
                            <div class="col-sm-9">
                                <input type="text" name="OutTime"  class="form-control" id="OutTime" value="<?php if ($rec_mismatch_report->DateTime >= date('Y-m-d', strtotime($rec_mismatch_report->DateTime)) . " 05:59:59") echo date('Y-m-d H:i:s', strtotime('+6 hours', strtotime($rec_mismatch_report->DateTime))); ?>">
                            </div>
                        </div>
                        <?php // } ?>
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