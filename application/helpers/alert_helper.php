<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('get_alert_by_id')) {

    function get_alert_by_id($id) {
        $message_array = array(
            '101' => 'Insert Successfully',
            '102' => 'Update Successfully',
            '103' => 'Delete Successfully',
            '104' => 'Are Your sure you want to delete',
            '105' => 'You are not allowed to run this operation'
        );

        return $message_array[$id];
    }
}
?>
