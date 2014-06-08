
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
        <div class="panel panel-primary">
            <div class="panel panel-heading">Leave Category</div>
            <div class="panel panel-body">
                <a href="<?php echo site_url('con_set_leave_catagory/create'); ?>">
                    <button class="btn btn-info btn-sm"><i class="icon icon-plus"></i> Create Leave Category</button>
                </a><br/><br/>
                <table class="table table-hover table-condensed table-bordered">
                    <thead>
                    <th><i class="icon icon-edit"></i> SL</th>
                    <th><i class="icon icon-edit"></i> Category Name</th>
                    <th><i class="icon icon-edit"></i> Days</th>
                    <th><i class="icon icon-edit"></i> Paid Unpaid</th>
                    <th><i class="icon icon-edit"></i> Short Form</th>
                    <th><i class="icon icon-rocket"></i> Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($tbl_leave_catagory as $rec_wages_breakdown) {
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $rec_wages_breakdown->CatagoryName; ?> </td>
                                <td><?php echo $rec_wages_breakdown->Days; ?> </td>
                                <td><?php echo $rec_wages_breakdown->PaidUnpaid; ?> </td>
                                <td><?php echo $rec_wages_breakdown->ShorfForm; ?> </td>
                                <td>
                                    <?php echo form_open('con_set_leave_catagory/edit'); ?>
                                    <input type="hidden" name="ID" id="ID" value="<?php echo $rec_wages_breakdown->ID; ?>"/>
                                    <button class="btn btn-success btn-xs" name="submit" value="edit"><i class="glyphicon glyphicon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs" name="submit" value="delete" onclick="return confirm('Are u sure u want to delete?')"><i class="glyphicon glyphicon-trash"></i></button>
                                    <?php echo form_close(); ?>
        <!--                            <button class="btn btn-danger" name="submit" value="delete" onclick="return confirm('Are u sure u want to delete')"><i class="glyphicon glyphicon-trash"></i></button>                            -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class='col-lg-2'></div>
</div>
