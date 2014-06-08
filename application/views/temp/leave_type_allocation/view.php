<div class="page-header">
    <div class="text-center"><h3><i class="icon icon-info"></i> নির্ধারিত বরাদ্দকৃত ছুটি</h3></div>
</div>

<section>
    <div class="panel panel-primary">
        <div class="panel panel-heading">
            নির্ধারিত বরাদ্দকৃত ছুটির সংশোধন তালিকা
        </div>
        <div class="panel panel-body">
            <table class="table table-bordered table-condensed table-hover">
                <thead>
                <th><i class="icon icon-edit"></i> কার্ড নং</th>
                <th><i class="icon icon-edit"></i> কাসুয়াল লিভ</th>
                <th><i class="icon icon-edit"></i> কম্পেন্সটরি হলিডে</th>
                <th><i class="icon icon-edit"></i> অর্জিত লিভ</th>
                <th><i class="icon icon-edit"></i> ফেস্টিভাল লিভ</th>
                <th><i class="icon icon-edit"></i> প্রসবকালীন ছুটি</th>
                <th><i class="icon icon-edit"></i> সিক লিভ</th>
                <th><i class="icon icon-pencil"></i> সংশোধন</th>
                </thead>
                <tbody>
                    <?php foreach ($tbl_leave_allocation_edit as $rec_leave_allocation_edit){ ?>
                    <tr>
                        <td><?php echo $rec_leave_allocation_edit['CardNo']; ?></td>
                        <td><?php echo $rec_leave_allocation_edit['CL']; ?></td>
                        <td><?php echo $rec_leave_allocation_edit['CH']; ?></td>
                        <td><?php echo $rec_leave_allocation_edit['EL']; ?></td>
                        <td><?php echo $rec_leave_allocation_edit['FL']; ?></td>
                        <td><?php echo $rec_leave_allocation_edit['ML']; ?></td>
                        <td><?php echo $rec_leave_allocation_edit['SL']; ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>con_proc_leave_type_allocation/edit_leave_allocation/<?php echo $rec_leave_allocation_edit['CardNo']; ?>" class="btn btn-primary btn-xs" title="সংশোধন"><strong><i class="icon icon-pencil"></i> সংশোধন</strong></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>