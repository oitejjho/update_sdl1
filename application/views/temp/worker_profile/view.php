<div class='row'>
	<div class='col-lg-2'>
		<?php echo $this->session->flashdata('msg'); ?>
	</div>
		<div class='col-lg-8'>
			<a href="<?php echo base_url(); ?>con_set_worker_profile/create">
			<button class="btn btn-info"><i class="glyphicon glyphicon-plus"></i>Add</button>
			</a>
			<table class="table table-hover">
				<thead>
					<th>Sl</th>

					<th>ID</th>

					<th>Name</th>

					<th>Designation</th>

					<th>Grade</th>

					<th>CardNo</th>

					<th>JoiningDate</th>

					<th>GrossSalary</th>

					<th>LastIncrementDate</th>

					<th>LastIncrementMoney</th>

					<th>ContactNo</th>

					<th>PromotionDate</th>

					<th>GuardianName</th>

					<th>PermanentVillage</th>

					<th>PermanenttPost</th>

					<th>PermanentThana</th>

					<th>PermanentDistrict</th>

					<th>PresentVillage</th>

					<th>PresentPost</th>

					<th>PresentThana</th>

					<th>PresentDistrict</th>

					<th>Reference</th>

					<th>EducationalQual</th>

					<th>Image</th>

					<th>ImageThumb</th>

					<th>Comment</th>

					<th>Status</th>

					<th>BuildingName</th>

					<th>Floor</th>

					<th>Department</th>

					<th>Line</th>

					<th>Parameter5</th>
				</thead>
				<tbody>
					<?php
						$count = 1;
						foreach ($tbl_worker_profile as $rec_worker_profile) {
					?>
					<tr>
						<td><?php echo $count++; ?></td>

						<td><?php echo $rec_worker_profile->ID; ?> </td>

						<td><?php echo $rec_worker_profile->Name; ?> </td>

						<td><?php echo $rec_worker_profile->Designation; ?> </td>

						<td><?php echo $rec_worker_profile->Grade; ?> </td>

						<td><?php echo $rec_worker_profile->CardNo; ?> </td>

						<td><?php echo $rec_worker_profile->JoiningDate; ?> </td>

						<td><?php echo $rec_worker_profile->GrossSalary; ?> </td>

						<td><?php echo $rec_worker_profile->LastIncrementDate; ?> </td>

						<td><?php echo $rec_worker_profile->LastIncrementMoney; ?> </td>

						<td><?php echo $rec_worker_profile->ContactNo; ?> </td>

						<td><?php echo $rec_worker_profile->PromotionDate; ?> </td>

						<td><?php echo $rec_worker_profile->GuardianName; ?> </td>

						<td><?php echo $rec_worker_profile->PermanentVillage; ?> </td>

						<td><?php echo $rec_worker_profile->PermanenttPost; ?> </td>

						<td><?php echo $rec_worker_profile->PermanentThana; ?> </td>

						<td><?php echo $rec_worker_profile->PermanentDistrict; ?> </td>

						<td><?php echo $rec_worker_profile->PresentVillage; ?> </td>

						<td><?php echo $rec_worker_profile->PresentPost; ?> </td>

						<td><?php echo $rec_worker_profile->PresentThana; ?> </td>

						<td><?php echo $rec_worker_profile->PresentDistrict; ?> </td>

						<td><?php echo $rec_worker_profile->Reference; ?> </td>

						<td><?php echo $rec_worker_profile->EducationalQual; ?> </td>

                                                <td><img src="<?php echo base_url(); ?>img/<?php echo $rec_worker_profile->Image; ?>" width="40" height="40" /> </td>

						<td><?php echo $rec_worker_profile->ImageThumb; ?> </td>

						<td><?php echo $rec_worker_profile->Comment; ?> </td>

						<td><?php echo $rec_worker_profile->Status; ?> </td>

						<td><?php echo $rec_worker_profile->BuildingName; ?> </td>

						<td><?php echo $rec_worker_profile->Floor; ?> </td>

						<td><?php echo $rec_worker_profile->Department; ?> </td>

						<td><?php echo $rec_worker_profile->Line; ?> </td>

						<td><?php echo $rec_worker_profile->Parameter5; ?> </td>
						<td>
							<?php echo form_open('con_set_worker_profile/edit'); ?>
							<input type="hidden" name="ID" id="ID" value="<?php echo $rec_worker_profile->ID; ?>"/>
							<a href="<?php echo base_url(); ?>con_set_worker_profile/edit" title="Edit"><button class="btn btn-success" name="submit" value="edit"><i class="glyphicon glyphicon-edit"></i></button></a>
							<a href="<?php echo base_url(); ?>con_set_worker_profile/delete" title="Delete" onclick="return confirm('Are you sure want to delete this data')"><button class="btn btn-danger" name="submit" value="delete"><i class="glyphicon glyphicon-trash"></i></button></a>
							<?php echo form_close(); ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class='col-lg-2'></div>
</div>
