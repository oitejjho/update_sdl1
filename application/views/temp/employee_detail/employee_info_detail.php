<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.css"/>
<script src="<?php echo base_url(); ?>js/jquery.dataTables1.js"></script>
<script src="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>

    $(document).ready(function() {
//        var table = $('#employee_info_log').DataTable();
//
//        $("#employee_info_log tfoot th").each(function(i) {
//            var select = $('<select><option value=""></option></select>')
//                    .appendTo($(this).empty())
//                    .on('change', function() {
//                        table.column(i)
//                                .search($(this).val())
//                                .draw();
//                    });
//
//            table.column(i).data().unique().sort().each(function(d, j) {
//                select.append('<option value="' + d + '">' + d + '</option>')
//            });
//        });


        // Change the width of the div
        $('#employee').css({'width': ($('#employee_info_log').width()) + 'px'});


    });
</script>

<script>
    $(document).ready(function() {
        $("#employeeDetailsSearchForm").submit(function() {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>con_set_employee_info_detail/ajax_page",
                data: $("#employeeDetailsSearchForm").serialize(),
                dataType: 'html',
                success: function(data)
                {
                    
                    $("#mmmd").html(data);


                }

            });
            return false;

        });
        $("body").on("click", ".kkk", function(){
        var mm = $(this).text();
        
             $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>con_set_employee_info_detail/ajax_page/"+mm,
                data: $("#employeeDetailsSearchForm").serialize()+"&mvalue="+mm,
                dataType: 'html',
                success: function(data)
                {
                    
                    $("#mmmd").html(data);


                }

            });
            return false;
        });
        
    });
</script>
<div class="row" >
    <div class="col-lg-12" >
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <section class="panel panel-body">
                    <div class="panel-primary">
                        <header class="panel-heading">
                            <h4><i class="glyphicon glyphicon-search"></i> কর্মচারীগনের বিস্তারিত তথ্য অনুসন্ধান করুন</h4>
                        </header>
                        <div class="panel panel-body">
                            <?php
                            $attributes = array(
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                'id' => 'employeeDetailsSearchForm'
                                
                            );
                            echo form_open('con_set_employee_info_detail/search_employee_info_details', $attributes);
                            ?>
                            <div class="form-group">
                                <label for="Department" class="col-md-2">বিভাগ/সেকশন</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="Department" id="Department">
                                        <option value="">--- সকল  বিভাগ---</option>
                                        <?php foreach ($tbl_section as $rec_section) { ?>
                                            <option value="<?php echo $rec_section->Name; ?>"><?php echo $rec_section->Name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="Name" class="col-md-2">কর্মচারীর নাম</label>
                                <div class="col-md-4">
                                    <input type="text" name="Name" id="Name" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="CardNo" class="col-md-2">কার্ড নং </label>
                                <div class="col-md-4">
                                    <input type="text" name="CardNo" id="CardNo" class="form-control" />
                                </div>
                                <label for="ContactNo" class="col-md-2">মোবাইল নং </label>
                                <div class="col-md-4">
                                    <input type="text" name="ContactNo" id="ContactNo" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="FromGrossSalary" class="col-md-2">বর্তমান বেতন (হইতে) </label>
                                <div class="col-md-4">
                                    <input type="text" name="FromGrossSalary" id="FromGrossSalary" class="form-control" />
                                </div>									
                                <label for="ToGrossSalary" class="col-md-2">বর্তমান বেতন (পর্যন্ত) </label>
                                <div class="col-md-4">
                                    <input type="text" name="ToGrossSalary" id="ToGrossSalary" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NID" class="col-md-2">জাতীয় পরিচয় পত্র নং</label>
                                <div class="col-md-4">
                                    <input type="text" name="NID" id="NID" class="form-control" />
                                </div>
                                <label for="" class="col-md-2"></label>
                                <div class="col-md-4">
                                    <input type="submit" name="submit"  value="অনুসন্ধান করুন" class="btn btn-success btn-sm">
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-1"></div>
        </div>

        <section class="panel panel-body" id="employee">
            <div class="panel-primary">
                <header class="panel-heading">
                    <h4><i class="glyphicon glyphicon-info-sign"></i> কর্মচারীগনের বিস্তারিত তথ্য</h4>
                </header>

                <div class="panel panel-body">
                    <div id="mmmd">
                        <table class="table table-condensed table-responsive table-bordered table-hover" id="employee_info_log" >
                            <thead>                    
                                <tr  class="success"> 
                                    <th>ক্রমিক নং </th> 
                                    <th>ভবনের নাম </th>
                                    <th>ফ্লোর</th>
                                    <th>বিভাগ/সেকশন </th>
                                    <th>লাইন </th>
                                    <th>নাম </th>
                                    <th>পদবি </th>
                                    <th>যোগদানের তারিখ </th>
                                    <th>কার্ড নং </th>
                                    <th>গ্রেড </th>
                                    <th>বর্তমান বেতন </th>
                                    <th>শেষ বর্ধিত তারিখ </th>
                                    <th>শেষ বর্ধিত টাকা </th>
                                    <th>মোবাইল নং </th>
                                    <th>জাতীয় পরিচয় পত্র নং</th>
                                    <th>পদোন্নতির তারিখ </th>
                                    <th>পিতা/স্বামীর নাম </th>
                                    <th>গ্রাম </th>
                                    <th>ডাকঘর </th> 
                                    <th>থানা </th>
                                    <th>জেলা </th>
                                    <th>গ্রাম </th>
                                    <th>ডাকঘর </th> 
                                    <th>থানা </th>
                                    <th>জেলা </th>
                                    <th>রেফারেন্স </th>
                                    <th>শিক্ষাগত যোগ্যতা </th>
                                    <th>মন্তব্য </th>						
                                </tr>                        
                            </thead>


                            <tbody>
                                <?php
                                $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
                                $count = 1;
                                foreach ($results as $monthly_employee_wages) {
                                    ?>
                                    <tr>
                                        <td><?php
                                            echo str_replace(range(0, 9), $bn_digits, '' . $count);
                                            $count++;
                                            ?>
                                        </td>
                                        <td><?php echo $monthly_employee_wages->BuildingName; ?> </td>
                                        <td><?php echo $monthly_employee_wages->Floor ?> </td>
                                        <td><?php echo $monthly_employee_wages->Department ?> </td>
                                        <td><?php echo $monthly_employee_wages->Line ?> </td>							
                                        <td><a href="<?php echo base_url(); ?>con_set_worker_profile/edit1/<?php echo $monthly_employee_wages->CardNo; ?>" target="_blank" title="সংশোধন করুন"><strong><?php echo $monthly_employee_wages->Name; ?></strong> </a></td>
                                        <td><?php echo $monthly_employee_wages->Designation ?> </td>
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->JoiningDate); ?> </td>
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->CardNo); ?> </td>
                                        <td><?php echo $monthly_employee_wages->Grade ?> </td>
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->GrossSalary); ?> </td>
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->LastIncrementDate); ?> </td>
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->LastIncrementMoney); ?> </td>
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->ContactNo); ?> </td> 
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->NID); ?> </td> 
                                        <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $monthly_employee_wages->PromotionDate); ?> </td>
                                        <td><?php echo $monthly_employee_wages->GuardianName; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PermanentVillage; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PermanenttPost; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PermanentThana; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PermanentDistrict; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PresentVillage; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PresentPost; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PresentThana; ?> </td>
                                        <td><?php echo $monthly_employee_wages->PresentDistrict; ?> </td>
                                        <td><?php echo $monthly_employee_wages->Reference; ?> </td>
                                        <td><?php echo $monthly_employee_wages->EducationalQual; ?> </td>

                                        <td><?php echo $monthly_employee_wages->Comment; ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
    </div>
</div>
