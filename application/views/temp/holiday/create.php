<div class='row'>
    <div class='col-lg-2'></div>
    <div class='col-lg-8'>
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
                <input type="text" name="HolidayDate"  class="form-control" id="HolidayDate" placeholder="ছুটির তারিখ দিন">
            </div>
        </div>
        <div class="form-group">
            <label for="Category" class="col-sm-3 control-label" >ছুটির নাম</label>
            <div class="col-sm-9">
                <input type="text" name="Category"  class="form-control" id="id_Category" placeholder="ছুটির নাম দিন">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" name="submit" class="btn btn-success">সংরক্ষণ</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class='col-lg-2'></div>
</div>
