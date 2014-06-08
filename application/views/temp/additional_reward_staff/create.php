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
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form',
            'id' => 'profile'
        );
        echo form_open('con_set_additional_reward_staff/insert', $attr);
        ?>
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
                <button type="submit" name="submit" class="btn btn-success" value="submit">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class='col-lg-2'></div>
</div>
