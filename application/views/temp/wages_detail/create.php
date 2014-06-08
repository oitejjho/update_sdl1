<script>
    $(document).ready(function() {
        $('#building').on('change', function(e) {
            $('#floor').html("");
            var building = $(this).val();
            if (building == 0) {
                alert("Please select a building");
            }
            else {
                $.ajax(
                        {
                            type: "POST",
                            url: "<?php echo base_url(); ?>con_proc_monthly_report_generate/get_floor",
                            data: "building_name=" + building,
                            success: function(data)
                            {
                                var mySelect = $('#floor');
                                mySelect.append("<option value=''>Select room</option>");
                                var sl = 1;
                                $.each(data, function(v, k) {
                                    mySelect.append("<option value='" + k.Floor + "'>" + k.Floor + "</option>");
                                });
                            }, dataType: 'json'
                        });
            }
        });
        $('#floor').on('change', function(e) {
            $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo base_url(); ?>con_proc_monthly_report_generate/get_department",
                        data: $("#buildingroom").serialize(),
                        success: function(data)
                        {
                            var mySelect = $('#Department');
                            var sl = 1;

                            $.each(data, function(v, k) {
                                mySelect.append("<option value='" + k.Department + "'>" + k.Department + "</option>");
                            });
                        }, dataType: 'json'
                    });

        });
        $('#Department').on('change', function(e) {
            $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo base_url(); ?>con_proc_monthly_report_generate/get_line",
                        data: $("#buildingroom").serialize(),
                        success: function(data)
                        {
                            var mySelect = $('#line');
                            var sl = 1;

                            $.each(data, function(v, k) {
                                mySelect.append("<option value='" + k.Line + "'>" + k.Line + "</option>");
                            });
                        }, dataType: 'json'
                    });

        });


    });
</script>
<!--main content start-->

<div  class="row col-lg-12">
    <?php
    $attr = array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'buildingroom'
    );
    echo form_open('con_proc_monthly_report_generate/view', $attr);
    ?>
    <!-- #first_step -->
    <div id="first_step">        
        <div class="form" >            
            <div class="form-group">
                <label class="control-label col-lg-3" for="building">Building Name</label>
                <div class="col-lg-8">
                    <select class ="form-control" name="building" id="building" >
                        <option value="">--Select One--</option>
                        <?php
                        foreach ($building_name as $building) {
                            if ($building->BuildingName) {
                                echo "<option value='" . $building->BuildingName . "'>" . $building->BuildingName . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-lg-3" for="floor" >Floor</label>
                <div class="col-lg-8">
                    <select class ="form-control" name="floor" id="floor" >
                        <option value="">--Select One--</option>


                    </select>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-lg-3" for="Department">Department</label>
                <div class="col-lg-8">
                    <select class ="form-control" name="Department" id="Department">
                        <option value="">--Select One--</option>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3" for="line">Line</label>
                <div class="col-lg-8">
                    <select class ="form-control" name="line" id="line" >
                        <option value="">--Select One--</option>

                    </select>
                </div>
            </div>
        </div>    
        <input class="submit" type="submit" name="submit" id="submit" value="Genarate" /> 
    </div>    


    <?php
    echo form_close();
    ?>    
</div>


<!-- page end-->

<!--main content end-->
