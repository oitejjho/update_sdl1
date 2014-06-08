<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $meta = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'My Great Site'),
            array('name' => 'keywords', 'content' => 'love, passion, intrigue, deception'),
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        echo meta($meta);
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/443775.png">
        <title>OPEX GROUP Ltd</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />
        <style>
            label.error{
                color: red;
                font-weight: bold;
            }
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>js/html5shiv.js"></script>
        <script src="<?php echo base_url(); ?>js/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#login").validate({
                    rules: {
                        Email: {
                            required: true,
                            email: true
                        },
                        Password: "required"
                    },
                    messages: {
                        Email: "Please enter a valid email address",
                        Password: "Please enter your password"
                    }

                });


            });

        </script>
    </head>

    <body class="login-body">
        <div class="container">
            <?php
            $attributes = array('class' => 'form-signin', 'id' => 'login');
            echo form_open('con_set_user_login_info/login_validation', $attributes);
            ?>
            <h2 class="form-signin-heading">sign in now</h2>
            <?php echo validation_errors(); ?>
            <div class="login-wrap">
                <input type="text" class="form-control" name="Email" id="Email" placeholder="User Email " autofocus>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right"> <a href="#">Forgot Password?</a></span>
                </label>
                <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</body>
</html>
