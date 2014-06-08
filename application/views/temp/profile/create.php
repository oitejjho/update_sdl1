
<?php
$role = array(
    'Admin' => 'Admin',
    'Manager' => 'Manager',
    'ItOperator' => 'ItOperator'
);
?>
<?php
$gender = array(
    'male' => 'Male',
    'Female' => 'Female'
);
?>
<?php
$isactive = array(
    'yes' => 'Yes',
    'no' => 'No'
);
?>
<style>
    label.error{
        color: red;
        font-weight: bold;
    }
</style>

<link href="<?php echo base_url(); ?>css/stylemultistep.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>js/jquery.inputfocus-0.9.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.main.js"></script>

<script>
    $(function() {
        $("#Birthday").datepicker({
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
            <div id="container">
                <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'profile', 'role' => 'form', 'action' => '#');
                echo form_open_multipart('con_set_user/insert', $attributes);
                ?>

                <!-- #first_step -->
                <div id="first_step">
                    <h1>SIGN UP FOR A FREE <span>WEBEXP18</span> ACCOUNT</h1>

                    <div class="form">
                        <input type="text" name="UserName" id="UserName" value="username" />
                        <label for="username">At least 4 characters. Uppercase letters, lowercase letters and numbers only.</label>

                        <input type="password" name="Password" id="password" value="Password" />
                        <label for="password">At least 4 characters. Use a mix of upper and lowercase for a strong password.</label>

                        <input type="password" name="cpassword" id="cpassword" value="password" />
                        <label for="cpassword">If your passwords aren’t equal, you won’t be able to continue with signup.</label>
                    </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    <input class="submit" type="submit" name="submit_first" id="submit_first" value="" />
                </div>      


                <!-- #second_step -->
                <div id="second_step">
                    <h1>SIGN UP FOR A FREE <span>WEBEXP18</span> ACCOUNT</h1>

                    <div class="form">
                        <input type="text" name="FirstName" id="FirstName" value="first name" />
                        <label for="firstname">Your First Name. </label>
                        <input type="text" name="MiddleName" id="MiddleName" value="last name" />
                        <label for="lastname">Your Last Name. </label>
                        <input type="text" name="Email" id="Email" value="email address" />
                        <label for="email">Your email address. We send important administration notices to this address. </label>                    
                    </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    <input class="submit" type="submit" name="submit_second" id="submit_second" value="" />
                </div>     


                <!-- #third_step -->
                <div id="third_step">
                    <h1>SIGN UP FOR A FREE <span>WEBEXP18</span> ACCOUNT</h1>

                    <div class="form">
                        <select id="age" name="age">
                            <option> 0 - 17</option>
                            <option>18 - 25</option>
                            <option>26 - 40</option>
                            <option>40+</option>
                        </select>
                        <label for="age">Your age range. </label> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->

                        <select id="gender" name="gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                        <label for="gender">Your Gender. </label> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->

                        <select id="country" name="country">
                            <option>United States</option>
                            <option>United Kingdom</option>
                            <option>Canada</option>
                            <option>Serbia</option>
                            <option>Italy</option>
                        </select>
                        <label for="country">Your country. </label> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->

                    </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    <input class="submit" type="submit" name="submit_third" id="submit_third" value="" />

                </div>      


                <!-- #fourth_step -->
                <div id="fourth_step">
                    <h1>SIGN UP FOR A FREE <span>WEBEXP18</span> ACCOUNT</h1>

                    <div class="form">
                        <h2>Summary</h2>

                        <table>
                            <tr><td>Username</td><td></td></tr>
                            <tr><td>Password</td><td></td></tr>
                            <tr><td>Email</td><td></td></tr>
                            <tr><td>Name</td><td></td></tr>
                            <tr><td>Age</td><td></td></tr>
                            <tr><td>Gender</td><td></td></tr>
                            <tr><td>Country</td><td></td></tr>
                        </table>
                    </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    <input class="send submit" type="submit" name="submit_fourth" id="submit_fourth" value="" />            
                </div>

                <?php
                echo form_close();
                ?>
            </div>
            <div id="progress_bar">
                <div id="progress"></div>
                <div id="progress_text">0% Complete</div>
            </div>

        </div>

        <!-- page end-->
    </section>
</section>
<!--main content end-->
