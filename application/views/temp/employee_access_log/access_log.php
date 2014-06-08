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
    <?php
    $attr = array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'profile'
    );
    echo form_open('con_pro_employee_access_log/example', $attr);
    ?>
    <div class='col-lg-8'> 
        <div class="form-group">
            <div class="col-sm-offset-8 col-sm-10">
                <input type="text" name="searchterm" id="searchterm" value="<?php echo $searchterm; ?>" />		
                <button type="submit" name="submit" class="btn btn-success">Search</button>
            </div>
        </div>
        <?php if($error_msg){ ?><div><?php echo $error_msg;  ?></div> <?php } ?>
        <table class="table table-hover">
            <thead>
            <th>Card No</th>
            <th>Date Time</th>
            <th>Status</th>           
            <th>Delete Status</th>
            </thead>
            <tbody>
                <?php
                foreach ($results as $access_log) {
                    ?>
                    <tr>
                        <td><?php echo $access_log->CardNo; ?> </td>
                        <td><?php echo $access_log->DateTime; ?> </td>
                        <td><?php echo $access_log->Status; ?> </td>                        
                        <td><?php echo $access_log->DelStatus; ?> </td>
                    </tr>                      
                <?php } ?>
            </tbody>            
        </table>
        <ul class="pagination pagination-lg">
            <?php echo $links; ?>
        </ul> 
        
    </div>
    <?php echo form_close(); ?>
    <div class='col-lg-2'></div>
</div>
