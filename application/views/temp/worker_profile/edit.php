<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/css/datepicker.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#LastIncrementDate').datepicker();
    });
    $(document).ready(function() {
        $('#JoiningDate').datepicker();
    });
    $(document).ready(function() {
        $('#PromotionDate').datepicker();
    });
</script>



<script type="text/javascript">
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
                            mySelect.append("<option value='" + k.Name + "' data-foo='" + k.ID + "'>" + k.Name + "</option>");
                        });
                        $('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

        $('#GradeName').on('change', function(e) {
            var selected = $(this).find('option:selected');
            var gradeName = selected.data('foo');
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

<script>
    $(document).ready(function() {

        //Permanent District
        $('#PermanentDistrict').on('change', function(e) {

            var selected = $(this).find('option:selected');
            var district = selected.data('foo');

            if (district == 0) {
                var mySelect = $('#PermanentThana');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে জেলা নির্বাচন  করুন</option> ");
                var mySelect1 = $('#PermanenttPost');
                mySelect1.html('');
                mySelect1.append("<option>অনুগ্রহ করে থানা নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_worker_profile/get_thana_name",
                    data: "District=" + district,
                    success: function(data)
                    {
                        var mySelect = $('#PermanentThana');
                        mySelect.html('');
                        mySelect.append("<option value='0'>থানা নির্বাচন করুন</option> ");
                        mySelect.append("<option>------------------</option> ");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.Thana + "' data-foo='" + k.ThanaEng + "' >" + k.Thana + "</option>");
                        });
                        //$('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

        //Permanent Thana
        $('#PermanentThana').on('change', function(e) {
            var selected = $(this).find('option:selected');
            var thana = selected.data('foo');
            if (thana == 0) {
                var mySelect = $('#PermanenttPost');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে থানা নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_worker_profile/get_po_name",
                    data: "Thana=" + thana,
                    success: function(data)
                    {
                        var mySelect = $('#PermanenttPost');
                        mySelect.html('');
                        mySelect.append("<option>পোস্ট অফিস নির্বাচন করুন</option> ");
                        mySelect.append("<option>------------------</option> ");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.PO + "' data-foo='" + k.POEng + "'>" + k.PO + "</option>");
                        });
                        //$('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

        //Present District
        $('#PresentDistrict').on('change', function(e) {
            var selected = $(this).find('option:selected');
            var district = selected.data('foo');
            if (district == 0) {
                var mySelect = $('#PresentThana');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে জেলা নির্বাচন  করুন</option> ");
                var mySelect1 = $('#PresentPost');
                mySelect1.html('');
                mySelect1.append("<option>অনুগ্রহ করে থানা নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_worker_profile/get_thana_name",
                    data: "District=" + district,
                    success: function(data)
                    {
                        var mySelect = $('#PresentThana');
                        mySelect.html('');
                        mySelect.append("<option value='0'>থানা নির্বাচন করুন</option> ");
                        mySelect.append("<option>------------------</option> ");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.Thana + "'  data-foo='" + k.ThanaEng + "'>" + k.Thana + "</option>");
                        });
                        //$('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

        //Present Thana
        $('#PresentThana').on('change', function(e) {
            var selected = $(this).find('option:selected');
            var thana = selected.data('foo');
            if (thana == 0) {
                var mySelect = $('#PresentPost');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে থানা নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_worker_profile/get_po_name",
                    data: "Thana=" + thana,
                    success: function(data)
                    {
                        var mySelect = $('#PresentPost');
                        mySelect.html('');
                        mySelect.append("<option>পোস্ট অফিস নির্বাচন করুন</option> ");
                        mySelect.append("<option>------------------</option> ");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.PO + "' data-foo='" + k.POEng + "'>" + k.PO + "</option>");
                        });
                        //$('#GradeKeyword').val(data.Keyword);
                    }, dataType: 'json'
                });
            }
        });

    });
</script>

<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <section class="panel-success">
            <div class="bio-graph-heading" style="font-size: 30px"><i class="icon icon-user"></i>
                শ্রমিক এবং কর্মচারীগণের নিবন্ধন 
            </div>          
            <?php
            $ot_array = array(1 => 'হ্যাঁ', 0 => 'না');
            $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
            $attr = array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'default',
                'role' => 'form'
            );
            echo form_open_multipart('con_set_worker_profile/update_employee', $attr);
            foreach ($tbl_worker_profile as $worker_profile) {
                
            }
            ?> 
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">কর্মরত ভবনের তথ্য</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="CardNo" class="col-sm-3 control-label" >কার্ড নং</label>
                            <div class="col-sm-9">
                                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" value="<?php echo str_replace(range(0, 9), $bn_digits, $worker_profile->CardNo); ?>" readonly>
                            </div>
                        </div>
                        <?php
                        $role = array(
                            'WG4' => 'WG4',
                        );
                        ?>
                        <div class="form-group">
                            <label class="control-label col-lg-3" for="BuildingName">ভবনের নাম</label>
                            <div class="col-lg-9">
                                <select class ="form-control" name="BuildingName" id="BuildingName" readonly>
                                    <option value="<?php echo $this->session->userdata('BuildingName'); ?>"><?php echo $this->session->userdata('BuildingName'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3" for="Floor">ফ্লোর</label>
                            <div class="col-lg-9">
                                <p>
                                    <select class ="form-control"  name="Floor" id="Floor">
                                        <?php
                                        if (is_array($floor_info)) {


                                            foreach ($floor_info as $flors) {
                                                ?>
                                                <option value="<?php echo $flors['Name']; ?>"><?php echo $flors['Name']; ?></option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="<?php echo $floor_info; ?>"><?php echo $floor_info; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3" for="Department">বিভাগ</label>
                            <div class="col-lg-9">
                                <select class ="form-control" name="Department" id="Floor" value="<?php echo set_value('Department'); ?>">
                                    <?php foreach ($tbl_section as $rec_section) { ?>
                                        <option value="<?php echo $rec_section->Name; ?>"><?php echo $rec_section->Name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="hidden">
                            <label class="control-label col-lg-3" for="Line">লাইন</label>
                            <div class="col-lg-9">
                                <select class ="form-control" name="Line" id="Line" >
                                    <option value="<?php echo $rec_worker_profile->Line; ?>"><?php echo $rec_worker_profile->Line; ?></option>

                                </select>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section> 
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">ব্যক্তিগত তথ্য</div>
                    <div class="panel-body">                             
                        <div class="form-group">
                            <label class="col-lg-3 control-label" >নাম</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="id" class="form-control"  value="<?php echo $this->uri->segment(3); ?>">
                                <input type="text" name="Name" class="form-control" class="required" id="Name" value="<?php echo $worker_profile->Name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="EducationalQual" class="col-sm-3 control-label" >শিক্ষাগত যোগ্যতা</label>
                            <div class="col-lg-9">
                                <input type="text" name="EducationalQual"  class="form-control required" id="id_EducationalQual" value="<?php echo $worker_profile->EducationalQual; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ContactNo" class="col-sm-3 control-label" >মোবাইল নম্বর</label>
                            <div class="col-lg-9">
                                <input type="text" name="ContactNo"  class="form-control" id="id_ContactNo" value="<?php echo $worker_profile->ContactNo; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="NID" class="col-sm-3 control-label" >জাতীয় পরিচয় পত্র নম্বর</label>
                            <div class="col-lg-9">
                                <input type="text" name="NID"  class="form-control" id="id_NID" value="<?php echo $worker_profile->NID; ?>">
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">স্থায়ী ঠিকানা</div>
                    <div class="panel-body">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="PermanentDistrict" class="col-sm-3 control-label" > জেলা</label>
                                <div class="col-sm-9">                                
                                    <select name="PermanentDistrict"  class="form-control" id="PermanentDistrict">
                                        <option value=""><?php echo $worker_profile->PermanentDistrict; ?></option>
                                        <option value="">-----------------</option>
                                        <?php foreach ($tbl_district as $rec_district) { ?>
                                            <option value="<?php echo $rec_district->District; ?>" <?php if ($rec_district->District == $worker_profile->PermanentDistrict) echo 'selected'; ?> data-foo="<?php echo $rec_district->DistrinctEng; ?>"> <?php echo $rec_district->District; ?> </option>
<?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PermanentThana" class="col-sm-3 control-label" > থানা</label>
                                <div class="col-sm-9">                                
                                    <select name="PermanentThana"  class="form-control" id="PermanentThana">
                                        <?php
                                        if ($worker_profile->PermanentThana) {
                                            ?>
                                            <option value="<?php echo $worker_profile->PermanentThana; ?>"><?php echo $worker_profile->PermanentThana; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PermanenttPost" class="col-sm-3 control-label"> ডাকঘর</label>
                                <div class="col-sm-9">                                
                                    <select name="PermanenttPost"  class="form-control" id="PermanenttPost">
                                        <?php
                                        if ($worker_profile->PermanenttPost) {
                                            ?>
                                            <option value="<?php echo $worker_profile->PermanenttPost; ?>"><?php echo $worker_profile->PermanenttPost; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PermanentVillage" class="col-sm-3 control-label" > গ্রাম</label>
                                <div class="col-sm-9">
                                    <input type="text" name="PermanentVillage"  class="form-control" id="id_PermanentVillage" value="<?php echo $worker_profile->PermanentVillage; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="EducationalQual" class="col-sm-3 control-label" >র্পূবর্বতী স্থায়ী ঠিকানা</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="PreviousParmanentAddress" value="<?php echo $worker_profile->PreviousParmanentAddress; ?>" rows="5"><?php echo $worker_profile->PreviousParmanentAddress; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">বর্তমান ঠিকানা</div>
                    <div class="panel-body">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="PresentDistrict" class="col-sm-3 control-label" >জেলা</label>
                                <div class="col-sm-9">                                
                                    <select name="PresentDistrict"  class="form-control" id="PresentDistrict">
                                        <option value=""><?php echo $worker_profile->PresentDistrict; ?></option>
                                        <option value="">-----------------</option>
                                        <?php foreach ($tbl_district as $rec_district) { ?>
                                            <option value="<?php echo $rec_district->District; ?>" <?php if ($rec_district->District == $worker_profile->PresentDistrict) echo 'selected'; ?> data-foo="<?php echo $rec_district->DistrinctEng; ?>"> <?php echo $rec_district->District; ?> </option>
<?php } ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="PresentThana" class="col-sm-3 control-label" > থানা</label>
                                <div class="col-sm-9">                                
                                    <select name="PresentThana"  class="form-control" id="PresentThana">
                                        <?php
                                        if ($worker_profile->PresentThana) {
                                            ?>
                                            <option value="<?php echo $worker_profile->PresentThana; ?>"><?php echo $worker_profile->PresentThana; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PresentPost" class="col-sm-3 control-label" > ডাকঘর</label>
                                <div class="col-sm-9">                                
                                    <select name="PresentPost"  class="form-control" id="PresentPost">
                                        <?php
                                        if ($worker_profile->PresentPost) {
                                            ?>
                                            <option value="<?php echo $worker_profile->PresentPost; ?>"><?php echo $worker_profile->PresentPost; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PresentVillage" class="col-sm-3 control-label" > গ্রাম</label>
                                <div class="col-sm-9">
                                    <input type="text" name="PresentVillage"  class="form-control" id="id_PresentVillage" value="<?php echo $worker_profile->PresentVillage; ?>">
                                </div>
                            </div> 
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="EducationalQual" class="col-sm-3 control-label" >র্পূবর্বতী বর্তমান ঠিকানা</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="PreviousPresentAddress" value="<?php echo $worker_profile->PreviousPresentAddress; ?>" rows="5"><?php echo $worker_profile->PreviousPresentAddress; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">শ্রমিক/ কর্মচারী গ্রেড নির্বাচন</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6" style="margin-left: 8px;">
                                <div class="form-group">
                                    <label for="JobCategoryName" class="col-lg-3 control-label" >পেশা বিভাগের নাম</label>
                                    <div class="col-lg-9">                            
                                        <select class ="form-control" name="JobCategoryName" id="JobCategoryName">
                                            <option value="0">বিভাগ নির্বাচন করুন</option>
                                            <option>----------------------------</option>                                    
                                            <?php foreach ($tbl_job_category as $rec_job_category) { ?>
                                                <option value="<?php echo $rec_job_category->ID; ?>" <?php if ($workerlistOfselect == $rec_job_category->ID) echo 'selected'; ?>><?php echo $rec_job_category->CategoryName; ?></option>
<?php } ?>                                
                                        </select>                        
                                    </div>
                                </div>                        
                                <div class="form-group">                            
                                    <label for="GradeName" class="col-lg-3 control-label" >গ্রেডের নাম</label>
                                    <div class="col-lg-9"> 
                                        <select class ="form-control" name="Grade" id="GradeName">
                                            <?php foreach ($jobcatinfo as $rec_job_categorys) { ?>
                                                <option value="<?php echo $rec_job_categorys->ID; ?>" <?php if ($worker_profile->Grade == $rec_job_categorys->Keyword) echo 'selected'; ?>><?php echo $rec_job_categorys->Name; ?></option>
<?php } ?>   
                                        </select>
                                        <input type="hidden" name="GradeKeyword" id="GradeKeyword" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="DesignationName" class="col-lg-3 control-label" >উপাধির নাম </label>
                                    <div class="col-lg-9">                            
                                        <select class ="form-control" name="Designation" id="DesignationName"> 
                                            <?php //foreach ($designationList as $rec_designation) {   ?>
                                            <option value="<?php echo $worker_profile->Designation; ?>"><?php echo $worker_profile->Designation; ?></option>
<?php //}   ?>
                                        </select>
                                    </div>                            
                                </div>
                                <div class="form-group">
                                    <label for="GradeMappingName" class="col-lg-3 control-label" >গ্রেড ম্যাপিং নাম</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="Parameter5"  class="form-control" id="GradeMappingName" readonly value="<?php echo $worker_profile->Parameter5; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="JobCategoryName" class="col-lg-3 control-label" >পূর্ববর্তী বিভাগের নাম</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="JobCategoryName1" id="JobCategoryName" value="<?php echo $worker_profile->Department; ?>" readonly/>                                                                  
                                    </div>
                                </div>                        
                                <div class="form-group">                            
                                    <label for="GradeName" class="col-lg-3 control-label" >পূর্ববর্তী গ্রেডের নাম</label>
                                    <div class="col-lg-9"> 
                                        <input type="text" class="form-control" name="Grade1" id="Grade" value="<?php echo $worker_profile->Grade; ?>" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="DesignationName" class="col-lg-3 control-label" >পূর্ববর্তী পদবীর নাম </label>
                                    <div class="col-lg-9"> 
                                        <input type="text" class="form-control" name="Designation1" id="Designation" value="<?php echo $worker_profile->Designation; ?>" readonly/>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<!--            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">শ্রমিক/ কর্মচারী কাজের তথ্য</div>
                    <div class="panel-body"> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="OT" class="col-sm-3 control-label" >ওভার টাইম</label>
                                <div class="col-sm-9">
                                    <select name="OT"  class="form-control" id="OT">
                                        <option value="<?php //echo $ot_array[$worker_profile->OT];  ?>"><?php //echo $ot_array[$worker_profile->OT];  ?></option>
                                        <option value="">-----</option>
                                        <option value="1">হ্যাঁ</option>
                                        <option value="0">না</option>
                                    </select>
                                </div>                                                        
                            </div>
                            <div class="form-group">
                                <label for="AttendanceBonus" class="col-sm-3 control-label" >উপস্থিতি বোনাস</label>
                                <div class="col-sm-9">
                                    <input type="text" name="AttendanceBonus"  class="form-control" id="AttendanceBonus" value="<?php //echo str_replace(range(0, 9), $bn_digits, $worker_profile->AttendanceBonus);  ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="LastIncrementDate" class="col-sm-3 control-label" >সর্বশেষ বর্ধিত তারিখ</label>
                                <div class="col-sm-8  date" id="LastIncrementDate" data-date="<?php //echo $worker_profile->LastIncrementDate;  ?>" data-date-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" name="LastIncrementDate"  value="<?php //echo str_replace(range(0, 9), $bn_digits, $worker_profile->LastIncrementDate);  ?>">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="JoiningDate" class="col-sm-3 control-label" >যোগদানের তারিখ</label>
                                <div class="col-sm-8 date" id="JoiningDate" data-date="<?php //echo $worker_profile->JoiningDate;  ?>" data-date-format="yyyy-mm-dd">
                                    <input type="text" name="JoiningDate"  class="form-control" id="JoiningDate" value="<?php //echo str_replace(range(0, 9), $bn_digits, $worker_profile->JoiningDate);  ?>">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="GrossSalary" class="col-sm-3 control-label" >মোট বেতন</label>
                                <div class="col-sm-9">
                                    <input type="text" name="GrossSalary"  class="form-control" id="id_GrossSalary" value="<?php //echo str_replace(range(0, 9), $bn_digits, $worker_profile->GrossSalary);  ?>">
                                </div>                        
                            </div>
                            <div class="form-group">
                                <label for="OtherAllowance" class="col-sm-3 control-label" >অন্যান্য ভাতা</label>
                                <div class="col-sm-9">
                                    <input type="text" name="OtherAllowance"  class="form-control" id="OtherAllowance" value="<?php //echo str_replace(range(0, 9), $bn_digits, $worker_profile->OtherAllowance);  ?>">
                                </div>                                                        
                            </div>
                            <div class="form-group">
                                <label for="OthAllowCal" class="col-sm-3 control-label" >অন্যান্য ভাতা হিসাব</label>
                                <div class="col-sm-9">
                                    <select name="OthAllowCal"  class="form-control" id="OthAllowCal" readonly>
                                        <option value="F">নির্দিষ্ট</option>
                                        <option value="M">মাসিক</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="LastIncrementMoney" class="col-sm-3 control-label" >সর্বশেষ বর্ধিত টাকা</label>
                                <div class="col-sm-9">
                                    <input type="text" name="LastIncrementMoney"  class="form-control" id="id_LastIncrementMoney" value="<?php echo str_replace(range(0, 9), $bn_digits, $worker_profile->LastIncrementMoney); ?>">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="PromotionDate" class="col-sm-3 control-label" >পদোন্নতির তারিখ</label>
                                <div class="col-sm-8 date" id="PromotionDate" data-date="<?php //echo $worker_profile->PromotionDate;  ?>" data-date-format="yyyy-mm-dd">
                                    <input type="text" name="PromotionDate"  class="form-control" id="PromotionDate" value="<?php //echo str_replace(range(0, 9), $bn_digits, $worker_profile->PromotionDate);  ?>">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>                -->                      

            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">রেফারেন্স এবং স্ট্যাটাস</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="GuardianName" class="col-sm-3 control-label" >স্বামী / পিতার নাম</label>
                            <div class="col-sm-9">
                                <input type="text" name="GuardianName"  class="form-control" id="id_GuardianName" value="<?php echo $worker_profile->GuardianName; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Reference" class="col-sm-3 control-label" >রেফারেন্স</label>
                            <div class="col-sm-9">
                                <input type="text" name="Reference"  class="form-control" id="id_Reference" value="<?php echo $worker_profile->Reference; ?>">
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label for="Comment" class="col-sm-3 control-label" >মন্তব্য</label>
                            <div class="col-sm-9">
                                <input type="text" name="Comment"  class="form-control" id="id_Comment" value="<?php echo $worker_profile->Comment; ?>">
                            </div>
                        </div>                        
                    </div>
                </div>
                <section>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class=" col-lg-10 col-lg-push-3">
                                    <button id="update" class="btn btn-success" value="Update" name="update" type="submit">Save</button>
                                    <button class="btn btn-default" type="button">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                echo form_close();
                ?>
            </section>
    </div>
    <div class="col-lg-1"></div>
</div>
