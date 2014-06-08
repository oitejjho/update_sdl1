<style>
    label.error{
        color: red;
        font-weight: bold;
    }
    .cat{
        border-radius: 5%;
    }
</style>
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#create_profile").validate({
            rules: {
                FirstName: "required",
                LastName: "required",
                Gender: "required",
                userfile: "required",
                UserName: "required",
                Password: {
                    required: true,
                    minlength: 6
                },
                Email: {
                    required: true,
                    email: true
                },
                Role: "required",
                BuildingName: "required",
                Floor: "required"
            },
            messages: {
                FirstName: "অনুগ্রহ করে নাম টাইপ করুন",
                LastName: "অনুগ্রহ করে পদবি টাইপ করুন",
                Gender: "অনুগ্রহ করে লিঙ্গ বাছুন",
                userfile: "অনুগ্রহ করে ছবি আপলোড করুন",
                UserName: "অনুগ্রহ করে ইউজার নাম টাইপ করুন",
                Password: {
                    required: "অনুগ্রহ করে পাসওয়ার্ড টাইপ করুন",
                    minlength: "পাসওয়ার্ড দৈর্ঘ্য অন্তত ৬ অক্ষর হতে হবে"
                },
                Email: {
                    required: "অনুগ্রহ করে ইমেল টাইপ করুন",
                    email: "অনুগ্রহ করে একটি বৈধ ইমেইল ঠিকানা টাইপ করুন"
                },
                Role: "অনুগ্রহ করে ভূমিকা বাছুন",
                BuildingName: "অনুগ্রহ করে বিল্ডিং এর নাম টাইপ করুন",
                Floor: "অনুগ্রহ করে ফ্লোরের নাম টাইপ করুন"
            }
        });

        $('#BuildingName').on('change', function(e) {
            var selected = $(this).find('option:selected');
            var buildingid = selected.data('foo');
            //var buildingid = $(this).val();
            if (buildingid == 0) {
                var mySelect = $('#Floor');
                mySelect.html('');
                mySelect.append("<option>অনুগ্রহ করে বিল্ডিং নাম নির্বাচন  করুন</option> ");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>con_set_user/get_floor_name",
                    data: "BuildingID=" + buildingid,
                    success: function(data)
                    {
                        var mySelect = $('#Floor');
                        mySelect.html('');
                        mySelect.append("<option value='0'>অনুগ্রহ করে ফ্লোর নির্বাচন করুন</option> ");
                        $.each(data, function(v, k) {
                            mySelect.append("<option value='" + k.Name + "' data-foo='" + k.ID + "'>" + k.Name + "</option>");
                        });
                    }, dataType: 'json'
                });
            }
        });
    });
</script>


<!-- page start-->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'id' => 'create_profile',
            'role' => 'form'
        );
        echo form_open_multipart('con_set_user/insert', $attr);
        ?>

        <div class="bio-graph-heading">
            <div class="text-center">
                <h3><i class="icon icon-user"></i> নতুন ইউজার প্রোফাইল তৈরি করুন</h3>
            </div>
        </div>

        <section class="panel panel-primary">                        
            <div class="panel-heading">মৌলিক তথ্য</div>
            <div class="panel-body">                                           
                <div class="form-group">
                    <label for="FirstName" class="col-lg-3 control-label" >নাম</label>
                    <div class="col-lg-6">
                        <input type="text" name="FirstName"  class="form-control" id="FirstName">
                    </div>
                </div>

                <div class="form-group">
                    <label for="MiddleName" class="col-lg-3 control-label" >নামের মধ্যাংশ</label>
                    <div class="col-lg-6">
                        <input type="text" name="MiddleName"  class="form-control" id="MiddleName" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="LastName" class="col-lg-3 control-label" >পদবি</label>
                    <div class="col-lg-6">
                        <input type="text" name="LastName"  class="form-control" id="LastName" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3" for="Gender">লিঙ্গ</label>
                    <div class="col-lg-6">
                        <select class ="form-control" name="Gender" id="Gender">                                            
                            <option value="">একটি লিঙ্গ নির্বাচন করুন</option>                                              
                            <option value="পুরুষ">পুরুষ</option>                                            
                            <option value="মহিলা">মহিলা</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" id="userfile">ছবি আপলোড করুন</label>
                    <div class="col-lg-4"> 
                        <input type="hidden" name="previous_image_url" id="previous_image_url" />
                        <input type="file" class="file-pos" name="userfile" accept="img/*" id="userfile" required>                                    
                    </div>
                    <div class="hidden-phone cat"></div>
                </div>
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading">লগইন তথ্য</div>
                <div class="panel-body">                             
                    <div class="form-group">
                        <label for="UserName" class="col-lg-3 control-label" >ইউজার নাম</label>
                        <div class="col-lg-6">
                            <input type="text" name="UserName"  class="form-control" id="UserName" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-lg-3 control-label" >পাসওয়ার্ড</label>
                        <div class="col-lg-6">
                            <input type="password" name="Password"  class="form-control" id="Password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="col-lg-3 control-label" >ইমেল</label>
                        <div class="col-lg-6">
                            <input type="text" name="Email"  class="form-control" id="Email" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3" for="Role">ভূমিকা</label>
                        <div class="col-lg-6">
                            <select class ="form-control" name="Role" id="Role">
                                <option value="">একটি ভূমিকা নির্বাচন করুন</option>                                            
                                <option value="Admin">অ্যাডমিন</option>                                            
                                <option value="Manager">ম্যানেজার</option>
                                <option value="TimeKeeper">টাইম কিপার</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading">কোম্পানির তথ্য</div>
                <div class="panel-body">                            
                    <div class="form-group">
                        <label for="BuildingName" class="col-lg-3 control-label" >বিল্ডিং নাম</label>
                        <div class="col-lg-6">                            
                            <select class ="form-control" name="BuildingName" id="BuildingName">
                                <option value="">একটি বিল্ডিং নাম নির্বাচন করুন</option>
                                <?php foreach ($tbl_building as $rec_building) { ?>
                                    <option value="<?php echo $rec_building->Name; ?>" data-foo="<?php echo $rec_building->ID; ?>"><?php echo $rec_building->Name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Floor" class="col-lg-3 control-label" >ফ্লোর</label>
                        <div class="col-lg-6">                            
                            <select class ="form-control" name="Floor" id="Floor">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="panel panel-primary">                        
                <div class="panel-body">
                    <div class="form-group">
                        <div class=" col-lg-10 col-lg-push-3">
                            <button type="submit" name="update"  class="btn btn-success" id="update" value="Update">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            echo form_close();
            ?>
        </section>

    </div>
    <div class="col-md-2"></div>
</div>


