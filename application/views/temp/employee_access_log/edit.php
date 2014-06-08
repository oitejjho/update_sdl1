<div class='row'>
	<div class='col-lg-2'></div>
	<div class='col-lg-8'>
	<?php
		$attr = array(
		'class' => 'form-horizontal',
		'role' => 'form'
		);
		echo form_open('con_access_log/update', $attr);
	foreach ($tbl_log as $rec_log) {
	?>
	<input type="hidden" name="ID" value="<?php echo $rec_log->ID; ?>"/>

	<div class="form-group">
		<label for="CardNo" class="col-sm-3 control-label" >CardNo</label>
		<div class="col-sm-9">
			<input type="text" name="CardNo"  class="form-control" id="id_CardNo" value="<?php echo $rec_log->CardNo;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="DateTime" class="col-sm-3 control-label" >DateTime</label>
		<div class="col-sm-9">
			<input type="text" name="DateTime"  class="form-control" id="id_DateTime" value="<?php echo $rec_log->DateTime;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="Status" class="col-sm-3 control-label" >Status</label>
		<div class="col-sm-9">
			<input type="text" name="Status"  class="form-control" id="id_Status" value="<?php echo $rec_log->Status;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="CreatedBy" class="col-sm-3 control-label" >CreatedBy</label>
		<div class="col-sm-9">
			<input type="text" name="CreatedBy"  class="form-control" id="id_CreatedBy" value="<?php echo $rec_log->CreatedBy;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="CreatedOn" class="col-sm-3 control-label" >CreatedOn</label>
		<div class="col-sm-9">
			<input type="text" name="CreatedOn"  class="form-control" id="id_CreatedOn" value="<?php echo $rec_log->CreatedOn;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="DelStatus" class="col-sm-3 control-label" >DelStatus</label>
		<div class="col-sm-9">
			<input type="text" name="DelStatus"  class="form-control" id="id_DelStatus" value="<?php echo $rec_log->DelStatus;?>">
		</div>
	</div>
<?php
		}
		echo form_close();
		?>
		</div>
		<div class='col-lg-2'>
		</div>
		</div>
