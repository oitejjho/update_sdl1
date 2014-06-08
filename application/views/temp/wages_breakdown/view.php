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
                Head: "required",
                Percentage: "required"
            },
            messages: {
                Head: "Please enter wages breakdown head",
                Percentage: "Please enter wages breakdown percentage"
            }
        });

    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<div class='row'>
    <?php
    if ($this->session->flashdata('msg')) {
        ?>
        <script>
    $(document).ready(function() {
        $('#myModal').modal('show');
    });
        </script>
        <?php
    }
    ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Status....</h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>                    
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Create Wages Breakdown</div>
                <div class="panel panel-body">
                    <?php
                    $attr = array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'id' => 'profile'
                    );
                    echo form_open('con_set_wages_breakdown/insert', $attr);
                    ?>
                    <div class="form-group">
                        <label for="Head" class="col-sm-3 control-label" >Head</label>
                        <div class="col-sm-9">
                            <input type="text" name="Head"  class="form-control" id="Head" placeholder="Enter Head">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Percentage" class="col-sm-3 control-label" >Percentage</label>
                        <div class="col-sm-9">
                            <input type="text" name="Percentage"  class="form-control" id="Percentage" placeholder="Enter Percentage">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel panel-heading">View Wages Breakdown</div>
                <div class="panel panel-body">
                    <table class="table table-condensed table-bordered table-hover">
                        <thead>
                            <tr class="active">
                                <th><i class="icon icon-edit"></i> SL</th>
                                <th><i class="icon icon-edit"></i> Head</th>
                                <th><i class="icon icon-edit"></i> Percentage</th>
                                <th><i class="icon icon-rocket"></i> Action</th>
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
                                    <td>
                                        <?php echo form_open('con_set_wages_breakdown/edit'); ?>
                                        <input type="hidden" name="ID" id="ID" value="<?php echo $rec_wages_breakdown->ID; ?>"/>
                                        <button class="btn btn-primary btn-xs" name="submit" value="edit"><i class="icon icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" name="submit" value="delete" onclick="return confirm('Are you sure want to delete this data?')"><i class="icon icon-trash"></i></button>
                                        <?php echo form_close(); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='col-lg-2'></div>
</div>
