<?php

/**
 * This class defines functions to query the database and
 * build html tags, options for selection tag 
 * @author Luca Bonaldo <info@lucabonaldo.it>
 * @package LB-Select-Location
 */
class Select {

  /**
   * Name of table to contain region
   * @var string
   */
  var $regioni = "";

  /**
   * Name of table to contain province
   * @var string
   */
  var $province = "";

  /**
   * Name of table to contain longhouse
   * @var string
   */
  var $comuni = "";

  /**
   * This functioni construct to set value of class members
   * @param string $tb_regioni Name of table to contain region
   * @param string $tb_province Name of table to contain province
   * @param string $tb_comuni Name of table to contain longhouse
   */
  public function __construct($tb_regioni, $tb_province, $tb_comuni) {
    $this->regioni = $tb_regioni;
    $this->province = $tb_province;
    $this->comuni = $tb_comuni;
  }

  /**
   * This function allow get name of region by id 
   * <code>
   * Example:
   * <?php 
   * global $select;
   * $name = $select->get_regioneByID(5); 
   * echo $name;
   * ?>
   * Output: Veneto
   * </code>
   * @global wpdb $wpdb
   * @param int|string $regione_id
   * @return string Value return of select
   */
  public function get_regioneByID($regione_id) {

    global $wpdb;
    $table = $wpdb->prefix . $this->regioni;
    $sql = "SELECT R.regione_nome FROM $table AS R WHERE R.regione_id = $regione_id";

    return $wpdb->get_var($sql);
  }

  /**
   * This function allow get name or sigle of province by id 
   * <code>
   * Example:
   * <?php 
   * global $select;
   * $name = $select->get_provinciaByID(1, 'provincia_nome'); 
   * echo $name;
   * ?>
   * Output: Torino
   * </code>
   * @global wpdb $wpdb
   * @param int|string $provincia_id
   * @param string $field
   * @return string Value return of select
   */
  public function get_provinciaByID($provincia_id, $field) {

    global $wpdb;
    $table = $wpdb->prefix . $this->province;
    $sql = "SELECT P.$field FROM $table AS P WHERE P.provincia_id = $provincia_id";

    return $wpdb->get_var($sql);
  }

  /**
   * This function allow get name or cap of longhouse by id 
   * <code>
   * Example:
   * <?php 
   * global $select;
   * $cap = $select->get_comuneByID(001156, 'comune_cap'); 
   * echo $cap;
   * ?>
   * Output: 10024
   * </code>
   * @global wpdb $wpdb
   * @param int|string $comune_id
   * @param string $field
   * @return string Value return of select
   */
  public function get_comuneByID($comune_id, $field) {

    global $wpdb;
    $table = $wpdb->prefix . $this->comuni;
    $sql = "SELECT C.$field FROM $table AS C WHERE C.comune_id = $comune_id";

    return $wpdb->get_var($sql);
  }

  /**
   * This function allow to make select query into table region
   * <code>
   * Example:
   * <?php 
   * global $select;
   * $array = $select->get_regioni('regione_nome', ARRAY_N); 
   * print_r($array);
   * ?>
   * Output: Array ( [0] => Array ( [0] => Abruzzo ) [1] => Array ( [0] => Basilicata ) [2] => Array ( [0] => Calabria ) [n + 1] => Array(...) )
   * </code>
   * @global wpdb $wpdb
   * @param string $args Attribute of region to select   
   * @param string $result_type This parameter define the type of array for result
   * @return array This array is result by sql query 
   */
  public function get_regioni($args = 'regione_id&regione_nome', $result_type = ARRAY_A) {

    global $wpdb;
    $list = array();

    $fields_name = $this->replace($args);

    if (!$this->isEmpty($fields_name)) {

      $table = $wpdb->prefix . $this->regioni;
      $sql = "SELECT $fields_name FROM $table ORDER BY regione_nome";
      $list = $wpdb->get_results($sql, $result_type);
    }

    return $list;
  }

  /**
   * This function allow to make select query into table province
   * <code>
   * Example:
   * <?php 
   * global $select;
   * $array = $select->get_province(1, 'province_nome', ARRAY_N); 
   * print_r($array);
   * ?>
   * Output: Array ( [0] => Array ( [0] => Alessandria ) [1] => Array ( [0] => Asti ) [2] => Array ( [0] => Biella ) [n + 1] => Array (...))
   * </code>
   * @global wpdb $wpdb
   * @param int|string $regione_id ID of region record by province 
   * @param string $args Attribute of province to select   
   * @param string $result_type This parameter define the type of array for result
   * @return array This array is result by sql query 
   */
  public function get_province($regione_id, $args = 'provincia_id&provincia_nome', $result_type = ARRAY_A) {

    global $wpdb;
    $list = array();

    $fields_name = $this->replace($args);

    if (!$this->isEmpty($fields_name)) {

      $table = $wpdb->prefix . $this->province . ' AS P';
      $sql = "SELECT $fields_name FROM $table WHERE P.regione_id = $regione_id ORDER BY provincia_nome";
      $list = $wpdb->get_results($sql, $result_type);
    }

    return $list;
  }

  /**
   * This function allow to make select query into table comuni
   * <code>
   * Example:
   * <?php 
   * global $select;
   * $array = $select->get_comuni(1, 'comune_nome', ARRAY_N); 
   * print_r($array);
   * ?>
   * Output: Array ( [0] => Array ( [0] => Agliè ) [1] => Array ( [0] => Airasca ) [n + 1] => Array (...)) 
   * </code>
   * @global wpdb $wpdb
   * @param int|string $provincia_id ID of province record by longhouse 
   * @param string $args Attribute of longhouse to select  
   * @param string $result_type This parameter define the type of array for result
   * @return array This array is result by sql query 
   */
  public function get_comuni($provincia_id, $args = 'comune_id&comune_nome', $result_type = ARRAY_A) {

    global $wpdb;
    $list = array();

    $fields_name = $this->replace($args);

    if (!$this->isEmpty($fields_name)) {

      $table = $wpdb->prefix . $this->comuni . ' AS C';
      $sql = "SELECT $fields_name FROM $table WHERE C.provincia_id = $provincia_id";
      $list = $wpdb->get_results($sql, $result_type);
    }

    return $list;
  }

  /**
   * This function allow to build tags option html for regions 
   * @param string $args Attribute of region to select
   * @return string Tags option html for regions  
   */
  public function display_regioni($args = 'regione_nome') {

    $list = $this->get_regioni('regione_id&' . $args, ARRAY_N);
    $html = "";

    if (count($list) > 0) {

      foreach ($list as $r) {
        $html.= '<option value="' . $r[0] . '">' . utf8_encode($r[1]) . '</option>';
      }
    } else {
      $html = "DISPLAY ERROR REGIONI";
    }

    return $html;
  }

  /**
   * This function allow to build tags option html for provinces 
   * @param int|string $regione_id ID of region record by province
   * @param string $args Attribute of province to select
   * @return string Tags option html for provinces  
   */
  public function display_province($regione_id, $args = 'provincia_nome') {

    $list = $this->get_province($regione_id, 'provincia_id&' . $args, ARRAY_N);
    $html = "";

    if (count($list) > 0) {

      $fields = (int) count(explode("&", $args));

      foreach ($list as $r) {

        $value = ($fields == 2) ? ($r[1] . " - " . $r[2]) : $r[1];
        $html.= '<option value="' . $r[0] . '">' . utf8_encode($value) . '</option>';
      }
    } else {
      $html = "DISPLAY ERROR PROVINCE";
    }

    return $html;
  }

  /**
   * This function allow to build tags option html for longhouses
   * @param int|string $provincia_id ID of province record by province
   * @param string $args Attribute of longhouse to select
   * @return string Tags option html for provinces  
   */
  public function display_comuni($provincia_id, $args = 'comune_nome') {

    $list = $this->get_comuni($provincia_id, 'comune_id&' . $args, ARRAY_N);
    $html = "";

    if (count($list) > 0) {

      $fields = (int) count(explode("&", $args));

      foreach ($list as $r) {

        $value = ($fields == 2) ? ($r[1] . " - " . $r[2]) : $r[1];
        $html.= '<option value="' . $r[0] . '">' . utf8_encode($value) . '</option>';
      }
    } else {
      $html = "DISPLAY ERROR COMUNI";
    }

    return $html;
  }

  /**
   * This function allow to replace all chars "&" with ","
   * @param string $str 
   * @return string 
   */
  private function replace($str) {
    return str_replace("&", ",", $str);
  }

  /**
   * This function allow to control if into $str there are chars "," 
   * @param string $str 
   * @return int 
   */
  private function isEmpty($str) {
    return (count(explode(",", $str)) > 0) ? 0 : 1;
  }

}

$select = new Select(TB_REG, TB_PRO, TB_COM);
?>
