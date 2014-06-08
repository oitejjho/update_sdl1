<div class="row">     
    <div class="col-md-12">
        <section class="panel panel-body">
            <div class="panel-primary" > 
                <header class="panel-heading">
                    <h4>
                        দৈনন্দিন ছুটির প্রতিবেদন তালিকা                         
                    </h4>                
                </header>                 
                <div class="panel panel-body">                                        
                    <table class="table table-striped table-advance table-condensed table-bordered" id="leave_log" >
                        <thead>
                            <tr>
                                <th><i class="icon icon-edit"></i> কার্ড নং</th>                    
                                <th><i class="icon icon-edit"></i> নাম</th>                     
                                <th><i class="icon icon-edit"></i> বিভাগ</th>                              
                                <th><i class="icon icon-edit"></i> ছুটির ধরন</th>	
                                <th><i class="icon icon-edit"></i> অনুমোদনকারী</th>								
                                <th><i class="icon icon-time"></i> তারিখ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><i class="icon icon-edit"></i> কার্ড নং</th>
                                <th><i class="icon icon-edit"></i> নাম</th>                    
                                <th><i class="icon icon-edit"></i> বিভাগ</th>   
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($tbl_leave_report as $rec_leave_report) { ?>
                                <tr>
                                    <td><?php echo $rec_leave_report['CardNo']; ?></td>
                                    <td><?php echo $rec_leave_report['Name']; ?></td> 
                                    <td><?php echo $rec_leave_report['Department']; ?></td>                              
                                    <td><?php echo $rec_leave_report['LeaveCategoryName']; ?></td>
                                    <td><?php echo $rec_leave_report['ApprovedBy']; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($rec_leave_report['Date'])); ?></td>                            
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>    
</div>

<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.css"/>
<script src="<?php echo base_url(); ?>js/jquery.dataTables1.js"></script>
<script src="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>

    $(document).ready(function() {
        var table = $('#leave_log').DataTable();
        $("#leave_log tfoot th").each(function(i) {
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