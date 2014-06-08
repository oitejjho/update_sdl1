<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Date').datepicker();
    });
</script>
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
<div class='row'>
    <div class='col-lg-2'>
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
    </div>
    <div class='col-lg-8'>
        <div class="panel-primary">
            <header class="pnael panel-heading">
                <h4>ছুটির নাম এবং তারিখ সংশোধন  করুন</h4> 
            </header>
            <div class="panel panel-body">
                <?php
                $attr = array(
                    'class' => 'form-horizontal',
                    'role' => 'form'
                );
                echo form_open('con_set_holiday/insert', $attr);
                ?>
                <div class="form-group">
                    <label for="HolidayDate" class="col-sm-3 control-label" >ছুটির তারিখ</label>
                    <div class="col-sm-9">
                        <input type="text" name="HolidayDate"  class="form-control" id="Date" placeholder="ছুটির তারিখ নির্বাচন করুন">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Category" class="col-sm-3 control-label" >ছুটির ধরণ</label>
                    <div class="col-sm-9">
                        <input type="text" name="Category"  class="form-control" id="id_Category" placeholder="ছুটির নাম নির্বাচন করুন ">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-success">সংরক্ষণ</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="panel-primary">
            <header class="panel-heading" >
                <h4>বাৎসরিক বরাদ্দকৃত ছুটির তালিকা</h4> 
            </header>
            <div class="panel panel-body">
                <table class="table table-condensed table-bordered table-hover">
                    <thead style="font-size: 18px">
                    <th><i class="icon icon-calendar"></i> ছুটির তারিখ</th>
                    <th><i class="icon icon-user"></i> ছুটির নাম</th>
                    <th><i class="icon icon-edit"></i> সংশোধন</th>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($tbl_holiday as $rec_holiday) {
                            ?>
                            <tr>
                                <td><?php echo date('d-m-Y', strtotime($rec_holiday->HolidayDate)); ?> </td>
                                <td><?php echo $rec_holiday->Category; ?> </td>
                                <td>
                                    <?php echo form_open('con_set_holiday/edit'); ?>
                                    <input type="hidden" name="HolidayDate" id="HolidayDate" value="<?php echo $rec_holiday->HolidayDate; ?>"/>
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
    <div class='col-lg-2'></div>
</div>
