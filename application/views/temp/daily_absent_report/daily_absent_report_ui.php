<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Date').datepicker({
            format: 'dd-mm-yyyy'
        });
    });
</script>

<div class="row">   
    <div class="col-lg-12">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4> 
                        সময়সূচী দ্বারা অনুসন্ধান  করুন                     
                    </h4>                
                </header> 
                <div class="panel-body">
                    <?php
                    $attributes = array(
                        'class' => 'form-inline',
                        'role' => 'form',
                        'id' => 'validateSearchForm'
                    );
                    echo form_open('con_pro_daily_absent_report/Search', $attributes);
                    ?>
                    <div class="form-group">
                        <label for="Date"></label>
                        <input type="text" name="Date" id="Date" class="form-control" placeholder="তারিখ নির্বাচন  করুন" value="<?php echo date('m-d-Y', strtotime($showDate)); ?>" />
                    </div>                 
                    <button class="btn btn-success" type="submit" style="margin-top: 18px;"><i class="glyphicon glyphicon-search"></i> অনুসন্ধান করুন</button>                                    
<?php echo form_close(); ?>
                </div>
            </div>
        </section>
    </div>    
</div>

<div class="row">     
    <div class="col-md-12">
        <section class="panel panel-body">
            <div class="text-center">
                <h5><strong>  দৈনন্দিন অনুপস্থিতির রিপোর্ট  বের করার জন্য বাটনটি চাপুন</strong></h5>
                <?php
                $attributes = array(
                    'class' => 'form-inline',
                    'role' => 'form',
                    'id' => 'excelExport'
                );
                echo form_open('con_pro_daily_absent_report/excelExport', $attributes);
                ?>
                <input type="hidden" name="hDate" value="<?php echo $showDate;?>"/>
                <button class="btn btn-info" type="submit" name="xlexport"><img src="<?php echo base_url(); ?>images/Excel-icon.png" alt="Excel Export" width="16" height="16"/> এক্সেল  এক্সপোর্ট করুন</button>
                <?php
                echo form_close();
                ?>
            </div><hr/>
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4>
                        দৈনন্দিন অনুপস্থিত প্রতিবেদন তালিকা                         
                    </h4>                
                </header>                 

                <table class="table table-striped table-advance table-condensed table-bordered" id="daily_log" style="margin-top: 5px;">
                    <thead>
                        <tr>
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> নাম</th>
<!--                                <th><i class="glyphicon glyphicon-edit"></i> ভবনের নাম</th>
                            <th><i class="glyphicon glyphicon-edit"></i> ফ্লোর</th>                    -->
                            <th><i class="glyphicon glyphicon-edit"></i> বিভাগ</th>     
<!--                                <th><i class="glyphicon glyphicon-edit"></i> লাইন</th> -->
                            <th><i class="icon icon-pencil"></i> সংশোধন</th>

                        </tr>
                    </thead>
                        <tfoot>
                        <tr>
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>
                            <th><i class="glyphicon glyphicon-edit"></i> নাম</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> বিভাগ</th>
                        </tr>
                    </tfoot>
                    <tbody>
<?php foreach ($tbl_absent_report as $rec_absent_report) { ?>
                            <tr>         
                                <td><?php echo $rec_absent_report['CardNo']; ?></td>
                                <td><?php echo $rec_absent_report['Name']; ?></td>
    <!--                                    <td><?php //echo $rec_absent_report['BuildingName'];   ?></td>
                                <td><?php //echo $rec_absent_report['Floor'];   ?></td>-->
                                <td><?php echo $rec_absent_report['Department']; ?></td>
    <!--                                    <td><?php //echo $rec_absent_report['Line'];   ?></td> -->
                                <td>
                                    <a href="<?php echo base_url(); ?>con_pro_daily_absent_report/attendanceRectifaction/<?php echo $rec_absent_report['CardNo']; ?>" class="btn btn-info btn-xs" title="সংশোধন"><strong><i class="icon icon-pencil"></i> সংশোধন</strong></a>
                                </td>
                            </tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>    
</div>

<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.css"/>
<script src="<?php echo base_url(); ?>js/jquery.dataTables1.js"></script>
<script src="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.js"></script>
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