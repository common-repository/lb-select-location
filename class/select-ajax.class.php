<?php

/**
 * This class defines functions for the management of Ajax in wordpress plugin
 * @author Luca Bonaldo <info@lucabonaldo.it>
 * @package LB-Select-Location
 */
class Select_Ajax {

  /**
   *
   * @var string Name of action 
   */
  var $action = 'ajax-sl';

  /**
   * This function constructor has add the actions for wordpress 
   */
  public function __construct() {

    add_action('wp_enqueue_scripts', array(&$this, 'register'));
    add_action('admin_enqueue_scripts', array(&$this, 'register_admin'));
    add_action('wp_ajax_nopriv_' . $this->action, array(&$this, 'ajax_callback'));
    add_action('wp_ajax_' . $this->action, array(&$this, 'ajax_callback'));
  }

  /**
   * This function registered the script js in front-end page 
   */
  public function register() {
    $this->register_scripts();
  }

  /**
   * This function  registered the script js in back-end page 
   * @param string $hook Name page
   */
  public function register_admin($hook) {
    //  if ($hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php')
    //    return;
    $this->register_scripts();
  }

  /**
   * 
   */
  private function register_scripts() {

    wp_enqueue_script($this->action, plugin_dir_url(__DIR__) . 'js/select.js', array('jquery'));

    wp_localize_script($this->action, 'sl_AjaxObject', array(
        'url' => admin_url('admin-ajax.php'),
        'action' => $this->action,
    ));
  }

  /**
   * This function response to ajax call
   * @global Select $select @see Select::$select
   */
  public function ajax_callback() {
    if (
            isset($_POST['action']) &&
            $_POST['action'] == $this->action &&
            isset($_POST['type']) &&
            isset($_POST['field']) &&
            isset($_POST['id'])
    ) {


      global $select;
      $html_resp = "";

      switch ($_POST['type']) {

        case 'province':
          $html_resp = $select->display_province($_POST['id'], $_POST['field']);
          break;

        case 'comuni':
          $html_resp = $select->display_comuni($_POST['id'], $_POST['field']);
          break;
      }

      echo $html_resp;
    } else {
      echo 'AJAX RESPONS ERROR';
    }

    die();
  }

}

$select_ajax = new Select_Ajax();
?>