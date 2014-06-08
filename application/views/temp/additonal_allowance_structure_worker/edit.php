<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-7'>
        <fieldset>
            <legend>Update Additional Allowance Worker</legend>
        </fieldset>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_set_additonal_allowance_structure_worker/update', $attr);
        foreach ($tbl_additonal_allowance_structure_worker as $rec_additonal_allowance_structure_worker) {
            ?>
            <input type="hidden" name="ID" value="<?php echo $rec_additonal_allowance_structure_worker->ID; ?>"/>
            <div class="form-group">
                <label for="Head" class="col-sm-3 control-label" >Head</label>
                <div class="col-sm-9">
                    <input type="text" name="Head"  class="form-control" id="id_Head" value="<?php echo $rec_additonal_allowance_structure_worker->Head; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="WorkerAmount" class="col-sm-3 control-label" >WorkerAmount</label>
                <div class="col-sm-9">
                    <input type="text" name="WorkerAmount"  class="form-control" id="id_WorkerAmount" value="<?php echo $rec_additonal_allowance_structure_worker->WorkerAmount; ?>">
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" name="update"  class="btn btn-primary" id="update" value="Update">
                </div>
            </div>
            <?php
        }
        echo form_close();
        ?>
        <fieldset>
            <legend>View Additional Allowance Worker</legend>
        </fieldset>
        <table class="table">
            <thead>
                <tr class="active">
                    <th>Sl</th>
                    <th>Head</th>
                    <th>WorkerAmount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($tbl_additonal_allowance_structure_worker as $rec_additonal_allowance_structure_worker) {
                    ?>
                    <tr class="success">
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rec_additonal_allowance_structure_worker->Head; ?> </td>
                        <td><?php echo $rec_additonal_allowance_structure_worker->WorkerAmount; ?> </td>                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class='col-lg-2'>
    </div>
</div>
