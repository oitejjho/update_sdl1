<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading"> Update Leave Category</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form'
                    );
                    echo form_open('con_set_leave_catagory/update', $attr);
                    foreach ($tbl_leave_catagory as $rec_leave_catagory) {
                        ?>
                        <input type="hidden" name="ID" id="id_ID" value="<?php echo $rec_leave_catagory->ID; ?>"/>
                        <div class="form-group">
                            <label for="CatagoryName" class="col-sm-3 control-label" >Catagory Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="CatagoryName"  class="form-control" id="id_CatagoryName" value="<?php echo $rec_leave_catagory->CatagoryName; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Days" class="col-sm-3 control-label" >Days</label>
                            <div class="col-sm-9">
                                <input type="text" name="Days"  class="form-control" id="id_Days" value="<?php echo $rec_leave_catagory->Days; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="PaidUnpaid" class="col-sm-3 control-label" >Paid Unpaid</label>
                            <div class="col-sm-9">
                                <input type="text" name="PaidUnpaid"  class="form-control" id="id_PaidUnpaid" value="<?php echo $rec_leave_catagory->PaidUnpaid; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ShorfForm" class="col-sm-3 control-label" >Short fForm</label>
                            <div class="col-sm-9">
                                <input type="text" name="ShorfForm"  class="form-control" id="id_ShorfForm" value="<?php echo $rec_leave_catagory->ShorfForm; ?>">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-9">
                                <input type="submit" name="update"  class="btn btn-success" id="update" value="Update">
                            </div>
                        </div>
                        <?php
                    }
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-2'></div>
</div>
