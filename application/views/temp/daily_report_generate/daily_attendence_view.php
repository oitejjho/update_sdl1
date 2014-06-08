<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Date').datepicker();
    });
</script>
<script>
    $(document).ready(function() {
        var building = $('#Building').val();
        var floor = $('#Floor').val();
        if (building == '') {
            alert('আপনার বিভাগ/সেকশন নাম অনুপস্থিত');
        } else if (floor == '') {
            alert('আপনার ফ্লোরের নাম অনুপস্থিত');
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>con_pro_attn_mismatch_report/get_department_name",
                data: "BuildingName=" + building + '&Floor' + floor,
                success: function(data)
                {
                    var mySelect = $('#DepartmentSection');
                    mySelect.append("<option value=''>বিভাগ/সেকশন নির্বাচন  করুন</option>");
                    $.each(data, function(v, k) {
                        mySelect.append("<option value='" + k.Department + "'>" + k.Department + "</option>");
                    });
                }, dataType: 'json'
            });
        }

        $('#DepartmentSection').on('change', function(e) {
            var department = $(this).val();
            if (department == 0) {
                alert('অনুগ্রহ করে বিভাগ/সেকশন নির্বাচন  করুন');
                var line = $('#LineUnit');
                line.html("<option value=''>প্রথমে বিভাগ/সেকশন নির্বাচন  করুন</option>");
            } else {
                var building = $('#Building').val();
                var floor = $('#Floor').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_pro_attn_mismatch_report/get_line_name",
                    data: "DepartmentName=" + department + '&BuildingName' + building + '&Floor' + floor,
                    success: function(data)
                    {
                        var mySelect = $('#LineUnit');
                        mySelect.html('');
                        mySelect.append("<option value=''>লাইন/ইউনিট নির্বাচন  করুন</option>");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.Line + "'>" + k.Line + "</option>");
                        });
                    }, dataType: 'json'
                });
            }
        });

    });
</script>
<!-- page start-->
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4> 
                        বিভাগ দ্বারা  অনুসন্ধান  করুন                    
                    </h4>                
                </header> 
                <div class="panel-body">
                    <?php
                    $attributes = array(
                        'class' => 'form-inline',
                        'role' => 'form'
                    );
                    echo form_open('con_pro_attn_mismatch_report/search', $attributes);
                    ?>
                    <div class="form-group">
                        <label for="Building"></label>
                        <select class="form-control" name="Building" id="Building" disabled>
                            <!--                            <option value="">বিল্ডিং নির্বাচন  করুন</option>
                                                        <option value="">------------------</option>-->
                            <option value="<?php echo $this->session->userdata('BuildingName') ?>"><?php echo $this->session->userdata('BuildingName') ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Floor"></label>
                        <select class="form-control" name="Floor" id="Floor" disabled>
                            <!--                            <option>ফ্লোর নির্বাচন  করুন</option>-->
                            <option value="<?php echo $this->session->userdata('Floor') ?>"><?php echo $this->session->userdata('Floor') ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="DepartmentSection"></label>
                        <select class="form-control" name="DepartmentSection" id="DepartmentSection">                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="LineUnit"></label>
                        <select class="form-control" name="LineUnit" id="LineUnit">                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Date"></label>
                        <input type="text" name="Date" id="Date" class="form-control" placeholder="তারিখ নির্বাচন  করুন"/>
                    </div>                 
                    <button class="btn btn-success" type="submit" style="margin-top: 18px;"><i class="glyphicon glyphicon-search"></i> Search</button>                                    
                    <?php echo form_close(); ?>
                </div>
            </div>
        </section>
        <section class="panel">
            <fieldset>
                <legend>Daily Attendance Log</legend>
            </fieldset>
            <table class="table table-striped border-top" id="daily_log">
                <thead>
                    <tr class="active">
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Card No</th>
                        <th>Total Worked Hour</th>
                        <th>General Working Hour</th>
                        <th>Over Time Hour</th>
                        <th>Additional Over Time Hour</th>
                        <th>Night Shift Over Time Hour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($tbl_daily_attendance_log as $rec_daily_attendance_log) {
                        ?>
                        <tr class="success">
                            <td><?php echo $count++; ?></td>                       
                            <td><?php echo $rec_daily_attendance_log->Date; ?> </td>
                            <td><?php echo $rec_daily_attendance_log->CardNo ?> </td>
                            <td><?php echo $rec_daily_attendance_log->TotalWorkedHour; ?> </td>
                            <td><?php echo $rec_daily_attendance_log->GenarelWorkHour; ?> </td>
                            <td><?php echo $rec_daily_attendance_log->OverTimeHour; ?> </td>
                            <td><?php echo $rec_daily_attendance_log->AdditionalOverTimeHour; ?> </td>
                            <td><?php echo $rec_daily_attendance_log->NihgtShiftOverTimeHour; ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
<!-- page end-->
<script>
    $('#daily_log').dataTable({
        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            }
        },
        "aoColumnDefs": [{
                'bSortable': true,
                'aTargets': [0]
            }]
    });
</script>