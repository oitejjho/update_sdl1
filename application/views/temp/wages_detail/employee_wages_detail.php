<div class="row">
    <div class="col-lg-12" style="width: 280%;">
    <section class="panel panel-body">
        <div class="panel-primary" > 
            <header class="panel-heading">
                <h3>
                    কর্মচারীগনের বিস্তারিত বেতন তালিকা
                    
<!--                    <a class="btn btn-default" href="<?php //echo base_url(); ?>con_proc_monthly_report_generate/PopulateSalarySheet"><img src="<?php //echo base_url(); ?>images/Excel-icon.png" alt="Excel Export" width="16" height="16"/> Excel Export</a>  -->
                </h3>                
            </header>    
            <div class="text-center">
                <h5><strong>  কর্মচারীগনের বিস্তারিত বেতন তালিকা  বের করার জন্য বাটনটি চাপুন</strong></h5>
                <?php
                $attributes = array(
                    'class' => 'form-inline',
                    'role' => 'form',
                    'id' => 'excelExport'
                );
                echo form_open('', $attributes);
                ?>
                <input type="hidden" name="hDate" value="<?php
//                if ($tbl_first_half_log_report)
//                    echo date('m-d-Y', strtotime($tbl_first_half_log_report[0]['InTime']));
//                else
//                    echo date('m-d-Y', now());
//                ?>"/>
                <button class="btn btn-info" type="submit" name="xlexport"><img src="<?php echo base_url(); ?>images/Excel-icon.png" alt="Excel Export" width="16" height="16"/> এক্সেল  এক্সপোর্ট করুন</button>
                <?php
                echo form_close();
                ?>
            </div><hr/>         
            <table class="table table-responsive table-striped table-bordered table-condensed" id="wages">
                <thead>                    
                    <tr> 
                        <th width="21" class="text-center" >ক্রমিক নং</th>
                        <th width="63" class="text-center" >ভবনের নাম </th>
                        <th width="40" class="text-center" >ফ্লোর</th>
                        <th width="21" class="text-center" >বিভাগ</th>
                        <th width="63" class="text-center" >লাইন</th>
                        <th width="40" class="text-center" >নাম</th>
                        <th width="89" class="text-center" >পদবী </th>                        
                        <th width="25" class="text-center" >কার্ড নং </th> 
                        <th width="57" class="text-center" >যোগদানের তারিখ</th>
                        <th width="50" class="text-center" >গ্রেড </th>
                        <th width="51" class="text-center" >সর্বমোট বর্তমান বেতন/মজুরী </th>
                        <th width="51" class="text-center" >মূল বেতন/মজুরী</th>
                        <th width="51" class="text-center" >বাড়ি ভাড়া</th>
                        <th width="51" class="text-center" >চিকিৎসা ভাতা </th>
                        <th width="51" class="text-center" >যাতায়াত ভাতা </th>
                        <th width="51" class="text-center" >খাদ্য ভাতা </th>
                        <th width="51" class="text-center" >দৈনিক মোট বেতন/মজুরী </th>
                        <th width="51" class="text-center" >মোট দিন </th>
                        <th width="51" class="text-center" >অনুমোদিত ছুটি </th>
                        <th width="51" class="text-center" >অনুপস্থিত </th>                        
                        <th width="51" class="text-center" >হাজিরা </th>
                        <th width="51" class="text-center" >মোট প্রাপ্য বেতন/মজুরী</th>
                        <th width="51" class="text-center" >বকেয়া প্রাপ্য </th>
                        <th width="51" class="text-center" >ওভারটাইম ঘন্টা </th>
                        <th width="51" class="text-center" >ওভারটাইম(প্রতি ঘন্টা) </th>
                        <th width="78" class="text-center" >ওভারটাইম প্রাপ্য টাকা </th>
                        <th width="75" class="text-center" >ভাতা টাকা </th>
                        <th width="61" class="text-center" >উপ: ভাতা (হাজিরা) </th>
                        <th width="51" class="text-center" >টিফিন সংখ্যা </th>
                        <th width="78" class="text-center" >টিফিন টাকা </th>
                        <th width="75" class="text-center" >মোট প্রাপ্য টাকা </th>
                        <th width="61" class="text-center" >প্রদত্ত অগ্রিম বেতন/মজুরী </th>
                        <th width="75" class="text-center" >স্ট্যাম্প চার্জ </th>
                        <th width="61" class="text-center" >সর্ব শেষ প্রাপ্য টাকা </th>
                        <th width="61" class="text-center" >স্বাক্ষর </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th width="21" class="text-center" ></th>
                        <th width="63" class="text-center" >ভবনের নাম </th>
                        <th width="40" class="text-center" >ফ্লোর</th>
                        <th width="21" class="text-center" >বিভাগ</th>
                        <th width="63" class="text-center" >লাইন</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
                    $count = 1;
                    $flag = 0;
                    foreach ($tbl_monthly_wages_detail as $employee_monthly_wages) {
                        ?>
                        <tr>
							<td><?php echo str_replace(range(0, 9), $bn_digits, '' . $count++); ?></td>
                            <td><?php echo $employee_monthly_wages->BuildingName; ?></td>
                            <td><?php echo $employee_monthly_wages->Floor; ?></td>
                            <td><?php echo $employee_monthly_wages->Department; ?></td>
							<td><?php echo $employee_monthly_wages->Line; ?></td>                            
                            <td><?php echo $employee_monthly_wages->Name; ?> </td>
                            <td><?php echo $employee_monthly_wages->Designation; ?></td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->CardNo); ?></td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->DateOfJoin); ?></td>
                            <td><?php echo $employee_monthly_wages->Grade; ?> </td>                            
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->GrossSalary); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->Basic); ?> </td> 
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->HouseRent); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->MedicalAllowance); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->TravelAllowance); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->FoodAllowance); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->DailyWage); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->TotalWorkingDays); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->LeaveOfEmpolyee); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->Absent); ?> </td>                            
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->WorkDays); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->TotalAvailableToPay); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->OutStandingDues); ?></td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->OverTimeHour + $employee_monthly_wages->AdditionalOverTimeHour + $employee_monthly_wages->NightShiftOverTimeHour); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->HourlyOTWage); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . ($employee_monthly_wages->OverTimeHour + $employee_monthly_wages->AdditionalOverTimeHour + $employee_monthly_wages->NightShiftOverTimeHour)) * $employee_monthly_wages->HourlyOTWage; ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->OtherAllowance); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->AttendanceBonus); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->NoOfAOT); ?></td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->NoOfAOT * 20.00); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->HolidayNetPayable + $employee_monthly_wages->TotalAvailableToPay + $employee_monthly_wages->OutStandingDues + (($employee_monthly_wages->OverTimeHour + $employee_monthly_wages->AdditionalOverTimeHour + $employee_monthly_wages->NightShiftOverTimeHour) * $employee_monthly_wages->HourlyOTWage) + $employee_monthly_wages->OtherAllowance+ $employee_monthly_wages->AttendanceBonus + ($employee_monthly_wages->NoOfAOT * 20.00)); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '0'); ?> </td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->StampCharge); ?></td>
                            <td><?php echo str_replace(range(0, 9), $bn_digits, '' . $employee_monthly_wages->NetPayable); ?></td>
                            <td> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.dataTables.css"/>
<script src="<?php echo base_url(); ?>js/jquery.dataTables1.js"></script>
<script>

    $(document).ready(function() {
        var table = $('#wages').DataTable();

        $("#wages tfoot th").each(function(i) {
            var select = $('<select><option value=""></option></select>')
                    .appendTo($(this).empty())
                    .on('change', function() {
                        table.column(i)
                                .search($(this).val())
                                .draw();
                    });

            table.column(i).data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });
    });
</script>