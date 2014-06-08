<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#profile").validate({
            rules: {
                CatagoryName: "required",
                Days: "required",
                PaidUnpaid: "required",
                ShorfForm: "required"
            },
            messages: {
                CatagoryName: "Please enter your category name",
                Days: "Please enter your days name",
                PaidUnpaid: "Please enter paid or not",
                ShorfForm: "Please enter short form of category name"
            }
        });

    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading"> Create Leave Category</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'id' => 'profile'
                    );
                    echo form_open('con_set_leave_catagory/insert', $attr);
                    ?>
                    <div class="form-group">
                        <label for="CatagoryName" class="col-sm-3 control-label" >CatagoryName</label>
                        <div class="col-sm-9">
                            <input type="text" name="CatagoryName"  class="form-control" id="CatagoryName" placeholder="Enter Catagory Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Days" class="col-sm-3 control-label" >Days</label>
                        <div class="col-sm-9">
                            <input type="text" name="Days"  class="form-control" id="Days" placeholder="Enter Days">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PaidUnpaid" class="col-sm-3 control-label" >Paid</label>
                        <div class="col-sm-9">
                            <input type="text" name="PaidUnpaid"  class="form-control" id="PaidUnpaid" placeholder="Enter Paid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ShorfForm" class="col-sm-3 control-label" >Short Form</label>
                        <div class="col-sm-9">
                            <input type="text" name="ShorfForm"  class="form-control" id="ShorfForm" placeholder="Enter Short Form">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-2'></div>
</div>
