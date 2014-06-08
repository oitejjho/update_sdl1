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

<div class="row">
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
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <section class="panel panel-primary">                        
            <div class="panel-heading">গ্রেড ম্যাপিং তথ্যসমূহ</div>
            <div class="panel-body"> 
                <?php
                $attr = array(
                    'class' => 'form-horizontal',
                    'id' => 'gradeMappingForm',
                    'role' => 'form'
                );
                echo form_open('con_set_grade_mapping/edit', $attr);
//                        echo '<pre>';
//            print_r($tbl_grade_mapping);
//            echo '</pre>';
//            exit();
                ?>
                <input type="hidden" name="ID" value="<?php echo $tbl_grade_mapping->ID; ?>"/>
                <div class="form-group">
                    <label for="JobCategoryName" class="col-lg-3 control-label" >পেশা বিভাগের নাম</label>
                    <div class="col-lg-6">                            
                        <select class ="form-control" name="JobCategoryName" id="JobCategoryName">
                            <<option value="0">বিভাগ নির্বাচন করুন</option>
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
                        <textarea name="Description" id="Description" class="form-control" cols="5" rows="5" value="<?php echo $tbl_grade_mapping->Descrip; ?>"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="TreatmentAllowance" class="col-lg-3 control-label" >চিকিৎসা ভাতা</label>
                    <div class="col-lg-6">
                        <input type="text" name="TreatmentAllowance"  class="form-control" id="TreatmentAllowance" value="<?php echo $tbl_grade_mapping->TreatmentAllowance; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="TravelAllowance" class="col-lg-3 control-label" >ভ্রমন ভাতা</label>
                    <div class="col-lg-6">
                        <input type="text" name="TravelAllowance"  class="form-control" id="TravelAllowance" value="<?php echo $tbl_grade_mapping->TravelAllowance; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="FoodAllowance" class="col-lg-3 control-label" >খাবার ভাতা</label>
                    <div class="col-lg-6">
                        <input type="text" name="FoodAllowance"  class="form-control" id="FoodAllowance" value="<?php echo $tbl_grade_mapping->FoodAllowance; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="AttendanceBonus" class="col-lg-3 control-label" >হাজিরা বোনাস</label>
                    <div class="col-lg-6">
                        <input type="text" name="AttendanceBonus"  class="form-control" id="AttendanceBonus" value="<?php echo $tbl_grade_mapping->AttendanceBonus; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6 col-lg-push-3">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>

    <div class="col-md-2"></div>
</div>