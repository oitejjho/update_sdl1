<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#StartTime').timepicker({
            minuteStep: 1,
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
        // $('#EndTime').timepicker();

        $('#EndTime').timepicker({
            minuteStep: 1,
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });

    });
</script>

<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Update Work Hour Breakdown</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form'
                    );
                    echo form_open('con_set_work_hour_breakdown/update', $attr);
                    foreach ($tbl_work_hour_breakdown as $rec_work_hour_breakdown)
                        
                        ?>
                    <input type="hidden" name="ID" value="<?php echo $rec_work_hour_breakdown->ID; ?>"/>
                    <div class="form-group">
                        <label for="WorkHourName" class="col-sm-2 control-label" >Work Hour Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="WorkHourName"  class="form-control" id="id_WorkHourName" value="<?php echo $rec_work_hour_breakdown->WorkHourName; ?>">
                        </div>
                    </div>            
                    <div class="form-group">
                        <label for="StartTime" class="col-sm-2 control-label" >Start Time</label>            
                        <div class="col-sm-7 input-append bootstrap-timepicker" >            	
                            <input type="text" name="StartTime"  class="form-control" id="StartTime" value="<?php echo $rec_work_hour_breakdown->StartTime; ?>">
                            <span class="add-on"><i class="icon-time"></i></span>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label for="EndTime" class="col-sm-2 control-label" >End Time</label>
                        <div class="col-sm-7 input-append bootstrap-timepicker" >            	
                            <input type="text" name="EndTime"  class="form-control" id="EndTime" value="<?php echo $rec_work_hour_breakdown->EndTime; ?>">
                            <span class="add-on"><i class="icon-time"></i></span>
                        </div>
                    </div>            
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" name="update"  class="btn btn-primary" id="update" value="Update">
                        </div>
                    </div>
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">View Work Hour Breakdown</div>
                <div class="panel panel-body">
                    <table class="table table-condensed table-bordered table-hover">
                        <thead>
                            <tr class="active">
                                <th><i class="icon icon-edit"></i> SL</th>
                                <th><i class="icon icon-edit"></i> Work Hour Name</th>
                                <th><i class="icon icon-time"></i> Start Time</th>
                                <th><i class="icon icon-time"></i> End Time</th>
                                <th><i class="icon icon-time"></i> Total Working Hour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($tbl_work_hour_breakdown as $rec_work_hour_breakdown) {
                                ?>
                                <tr class="success">
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $rec_work_hour_breakdown->WorkHourName; ?> </td>
                                    <td><?php echo $rec_work_hour_breakdown->StartTime; ?> </td>
                                    <td><?php echo $rec_work_hour_breakdown->EndTime; ?> </td>
                                    <td><?php echo $rec_work_hour_breakdown->TotalWorkingHour; ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-2'></div>
</div>