<?php

/*
  Plugin Name: LB Select location
  Description: LB Select Location è un plugin per Wordpress che permette di aggiungere al vostro blog, una select multipla a cascata per la selezione di una regione, provincia, comune d'Italia mediante uno shortcode. Inoltre il plugin mette a disposizione delle API per interagire con la base di dati e per selezionare dei valori predefiniti nelle select.
  Author:      Luca Bonaldo
  Author URI:  http://www.lucabonaldo.it
  Plugin URI:  http://www.lucabonaldo.it/lb-select-location-plugin/
  Version: 2.6.1
  License: GPLv3
 */
/*
  Copyright (C) 2013  Luca Bonaldo

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>
 */
/**
 * @author Luca Bonaldo <info@lucabonaldo.it>
 * @package LB-Select-Location
 * @version 2.6.0
 * Displays <a href="http://opensource.org/licenses/gpl-license.php">GNU Public License</a>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
//defined('ABSPATH') OR exit;
define('DB_PATH', plugin_dir_url(__FILE__) . 'database/sl_comuni_italiani.sql');

define('TB_REG', 'sl_regioni');
define('TB_PRO', 'sl_province');
define('TB_COM', 'sl_comuni');

include 'class/select.class.php';
include 'class/select-ajax.class.php';
include 'class/select-shortcode.class.php';
include 'class/select-load.class.php';

if (!function_exists('sl_import_database')) {

  register_activation_hook(__FILE__, 'sl_import_database');

  /**
   * This function scan the SQL code contained in the file and executes sl_comuni_italiani.sql
   * queries to import tables region, province,  longhouse in the data base current.
   * @global type $wpdb
   * @package LB-Select-Location
   */
  function sl_import_database() {

    global $wpdb;

    $file = file_get_contents(DB_PATH);
    $file = str_replace("?", $wpdb->prefix, $file);
    $queries = explode(";", $file);

    foreach ($queries as $query) {
      $wpdb->query($query);
    }
  }

}

if (!function_exists('sl_drop_database')) {

  register_uninstall_hook(__FILE__, 'sl_drop_database');

  /**
   * Remove tables region, province, longhouse.
   * @global type $wpdb
   * @package LB-Select-Location
   */
  function sl_drop_database() {

    global $wpdb;
    $wpdb->query('DROP TABLE ' . $wpdb->preix . TB_REG);
    $wpdb->query('DROP TABLE ' . $wpdb->preix . TB_PRO);
    $wpdb->query('DROP TABLE ' . $wpdb->preix . TB_COM);
  }

}

if (!function_exists('sl_register_style')) {

  add_action('wp_enqueue_scripts', 'sl_register_style');
  add_action('admin_print_styles', 'sl_register_style');

  /**
   * This function allow  to register stylesheet for tag select 
   * @package LB-Select-Location
   */
  function sl_register_style() {
    wp_register_style('sl-style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_style('sl-style');
  }

}
?>
