<div class='row' style="margin-top: 100px;">
    <div class='col-lg-2'>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <div class='col-lg-8'>
        <?php
        $attr = array(
            'class' => 'form-horizontal',
            'role' => 'form'
        );
        echo form_open('con_pro_employee_monthly_report/search', $attr);
        ?>
        <div class="form-group">
            <label for="CardNo" class="col-sm-3 control-label" >Card No : </label>
            <div class="col-sm-9">
                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" placeholder="Enter RewaredName">
            </div>
        </div>
        <div class="form-group"> 
            <label for="Month" class="col-sm-3 control-label" >Month : </label>
            <div class="form-group col-sm-9">
                <select class ="form-control" name="Month" id="Month">
                    <option>মাস নির্বাচন করুন</option>                                            
                    <option>---------------</option>                                            
                    <option value="1">জানুয়ারী </option>                                                       
                    <option value="2">ফেব্রুয়ারী </option>                                                       
                    <option value="3">মার্চ </option>                                                       
                    <option value="4">এপ্রিল </option>                                                       
                    <option value="5">মে </option>                                                       
                    <option value="6">জুন</option>                                                       
                    <option value="7">জুলাই </option>
                    <option value="8">অগাস্ট </option>                                                       
                    <option value="9">সেপ্টেম্বর </option>                                                       
                    <option value="10">অক্টোবর </option>                                                       
                    <option value="11">নভেম্বর </option>                                                       
                    <option value="12">ডিসেম্বর </option>
                </select>
            </div>
        </div>
        <div class="form-group">

            <div class="col-sm-9">
                <input type="submit" name="submit"  class="btn btn-success" id="update" value="Search">
            </div>


        </div>
        <?php
        echo form_close();
        ?>
    </div>
    <div class='col-lg-2'></div>
</div>