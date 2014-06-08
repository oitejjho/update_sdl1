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
        echo form_open('con_proc_daily_report_generate/view_by_id', $attr);
        ?>
        <div class="form-group">
            <label for="CardNo" class="col-sm-3 control-label" >Card No : </label>
            <div class="col-sm-9">
                <input type="text" name="CardNo"  class="form-control" id="id_CardNo" placeholder="Enter RewaredName">
            </div>
        </div>
        <div class="form-group">
            <label for="DateTime" class="col-sm-3 control-label" >Date Time : </label>
            <div class="col-sm-9">
                <input type="text" name="DateTime"  class="form-control" id="id_DateTime" placeholder="Enter RewaredName">
            </div>
        </div>
        <div class="form-group">

            <div class="col-sm-9">
                <input type="submit" name="submit"  class="btn btn-success" id="update" value="Search">
            </div>
         
            <div class="col-sm-9">
                <a href="<?php echo site_url('con_proc_daily_report_generate/generate_daily_report'); ?>"  class="btn btn-success" id="update"  >Daily Report Generate</a>
            </div>
            <div class="col-sm-9">
                <a href="<?php echo site_url('con_proc_daily_report_generate/view_daily_report'); ?>"  class="btn btn-success" id="update"  >Daily Report View</a>
            </div>
            <div class="col-sm-9">
                <a href="<?php echo site_url('con_proc_daily_report_generate/generateData'); ?>"  class="btn btn-success" id="update"  >Generate Random data</a>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
    </div>
    <div class='col-lg-2'></div>
</div>