<div class='row'>
     <?php
        if (isset($msg))
            echo $msg;
        ?>
    
    <div class='col-lg-12'>
        <table class="table table-hover table-condensed">
            <thead>
            <th>Sl</th>
            <th>Month</th>
            <th>Year</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Card No</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Grade</th>
            <th>Date Of Join</th>
            <th>Parameter1</th>
            <th>Parameter2</th>
            <th>Parameter3</th>
            <th>Parameter4</th>
            <th>Parameter5</th>
            <th>Gross Salary</th>
            <th>Work Days</th>
            <th>Absent</th>
            <th>Leave Of Employee</th>
            <th>OverTime Hour</th>
            <th>Additional OverTime Hour</th>
            <th>Night Shift OverTime Hour</th>
            <th>Attendance Bonus</th>
            <th>Stamp Charge</th>
            <th>Net Payable</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($tbl_monthly_wages_detail as $rec_monthly_wages_detail) {
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>                       
                        <td><?php echo $rec_monthly_wages_detail->Month; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Year; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->FormDate; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->ToDate; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->CardNo; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Name; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Designation; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Grade; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->DateOfJoin ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Parameter1; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Parameter2; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Parameter3; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Parameter4; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Parameter5; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->GrossSalary; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->WorkDays; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->Absent; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->LeaveOfEmpolyee; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->OverTimeHour; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->AdditionalOverTimeHour; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->NightShiftOverTimeHour; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->AttendanceBonus; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->StampCharge; ?> </td>
                        <td><?php echo $rec_monthly_wages_detail->NetPayable; ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
