<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo form_open_multipart('con_set_worker_profile/save_file'); ?>
        upload a file : <input type="file" name="excel_file"/> <br/>
        
        <input type="submit" name="submit" value="submit"/>
        <?php echo form_close(); ?>
    </body>
</html>
