<div class='row'>
    <div class='col-lg-3'></div>
    <div class='col-lg-6'>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Update Wages Breakdown</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form'
                    );
                    echo form_open('con_set_wages_breakdown/update', $attr);
                    foreach ($tbl_wages_breakdown as $rec_wages_breakdown) {
                        ?>
                        <input type="hidden" name="ID" value="<?php echo $rec_wages_breakdown->ID; ?>"/>

                        <div class="form-group">
                            <label for="Head" class="col-sm-3 control-label" >Head</label>
                            <div class="col-sm-9">
                                <input type="text" name="Head"  class="form-control" id="id_Head" value="<?php echo $rec_wages_breakdown->Head; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Percentage" class="col-sm-3 control-label" >Percentage</label>
                            <div class="col-sm-9">
                                <input type="text" name="Percentage"  class="form-control" id="id_Percentage" value="<?php echo $rec_wages_breakdown->Percentage; ?>">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" name="update"  class="btn btn-primary" id="update" value="Update">
                            </div>
                        </div>
                        <?php
                    }
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">View Wages Breakdown</div>
                <div class="panel panel-body">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr class="active">
                                <th>Sl</th>
                                <th>Head</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($tbl_wages_breakdown as $rec_wages_breakdown) {
                                ?>
                                <tr class="success">
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $rec_wages_breakdown->Head; ?> </td>
                                    <td><?php echo $rec_wages_breakdown->Percentage; ?>% </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-3'> </div>
</div>
