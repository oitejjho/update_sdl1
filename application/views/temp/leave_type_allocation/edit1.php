<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading"> ছুটির প্রকারভেদ সংশোধন করুন</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form'
                    );
                    echo form_open('con_proc_leave_type_allocation/UpdateCardSpecificLeaveAllocation', $attr);
                    ?>

                    <?php
                    $limit = count($tbl_leave_allocation_edit) - 1;
                    for ($index = 0; $index <= $limit; $index++) {
                        ?>
                        <div class="form-group">
                            <label for="CatagoryName" class="col-sm-3 control-label" >কার্ড নং</label>
                            <div class="col-sm-9">
                                <input type="text" name="CardNo"  class="form-control" id="CardNo" value="<?php echo $tbl_leave_allocation_edit[$index]['CardNo']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Days" class="col-sm-3 control-label" >কাসুয়াল লিভ</label>
                            <div class="col-sm-9">
                                <input type="text" name="CL"  class="form-control" value="<?php echo $tbl_leave_allocation_edit[$index]['Days'];
                    $index++; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="PaidUnpaid" class="col-sm-3 control-label" >কম্পেন্সটরি হলিডে</label>
                            <div class="col-sm-9">
                                <input type="text" name="CH"  class="form-control" id="id_PaidUnpaid" value="<?php echo $tbl_leave_allocation_edit[$index]['Days'];
                    $index++; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="EarnLeave" class="col-sm-3 control-label" >অর্জিত লিভ</label>
                            <div class="col-sm-9">
                                <input type="text" name="EL"  class="form-control" id="id_EarnLeave" value="<?php echo $tbl_leave_allocation_edit[$index]['Days'];
                    $index++; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ShorfForm" class="col-sm-3 control-label" >ফেস্টিভাল লিভ</label>
                            <div class="col-sm-9">
                                <input type="text" name="FL"  class="form-control" id="id_ShorfForm" value="<?php echo $tbl_leave_allocation_edit[$index]['Days'];
                    $index++; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ShorfForm" class="col-sm-3 control-label" >প্রসবকালীন ছুটি</label>
                            <div class="col-sm-9">
                                <input type="text" name="ML"  class="form-control" id="id_ShorfForm" value="<?php echo $tbl_leave_allocation_edit[$index]['Days'];
                    $index++; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ShorfForm" class="col-sm-3 control-label" >সিক লিভ</label>
                            <div class="col-sm-9">
                                <input type="text" name="SL"  class="form-control" id="id_ShorfForm" value="<?php echo $tbl_leave_allocation_edit[$index]['Days'];
                    $index++; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" style='margin-left:8px;'>
                            <div class="col-sm-offset-3">
                                <input type="submit" name="update"  class="btn btn-success btn-sm" id="update" value="সংশোধন করুন">
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