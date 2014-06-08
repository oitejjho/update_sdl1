<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_leave_detail/update', $attr);
        foreach ($tbl_detail as $rec_detail) {
            ?>
            <input type="hidden" name="ID" value="<?php echo $rec_detail->ID; ?>"/>
            <div class="form-group">
                <label for="CardNo" class="col-sm-3 control-label" >CardNo</label>
                <div class="col-sm-9">
                    <input type="text" name="CardNo"  class="form-control" id="id_CardNo" value="<?php echo $rec_detail->CardNo; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="Date" class="col-sm-3 control-label" >Date</label>
                <div class="col-sm-9">
                    <input type="text" name="Date"  class="form-control" id="id_Date" value="<?php echo $rec_detail->Date; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="LeaveCategoryName" class="col-sm-3 control-label" >LeaveCategoryName</label>
                <div class="col-sm-9">
                    <input type="text" name="LeaveCategoryName"  class="form-control" id="id_LeaveCategoryName" value="<?php echo $rec_detail->LeaveCategoryName; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="ApprovedBy" class="col-sm-3 control-label" >ApprovedBy</label>
                <div class="col-sm-9">
                    <input type="text" name="ApprovedBy"  class="form-control" id="id_ApprovedBy" value="<?php echo $rec_detail->ApprovedBy; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="ApplicationNo" class="col-sm-3 control-label" >ApplicationNo</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplicationNo"  class="form-control" id="id_ApplicationNo" value="<?php echo $rec_detail->ApplicationNo; ?>">
                </div>
            </div>
            <?php
        }
        echo form_close();
        ?>
    </div>
    <div class='col-lg-2'>
    </div>
</div>
