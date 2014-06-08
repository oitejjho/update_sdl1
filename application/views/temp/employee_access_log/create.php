<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <fieldset>
            <legend>Create Access Log</legend>
        </fieldset>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_access_log/insert', $attr);
        ?>
        <div class="form-group">
            <label for="CardNo" class="col-sm-3 control-label" >Card No</label>
            <div class="col-sm-9">
                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" placeholder="Enter Card No">
            </div>
        </div>
        <div class="form-group">
            <label for="DateTime" class="col-sm-3 control-label" >Date Time</label>
            <div class="col-sm-9">
                <input type="text" name="DateTime"  class="form-control" id="id_DateTime" placeholder="Enter Date Time">
            </div>
        </div>
        <div class="form-group">
            <label for="Status" class="col-sm-3 control-label" >Status</label>
            <div class="col-sm-9">
                <input type="text" name="Status"  class="form-control" id="id_Status" placeholder="Enter Status">
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
