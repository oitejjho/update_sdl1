
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
                WorkerAmount: "required"
            },
            messages: {
                Head: "Please enter your first name",
                WorkerAmount: "Please enter your last name"
            }
        });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<div class='row'>
    <div class='col-lg-2'>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <div class='col-lg-8'> 
        <fieldset>
            <legend>View Leave Detail</legend>
        </fieldset>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_leave_detail/insert', $attr);
        ?>

        <div class="form-group">
            <label for="CardNo" class="col-sm-3 control-label" >Card No</label>
            <div class="col-sm-9">
                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" placeholder="Enter CardNo">
            </div>
        </div>
        <div class="form-group">
            <label for="Date" class="col-sm-3 control-label" >Date</label>
            <div class="col-sm-9">
                <input type="text" name="Date"  class="form-control" id="id_Date" placeholder="Enter Date">
            </div>
        </div>
        <div class="form-group">
            <label for="LeaveCategoryName" class="col-sm-3 control-label" >Leave Category Name</label>
            <div class="col-sm-9">
                <input type="text" name="LeaveCategoryName"  class="form-control" id="id_LeaveCategoryName" placeholder="Enter LeaveCategoryName">
            </div>
        </div>
        <div class="form-group">
            <label for="ApprovedBy" class="col-sm-3 control-label" >Approved By</label>
            <div class="col-sm-9">
                <input type="text" name="ApprovedBy"  class="form-control" id="id_ApprovedBy" placeholder="Enter ApprovedBy">
            </div>
        </div>
        <div class="form-group">
            <label for="ApplicationNo" class="col-sm-3 control-label" >Application No</label>
            <div class="col-sm-9">
                <input type="text" name="ApplicationNo"  class="form-control" id="id_ApplicationNo" placeholder="Enter ApplicationNo">
            </div>
        </div>
        <?php
        $role = array(
            'WG4' => 'WG4',
            'WG5' => 'WG5',
            'WG6' => 'WG6'
        );
        ?>
        <div class="form-group">
            <label class="control-label col-lg-3" for="BuildingName">Building Name</label>
            <div class="col-lg-8">
                <select class ="form-control" name="BuildingName" id="BuildingName" value="<?php echo set_value('BuildingName'); ?>">
                    <option value="">--Select One--</option>
                    <?php
                    foreach ($role as $k => $v) {
                        echo "<option value='" . $k . "'>" . $v . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        $role = array(
            'SDL1' => 'SDL1',
            'SDL2' => 'SDL2',
            'SDL3' => 'SDL3',
            'SDWL1' => 'SDWL1',
            'SDWL2' => 'SDWL2',
            'SDWL3' => 'SDWL3',
        );
        ?>
        <div class="form-group">
            <label class="control-label col-lg-3" for="Floor">Floor</label>
            <div class="col-lg-8">
                <select class ="form-control" name="Floor" id="Floor" value="<?php echo set_value('Floor'); ?>">
                    <option value="">--Select One--</option>
                    <?php
                    foreach ($role as $k => $v) {
                        echo "<option value='" . $k . "'>" . $v . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        $role = array(
            'SEWING' => 'SEWING',
            'BARTACK' => 'BARTACK',
            'CWAS' => 'CENTRAL WORKER AND STAFF',
            'CUTING' => 'CUTING',
            'EOGA' => 'ED, OIC, GM, AGM',
            'FINISHING' => 'CENTRAL WORKER AND STAFF',
            'PS' => 'PRODUCTION STAFF',
            'QUALITY' => 'QUALITY'
        );
        ?>
        <div class="form-group">
            <label class="control-label col-lg-3" for="Department">Department</label>
            <div class="col-lg-8">
                <select class ="form-control" name="Department" id="Floor" value="<?php echo set_value('Department'); ?>">
                    <option value="">--Select One--</option>
                    <?php
                    foreach ($role as $k => $v) {
                        echo "<option value='" . $k . "'>" . $v . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        $role = array(
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F'
        );
        ?>
        <div class="form-group">
            <label class="control-label col-lg-3" for="Line">Line</label>
            <div class="col-lg-8">
                <select class ="form-control" name="Line" id="Line" value="<?php echo set_value('Line'); ?>">
                    <option value="">--Select One--</option>
                    <?php
                    foreach ($role as $k => $v) {
                        echo "<option value='" . $k . "'>" . $v . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
        </div>        
    </div>
    <div class='col-lg-2'></div>
</div>
