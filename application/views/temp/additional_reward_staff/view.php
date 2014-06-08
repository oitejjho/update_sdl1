<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script>
    $(document).ready(function() {
        $("#profile").validate({
            rules: {
                RewaredName: "required",
                RewaredAmount: "required",
                IsCalculatedOnBasic: "required",
                BasicXTime: "required",
                CompensatoryHolyday: "required"
            },
            messages: {
                RewaredName: "Please enter your first name",
                RewaredAmount: "Please enter your last name",
                IsCalculatedOnBasic: "Please enter your last name",
                BasicXTime: "Please enter your username",
                CompensatoryHolyday: "Please select a gender"
            }
        });

    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<div class='row'>
    <?php
            $attr = array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'profile'
            );
            echo form_open('con_set_additional_reward_staff/insert', $attr);
            ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Status....</h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>                    
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-1'></div>
    <div class='col-lg-10'>
<!--        <a href="<?php //echo site_url('con_set_additional_reward_staff/create');   ?>">
            <button class="btn btn-info"><i class="glyphicon glyphicon-plus"></i>Add</button>
        </a>-->
        <fieldset>
            <legend>Create Staff Reword</legend>
        
            
            <div class="form-group">
                <label for="RewaredName" class="col-sm-3 control-label" >Reward Name</label>
                <div class="col-sm-9">
                    <input type="text" name="RewaredName"  class="form-control" id="id_RewaredName" placeholder="Enter RewaredName">
                </div>
            </div>
            <div class="form-group">
                <label for="RewaredAmount" class="col-sm-3 control-label" >Reward Amount</label>
                <div class="col-sm-9">
                    <input type="text" name="RewaredAmount"  class="form-control" id="id_RewaredAmount" placeholder="Enter RewaredAmount">
                </div>
            </div>
            <div class="form-group">
                <label for="IsCalculatedOnBasic" class="col-sm-3 control-label" >Is Calculated On Basic</label>
                <div class="col-sm-9">
                    <input type="text" name="IsCalculatedOnBasic"  class="form-control" id="id_IsCalculatedOnBasic" placeholder="Enter IsCalculatedOnBasic">
                </div>
            </div>
            <div class="form-group">
                <label for="BasicXTime" class="col-sm-3 control-label" >Basic X Time</label>
                <div class="col-sm-9">
                    <input type="text" name="BasicXTime"  class="form-control" id="id_BasicXTime" placeholder="Enter BasicXTime">
                </div>
            </div>
            <div class="form-group">
                <label for="CompensatoryHolyday" class="col-sm-3 control-label" >Compensatory Holiday</label>
                <div class="col-sm-9">
                    <input type="text" name="CompensatoryHolyday"  class="form-control" id="id_CompensatoryHolyday" placeholder="Enter CompensatoryHolyday">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary" value="submit">Save</button>
                </div>
            </div>
            </fieldset>
            <?php echo form_close(); ?>
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
                        <th>Action</th>
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
                            <td>
                                <?php echo form_open('con_set_additional_reward_staff/edit'); ?>
                                <input type="hidden" name="ID" id="ID" value="<?php echo $rec_additional_reward_staff->ID; ?>"/>
                                <button class="btn btn-primary" name="submit" value="edit"><i class="glyphicon glyphicon-pencil"></i></button>
                                <button class="btn btn-danger" name="submit" value="delete" onclick="return confirm('Are u sure u want to delete')"><i class="glyphicon glyphicon-trash"></i></button>
                                <?php echo form_close(); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </fieldset>
        </div>
        <div class='col-lg-1'></div>
    </div>
