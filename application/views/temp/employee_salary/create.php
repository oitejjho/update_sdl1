<link rel="stylesheet" type="text/css" href="<?php //echo base_url();  ?>assets/bootstrap-datepicker/css/datepicker.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

//        $("body").on("focus", ".datepicker", function() {
//            $(this).datepicker();
//        });

        $("#LastIncrementDate").datepicker();
        $("#PromotionDate").datepicker();

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
        $("#employeeSalaryInsertUpdateForm").validate({
            rules: {
                GradeName: "required",
                DesignationName: "required",
                CardNo: {
                    required: true,
                    max: 65500,
                    remote:
                            {
                                url: '<?php echo base_url(); ?>con_set_employee_salary/check_cardno_availibility',
                                type: "post",
                                data:
                                        {
                                            cardno: function()
                                            {
                                                return $('#employeeSalaryInsertUpdateForm :input[name="CardNo"]').val();
                                            }
                                        }
                            }
                },
                GrossSalary: "required",
                LastIncrementDate: "required",
                LastIncrementMoney: "required",
                PromotionDate: "required",
                AttendanceBonus: "required",
                OtherAllowance: "required"
            },
            messages: {
                GradeName: "অনুগ্রহ করে গ্রেডের নাম টাইপ করুন",
                DesignationName: "অনুগ্রহ করে উপাধির নাম টাইপ করুন",
                CardNo: {
                    required: "অনুগ্রহ করে কার্ড নং টাইপ করুন",
                    remote: "দুঃখিত এই কার্ড নাম্বারটি বর্তমানে ডাটাবেইস এ আছে। দয়া করে অন্য কার্ড নাম্বার দিয়ে চেষ্টা করুন",
					max: "কার্ড নং অবশ্যই (১-৬৫৫০০) এর মধ্যে হতে হবে"
                },
                GrossSalary: "অনুগ্রহ করে মূল বেতন টাইপ করুন",
                LastIncrementDate: "অনুগ্রহ করে সর্বশেষ বর্ধিত তারিখ নির্বাচন করুন",
                LastIncrementMoney: "অনুগ্রহ করে সর্বশেষ বর্ধিত টাকা টাইপ করুন",
                PromotionDate: "অনুগ্রহ করে পদোন্নতির তারিখ নির্বাচন করুন",
                AttendanceBonus: "অনুগ্রহ করে উপস্থিত বোনাস টাইপ করুন",
                OtherAllowance: "অনুগ্রহ করে অন্যান্য ভাতা টাইপ করুন"
            }
        });


        $("#searchButton").click(function() {
            var cardno = $("#Search").val();
            if (cardno == '') {
                alert('অনুগ্রহ করে কার্ড নং টাইপ করে অনুসন্ধান করুন');
                $("#Search").focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_employee_salary/get_employee_salary_by_cardno_json_result",
                    data: "CardNo=" + cardno,
                    success: function(data)
                    {
                        if (data == '') {
                            alert('দুঃখিত এই কার্ড নাম্বারের তথ্য নেই । দয়া করে অন্য কার্ড নাম্বার দ্বারা অনুসন্ধান করুন');
                            $("#Search").val('');
                            $("#Search").focus();
                        } else if (data != '') {
                       	    $("#GradeName").html('');
                            $("#DesignationName").html('');
                            $("#CardNoDiv").hide();
                            $("#CardNoHidden").val(data.CardNo);
                            $("#GradeName").append('select <option value="' + data.Grade + '">' + data.Grade + '</option>');
                            $("#DesignationName").append('select <option value="' + data.Designation + '">' + data.Designation + '</option>');
                            $("#GrossSalary").val(data.GrossSalary);
                            $("#LastIncrementDate").val(data.LastIncrementDate);
                            $("#LastIncrementMoney").val(data.LastIncrementMoney);
                            $("#PromotionDate").val(data.PromotionDate);
                            $("#OT").val(data.OT);
                            $("#AttendanceBonus").val(data.AttendanceBonus);
                            $("#OtherAllowance").val(data.OtherAllowance);
                            $("#MedicalAllowance").val(data.MedicalAllowance);
                            $("#TravelAllowance").val(data.TravelAllowance);
                            $("#FoodAllowance").val(data.FoodAllowance);
                            $("#OthAllowCal").val(data.OthAllowCal);
                            $("#IsActive").val(data.IsActive);
                        }
                    }, dataType: 'json'
                });
                return false;
            }
        });

    });
</script>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <section class="panel panel-primary">                        
            <div class="panel-heading"> কার্ড নং দ্বারা অনুসন্ধান করুন</div>
            <div class="panel-body">
                <?php
                $attributes = array(
                    'class' => 'form-inline',
                    'role' => 'form',
                    'id' => 'searchForm'
                );
                echo form_open('', $attributes);
                ?>
                <div class="form-group">
                    <label for="Search" class="col-lg-4 control-label">কার্ড নং টাইপ করুন</label>
                    <div class="col-lg-5"> 
                        <input type="text" name="Search" id="Search" class="form-control"/>
                    </div>
                    <button class="btn btn-sm btn-primary" id="searchButton"><i class="glyphicon glyphicon-search"></i> অনুসন্ধান করুন</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'id' => 'employeeSalaryInsertUpdateForm',
            'role' => 'form'
        );
        echo form_open('con_set_employee_salary/insert', $attr);
        ?>

        <section class="panel panel-primary">                        
            <div class="panel-heading">কর্মচারী বেতন সংক্রান্ত তথ্য</div>
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

                <div class="form-group" id="CardNoDiv">
                    <label for="CardNo" class="col-lg-3 control-label" >কার্ড নং</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="CardNo"  class="form-control" id="CardNo" placeholder="কার্ড নং টাইপ করুন" >
                    </div>
                </div>

                <input type="hidden" name="CardNoHidden" id="CardNoHidden"/>
                <div class="form-group">
                    <label for="GrossSalary" class="col-lg-3 control-label" >মূল বেতন</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="GrossSalary"  class="form-control" id="GrossSalary" placeholder="মূল বেতন টাইপ করুন" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="LastIncrementDate" class="col-lg-3 control-label" >সর্বশেষ বর্ধিত তারিখ</label>
                    <div class="col-lg-6">
                        <input type="text" name="LastIncrementDate"  class="form-control datepicker" id="LastIncrementDate" placeholder="সর্বশেষ বর্ধিত তারিখ নির্বাচন করুন" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="LastIncrementMoney" class="col-lg-3 control-label" >সর্বশেষ বর্ধিত টাকা</label>
                    <div class="col-lg-6">
                        <input type="text" name="LastIncrementMoney"  class="form-control" id="LastIncrementMoney" placeholder="সর্বশেষ বর্ধিত টাকা টাইপ করুন">
                    </div>
                </div>

                <div class="form-group">
                    <label for="PromotionDate" class="col-lg-3 control-label" >পদোন্নতির তারিখ</label>
                    <div class="col-lg-6">
                        <input type="text" name="PromotionDate"  class="form-control datepicker" id="PromotionDate" placeholder="পদোন্নতির তারিখ নির্বাচন করুন" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="OT" class="col-lg-3 control-label" >ওভার টাইম</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="OT" id="OT">
                            <option value="1">হ্যাঁ</option>
                            <option value="0">না</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="AttendanceBonus" class="col-lg-3 control-label" >উপস্থিত বোনাস</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="AttendanceBonus"  class="form-control" id="AttendanceBonus" placeholder="উপস্থিত বোনাস  টাইপ করুন" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="MedicalAllowance" class="col-lg-3 control-label" >চিকিৎসা ভাতা</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="MedicalAllowance"  class="form-control" id="MedicalAllowance" value="২৫০" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="TravelAllowance" class="col-lg-3 control-label" >ভ্রমন ভাতা</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="TravelAllowance"  class="form-control" id="TravelAllowance" value="২০০" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="FoodAllowance" class="col-lg-3 control-label" >খাবার ভাতা</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="FoodAllowance"  class="form-control" id="FoodAllowance" value="৬৫০" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="OtherAllowance" class="col-lg-3 control-label" >অন্যান্য ভাতা</label>
                    <div class="col-lg-6">                        
                        <input type="text" name="OtherAllowance"  class="form-control" id="OtherAllowance" placeholder="অন্যান্য ভাতা  টাইপ করুন" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="OthAllowCal" class="col-lg-3 control-label" >অন্যান্য ভাতা হিসাব</label>
                    <div class="col-lg-6">                        
                        <select class="form-control" name="OthAllowCal" id="OthAllowCal">
                            <option value="M">মাসিক</option>
                            <option value="D">বাৎসরিক</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="IsActive" class="col-lg-3 control-label" >সক্রিয়</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="IsActive" id="IsActive">
                            <option value="1">হ্যাঁ</option>
                            <option value="0">না</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6 col-lg-push-3">
                        <button class="btn btn-success btn-sm" type="submit" name="submit" value="save" ><i class="glyphicon glyphicon-save"></i> সংরক্ষণ করুন</button>
                        <button class="btn btn-info btn-sm" type="submit" name="submit" value="update" ><i class="glyphicon glyphicon-pencil"></i> সংশোধন করুন</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php echo form_close(); ?>
    <div class="col-md-2"></div>
</div>

<?php if ($this->session->flashdata('msg')) { ?>
    <script>
        $(document).ready(function() {
            $("#confirmationModal").modal("show");
        });
    </script>
<?php } ?>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center">
                <h3 class="modal-title"><strong><i class="glyphicon glyphicon-comment"></i> নিশ্চিতকরণ বার্তা</strong></h3>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <?php
                    echo $this->session->flashdata('msg')
                    ?>
                </div>
                <div class="text-center">
                    <button class="btn btn-default btn-xs" data-dismiss="modal" type="button"> বন্ধ করুন</button>
                </div>
            </div>
        </div>
    </div>
</div>