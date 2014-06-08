<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_leave_detail/insert', $attr);
        ?>

        <div class="form-group">
            <label for="CardNo" class="col-sm-3 control-label" >CardNo</label>
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

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class='col-lg-2'></div>
</div>
