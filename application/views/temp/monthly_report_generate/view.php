<div class='row'>
    <div class='col-lg-2'>
        <?php
        if (isset($msg))
            echo $msg;
        ?>
    </div>
    <div class='col-lg-8'>

        <table class="table table-hover">
            <thead>
            <th>Sl</th>
            <th>Card No</th>
            <th>Access Time</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Created On</th>
            <th>Del Status</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($tbl_access_log as $rec_access_log) {
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>                        
                        <td><?php echo $rec_access_log->CardNo; ?> </td>
                        <td><?php echo $rec_access_log->DateTime ?> </td>
                        <td><?php echo $rec_access_log->Status; ?> </td>
                        <td><?php echo $rec_access_log->CreatedBy; ?> </td>
                        <td><?php echo $rec_access_log->CreatedOn; ?> </td>
                        <td><?php echo $rec_access_log->DelStatus; ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class='col-lg-2'></div>
</div>
