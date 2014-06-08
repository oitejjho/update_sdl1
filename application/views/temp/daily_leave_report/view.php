<script src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script>
    $(document).ready(function() {
        $("body").on("focus", ".datepicker", function(){
            $(this).datepicker();
        });
        
        $('#leaveApprovalForm').validate({
           rules: {
               CardNo: 'required',
               NumberOfDays: 'required',
               LeaveTypeName: 'required',
               Date: 'required'
           },
           messages: {
               CardNo: 'Please enter card number',
               NumberOfDays: 'Please enter number of days',
               LeaveTypeName: 'Please select a leave type',
               Date: 'Please select a dates'
           }
        });
        
        $("#CardNo").change(function() {
            $('#Image').html('');
            $("#employeeLeaveStatus").html('');
            var CardNo = $('#CardNo').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>con_pro_daily_leave_report/get_image_designation_by_cardno",
                data: "CardNo=" + CardNo,
                success: function(data)
                {
                    if (data == '') {
                        alert('Sorry No Data Found');
                        $("#CardNo").val('');
                        $("#CardNo").focus();
                        $('#Image').html('');
                        //image.hide();
                        $('#Name').text('');
                        $('#Designation').text('');
                        $('#BuildingName').text('');
                        $('#Floor').text('');
                        $('#Department').text('');
                        $('#employeeLeaveStatus').html('');
                        return false;
                    } else if (data != '') {
                        var image = $('#Image');
                        image.append('<img src="<?php echo base_url(); ?>img/' + data[0].Image + '" height="150" width="150"/>');
                        $('#Name').text('নাম  : ' + data[0].Name);
                        $('#Designation').text('পদবী  : ' + data[0].Designation);
                        $('#BuildingName').text('ভবনের নাম  : ' + data[0].BuildingName);
                        $('#Floor').text('ফ্লোর : ' + data[0].Floor);
                        $('#Department').text('বিভাগ  : ' + data[0].Department);
                        var empStatus = $('#employeeLeaveStatus');
                        empStatus.append('<thead> <tr><th>সংক্ষিপ্ত নাম</th><th>দিন</th><th>বছর</th></tr></thead><tbody>');
                        $.each(data, function(v, k) {
                            empStatus.append("<tr><td>" + k.ShortForm + "</td><td>" + k.Days + "</td><td>" + k.Year + "</td></tr>");
                        });
                        empStatus.append('</tbody>');

                    }
                }, dataType: 'json'
            });
        });

        $('#NumberOfDays').on('change', function() {
            var days = parseInt($('#NumberOfDays').val());
            var counter = 1;
            if (days != 0) {
                while (counter <= days) {
                    var datepicker_textbox = '<div class="form-group">';
                    datepicker_textbox += '<label for="Date" class="col-sm-3 control-label" >তারিখ</label>';
                    datepicker_textbox += '<div class="col-sm-8">';
                    datepicker_textbox += '<input type="text" name="mydate[]"  class="form-control datepicker" id="Date"  placeholder="তারিখ টাইপ করুন">';
                    datepicker_textbox += '</div>';
                    datepicker_textbox += '</div>';
                    $('#genaratedDatepicker').append(datepicker_textbox);
                    counter++;
                }
            }
        });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

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

    <div class='col-lg-2'>        

    </div>
    <div class='col-lg-8'> 

        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form',
            'id' => 'leaveApprovalForm'
        );
        echo form_open('con_proc_leave_type_allocation/insert', $attr);
        ?>
        <section class="panel panel-primary">                        
            <div class="panel-heading">ছুটির অনুমোদন তথ্য</div>
            <div class="panel-body">                                
                <div class="form-group">
                    <label for="CardNo" class="col-sm-3 control-label" >কার্ড  নং</label>
                    <div class="col-sm-8">
                        <input type="text" name="CardNo"  class="form-control " id="CardNo" placeholder="কার্ড  নং টাইপ করুন">
                    </div>
                </div>
                <div class="form-group">                    
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3" id="Image" style="margin-left: 20px; margin-top: 10px;">

                        </div>
                        <div class="col-sm-5">
                            <h3 id="Name"></h3>
                            <h4 id="Designation"></h4>
                            <p id="BuildingName"></p>
                            <p id="Floor"></p>
                            <p id="Department"></p>                                                
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8">
                                <table class="table table-advance table-condensed" id="employeeLeaveStatus">

                                </table>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="NumberOfDays" class="col-sm-3 control-label" >দিনের সংখ্যা </label>
                    <div class="col-sm-8">
                        <input type="text" name="NumberOfDays"  class="form-control" id="NumberOfDays" placeholder="কত দিনের ছুটি চান টাইপ করুন?">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3" for="LeaveTypeName">ছুটির ধরনের নাম</label>
                    <div class="col-lg-8">
                        <select class ="form-control" name="LeaveTypeName" id="LeaveTypeName">
                            <option value="">--ছুটির ধরনের নাম নির্বাচন করুন--</option>
                            <?php
                            foreach ($tbl_leave_category as $rec_leave_category) {
                                echo "<option value='" . $rec_leave_category->CatagoryName . "'>" . $rec_leave_category->CatagoryName . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Note" class="col-sm-3 control-label" >নোট</label>
                    <div class="col-sm-8">
                        <textarea name="Note" id="Note" col="5" row="30" class="form-control"></textarea>
                    </div>
                </div>
                <div id="genaratedDatepicker">

                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" name="submit" class="btn btn-primary">সেভ করুন</button>
                    </div>
                </div>        
            </div>    
        </section>
        <div class='col-lg-2'></div>
    </div>
</div>
