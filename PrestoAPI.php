<?php

/**
 * @package PrestoAPI
 */
/* 
Plugin Name: PrestoAPI
Plugin URI: https://prestoapi.com
Description: Database connector for PrestoAPI
Version: 1.0.0
Author: Andrew Samole
License: GPLv2 or later
Text Domain: prestoapi 
*/
/*
    Copyright (C) 2020  Andrew Samole

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <https://www.gnu.org/licenses/>.
    For any questions or concerns, contact andrew@prestoapi.com.
*/
// require_once('wp-config.php');


// if (!defined('ABSPATH')) {
//     die;
// }

class PrestoAPI
{
    function activate()
    {
        echo 'The plugin was activated';
    }
    function deactivate()
    {
        echo 'The plugin was deactivated';
    }
    function uninstall()
    {
        echo 'The plugin was uninstalled';
    }
    function add_front_page()
    {
        include_once("form.php");
    }
}
if (class_exists('PrestoAPI'))
    $prestoAPI = new PrestoAPI();

// activation
// register_activation_hook(__FILE__, array($prestoAPI, 'activate'));
//  deactivation
// register_deactivation_hook(__FILE__, array($prestoAPI, 'activate'));
// uninstall
// register_uninstall_hook(__FILE__, array($prestoAPI, 'uninstall'));
