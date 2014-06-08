<script>
    $(document).ready(function() {
        $('#JobCategoryName').on('change', function(e) {
            var jobCatName = $(this).val();
            if (jobCatName == 0) {
                var mySelect = $('#GradeName');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে বিভাগ নির্বাচন  করুন</option> ");
                var mySelect1 = $('#DesignationName');
                mySelect1.html('');
                mySelect1.append("<option>অনুগ্রহ করে গ্রেড নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_grade_mapping/get_grade_names",
                    data: "Name=" + jobCatName,
                    success: function(data)
                    {
                        var mySelect = $('#GradeName');
                        mySelect.html('');
                        mySelect.append("<option value='0'>গ্রেড নির্বাচন করুন</option> ");
                        mySelect.append("<option>------------------</option> ");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.ID + "'>" + k.Name + "</option>");
                        });
                        $('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

        $('#GradeName').on('change', function(e) {
            var gradeName = $(this).val();
            if (gradeName == 0) {
                var mySelect = $('#DesignationName');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে গ্রেড নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_grade_mapping/get_designation_list",
                    data: "GradeName=" + gradeName,
                    success: function(data)
                    {
                        var mySelect = $('#DesignationName');
                        mySelect.html('');
                        mySelect.append("<option>উপাধি নির্বাচন করুন</option> ");
                        mySelect.append("<option>------------------</option> ");
                        $.each(data, function(v, k) {

                            mySelect.append("<option value='" + k.Designation + "' data-foo='" + k.ID + "' >" + k.Designation + "</option>");
                        });
                        $('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

        $('#DesignationName').on('change', function(e) {
            var DesignationID = $(this).val();
            if (DesignationID == 0) {
                $('#GradeMappingName').val('');
            } else {
                $.ajax({
                    type: "POST",
                    data: "DesignationID=" + DesignationID,
                    url: "<?php echo base_url(); ?>con_set_grade_mapping/get_mapping_keyword",
                    dataType: 'json',
                    success: function(abc)
                    {
                        $('#GradeMappingName').val(abc.ShortForm + '-' + abc.Grade + '-' + abc.Designation);
                    }
                });
            }
        });
    });
</script>
<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#gradeMappingForm").validate({
            rules: {                
                TreatmentAllowance: "required",
                TravelAllowance: "required",
                FoodAllowance: "required",
                AttendanceBonus: "required"
            },
            messages: {                
                TreatmentAllowance: "Please enter treatment allowance",
                TravelAllowance: "Please enter travel allowance",
                FoodAllowance: "Please enter food allowance",
                AttendanceBonus: "Please enter attendance bonus"
            }
        });

    });
</script>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'id' => 'gradeMappingForm',
            'role' => 'form'
        );
        echo form_open('con_set_grade_mapping/insert', $attr);
        ?>

        <section class="panel panel-primary">                        
            <div class="panel-heading">গ্রেড ম্যাপিং তথ্যসমূহ</div>
            <div class="panel-body">                                                          
                <div class="form-group">
                    <label for="JobCategoryName" class="col-lg-3 control-label" >পেশা বিভাগের নাম</label>
                    <div class="col-lg-6">                            
                        <select class ="form-control" name="JobCategoryName" id="JobCategoryName">
                            <option value="0">বিভাগ নির্বাচন করুন</option>
                            <option>------------------------</option>
                            <?php foreach ($tbl_job_category as $rec_job_category) { ?>
                                <option value="<?php echo $rec_job_category->ID; ?>"><?php echo $rec_job_category->CategoryName; ?></option>
                            <?php } ?>                                
                        </select>                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="GradeName" class="col-lg-3 control-label" >গ্রেডের নাম</label>
                    <div class="col-lg-6">                            
                        <select class ="form-control" name="GradeName" id="GradeName">                                                                       
                        </select>
                        <input type="hidden" name="GradeKeyword" id="GradeKeyword" value=""/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="DesignationName" class="col-lg-3 control-label" >উপাধির নাম </label>
                    <div class="col-lg-6">                            
                        <select class ="form-control" name="DesignationName" id="DesignationName">                                                                       
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="GradeMappingName" class="col-lg-3 control-label" >গ্রেড ম্যাপিং নাম</label>
                    <div class="col-lg-6">
                        <input type="text" name="GradeMappingName"  class="form-control" id="GradeMappingName" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Description" class="col-lg-3 control-label" >বর্ণনা</label>
                    <div class="col-lg-6">                        
                        <textarea name="Description" id="Description" class="form-control" cols="5" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="TreatmentAllowance" class="col-lg-3 control-label" >চিকিৎসা ভাতা</label>
                    <div class="col-lg-6">
                        <input type="text" name="TreatmentAllowance"  class="form-control" id="TreatmentAllowance" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="TravelAllowance" class="col-lg-3 control-label" >ভ্রমন ভাতা</label>
                    <div class="col-lg-6">
                        <input type="text" name="TravelAllowance"  class="form-control" id="TravelAllowance">
                    </div>
                </div>

                <div class="form-group">
                    <label for="FoodAllowance" class="col-lg-3 control-label" >খাবার ভাতা</label>
                    <div class="col-lg-6">
                        <input type="text" name="FoodAllowance"  class="form-control" id="FoodAllowance" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="AttendanceBonus" class="col-lg-3 control-label" >হাজিরা বোনাস</label>
                    <div class="col-lg-6">
                        <input type="text" name="AttendanceBonus"  class="form-control" id="AttendanceBonus" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6 col-lg-push-3">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php echo form_close(); ?>
    <div class="col-md-2"></div>
</div>