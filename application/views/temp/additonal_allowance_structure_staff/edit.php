<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <fieldset>
            <legend>Update Staff Additional Allowance</legend>
        </fieldset>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_set_additonal_allowance_structure_staff/update', $attr);
        foreach ($tbl_additonal_allowance_structure_staff as $rec_additonal_allowance_structure_staff) {
            ?>
            <input type="hidden" name="ID" value="<?php echo $rec_additonal_allowance_structure_staff->ID; ?>"/>
            <div class="form-group">
                <label for="Head" class="col-sm-3 control-label" >Head</label>
                <div class="col-sm-9">
                    <input type="text" name="Head"  class="form-control" id="id_Head" value="<?php echo $rec_additonal_allowance_structure_staff->Head; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="StaffAmount" class="col-sm-3 control-label" >StaffAmount</label>
                <div class="col-sm-9">
                    <input type="text" name="StaffAmount"  class="form-control" id="id_StaffAmount" value="<?php echo $rec_additonal_allowance_structure_staff->StaffAmount; ?>">
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-offset-3 col-sm-10">
                    <input type="submit" name="update"  class="btn btn-primary" id="update" value="Update">
                </div>
            </div>
            <?php
        }
        echo form_close();
        ?>

        <fieldset>
            <legend>View Staff Additional Allowance</legend>
        </fieldset>
        <table class="table">            
            <thead>
                <tr class="active">
                    <th>Sl</th>
                    <th>Head</th>
                    <th>StaffAmount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($tbl_additonal_allowance_structure_staff as $rec_additonal_allowance_structure_staff) {
                    ?>
                    <tr class="success">
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rec_additonal_allowance_structure_staff->Head; ?> </td>
                        <td><?php echo $rec_additonal_allowance_structure_staff->StaffAmount; ?> </td>                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class='col-lg-2'>
    </div>
</div>
