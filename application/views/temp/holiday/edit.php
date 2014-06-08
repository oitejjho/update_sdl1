<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-datepicker/css/datepicker.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Date').datepicker();
    });
</script>
<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <div class="panel-primary">
            <header class="panel-heading" >
                <h4>ছুটির নাম এবং তারিখ সংশোধন  করুন</h4> 
            </header>
            <div class="panel panel-body">
                <?php
                $attr = array(
                    'class' => 'form-horizontal',
                    'role' => 'form'
                );
                echo form_open('con_set_holiday/update', $attr);
                foreach ($tbl_holiday as $rec_holiday) {
                    ?>
                    <input type="hidden" name="previousdate" value="<?php echo $rec_holiday->HolidayDate; ?>"/>
                    <div class="form-group">
                        <label for="HolidayDate" class="col-sm-3 control-label" >ছুটির তারিখ</label>
                        <div class="col-sm-4 date" id="Date" data-date="<?php echo date('Y-m-d', strtotime($rec_holiday->HolidayDate)); ?>" data-date-format="yyyy-mm-dd">                       
                            <input type="text" name="HolidayDate"  class="form-control"  value="<?php echo date('d-m-Y', strtotime($rec_holiday->HolidayDate)); ?>">
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Category" class="col-sm-3 control-label" >ছুটির ধরণ</label>
                        <div class="col-sm-9">
                            <input type="text" name="Category"  class="form-control" id="id_Category" value="<?php echo $rec_holiday->Category; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-success">সংশোধন</button>
                        </div>
                    </div>
                    <?php
                }
                echo form_close();
                ?>
            </div>
        </div>
        <div class="panel-primary">
            <header class="panel-heading" >
                <h4>বাৎসরিক বরাদ্দকৃত ছুটির তালিকা</h4> 
            </header>
            <div class="panel panel-body">
                <table class="table table-condensed table-bordered table-hover">
                    <thead>
                    <th><i class="icon icon-calendar"></i> ছুটির তারিখ</th>
                    <th><i class="icon icon-user"></i> ছুটির নাম</th>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($tbl_holiday as $rec_holiday) {
                            ?>                    
                            <tr>
                                <td><?php echo date('d-m-Y', strtotime($rec_holiday->HolidayDate)); ?> </td>
                                <td><?php echo $rec_holiday->Category; ?> </td>                            
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
    <div class='col-lg-2'>
    </div>
</div>
