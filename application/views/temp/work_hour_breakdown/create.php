<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script>
    $(document).ready(function() {
        $("#profile").validate({
            rules: {
                WorkHourName: "required",
                StartTime: "required",
                EndTime: "required",
                Conditional: "required",
                Priority: "required",
                TotalWorkingHour: "required",
                BasicStructure:"required"
            },
            messages: {
                WorkHourName: "Please enter work hour name",
                StartTime: "Please enter rewared amount",
                EndTime: "Please enter end time",
                Conditional: "Please enter condition",
                Priority: "Please enter priority",
                TotalWorkingHour: "Please enter total working hour",
                BasicStructure: "Please enter basic structure"
            }
        });

    });
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-timepicker.min.css"/>
<script src="<?php echo base_url(); ?>js/bootstrap-timepicker.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#id_StartTime').timepicker();
        $('#id_EndTime').timepicker();
    });

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form',
            'id' => 'profile'
        );
        echo form_open('con_set_work_hour_breakdown/insert', $attr);
        ?>
        <div class="form-group">
            <label for="WorkHourName" class="col-sm-2 control-label" >WorkHourName</label>
            <div class="col-sm-7">
                <input type="text" name="WorkHourName"  class="form-control" id="id_WorkHourName" placeholder="Enter WorkHourName">
            </div>
        </div>
        <div class="form-group">
            <label for="StartTime" class="col-sm-2 control-label" >StartTime</label>
            <div class="col-sm-3">
                <input type="text" name="StartTime"  class="form-control" id="id_StartTime" placeholder="Enter StartTime">
            </div>
            <label for="EndTime" class="col-sm-1 control-label" >EndTime</label>
            <div class="col-sm-3">
                <input type="text" name="EndTime"  class="form-control" id="id_EndTime" placeholder="Enter EndTime">
            </div>
        </div>        
        <div class="form-group">
            <label for="Conditional" class="col-sm-2 control-label" >Conditional</label>
            <div class="col-sm-7">
                <input type="text" name="Conditional"  class="form-control" id="id_Conditional" placeholder="Enter Conditional">
            </div>
        </div>
        <div class="form-group">
            <label for="Priority" class="col-sm-2 control-label" >Priority</label>
            <div class="col-sm-7">
                <input type="text" name="Priority"  class="form-control" id="id_Priority" placeholder="Enter Priority">
            </div>
        </div>
        <div class="form-group">
            <label for="TotalWorkingHour" class="col-sm-2 control-label" >TotalWorkingHour</label>
            <div class="col-sm-7">
                <input type="text" name="TotalWorkingHour"  class="form-control" id="id_TotalWorkingHour" placeholder="Enter TotalWorkingHour">
            </div>
        </div>
        <div class="form-group">
            <label for="BasicStructure" class="col-sm-2 control-label" >BasicStructure</label>
            <div class="col-sm-7">
                <input type="text" name="BasicStructure"  class="form-control" id="id_BasicStructure" placeholder="Enter BasicStructure">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-success">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class='col-lg-2'></div>
</div>
