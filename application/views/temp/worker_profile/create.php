<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

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
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <section class="panel-success">
            <div class="bio-graph-heading" style="font-size: 30px"><i class="icon icon-user"></i>
                শ্রমিক এবং কর্মচারীগণের নিবন্ধন 
            </div>          
            <?php
            $attr = array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'default',
                'role' => 'form'
            );
            echo form_open_multipart('con_set_worker_profile/insert', $attr);
            ?>     
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">কর্মরত ভবনের তথ্য</div>
                    <div class="panel-body">
                        <?php
                        $role = array(
                            'WG4' => 'WG4',
                        );
                        ?>
                        <div class="form-group">
                            <label for="CardNo" class="col-lg-3 control-label" >কার্ড নং</label>
                            <div class="col-lg-9">
                                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" placeholder="কার্ড নং টাইপ করুন">
                            </div>
                        </div>
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
                                    <select class ="form-control" style="overflow-y: scroll !important;" name="Floor" id="Floor" readonly>
                                        <option value="<?php echo $this->session->userdata('Floor'); ?>"><?php echo $this->session->userdata('Floor'); ?></option>
                                    </select>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3" for="Department">বিভাগ</label>
                            <div class="col-lg-9">
                                <select class ="form-control" name="Department" id="Floor">
                                    <option value="">--Select One--</option>
                                    <?php foreach ($tbl_section as $rec_section) { ?>
                                        <option value="<?php echo $rec_section->Name; ?>"><?php echo $rec_section->Name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="hidden">
                            <label class="control-label col-lg-3" for="Line">লাইন</label>
                            <div class="col-lg-9">
                                <select class ="form-control" name="Line" id="Line">
                                    <option value="">--Select One--</option>

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
                                <input type="text" name="Name" class="form-control" class="required" id="Name" placeholder="নাম টাইপ করুন">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="EducationalQual" class="col-sm-3 control-label" >শিক্ষাগত যোগ্যতা</label>
                            <div class="col-lg-9">
                                <input type="text" name="EducationalQual"  class="form-control required" id="id_EducationalQual" placeholder="শিক্ষাগত যোগ্যতা টাইপ করুন">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ContactNo" class="col-sm-3 control-label" >মোবাইল নম্বর</label>
                            <div class="col-lg-9">
                                <input type="text" name="ContactNo"  class="form-control" id="id_ContactNo" placeholder="মোবাইল নম্বর টাইপ করুন">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="NID" class="col-sm-3 control-label" >জাতীয় পরিচয় পত্র নম্বর</label>
                            <div class="col-lg-9">
                                <input type="text" name="NID"  class="form-control" id="id_NID" placeholder="জাতীয় পরিচয় পত্রের নম্বর টাইপ করুন">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Image" class="col-sm-3 control-label" >ছবি</label>
                            <div class="col-lg-9">
                                <input type="file" class="file-pos" id="exampleInputFile" name="userfile" accept="img/*" id="Image">                                    
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">স্থায়ী ঠিকানা</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="PermanentDistrict" class="col-sm-3 control-label" > জেলা</label>
                            <div class="col-sm-9">                                
                                <select name="PermanentDistrict"  class="form-control" id="PermanentDistrict">
                                    <option value="">জেলা নির্বাচন করুন</option>
                                    <option value="">-----------------</option>
                                    <?php foreach ($tbl_district as $rec_district) { ?>
                                        <option value="<?php echo $rec_district->District; ?>" data-foo="<?php echo $rec_district->DistrinctEng; ?>"> <?php echo $rec_district->District; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PermanentThana" class="col-sm-3 control-label" > থানা</label>
                            <div class="col-sm-9">                                
                                <select name="PermanentThana"  class="form-control" id="PermanentThana">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PermanenttPost" class="col-sm-3 control-label"> ডাকঘর</label>
                            <div class="col-sm-9">                                
                                <select name="PermanenttPost"  class="form-control" id="PermanenttPost">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PermanentVillage" class="col-sm-3 control-label" > গ্রাম</label>
                            <div class="col-sm-9">
                                <input type="text" name="PermanentVillage"  class="form-control" id="id_PermanentVillage" placeholder="গ্রাম টাইপ করুন">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">বর্তমান ঠিকানা</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="PresentDistrict" class="col-sm-3 control-label" >জেলা</label>
                            <div class="col-sm-9">                                
                                <select name="PresentDistrict"  class="form-control" id="PresentDistrict">
                                    <option value="">জেলা নির্বাচন করুন</option>
                                    <option value="">-----------------</option>
                                    <?php foreach ($tbl_district as $rec_district) { ?>
                                        <option value="<?php echo $rec_district->District; ?>" data-foo="<?php echo $rec_district->DistrinctEng; ?>"> <?php echo $rec_district->District; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="PresentThana" class="col-sm-3 control-label" > থানা</label>
                            <div class="col-sm-9">                                
                                <select name="PresentThana"  class="form-control" id="PresentThana">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PresentPost" class="col-sm-3 control-label" > ডাকঘর</label>
                            <div class="col-sm-9">                                
                                <select name="PresentPost"  class="form-control" id="PresentPost">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PresentVillage" class="col-sm-3 control-label" > গ্রাম</label>
                            <div class="col-sm-9">
                                <input type="text" name="PresentVillage"  class="form-control" id="id_PresentVillage" placeholder="গ্রাম টাইপ করুন">
                            </div>
                        </div>                                                
                    </div>
                </div>
            </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">শ্রমিক/ কর্মচারী গ্রেড নির্বাচন</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="JobCategoryName" class="col-lg-3 control-label" >পেশা বিভাগের নাম</label>
                            <div class="col-lg-9">                            
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
                            <div class="col-lg-9"> 
                                <select class ="form-control" name="Grade" id="GradeName">                                                                       
                                </select>
                                <input type="hidden" name="GradeKeyword" id="GradeKeyword" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DesignationName" class="col-lg-3 control-label" >উপাধির নাম </label>
                            <div class="col-lg-9">                            
                                <select class ="form-control" name="Designation" id="DesignationName">                                                                       
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="GradeMappingName" class="col-lg-3 control-label" >গ্রেড ম্যাপিং নাম</label>
                            <div class="col-lg-9">
                                <input type="text" name="Parameter5"  class="form-control" id="GradeMappingName" readonly/>
                            </div>
                        </div>                                                                       
                    </div>
                </div>
            </section>

<!--            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading">শ্রমিক/ কর্মচারী কাজের তথ্য</div>
                    <div class="panel-body"> 
                        <div class="form-group">
                            <label for="CardNo" class="col-sm-2 control-label" >কার্ড নং</label>
                            <div class="col-sm-4">
                                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" placeholder="কার্ড নং টাইপ করুন">
                            </div>
                            <label for="GrossSalary" class="col-sm-2 control-label" >মূল বেতন</label>
                            <div class="col-sm-4">
                                <input type="text" name="GrossSalary"  class="form-control" id="id_GrossSalary" placeholder="মূল বেতন টাইপ করুন">
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label for="OT" class="col-sm-2 control-label" >ওভার টাইম</label>
                            <div class="col-sm-4">
                                <input type="text" name="OT"  class="form-control" id="OT" placeholder="ওভার টাইম টাইপ করুন">
                                <select name="OT"  class="form-control" id="OT">
                                    <option value="">--ওভার টাইম নির্বাচন করুন--</option>
                                    <option value="1">হ্যাঁ</option>
                                    <option value="0">না</option>
                                </select>
                            </div>
                            <label for="AttendanceBonus" class="col-sm-2 control-label" >উপস্থিতি বোনাস</label>
                            <div class="col-sm-4">
                                <input type="text" name="AttendanceBonus"  class="form-control" id="AttendanceBonus" placeholder="উপস্থিতি বোনাস টাইপ করুন">
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label for="OtherAllowance" class="col-sm-2 control-label" >অন্যান্য ভাতা</label>
                            <div class="col-sm-4">
                                <input type="text" name="OtherAllowance"  class="form-control" id="OtherAllowance" placeholder="অন্যান্য ভাতা টাইপ করুন">
                            </div>
                            <label for="OthAllowCal" class="col-sm-2 control-label" >অন্যান্য ভাতা হিসাব</label>
                            <div class="col-sm-4">
                                <input type="text" name="OthAllowCal"  class="form-control" id="OthAllowCal" placeholder="মূল বেতন টাইপ করুন">
                                <select name="OthAllowCal"  class="form-control" id="OthAllowCal" readonly>
                                    <option value="">--অন্যান্য ভাতা নির্বাচন করুন--</option>
                                    <option value="F">নির্দিষ্ট</option>
                                    <option value="M">মাসিক</option>
                                </select>
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label for="LastIncrementMoney" class="col-sm-2 control-label" >সর্বশেষ বর্ধিত টাকা</label>
                            <div class="col-sm-4">
                                <input type="text" name="LastIncrementMoney"  class="form-control" id="id_LastIncrementMoney" placeholder="সর্বশেষ বর্ধিত টাকা টাইপ করুন">
                            </div>
                            <label for="LastIncrementDate" class="col-sm-2 control-label" >সর্বশেষ বর্ধিত তারিখ</label>
                            <div class="col-sm-4">
                                <input type="text" name="LastIncrementDate"  class="form-control" id="LastIncrementDate" placeholder="সর্বশেষ বর্ধিত তারিখ নির্বাচন করুন">
                            </div>                            
                        </div>                    
                        <div class="form-group">
                            <label for="JoiningDate" class="col-sm-2 control-label" >যোগদানের তারিখ</label>
                            <div class="col-sm-4">
                                <input type="text" name="JoiningDate"  class="form-control" id="JoiningDate" placeholder="যোগদানের তারিখ নির্বাচন করুন">
                            </div>
                            <label for="PromotionDate" class="col-sm-2 control-label" >পদোন্নতির তারিখ</label>
                            <div class="col-sm-4">
                                <input type="text" name="PromotionDate"  class="form-control" id="PromotionDate" placeholder="পদোন্নতির তারিখ নির্বাচন করুন">
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
                                <input type="text" name="GuardianName"  class="form-control" id="id_GuardianName" placeholder="স্বামী / পিতার নাম টাইপ করুন">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Reference" class="col-sm-3 control-label" >রেফারেন্স</label>
                            <div class="col-sm-9">
                                <input type="text" name="Reference"  class="form-control" id="id_Reference" placeholder="রেফারেন্স টাইপ করুন">
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label for="Comment" class="col-sm-3 control-label" >মন্তব্য</label>
                            <div class="col-sm-9">
                                <input type="text" name="Comment"  class="form-control" id="id_Comment" placeholder="মন্তব্য টাইপ করুন">
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
        </section>
    </div>
    <div class="col-lg-2"></div>
</div>
