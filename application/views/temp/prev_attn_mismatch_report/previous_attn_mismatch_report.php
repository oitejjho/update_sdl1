
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Date').datepicker({
            format: 'mm-dd-yyyy'
        });
    });
</script>

<div class="row">   
    <div class="col-lg-12">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4> 
                        সময়সূচী দ্বারা  অনুসন্ধান  করুন                    
                    </h4>                
                </header> 
                <div class="panel-body">
                    <?php
                    $attributes = array(
                        'class' => 'form-inline',
                        'role' => 'form'
                    );
                    echo form_open('con_pro_attn_mismatch_report/', $attributes);
                    ?>
                    <div class="form-group">
                        <label for="Date"></label>
                        <input type="text" name="Date" id="Date" value="<?php if ($this->input->post('Date')) echo date('d-m-Y', strtotime(str_replace('-', '/', $this->input->post('Date')))); ?>" class="form-control" placeholder="তারিখ নির্বাচন  করুন"/>
                    </div>                 
                    <button class="btn btn-success" type="submit" style="margin-top: 18px;"><i class="glyphicon glyphicon-search"></i> অনুসন্ধান করুন</button>                                    
                    <?php echo form_close(); ?>
                </div>
            </div>
        </section>
    </div>    
</div>
<div class="row"> 
    <div class="col-lg-12">
        <section class="panel panel-body">
            <div class="text-center">
                <h5><strong>  পূর্ববর্তী উপস্থিতির রিপোর্ট  বের করার জন্য বাটনটি চাপুন</strong></h5>
                <?php
                $attributes = array(
                    'class' => 'form-inline',
                    'role' => 'form',
                    'id' => 'excelExport'
                );
                echo form_open('con_pro_attn_mismatch_report/excelExport', $attributes);
                ?>
                <input type="hidden" name="hDate" value="<?php
                    echo $showDate;
                ?>"/>
                <button class="btn btn-info" type="submit" name="xlexport"><img src="<?php echo base_url(); ?>images/Excel-icon.png" alt="Excel Export" width="16" height="16"/> এক্সেল  এক্সপোর্ট করুন</button>
                <?php
                echo form_close();
                ?>
            </div><hr/>
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4>
                        পূর্ববর্তী উপস্থিতি অমিলের প্রতিবেদন তালিকা                         
                    </h4>                
                </header>
                <table class="table table-striped table-advance table-condensed table-bordered" id="daily_log" style="margin-top: 5px;">
                    <thead>                        
                        <tr>                   
                            <th><i class="glyphicon glyphicon-edit"></i> কার্ড নং</th>                    
                            <th><i class="glyphicon glyphicon-time"></i> নাম</th>     
<!--                            <th><i class="glyphicon glyphicon-edit"></i> ভবনের নাম</th>     
                            <th><i class="glyphicon glyphicon-edit"></i> ফ্লোর</th>                    -->
                            <th><i class="glyphicon glyphicon-edit"></i> বিভাগ/সেকশন</th>                    
<!--                            <th><i class="glyphicon glyphicon-edit"></i> লাইন/ইউনিট</th>           -->
                            <th><i class="glyphicon glyphicon-time"></i> প্রবেশ সময়</th>
                            <th><i class="glyphicon glyphicon-time"></i> বাহির সময়</th>
                            <th><i class="glyphicon glyphicon-time"></i> সংশোধন</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><i class="glyphicon glyphicon-edit"></i> ভবনের নাম</th>     
                            <th><i class="glyphicon glyphicon-edit"></i> ফ্লোর</th>                    
                            <th><i class="glyphicon glyphicon-edit"></i> বিভাগ/সেকশন</th>
                        </tr>
                    </tfoot>
                    <tbody>                        
                        <?php
                        $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
                        foreach ($tbl_mismatch_report as $rec_mismatch_report) {
                            ?>
                            <tr>  
                                <td><?php echo str_replace(range(0, 9), $bn_digits, $rec_mismatch_report['CardNo']); ?></td>
                                <td><?php echo $rec_mismatch_report['Name']; ?></td>   
    <!--                                <td><?php //echo $rec_mismatch_report['BuildingName'];   ?></td>
                                <td><?php //echo $rec_mismatch_report['Floor'];   ?></td>-->
                                <td><?php echo $rec_mismatch_report['Department']; ?></td>
    <!--                                <td><?php //echo $rec_mismatch_report['Line'];   ?></td>                                                          -->
                                <td>
                                    <?php
                                    $date = date('Y-m-d', strtotime($rec_mismatch_report['DateTime']));
                                    $time = date('H:i:s', strtotime($rec_mismatch_report['DateTime']));
                                    if (date('H:i:s', strtotime($rec_mismatch_report['DateTime'])) < date('H:i:s', strtotime('10:59:59'))) {
                                        
                                        echo str_replace(range(0, 9), $bn_digits, date('d-m-Y H:i:s', strtotime('+6 hours', strtotime($rec_mismatch_report['DateTime']))));
                                    }
                                    ?>
                                </td> 
                                <td>
                                    <?php
                                    $date = date('Y-m-d', strtotime($rec_mismatch_report['DateTime']));
                                    $time = date('H:i:s', strtotime($rec_mismatch_report['DateTime']));
                                    if (date('H:i:s', strtotime($rec_mismatch_report['DateTime'])) > date('H:i:s', strtotime('10:59:59'))) {
                                        echo str_replace(range(0, 9), $bn_digits, date('d-m-Y H:i:s', strtotime('+6 hours', strtotime($rec_mismatch_report['DateTime']))));
                                    }
                                    ?>
                                </td> 
                                <td>
                                    <?php echo form_open('con_pro_attn_mismatch_report/edit'); ?>
                                    <input type="hidden" name="CardNo" value="<?php echo $rec_mismatch_report['CardNo']; ?>"/>
                                    <input type="hidden" name="Date" value="<?php echo $rec_mismatch_report['DateTime']; ?>"/>
                                    <button class="btn btn-primary btn-xs" name="submit" value="edit" id="mismatchLogEditButton"><i class="glyphicon glyphicon-pencil"></i> সংশোধন</button>
                                    <?php echo form_close(); ?>
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

