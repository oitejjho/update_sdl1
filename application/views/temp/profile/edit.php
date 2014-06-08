
<?php
$gender = array(
    'Male' => 'Male',
    'Female' => 'Female'
);
?>
<?php
$role = array(
    'Admin' => 'Admin',
    'Manager' => 'Manager',
    'ItOperator' => 'ItOperator'
);
?>
<?php
$isactive = array(
    'Yes' => 'Yes',
    'No' => 'No'
);
?>
<style>
    label.error{
        color: red;
        font-weight: bold;
    }
    .cat{
        border-radius: 5%;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    $(function() {
        $("#birth_date").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1910:2010',
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
<!--main content start-->
<section id="main-content">
    <section class="wrapper" style="margin-top:-100px">
        <!-- page start-->
        <div class="row">
            <?php
            $attr = array(
                'class' => 'form-horizontal',
                'id' => 'create_profile',
                'role' => 'form'
            );
            echo form_open_multipart('con_set_user/update', $attr);
            $this->load->helper('html');
            if (isset($tbl_user)) {
                foreach ($tbl_user as $rec_user) {
                    $image_properties = array(
                        'src' => 'img/' . $rec_user->Image,
                        'alt' => 'No Image',
                        'class' => 'post_images',
                        'width' => '45',
                        'height' => '45',
                        'title' => 'That was quite a night',
                        'rel' => 'lightbox',
                    );
                    ?>
                    <aside class="profile-info col-lg-9">
                        <section class="panel">
                            <div class="bio-graph-heading">
                                Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                            </div>
                            <div class="panel-body bio-graph-info">
                                <h1>Profile Info bbbb</h1>
                                <input type="hidden" name="ID" value="<?php echo $rec_user->ID; ?>"/>
                                <div class="form-group">
                                    <label for="FirstName" class="col-lg-3 control-label" >FirstName</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="FirstName"  class="form-control" id="FirstName" value="<?php echo $rec_user->FirstName; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="MiddleName" class="col-lg-3 control-label" >MiddleName</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="MiddleName"  class="form-control" id="MiddleName" value="<?php echo $rec_user->MiddleName; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="LastName" class="col-lg-3 control-label" >LastName</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="LastName"  class="form-control" id="LastName" value="<?php echo $rec_user->LastName; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="inputSuccess">Gender</label>
                                    <div class="col-lg-6">
                                        <select class ="form-control" name="Gender" id="Gender">                                            
                                            <option value= "<?php echo $rec_user->Gender; ?>"   selected="selected"> <?php echo $rec_user->Gender; ?> </option>
                                            <?php
                                            foreach ($gender as $k => $v) {
                                                echo "<option value='" . $k . "'>" . $v . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 control-label">Upload Picture</label>
                                    <div class="col-lg-4"> 
                                        <input type="hidden" name="previous_image_url" id="previous_image_url" value="<?php echo $rec_user->Image; ?>"/>
                                        <input type="file" class="file-pos" id="exampleInputFile" name="userfile" accept="img/*" id="Image">                                    
                                    </div>
                                    <div class="hidden-phone cat"><?php echo img($image_properties); ?></div>
                                </div>
                        </section>
                        <section>
                            <div class="panel panel-primary">
                                <div class="panel-heading">Login Info</div>
                                <div class="panel-body">                             
                                    <div class="form-group">
                                        <label for="UserName" class="col-lg-3 control-label" >UserName</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="UserName"  class="form-control" id="UserName" value="<?php echo $rec_user->UserName; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Password" class="col-lg-3 control-label" >Password</label>
                                        <div class="col-lg-6">
                                            <input type="password" name="Password"  class="form-control" id="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email" class="col-lg-3 control-label" >Email</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="Email"  class="form-control" id="Email" value="<?php echo $rec_user->Email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="inputSuccess">Role</label>
                                        <div class="col-lg-6">
                                            <select class ="form-control" name="Role" id="Role">
                                                <option value="<?php echo $rec_user->Role; ?>" selected="selected"><?php echo $rec_user->Role; ?></option>
                                                <?php
                                                foreach ($role as $k => $v) {
                                                    echo "<option value='" . $k . "'>" . $v . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        <section>
                            <div class="panel panel-primary">
                                <div class="panel-heading">Search</div>
                                <div class="panel-body">                            
                                    <div class="form-group">
                                        <label for="Parameter1" class="col-lg-3 control-label" >Parameter1</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="Parameter1"  class="form-control" id="Parameter1" value="<?php echo $rec_user->Parameter1; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Parameter2" class="col-lg-3 control-label" >Parameter2</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="Parameter2"  class="form-control" id="Parameter2" value="<?php echo $rec_user->Parameter2; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Parameter3" class="col-lg-3 control-label" >Parameter3</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="Parameter3"  class="form-control" id="Parameter3" value="<?php echo $rec_user->Parameter3; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Parameter4" class="col-lg-3 control-label" >Parameter4</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="Parameter4"  class="form-control" id="Parameter4" value="<?php echo $rec_user->Parameter4; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Parameter5" class="col-lg-3 control-label" >Parameter5</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="Parameter5"  class="form-control" id="Parameter5" value="<?php echo $rec_user->Parameter5; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="inputSuccess">Is Active</label>
                                        <div class="col-lg-6">
                                            <select class ="form-control" name="IsActive" id="IsActive">
                                                <option value="<?php echo $rec_user->IsActive; ?> " selected=""><?php echo $rec_user->IsActive; ?></option>
                                                <?php
                                                foreach ($isactive as $k => $v) {
                                                    echo "<option value='" . $k . "'>" . $v . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="panel panel-primary">                        
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class=" col-lg-10">
                                            <button type="submit" name="update"  class="btn btn-success" id="update" value="Update">Update</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    echo form_close();
                    ?>
                </section>
            </aside>            
        </div>

        <!-- page end-->
    </section>
</section>
<!--main content end-->


