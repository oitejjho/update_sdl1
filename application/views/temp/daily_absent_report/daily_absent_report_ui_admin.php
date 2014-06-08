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
                data: "Building=" + building + '&Floor' + floor,
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
                    data: "Department=" + department + '&Building' + building + '&Floor' + floor,
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
        
        $('#absentSearchForm').submit(function(){
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
<?php
$month = array(
    '1' => 'জানুয়ারী',
    '2' => 'ফেব্রুয়ারী ',
    '3' => 'মার্চ',
    '4' => 'এপ্রিল',
    '5' => 'মে',
    '6' => 'জুন',
    '7' => 'জুলাই',
    '8' => 'অগাস্ট',
    '9' => 'সেপ্টেম্বর',
    '10' => 'অক্টোবর',
    '11' => 'নভেম্বর',
    '12' => 'ডিসেম্বর'
);
?>
<div class="row">   
    <div class="col-md-12">
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
                        'role' => 'form',
                        'id' => 'absentSearchForm'
                    );
                    echo form_open('con_pro_daily_absent_report/search', $attributes);
                    ?>

                    <div class="form-group">
                        <label for="Building"></label>
                        <select class="form-control" name="Building" id="Building" disabled>
                            <option value="<?php echo $this->session->userdata('BuildingName') ?>"><?php echo $this->session->userdata('BuildingName') ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Floor"></label>
                        <select class="form-control" name="Floor" id="Floor">
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
    <div class="col-md-12">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4>
                        দৈনন্দিন অনুপস্থিত প্রতিবেদন তালিকা                         
                    </h4>                
                </header>                 
                <div class="panel panel-body">
                    <table class="table table-striped table-advance table-hover" id="daily_log" border="1">
                        <thead>
                            <tr>
                                <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>                    
                                <th><i class="glyphicon glyphicon-edit"></i> নাম</th>
                                <th><i class="glyphicon glyphicon-edit"></i> ভবনের নাম</th>
                                <th><i class="glyphicon glyphicon-edit"></i> ফ্লোর</th>                    
                                <th><i class="glyphicon glyphicon-edit"></i> বিভাগ</th>     
                                <th><i class="glyphicon glyphicon-edit"></i> লাইন</th>                                                                                  
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tbl_absent_report as $rec_absent_report) { ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $rec_absent_report['CardNo']; ?></td>
                                    <td><?php echo $rec_absent_report['Name']; ?></td>
                                    <td><?php echo $rec_absent_report['BuildingName']; ?></td>
                                    <td><?php echo $rec_absent_report['Floor']; ?></td>
                                    <td><?php echo $rec_absent_report['Department']; ?></td>
                                    <td><?php echo $rec_absent_report['Line']; ?></td>                                                               
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>    
</div>
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