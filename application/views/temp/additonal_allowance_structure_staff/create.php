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
                Head: "required",
                StaffAmount: "required"            
            },
            messages: {
                Head: "Please enter your first name",
                StaffAmount: "Please enter your last name"
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
        echo form_open('con_set_additonal_allowance_structure_staff/insert', $attr);
        ?>
        <div class="form-group">
            <label for="Head" class="col-sm-3 control-label" >Head</label>
            <div class="col-sm-9">
                <input type="text" name="Head"  class="form-control" id="id_Head" placeholder="Enter Head">
            </div>
        </div>
        <div class="form-group">
            <label for="StaffAmount" class="col-sm-3 control-label" >Staff Amount</label>
            <div class="col-sm-9">
                <input type="text" name="StaffAmount"  class="form-control" id="id_StaffAmount" placeholder="Enter StaffAmount">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" name="submit" class="btn btn-success">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class='col-lg-2'></div>
</div>
