<div class='row'>
    <div class='col-lg-1'></div>
    <div class='col-lg-10'>
        <fieldset>
            <legend>Update Staff Reword</legend>
        </fieldset>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_set_additional_reward_staff/update', $attr);
        foreach ($tbl_additional_reward_staff as $rec_additional_reward_staff) {
            ?>
            <input type="hidden" name="ID" value="<?php echo $rec_additional_reward_staff->ID; ?>"/>
            <div class="form-group">
                <label for="RewaredName" class="col-sm-3 control-label" >Reward Name</label>
                <div class="col-sm-9">
                    <input type="text" name="RewaredName"  class="form-control" id="id_RewaredName" value="<?php echo $rec_additional_reward_staff->RewaredName; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="RewaredAmount" class="col-sm-3 control-label" >Reward Amount</label>
                <div class="col-sm-9">
                    <input type="text" name="RewaredAmount"  class="form-control" id="id_RewaredAmount" value="<?php echo $rec_additional_reward_staff->RewaredAmount; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="IsCalculatedOnBasic" class="col-sm-3 control-label" >Is Calculated On Basic</label>
                <div class="col-sm-9">
                    <input type="text" name="IsCalculatedOnBasic"  class="form-control" id="id_IsCalculatedOnBasic" value="<?php echo $rec_additional_reward_staff->IsCalculatedOnBasic; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="BasicXTime" class="col-sm-3 control-label" >Basic X Time</label>
                <div class="col-sm-9">
                    <input type="text" name="BasicXTime"  class="form-control" id="id_BasicXTime" value="<?php echo $rec_additional_reward_staff->BasicXTime; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="CompensatoryHolyday" class="col-sm-3 control-label" >Compensatory Holiday</label>
                <div class="col-sm-9">
                    <input type="text" name="CompensatoryHolyday"  class="form-control" id="id_CompensatoryHolyday" value="<?php echo $rec_additional_reward_staff->CompensatoryHolyday; ?>">
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
            <legend>View Staff Reword</legend>

            <table class="table">
                <thead>
                    <tr class="active">
                        <th>Sl</th>
                        <th>Reward Name</th>
                        <th>Reward Amount</th>
                        <th>Is Calculated On Basic</th>
                        <th>Basic X Time</th>
                        <th>Compensatory Holiday</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($tbl_additional_reward_staff as $rec_additional_reward_staff) {
                        ?>
                        <tr class="success">
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $rec_additional_reward_staff->RewaredName; ?> </td>
                            <td><?php echo $rec_additional_reward_staff->RewaredAmount; ?> </td>
                            <td><?php echo $rec_additional_reward_staff->IsCalculatedOnBasic; ?> </td>
                            <td><?php echo $rec_additional_reward_staff->BasicXTime; ?> </td>
                            <td><?php echo $rec_additional_reward_staff->CompensatoryHolyday; ?> </td> 
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class='col-lg-1'>
    </div>
</div>
