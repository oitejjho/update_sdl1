<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">       
        <section class="panel panel-primary">                        
            <div class="panel-heading">Grade Mapping Information</div>
            <div class="panel-body">
                <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>con_set_grade_mapping/create"><i class="icon icon-plus"></i> Create Grade Mapping</a>
                <br/><br/>
                <table class="table table-bordered table-condensed table-hover">
                    <thead>
                    <th><i class="icon icon-edit"></i> নাম</th>
                    <th><i class="icon icon-edit"></i> বর্ণনা</th>
                    <th><i class="icon icon-money"></i> চিকিৎসা ভাতা</th>
                    <th><i class="icon icon-money"></i> ভ্রমন ভাতা</th>
                    <th><i class="icon icon-money"></i> খাবার ভাতা</th>
                    <th><i class="icon icon-money"></i> হাজিরা বোনাস</th>
                    <th><i class="icon icon-pencil"></i> সংশোধন</th>
                    </thead>

                    <tbody>
                        <?php foreach ($tbl_grade_mapping as $rec_grade_mapping) { ?>
                            <tr>
                                <td><?php echo $rec_grade_mapping->Name; ?></td>
                                <td><?php echo $rec_grade_mapping->Descrip; ?></td>
                                <td><?php echo $rec_grade_mapping->TreatmentAllowance; ?></td>
                                <td><?php echo $rec_grade_mapping->TravelAllowance; ?></td>
                                <td><?php echo $rec_grade_mapping->FoodAllowance; ?></td>
                                <td><?php echo $rec_grade_mapping->AttendanceBonus; ?></td>
                                <td>
                                    <?php echo form_open('con_set_grade_mapping/edit'); ?>
                                    <input type="hidden" name="ID" id="ID" value="<?php echo $rec_grade_mapping->ID; ?>"/>
                                    <button class="btn btn-primary btn-xs" name="submit" value="edit"><i class="icon icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs" name="submit" value="delete" onclick="return confirm('Are u sure u want to delete')"><i class="icon icon-trash"></i></button>
                                    <?php echo form_close(); ?>
                                </td>                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-1"></div>
</div>