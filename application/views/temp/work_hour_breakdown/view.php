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
<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#profile").validate({
            rules: {
                WorkHourName: "required",
                StartTime: "required",
                EndTime: "required"
            },
            messages: {
                WorkHourName: "Please enter work hour name",
                StartTime: "Please enter start time",
                EndTime: "Please enter end time"
            }
        });

    });
</script>
<div class='row'>
    <?php
    if ($this->session->flashdata('msg')) {
        ?>
        <script>
            $(document).ready(function() {
                $('#myModal').modal('show');
            });
        </script>
        <?php
    }
    ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Status....</h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>                    
                </div>
            </div>
        </div>
    </div>

    <div class='col-lg-1'></div>
    <div class='col-lg-10'>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Create Work Hour Breakdown</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'id' => 'profile'
                    );
                    echo form_open('con_set_work_hour_breakdown/insert', $attr);
                    ?>
                    <div class="form-group">
                        <label for="WorkHourName" class="col-sm-2 control-label" >Work Hour Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="WorkHourName"  class="form-control" id="WorkHourName" placeholder="Enter Work Hour Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="StartTime" class="col-sm-2 control-label" >Start Time</label>            
                        <div class="col-sm-7 input-append bootstrap-timepicker">            	
                            <input type="text" name="StartTime"  class="form-control" id="StartTime" placeholder="Enter Start Time">
                            <span class="add-on"><i class="icon-time"></i></span>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label for="EndTime" class="col-sm-2 control-label" >End Time</label>
                        <div class="col-sm-7 input-append bootstrap-timepicker">            	
                            <input type="text" name="EndTime"  class="form-control" id="EndTime" placeholder="Enter End Time">
                            <span class="add-on"><i class="icon-time"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
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
                                <th><i class="icon icon-edit"></i> Sl</th>
                                <th><i class="icon icon-edit"></i> Work Hour Name</th>
                                <th><i class="icon icon-time"></i> Start Time</th>
                                <th><i class="icon icon-time"></i> End Time</th>
                                <th><i class="icon icon-edit"></i> Total Working Hour</th>
                                <th><i class="icon icon-rocket"></i> Action</th>
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
                                    <td><?php echo date('H:i:s', strtotime($rec_work_hour_breakdown->EndTime)) - date('H:i:s', strtotime($rec_work_hour_breakdown->StartTime)); ?> </td>
                                    <td>
                                        <?php echo form_open('con_set_work_hour_breakdown/edit'); ?>
                                        <input type="hidden" name="ID" id="ID" value="<?php echo $rec_work_hour_breakdown->ID; ?>"/>
                                        <button class="btn btn-primary btn-xs" name="submit" value="edit"><i class="icon icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" name="submit" value="delete" onclick="return confirm('Are u sure u want to delete')"><i class="icon icon-trash"></i></button>
                                        <?php echo form_close(); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-1'></div>
</div>