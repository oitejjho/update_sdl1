<div class='row'>
    <div class='col-lg-2'>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <div class='col-lg-8'>
        <a href="<?php echo base_url(); ?>con_access_log/create">
            <button class="btn btn-info"><i class="glyphicon glyphicon-plus"></i>Add</button>
        </a>
        <table class="table table-hover">
            <thead>
            <th>Sl</th>
            <th>CardNo</th>
            <th>DateTime</th>
            <th>Status</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($tbl_log as $rec_log) {
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rec_log->CardNo; ?> </td>
                        <td><?php echo $rec_log->DateTime; ?> </td>
                        <td><?php echo $rec_log->Status; ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class='col-lg-2'></div>
</div>
