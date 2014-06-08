
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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
                url: "<?php echo base_url(); ?>con_pro_first_half_attendance_log/get_department_name",
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
                    url: "<?php echo base_url(); ?>con_pro_first_half_attendance_log/get_line_name",
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
        
        $('#validateSearchForm').submit(function(){
            var department = $('#DepartmentSection').val();
            var date = $('#Date').val();
            if(department == ''){
                alert('অনুগ্রহ করে বিভাগ নির্বাচন করুন');
                return false;
            }
            if(date == ''){
                alert('অনুগ্রহ করে তারিখ নির্বাচন করুন');
                return false;
            }            
        });

    });
</script>
<div class="row">   
    <div class="col-lg-12">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4> 
                        বিভাগ দ্বারা অনুসন্ধান  করুন                    
                    </h4>                
                </header> 
                <div class="panel-body">
                    <?php
                    $attributes = array(
                        'class' => 'form-inline',
                        'role' => 'form',
                        'id' => 'validateSearchForm'
                    );
                    echo form_open('con_pro_first_half_attendance_log/search', $attributes);
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
                        <select class="form-control" name="Floor" id="Floor">
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
    </div>    
</div>
<div class="row"> 
    <div class="col-lg-12">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4>
                        দৈনিক প্রথম অর্ধেক উপস্থিতির তালিকা 
                        <button class="btn btn-default" type="submit" name="xlexport"><img src="<?php echo base_url(); ?>images/Excel-icon.png" alt="Excel Export" width="16" height="16"/> Excel Export</button>
                    </h4>                
                </header> 
                <table class="table table-striped border-top" id="daily_log" border="1" style="font-size: 10px;">
                    <thead>
                        <tr style="font-size: 18px;">
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>     
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> নাম</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> বিভাগ/সেকশন</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> লাইন/ইউনিট</th>                    
                            <th><i class="glyphicon glyphicon-time"></i> প্রবেশ সময়</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="font-size: 18px;">
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>     
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> নাম</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> বিভাগ/সেকশন</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> লাইন/ইউনিট</th>                    
                            <th><i class="glyphicon glyphicon-time"></i> প্রবেশ সময়</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($tbl_first_half_log_report as $rec_mismatch_report) { ?>
                            <tr style="font-size: 15px;">
                                <td><?php echo $rec_mismatch_report['BuildingName']; ?></td>
                                <td><?php echo $rec_mismatch_report['Department']; ?></td>
                                <td><?php echo $rec_mismatch_report['Line']; ?></td>
                                <td><?php echo $rec_mismatch_report['CardNo']; ?></td>
                                <td><?php echo $rec_mismatch_report['Name']; ?></td>
                                

                                <td><?php
                                echo date('d-m-Y H:i:s', strtotime($rec_mismatch_report['InTime']));
                                    //echo date('d-m-Y H:i:s', strtotime('+6 hours', strtotime(date('d-m-Y H:i:s', strtotime($rec_mismatch_report['InTime'])))));
                                    ?>
                                </td>                            
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.css"></script>
<script src="<?php echo base_url(); ?>js/jquery.dataTables1.js"></script>
<script>

    $(document).ready(function() {
        var table = $('#daily_log').DataTable();

        $("#daily_log tfoot th").each(function(i) {
            var select = $('<select><option value=""></option></select>')
                    .appendTo($(this).empty())
                    .on('change', function() {
                        table.column(i)
                                .search($(this).val())
                                .draw();
                    });

            table.column(i).data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });
    });
</script>